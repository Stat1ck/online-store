<?php

    function productsAction($connect, $controllerName, $actionName, $user){
        
        $filter = htmlspecialchars(trim($_GET['search']));
        $sql = $connect->prepare("SELECT * FROM products WHERE search_words LIKE ?");
        $sql->execute(['%'.$filter.'%']);

        $info = $sql->fetchAll();
        
        if(!empty($info)){
            $pagetitle = "Поиск по запросу '$filter'";
        }else{
            $pagetitle = "Ничего не найдено!";
        }
        
        $templates = ['menu', 'modals', 'catalog', 'footer'];
    
        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }
        
    }
    
?>