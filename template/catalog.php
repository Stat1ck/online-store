<?php
    $selectsPage = [4, 8, 12, 16];
?>
<div class="catalog_center">
    <?php if(empty($info)) : ?>
        <div class="block_search_notfound"><h2><?php echo $pagetitle; ?></h2></div>
    <?php else: ?>
    <div class="catalog_top">
        <h2 class="catalog_zagolovok_CATALOG"><?php echo $pagetitle; ?></h2>
        <div class="catalog_select_count_products">
            Количество товаров на странице:
            <select name="countProducts" id="countProducts">
                <?php for($i = 0; $i < count($selectsPage); $i++) : ?> 
                    <option <?php if($selectsPage[$i] == 8) : ?>selected<?php endif; ?> value="<?php echo $selectsPage[$i] ?>"><?php echo $selectsPage[$i] ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
    <!--<div class="catalog_sort_leftbar">
        <div class="catalog_show_to_sort">
            Сортировка 
            <div class="catalog_block_for_arrow">
                <div class="catalog_arrow catalog_first_part"></div>
                <div class="catalog_arrow catalog_second_part"></div>
            </div>
        </div>
        <div>
            <div>
                <select>
                    <option></option>
                    <option></option>
                </select>
            </div>
        </div>
    </div>-->
    <div class="block_for_catalog_content_center">
        <div class="grid_for_catalog">
            <?php
                foreach ($info as $item) :
                $count++;
                
                if($user){
                    include('config/dbconnect.php');
                        
                    $sqlCartProduct = $connect->prepare("SELECT product_amount from cart WHERE user_id = ? AND product_id = ?");
                    $sqlCartProduct->bindParam(1, $_SESSION['userUniqueId']);
                    $sqlCartProduct->bindParam(2, $item['id']);
                    $sqlCartProduct->execute();
                    $infoCartProduct = $sqlCartProduct->fetchAll();
                                            
                    foreach($infoCartProduct as $product_amount){
                        $productAmount = $product_amount['product_amount'];
                    }
                }
            ?>
            <div class="block_for_catalog<?php if($count > $selectsPage[1]) : ?> catalog_product_hide<?php else : ?> catalog_product_show<?php endif; ?>" id="<?php echo $count ?>ProductItem">
                <a href="/catalog/product/<?php echo $item['id'] ?>/" class="catalog_products_links">
                    <div>
                        <img src="/img/<?php echo $item['product_img'] ?>" alt="<?php echo $item['product_name'] ?>" class="catalog_product_img" />
                    </div>
                    <h3 class = "catalog_name_zagolovok_h3">
                        <?php echo $item['product_name'] ?>
                    </h3>
                </a>
                <div class="catalog_stoimost">
                    Стоимость указана за <?php echo $item['product_weight'] ?> <?php echo $item['product_mweight'] ?>
                </div>
                <a href="/catalog/product/<?php echo $item['id'] ?>/" class="catalog_chena">
                    <div class="catalog_chena_gl">
                        <?php echo $item['product_price'] ?> руб.
                    </div>
                    <div>
                        <?php if($item['product_status'] >= 1) : ?>
                            <p style="color: green">Есть в наличии</p>
                        <?php else : ?>
                            <p style="color: red">Нет в наличии</p>
                        <?php endif; ?>
                    </div>
                </a>
                <?php 
                    if($item['product_status'] >= 1) :
                        if($user) :
                            if(!empty($productAmount)):
                ?>
                <div class="btns_change_count_product" id="<?php echo $item['id'] ?>CatalogDeleteAddProduct">
                    <input type="button" onclick="removeOneProduct(<?php echo $item['id'] ?>, true, <?php echo $item['product_status'] ?>)" value="-" class="btns_cart">
                    <input type="number" id="<?php echo $item['id'] ?>" min="0" max="<?php echo $item['product_status'] ?>" value="<?php if($item['product_status'] >= $productAmount){ echo $productAmount; }else{ echo $item['product_status']; } ?>" class="btns_cart product_count <?php if($productAmount >= $item['product_status']){ echo "dis"; } ?>" readonly>
                    <input type="button" onclick="addOneProduct(<?php echo $item['id'] ?>, <?php echo $item['product_status'] ?>, true)" value="+" class="btns_cart">
                </div>
                <?php else : ?>
                <div class="btns_change_count_product" id="<?php echo $item['id'] ?>CatalogDeleteAddProduct">
                    <a href="#" onclick="addToCart(<?php echo $item['id'] . ', ' .$item['product_status'] ?>); return false;" class="catalog_dobavkorzina">Добавить в корзину</a>
                </div>
                <?php endif; else : ?>
                <div class="for__goToLogin">
                    <a href="#" class="goToLogin" title="Авторизуйтесь, чтобы добавить товар в корзину!">Авторизоваться</a>
                </div>
                <?php endif; else: ?>
                <div class="btns_change_count_product">
                    <a href="#" onclick="return false;" class="catalog_dobavkorzina disable">Нет в наличии</a>
                </div>
                <?php endif; ?>
                <a href="/catalog/product/<?php echo $item['id'] ?>/" class="catalog_otovare">Подробнее о товаре</a>
            </div>
            <?php 
                if(!empty($productAmount)){
                    unset($productAmount);
                }
                endforeach; 
            ?>
        </div>
        <div class="catalog_block_for_btns_bottom">
            <?php 
                $resFull = intdiv($count, $selectsPage[1]);
                $resOst = $count % $selectsPage[1];
                if($resOst !== 0){
                    $resFull += 1;
                }
                $resBtn = $resFull;
                
                if($resBtn !== 1):

                for($j = 1; $j <= $resBtn; $j++) :
            ?>
                <input type="button" <?php if($j == 1) : ?>disabled<?php endif; ?> class="<?php if($j == 1) : ?>page_active<?php endif; ?>" value="<?php echo $j ?>" onclick="togglePage(<?php echo $j. ', '.$selectsPage[1]. ', '.$count. ', '.$resBtn ?>)" id="<?php echo $j ?>BtnToggle">
            <?php endfor; endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>