    <?php 
        if(!$user){
            Header("Location: /");
        }  
        include('config/dbconnect.php');
    ?>
    <div class="block_orders">
        <div class="block_orders_inside">
            <h2>Ваши заказы</h2>
            <div>
                <h4>Не завершенные</h4>
                <div>
                <?php 
                    if(!empty($info)):
                        for($i = 0; $i < count($info); $i++) :
                ?>
                    <div id="<?php echo $info[$i] ?>" class="block_for_order">
                        <?php 
                            $order_id = $info[$i];
                            $sql = $connect->prepare("SELECT * FROM orders WHERE unique_id_order = ? AND user_id = ?");
                            $sql->execute([$order_id, $_SESSION['userUniqueId']]);
                            $infoOrder = $sql->fetchAll();
                            
                            foreach($infoOrder as $item){
                                $order_sum = $item['order_sum'];
                                $order_date = $item['date'];
                                $phone = $item['phone'];
                                $addres = $item['addres'];
                                $addresInfo = $item['addrInfo'];
                                $method_pay = $item['pay'];
                            }
                        ?>
                        <div class="block_for_order_inside">
                            <div class="order_top">
                                <div>
                                    Статус: <span class="order_spans">Не завершен</span>
                                </div>
                                <div>
                                    <input type="button" id="<?php echo $order_id ?>" onclick="deleteOrderFromOrders()" class="btn_del_order" value="Отменить">
                                </div>
                            </div>
                            <div class="order_number">
                                <div>Номер заказа: <span class="order_spans"><?php echo $order_id ?></span></div>
                            </div>
                            <div class="order_top_info">
                                <div>Дата: <span class="order_spans"><?php echo $order_date ?></span></div>
                                <div>Сумма: <span class="order_spans"><?php echo $order_sum ?> рублей</span></div>
                                <div>
                                    Способ оплаты: <span class="order_spans"><?php echo $method_pay ?></span>
                                </div>
                            </div>
                            <div class="order_user_info">
                                <h4>
                                    Ваша информация
                                </h4>
                                <div class="order_user_info_inside">
                                    <?php if(!empty($phone)) : ?>
                                    <div>
                                        Телефон: <span class="order_spans"><?php echo $phone ?></span>
                                    </div>
                                    <?php endif; ?>
                                    <div>
                                        <p>Адрес: <span class="order_spans"><?php echo $addres ?></span></p>
                                        <?php if(!empty($addresInfo)) : ?>
                                        <p>Доп. инфо: <span class="order_spans"><?php echo $addresInfo ?></span></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                foreach($infoOrder as $item) :
                                    $sqlProduct = $connect->prepare("SELECT * FROM products WHERE id = ?");
                                    $sqlProduct->execute([$item['products_id']]);
                                    $infoProduct = $sqlProduct->fetchAll();
                                    
                                    $product_amount = $item['products_amount'];
                            ?>
                            <div class="order_products_info">
                                <h4>Состав заказа</h4>
                                <?php
                                    foreach($infoProduct as $product):
                                ?>
                                <div class="order_product_info">
                                    <div class="block_order_product_img">
                                        <img src="/img/<?php echo $product['product_img'] ?>" alt="<?php echo $product['product_img'] ?>" class="order_product_img">
                                    </div>
                                    <div class="order_product_information">
                                        <p>
                                            <?php echo $product['product_name'] ?>
                                        </p>
                                        <p>
                                            Количество: <?php echo $product_amount. ' ' .$product['product_mweight'] ?>
                                        </p>
                                        <p>
                                            Стоимость: <?php echo $product['product_price'] * $product_amount ?> рублей
                                        </p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endfor; else: ?>
                    <p>У вас пока нет не завершенных заказов!</p>
                <?php endif; ?>
                </div>
            </div>
            <div>
                <h4>Завершенные</h4>
                <div>
                    <?php 
                        $sql = $connect->prepare("SELECT * FROM orders INNER JOIN products ON orders.products_id = products.id WHERE user_id = ? AND condition_order = 'complited' ORDER BY date DESC");
                        $sql -> execute([$_SESSION['userUniqueId']]);
        
                        $res = $sql->fetchAll();
        
                        $info = Array();
        
                        foreach ($res as $item){
                            if($item['unique_id_order'] != $info[count($info) - 1]){
                                array_push($info, $item['unique_id_order']);
                            }
                        }
                        
                        if(!empty($info)):
                            for($i = 0; $i < count($info); $i++) :
                    ?>
                    <div id="<?php echo $info[$i] ?>" class="block_for_order">
                        <?php 
                            $order_id = $info[$i];
                            $sql = $connect->prepare("SELECT * FROM orders WHERE unique_id_order = ? AND user_id = ?");
                            $sql->execute([$order_id, $_SESSION['userUniqueId']]);
                            $infoOrder = $sql->fetchAll();
                            
                            foreach($infoOrder as $item){
                                $order_sum = $item['order_sum'];
                                $order_date = $item['date'];
                                $phone = $item['phone'];
                                $addres = $item['addres'];
                                $addresInfo = $item['addrInfo'];
                                $method_pay = $item['pay'];
                            }
                        ?>
                        <div class="block_for_order_inside">
                            <div class="order_top">
                                <div>
                                    Статус: <span class="order_spans">Завершен</span>
                                </div>
                                <div>
                                    <!--<input type="button" onclick="deleteOrderFromOrders()" style="display: none" class="btn_del_order" value="Повторить">-->
                                </div>
                            </div>
                            <div class="order_number">
                                <div>Номер заказа: <span class="order_spans"><?php echo $order_id ?></span></div>
                            </div>
                            <div class="order_top_info">
                                <div>Дата: <span class="order_spans"><?php echo $order_date ?></span></div>
                                <div>Сумма: <span class="order_spans"><?php echo $order_sum ?> рублей</span></div>
                                <div>
                                    Способ оплаты: <span class="order_spans"><?php echo $method_pay ?></span>
                                </div>
                            </div>
                            <div class="order_user_info">
                                <h4>
                                    Ваша информация
                                </h4>
                                <div class="order_user_info_inside">
                                    <?php if(!empty($phone)) : ?>
                                    <div>
                                        Телефон: <span class="order_spans"><?php echo $phone ?></span>
                                    </div>
                                    <?php endif; ?>
                                    <div>
                                        <p>Адрес: <span class="order_spans"><?php echo $addres ?></span></p>
                                        <?php if(!empty($addresInfo)) : ?>
                                        <p>Доп. инфо: <span class="order_spans"><?php echo $addresInfo ?></span></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                foreach($infoOrder as $item) :
                                    $sqlProduct = $connect->prepare("SELECT * FROM products WHERE id = ?");
                                    $sqlProduct->execute([$item['products_id']]);
                                    $infoProduct = $sqlProduct->fetchAll();
                                    
                                    $product_amount = $item['products_amount'];
                            ?>
                            <div class="order_products_info">
                                <h4>Состав заказа</h4>
                                <?php
                                    foreach($infoProduct as $product):
                                ?>
                                <div class="order_product_info">
                                    <div class="block_order_product_img">
                                        <img src="/img/<?php echo $product['product_img'] ?>" alt="<?php echo $product['product_img'] ?>" class="order_product_img">
                                    </div>
                                    <div class="order_product_information">
                                        <p>
                                            <?php echo $product['product_name'] ?>
                                        </p>
                                        <p>
                                            Количество: <?php echo $product_amount. ' ' .$product['product_mweight'] ?>
                                        </p>
                                        <p>
                                            Стоимость: <?php echo $product['product_price'] * $product_amount ?> рублей
                                        </p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endfor; else: ?>
                    <p>У вас пока нет завершенных заказов!</p>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>