<style scoped>
    .get-a-taste-behavior {
        background-image: url(<?php echo get_sub_field('image')['url']; ?>); 
    }
    @media (max-width: 768px) {
        .get-a-taste-behavior {
            background-image: none;
        }
        .get-a-taste-behavior-mobile {   
            background-image: url(<?php echo get_sub_field('image_mobile')['url']; ?>);
        }
    }
</style>
<div class="get-a-taste get-a-taste-behavior-mobile">
    <div class="get-a-taste__container get-a-taste-behavior">
        <div class="get-a-taste__body">
            <div class="get-a-taste__left">
                <div class="get-a-taste__title">
                    <?php echo get_sub_field('title'); ?>
                </div>
                <div class="get-a-taste__description">
                    <?php echo get_sub_field('description'); ?>
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
            <div class="get-a-taste__right"></div>
        </div>
    </div>
</div>