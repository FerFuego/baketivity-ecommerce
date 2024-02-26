<style scoped>
.on-bg-behavior {
    background-image: url(<?php echo get_sub_field('background_desktop')['url']; ?>); 
}
@media (max-width: 768px) {
    .on-bg-behavior {   
        background-image: url(<?php echo get_sub_field('background_mobile')['url']; ?>);
    }
}
</style>
<div class="hero-starter-kit on-bg-behavior">
    <div class="hero-starter-kit__container">
        <div class="hero-starter-kit__content">
            <div class="hero-starter-kit__title"><?php echo get_sub_field('title'); ?></div>
            <div class="hero-starter-kit__subtitle"><?php echo get_sub_field('subtitle'); ?></div>
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
                ?>
            <?php endif; ?>
            <div class="hero-starter-kit__shipping" style="background-image: url(<?php echo get_sub_field('shipping'); ?>);"></div>
        </div>
    </div>
</div>