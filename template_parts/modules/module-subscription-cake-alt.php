<style scoped>
.cake-mbg-behavior {
    background-image: url(<?php echo get_sub_field('image_desktop')['url']; ?>); 
}
@media (max-width: 768px) {
    .cake-mbg-behavior {   
        background-image: url(<?php echo get_sub_field('image_mobile')['url']; ?>);
    }
}
</style>
<div class="subscription-cake" id="subscription-cake">
    <div class="subscription-cake__container">
        <div class="subscription-cake__left cake-mbg-behavior"></div>
        <div class="subscription-cake__right">
            <div class="subscription-cake__header subscription-cake__header--alt">
                <h3 class="subscription-cake__title subscription-cake__title--alt"><?php echo get_sub_field('title'); ?></h3>
                <h4 class="subscription-cake__subtitle subscription-cake__subtitle--alt"><?php echo get_sub_field('subtitle'); ?></h4>
            </div>
            <div class="subscription-cake__body subscription-cake__body--alt">
                <div class="subscription-cake__text subscription-cake__text--alt"><?php echo get_sub_field('text'); ?></div>
                <?php if ( get_sub_field('product')) : 
                    $product = wc_get_product( get_sub_field('product')->ID ); ?>
                    <div class="subscription-cake__product">
                        <?php echo $product->get_image(); ?>
                        <h3 class="subscription-cake__product-title"><?php echo $product->get_name(); ?></h3>
                        <p class="subscription-cake__product-price">
                            <?php if ($product->get_sale_price()) : ?>
                                <strong><?php echo '$'.$product->get_sale_price(); ?></strong> 
                            <?php endif; ?>
                            <span style="<?php echo $product->get_sale_price() ? 'text-decoration: line-through;':''; ?>"><?php echo '$'.$product->get_price(); ?></span>
                        </p>
                        <a href="/" data-quantity="1" class="button <?php echo $product->get_type(); ?> add_to_cart_button ajax_add_to_cart js_add_to_cart subscription-cake__product-link" data-product_id="<?php echo $product->get_id(); ?>" data-product_sku="<?php echo $product->get_sku(); ?>" aria-label="" rel="nofollow" product_name="<?php echo $product->get_name(); ?>" product_price="" product_type="<?php echo $product->get_type(); ?>"><span>Buy now</span></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>