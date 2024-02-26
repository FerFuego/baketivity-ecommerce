<?php

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
//add_filter( 'woocommerce_package_rates', 'd_hide_shipping_when_free_is_available', 999 );
function d_hide_shipping_when_free_is_available($rates)
{
    $free = array();
    foreach ($rates as $rate_id => $rate) {
        if ('free_shipping' === $rate->method_id) {
            $free[$rate_id] = $rate;
            break;
        }
    }
    return !empty($free) ? $free : $rates;
}

function woo_is_in_cart($product_id)
{
    global $woocommerce;
    foreach ($woocommerce->cart->get_cart() as $key => $val) {
        $_product = $val['data'];
        if ($product_id == $_product->get_id()) {
            return true;
        }
    }
    return false;
}

// multiply itself for every three items in the cart.
add_filter('woocommerce_package_rates', 'three_flat_rates_cost', 100, 1);
function three_flat_rates_cost($rates)
{
    $recurring_carts = WC()->cart->recurring_carts;
    $numner = 0;
    $d_sub_n = 0;
    $ex_product = 0;
    // Loop through cart items to find out if any hasn't the targetted shipping class
    foreach (WC()->cart->get_cart() as $cart_item) {
        $_product = $cart_item['data'];
        $type = $_product->get_type();
        if ($type == 'simple' || $type == 'variable' || $type == 'variation') {
            $numner += $cart_item['quantity'];
        }
        if ($type == 'subscription' || $type == 'variable-subscription') {
            $d_sub_n += $cart_item['quantity'];
        }
        //new 
        if ($_product->get_id() == 340652 && isset($cart_item['price'])) {
            $ex_product += $cart_item['quantity'];
        }
    }

    $numner = $numner - $ex_product;
    $d_rate =  ceil($numner / 3);
    $new_cost = false;

    if ($numner >= 15) {
        $new_cost = 49.99;
    } else if ($numner >= 6) {
        $new_cost = 24.99;
    }

    // USA
    if (isset($rates['flat_rate:2'])) {
        $rates['flat_rate:2']->cost = $d_rate *  $rates['flat_rate:2']->cost;
    }

    // USA
    if (isset($rates['flat_rate:3'])) {
        $rates['flat_rate:3']->cost = $d_rate *  $rates['flat_rate:3']->cost;
    }

    // Canada
    if (isset($rates['flat_rate:6'])) {
        $rates['flat_rate:6']->cost = $new_cost ? $new_cost : $rates['flat_rate:6']->cost;
    }

    // UK
    if (isset($rates['flat_rate:8'])) {
        $rates['flat_rate:8']->cost =  $new_cost ? $new_cost : $rates['flat_rate:8']->cost;
    }

    // AU
    if (isset($rates['flat_rate:13'])) {
        $rates['flat_rate:13']->cost =  $new_cost ? $new_cost : $rates['flat_rate:13']->cost;
    }

    return $rates;
}

