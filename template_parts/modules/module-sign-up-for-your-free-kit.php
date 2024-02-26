<div class="sign-up-for-your-free-kit">
    <div class="sign-up-for-your-free-kit__container">
        <div class="sign-up-for-your-free-kit__left">
            <div class="sign-up-for-your-free-kit__img" style="background-image: url(<?php echo (wp_is_mobile()) ? get_sub_field('image_mobile')['url'] : get_sub_field('image_desktop')['url']; ?>)"></div>
            <p class="sign-up-for-your-free-kit__subtitle-mobile"><?php echo get_sub_field('subtitle'); ?></p>
        </div>
        <div class="sign-up-for-your-free-kit__right">
            <div class="sign-up-for-your-free-kit__title"><?php echo get_sub_field('title'); ?></div>
            <p class="sign-up-for-your-free-kit__subtitle"><?php echo get_sub_field('subtitle'); ?></p>
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
                        get_sub_field('link')? get_sub_field('link')['title'] : 'Get Your FREE kit'
                    ),
                $product );
            endif; ?>
        </div>
    </div>
</div>