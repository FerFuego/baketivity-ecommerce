<?php

/**
 * Popup related products template
 *
 * @author  YITH
 * @package YITH WooCommerce Added to Cart Popup
 * @version 1.0.0
 */

if (!defined('YITH_WACP')) {
	exit; // Exit if accessed directly.
}

$cross_sell_products_ids = Baketivity_Cart::get_cart_related_products_from_cross_sell(4);

if ($cross_sell_products_ids) : ?>
	<div class="cart-related-d">
		<div class="woocommmerce yith-wacp-related">

			<h3><?php echo esc_html($title); ?></h3>

			<ul class="products columns-<?php echo esc_attr($columns); ?>">

				<?php

				// Extra post classes.
				$classes = array('yith-wacp-related-product');
				// Set columns.
				$woocommerce_loop['loop']    = 0;
				$woocommerce_loop['columns'] = $columns;

				foreach ($cross_sell_products_ids as $product_id) :
					$post_object = get_post($product_id);
					setup_postdata($GLOBALS['post'] = &$post_object); ?>

					<li <?php post_class($classes); ?>>

						<?php do_action('yith_wacp_before_related_item'); ?>

						<div class="product-image">
							<a href="<?php the_permalink(); ?>">
								<?php
								$image_size = apply_filters('yith_wacp_suggested_product_image_size', 'shop_catalog');
								echo woocommerce_get_product_thumbnail($image_size); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								?>
							</a>
						</div>
						<div class="product-des-pop">
							<h3 class="product-title">
								<a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
								<?php echo woocommerce_template_single_rating(); ?>
							</h3>

							<div class="product-price">
								<?php wc_get_template('loop/price.php'); ?>
							</div>
							<div class="product-description-pop">
								<?php
								if ($show_add_to_cart) {
									echo do_shortcode('[add_to_cart id="' . get_the_ID() . '" style="" show_price="false"]');
								}
								?>
							</div>

						</div>

						<?php do_action('yith_wacp_after_related_item'); ?>

					</li>

				<?php endforeach; //endwhile; // end of the loop. 
				?>

			</ul>

		</div>

	<?php
endif;

wp_reset_postdata(); ?>

	</div>

	</div>