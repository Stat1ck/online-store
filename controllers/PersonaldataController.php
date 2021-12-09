<?php

    function indexAction($connect, $controllerName, $actionName, $user){
        
        $pagetitle = 'Политика обработки персональных данных';

        $templates = ['menu', 'modals', 'personaldata', 'footer'];

        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }
        
    }
    
?>