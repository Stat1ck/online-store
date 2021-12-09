    <?php
    
        foreach ($info as $item){
            $product_id = $item['id'];
            $product_img = $item['product_img'];
            $product_name = $item['product_name'];
            $product_fullinfo = $item['product_fullinfo'];
            $product_price = $item['product_price'];
            $product_weight = $item['product_weight'];
            $product_mweight = $item['product_mweight'];
            $product_status = $item['product_status'];
            $product_bonus = $item['product_bonus'];
            $product_country = $item['product_country'];
            $product_categoryPath = $item['category_path'];
        }
        
        if($user){
            include('config/dbconnect.php');
            
            $sqlCartProduct = $connect->prepare("SELECT product_amount from cart WHERE user_id = ? and product_id = ?");
            $sqlCartProduct->bindParam(1, $_SESSION['userUniqueId']);
            $sqlCartProduct->bindParam(2, $product_id);
            $sqlCartProduct->execute();
            $infoCartProduct = $sqlCartProduct->fetchAll();
                                
            foreach($infoCartProduct as $product_amount){
                $productAmount = $product_amount['product_amount'];
            }
            
            $sqlCat = $connect->prepare("SELECT pagetitle from routers WHERE path = ?");
            $sqlCat->bindParam(1, $product_categoryPath);
            $sqlCat->execute();
            $infoCat = $sqlCat->fetchAll();
                                
            foreach($infoCat as $productCat){
                $product_category = $productCat['pagetitle'];
            }
        }
    ?>
    <div class="block_for_product_content">
        <div class="block_for_product_content_inside">
            <a href="/catalog/" class="link_product_to_back" style="text-decoration: none">&#8592; Каталог</a>
            <div class="product_block_for_info">
                <div class="product_gallery">
                    <img src="/img/<?php echo $product_img; ?>" alt="<?php echo $product_name; ?>" class="product_main_image" />
                </div>
                <div class="product_block_info_outside">
                    <div class="product_block_info_inside">
                        <h1 class="product_name_header"><?php echo $product_name; ?></h1>
                        <div class="product_first_line"></div>
                        <div class="product_second_line"></div>
                        <div class="product_min_info">
                            <div class="product_every_min_info">
                                <span>Цена указана за: </span>
                                <span>Страна происхождения: </span>
                                <span>Бонусные баллы: </span>
                                <span>Наличие: </span>
                                <span>Категория: </span>
                            </div>
                            <div class="product_every_min_info">
                                <span><?php echo $product_weight. ' ' .$product_mweight ?></span>
                                <span><?php echo $product_country ?></span>
                                <span><?php echo $product_bonus ?></span>
                                <span>
                                    <?php if($product_status != 0) : ?> 
                                        <font style="color:green">Есть в наличии <?php echo $product_status ?> <?php echo $product_mweight ?></font>
                                    <?php else : ?>
                                        <font style="color:red">Нет в наличии</font>
                                    <?php endif; ?>
                                </span>
                                <span><a href="/catalog/category/<?php echo $product_categoryPath ?>/" class="link_product_to_back" style="text-decoration: none"><?php echo $product_category ?></a></span>
                            </div>
                        </div>
                        <div class="price">
                            <?php echo $product_price . ' руб. за ' . $product_weight. ' ' .$product_mweight ?>
                        </div>
                        <?php
                            if($product_status != 0) :
                                if((!empty($productAmount)) && ($user)) :
                        ?>
                            <div class="btns_change_count_product">
                                <input type="button" onclick="removeOneProduct(<?php echo $product_id ?>, true, <?php echo $product_status ?>)" value="-" class="btns_cart">
                                <input type="number" id="<?php echo $product_id; ?>" min="0" max="<?php echo $product_status ?>" value="<?php if($product_status >= $productAmount){ echo $productAmount; }else{ echo $product_status; } ?>" class="btns_cart product_count <?php if($productAmount >= $product_status){ echo "dis"; } ?>" readonly>
                                <input type="button" onclick="addOneProduct(<?php echo $product_id; ?>, <?php echo $product_status ?>, true)" value="+" class="btns_cart">
                            </div>
                        <?php elseif((empty($productAmount)) && ($user)) : ?>
                            <div class="btns_change_count_product">
                                <a href="#" onclick="addToCart(<?php echo $product_id . ', ' .$product_status ?>); return false;" class="catalog_dobavkorzina">Добавить в корзину</a>
                            </div>
                        <?php endif; ?>
                        <?php if(!$user) : ?>
                            <div class="for__goToLogin">
                                <a href="#" class="goToLogin" title="Авторизуйтесь, чтобы добавить товар в корзину!">Авторизоваться</a>
                            </div>
                        <?php endif; else : ?>
                            <div class="btns_change_count_product">
                                <a href="#" onclick="return false;" class="catalog_dobavkorzina disable">Нет в наличии</a>
                            </div>
                        <?php endif; ?>
                        <div class="div_pocelit">
                            Поделиться <br/>
                                <a class="div_pocelit"  title="Facebook" rel="nofollow" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                                    <img class="imgg" src="/img/facebook.png">
                                </a>
                                <a class="div_pocelit" title="Twitter" rel="nofollow" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                                    <img class="imgg" src="/img/social_network_twitter_icon-icons.com_66157.png">
                                </a>
                                <a  class="div_pocelit" title="Вконтакте" rel="nofollow" target="_blank" href="https://vkontakte.ru/share.php?url=<?php echo ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                                    <img  class="imgg" src="/img/1486147202-social-media-circled-network10_79475 (1).png">
                                </a>
                                <a class="div_pocelit" title="Одноклассники" rel="nofollow" target="_blank" href="https://connect.ok.ru/offer?url=<?php echo ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                                    <img  class="imgg" src="/img/classmates_logo_icon_134599.png">
                                </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product_full_info">
                <h3>Описание |</h3>
                <p>
                    <?php echo $product_fullinfo; ?>
                </p>
            </div>
        </div>
    </div>