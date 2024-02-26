<?php

/**
 * Add Starter Kit class
 * 
 * @author: Fer Catalano
 * @description: This code will allow you to add the Starter Kit to the cart only once and without any other product.
 * 
 * First time buyers only
 * Limited to a single purchase (set in the product settings)
 * Cannot be purchased together with another promotion or product
 * Coupons cannot be used with this offer
 * The express shipping option is disabled or hidden in the shopping cart/checkout.
 */

class Baketivity_Starter_Kit
{

    public $product_sk              = null;
    public $active_starter_kit      = false;
    public $delivery_message_kit    = '';
    public $delivery_message_coupon = '';
    public $delivery_message_error  = '';

    public function __construct()
    {
        // get data from ACF
        $this->active_starter_kit       = get_field('active_starter_kit', 'option');
        $this->product_sk               = get_field('product_starter_kit', 'option');
        $this->delivery_message_kit     = get_field('delivery_message_kit', 'option');
        $this->delivery_message_coupon  = get_field('delivery_message_coupon', 'option');
        $this->delivery_message_error   = get_field('delivery_message_error', 'option');
        // check if starter kit is active
        if (!$this->active_starter_kit) return;
        // check if product starter kit is set
        if (!$this->product_sk) return;
        // check if not is admin page
        if (is_admin()) return;
        // do actions
        add_action('wp_loaded', [$this, 'cart_starter_kit_rule']);
        add_action('wp_footer', [$this, 'starter_kit_error_styles']);
        add_action('woocommerce_before_cart', [$this, 'check_if_product_in_cart']);
        add_action('woocommerce_add_to_cart', [$this, 'custom_add_to_cart'], 10, 2);
        add_filter('woocommerce_coupon_is_valid_for_product', [$this, 'set_coupon_invalid_for_product'], 12, 4);
        add_action('woocommerce_checkout_process', [$this, 'custom_validation_shipping_field']);
    }

