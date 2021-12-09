<!DOCTYPE HTML>
<html>
<head>
    <title>
        <?php echo $pagetitle ?>
    </title>
    <style>
        .preloader{
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            background: #fdfdfd;
            z-index: 1001;
        }
        .preloader img{
            position: relative;
            top: 50%;
            left: 50%;
            width: 150px;
            height: 150px;
            margin-top: -75px;
            margin-left: -75px;
        }
        @media (max-width: 767px){
            .preloader img{
                width: 100px;
                height: 100px;
                margin-top: -50px;
                margin-left: -50px;
            }
        }
        .loaded_hiding .preloader{
            transition: 1s opacity;
            opacity: 0.9;
        }
        .loaded .preloader{
            display: none;
        }
        body{
            overflow: hidden;
        }
    </style>
    <script>
        window.onload = function () {
            document.body.classList.add('loaded_hiding');
            window.setTimeout(function () {
                document.body.classList.remove('loaded_hiding');
                document.body.classList.add('loaded');
                document.body.style.overflow = "auto";
            }, 1000);
        }
    </script>
    <?php For($i=0; $i<count($templates); $i++) { ?>
        <link href="/css/<?php echo $templates[$i] ?>-style.css" rel="stylesheet">
    <?php } ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/img/favicon_3.ico" type="image/x-icon">
</head>
<body>
    <div class="preloader">
        <img src="/img/logogif.gif">
    </div>
    <div class="menu">
        <div class="con_for_menu">
            <div class="menu_blok_for_logo">
                <a href="/" class="menu_link_for_logo">
                    <img src="/img/logo.png" class="menu_logo" alt="logo" />
                </a>
            </div>
            <div class="menu_blok_for_links">
                <?php if($controllerName != "Index") : ?>
                    <div class="menu_bloks_for_links">
                        <a href="/">Главная</a>
                    </div>
                <?php elseif($controllerName != "Catalog") : ?>
                    <div class="menu_bloks_for_links">
                        <a href="/catalog/">Каталог</a>
                    </div>
                <?php endif; ?>
                <div class="menu_bloks_for_links">
                    <a href="/#aboutus " class="menu_link_for_aboutus">О нас</a>
                </div>
                <div class="menu_bloks_for_links">
                    <a href="/#blog" class="menu_link_for_blog">Блог</a>
                </div>
                <div class="menu_bloks_for_links">
                    <a href="/#contacts" class="menu_link_for_contacts">Контакты</a>
                </div>
            </div>
            <div class="menu_blok_for_btns">
                <?php if($user): ?>
                    <a href="/cart/" class="menu_link_icons cart_link" title="Корзина">
                        <img src="/img/cart.png" class="menu_icons_image">
                        <span class="product_cart_number"><?php if(!empty($_SESSION['product_Numb'])) { echo $_SESSION['product_Numb']; }else{ echo "0"; } ?></span>
                    </a>
                <?php endif; ?>
                    <a href="#" class="menu_link_icons btn_toggle_personalarea" onclick="return false;" title="<?php if($user){
                                echo $_SESSION['userFName'];
                            }else{
                                echo "Гость";
                            }?>">
                        <?php if(($_SESSION['userAvatar'] == "user.png") || (!$user)): ?>
                            <img src="/img/avatars/user.png" class="menu_icons_image" id="menu_user_avatar">
                        <?php else : ?>
                            <img src="/img/avatars/<?php echo $_SESSION['userAvatar']; ?>" class="menu_icons_image user_avatar" id="menu_user_avatar">
                        <?php endif; ?>
                    </a>
                    <div class="block_person_bottom_menu">
                        <?php if($user): ?>
                            <div class="block_for_userName">
                                <?php
                                    echo $_SESSION['userFName'];
                                ?>
                            </div>
                            <div>
                                <a href="/personalarea/" class="menu_link_icons">Личный кабинет</a>
                            </div>
                            <div>
                                <a href="/orders/" class="menu_link_icons">Заказы</a>
                            </div>
                            <div>
                                <a href="#" class="logout">Выйти</a>
                            </div>
                        <?php else: ?>
                            <div class="block_for_userName">
                                Добро пожаловать, Гость!
                            </div>
                            <div>
                                <a href="#" class="goToLogin">Вход</a>
                            </div>
                            <div>
                                <a href="#" class="goToReg">Регистрация</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <a href="#" class="goToSearch" title="Поиск">
                        <img src="/img/search.png" alt="поиск" class="goToSearch">
                    </a>
            </div>
            <div class="menu_bars">
                <div class="menu_bar"></div>
                <div class="menu_bar"></div>
                <div class="menu_bar"></div>
            </div>
        </div>
    </div>