add_filter('woocommerce_package_rates', 'hide_shipping_when_free_is_available', 9999999999999999);
function hide_shipping_when_free_is_available($rates)
{
    $remove_shipping = false;
    $cart_total = WC()->cart->cart_contents_total;
    $count = 0;
    $has_sub = false;
    $has_card = false;
    $has_kit = false;
    $cp = WC()->cart->get_applied_coupons();

    $spoiler_settings = get_field('theme_settings_spoiler_alert', 'option');
    $enable     = $spoiler_settings['enable'];
    $product_id = $spoiler_settings['product'];

    // Loop through cart items to find out if any hasn't the targetted shipping class
    foreach (WC()->cart->get_cart() as $key => $values) {

        $_product = $values['data'];
        $count++;

        if ($_product->get_id() == 340652 && isset($values['price']) && !in_array('firstmonthfree', $cp)) {
            $remove_shipping = true;
        }

        if ($_product->get_id() == 340651 && isset($values['price']) && !in_array('firstmonthfree', $cp)) {
            $remove_shipping = true;
        }

        // Check if product is a SpoilerBox
        if ($enable) {
            if ($_product->get_id() == $product_id && !in_array('firstmonthfree', $cp)) {
                $remove_shipping = true;
            }
        }

        if ($_product->get_type() == 'subscription' || $_product->get_type() == 'variable-subscription') {
            $has_sub = true;
        }

        if ($_product->get_type() == 'simple' && $_product->get_id() != 340652 && $_product->get_id() != 340651) {
            if ($enable) {
                // Check if product is not a SpoilerBox
                if ($_product->get_id() !== $product_id) {
                    $has_kit = true;
                }
            } else {
                $has_kit = true;
            }
        }

        if ($_product->get_type() == 'variation') {
            if (get_field('personalized_card', $_product->get_parent_id())) {
                $has_card = true;
            }
        }
    }

    if ($count == 1 || $count >= 3) {
        if (isset($rates['flat_rate:6'])) {
            // Check if there are more than 10 products in the cart
            //$rates['flat_rate:6']->cost =  0;
            //unset($rates['flat_rate:6']);
        }
    }

    if (($remove_shipping == true && $has_kit == false && $has_sub == true) ||
        ($remove_shipping == true && $has_sub == true && $has_card == true && $has_kit == false)
    ) {

        $chosen_payment_method = WC()->session->get('chosen_payment_method');

        if (isset($rates['flat_rate:3'])) {
            unset($rates['flat_rate:3']);
        }

        if (isset($rates['flat_rate:2'])) {
            unset($rates['flat_rate:2']);
        }

        $recurring_carts = WC()->cart->recurring_carts;

        if (isset($rates['flat_rate:4'])  && empty($recurring_carts)) {
            $rates['flat_rate:4']->cost =  0;
        }

        if (isset($rates['flat_rate:6'])  && !$has_sub) {
            unset($rates['flat_rate:6']);
        }

        if (isset($rates['flat_rate:5'])) {
            //unset($rates['flat_rate:5']);
        }

        if (isset($rates['flat_rate:13'])  && !$has_sub) {
            unset($rates['flat_rate:13']);
        }
    }
    return $rates;
}

add_action('woocommerce_after_shipping_rate', 'action_after_shipping_rate', 20, 2);
function action_after_shipping_rate($method, $index)
{

    $d_shipping_mess = "<p>Estimated Delivery: 2-3 Business Days</p>";
    $product_id = array();
    $d_type = array();
    $quantity = 0;

    foreach (WC()->cart->get_cart() as $cart_item) {

        $_product = $cart_item['data'];
        array_push($d_type, $_product->get_type());
        $parent_id = $_product->get_id();

        if ($_product->get_type() == 'variation') {
            $variation = wc_get_product($_product->get_id());
            $parent_id = $variation->get_parent_id();
        }

        if ($parent_id == '17425') {
            $quantity = $quantity + $cart_item['quantity'];
        }

        $product_id[] = $parent_id;
    }

    $product_id =  array_unique($product_id);

    if (in_array("17425", $product_id) && count($product_id) == 1) {
        $d_shipping_mess = "<p>Shipped in 4-6 Business Days</p>";
    }

    if (in_array("17425", $product_id) && count($product_id) == 2  && in_array("subscription", $d_type)) {
        $d_shipping_mess = "<p>Shipped in 4-6 Business Days</p>";
    }

    if ('flat_rate:2' === $method->id) {
        echo __("<p>Estimated Delivery: 4-6 Business Days</p> ");
    }
    if ('flat_rate:3' === $method->id) {
        echo $d_shipping_mess;
    }
    if ('flat_rate:4' === $method->id) {
        echo __(
            "<style type='text/css'>
            .woocommerce-shipping-methods li label:after{opacity: 1;}
            .woocommerce-shipping-methods li label span {color: #EE324D;}
            </style>
            <p>Shipped every 10th of the month</p>"
        );
    }
}

add_filter('woocommerce_package_rates', 'only_show_flat_rate_shipping_with_patterns_cs', 10, 2);
function only_show_flat_rate_shipping_with_patterns_cs($rates)
{

    $recurring_carts = WC()->cart->recurring_carts;
    if ($recurring_carts) {

        unset($rates['flat_rate:2']);
        if ($rates['flat_rate:3']) {
            unset($rates['flat_rate:3']);
        }

        if (isset($rates['flat_rate:6'])) {
            unset($rates['flat_rate:6']);
        }
    }

    return $rates;
}

add_action('wp_footer', 'update_checkout_js');
function update_checkout_js()
{
    if (is_checkout()) {
?>
        <script type="text/javascript">
            var getUrlParameter = function getUrlParameter(sdata, sParam) {
                var sURLVariables = sdata.split('&'),
                    sParameterName,
                    i;

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');

                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    }
                }
            };

            jQuery(document).ajaxComplete(function(event, xhr, settings) {
                if (settings.url == '/?wc-ajax=update_order_review') {
                    var b_country = getUrlParameter(settings.data, 'b_country');
                    var s_country = getUrlParameter(settings.data, 's_country');

                    if (b_country == 'CA' || s_country == 'CA') {
                        jQuery('#shipping_method_0_flat_rate5').parent().hide();
                        jQuery("input#shipping_method_0_flat_rate6").prop("checked", true).trigger("click");
                    }
                }
            });
        </script>
<?php
    }
}

