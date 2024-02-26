<?php

/**
 * New Cart Class
 * @author Fer Catalano
 */
class Baketivity_Cart
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_filter('woocommerce_product_related_posts_query', [$this, 'show_instock_related_products'], 50, 3);
        add_action('woocommerce_check_cart_items', [$this, 'remove_coupons_on_empty_cart']);
        add_action('woocommerce_before_main_content', [$this, 'remove_coupons_on_empty_cart']);
        add_action('woocommerce_checkout_process', [$this, 'woocommerce_spoiler_alert']);
        add_action('woocommerce_before_cart', [$this, 'woocommerce_spoiler_alert']);
        add_action('woocommerce_checkout_update_order_review', [$this, 'woocommerce_spoiler_alert']);
        add_filter('woocommerce_product_single_add_to_cart_text', [$this, 'woocommerce_custom_single_add_to_cart_text'], 200, 1);
        add_action('woocommerce_after_cart_table', [$this, 'render_upsell_products_in_cart'], 20);
    }

    /*
     * get only related products in stock
     */
    public function show_instock_related_products($query, $product_id, $args)
    {
        global $wpdb;

        $query['join']  .= " LEFT JOIN {$wpdb->postmeta} as pmstock ON p.ID = pmstock.post_id ";
        $query['where'] .= " AND pmstock.meta_key = '_stock_status' AND pmstock.meta_value != 'outofstock' ";

        return $query;
    }

    public function woocommerce_custom_single_add_to_cart_text($text)
    {
        if (is_cart()) {
            return __('Add', 'baketivity');
        }
        return $text;
    }

    /* 
    * Remove all coupons from cart if cart is empty
    * @author: Fer Catalano
    * Add to cart page
    * Add to shop archives & product pages
    */
    public function remove_coupons_on_empty_cart()
    {
        if (WC()->cart->get_cart_contents_count() == 0) {
            foreach (WC()->cart->get_coupons() as $code => $coupon) {
                WC()->cart->remove_coupon($code);
            }
        }
    }

    public function woocommerce_spoiler_alert()
    {
        global $woocommerce;
        $spoiler_settings = get_field('theme_settings_spoiler_alert', 'option');
        $shop_page_url    = wc_get_page_permalink('shop');
        $enable     = $spoiler_settings['enable'];
        $minimum    = $spoiler_settings['amount'];
        $product_id = $spoiler_settings['product'];

        if ($enable == true) {

            $cart_total      = WC()->cart->total; // Cart total with tax and shipping
            $product_cart_id = WC()->cart->generate_cart_id($product_id);
            $in_cart         = WC()->cart->find_product_in_cart($product_cart_id);

            if ($cart_total < $minimum) {

                $rest = $minimum - $cart_total;

                // Remove the product from the cart
                if ($in_cart) WC()->cart->remove_cart_item($in_cart);

                if (is_cart()) {
                    if (WC()->cart->cart_contents_count > 0) {
                        wc_print_notice(
                            sprintf(
                                '<div class="spoiler-alert"><div class="content">Are you sure you want to check out? <br> You are just %s away from getting a FREE surprise gift box!</div><div class="shop-url"><a href=' . $shop_page_url . '>Continue Shopping </a></div></div>',
                                wc_price($rest),
                                wc_price($cart_total)
                            )
                        );
                    } else {
                        // refresh cart page when cart is empty after removing the product
                        wp_safe_redirect(wc_get_cart_url());
                    }
                }
            } else {

                if (is_cart()) {
                    wc_print_notice(
                        sprintf("<div class='spoiler-alert'>Nice job! You earned a FREE surprise gift box – it's been added to your cart</div>",)
                    );
                }

                if (!$in_cart) WC()->cart->add_to_cart($product_id);
            }
        }
    }

    /*
     * get related products from upsell
     * return html
     */
    public function render_upsell_products_in_cart()
    {
        $upsell_products_ids = $this->get_cart_related_products_from_upsell();

        if ($upsell_products_ids && is_array($upsell_products_ids)) {
            echo '<div class="d-term-pro cart-upsell-products">';
            echo '<h4 class="related-title-new-design">Yum! make it even sweeter!</h4>';
            echo '<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents gfgt" cellspacing="0">';
            for ($i = 0; $i < 3; $i++) {
                if ($i < count($upsell_products_ids)) {
                    set_query_var('product_id', (int)$upsell_products_ids[$i]);
                    get_template_part('woocommerce/cart/cart', 'related-product');
                    wp_reset_postdata();
                }
            }
            echo '</table>';

            if (count($upsell_products_ids) > 3) {
                echo '<div class="show-more-button-container">
                    <button class="btn-show-more-products js-show-more-products">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17.371" height="17.248" viewBox="0 0 17.371 17.248">
                            <path id="Union_1" data-name="Union 1" d="M-6189.643-6178.967a5.481,5.481,0,0,1-1.748-1.271,5.957,5.957,0,0,1-1.179-1.884,6.3,6.3,0,0,1-.432-2.308,6.3,6.3,0,0,1,.432-2.308,5.975,5.975,0,0,1,1.179-1.885,5.48,5.48,0,0,1,1.748-1.271,5.116,5.116,0,0,1,2.14-.466h0V-6192l3.744,2.4-3.744,2.4v-1.388h0a3.7,3.7,0,0,0-2.729,1.219,4.31,4.31,0,0,0-1.131,2.944,4.308,4.308,0,0,0,1.131,2.944,3.7,3.7,0,0,0,2.729,1.219,3.7,3.7,0,0,0,2.73-1.219,4.311,4.311,0,0,0,1.129-2.818h1.638a6.278,6.278,0,0,1-.431,2.182,5.947,5.947,0,0,1-1.178,1.884,5.481,5.481,0,0,1-1.748,1.271,5.119,5.119,0,0,1-2.141.466A5.116,5.116,0,0,1-6189.643-6178.967Z" transform="translate(-295.053 8752.209) rotate(47)" fill="#ee324d"></path>
                        </svg>' . __('Show more products', 'baketivity') . '</button>
                    </div>';
                echo '<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents gfgt show-more-upsell-products hidden-table" cellspacing="0">';

                for ($i = 3; $i < count($upsell_products_ids); $i++) {
                    set_query_var('product_id', (int)$upsell_products_ids[$i]);
                    get_template_part('woocommerce/cart/cart', 'related-product');
                    wp_reset_postdata();
                }
                echo '</table>';
            }
            echo '</div>';
        }
    }

    public function get_cart_related_products_from_upsell($total_items = 6)
    {
        return self::get_cart_related_products_from_linked_proudcts($total_items, false);
    }

    public static function get_cart_related_products_from_cross_sell($total_items = 4)
    {
        return self::get_cart_related_products_from_linked_proudcts($total_items, true);
    }

    /**
     * Return products mixin from cross_sell and up_sell fields based on the cart's product
     */
    public static function get_cart_related_products_from_linked_proudcts($total_items = 6, $cross_sell = false)
    {
        if (WC()->cart->is_empty()) {
            return;
        }

        $exclude_product_ids = self::get_upsell_products_to_exclude();

        $upsell_ids = [];

        // Loop through cart items
        foreach (WC()->cart->get_cart() as $cart_item) {
            // Merge all cart items upsells ids
            //$upsell_qty = $cart_item['data']->get_upsell_ids();

            if ($cross_sell) {
                $product_upsell_ids = $cart_item['data']->get_cross_sell_ids();
            } else {
                $product_upsell_ids = $cart_item['data']->get_upsell_ids();
            }
            //if upsell produdcts are not configured, we get related
            if (!$product_upsell_ids) {
                $product_upsell_ids = $cart_item['data']->get_upsell_ids();
            }

            if (count($upsell_ids) < $total_items) {
                $product_realted_ids = wc_get_related_products($cart_item['product_id'], 5, $exclude_product_ids);
            }

            $upsell_ids = array_merge($product_upsell_ids, $upsell_ids, $product_realted_ids);

            $cart_item_ids[] = $cart_item['product_id'];
        }

        // Remove cart item ids from upsells
        $upsell_ids = array_diff($upsell_ids, $cart_item_ids);
        $upsell_ids = array_unique($upsell_ids); // Remove duplicated Ids
        // Remove products to exclude
        $upsell_ids = array_diff($upsell_ids, $exclude_product_ids);

        //slice the array based on total items param
        $upsell_ids = array_slice($upsell_ids, 0, $total_items);

        return $upsell_ids;
    }

    /**
     * Returns products to exclude, eg: subscriptions, variables.
     */
    public static function get_upsell_products_to_exclude()
    {
        $products_ids = array();

        if (false === ($products_ids = get_transient('upsell_products_to_exclude'))) {
            $args = array(
                'return'    => 'ids',
                'type'      => array('subscription', 'variable-subscription', 'variable'),
                'limit'     => -1
            );
            $products_ids = wc_get_products($args);

            set_transient('upsell_products_to_exclude', $products_ids, DAY_IN_SECONDS);
        }

        return $products_ids;
    }
}

new Baketivity_Cart();
