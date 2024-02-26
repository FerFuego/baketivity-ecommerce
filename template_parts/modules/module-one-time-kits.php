<div class="otk-wrapper">
    <div class="col-full">
        <div class="otk-title filson-pro-heavy"><?php echo get_sub_field('home_otk_title'); ?></div>
        <div class="otk-text"><?php echo get_sub_field('home_otk_text'); ?></div>
    </div>
    <div class="col-full slider-otk" id="slider-otk">
        <?php if (have_rows('home_otk_items')) : ?>
            <?php while (have_rows('home_otk_items')) : the_row();
                $product = wc_get_product(get_sub_field('product'));
                $bg_color = get_sub_field('otk_color');
                list($r, $g, $b) = sscanf($bg_color, "#%02x%02x%02x");
                $rgb_bg_color = $r . ', ' . $g . ', ' . $b; ?>
                <div class="slider-otk-item" style="border-color:<?php echo get_sub_field('otk_color'); ?>">
                    <?php if (get_sub_field('otk_ribbon')) : ?>
                        <img src="<?php echo get_sub_field('otk_ribbon'); ?>" class="otk-item-ribbon" alt="one-time-kits-<?php echo $product->get_name(); ?>">
                    <?php endif; ?>
                    <a href="<?php echo $product->get_permalink(); ?>">
                        <img src="<?php echo wp_get_attachment_image_url($product->get_image_id(), 'medium'); ?>" class="otk-main-image" alt="two-time-kits-<?php echo $product->get_name(); ?>">
                    </a>
                    <div class="otk-item-title filson-pro-bold" style="background-color:rgba(<?php echo $rgb_bg_color ?>, 0.2);">
                        <a class="filson-pro-bold" href="<?php echo $product->get_permalink(); ?>"><?php echo custom_trim_excerpt(null, $product->get_name(), 3, false); ?></a>
                    </div>
                    <!-- <div class="otk-item-text filson-pro-regular">
                        <?php //echo custom_trim_excerpt(null, $product->post->post_excerpt, 8, true); 
                        ?>
                    </div> -->
                    <div class="otk-button" id="slick-slide-control2<?php echo (get_row_index() - 1); ?>">
                        <?php echo do_shortcode('[add_to_cart id=' . $product->get_id() . ']'); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>