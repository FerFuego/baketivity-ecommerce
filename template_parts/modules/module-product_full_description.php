<?php
    if (get_sub_field('display_layout')) :
        $style_container = 'flex-direction: column;';
        $style_container_1 = 'margin-bottom: 30px; width: 100%;';
        $style_container_2 = 'margin-bottom: 30px; width: 100%;';
    else:
        $style_container = 'flex-direction: row; justify-content: space-between;';
        $style_container_1 = 'width: 47%;';
        $style_container_2 = 'width: 47%;';

        if (wp_is_mobile()) {
            $style_container = 'flex-direction: column;';
            $style_container_1 = 'margin-bottom: 30px; width: 100%;';
            $style_container_2 = 'margin-bottom: 30px; width: 100%;';
        }
    endif;
?>
</div> <!-- Fix div -->
<div class="product-full-description">
    <div class="container">
        <div class="product-full-description__header">
            <h2 class="product-full-description__title"><?php echo get_sub_field('title'); ?></h2>
        </div>
        <div class="product-full-description__content" style="<?php echo $style_container; ?>">
            <div class="product-full-description__content-1" style="<?php echo $style_container_1; ?>">
                <?php echo get_sub_field('content_1'); ?>
            </div>
            <div class="product-full-description__content-2" style="<?php echo $style_container_2; ?>">
                <?php echo get_sub_field('content_2'); ?>
            </div>
        </div>
    </div>
</div>