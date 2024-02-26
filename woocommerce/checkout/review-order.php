<?php

/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>

<!-- Sidebar checkout Review order -->
<table class="woocommerce-checkout-review-order-table">
	<thead>
		<?php if (wc_coupons_enabled()) { ?>
			<tr>
				<td colspan="2">
					<script>
						//toggle arrow in gift form
						jQuery('#nm-coupon-btn').before().click(function() {
							jQuery('.coupon-form-toggle').toggleClass('active');
							jQuery("#pwgc-redeem-button").val("Apply");
						});
					</script>
					<div class="coupon-form-toggle">
						<div class="form-coupon-loader js-coupon-loader">
							<span></span>
						</div>
						<a href="#" id="nm-coupon-btn"><?php esc_html_e('Have a gift card or a coupon code?', 'nm-framework'); ?></a>
						<!-- Coupon Code -->
						<form class="form-coupon-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" method="post" id="js-coupon-form-checkout">
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
				</td>
			</tr>
		<?php } ?>
	</thead>
	<tbody>
		<?php do_action('woocommerce_review_order_before_cart_contents');

		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
			$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) { ?>
				<tr class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
					<td class="product-name">
						<div class="product-name-resume-checkout">
							<?php echo apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . sprintf('&nbsp;&times;&nbsp;%s', $cart_item['quantity']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?>
							<?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?>
						</div>
					</td>
					<td class="product-price-alt">
						<?php if ($_product->get_type() == 'subscription') {
							echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						} else {
							echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						} ?>
					</td>
				</tr>
				<tr class="empty-row"></tr>
			<?php } ?>
		<?php endforeach; ?>

		<?php do_action('woocommerce_review_order_after_cart_contents'); ?>

	</tbody>
	<tfoot>
		<tr class="shipping-cost">
			<th>
				<?php esc_html_e('Shipping:', 'baketivity'); ?>
			</th>
			<td>
				<?php echo WC()->cart->get_cart_shipping_total(); ?>
			</td>
		</tr>

		<tr class="empty-row"></tr>

		<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
				<th><?php esc_html_e('Discount:', 'baketivity'); ?> <?php wc_cart_totals_coupon_label($coupon); ?></th>
				<td><?php wc_cart_totals_coupon_html($coupon); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php foreach (WC()->cart->get_fees() as $fee) : ?>
			<tr class="fee">
				<th><?php echo esc_html($fee->name); ?></th>
				<td><?php wc_cart_totals_fee_html($fee); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
			<?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
				<?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
						<th><?php echo esc_html($tax->label); ?></th>
						<td><?php echo wp_kses_post($tax->formatted_amount); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html(WC()->countries->tax_or_vat()); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action('woocommerce_review_order_before_order_total'); ?>

		<tr class="order-total">
			<th><?php esc_html_e('Total', 'woocommerce'); ?></th>
			<td style="text-align: right;"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action('woocommerce_review_order_after_order_total'); ?>

	</tfoot>
</table>