<?php

    function indexAction($connect, $controllerName, $actionName, $user){
        
        $pagetitle = "Помощь";

        $templates = ['menu', 'modals', 'help', 'footer'];

        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }
        
    }
    
?>