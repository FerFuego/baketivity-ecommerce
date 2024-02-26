<?php
$product = wc_get_product($product_id);
$product_gallery = $product->get_gallery_image_ids();
$newness_days = 30;
$created = strtotime($product->get_date_created());
$timestamp = (time() - (60 * 60 * 24 * $newness_days));
?>

<div
    class="product-shop-duff has-gallery product type-product post-280916 status-publish last instock product_cat-shop-baking-kits product_tag-branded has-post-thumbnail purchasable product-type-simple">
    <?php if ($timestamp < $created): ?>
        <div class="product-shop-duff__badges ribbon-new">
            <div class="product-shop-duff__badges-label"><?php echo esc_html__('NEW', 'woocommerce') ?></div>
        </div>
    <?php elseif (get_field('on_sale', $product->get_ID())) : ?>
        <div class="product-shop-duff__badges ribbon-sale">
            <div class="product-shop-duff__badges-label"><?php echo esc_html__('SALE', 'woocommerce') ?></div>
        </div>
    <?php elseif (get_field('prime', $product->get_ID())) : ?>
        <div class="product-shop-duff__badges ribbon-prime">
            <div class="product-shop-duff__badges-label-prime"><?php echo esc_html__('50% OFF', 'woocommerce') ?></div>
        </div>
    <?php endif;?>
    <!-- Product image -->
    <div class="product-shop-duff__ba-slider">
        <?php if ($product_gallery): ?>
            <a href="javascript:void(0);" class="product-shop-duff__control_prev"></a>
            <a href="javascript:void(0);" class="product-shop-duff__control_next"></a>
        <?php endif;?>
        <ul class="product-shop-duff__image product-shop-duff__ul">
            <li class="product-shop-duff__li product-shop-duff__image">
                <a href="<?php echo $product->get_permalink(); ?>" class="link-image">
                    <img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>"alt="<?php echo $product->get_name(); ?>">
                </a>
            </li>
            <?php // Get product gallery image ids
            if ($product_gallery):
                foreach ($product_gallery as $key => $img_id): ?>
                <li class="product-shop-duff__li product-shop-duff__image">
                    <a href="<?php echo $product->get_permalink(); ?>" class="link-image">
                        <img src="<?php echo wp_get_attachment_url($img_id); ?>" alt="<?php echo $product->get_name(); ?>">
                    </a>
                </li>
                <?php endforeach;
            endif;?>
        </ul>
    </div>
    <!-- Pruduct title -->
    <h4 class="product-shop-duff__title"><a href="<?php echo $product->get_permalink(); ?>"><?php echo $product->get_name(); ?></a></h4>
    <!-- Product price -->
    <div class="product-shop-duff__price"><?php echo $product->get_price_html(); ?></div>
    <!-- Add to cart -->
    <?php echo do_shortcode('[add_to_cart id=' . $product->get_id() . ']'); ?>
</div>