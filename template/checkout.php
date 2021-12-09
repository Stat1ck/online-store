    <?php 
        if(!user){
            Header("Location: /");
        }else if(empty($info)){
            Header("Location: /cart/");
        }
    ?>
    <div class="block_checkout">
        <div class="block_checkout_inside">
            <h2>Страница заказа</h2>
            <div class="checkout_content">
                <div class="checkout_content_top">
                    <div>
                        <h4>Состав заказа</h4>
                        <?php foreach ($info as $item) : 
                            $cost += $item['products_amount'] * $item['product_price'];
                            $count++;
                        ?>
                            <div class="block_for_checkout_orders">
                                <div class="block_for_checkout_orders_con">
                                    <div>
                                        <h4>
                                            <span><?php echo $count ?>.</span>
                                            <?php echo $item['product_name'] ?>
                                        </h4>
                                    </div>
                                    <div class="block_for_image_checkout">
                                        <img src="/img/<?php echo $item['product_img'] ?>" alt="<?php echo $item['product_name'] ?>">
                                    </div>
                                </div>
                                <div class="block_for_checkout_orders_con">
                                    <div>
                                        <p>
                                            <p>Количество:</p>
                                            <b><?php echo $item['products_amount'] . ' ' .  $item['product_mweight'] ?></b>
                                        </p>
                                    </div>
                                    <div>
                                        <p>
                                            <p>Сумма:</p>
                                            <b><?php echo $item['products_amount'] * $item['product_price']. ' рублей' ?></b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="block_your_data">
                        <h4>Ваши данные</h4>
                        <div>
                            <div class="p_checkout"><label for="c_fname" class="l_checkout">Имя: </label><input class="i_checkout i_readonly" id="c_fname" type="text" value="<?php echo $_SESSION['userFName']; ?>" readonly></div>
                            <?php if(!empty($_SESSION['userLName'])) : ?>
                            <div class="p_checkout"><label for="c_lname" class="l_checkout">Фамилия: </label><input class="i_checkout i_readonly" id="c_lname" type="text" value="<?php echo $_SESSION['userLName']; ?>" readonly placeholder="Фамилия"></div>
                            <?php endif; ?>
                            <div class="p_checkout"><label for="c_email" class="l_checkout">E-mail: </label><input class="i_checkout i_readonly" id="c_email" type="email" value="<?php echo $_SESSION['userEmail']; ?>" readonly></div>
                            <div class="p_checkout"><label for="c_phone" class="l_checkout">Телефон: </label><input class="i_checkout <?php if($_SESSION['userPhone'] != "none") : ?>i_readonly<?php endif; ?>" id="c_phone" type="tel" value="<?php if($_SESSION['userPhone'] != "none"){ echo $_SESSION['userPhone'];} ?>" placeholder="Телефон" <?php if($_SESSION['userPhone'] != "none") : ?>readonly<?php endif; ?>></div>
                        </div>
                        <h4>Данные для доставки</h4>
                        <div>
                            <?php if(empty($_SESSION['userAddres'])) : ?>
                            <div class="p_checkout"><label for="c_country" class="l_checkout">Страна: </label><input class="i_checkout" id="c_country" type="text"></div>
                            <div class="p_checkout"><label for="c_area" class="l_checkout">Область: </label><input class="i_checkout" id="c_area" type="text"></div>
                            <div class="p_checkout"><label for="c_city" class="l_checkout">Город: </label><input class="i_checkout" id="c_city" type="text"></div>
                            <div class="p_checkout"><label for="c_index" class="l_checkout">Индекс: </label><input class="i_checkout" id="c_index" type="number"></div>
                            <div class="p_checkout"><label for="c_adres" class="l_checkout">Улица, дом, кв.: </label><input class="i_checkout" id="c_adres" type="text"></div>
                            <?php else : ?>
                            <p class="checkout_adres" id="checkout_addres"><?php echo $_SESSION['userAddres'] ?></p>
                            <?php endif; ?>
                            <div class="p_checkout"><label for="c_addInfo" class="l_checkout">Доп. информация: </label><input class="i_checkout" id="c_addInfo" type="text"></div>
                        </div>
                        <h4>Способ оплаты</h4>
                        <div>
                            <div class="p_checkout"><input type="radio" class="radio_pay" name="radioCheck" id="p_check_money" checked><label for="p_check_money" class="l_checkout">Деньги курьеру</label></div>
                            <div class="p_checkout"><input type="radio" class="radio_pay" name="radioCheck" id="p_check_online"><label for="p_check_online" class="l_checkout">Оплата онлайн</label></div>
                        </div>
                        <div class="checkout_bottom_end">
                            <div class="result_pay">
                                К оплате: <span><?php echo $cost ?></span> рублей
                            </div>
                            <div class="checkout_btns_bottom">
                                <div>
                                    <input type="button" value="Отмена" onclick="toBackCheckout()" class="btn_to_back_checkout">
                                </div>
                                <div>
                                    <input type="button" value="Заказать" onclick="toCheckout(<?php if(empty($_SESSION['userAddres'])) : ?>false<?php else : ?>true<?php endif; ?>, <?php if($_SESSION['userPhone'] != "none") : ?>true<?php else : ?>false<?php endif ; ?>)" class="btn_to_checkout">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>