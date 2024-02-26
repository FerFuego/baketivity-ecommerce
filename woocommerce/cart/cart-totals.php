<?php

/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined('ABSPATH') || exit;

?>
<div class="cart_totals <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">

	<h2 class="cart-collaterals__title" id="order_review_heading"><?php esc_html_e('My Order', 'woocommerce'); ?></h2>

	<?php do_action('woocommerce_before_cart_totals'); ?>

	<!-- Coupon Cart html here -->
	<?php if (wc_coupons_enabled()) { ?>
		<div class="coupon-form-toggle">
			<div class="form-coupon-loader js-coupon-loader">
				<span></span>
			</div>
			<a href="#" id="nm-coupon-btn"><?php esc_html_e('Have a gift card or a coupon code?', 'nm-framework'); ?></a>
			<!-- Coupon Code -->
			<form class="form-coupon-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" method="post" id="js-coupon-form">
				<div class="coupon" style="display: none;">
					<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
					<input type="hidden" name="woocommerce_apply_coupon_nonce" id="woocommerce_apply_coupon_nonce" value="<?php echo wp_create_nonce("apply-coupon"); ?>" />
					<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply', 'woocommerce'); ?>">
						<?php esc_attr_e('Apply', 'woocommerce'); ?>
					</button>
					<?php do_action('woocommerce_cart_coupon'); ?>
				</div>
			</form>
			<!-- Gift Code -->
			<?php do_action('woocommerce_review_order_before_submit'); ?>
		</div>
	<?php } ?>

	<!-- Table Cart Totals -->
	<table cellspacing="0" class="shop_table shop_table_responsive">

		<!-- Custom Resume Cart -->
		<?php
		do_action('woocommerce_review_order_before_cart_contents');

		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
			$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) : ?>
				<tr class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
					<td class="product-name">
						<?php //echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf('%s&nbsp;&times;', $cart_item['quantity']) . '</strong>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
						?>
						<?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?>
						<?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
						?>
					</td>
					<td class="product-total">
						<?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
						?>
					</td>
				</tr>
			<?php endif; ?>
		<?php endforeach; ?>

		<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
				<td class="resume_discount"><?php echo __('Discount', 'baketivity'); ?> <?php wc_cart_totals_coupon_label($coupon); ?></td>
				<td class="resume_discount_value" data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php do_action('woocommerce_review_order_after_cart_contents'); ?>

		<!-- End Custom Resume Cart -->

		<tr class="cart-subtotal">
			<th><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
			<td data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?= WC()->cart->get_cart_total(); ?></td>
		</tr>

		<!-- Coupon move to Custom Resume Cart -->
		<!-- Default Coupon html here -->

		<!-- Shipping is not used in cart -->
		<!-- Default Shipping html here -->

		<!-- Fees is not used in cart -->
		<!-- Default Fees html here -->

		<!-- Taxes is not used in cart -->
		<!-- Default Taxes html here -->

		<?php do_action('woocommerce_cart_totals_before_order_total'); ?>

		<!-- Order Total is not used in cart -->
		<!-- Default Order Total html here -->

		<?php do_action('woocommerce_cart_totals_after_order_total'); ?>

	</table>

	<div class="wc-proceed-to-checkout">
		<a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button wc-forward btn-spinner"><?php esc_html_e('Secure Checkout', 'woocommerce'); ?></a>

		<a class="button continue-shopping btn-spinner" href="/shop">Continue Shopping</a>

		<!-- Show only in desktop -->
		<?php do_action('woocommerce_proceed_to_checkout'); ?>

	</div>

	<div class="cart-collaterals-safe">
		<img src="<?php echo get_template_directory_uri(); ?>/../baketivity/images/checkout/safe.webp" alt="safe checkout">
	</div>

	<?php do_action('woocommerce_after_cart_totals'); ?>

</div>