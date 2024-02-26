<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout woocomerce-custom-sidebar-checkout woocommerce-cart-form-js" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

	<?php if ($checkout->get_checkout_fields()) : ?>

		<?php do_action('woocommerce_checkout_before_customer_details'); ?>

		<div class="col2-set checkout-form-container animate__animated animate__bounceInLeft" id="customer_details">

			<!-- User Login-->
			<?php include 'custom/form-login.php'; ?>

			<div class="col-0 <?= is_user_logged_in() ? 'active' : ''; ?>">

				<div class="col-1">

					<?php do_action('woocommerce_checkout_billing'); ?>

					<!-- Resume Billing -->
					<div class="woocommerce-billing-fields__field-wrapper-resume"></div>
					<!-- Billing Form -->

				</div>

				<div class="col-2">
					<!-- Shipping Methods -->
					<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
						<div class="shipping-methods-container">
							<h4 class="shipping-methods-container__title"><?php esc_html_e('Select your shipping speed', 'baketivity'); ?></h4>
							<?php do_action('woocommerce_review_order_before_shipping'); ?>
							<?php wc_cart_totals_shipping_html(); ?>
							<?php do_action('woocommerce_review_order_after_shipping'); ?>
						</div>
					<?php endif; ?>

					<!-- This is a Gift -->
					<?php get_template_part('woocommerce/checkout/form-gift'); ?>

					<!-- Shipping Address -->
					<?php do_action('woocommerce_checkout_shipping'); ?>

					<!-- Continue Next Step -->
					<button type="button" class="woocommerce_checkout_continue_order button" id="place_continue">Continue</button>
				</div>

			</div>

			<!-- Payment Methods -->
			<div class="col-3 custom-payment-methods" id="payment_method_step">
				<div class="payment-method-container">
					<div class="payment-method-container__header">
						<h3 class="payment-method-container__title">3. Payment Methods</h3>
					</div>
					<!-- Terms & Conditions -->
					<?php do_action('custom_checkout_extra_step_shipping'); ?>
				</div>
			</div>

		</div>

		<?php do_action('woocommerce_checkout_after_customer_details'); ?>

	<?php endif; ?>

	<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

	<!-- Sidebar checkout Desktop -->
	<?php do_action('woocommerce_checkout_before_order_review'); ?>

	<div class="woocommerce-checkout-review-order animate__animated animate__bounceInRight" id="order_review">

		<div class="checkout-collaterals">

			<h3 class="checkout-collaterals__title" id="order_review_heading"><?php esc_html_e('My Order', 'woocommerce'); ?></h3>

			<?php do_action('woocommerce_checkout_order_review'); ?>

			<div class="checkout-collaterals__safe">
				<img src="<?php echo get_template_directory_uri(); ?>/../baketivity/images/checkout/safe.webp" alt="safe checkout" width="351" height="52">
			</div>

		</div>

	</div>

	<?php do_action('woocommerce_checkout_after_order_review'); ?>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>