<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<style scoped>#ppc-button-ppcp-gateway {display: block !important;}</style>
<li class="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
	<?php $gateway->payment_fields(); ?>
	<?php do_action( 'custom_woocommerce_paypal_checkout_button_renderer' ); ?>
</li>
