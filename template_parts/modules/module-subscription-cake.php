<style scoped>
.cake-mdbg-behavior {
    background-image: url(<?php echo get_sub_field('image_desktop')['url']; ?>); 
}
@media (max-width: 768px) {
    .cake-mdbg-behavior {   
        background-image: url(<?php echo get_sub_field('image_mobile')['url']; ?>);
    }
}
</style>
<div class="subscription-cake" id="subscription-cake">
    <div class="subscription-cake__container">
        <div class="subscription-cake__left cake-mdbg-behavior"></div>
        <div class="subscription-cake__right">
            <div class="subscription-cake__header">
                <h3 class="subscription-cake__title"><?php echo get_sub_field('title'); ?></h3>
                <h4 class="subscription-cake__subtitle"><?php echo get_sub_field('subtitle'); ?></h4>
            </div>
            <div class="subscription-cake__body">
                <div class="subscription-cake__text"><?php echo get_sub_field('text'); ?></div>
                <div class="subscription-cake__items">
                    <?php if( have_rows('items') ): ?>
                        <?php while( have_rows('items') ): the_row(); ?>
                            <?php
                                $_product = wc_get_product(get_sub_field('product_subscription'));

                                if ($_product->is_type( 'subscription' )) {
                                    $price_sale =  WC_Subscriptions_Product::get_price( $_product );
                                    $get_regular_price =  WC_Subscriptions_Product::get_regular_price( $_product);
                                    $period = WC_Subscriptions_Product::get_period( $_product);
                                    $lenght   = WC_Subscriptions_Product::get_interval($_product);

                                    if ($period == 'month') {
                                        $price_sale_per_month = $price_sale / $lenght;
                                        $get_regular_price_per_month = $get_regular_price /  $lenght;
                                    } else if ($period == 'year') {
                                        $lenght = $lenght * 12;
                                        $price_sale_per_month = $price_sale / $lenght;
                                        $get_regular_price_per_month = $get_regular_price / $lenght;
                                    } else {
                                        $price_sale_per_month = 0;
                                        $get_regular_price_per_month = 0;
                                    }
                                }
                            ?>
                            <div class="subscription-cake__item js-radio-list">
                                <div>
                                    <input 
                                        type="radio" 
                                        name="subscription"
                                        data-product_id="<?php echo $_product->get_id(); ?>" 
                                        data-product_sku="<?php echo $_product->get_sku(); ?>" 
                                        aria-label="Add <?php echo $_product->get_name(); ?> to your cart"
                                        product_name="<?php echo $_product->get_name(); ?>" 
                                        product_price="<?php echo $price_sale_per_month; ?>"
                                        value="<?php echo get_sub_field('product_subscription'); ?>" 
                                        id="subscription_<?php echo get_sub_field('product_subscription'); ?>" <?php //echo get_row_index() == 1 ? 'checked' : ''; ?>
                                    />
                                    <label class="subscription-cake__label" for="subscription_<?php echo get_sub_field('product_subscription'); ?>">
                                        <?php echo $_product->get_name(); ?>
                                    </label>
                                </div>
                                <div class="subscription-cake__price">
                                    <strong class="subscription-cake__strong"><?php echo wc_price($price_sale_per_month); ?></strong> <span class="subscription-cake__span">Per month</span>
                                    <?php if ($get_regular_price - $price_sale > 0): ?>
                                        <span class="subscription-cake__span">Total $<?php echo $price_sale; ?> -</span> <span class="subscription-cake__green">Save $<?php echo number_format($get_regular_price - $price_sale, 0); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <a href="/" data-quantity="1" class="button product_type_subscription add_to_cart_button ajax_add_to_cart js_add_to_cart subscription-cake__button" data-product_id="" data-product_sku="" aria-label="" rel="nofollow" product_name="" product_price="" product_type="subscription"><span>Subscribe</span></a>
            </div>
        </div>
    </div>
</div>