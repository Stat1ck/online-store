<?php

    function indexAction($connect, $controllerName, $actionName, $user){
        
        $pagetitle = "Главная";

        $templates = ['menu', 'modals', 'header', 'categories', 'aboutus', 'blog', 'footer'];
        
        $sql = $connect->prepare('SELECT * FROM categories');
        $sql->execute();
    
        $info = $sql->fetchAll();

        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }

    }
    
?>