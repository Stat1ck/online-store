<?php

    function indexAction($connect, $controllerName, $actionName, $user){
        
        if(!$user){
            Header("Location: /");
        }else{
            getCart($connect, $user);
            $info = $_SESSION['cartInfo'];
            
            productCheck($connect);
        }
        
        $pagetitle = "Корзина";

        $templates = ['menu', 'modals', 'cart', 'footer'];

        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }
        
    }
    
?>