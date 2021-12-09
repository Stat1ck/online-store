        <a name="contacts"></a>
        <div class="block_for_footer">
            <div class="footer">
                <div class="info_footer">
                    <div class="blocks_info_footer">
                        <a href="/"><img src="/img/logo.png" class="logo_footer" /></a>
                        <div class="head_footer">
                            <a href="/privacypolicy/">Политика конфиденциальности</a>
                        </div>
                    </div>
                    <div class="blocks_info_footer">
                        <h4>Меню</h4>
                        <div class="head_footer">
                            <a href="/catalog/">Каталог</a>
                            <a href="/">Главная</a>
                            <a href="/#blog">Блог</a>
                            <a href="#contacts">Контакты</a>
                        </div>
                    </div>
                    <div class="blocks_info_footer">
                        <h4>Информация</h4>
                        <div class="head_footer">
                            <a href="/help/">Помощь</a>
                            <a href="/#aboutus">О проекте</a>
                            <a href="/conditionsterms/">Условия и соглашения</a>
                            <a href="/catalog/">Фрукты и овощи оптом</a>
                        </div>
                    </div>
                    <div class="blocks_info_footer">
                        <h4>Контакты</h4>
                        <div class="head_footer">
                            <div>
                                <img src="">
                                <span>г. Краснодар, ул. Парковая, 2\1 . х.Ленина</span>
                            </div>
                            <div>
                                <img src="">
                                <span><a href="tel:+79182538295">+7 (918)-253-82-95</a></span>
                            </div>
                            <div>
                                <img src="">
                                <span>fruits-store@mail.ru</span>
                            </div>
                            <div>
                                <img src="">
                                <img src="">
                                <img src="">
                                <img src="">
                                <img src="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom_footer">
                    <p>
                        Интернет-магазин Fruit Dream <br>
                        © 2015-2021. Все права защищены <br>
                        <a href="https://vk.com/id450606359" class="prog" target="_blank" title="Дегтярев Кирилл">Backend/Frontend</a><a href="https://vk.com/blossom_31" target="_blank" class="prog" title="Толкачев Иван">Design/Frontend</a>
                    </p>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="/scripts/cart-scripts.js"></script>
        <script src="/scripts/modals_functions.js"></script>
        <script src="/scripts/send_form.js"></script>
        <script src="/scripts/menu-scripts.js"></script>
        <?php if(($controllerName == "Index") and ($actionName == "index")) : ?>
            <script src="/scripts/header-scripts.js"></script>
            <script src="/scripts/blog-scripts.js"></script>
            <script src="https://cdn.jsdelivr.net/jquery.typeit/4.4.0/typeit.min.js"></script>
        <?php elseif($controllerName == "Cart") : ?>
            <script src="/scripts/footer-scripts.js"></script>
        <?php elseif($controllerName == "Personalarea") : ?>
            <script src="/scripts/personalarea-scripts.js"></script>
        <?php elseif($controllerName == "Search") : ?>
            <script src="/scripts/search-scripts.js"></script>
        <?php elseif($controllerName == "Catalog") : ?>
            <script src="/scripts/catalog-scripts.js"></script>
        <?php endif; ?>
        
    </body>
</html>