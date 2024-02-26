<?php
/*
 * @package baketivity
 * @since baketivity
 * Amazon Pixels class 
 */
class AmazonPixels
{

    public function __construct()
    {
        add_action('wp_head', [$this, 'script_amazon_header']);
        add_action('woocommerce_thankyou', [$this, 'amazon_scripts_hook'], 20, 1);
        add_action('wp_footer', [$this, 'add_footer_scripts']);
    }

    public function script_amazon_header()
    {
        if (!is_account_page() && !is_admin() && wp_get_environment_type() == "production") : ?>
            <!-- Buy With Prime Cart -->
            <style>
                #amzn-event-bus {
                    position: fixed;
                }
            </style>
            <!-- Amazon Pixel -->
            <script>
                ! function(w, d, s, t, a) {
                    if (w.amzn) return;
                    w.amzn = a = function() {
                        w.amzn.q.push([arguments, (new Date).getTime()])
                    };
                    a.q = [];
                    a.version = "0.0";
                    s = d.createElement("script");
                    s.src = "https://c.amazon-adsystem.com/aat/amzn.js";
                    s.id = "amzn-pixel";
                    s.async = true;
                    t = d.getElementsByTagName("script")[0];
                    t.parentNode.insertBefore(s, t)
                }(window, document);
                amzn("setRegion", "NA");
                amzn("addTag", "218d783f-0903-4ce3-bb64-eb1143e8d511");
                amzn("trackEvent", "PageView");
            </script>
        <?php endif;
    }

    public function amazon_scripts_hook($order_id)
    {
        if (!is_account_page() && !is_admin() && is_wc_endpoint_url('order-received') && wp_get_environment_type() == "production") :

            $order = new WC_Order($order_id); ?>

            <!-- Amazon Pixel -->
            <script>
                amzn("setTag", "218d783f-0903-4ce3-bb64-eb1143e8d511");
            </script>
            <!-- Amazon Pixel -->
            <script>
                amzn("setUserData", {
                    email: "<?= $order->get_billing_email(); ?>",
                });
            </script>
            <!-- Amazon Pixel -->
            <script>
                amzn("trackEvent", "WooPurchase", {
                    value: <?= $order->get_total(); ?>,
                    currencyCode: "USD",
                    unitsSold: <?= $order->get_item_count(); ?>
                });
            </script>

        <?php endif;
    }

    public function add_footer_scripts()
    {
        if (wp_get_environment_type() == "production" && !is_checkout() && !is_cart()) : ?>
            <!-- Beginning of Buy With Prime Cart -->
            <script async fetchpriority='high' src='https://code.buywithprime.amazon.com/bwp.v1.js'></script>
            <div id="amzn-bwp-cart" data-site-id="fa9sxfb5f7" data-widget-id="w-2X6XTKFNzr4nnBeb6DLsC3"></div>
            <!-- End of Buy With Prime Cart -->
<?php endif;
    }
}
