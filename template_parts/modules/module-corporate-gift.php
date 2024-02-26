<div class="corporate-gift-slider" style="background-color: <?php echo get_sub_field('bg_color'); ?>" id="corporate-gift-products">
    <div class="corporate-gift-slider__title"><?php echo get_sub_field('title'); ?></div>
    <div class="corporate-gift-slider__container">
        <div class="corporate-gift-slider__content" id="js-corporate-slider">
            <?php if (have_rows('items')) : ?>
            <?php while (have_rows('items')) : the_row(); ?>
                <?php $product = wc_get_product( get_sub_field('product') ); ?>
                <div>
                    <div class="corporate-gift-slider__item">
                        <div>
                            <div class="corporate-gift-slider__item-image" style="background-image: url(<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>);"></div>
                        </div>
                        <div class="corporate-gift-slider__item-body">
                            <h2 class="corporate-gift-slider__item-title"><?php echo $product->get_name(); ?></h2>
                            <p class="corporate-gift-slider__item-price">Single: <b><?php echo get_woocommerce_currency_symbol(); ?><?php echo get_sub_field('single_price') ? get_sub_field('single_price') : $product->get_regular_price(); ?></b></p>
                            <p class="corporate-gift-slider__item-price">Bulk (+25): <b><?php echo get_woocommerce_currency_symbol(); ?><?php echo get_sub_field('bulk_price'); ?></b></p>
                            <div class="corporate-gift-slider__item-content"><?php echo get_sub_field('sort_description') ? get_sub_field('sort_description') : $product->get_short_description(); ?></div>
                            <!-- Quantity -->
                            <div class="corporate-gift-slider__product-quantity product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                <div class="pro-qty d-flex justify-content-center align-items-center">
                                    <span class="corporate-gift-slider__qty dec qtybtn">-</span>
                                    <input class="corporate-gift-slider__qty-input" type="text" name="<?php echo 'quantity_' . $product->get_id(); ?>" id="<?php echo $product->get_id(); ?>"value="25" readonly>
                                    <span class="corporate-gift-slider__qty inc qtybtn">+</span>
                                </div>
                            </div>
                            <!-- Add to cart button -->
                            <?php echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="25" class="corporate-gift-slider__product-button button product_type_simple add_to_cart_button ajax_add_to_cart %s product_type_%s">%s</a>',
                                        esc_url( $product->add_to_cart_url() ),
                                        esc_attr( $product->get_id() ),
                                        esc_attr( $product->get_sku() ),
                                        $product->is_purchasable() ? 'add_to_cart_button' : '',
                                        esc_attr( $product->get_type() ),
                                        'Select'
                                    ),
                                $product );
                            ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>