    function check_if_product_in_cart()
    {
        $product_id = $this->product_sk;

        if (WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product_id))) {
            // Remove Free Shipping Meter
            remove_action('free_shipping_meter_action', ['Free_Shipping_Meter', 'free_shipping_meter_html']); // quickcart
            remove_action('woocommerce_before_cart_totals', ['Free_Shipping_Meter', 'free_shipping_meter_html']); // cart
            remove_action('free_shipping_meter_action', ['Free_Shipping_Meter', 'force_free_shipping_meter']);
            add_action('wp_footer', [$this, 'starter_kit_styles']);
        }
    }

    // Only works for registered users
    public function is_first_time_buyer()
    {
        // get current user
        $user_id = get_current_user_id();
        // get orders of current user
        $orders = wc_get_orders([
            'customer_id' => $user_id,
            'limit' => 2,
        ]);
        // return false if has orders
        if (count($orders) > 0 && $user_id > 0) return false;

        return true;
    }

    // Only works for unlogged users
    public static function is_first_time_buyer_email($email)
    {
        $product_id = get_field('product_starter_kit', 'option');
        $active = get_field('active_starter_kit', 'option');

        if (!$email) return true;
        // check if starter kit is active
        if (!$active) return true;
        // check if product starter kit is set
        if (!$product_id) return true;

        // check if product is starter kit in the cart
        if (WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product_id))) {
            // get user by email
            $user = get_user_by('email', $email);
            // get orders of current user
            $orders = wc_get_orders([
                'customer_id' => $user->ID,
                'limit' => 2,
            ]);
            // return false if has orders
            if (count($orders) > 0 && $user->ID > 0) return false;
        }

        return true;
    }

    public function custom_add_to_cart($key, $product_id)
    {
        // check if product is starter kit
        if (!$this->is_first_time_buyer() && $product_id == $this->product_sk) {
            // remove starter kit from cart
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                if ($cart_item['product_id'] == $this->product_sk) {
                    WC()->cart->remove_cart_item($cart_item_key);
                }
            }
            // remove other notification
            wc_clear_notices();
            add_filter('wc_add_to_cart_message_html', '__return_false');
            // send notification
            // wc_add_notice( $this->delivery_message_error, 'error' );
            // send notification into quickcart
            add_action('baketivity_starter_kit_action', [$this, 'baketivity_starter_kit_html_error']); // quickcart

            return false;
        }

        // check if cart is empty
        $cart = WC()->cart;
        if (!$cart) return;

        // Get cart content
        $cart = WC()->cart->get_cart();

        // check if cart has starter kit
        $product_ids = array_column($cart, 'product_id');
        if (!in_array($this->product_sk, $product_ids)) return;

        // loop items in cart
        foreach ($cart as $cart_item_key => $cart_item) {
            // if product is not starter kit
            if ($cart_item['product_id'] != $this->product_sk) {
                // Send notification into quickcart
                add_action('baketivity_starter_kit_action', [$this, 'baketivity_starter_kit_html']); // quickcart
                // remove item from cart
                WC()->cart->remove_cart_item($cart_item_key);
            }
        }
        // Remove Free Shipping Meter
        add_action('baketivity_starter_kit_action', [$this, 'baketivity_starter_kit_active']);
        // Remove coupon form
        //add_filter( 'woocommerce_coupons_enabled', false );
    }

    public function cart_starter_kit_rule()
    {
        // check if cart is empty
        $cart = WC()->cart;
        if (!$cart) return;

        // Get cart content
        $cart = WC()->cart->get_cart();

        // check if cart has starter kit
        $product_ids = array_column($cart, 'product_id');
        if (!in_array($this->product_sk, $product_ids)) return;

        // check if is first time buyer
        if (!$this->is_first_time_buyer()) {
            // remove starter kit from cart
            foreach ($cart as $cart_item_key => $cart_item) {
                if ($cart_item['product_id'] == $this->product_sk) {
                    WC()->cart->remove_cart_item($cart_item_key);
                }
            }
            // send notification
            wc_clear_notices();
            wc_add_notice($this->delivery_message_error, 'error');
            return;
        }

        // loop items in cart
        foreach ($cart as $cart_item_key => $cart_item) {
            // if product is not starter kit
            if ($cart_item['product_id'] != $this->product_sk) {
                // remove item from cart
                WC()->cart->remove_cart_item($cart_item_key);
            }
        }

        // Remove coupon form
        //add_filter( 'woocommerce_coupons_enabled', false );

        // add styles to hide Express Shipping method
        add_action('wp_footer', [$this, 'starter_kit_styles']);

        if (is_checkout() || is_page_template('checkout-page.php') || is_page_template('checkout') || is_page_template('template_pages/checkout-page.php')) return;

        // Send notification
        if (!wc_has_notice($this->delivery_message_kit, 'success') && $_SERVER['REQUEST_URI'] === '/cart/') {
            wc_clear_notices();
            //wc_add_notice( $this->delivery_message_kit, 'success' );
        }
    }

    public function baketivity_starter_kit_active()
    {
        ob_start(); ?>
        <script>
            jQuery('.free-shipping-meter').fadeOut(160);
        </script>
    <?php
        $content = ob_get_clean();
        echo $content;
    }

    public function baketivity_starter_kit_html()
    {
        ob_start(); ?>
        <div class="baketivity-starter-kit">
            <div class="baketivity-starter-kit__title"><?php echo $this->delivery_message_kit; ?></div>
        </div>
        <script>
            jQuery('.free-shipping-meter').fadeOut(160);
        </script>
    <?php
        $content = ob_get_clean();
        echo $content;
    }

    public function baketivity_starter_kit_html_error()
    {
        ob_start(); ?>
        <div class="baketivity-starter-kit">
            <div class="baketivity-starter-kit__title"><?php echo $this->delivery_message_error; ?></div>
        </div>
        <?php
        $content = ob_get_clean();
        echo $content;
    }

    public function starter_kit_styles()
    {
        // hide Express Shipping method
        echo '<style> ul#shipping_method li:last-child { display: none !important; } </style>';
        // hide Coupon form
        //echo '<style> .coupon-form-toggle { display: none; } </style>';
        // hide Free Shipping Method
        echo "<style> .free-shipping-meter { display: none !important; } </style>";
    }

    public function starter_kit_error_styles()
    {
        if (!is_checkout() && !is_cart()) : ?>
            <script>
                jQuery(function($) {
                    var initInterval = window.setInterval(crazyTimer, 3000);

                    function crazyTimer() {
                        if ($('.woocommerce-error').length) {
                            remove_woo_error();
                        }
                    }

                    function remove_woo_error() {
                        var wooError = $('.woocommerce-error');
                        setTimeout(function() {
                            wooError.fadeOut(160);
                        }, 2000);
                    }
                });
            </script>
            <style>
                .woocommerce-error {
                    position: fixed !important;
                    width: 600px !important;
                    background-color: red !important;
                    z-index: 3 !important;
                    right: 0 !important;
                    font-family: "FilsonPro" !important;
                    font-size: 16px;
                    top: 160px !important;
                    padding: 15px;
                }
            </style>
            <style>
                .baketivity-starter-kit {
                    background-color: #ee324d !important;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 10px;
                    padding: 10px;
                    position: relative;
                    margin-bottom: 15px;
                    height: 60px;
                    width: 100%;
                }

                .baketivity-starter-kit__title {
                    font-family: 'FilsonPro', sans-serif;
                    font-size: 14px;
                    font-weight: 400;
                    line-height: 19px;
                    margin-bottom: 0px;
                    text-align: left;
                    display: inline-flex;
                    align-items: center;
                    color: #fff;
                }

                .baketivity-starter-kit__title::before {
                    font-family: 'Font Awesome 5 Free';
                    content: '';
                    display: block;
                    position: relative;
                    margin-right: 10px;
                    color: #fff;
                }
            </style>
<?php endif;
    }

    // Hacer que los cupones no sean válidos a nivel de producto
    public function set_coupon_invalid_for_product($valid, $product, $coupon, $values)
    {
        if ($this->product_sk === $product->get_id()) {
            $valid = false;
        }

        return $valid;
    }

    public function custom_validation_shipping_field()
    {
        // check if product is starter kit in the cart
        if (WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($this->product_sk))) {
            // get user by email
            $user = get_user_by('email', $_POST['billing_email']);
            // get orders of current user
            $orders = wc_get_orders([
                'customer_id' => $user->ID,
                'limit' => 2,
            ]);
            // add notice
            wc_add_notice($this->delivery_message_error, 'error');
            // return false if has orders
            if (count($orders) > 0 && $user->ID > 0) return false;
        }
    }
}
