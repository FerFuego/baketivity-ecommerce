<?php
$product = wc_get_product($product_id);
$product_gallery = (method_exists($product, 'get_gallery_image_ids')) ? $product->get_gallery_image_ids() : null;
$newness_days = 30;
$created = (method_exists($product, 'get_date_created')) ? strtotime($product->get_date_created()) : 0;
$timestamp = (time() - (60 * 60 * 24 * $newness_days));

if (isset($_GET['cat'])) {
    $url_categories = explode(',', sanitize_text_field($_GET['cat']));
} else if (isset($order_by) && $order_by == 'prime') {
    $url_categories = ['buy-with-prime'];
} else {
    $url_categories = [];
}
?>

<div class="product-shop has-gallery product type-product status-publish last instock product_cat-shop-baking-kits product_tag-branded has-post-thumbnail purchasable product-type-simple <?= get_field('prime', $product->get_ID()) && in_array('buy-with-prime', $url_categories) ? 'order_prime' : '' ?>">
    <?php if ($timestamp < $created) : ?>
        <div class="product-shop__badges ribbon-new">
            <div class="product-shop__badges-label"><?php echo esc_html__('NEW', 'woocommerce') ?></div>
        </div>
    <?php elseif (get_field('on_sale', $product->get_ID())) : ?>
        <div class="product-shop__badges ribbon-sale">
            <div class="product-shop__badges-label"><?php echo esc_html__('SALE', 'woocommerce') ?></div>
        </div>
    <?php elseif (get_field('prime', $product->get_ID())) : ?>
        <!-- <div class="product-shop__badges ribbon-prime">
            <div class="product-shop__badges-label-prime">
                <?php //echo esc_html__('30% OFF', 'woocommerce'); 
                ?></div>
        </div> -->
        <div class="product-shop__badges-prime">
            <img src="/wp-content/themes/baketivity/images/prime/buy-with-prime.png" alt="buy with prime">
        </div>
    <?php endif; ?>
    <!-- Product Custom New Badge -->
    <?php if (get_field('custom_badge', $product->get_ID())) : ?>
        <div class="product-shop__new-badge" style="background-color:<?= get_field('custom_badge_bg', $product->get_ID()); ?>; color:<?= get_field('custom_badge_color', $product->get_ID()); ?>">
            <?= get_field('custom_badge', $product->get_ID()); ?>
        </div>
    <?php endif; ?>
    <!-- Product image -->
    <div class="product-shop__ba-slider">
        <?php if ($product_gallery) : ?>
            <a href="javascript:void(0);" class="product-shop__control_prev"></a>
            <a href="javascript:void(0);" class="product-shop__control_next"></a>
        <?php endif; ?>
        <ul class="product-shop__image product-shop__ul">
            <li class="product-shop__li product-shop__image">
                <a href="<?php echo $product->get_permalink(); ?>" class="link-image">
                    <img src="<?php echo wp_get_attachment_image_url($product->get_image_id(), 'medium'); ?>" alt="<?php echo $product->get_name(); ?>">
                </a>
            </li>
            <?php // Get product gallery image ids
            if ($product_gallery) :
                foreach ($product_gallery as $key => $img_id) : ?>
                    <li class="product-shop__li product-shop__image">
                        <a href="<?php echo $product->get_permalink(); ?>" class="link-image">
                            <img src="<?php echo wp_get_attachment_image_url($img_id, 'medium'); ?>" alt="<?php echo $product->get_name(); ?>">
                        </a>
                    </li>
            <?php endforeach;
            endif; ?>
        </ul>
    </div>
    <!-- Pruduct title -->
    <h4 class="product-shop__title"><a href="<?php echo $product->get_permalink(); ?>"><?php echo $product->get_name(); ?></a></h4>
    <!-- Product price -->
    <div class="product-shop__price"><?php echo $product->get_price_html(); ?></div>
    <!-- Add to cart -->
    <?php if (get_field('prime', $product->get_ID())) : ?>
        <a href="<?php echo $product->get_permalink(); ?>" class="button product_type_simple add_to_cart_inline"><span>View Details</span></a>
    <?php else :
        echo do_shortcode('[add_to_cart id=' . $product->get_ID() . ']');
    endif; ?>
</div>