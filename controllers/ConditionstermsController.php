<?php

    function indexAction($connect, $controllerName, $actionName, $user){
        
        $pagetitle = 'Условия и соглашения';

        $templates = ['menu', 'modals', 'conditionsterms', 'footer'];

        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }
        
    }
    
?>