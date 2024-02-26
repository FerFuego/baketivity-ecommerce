<?php
function get_all_address_keys_above(){
    return array(
        'address_1', 'address_2', 'city', 'state', 'postcode',
        'postcode', 'country', 'first_name', 'last_name'
    );
}

function get_all_shipping_address_keys_above(){
    return array_map( function( $value ){
        return 'shipping_' . $value;
    }, get_all_address_keys_above());

}

function get_all_billing_address_keys_above(){
    return array_map( function( $value ){
        return 'billing_' . $value;
    }, get_all_address_keys_above());
}

/// backup (pre save shipping info)
add_action( 'woocommerce_new_order', 'backup_order_shipping_billing_address' );
function backup_order_shipping_billing_address( $order_id ){
    $order = wc_get_order( $order_id );
    /// shipping
    $shipping_keys = get_all_shipping_address_keys_above();
    foreach($shipping_keys AS $shipping_key){
        $get_shipping_key = 'get_' . $shipping_key;
        if($order->$get_shipping_key()) {
            update_post_meta($order_id, 'backup_'.$shipping_key, $order->$get_shipping_key());
        }
    }

    /// billing
    $billing_keys = get_all_billing_address_keys_above();
    foreach($billing_keys AS $billing_key){
        $get_billing_key = 'get_' . $billing_key;
        if($order->$get_billing_key()) {
            update_post_meta($order_id, 'backup_'.$billing_key, $order->$get_billing_key());
        }
    }
}
/// end backup (pre save shipping info)
///// fixed shipping for PayPal Standard
add_filter('wt_paypal_request_params', 'fixed_callback_paypal_standart');

function fixed_callback_paypal_standart( $params ){
    write('fixed_callback_paypal_standart start');
    $order_id = intval($params['PAYMENTREQUEST_0_PAYMENTREQUESTID']);
    $order = wc_get_order( $order_id );
    if(! $order) return $params;

    $_shipping_first_name = get_post_meta( $order_id, '_shipping_first_name', true);
    $_shipping_last_name = get_post_meta( $order_id, '_shipping_last_name');
    if($_shipping_first_name || $_shipping_last_name){
        $params['PAYMENTREQUEST_0_SHIPTONAME'] = trim($_shipping_first_name .' '. $_shipping_last_name);
    }

    $_shipping_address_1 = get_post_meta( $order_id, '_shipping_address_1', true);
    if($_shipping_address_1){
        $params['PAYMENTREQUEST_0_SHIPTOSTREET'] = $_shipping_address_1;
    }

    $_shipping_address_2 = get_post_meta( $order_id, '_shipping_address_2', true);
    if($_shipping_address_2){
        $params['PAYMENTREQUEST_0_SHIPTOSTREET2'] = $_shipping_address_2;
    }

    $_shipping_city = get_post_meta( $order_id, '_shipping_city', true);
    if($_shipping_city){
        $params['PAYMENTREQUEST_0_SHIPTOCITY'] = $_shipping_city;
    }

    $_shipping_state = get_post_meta( $order_id, '_shipping_state', true);
    if($_shipping_state){
        $params['PAYMENTREQUEST_0_SHIPTOSTATE'] = $_shipping_state;
    }

    $_shipping_postcode = get_post_meta( $order_id, '_shipping_postcode', true);
    if($_shipping_postcode){
        $params['PAYMENTREQUEST_0_SHIPTOZIP'] = $_shipping_postcode;
    }

    $_shipping_country = get_post_meta( $order_id, '_shipping_country', true);
    if($_shipping_country){
        $params['PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE'] = $_shipping_country;
    }
    write('fixed_callback_paypal_standart end');
    return $params;
}
///// fixed shipping for PayPal Standard end
///// fixed shipping for PayPal Standard EXPRESS


///// fixed shipping for PayPal Standard EXPRESS end
