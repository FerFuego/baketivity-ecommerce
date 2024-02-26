<div class="let-the-celebration-begin" id="let-the-celebration-begin">
    <!-- Products -->
    <div class="let-the-celebration-begin__container">
        <h2 class="let-the-celebration-begin__title"><?php _e(get_sub_field('title'),'baketivity');?></h2>
        <p class="let-the-celebration-begin__subtitle"><?php _e(get_sub_field('subtitle'),'baketivity');?></p>
        <?php if (have_rows('items')) : ?>
            <div class="let-the-celebration-begin__items">
                <?php while (have_rows('items')) : the_row(); 
                    $product = wc_get_product(get_sub_field('product'))?>
                    <div class="let-the-celebration-begin__item">
                        <div class="let-the-celebration-begin__item-product">
                            <img class="let-the-celebration-begin__item-image" src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="">
                            <div class="let-the-celebration-begin__item-content">
                                <div class="let-the-celebration-begin__item-title"><?php echo $product->get_name(); ?></div>
                                <p class="let-the-celebration-begin__item-text"><?php echo custom_trim_excerpt(null, $product->post->post_excerpt, 8, true); ?></p>
                            </div>
                        </div>
                        <div class="let-the-celebration-begin__item-cart">
                            <span class="let-the-celebration-begin__item-label"><?php _e('Choose Quantity', 'baketovoty'); ?></span>
                            <!-- Quantity -->
                            <div class="corporate-gift-slider__product-quantity product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                <div class="pro-qty d-flex justify-content-center align-items-center">
                                    <span class="corporate-gift-slider__qty dec qtybtn">-</span>
                                    <input class="corporate-gift-slider__qty-input" type="text" name="<?php echo 'quantity_' . $product->get_id(); ?>" id="<?php echo $product->get_id(); ?>"value="12" readonly>
                                    <span class="corporate-gift-slider__qty inc qtybtn">+</span>
                                </div>
                            </div>
                            <!-- Add to cart button -->
                            <?php echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="12" class="corporate-gift-slider__product-button button product_type_simple add_to_cart_button ajax_add_to_cart %s product_type_%s">%s</a>',
                                        esc_url( $product->add_to_cart_url() ),
                                        esc_attr( $product->get_id() ),
                                        esc_attr( $product->get_sku() ),
                                        $product->is_purchasable() ? 'add_to_cart_button' : '',
                                        esc_attr( $product->get_type() ),
                                        'Add to cart'
                                    ),
                                $product );
                            ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
    <!-- End Products -->

    <!-- Extra Sweetness -->
    <?php if (get_sub_field('extra_title')) : ?>
        <div class="let-the-celebration-begin__extra">
            <h3 class="let-the-celebration-begin__extra-title"><?php _e(get_sub_field('extra_title','baketivity')); ?></h3>
            <?php if (have_rows('extra_items')) : ?>
                <div class="let-the-celebration-begin__extra-items">
                    <?php while(have_rows('extra_items')) : the_row(); $product = wc_get_product(get_sub_field('product'))?>
                        <div class="let-the-celebration-begin__extra-item">
                            <div class="let-the-celebration-begin__extra-item-product">
                                <img class="let-the-celebration-begin__item-image" src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="">
                                <div class="let-the-celebration-begin__item-content">
                                    <div class="let-the-celebration-begin__extra-item-title"><?php echo $product->get_name(); ?></div>
                                </div>
                            </div>
                            <div class="let-the-celebration-begin__extra-item-cart">
                                <div class="let-the-celebration-begin__extra-item-content">
                                    <span class="let-the-celebration-begin__item-label"><?php _e('Choose Quantity', 'baketovoty'); ?></span>
                                    <!-- Quantity -->
                                    <div class="corporate-gift-slider__product-quantity product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                        <div class="pro-qty d-flex justify-content-center align-items-center">
                                            <span class="corporate-gift-slider__qty dec qtybtn">-</span>
                                            <input class="corporate-gift-slider__qty-input" type="text" name="<?php echo 'quantity_' . $product->get_id(); ?>" id="<?php echo $product->get_id(); ?>"value="12" readonly>
                                            <span class="corporate-gift-slider__qty inc qtybtn">+</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add to cart button -->
                                <?php echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                        sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="12" class="corporate-gift-slider__product-button button product_type_simple add_to_cart_button ajax_add_to_cart %s product_type_%s">%s</a>',
                                            esc_url( $product->add_to_cart_url() ),
                                            esc_attr( $product->get_id() ),
                                            esc_attr( $product->get_sku() ),
                                            $product->is_purchasable() ? 'add_to_cart_button' : '',
                                            esc_attr( $product->get_type() ),
                                            'Add to cart'
                                        ),
                                    $product );
                                ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <!-- End Extra Sweetness -->

    <!-- Custom Evites -->
    <?php if (get_sub_field('evites_title')) : ?>
        <div class="let-the-celebration-begin__evites" id="evites" style="background-color: <?php echo get_sub_field('evites_bg_color'); ?>">
            <div class="let-the-celebration-begin__evites-content-left">
                <h3 class="let-the-celebration-begin__evites-title"><?php _e(get_sub_field('evites_title','baketivity')); ?></h3>
                <p class="let-the-celebration-begin__evites-text"><?php _e(get_sub_field('evites_subtitle','baketivity')); ?></p>
                <?php if (get_sub_field('evites_active')) : ?>
                    <a class="let-the-celebration-begin__evites-cta" href="<?php echo get_sub_field('evites_cta')['url']; ?>" target="<?php echo get_sub_field('evites_cta')['target']; ?>"><?php echo get_sub_field('evites_cta')['title']; ?></a>
                <?php else: ?>
                    <div class="let-the-celebration-begin__evites-cta disable"> <?php echo get_sub_field('evites_cta')['title']; ?></div>
                <?php endif; ?>
            </div>
            <div class="let-the-celebration-begin__evites-content-right">
                <div class="let-the-celebration-begin__evites-image" style="background-image: url(<?php echo get_sub_field('evites_image')['sizes']['large']; ?>);"></div>
            </div>
        </div>
    <?php endif; ?>
    <!-- End Custom Evites -->
</div>