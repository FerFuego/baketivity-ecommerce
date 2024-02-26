<style scoped>
.subs-bg-behavior {
    background-image: url(<?php echo get_sub_field('image_desktop')['url'];
    ?>);
}

@media (max-width: 768px) {
    .subs-bg-behavior {
        background-image: url(<?php echo get_sub_field('image_mobile')['url'];
        ?>);
    }
}
</style>
<div class="subscription-duff" id="subscription-duff">
    <div class="subscription-duff__container">
        <div class="subscription-duff__left subs-bg-behavior"></div>
        <div class="subscription-duff__right">
            <div class="subscription-duff__header">
                <h3 class="subscription-duff__title"><?php echo get_sub_field('title'); ?></h3>
                <h4 class="subscription-duff__subtitle"><?php echo get_sub_field('subtitle'); ?></h4>
            </div>
            <div class="subscription-duff__body">
                <div class="subscription-duff__text"><?php echo get_sub_field('text'); ?></div>
                <div class="subscription-duff__items">
                    <?php if (have_rows('items')): ?>
                    <?php while (have_rows('items')): the_row();?>
                    <?php
    $_product = wc_get_product(get_sub_field('product_subscription'));

    if ($_product->is_type('subscription')) {
        $price_sale = WC_Subscriptions_Product::get_price($_product);
        $get_regular_price = WC_Subscriptions_Product::get_regular_price($_product);
        $period = WC_Subscriptions_Product::get_period($_product);
        $lenght = WC_Subscriptions_Product::get_interval($_product);

        if ($period == 'month') {
            $price_sale_per_month = $price_sale / $lenght;
            $get_regular_price_per_month = $get_regular_price / $lenght;
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
                    <?php if ($_product->get_sku() == "6MT001") {?>
                    <div class="subscription-duff__limited-offer-item">Apply FIRSTFREE coupon and get a free month <br>
                        with
                        6 and 12 months plans</div>
                    <?php }?>
                    <div
                        class="subscription-duff__item js-radio-list <?php if ($_product->get_sku() == "YR001" || $_product->get_sku() == "6MT001") {echo "offer-item-container";}?>">
                        <div class="subscription-duff__product-name">
                            <input type="radio" name="subscription" data-product_id="<?php echo $_product->get_id(); ?>"
                                data-product_sku="<?php echo $_product->get_sku(); ?>"
                                aria-label="Add <?php echo $_product->get_name(); ?> to your cart"
                                product_name="<?php echo $_product->get_name(); ?>"
                                product_price="<?php echo $price_sale_per_month; ?>"
                                value="<?php echo get_sub_field('product_subscription'); ?>"
                                id="subscription_<?php echo get_sub_field('product_subscription'); ?>"
                                <?php //echo get_row_index() == 1 ? 'checked' : ''; ?> />
                            <label class="subscription-duff__label"
                                for="subscription_<?php echo get_sub_field('product_subscription'); ?>">
                                <?php echo $_product->get_name(); ?>
                            </label>
                        </div>
                        <?php if ($_product->get_sku() == "YR001" || $_product->get_sku() == "6MT001") {?>
                        <div class="subscription-duff__limited-offer">Limited-time<br> offer</div>
                        <?php }?>
                        <div class="subscription-duff__price">
                            <strong
                                class="subscription-duff__strong"><?php echo wc_price($price_sale_per_month); ?></strong>
                            <span class="subscription-duff__span">Per month</span>
                            <?php if ($get_regular_price - $price_sale > 0): ?>
                            <span class="subscription-duff__span">Total $<?php echo $price_sale; ?> -</span> <span
                                class="subscription-duff__green">Save
                                $<?php echo number_format($get_regular_price - $price_sale, 0); ?></span>
                            <?php endif;?>
                        </div>
                    </div>
                    <?php endwhile;?>
                    <?php endif;?>
                </div>
                <a href="#subscription-duff" data-quantity="1"
                    class="button product_type_subscription add_to_cart_button ajax_add_to_cart js_add_to_cart subscription-duff__button"
                    data-product_id="" data-product_sku="" aria-label="" rel="nofollow" product_name="" product_price=""
                    product_type="subscription"><span>Subscribe Now</span></a>
            </div>
        </div>
    </div>
</div>