add_filter('woocommerce_subscriptions_calculated_total', 'modify_shipping_total', 10, 1);
function modify_shipping_total($price)
{
    $recurring_total = 0;
    $cp = WC()->cart->get_applied_coupons();
    foreach (WC()->cart->recurring_carts as $cart) {
        $recurring_total += $cart->shipping_total;
    }

    $remove_shipping = false;
    $cart_total = WC()->cart->cart_contents_total;
    $count = 0;
    $has_sub = false;
    $has_card = false;
    $has_kit = false;
    $has_simple = false;

    $spoiler_settings = get_field('theme_settings_spoiler_alert', 'option');
    $enable     = $spoiler_settings['enable'];
    $product_id = $spoiler_settings['product'];

    //$cartcount = WC()->cart->get_cart_contents_count();
    // Loop through cart items to find out if any hasn't the targetted shipping class
    foreach (WC()->cart->get_cart() as $key => $values) {

        $_product = $values['data'];
        $count++;
        if ($_product->get_id() == 340652 && isset($values['price']) && !in_array('firstmonthfree', $cp)) {
            $remove_shipping = true;
        }

        if ($_product->get_id() == 340651 && isset($values['price']) && !in_array('firstmonthfree', $cp)) {
            $remove_shipping = true;
        }

        // Check if product is a SpoilerBox
        if ($_product->get_id() == $product_id && !in_array('firstmonthfree', $cp)) {
            $remove_shipping = true;
        }

        if ($_product->get_type() == 'subscription' || $_product->get_type() == 'variable-subscription') {
            $has_sub = true;
        } else if ($values['line_total'] > 0) {
            $has_simple = true;
        }

        if (in_array($_product->get_type(), array('simple', 'variable', 'variation')) && $_product->get_id() != 340652 && $_product->get_id() != 340651) {
            if ($enable) {
                // Check if product is not a SpoilerBox
                if ($_product->get_id() !== $product_id) {
                    $has_kit = true;
                }
            } else {
                $has_kit = true;
            }
        }

        if ($_product->get_type() == 'variation') {
            if (get_field('personalized_card', $_product->get_parent_id())) {
                $has_card = true;
            }
        }
    }

    if (($remove_shipping == true && $count == 2 && $has_sub == true) ||
        ($remove_shipping == true && $has_sub == true && $has_card == true && $has_kit == false) ||
        ($count == 1 && $has_sub == true) ||
        ($has_sub && $has_simple) ||
        ($has_sub == true && $has_card == true && $has_kit == false) ||
        ($remove_shipping == false && $count == 2 && $has_sub == true && $has_kit == false)
    ) {

        $price = $price;
    } else {
        $price = $price + $recurring_total;
    }

    return $price;
}


add_action('woocommerce_package_rates', 'hide_shipping_zero_methods_for_canada', 10, 2);
function hide_shipping_zero_methods_for_canada($rates, $package)
{
    // HERE Define your targeted shipping method ID
    $shipping_zone = WC_Shipping_Zones::get_zone_matching_package($package);
    $zone = $shipping_zone->get_zone_name();
    foreach ($rates as $rate) {
        if ($rate->cost == 0 && $zone == 'Canada') {
            unset($rates[$rate->id]);
        }
    }

    return $rates;
}

