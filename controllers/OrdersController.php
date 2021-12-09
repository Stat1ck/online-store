<?php

    function indexAction($connect, $controllerName, $actionName, $user){
        
        if(!$user){
            Header("Location: /");
        }
        
        $sql = $connect->prepare("SELECT * FROM orders INNER JOIN products ON orders.products_id = products.id WHERE user_id = ? AND condition_order = 'ready' ORDER BY date DESC");
        $sql -> execute([$_SESSION['userUniqueId']]);
        
        $res = $sql->fetchAll();
        
        $info = Array();
        
        foreach ($res as $item){
            if($item['unique_id_order'] != $info[count($info) - 1]){
                array_push($info, $item['unique_id_order']);
            }
        }
        
        $pagetitle = 'Ваши заказы';

        $templates = ['menu', 'modals', 'orders', 'footer'];

        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }
        
    }
    
    function deleteorderAction($connect, $controllerName, $actionName, $user){
        
        if(!$user){
            Header("Location: /");
        }
        
        $order_id = $_POST['orderId'];
        
        $sql = $connect->prepare("DELETE FROM orders WHERE unique_id_order = ? AND user_id = ?");
        $sql -> execute([$order_id, $_SESSION['userUniqueId']]);
            
        echo "success";
        
    }
    
?>