    <?php
        if(!$user){
            Header("Location: /");
        }
    ?>
    <div class="block__personalarea">
        <h2>Личный кабинет</h2>
        <div class="block__personalarea_inside">
            <div class="block_personalarea_avatar">
                <div>
                    <div class="block_wrapper_avatar">
                        <img src="/img/avatars/<?php echo $_SESSION['userAvatar'] ?>" class="personalarea_avatar_img">
                        <div class="block_personalarea_btn_select_avatar" onclick="showSelectImg()">Выбрать аватар</div>
                        <input type="file" class="personalarea_select_avatar" name="personalareaAvatar" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                    </div>
                </div>
                <div>
                    <a href="/orders/" class="link_user_orders">Ваши заказы</a>
                </div>
                <div>
                    <h3>Ваш адрес</h3>
                    <div id="p_block_user_addres">
                        <p id="p_block_for_addres"><?php if(!empty($_SESSION['userAddres'])) : echo $_SESSION['userAddres']; else : ?>У вас пока нет адреса для доставки! Добавьте его в личном кабинете, чтобы не вводить каждый раз при заказе!<?php endif; ?></p>
                        <?php if(!empty($_SESSION['userAddres'])) : ?>
                        <input type="button" onclick="removeAddr()" class="link_user_orders" value="Удалить адрес">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="block_personalarea_main_data">
                <div class="change_main_data">
                    <h3>Изменить основные данные</h3>
                    <div class="personalarea_main_data">
                        <div class="p_data"><label for="p_fname">Имя: </label><input class="personalarea_main_data_inputs readonly_input" id="p_fname" type="text" value="<?php echo $_SESSION['userFName']; ?>" readonly placeholder="Имя"></div>
                        <div class="p_data"><label for="p_lname">Фамилия: </label><input class="personalarea_main_data_inputs readonly_input" id="p_lname" type="text" value="<?php echo $_SESSION['userLName']; ?>" readonly placeholder="Фамилия"></div>
                        <div class="p_data"><label for="p_email">E-mail: </label><input class="personalarea_main_data_inputs readonly_input" id="p_email" type="email" value="<?php echo $_SESSION['userEmail']; ?>" readonly placeholder="E-mail"></div>
                        <div class="p_data"><label for="p_phone">Телефон: </label><input class="personalarea_main_data_inputs readonly_input" id="p_phone" type="tel" value="<?php if($_SESSION['userPhone'] != "none"){ echo $_SESSION['userPhone'];} ?>" readonly placeholder="Телефон"></div>
                        <div class="p_data p_data_for_btn"><input type="button" onclick="changeMainData()" id="saveDataBtn" value="Сохранить изменения"></div>
                    </div>
                </div>
                <div>
                    <h3>Изменить пароль</h3>
                    <div class="personalarea_main_data">
                        <div class="p_data"><label for="p_old_pass">Старый пароль: </label><div class="block_p_eye"><input id="p_old_pass" type="password" class="personalarea_main_data_inputs_pass" placeholder="Old password"><i class="fas fa-eye"></i></div></div>
                        <div class="p_data"><label for="p_new_pass">Новый пароль: </label><div class="block_p_eye"><input id="p_new_pass" type="password" class="personalarea_main_data_inputs_pass" placeholder="New password"><i class="fas fa-eye"></i></div></div>
                        <div class="p_data p_data_for_btn"><input type="button" onclick="changePassword()" value="Сохранить изменения"></div>
                    </div>
                </div>
                <div id="p_block_add_addres">
                    <h3 id="h3_p_addres"><?php if(empty($_SESSION['userAddres'])) : ?>Добавить<?php else : ?>Редактировать<?php endif; ?> адрес</h3>
                    <div class="personalarea_main_data">
                        <div class="p_data"><label for="p_country">Страна: </label><input id="p_country" type="text" class="personalarea_main_data_inputs_addr" placeholder="Россия"></div>
                        <div class="p_data"><label for="p_area">Область / Край: </label><input id="p_area" type="text" class="personalarea_main_data_inputs_addr" placeholder="Московская"></div>
                        <div class="p_data"><label for="p_city">Город: </label><input id="p_city" type="text" class="personalarea_main_data_inputs_addr" placeholder="Москва"></div>
                        <div class="p_data"><label for="p_index">Индекс: </label><input id="p_index" type="number" class="personalarea_main_data_inputs_addr" placeholder="101000"></div>
                        <div class="p_data"><label for="p_adres">Улица, дом, кв.: </label><input id="p_adres" type="text" class="personalarea_main_data_inputs_addr" placeholder="Красная, 1, 1"></div>
                        <div class="p_data p_data_for_btn"><input type="button" id="inp_p_addres" onclick="addAddres()" value="<?php if(empty($_SESSION['userAddres'])) : ?>Добавить<?php else : ?>Редактировать<?php endif; ?>"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>