add_filter('woocommerce_cart_shipping_method_full_label', 'bbloomer_add_0_to_shipping_label', 10, 2);
function bbloomer_add_0_to_shipping_label($label, $method)
{
    // if shipping rate is 0, concatenate ": $0.00" to the label
    if (!($method->cost > 0)) {
        $label .= ': ' . wc_price(0);
    }

    // return original or edited shipping label
    return $label;
}

add_filter('woocommerce_package_rates', 'd_remove_flat_rates_cost_camp_baking_kit', 100, 2);
function d_remove_flat_rates_cost_camp_baking_kit($rates, $arrgg)
{
    $product_id = array();
    $d_type = array();
    $quantity = 0;
    foreach (WC()->cart->get_cart() as $cart_item) {
        $_product = $cart_item['data'];
        array_push($d_type, $_product->get_type());
        $parent_id = $_product->get_id();
        if ($_product->get_type() == 'variation') {
            $variation = wc_get_product($_product->get_id());
            $parent_id = $variation->get_parent_id();
        }
        if ($parent_id == '17425') {
            $quantity = $quantity + $cart_item['quantity'];
        }
        $product_id[] = $parent_id;
    }

    $product_id =  array_unique($product_id);

    if (in_array("17425", $product_id) && count($product_id) == 1) {
        if ($rates['flat_rate:4']) {
            unset($rates['flat_rate:4']);
        }
        if ($rates['flat_rate:2']) {
            // Conflict with Free-Shipping Meter
            //unset( $rates['flat_rate:2']); 
        }

        if ($rates['flat_rate:5']) {
            unset($rates['flat_rate:5']);
        }
        if ($rates['flat_rate:3']) {
            $rates['flat_rate:3']->cost = $quantity * 9.99;
        }
    }
    return $rates;
}

add_filter('woocommerce_package_rates', 'd_remve_other_shipping', 999);
function d_remve_other_shipping($rates)
{
    $remove_shipping = false;
    $cart_total = WC()->cart->cart_contents_total;
    $count = 0;
    $has_sub = false;
    $has_card = false;
    $has_kit = false;
    $d_sub_n = 0;
    $cp = WC()->cart->get_applied_coupons();

    // Loop through cart items to find out if any hasn't the targetted shipping class
    foreach (WC()->cart->get_cart() as $key => $values) {
        $_product = $values['data'];
        $type = $_product->get_type();
        $count++;
        if (in_array('firstmonthfree', $cp)) {
            $remove_shipping = true;
        }
        if ($type == 'subscription' || $type == 'variable-subscription') {
            $d_sub_n += $values['quantity'];
        }
    }

    if (woo_is_in_cart(340652) != 1 && woo_is_in_cart(340651) != 1 && $remove_shipping == true && $d_sub_n >= 1) {
        if (isset($rates['flat_rate:3'])) {
            $rates['flat_rate:3']->cost = $d_sub_n * 7.99;
        }
    }

    if ($remove_shipping == true) {
        if (isset($rates['flat_rate:2'])) {
            unset($rates['flat_rate:2']);
        }
        if (isset($rates['flat_rate:4'])) {
            unset($rates['flat_rate:4']);
        }
    }
    return $rates;
}

