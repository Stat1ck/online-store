<?php

    function indexAction($connect, $controllerName, $actionName, $user) {

        $pagetitle = 'Каталог';

        $templates = ['menu', 'modals', 'catalog', 'footer'];
        
        $sql = $connect->prepare("SELECT * FROM products");
        
        $sql->execute();    
            
        $info = $sql->fetchAll();

        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }

    }

    function categoryAction($connect, $controllerName, $actionName, $user) {

        $category_array = array("catalog", "vegetables", "fruits");

        $category = isset($_GET['category']) ? $_GET['category'] : "catalog";
        
        $sql = $connect->prepare("SELECT pagetitle FROM routers WHERE path = ?");
        $sql->execute([$category]);

        $info = $sql->fetchAll();

        foreach ($info as $item){
            $pagetitle = $item['pagetitle'];
        }
        
        $sql = $connect->prepare("SELECT * FROM products WHERE category_path = ?");
        $sql->execute([$category]);

        $info = $sql->fetchAll();

        $templates = ['menu', 'modals', 'catalog', 'footer'];

        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }

    }

    function productAction($connect, $controllerName, $actionName, $user){

        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $id = intval($id);

        $sql = $connect->prepare("SELECT * FROM products WHERE id = ?");
        $sql->execute([$id]);

        $info = $sql->fetchAll();

        foreach ($info as $item){
            $pagetitle = $item['product_name'];
        }

        $templates = ['menu', 'modals', 'product', 'footer'];

        for ($i=0; $i<count($templates); $i++) {
            loadTemplate($templates[$i], $pagetitle, $templates, $info, $controllerName, $actionName, $user);
        }

    }
    
?>