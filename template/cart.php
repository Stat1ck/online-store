    <?php
        if(!$user){
            Header("Location: /");
        }
    ?>
    <div class="block_cart">
        <div class="block_inside_cart">
            <?php if($_SESSION['product_Numb'] !== 0) : ?>
                <a href="/catalog/" class="link_product_to_back" style="text-decoration: none">&#8592; Каталог</a>
                <h2 class="block_header_cart">Корзина</h2>
                <div class="main_block_content_cart">
                    <div class="headers_cart">
                        <div class="cart_center cart__center__top">
                            Выбрать
                            <input type="checkbox" name="checkProductsCartAll" id="checkProductsCartAll">
                        </div>
                        <div class="cart_center cart__center__top">
                            Изображение
                        </div>
                        <div class="cart__center__top">
                            Наименование
                        </div>
                        <div class="cart_center cart__center__top">
                            Наличие
                        </div>
                        <div class="cart_center cart__center__top">
                            Стоимость
                        </div>
                        <div class="cart_center cart__center__top">
                            Количество
                        </div>
                        <div class="cart_center cart__center__top">
                            Удалить
                        </div>
                    </div>
                    <div class="blockUpdateCartInfo">
                        <?php foreach ($info as $item) : 
                            if($item['product_status'] >= $item['product_amount']){ 
                                $costProducts += $item['product_price'] * $item['product_amount']; 
                            }else{ 
                                $costProducts += $item['product_price'] * $item['product_status']; 
                            }
                        ?>
                        <div class="block_products_cart" id="<?php echo $item['product_id'] ?>cart">
                            <div class="cart_center">
                                <input type="checkbox" class="everyProductCheck" name="checkProductsCart" id="<?php echo $item['product_id'] ?>check">
                            </div>
                            <div class="cart_center">
                                <a href="/catalog/product/<?php echo $item['product_id']; ?>/" class="cart_link_product">
                                    <img src="/img/<?php echo $item['product_img'] ?>" alt="<?php echo $item['product_name'] ?>" class="cart_product_img">
                                </a>
                            </div>
                            <div>
                                <a href="/catalog/product/<?php echo $item['product_id']; ?>/" class="cart_link_product">
                                    <?php echo $item['product_name'] ?>
                                </a>
                            </div>
                            <div id="<?php echo $item['product_id'] ?>status">
                                <?php 
                                    if(($item['product_status'] != 0) or ($item['product_status'] - $item['product_amount'] >= 1)) :
                                        if($item['product_status'] > $item['product_amount']) : 
                                ?>
                                    <font style="color:green">Есть в наличии еще <?php echo $item['product_status'] - $item['product_amount'] ?> <?php echo $item['product_mweight'] ?></font>
                                <?php else : ?>
                                    <font style="color:red">Больше <?php echo $item['product_status'] ?> <?php echo $item['product_mweight'] ?> нет в наличии!</font>
                                <?php endif; elseif(($item['product_status'] == 0) or ($item['product_status'] < $item['product_amount'])) : ?>
                                    <font style="color:red">Нет в наличии!</font>
                                <?php endif; ?>
                            </div>
                            <div class="cart_center" id="<?php echo $item['product_id'] ?>price">
                                <?php if($item['product_status'] >= $item['product_amount']){ echo $item['product_price'] * $item['product_amount']; }else{ echo $item['product_price'] * $item['product_status']; } ?> руб.
                            </div>
                            <input id="<?php echo $item['product_id'] ?>priceProduct" type="hidden" value="<?php echo $item['product_price'] ?>">
                            <input id="<?php echo $item['product_id'] ?>priceProductSum" type="hidden" value="<?php if($item['product_status'] >= $item['product_amount']){ echo $item['product_price'] * $item['product_amount']; }else{ echo $item['product_price'] * $item['product_status']; } ?>">
                            <div class="cart_center">
                                <input type="button" onclick="removeOneProduct(<?php echo $item['product_id'] ?>, false, <?php echo $item['product_status'] ?>)" value="-" class="btns_cart">
                                <input type="number" id="<?php echo $item['product_id'] ?>" min="0" max="<?php echo $item['product_status'] ?>" value="<?php if($item['product_status'] >= $item['product_amount']){ echo $item['product_amount']; }else{ echo $item['product_status']; } ?>" class="btns_cart product_count <?php if($item['product_amount'] >= $item['product_status']){ echo "dis"; } ?>" readonly>
                                <input type="button" onclick="addOneProduct(<?php echo $item['product_id'] ?>, <?php echo $item['product_status'] ?>, false)" value="+" class="btns_cart">
                            </div>
                            <div class="cart_center">
                                <input type="button" onclick="deleteProductFromCart(<?php echo $item['product_id'] ?>)" class="btn_remove_cart" title="Удалить" value="X">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="cart__bottom">
                    <div>
                        <input type="button" onclick="clearCart()" value="Удалить выбранное" id="btn_clear_cart_id" class="btn_clear_cart" disabled>
                    </div>
                    <div>
                        <span>
                            Итого: <span id="resultCartSum"><?php echo $costProducts ?></span> рублей
                            <input id="costCartSum" type="hidden" value="<?php echo $costProducts ?>">
                        </span>
                        <input type="button" onclick="buyCart()" value="Купить выбранное" id="btn_buy_cart_id" class="btn_buy_cart" disabled>
                    </div>
                </div>
            <?php else : ?>
                <div class="block_cart_empty">
                    <div><h2>Ваша корзина пока что пуста!</h2></div>
                    <div><a href="/catalog/" class="cart_empty_links">Перейти к покупкам</a><a href="/" class="cart_empty_links">На главную</a></div>
                </div>
            <?php endif; ?>
        </div>
    </div>