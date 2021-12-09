    <div class="block_modals">
        <div class="block_modals_btn_close">
            <div class="block_modals_btn_close-first"></div>
            <div class="block_modals_btn_close-second"></div>
        </div>
        <div class="block_modals_error-text"></div>
        <div class="block_modals_registration">
            <div class="block_modals_header">
                <h3>Регистрация</h3>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off" class="block_modals_form_reg" name="form_regist">
                <div class="block_modals_name-details">
                    <div class="block_modals_field_input">
                        <input type="text" name="fname" placeholder="Имя" pattern="^[A-Za-zА-Яа-яЁё\s]+$" maxlength="40">
                    </div>
                    <div class="block_modals_field_input">
                        <input type="text" name="lname" placeholder="Фамилия" pattern="^[A-Za-zА-Яа-яЁё\s]+$" maxlength="40">
                    </div>
                </div>
                <div class="block_modals_field_input">
                    <input type="email" name="email" placeholder="E-mail">
                </div>
                <div class="block_modals_field_input">
                    <input type="tel" name="tel" placeholder="89057777777" pattern="[0-9]{10,11}">
                </div>
                <div class="block_modals_field_input input_password">
                    <input type="password" class="modal_password" id="password_first" name="password" placeholder="Пароль">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="block_modals_field_input input_password">
                    <input type="password" class="modal_password" id="password_second" name="password_repeat" placeholder="Подтвердите пароль">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="block_modals_field_image">
                    <label title="png/gif/jpeg/jpg">Выберите аватар</label>
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                </div>
                <p>
                    <input type="checkbox" id="check_conditions" name="checkCon" checked><label for="check_conditions">Я принимаю условия <a href="/personaldata/" target="_blank">политики обработки персональных данных</a></label>
                </p>
                <div class="block_modals_field_button">
                    <input type="submit" name="submitReg" value="Зарегистрироваться">
                </div>
            </form>
            <div class="block_modals_link">Уже зарегистрированы? <a href="#" class="goToLogin">Войти</a></div>
        </div>
        <div class="block_modals_login">
            <div class="block_modals_header">
                <h3>Вход</h3>
            </div>
            <form action="#" method="POST" class="block_modals_form_log" name="form_login">
                <div class="block_modals_field_input">
                    <input type="email" name="email" placeholder="E-mail">
                </div>
                <div class="block_modals_field_input">
                    <input type="tel" name="tel" placeholder="89057777777" pattern="[0-9]{10,11}">
                </div>
                <div class="block_modals_field_input">
                    <input type="password" class="modal_password" id="password_third" name="password" placeholder="Пароль">
                    <i class="fas fa-eye"></i>
                </div>
                <p>
                    <p  class="btns_opt-p">
                        <a href="#" class="btns_opt">Забыли пароль?</a>
                    <p>
                    <input type="checkbox" id="check_cook" name="checkCook"><label for="check_cook" class="btns_opt">Запомнить меня</label>
                </p>
                <div class="block_modals_field_button">
                    <input type="submit" name="submitLog" value="Вход">
                </div>
            </form>
            <div class="block_modals_link">Впервые у нас? <a href="#" class="goToReg">Зарегистрироваться</a></div>
        </div>
        <div class="block_for_search">
            <form action="/search/products/" method="GET" enctype="multipart/form-data" autocomplete="off" class="form_for_search">
        		<input type="search" name="search" class="inp_for_search" pattern="^[А-Яа-яЁё\s]+$" required>
        		<button type="submit" class="btn_for_search">Искать</button>
        	</form>
    	</div>
    </div>
    <div class="message_for_user"></div>