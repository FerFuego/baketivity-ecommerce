<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p><?php
	// translators: placeholder is the name of the site
	printf( esc_html__( 'Hi there. Your subscription renewal order with %s has been completed. Your order details are shown below for your reference:', 'woocommerce-subscriptions-gifting' ), esc_html( get_option( 'blogname' ) ) );
	?>
</p>

<?php

if ( is_callable( array( 'WC_Subscriptions_Email', 'order_download_details' ) ) ) {
	WC_Subscriptions_Email::order_download_details( $order, $sent_to_admin, $plain_text, $email );
}
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
?>

<?php do_action( 'wcs_gifting_email_order_details', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_subscriptions_gifting_recipient_email_details', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_footer', $email ); ?>
