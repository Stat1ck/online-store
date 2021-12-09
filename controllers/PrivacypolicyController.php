<?php

    function indexAction($connect, $controllerName, $actionName, $user){
        
        $pagetitle = 'Политика конфиденциальности';

        $templates = ['menu', 'modals', 'privacypolicy', 'footer'];

        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }
        
    }
    
?>