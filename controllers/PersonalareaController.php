<?php

    function indexAction($connect, $controllerName, $actionName, $user){
        
        if(!$user){
            Header("Location: /");
        }
        
        $pagetitle = 'Личный кабинет';

        $templates = ['menu', 'modals', 'personalarea', 'footer'];

        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }
        
    }
    
?>