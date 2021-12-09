<?php

    function indexAction($connect, $controllerName, $actionName, $user){
        
        if(!$user){
            header("Location: /");
        }else{
            $user = false;
            $_SESSION['user'] = false;
            $_SESSION['logout'] = true;
            
            echo "success";
        }
        
    }
    
?>