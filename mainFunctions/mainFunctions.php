<?php

    function getCart($connect, $user){
        
        if($user){
        
            $sql = $connect->prepare("SELECT * FROM cart INNER JOIN products ON cart.product_id = products.id AND products.product_status >= 1 WHERE user_id = ?");
            $sql -> execute([$_SESSION['userUniqueId']]);
            $info = $sql->fetchAll();
            
            $_SESSION['cartInfo'] = $info;
            
        }
        
    }
    
    function getProductInfo($connect, $productId){
        
        $sql = $connect->prepare("SELECT * FROM cart INNER JOIN products ON cart.product_id = products.id WHERE product_id = ? AND user_id = ?");
        $sql -> execute([$productId, $_SESSION['userUniqueId']]);
        $info = $sql->fetchAll();
            
        $_SESSION['changedProductInfo'] = $info;
        
    }
    
    function productCount($connect, $productId){
        
        $sql = $connect->prepare("SELECT product_count FROM cart INNER JOIN products ON cart.product_id = products.id AND products.product_status >= 1 WHERE user_id = ? AND product_id = ?");
        $sql -> execute([$_SESSION['userUniqueId'], $productId]);
        $productCount = $sql->fetchAll();
            
        foreach ($productCount as $product){
            $_SESSION['product_count'] = $product['product_amount'];
        }
        
    }
    
    function productCheck($connect, $productId = null){
        
        $sql = $connect->prepare("SELECT product_id FROM cart INNER JOIN products ON cart.product_id = products.id AND products.product_status >= 1 WHERE user_id = ?");
        $sql -> execute([$_SESSION['userUniqueId']]);
        $productID = $sql->fetchAll();
            
        foreach ($productID as $product){ 
            
            $productNumb++;
            
            if($productId == $product['product_id']){
                $end = true;
            }
            
        }
        
        if(empty($productNumb)){
            $productNumb = 0;
        }
            
        $_SESSION['product_Numb'] = $productNumb;
        $_SESSION['end'] = $end;
        
    }

    function getUserInfo($connect, $user){
        
        if($user){
            
            $sqlUser = $connect -> prepare("SELECT * FROM users WHERE unique_id = ?");
            $sqlUser -> execute([$user]);
            $user = $sqlUser->fetchAll();
            
            foreach($user as $userInfo){
                $_SESSION['userUniqueId'] = $userInfo['unique_id'];
                $_SESSION['userFName'] = $userInfo['fname'];
                $_SESSION['userLName'] = $userInfo['lname'];
                $_SESSION['userEmail'] = $userInfo['email'];
                $_SESSION['userPhone'] = $userInfo['phone'];
                $_SESSION['userAvatar'] = $userInfo['avatar'];
                $_SESSION['userAddres'] = $userInfo['addres'];
            }

        }
        
    }
    
    // функция загрузки страницы
    function loadPage ($controllerName, $actionName, $connect, $user){
        
        include_once(Path . $controllerName . Name);
        
        $function = $actionName. NameFunc;
    
        $function($connect, $controllerName, $actionName, $user);
        
    }
    
    // функция загрузки компонентов
    function loadTemplate ($component, $pagetitle, $templates, $info, $controllerName = null, $actionName = null, $user = null){
    
        include('./template/'.$component.'.php');
        
    }
    
?>