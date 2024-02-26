<?php

/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $product;

if (!wc_review_ratings_enabled()) {
	return;
}

$rating_count = $review_count = $average = 0;

if (null !== $product->get_rating_count() && method_exists($product, 'get_rating_count')) {
	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();
}

if ($rating_count >= 0) : ?>

	<div class="woocommerce-product-rating">
		<?php echo wc_get_rating_html($average, $rating_count); // WPCS: XSS ok. 
		?>
		<?php if (comments_open()) : ?>
			<?php //phpcs:disable 
			?>
			<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><span class="count"><?php echo esc_html($review_count); ?></span><svg xmlns="http://www.w3.org/2000/svg" width="9.001" height="5" viewBox="0 0 9.001 5">
					<path id="arrow" d="M4541.5,235l4.5-2.5v-2.4l-4.5,2.516L4537,230v2.5Z" transform="translate(-4537 -230)" fill="#b3b3b3" />
				</svg></a>
			<?php // phpcs:enable 
			?>
		<?php endif ?>
	</div>

<?php endif; ?>