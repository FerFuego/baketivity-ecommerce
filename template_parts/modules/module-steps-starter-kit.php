<div class="steps-starter-kit">
    <div class="steps-starter-kit__container">
        <div class="steps-starter-kit__header">
            <?php echo get_sub_field('title'); ?>
        </div>
        <div class="steps-starter-kit__body">
            <?php if (have_rows('steps')) : ?>
                <?php while (have_rows('steps')) : the_row(); ?>
                    <div class="steps-starter-kit__item">
                        <img class="steps-starter-kit__img" src="<?php echo get_sub_field('icon')['url']; ?>" alt="icon-steps-<?php echo get_row_index(); ?>">
                        <div class="steps-starter-kit__num"><?php echo get_row_index(); ?></div>
                        <h4 class="steps-starter-kit__title"><?php echo get_sub_field('title'); ?></h4>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <div class="steps-starter-kit__footer">
            <?php if (get_field('product_starter_kit', 'option')) : 
                /* Add to cart button */
                $product = wc_get_product( get_field('product_starter_kit', 'option') );
                echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="25" class="corporate-gift-slider__product-button button product_type_simple add_to_cart_button ajax_add_to_cart %s product_type_%s">%s</a>',
                        esc_url( $product->add_to_cart_url() ),
                        esc_attr( $product->get_id() ),
                        esc_attr( $product->get_sku() ),
                        $product->is_purchasable() ? 'add_to_cart_button' : '',
                        esc_attr( $product->get_type() ),
                        get_sub_field('cta')
                    ),
                $product );    
            endif; ?>
        </div>
    </div>
</div>