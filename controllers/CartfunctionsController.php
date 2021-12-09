<?php

    function addtocartAction($connect, $controllerName, $actionName, $user){
    
        $productId = $_POST['product_id'];
        
        $kol = 1;
        
        productCheck($connect, $productId);
        
        if(!$_SESSION['end']){
            $sql = $connect->prepare("INSERT INTO cart (user_id, product_id, product_amount) VALUES (?, ?, ?)");
            $sql->bindParam(1, $_SESSION['userUniqueId']);
            $sql->bindParam(2, $productId);
            $sql->bindParam(3, $kol);
            $sql->execute();
        }
        
        productCheck($connect, $productId);
        
        echo $_SESSION['product_Numb'];
        
    }
    
    function deleteproductfromcartAction($connect, $controllerName, $actionName, $user){
        
        $deleteProductID = explode(",", $_POST['product_id']);
        
        for($i = 0; $i < count($deleteProductID); $i++){
            
            $sql = $connect->prepare("DELETE FROM cart WHERE product_id = ? AND user_id = ?");
            $sql -> execute([$deleteProductID[$i], $_SESSION['userUniqueId']]);
                
        }
        
        productCheck($connect, $deleteProductID);

        echo $_SESSION['product_Numb'];
        
    }
    
    function changeproductcountAction($connect, $controllerName, $actionName, $user){
        
        $productId = $_POST['product_id'];
        $kol = $_POST['product_count'];
        
        productCheck($connect, $productId);
        
        if($_SESSION['end']){
            
            $sql = $connect->prepare("UPDATE cart SET product_amount = ? WHERE product_id = ? AND user_id = ?");
            $sql->execute([$kol, $productId, $_SESSION['userUniqueId']]);
            
        }

        getProductInfo($connect, $productId);
        $info = $_SESSION['changedProductInfo'];

        echo json_encode($info);
        
    }
    
    function buyproductfromcartAction($connect, $controllerName, $actionName, $user){
        
        if($user){
            
            $productId = explode(",", $_POST['product_id']);
            $CartSumma = intval($_POST['CartSumma']);
            $unique_id = uniqid(rand(time(), 100000000), true);
            $condition_order = "process";
            
            $sql = $connect->prepare("DELETE FROM orders WHERE condition_order = ? AND user_id = ?");
            $sql -> execute([$condition_order, $_SESSION['userUniqueId']]);
        
            for($i = 0; $i < count($productId); $i++){
                
                $sql_amount = $connect->prepare("SELECT product_amount from cart WHERE user_id = ? AND product_id = ?");
                $sql_amount->bindParam(1, $_SESSION['userUniqueId']);
                $sql_amount->bindParam(2, $productId[$i]);
                $sql_amount->execute();
                
                $product_amount = $sql_amount->fetchAll();
                
                foreach ($product_amount as $product){
                    $amounts = $product['product_amount'];
                }

                $sql = $connect->prepare("INSERT INTO orders (unique_id_order, user_id, products_id, products_amount, order_sum, condition_order) VALUES (?, ?, ?, ?, ?, ?)");
                $sql->bindParam(1, $unique_id);
                $sql->bindParam(2, $_SESSION['userUniqueId']);
                $sql->bindParam(3, $productId[$i]);
                $sql->bindParam(4, $amounts);
                $sql->bindParam(5, $CartSumma);
                $sql->bindParam(6, $condition_order);
                
                $sql->execute();
                
            }
            
        }

    }

?>