add_action('woocommerce_after_cart', 'fixed_subscription_shipping_method_js');
add_action('woocommerce_after_checkout_form', 'fixed_subscription_shipping_method_js');
function fixed_subscription_shipping_method_js()
{
    $has_subscription = false;
    $has_simple = false;
    foreach (WC()->cart->get_cart() as $key => $values) {
        $_product = $values['data'];
        if (in_array($_product->get_type(), array('subscription', 'variable-subscription')) !== false) {
            $has_subscription = true;
        } else if ($values['line_total'] > 0) {
            $has_simple = true;
        }
    }

    if ($has_subscription && $has_simple) {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function () {
                    update_subscription_cart();
                });
                
                jQuery("body").on("updated_checkout", function(){
                    update_subscription_cart();
                })
                
                jQuery("body").on("wc_fragments_refreshed", function(){
                    update_subscription_cart();
                })                   
                
                
                function update_subscription_cart(){
                    /* let subscriptiun_shippings = ["flat_rate:4", "flat_rate:5", "flat_rate:9", "flat_rate:14"]; */
                    let subscriptiun_shippings = ["flat_rate:4", "flat_rate:9", "flat_rate:14"];
                   document.querySelectorAll("#shipping_method input").forEach(function(input){      
                         if(subscriptiun_shippings.includes(input.value)){
                             input.checked = false;
                             input.parentElement.style.display = "none";
                         }                         
                   });
                   document.querySelectorAll(".recurring-total.shipping input").forEach(function(input){      
                         if(subscriptiun_shippings.includes(input.value) == false){                             
                             input.parentElement.style.display = "none";
                         } else {
                             input.checked = true;
                         }                 
                   });                
                }
             </script>';

        echo '<style>
                .shipping.recurring-total ul li input{display: none;}
            </style>';
    }

    echo '<script>
        jQuery("body").on("updated_checkout", function(){

            /* add spinner btn */
            var gral = new General();
                gral.init();

            cart.ajaxApplyCoupon();
        })

        jQuery("body").on("updated_cart_totals", function(){
            /* refresh listener coupon form */
            cart.toggleCoupon();
            cart.ajaxApplyCoupon();

            /* add spinner btn */
            var gral = new General();
                gral.init();
        })

        document.addEventListener("DOMContentLoaded", function () {
            // refresh listener coupon form
            cart.toggleCoupon();
            cart.ajaxApplyCoupon();
        });
    </script>';
}

add_filter('woocommerce_package_rates', 'remove_simple_shipping_subscription', 1000000, 2);
function remove_simple_shipping_subscription($rates)
{
    $has_subscription = false;
    $has_simple = false;
    $woocommerce_order_splitter_for_subscription_and_simple_products_array = get_woocommerce_order_splitter_for_subscription_and_simple_products();

    foreach (WC()->cart->get_cart() as $key => $values) {
        $_product = $values['data'];
        if (in_array($_product->get_type(), array('subscription', 'variable-subscription')) !== false) {
            $has_subscription = true;
        } else if ($values['line_total'] > 0) {
            if ($woocommerce_order_splitter_for_subscription_and_simple_products_array && in_array($values['data']->get_id(), $woocommerce_order_splitter_for_subscription_and_simple_products_array)) {
                continue;
            }
            $has_simple = true;
        }
    }

    if ($has_subscription && !$has_simple) {
        if (isset($rates['flat_rate:8'])) unset($rates['flat_rate:8']);
        if (isset($rates['flat_rate:6'])) unset($rates['flat_rate:6']);
        if (isset($rates['flat_rate:13'])) unset($rates['flat_rate:13']);
    }


    if (!$has_subscription) {
        if (isset($rates['flat_rate:9'])) unset($rates['flat_rate:9']);
        if (isset($rates['flat_rate:14'])) unset($rates['flat_rate:14']);
    }

    /// fixed total shipping cost
    if ($has_subscription && $has_simple) {
        $subscription_cost = 0;
        foreach ($rates as $rate) {
            if (strripos($rate->get_label(),  'subscription') !== false) {
                $subscription_cost = $rate->get_cost();
            }
        }

        foreach ($rates as $rate) {
            if (strripos($rate->get_label(),  'subscription') === false) {
                $rate->set_cost($rate->get_cost() + $subscription_cost);
            }
        }

        // checked default method
        if (!isset($rates[WC()->session->get('chosen_shipping_methods')[0]])) {
            $rate_keys = array_keys($rates);
            $default   = current($rate_keys);
            add_filter('woocommerce_shipping_chosen_method', $default, 99999);
        }
    }

    return $rates;
}


