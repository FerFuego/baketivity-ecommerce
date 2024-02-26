<?php

/**
 * New Checkout Class
 * @author Fer Catalano
 */
class Baketivity_Checkout
{

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_action('init', [$this, 'update_kl_is']);
        // remove action have a coupon from notifications bar
        remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
        // remove action login from notifications bar
        remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10);
        add_action('wp_head', [$this, 'animate_style'], 11);
        add_action('wp_head', [$this, 'custom_ajax_spinner'], 12);
        add_action('custom_checkout_extra_step_shipping', [$this, 'my_custom_display_payments'], 20);
        add_action('wp_ajax_nopriv_woocommerce_custom_validation', [$this, 'woocommerce_custom_validation']);
        add_action('wp_ajax_woocommerce_custom_validation', [$this, 'woocommerce_custom_validation']);
        add_action('woocommerce_new_order', [$this, 'action_woocommerce_new_order'], 10, 1);
        add_filter('woocommerce_checkout_posted_data', [$this, 'ftm_filter_checkout_posted_data'], 10, 1);
        add_filter('woocommerce_order_button_text', [$this, 'custom_button_text']);
        add_action('woocommerce_payment_complete', [$this, 'login_after_order_complete'], 10, 1);
        add_action('woocommerce_thankyou', [$this, 'login_after_order_complete'], 10, 1);
        add_filter('woocommerce_checkout_fields', [$this, 'custom_override_checkout_fields']);
        add_filter('woocommerce_shipstation_export_custom_field_3_value', [$this, 'd_date_modify_val'], 10, 2);
        add_filter('woocommerce_can_subscription_be_updated_to_new-payment-method', [$this, 'allow_zero_price_to_auto'], 10, 2);
        add_filter('manage_edit-shop_subscription_columns', [$this, 'd_set_custom_edit_shop_subscription_columns'], 100, 1);
        add_filter('gettext', [$this, 'wc_billing_field_strings'], 20, 3);
        add_action('woocommerce_thankyou', [$this, 'd_conversion_tracking_thank_you_page'], 998);
        add_action('woocommerce_thankyou', [$this, 'add_traking_script_thankyou_page'], 999);
        add_filter('woocommerce_registration_error_email_exists', [$this, 'replace_woocommerce_registration_error_email_exists']);
        add_action('wp_ajax_nopriv_get_checkout_total_order', [$this, 'get_checkout_total_order']);
        add_action('wp_ajax_get_checkout_total_order', [$this, 'get_checkout_total_order']);
        add_filter('woocommerce_checkout_get_value', [$this, 'pre_populate_checkout_fields'], 10, 2);
    }

    public function custom_override_checkout_fields($fields)
    {
        $fields['billing']['billing_first_name']['priority']     = 10;
        $fields['billing']['billing_first_name']['autocomplete'] = 'nope';
        $fields['billing']['billing_last_name']['priority']      = 20;
        $fields['billing']['billing_last_name']['autocomplete']  = 'nope';
        $fields['billing']['billing_email']['priority']          = 22;
        $fields['billing']['billing_email']['autocomplete']      = 'nope';
        $fields['billing']['billing_country']['priority']        = 30;
        $fields['billing']['billing_country']['autocomplete']    = 'nope';
        $fields['billing']['billing_company']['priority']        = 30;
        $fields['billing']['billing_company']['autocomplete']    = 'nope';
        $fields['billing']['billing_address_1']['priority']      = 40;
        $fields['billing']['billing_address_1']['autocomplete']  = 'nope';
        $fields['billing']['billing_address_2']['priority']      = 50;
        $fields['billing']['billing_address_2']['autocomplete']  = 'nope';
        $fields['billing']['billing_city']['priority']           = 70;
        $fields['billing']['billing_city']['autocomplete']       = 'nope';
        $fields['billing']['billing_postcode']['priority']       = 70;
        $fields['billing']['billing_postcode']['autocomplete']   = 'nope';
        $fields['billing']['billing_state']['priority']          = 80;
        $fields['billing']['billing_state']['autocomplete']      = 'nope';
        $fields['billing']['billing_phone']['priority']          = 90;
        $fields['billing']['billing_phone']['autocomplete']      = 'nope';
        $fields['shipping']['shipping_first_name']['autocomplete'] = 'nope';
        $fields['shipping']['shipping_last_name']['autocomplete'] = 'nope';
        $fields['shipping']['shipping_phone'] = array(
            'label' => 'Phone',
            'required' => true,
            'autocomplete' => 'nope',
            'class' => array('form-row-wide', 'form-row-first'),
            'priority' => 90,
        );
        $fields['shipping']['shipping_email'] = array(
            'label' => 'Email',
            'required' => true,
            'autocomplete' => 'nope',
            'class' => array('form-row-wide', 'form-row-first'),
            'priority' => 100,
        );

        $fields['billing']['billing_company']['label'] = "Child’s name (Kids love mail! <span class='d-h-mb'>We recommend adding their names here</span>)";
        $fields['billing']['billing_company']['maxlength'] = 29;
        $fields['shipping']['shipping_company']['label'] = "Child’s name (Kids love mail! <span class='d-h-mb'>We recommend adding their names here</span>)";
        $fields['shipping']['shipping_company']['autocomplete'] = 'nope';
        $fields['shipping']['shipping_company']['maxlength'] = 29;
        $fields['shipping']['shipping_address_1']['autocomplete'] = 'nope';
        $fields['shipping']['shipping_address_2']['autocomplete'] = 'nope';
        $fields['shipping']['shipping_city']['autocomplete'] = 'nope';
        $fields['shipping']['shipping_state']['autocomplete'] = 'nope';
        $fields['shipping']['shipping_postcode']['autocomplete'] = 'nope';
        $fields['order']['order_comments']['autocomplete'] = 'nope';

        unset($fields['billing']['billing_company']);
        unset($fields['shipping']['shipping_phone']);
        unset($fields['shipping']['shipping_email']);

        return $fields;
    }

    /**
     * Shipstation export date formatting
     */
    public function d_date_modify_val($val, $order_id)
    {
        $val = false;
        $hold_unlti_date =  get_post_meta($order_id, 'sub_start_date', true);
        $today = date("Y-m-d");

        if (strtotime($hold_unlti_date) > strtotime($today)) {
            $val = $hold_unlti_date;
        }

        return $val;
    }

    /**
     * Source: https://woo.com/es-es/feature-request/option-to-apply-updated-payment-method-to-existing-subscriptions/
     */
    function allow_zero_price_to_auto($can_be_updated, $sub)
    {
        if ($sub->payment_method_supports('subscription_reactivation')  &&  $sub->payment_method_supports('subscription_date_changes') && $sub->is_manual() && $sub->get_total() == 0) {
            $can_be_updated = true;
        }
        return $can_be_updated;
    }

    //Let the user checkout as guest even if they have an account
    public function ftm_filter_checkout_posted_data($data)
    {
        $email = $data['billing_email'];
        if (email_exists($email)) $data['createaccount'] = 0;
        return $data;
    }

    // Assign user in guest order
    public function action_woocommerce_new_order($order_id)
    {
        $order = new WC_Order($order_id);
        $user = $order->get_user();

        if (!$user) {
            //unlogged user but user exists
            $userdata = get_user_by('email', $order->get_billing_email());

            if (isset($userdata->ID)) {
                // setcookie to autologin
                wp_set_current_user($userdata->ID, $userdata->user_login);
                wp_set_auth_cookie($userdata->ID, true);
                do_action('wp_login', $userdata->user_login, $userdata);
                //registered
                wc_update_new_customer_past_orders($userdata->ID);
            } else {
                //Guest customer
                $this->create_new_user($order);
            }
        }
    }

    // Create new user
    public function create_new_user($order)
    {
        // random password with 12 chars
        $random_password = wp_generate_password();

        // create new user with email as username & newly created pw
        $user_id = wp_create_user($order->get_billing_first_name(), $random_password, $order->get_billing_email());

        //WC guest customer identification
        update_user_meta($user_id, 'guest', 'yes');

        //user's billing data
        update_user_meta($user_id, 'billing_address_1', $order->get_billing_address_1());
        update_user_meta($user_id, 'billing_address_2', $order->get_billing_address_2());
        update_user_meta($user_id, 'billing_city',      $order->get_billing_city());
        update_user_meta($user_id, 'billing_company',   $order->get_billing_company());
        update_user_meta($user_id, 'billing_country',   $order->get_billing_country());
        update_user_meta($user_id, 'billing_email',     $order->get_billing_email());
        update_user_meta($user_id, 'billing_first_name', $order->get_billing_first_name());
        update_user_meta($user_id, 'billing_last_name', $order->get_billing_last_name());
        update_user_meta($user_id, 'billing_phone',     $order->get_billing_phone());
        update_user_meta($user_id, 'billing_postcode',  $order->get_billing_postcode());
        update_user_meta($user_id, 'billing_state',     $order->get_billing_state());

        // user's shipping data
        update_user_meta($user_id, 'shipping_address_1', $order->get_shipping_address_1());
        update_user_meta($user_id, 'shipping_address_2', $order->get_shipping_address_2());
        update_user_meta($user_id, 'shipping_city',      $order->get_shipping_city());
        update_user_meta($user_id, 'shipping_company',   $order->get_shipping_company());
        update_user_meta($user_id, 'shipping_country',   $order->get_shipping_country());
        update_user_meta($user_id, 'shipping_first_name', $order->get_shipping_first_name());
        update_user_meta($user_id, 'shipping_last_name', $order->get_shipping_last_name());
        update_user_meta($user_id, 'shipping_method',    $order->get_shipping_method());
        update_user_meta($user_id, 'shipping_postcode',  $order->get_shipping_postcode());
        update_user_meta($user_id, 'shipping_state',     $order->get_shipping_state());

        // link past orders to this newly created customer
        wc_update_new_customer_past_orders($user_id);

        setcookie('user_login', $order->get_billing_first_name(), time() + (86400 * 30), COOKIEPATH, COOKIE_DOMAIN, false, false); // 86400 = 1 day
        setcookie('user_pswd', $random_password, time() + (86400 * 30), COOKIEPATH, COOKIE_DOMAIN, false, false); // 86400 = 1 day
        setcookie('remember', true, time() + (86400 * 30), COOKIEPATH, COOKIE_DOMAIN, false, false); // 86400 = 1 day
    }

    //Change the Billing Details checkout label
    public function wc_billing_field_strings($translated_text, $text, $domain)
    {
        switch ($translated_text) {
            case 'Billing details':
                $translated_text = __('2. Billing & Shipping', 'woocommerce');
                break;
        }
        return $translated_text;
    }

    public function login_after_order_complete($order_id)
    {
        // get order
        $order = new WC_Order($order_id);
        // check if user not logged in
        if ($order && !is_user_logged_in()) {
            // check if isset cookies
            if (isset($_COOKIE['user_login'])) {
                // get cookies
                $creds['user_login']    = $_COOKIE['user_login'];
                $creds['user_password'] = $_COOKIE['user_pswd'];
                $creds['remember']      = $_COOKIE['remember'];
                // login
                wp_signon($creds, true);
            }
        }
    }

    public function custom_button_text($button_text)
    {
        return 'Place your order'; // new text is here 
    }

    /**
     * Change default spinner loader
     */
    public function custom_ajax_spinner()
    {
        if (is_cart() || is_checkout()) : ?>
            <style>
                .woocommerce .blockUI.blockOverlay:before,
                .cart-collaterals .blockUI.blockOverlay:before,
                .woocommerce .loader:before {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    margin-left: -.5em;
                    margin-top: -.5em;
                    display: block;
                    content: "";
                    -webkit-animation: none;
                    -moz-animation: none;
                    animation: none;
                    background-size: cover;
                    line-height: 1;
                    text-align: center;
                    font-size: 2em;
                    border: 4px solid rgba(0, 0, 0, 0.1) !important;
                    width: 36px;
                    height: 36px;
                    border-radius: 50%;
                    border-left-color: #ee324d !important;
                    animation: spin 1s ease infinite !important;
                }
            </style>
        <?php else : ?>
            <style>
                /* Fix to sidecart */
                .woocommerce .blockUI.blockOverlay:before,
                .cart-collaterals .blockUI.blockOverlay:before,
                .woocommerce .loader:before {
                    display: none;
                }
            </style>
        <?php endif;
    }

    /**
     * Add Animate.css Library
     */
    public function animate_style()
    {
        if (is_cart() || is_checkout()) :
            // enqueue cdn style
            wp_enqueue_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
        endif;
    }

    /**
     * Moving the payments
     * Displaying the Payment Gateways
     * Include Terms and Conditions
     * TODO: Review if this is needed
     */
    public function my_custom_display_payments()
    {
        if (WC()->cart->needs_payment()) {
            $available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
            WC()->payment_gateways()->set_current_gateway($available_gateways);
        } else {
            $available_gateways = array();
        } ?>
        <div class="payment-methods" id="checkout_payments">
            <div class="summary-loader js-payment-loader">
                <span></span>
            </div>
            <?php if (WC()->cart->needs_payment()) : ?>
                <ul class="wc_payment_methods payment_methods methods">
                    <?php
                    if (!empty($available_gateways)) {
                        foreach ($available_gateways as $gateway) {
                            wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
                        }
                    } else {
                        echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce')) . '</li>'; // @codingStandardsIgnoreLine
                    }
                    ?>
                </ul>
            <?php endif; ?>

            <?php wc_get_template('checkout/terms.php'); ?>

            <!-- Place Order Button - Only Mobile -->
            <?php if (wp_is_mobile()) :

                $order_button_text = apply_filters('woocommerce_order_button_text', __('Place your order', 'woocommerce'));

                if (!wp_doing_ajax()) {
                    // Show Place Order on Mobile   
                    echo '<div class="woocommerce_checkout_place_order_container">
                    <input id="place_order" class="woocommerce_checkout_place_order button" name="woocommerce_checkout_place_order" type="submit" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '" />
                    </div>';

                    // Fix to show Paypal button
                    do_action('woocommerce_review_order_after_payment');
                }
            endif; ?>
        </div>
    <?php
    }

    /**
     * Checkout extra fields Validation
     * TODO: let better use native validation
     */
    public function woocommerce_custom_validation()
    {
        $response = array();
        $response['status'] = 'success';
        $response['message'] = array();

        if (empty($_POST['billing_country'])) {
            $response['status'] = 'error';
            $response['field'] = 'billing_country';
            array_push($response['message'], 'Please confirm your country.');
        }

        if (empty($_POST['billing_email'])) {
            $response['status'] = 'error';
            $response['field'] = 'billing_email';
            array_push($response['message'], 'Please confirm your email.');
        }

        if ($_POST['billing_email'] && !WC_Validation::is_email($_POST['billing_email'])) {
            $response['status'] = 'error';
            $response['field'] = 'billing_email';
            array_push($response['message'], 'Please enter a valid email.');
        }

        if ($_POST['billing_postcode'] && !WC_Validation::is_postcode($_POST['billing_postcode'], $_POST['billing_country'])) {
            $response['status'] = 'error';
            $response['field'] = 'billing_postcode';
            array_push($response['message'], 'Please enter a valid postcode/ZIP.');
        }

        if (isset($_POST['shipping_postcode']) && $_POST['shipping_postcode'] !== '' && isset($_POST['shipping_country']) && $_POST['shipping_country'] !== '') {
            if ($_POST['shipping_postcode'] && !WC_Validation::is_postcode($_POST['shipping_postcode'], $_POST['shipping_country'])) {
                $response['status'] = 'error';
                $response['field'] = 'shipping_postcode';
                array_push($response['message'], 'Please enter a valid postcode/ZIP.');
            }
        }

        if (class_exists('Baketivity_Starter_Kit')) {
            if (isset($_POST['billing_email']) && $_POST['billing_email'] !== '') {
                if (!Baketivity_Starter_Kit::is_first_time_buyer_email($_POST['billing_email'])) {
                    $response['status'] = 'error';
                    $response['field'] = 'billing_email';
                    array_push($response['message'], 'You cannot purchase a starter kit because you already have orders placed.');
                }
            }
        }

        wp_send_json($response);
    }

    /* 
    * Admin - Add the custom columns to the subscription
    */
    function d_set_custom_edit_shop_subscription_columns($columns)
    {
        $columns['dshippng_address'] = __('Shipping address', 'bake');
        return $columns;
    }

    /*
    * Klaviyo Conversion Tracking
    */
    public function update_kl_is()
    {
        remove_action('woocommerce_after_checkout_form', 'wck_insert_checkout_tracking');
        add_action('woocommerce_after_checkout_form', [$this, 'wck_insert_checkout_tracking_updated']);
    }

    /*
    * Klaviyo Conversion Tracking
    */
    public function wck_insert_checkout_tracking_updated($checkout)
    {

        global $current_user;
        wp_reset_query();
        wp_get_current_user();

        $cart = WC()->cart;
        $event_data = array(
            '$service' => 'woocommerce',
            'CurrencySymbol' => get_woocommerce_currency_symbol(),
            'Currency' => get_woocommerce_currency(),
            '$value' => $cart->total,
            '$extra' => array(
                'Items' => array(),
                'SubTotal' => $cart->subtotal,
                'ShippingTotal' => $cart->shipping_total,
                'TaxTotal' => $cart->tax_total,
                'GrandTotal' => $cart->total
            )
        );
        $wck_cart = array();
        $composite_products = array();
        $normal_products = array();
        $allcategories = array();
        $month = '';

        foreach ($cart->get_cart() as $cart_item_key => $values) {
            $product = $values['data'];
            $parent_product_id = $product->get_parent_id();

            if ($product->get_parent_id() == 0) {
                $parent_product_id = $product->get_id();
            }
            $categories_array = get_the_terms($parent_product_id, 'product_cat');
            if ($categories_array && !is_wp_error($categories_array)) {
                $categories = wp_list_pluck($categories_array, 'name');

                foreach ($categories as $category) {
                    array_push($allcategories, $category);
                }
            }

            $is_composite_child = false;

            if (class_exists('WC_Composite_Products')) {
                $product_encoded = json_encode($product);
                $is_composite_child = wc_cp_is_composited_cart_item($values);
                $container = wc_cp_get_composited_cart_item_container($values);

                if ($product->get_type() == 'composite') {
                    $composite_product = array();

                    foreach (wc_cp_get_composited_cart_items($values) as $key => $val) {
                        $composite_product = add_encoded_composite($val['composite_data'], $values);
                        break;
                    }
                    array_push($composite_products, $composite_product);
                } else {
                    if (!$is_composite_child) {
                        $normal_products[$cart_item_key] = normalize_normal_product($values);
                    }
                }
            } else {
                $normal_products[$cart_item_key] = $values;
            }

            $image = wp_get_attachment_url(get_post_thumbnail_id($product->get_id()));

            if ($image == false) {
                $image = wp_get_attachment_url(get_post_thumbnail_id($parent_product_id));
            }

            $event_data['$extra']['Items'][] = array(
                'Quantity' => $values['quantity'],
                'ProductID' => $parent_product_id,
                'VariantID' => $product->get_id(),

                'Name' => $product->get_name(),
                'URL' => $product->get_permalink(),
                'Images' => array(
                    array(
                        'URL' => $image
                    )
                ),
                'Categories' => $categories,
                'Variation' => $values['variation'],
                'SubTotal' => $values['line_subtotal'],
                'Total' => $values['line_subtotal_tax'],
                'LineTotal' => $values['line_total'],
                'Tax' => $values['line_tax'],
                'TotalWithTax' => $values['line_total'] + $values['line_tax']
            );
            if (!empty($values['variation']['attribute_month'])) {
                $month = $values['variation']['attribute_month'];
            }

            $allcategories = array_unique($allcategories);
            $event_data['Categories'] = $allcategories;
        }

        // if(!empty($month)){
        $event_data['Month'] = $month;
        // }

        if (empty($event_data['$extra']['Items'])) {
            return;
        }
        // Set top-level item names
        $itemNames = array();
        foreach ($event_data['$extra']['Items'] as $val) {
            array_push($itemNames, $val['Name']);
        }
        $event_data['ItemNames'] = $itemNames;
        // current user email
        $email = '';
        if (is_user_logged_in()) {
            $email = $current_user->user_email;
        } else {
            $email = $checkout->get_value('billing_email');
        }
        $wck_cart['composite'] = $composite_products;
        $wck_cart['normal_products'] = $normal_products;
        $event_data['$extra']['CartRebuildKey'] = base64_encode(json_encode($wck_cart));

        $started_checkout_data = array(
            'email' => $email,
            'event_data' => $event_data
        );

        // Pass Started Checkout event data to javascript attaching to 'wck_started_checkout' handle
        wp_localize_script('wck_started_checkout', 'kl_checkout', $started_checkout_data);
    }

    /*
    * Klaviyo Conversion Tracking
    */
    public function d_conversion_tracking_thank_you_page($order_id)
    {

        if (is_checkout() && !empty(is_wc_endpoint_url('order-received'))) {
            $order = wc_get_order($order_id);
            $date = $order->order_date;
            $subscriptions = wcs_get_subscriptions(array('order_id' => $order_id));

            if ($subscriptions) {
                foreach ($subscriptions as $subscription) {
                    // Iterating through subscription items
                    foreach ($subscription->get_items() as $item_id => $product_subscription) {
                        // Get the name
                        $product_name = $product_subscription->get_name();
                    }

                    $recipient_email   = get_post_meta($order_id, '_recipient_email', true);
                    $recipient_message = get_post_meta($order_id, '_recipient_message', true);

                    if ($recipient_email) {
                        echo "<script>
                            var WCK = WCK || {};
                            WCK.dtrackStartedCheckout = function() {
                                var event_object = {
                                    'token': public_key.token,
                                    'event': 'Gift Subscription',
                                    'customer_properties': {
                                        'email': '" .  $recipient_email . "',
                                        'Order ID': '" . $order_id . "',
                                        'Date': '" . $date . "',
                                        'Product Title': '" . $product_name . "',
                                        'Message': '" . $recipient_message . "',
                                        'Subscription ID ': '" . $subscription->get_id() . "',
                                    },
                                };

                                makePublicAPIcall('track', event_object);
                            };

                            WCK.dtrackStartedCheckout();
                        </script>";
                    }
                }
            }
        }
    }

    /*
    * Shopper Approved Tracking
    */
    public function add_traking_script_thankyou_page($order_id)
    {
        $order = wc_get_order($order_id);
    ?>
        <!-- Shopper Approved script -->
        <script type="text/javascript">
            var sa_values = {
                "site": 36641,
                "token": "b47jNhRQ",
                "orderid": "<?php echo $order->get_id(); ?>",
                "name": "<?php echo $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(); ?>",
                "email": "<?php echo $order->get_billing_email(); ?>",
                "country": "<?php echo $order->get_billing_country(); ?>"
            };

            function saLoadScript(src) {
                var js = window.document.createElement("script");
                js.src = src;
                js.type = "text/javascript";
                document.getElementsByTagName("head")[0].appendChild(js);
            }
            saLoadScript("https://www.shopperapproved.com/thankyou/rate/36641.js")
        </script>
        <!-- End Shopper Approved script -->

        <!-- Use of this pixel is subject to the Amazon ad specs and policies at http://www.amazon.com/b/?&node=7253015011 -->
        <script type='text/javascript'>
            window.onload = function() {
                var _pix = document.getElementById('_pix_id_73c13fc6-1cce-6aa5-8633-88ebfab54cb5');
                if (!_pix) {
                    var protocol = '//';
                    var a = Math.random() * 1000000000000000000;
                    _pix = document.createElement('iframe');
                    _pix.style.display = 'none';
                    _pix.setAttribute('src', protocol + 's.amazon-adsystem.com/iu3?d=generic&ex-fargs=%3Fid%3D73c13fc6-1cce-6aa5-8633-88ebfab54cb5%26type%3D29%26m%3D1&ex-fch=416613&ex-src=https://baketivity.com/&ex-hargs=v%3D1.0%3Bc%3D588912635915411416%3Bp%3D73C13FC6-1CCE-6AA5-8633-88EBFAB54CB5' + '&cb=' + a);
                    _pix.setAttribute('id', '_pix_id_73c13fc6-1cce-6aa5-8633-88ebfab54cb5');
                    document.body.appendChild(_pix);
                }
            }
        </script>
        <noscript> <img height='1' width='1' border='0' alt='' src='https://s.amazon-adsystem.com/iui3?d=forester-did&ex-fargs=%3Fid%3D73c13fc6-1cce-6aa5-8633-88ebfab54cb5%26type%3D29%26m%3D1&ex-fch=416613&ex-src=https://baketivity.com/&ex-hargs=v%3D1.0%3Bc%3D588912635915411416%3Bp%3D73C13FC6-1CCE-6AA5-8633-88EBFAB54CB5'   /></noscript>
        <!-- End Amazon Pixel Code -->
<?php
    }

    public function replace_woocommerce_registration_error_email_exists()
    {
        return 'An account is already registered with your email address. Please <a href="/checkout" class="woocommerce-error__login-link"><strong>Sign in</strong></a>';
    }

    public function get_checkout_total_order()
    {
        return wc_cart_totals_order_total_html();
    }

    /**
     * Pre-populate Woocommerce checkout fields
     * Note that this filter populates shipping_ and billing_ fields with a different meta field eg 'first_name'
     */
    public function pre_populate_checkout_fields($fields, $key = '')
    {
        global $current_user;

        switch ($key):
            case 'billing_first_name':
            case 'shipping_first_name':
                return $current_user->first_name;
                break;

            case 'billing_last_name':
            case 'shipping_last_name':
                return $current_user->last_name;
                break;

            case 'billing_email':
                return $current_user->user_email;
                break;

            case 'billing_phone':
                return $current_user->phone;
                break;

        endswitch;
    }
}
