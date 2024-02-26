<div class="sweeten-your-gifts" style="background-color: <?php echo get_sub_field('bg_color'); ?>">
    <?php if (get_sub_field('title')) : ?>
        <div class="sweeten-your-gifts__header">
            <h2 class="sweeten-your-gifts__header-title"><?php echo get_sub_field('title'); ?></h2>
        </div>
    <?php endif; ?>
    <div class="sweeten-your-gifts__container">
        <div class="sweeten-your-gifts__body">
            <?php if (have_rows('items')) : $index_gift = 0;?>
            <?php while (have_rows('items')) : the_row(); 
                $index_gift += 1; 
                $product = wc_get_product( get_sub_field('product') ); //print_r($product);?>
                <div class="sweeten-your-gifts__item">
                    <img class="sweeten-your-gifts__item-image" src="<?php echo get_sub_field('image'); ?>" alt="gifting icon <?php echo get_row_index(); ?>">
                    <div class="sweeten-your-gifts__item-title"><?php echo get_sub_field('title'); ?></div>
                    <div class="sweeten-your-gifts__item-copy <?php echo (get_sub_field('form')) ? 'sweeten-your-gifts__fix-margin' : ''; ?>"><?php echo get_sub_field('copy'); ?></div>
                    <?php if (get_sub_field('cta') && !get_sub_field('product')) : ?>
                        <a class="sweeten-your-gifts__item-link" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                    <?php endif; ?>
                    <?php //echo do_shortcode( '[add_to_cart id=' . get_sub_field('product') . ' style="border:0" show_price="true"]' ) ?>
                    <!-- Quantity -->
                    <?php if (get_sub_field('product') && get_sub_field('form')) : ?>
                        <div class="cocho"></div>
                        <span class="gift-card-amount__select-an-amount" data-id="<?= $index_gift ?>">Please select an amount</span>
                        <div class="sweeten-your-gifts__variations">
                            <?php if (get_sub_field('gift_card_amount')) : ?>
                            <select id="gift-card-amount" class="wc-default-select gift-card-amount" name="attribute_gift-card-amount" data-attribute_name="attribute_gift-card-amount" data-show_option_none="yes" data-id="<?= $index_gift ?>">
                                <option value="">Choose an amount</option>
                                <option value="367574" class="attached enabled">$5.00</option>
                                <option value="367644" class="attached enabled">$10.00</option>
                                <option value="167307" class="attached enabled">$25.00</option>
                                <option value="167308" class="attached enabled">$50.00</option>
                                <option value="167309" class="attached enabled">$75.00</option>
                                <option value="167310" class="attached enabled">$100.00</option>
                                <option value="348257" class="attached enabled">$175.00</option>
                                <option value="367646" class="attached enabled">$250.00</option>
                                <option value="367647" class="attached enabled">$325.00</option>
                                <option value="367648" class="attached enabled">$500.00</option>
                            </select>
                            <?php endif; ?>
                            <div class="sweeten-your-gifts__product-quantity">
                                <div class="d-flex justify-content-center align-items-center gift-card-quantity" id="gift-card-quantity">
                                    <span class="sweeten-your-gifts__qty dec qtybtn" data-id="<?= $index_gift ?>">-</span>
                                    <input class="sweeten-your-gifts__qty-input" type="text" name="<?php echo 'quantity_' . $product->get_id(); ?>" id="<?php echo $product->get_id(); ?>"value="25" readonly data-card-id="<?= $index_gift ?>">
                                    <span class="sweeten-your-gifts__qty inc qtybtn" data-id="<?= $index_gift ?>">+</span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Add to cart button -->
                    <?php if (get_sub_field('product')) :
                        echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                            sprintf( '<a href="%s" id="%s" rel="nofollow" data-product_id="%s" data-quantity="%s" data-card-id="%s" data-gif-card-amount="%s" class="corporate-gift-slider__product-button button product_type_simple add_to_cart_button ajax_add_to_cart %s product_type_%s">%s</a>',
                                esc_url( $product->add_to_cart_url(),  ),
                                get_sub_field('form') ? 'custom_add_to_cart_gift_card' : '',
                                esc_attr( $product->get_id() ),
                                get_sub_field('form') ? '25' : '1',
                                $index_gift,
                                (get_sub_field('gift_card_amount') ? 'true' : 'false'), 
                                $product->is_purchasable() ? 'add_to_cart_button' : '',
                                esc_attr( $product->get_type() ),
                                'Add to cart'
                            ),
                        $product );
                    endif;
                    ?>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>