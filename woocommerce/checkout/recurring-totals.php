<?php

/**
 * Recurring totals
 *
 * @author  Prospress
 * @package WooCommerce Subscriptions/Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
	exit;
}

$display_th = true;

?>
<tr class="subscription-summary">
	<td colspan="2">
		<table class="subscription-summary__table">
			<thead>
				<tr>
					<th class="subscription-summary__title" colspan="2"><?php esc_html_e('Subscription Summary', 'woocommerce-subscriptions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($recurring_carts as $recurring_cart_key => $recurring_cart) : ?>

					<?php if (0 == $recurring_cart->next_payment_date) : ?>
						<?php continue; ?>
					<?php endif; ?>

					<tr>
						<?php foreach ($recurring_cart->cart_contents as $key => $values) {
							$_product = $values['data']; ?>
							<th><?php echo $_product->get_title(); ?></th>
						<?php } ?>

						<td class="order-total subscription-summary__recurring-total">
							<?php wcs_cart_totals_order_total_html($recurring_cart); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>

			<tfoot class="d-none">

				<?php $display_th = true; ?>

				<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
					<?php foreach ($recurring_carts as $recurring_cart_key => $recurring_cart) : ?>
						<?php if (0 == $recurring_cart->next_payment_date) : ?>
							<?php continue; ?>
						<?php endif; ?>
						<?php foreach ($recurring_cart->get_coupons() as $recurring_code => $recurring_coupon) : ?>
							<?php if ($recurring_code !== $code) {
								continue;
							} ?>
							<tr class="cart-discount coupon-<?php echo esc_attr($code); ?> recurring-total">
								<?php if ($display_th) : $display_th = false; ?>
									<th rowspan="<?php echo esc_attr($carts_with_multiple_payments); ?>"><?php wc_cart_totals_coupon_label($coupon); ?></th>
									<td data-title="<?php wc_cart_totals_coupon_label($coupon); ?>"><?php wcs_cart_totals_coupon_html($recurring_coupon, $recurring_cart); ?>
										<?php echo ' ';
										wcs_cart_coupon_remove_link_html($recurring_coupon); ?></td>
								<?php else : ?>
									<td><?php wcs_cart_totals_coupon_html($recurring_coupon, $recurring_cart); ?></td>
								<?php endif; ?>
							</tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
					<?php $display_th = true; ?>
				<?php endforeach; ?>

				<!-- Subscription Shipping Cost -->
				<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
					<?php wcs_cart_totals_shipping_html(); ?>
				<?php endif; ?>

			</tfoot>

		</table>
	</td>
</tr>