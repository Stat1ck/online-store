<?php
    
    // переменные для получения страницы из url
    $controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';
    
    $actionName = isset($_GET['action']) ? $_GET['action'] : 'index';
    
?>