add_action('woocommerce_after_calculate_totals', 'action_function_name_2393');
function action_function_name_2393($cart)
{
    // action...
    $has_subscription = false;
    $subscription_item_counter = 0;
    $has_simple = false;
    $woocommerce_order_splitter_for_subscription_and_simple_products_array = get_woocommerce_order_splitter_for_subscription_and_simple_products();

    foreach (WC()->cart->get_cart() as $key => $values) {
        $_product = $values['data'];
        if (in_array($_product->get_type(), array('subscription', 'variable-subscription')) !== false) {
            $has_subscription = true;
            $subscription_item_counter++;
        } else if ($values['line_total'] > 0) {
            if ($woocommerce_order_splitter_for_subscription_and_simple_products_array && in_array($values['data']->get_id(), $woocommerce_order_splitter_for_subscription_and_simple_products_array)) {
                continue;
            }
            $has_simple = true;
        }
    }

    if ($has_subscription && !$has_simple && $subscription_item_counter > 1) {
        WC()->cart->set_total($cart->total - $cart->get_shipping_total());
    }
}

///////////////////////////////////////////////// fixed total order with subscription + single
//add_action( 'woocommerce_checkout_create_order', 'fixed_order_total_with_subscription_and_regular', 20, 1 );
add_action('woocommerce_checkout_order_created', 'fixed_order_total_with_subscription_and_regular', 20, 1);
function fixed_order_total_with_subscription_and_regular($order)
{
    if (get_post_meta($order->get_id(), 'fixed_subscription_and_regular', true) == 1) return;

    $has_subscription = false;
    $has_single = false;
    $total = $order->get_total();

    $recurring_shipping_total = 0;
    WC()->cart->get_applied_coupons();
    foreach (WC()->cart->recurring_carts as $cart) {
        $recurring_shipping_total += $cart->shipping_total;
    }

    foreach (WC()->cart->get_cart() as $cart_item) {
        $product = $cart_item['data'];
        if (in_array($product->get_type(), array('subscription', 'variable-subscription')) !== false) {
            $has_subscription = true;
        } else if (isset($cart_item['line_subtotal']) && $cart_item['line_subtotal'] > 0) {
            $has_single = true;
        }
    }


    if ($has_subscription && $has_single) {

        update_post_meta($order->get_id(), '_save_base_shipping_total', $order->get_shipping_total());
        update_post_meta($order->get_id(), '_save_base_recurring_shipping_total', $recurring_shipping_total);
        $order->set_shipping_total($order->get_shipping_total() + $recurring_shipping_total);
        $order->set_total($total + $recurring_shipping_total);
        update_post_meta($order->get_id(), 'fixed_subscription_and_regular', 1);
    }
}
///////////////////////////////////////////////// fixed total order with subscription + single

///// fixed PayPal Standard IPN save shipping change
add_action('valid-paypal-standard-ipn-request', 'fixed_paypal_standart_ipn_callback');
function fixed_paypal_standart_ipn_callback($PayPal_response)
{
    $custom = json_decode($PayPal_response['custom'], true);

    if (isset($custom['order_id'])) {
        $order_id = intval($custom['order_id']);
        if (isset($PayPal_response['address_street'])) {
            update_post_meta($order_id, '_shipping_address_1', $PayPal_response['address_street']);
        }
        if (isset($PayPal_response['address_city'])) {
            update_post_meta($order_id, '_shipping_city', $PayPal_response['address_city']);
        }
        if (isset($PayPal_response['address_state'])) {
            update_post_meta($order_id, '_shipping_state', $PayPal_response['address_state']);
        }
        if (isset($PayPal_response['address_country'])) {
            update_post_meta($order_id, '_shipping_country', $PayPal_response['address_country']);
        }
        if (isset($PayPal_response['address_zip'])) {
            update_post_meta($order_id, '_shipping_postcode', $PayPal_response['address_zip']);
        }
    }
}
///// fixed PayPal Standard IPN shipping change


/**
 * Fix shipping method for simple products
 * @author FERNANDO
 */
add_action('woocommerce_after_shipping_rate', 'reset_default_shipping_method', 20, 2);
function reset_default_shipping_method($method, $index)
{

    if (isset(WC()->session) && !WC()->session->has_session())
        WC()->session->set_customer_session_cookie(true);

    // Check if "shipping" is already set
    if (WC()->session->get('chosen_shipping_methods')[0] === 'flat_rate:2' || WC()->session->get('chosen_shipping_methods')[0] === 'flat_rate:3')
        return;

    // Set "First shipping" method
    if ($method->id === 'flat_rate:2') {
        WC()->session->set('chosen_shipping_methods', array($method->id));
    }
}
