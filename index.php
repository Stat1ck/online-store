<?php
    session_start();
    if((isset($_SESSION['setCookUser'])) && (!empty($_SESSION['setCookUser']))){
        setcookie("UserCook", $_SESSION['setCookUser'], time() + 60 * 60 * 24 * 30, "/");
        unset($_SESSION['setCookUser']);
    }
    if((isset($_COOKIE['UserCook'])) && (!empty($_COOKIE['UserCook']))){
        $_SESSION['user'] = $_COOKIE['UserCook'];
    }
    if((isset($_SESSION['logout'])) && ($_SESSION['logout'] === true)){
        setcookie("UserCook", "", time() - 3600, "/");
        $_SESSION['user'] = false;
        unset($_SESSION['logout']);
    }

    include_once('./config/dbconnect.php');
    include_once('./config/config.php');
    include_once('./config/getController.php');
    include_once('./mainFunctions/mainFunctions.php');
    
    $user = $_SESSION['user'];
    
    getUserInfo($connect, $user);
    getCart($connect, $user);
    productCheck($connect);
    
    loadPage($controllerName, $actionName, $connect, $user);
    
?>