<?php
/**
 * Popup cart info template
 *
 * @author  YITH
 * @package YITH WooCommerce Added to Cart Popup
 * @version 1.0.0
 */

if ( ! defined( 'YITH_WACP' ) ) {
	exit;
}

?>

<div class="cart-info custom-quick-cart">
	<?php if ( wc_coupons_enabled() ) { ?>
		<script>
			//toggle arrow in gift form
			jQuery('#nm-coupon-btn').before().click(function(){
				jQuery('.coupon-form-toggle').toggleClass('active');
				jQuery("#pwgc-redeem-button").val("Apply");
			});
			// form submit
			jQuery('#js-coupon-form').on('submit', function () {
				var loader = document.querySelector(".js-coupon-loader");
					loader.style.display = "block";
			});
		</script>
		<div class="coupon-form-toggle">
			<div class="form-coupon-loader js-coupon-loader">
				<span></span>
			</div>
			<a href="#" id="nm-coupon-btn"><?php esc_html_e( 'Have a gift card or a coupon code?', 'nm-framework' ); ?></a>
			<!-- Coupon Code -->
			<form class="form-coupon-checkout" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post" id="js-coupon-form">
				<div class="coupon" style="display: none;">
					<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
					<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>">
						<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>
					</button>
					<?php do_action( 'woocommerce_cart_coupon' ); ?>
				</div>
			</form>
			<!-- Gift Code -->
			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>
		</div>
	<?php } ?>

	<?php if ( $cart_shipping && isset( $cart_info['shipping'] ) ) : ?>
		<div class="cart-shipping">
			<?php esc_html_e( 'Shipping Cost', 'yith-woocommerce-added-to-cart-popup' ); ?>:
			<span class="shipping-cost">
				<?php echo $cart_info['shipping']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</span>
		</div>
	<?php endif; ?>
	
</div>

<div class="d-pop-cart-info">
	<div class="d-pop-info-cs">
		<?php if ( $cart_total && isset( $cart_info['total'] ) ) : ?>
			<?php if ( ! empty( $cart_info['discount'] ) ) : ?>
				<div class="cart-discount">
					<?php esc_html_e( 'Discount', 'yith-woocommerce-added-to-cart-popup' ); ?>:
					<span class="discount-cost">
						<?php echo $cart_info['discount']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</span>
				</div>
			<?php endif; ?>
			<div class="cart-totals">
				<?php echo esc_html( apply_filters( 'yith_wacp_cart_total_label', __( 'Total', 'yith-woocommerce-added-to-cart-popup' ) ) ); ?>:
				<span class="cart-cost">
					<?php echo WC()->cart->get_cart_total(); ?>
					<?php //echo $cart_info['subtotal']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</span>
			</div>
		<?php endif; ?>