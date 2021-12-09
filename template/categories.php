    <div class="block_categories">
        <?php
            foreach ($info as $item) :
        ?>
            <a href="/catalog/category/<?php echo $item['category_path'] ?>/" class="block_category">
                <div class="category">
                    <div class="category_img">
                        <img src="/img/<?php echo $item['category_img'] ?>" alt="<?php echo $item['category_img'] ?>" class="category_image" />
                    </div>
                    <div class="category_btn">
                        <?php echo $item['category_name'] ?>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>