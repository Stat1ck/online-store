<?php

    function indexAction($connect, $controllerName, $actionName, $user){
        
        $condition_order = "process";
        
        $sql = $connect->prepare("SELECT * FROM orders INNER JOIN products ON orders.products_id = products.id WHERE user_id = ? AND condition_order = ?");
        $sql -> execute([$_SESSION['userUniqueId'], $condition_order]);
        $info = $sql->fetchAll();
        
        if(!$user){
            Header("Location: /");
        }else if(empty($info)){
            Header("Location: /cart/");
        }
        
        $pagetitle = "Оформить заказ";

        $templates = ['menu', 'modals', 'checkout', 'footer'];

        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }
        
    }
    
    function backtocartAction($connect, $controllerName, $actionName, $user){
        if(!$user){
            Header("Location: /");
        }else{
            $sql = $connect->prepare("DELETE FROM orders WHERE condition_order = 'process' AND user_id = ?");
            $sql -> execute([$_SESSION['userUniqueId']]);
            
            echo "success";
        }
    }
    
    function tocheckoutAction($connect, $controllerName, $actionName, $user){
        if(!$user){
            Header("Location: /");
        }else{
            
            $phone = $_POST['phone'];
            $addres = $_POST['addres'];
            $addrInfo = $_POST['addrInfo'];
            $pay = $_POST['pay'];
            
            $date = date("Y-m-d");
            
            $sql = $connect->prepare("SELECT unique_id_order FROM orders WHERE user_id = ? AND condition_order = 'process'");
            $sql -> execute([$_SESSION['userUniqueId']]);
            $info = $sql->fetchAll();
            
            foreach($info as $item){
                $order_id = $item['unique_id_order'];
            }
            
            $sql = $connect->prepare("UPDATE orders SET condition_order = 'ready', date = ?, phone = ?, addres = ?, addrInfo = ?, pay = ? WHERE condition_order = 'process' AND user_id = ?");
            $sql->execute([$date, $phone, $addres, $addrInfo, $pay, $_SESSION['userUniqueId']]);
            
            $sql = $connect->prepare("SELECT products_id FROM orders WHERE user_id = ? AND condition_order = 'ready' AND unique_id_order = ?");
            $sql -> execute([$_SESSION['userUniqueId'], $order_id]);
            $info = $sql->fetchAll();
            
            foreach($info as $item){
                $sql = $connect->prepare("DELETE FROM cart WHERE product_id = ? AND user_id = ?");
                $sql -> execute([$item['products_id'], $_SESSION['userUniqueId']]);
            }
            
            if(!empty($order_id)){
                echo $order_id;
            }else{
                echo "Error";
            }
        }
    }
    
?>