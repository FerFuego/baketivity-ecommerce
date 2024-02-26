<?php

/**
 * Description: Add the option to gift note to orders in WooCommerce
 * Author: Fer Catalano
 */
class Checkout_Gift_Extra_Fields
{

	// Contants
	const KLAVIYO_URL = 'https://a.klaviyo.com/api/v2';
	const KLAVIYO_LIST = 'YmDKfK'; // Gifting List
	const KLAVIYO_API_KEY = 'pk_da64aa2b367f684a1baae8f4613f69af75';

	public function __construct()
	{
		add_filter('woocommerce_checkout_fields', [$this, 'custom_checkout_fields']);
		add_action('woocommerce_checkout_update_order_meta', [$this, 'save_extra_checkout_fields'], 10, 2);
		add_action('woocommerce_thankyou', [$this, 'display_order_data'], 20);
		add_action('woocommerce_view_order', [$this, 'display_order_data'], 20);
		add_action('woocommerce_admin_order_data_after_order_details', [$this, 'display_order_data_in_admin']);
		add_action('woocommerce_after_thankyou', [$this, 'email_recipient_gift_after_wc_order_completed'], 10, 1);
		//add_filter( 'woocommerce_shipstation_export_custom_field_2', [ $this, 'shipstation_custom_field_2'] );
		add_filter('woocommerce_shipstation_export_order_xml', [$this, 'add_new_data_note']);
	}

	public function custom_checkout_fields($fields)
	{
		$fields['extra_fields'] = array(
			'recipient_email' => array(
				'type' 		=> 'email',
				'required'	=> false,
				'label'		=> __('Recipient Email')
			),
			'recipient_message' => array(
				'type' 		=> 'textarea',
				'required'	=> false,
				'label'		=> __('Gift Message')
			),
		);
		return $fields;
	}

	public function save_extra_checkout_fields($order_id, $posted)
	{
		if (isset($posted['recipient_email'])) {
			update_post_meta($order_id, '_recipient_email', sanitize_text_field($posted['recipient_email']));
		}
		if (isset($posted['recipient_message'])) {
			update_post_meta($order_id, '_recipient_message', sanitize_text_field($posted['recipient_message']));
		}
	}

	public function display_order_data($order_id)
	{
		$recipient_email	= get_post_meta($order_id, '_recipient_email', true);
		$recipient_message	= get_post_meta($order_id, '_recipient_message', true);

		if ($recipient_email) : ?>
			<div class="woocommerce-column woocommerce-column--2 woocommerce-column--payment-gifting col-2">
				<h2 class="woocommerce-column__title"><?php _e('Gift Information'); ?></h2>
				<div>
					<?php
					if ($recipient_email) {
						echo '<p><span>' . __('Recipient Email') . ':</span> ' . $recipient_email . '</p>';
					}
					if ($recipient_message) {
						echo '<p><span>' . __('Gift Message') . ':</span> ' . $recipient_message . '</p>';
					}
					?>
				</div>
			</div>
		<?php
		else :
			echo '<br>';
		endif;
	}

	public function display_order_data_in_admin($order)
	{  ?>
		<div class="order_data_column form-field form-field-wide wc-customer-user">
			<h4><?php _e('Additional Information', 'woocommerce'); ?><a href="#" class="edit_address"><?php _e('Edit', 'woocommerce'); ?></a></h4>
			<div class="address">
				<?php
				echo '<p><strong>' . __('Recipient Email') . ':</strong>' . get_post_meta($order->id, '_recipient_email', true) . '</p>';
				echo '<p><strong>' . __('Gift Message') . ':</strong>' . get_post_meta($order->id, '_recipient_message', true) . '</p>';
				?>
			</div>
			<div class="edit_address">
				<?php woocommerce_wp_text_input(array('id' => '_recipient_email', 'label' => __('Recipient Email'), 'wrapper_class' => '_billing_company_field')); ?>
				<?php woocommerce_wp_text_input(array('id' => '_recipient_message', 'label' => __('Gift Message'), 'wrapper_class' => '_billing_company_field')); ?>
			</div>
		</div>
<?php }

	public function email_recipient_gift_after_wc_order_completed($order_id)
	{

		$recipient_email	= get_post_meta($order_id, '_recipient_email', true);
		$recipient_message	= get_post_meta($order_id, '_recipient_message', true);

		if (!empty($recipient_email)) {
			// url
			$url = static::KLAVIYO_URL . '/list/' . static::KLAVIYO_LIST . '/subscribe?api_key=' . static::KLAVIYO_API_KEY;
			// data
			$data = array(
				'profiles' => array(
					array(
						'email' => $recipient_email,
					),
					array(
						'$first_name' => 'Recipient',
						'$last_name'  => 'Gift',
						'email' 	  => $recipient_email,
						'message'     => $recipient_message,
						'sms_consent' => false,
					)
				)
			);
			// curl send
			if (class_exists('cURL')) {
				$curl = new cURL();
				$response = $curl->callcURL('POST', $url, $data);
			}
		}
	}

	public function shipstation_custom_field_2()
	{
		return '_recipient_message';
	}

	public function add_new_data_note($order_xml)
	{

		$doc 			= $order_xml->ownerDocument;
		$order_number	= $order_xml->firstChild->nodeValue;
		$gift_note		= get_post_meta($order_number, '_recipient_message', true);
		$order 			= wc_get_order($order_number);
		// Check if gift note is not empty and if order is a parent order
		if ($gift_note && 0 == $order->get_parent_id()) {
			// create element
			$data = $order_xml->appendChild($doc->createElement('GiftMessage'));
			// add value
			$data->appendChild($doc->createCDATASection($gift_note));
		}

		return $order_xml;
	}
}
