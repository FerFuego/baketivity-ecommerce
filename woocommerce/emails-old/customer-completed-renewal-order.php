<?php
/**
 * Customer completed renewal order email
 *
 * @author  Brent Shepherd
 * @package WooCommerce_Subscriptions/Templates/Emails
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer first name */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce-subscriptions' ), esc_html( $order->get_billing_first_name() ) ); ?></p>
<p><?php esc_html_e( 'We have finished processing your subscription renewal order.', 'woocommerce-subscriptions' ); ?></p>

<?php
echo 'tét';

$label_ids = get_posts( array(
	'posts_per_page' => -1,
	'post_type'      => 'wc_stamps_label',
	//'fields'         => 'ids',
	'post_parent'    => $order->get_id(),
) );

if( ! empty( $label_ids ) ){
	$output = '<div><p>';
	foreach ( $label_ids as $p ){
		$tracking = $p->post_title;
		$date = esc_html( date_i18n( get_option( 'date_format' ), strtotime( $p->post_date) ) );
		$output .= 'Your order was shipped on '.$date .' .Tracking number ' .$tracking.'. ';
		$output .= '<a target="_blank" href="https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=' . esc_attr( $tracking) . '">Click here to track you shipment</a>';
	}
	$output .= '</p></div>';
	echo $output;
}

do_action( 'woocommerce_subscriptions_email_order_details', $order, $sent_to_admin, $plain_text, $email );

do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

do_action( 'woocommerce_email_footer', $email );
