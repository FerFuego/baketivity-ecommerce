<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> style="margin-top: 0 !important;">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <meta name="p:domain_verify" content="8ee47cf10a2d70a8d8c1a7279aa7e731" />
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <?php if (wp_get_environment_type() == "production") { ?>
        <link rel="preconnect" href="https://google-analytics.com/">
        <link rel="preconnect" href="https://beacon-v2.helpscout.net/">
        <link rel="preconnect" href="https://static-tracking.klaviyo.com/">
        <link rel="preconnect" href="https://analytics.tiktok.com/">
    <?php } ?>
    <?php wp_head(); ?>
    <?php if (wp_get_environment_type() == "production") { ?>
        <script>
            ! function(w, d, t) {
                w.TiktokAnalyticsObject = t;
                var ttq = w[t] = w[t] || [];
                ttq.methods = ["page", "track", "identify", "instances", "debug", "on", "off", "once", "ready", "alias",
                    "group", "enableCookie", "disableCookie"
                ], ttq.setAndDefer = function(t, e) {
                    t[e] = function() {
                        t.push([e].concat(Array.prototype.slice.call(arguments, 0)))
                    }
                };
                for (var i = 0; i < ttq.methods.length; i++) ttq.setAndDefer(ttq, ttq.methods[i]);
                ttq.instance = function(t) {
                    for (var e = ttq._i[t] || [], n = 0; n < ttq.methods.length; n++) ttq.setAndDefer(e, ttq.methods[n]);
                    return e
                }, ttq.load = function(e, n) {
                    var i = "https://analytics.tiktok.com/i18n/pixel/events.js";
                    ttq._i = ttq._i || {}, ttq._i[e] = [], ttq._i[e]._u = i, ttq._t = ttq._t || {}, ttq._t[e] = +new Date,
                        ttq._o = ttq._o || {}, ttq._o[e] = n || {};
                    var o = document.createElement("script");
                    o.type = "text/javascript", o.async = !0, o.src = i + "?sdkid=" + e + "&lib=" + t;
                    var a = document.getElementsByTagName("script")[0];
                    a.parentNode.insertBefore(o, a)
                };

                ttq.load('C3MV4QR3G487IS97GFI0');
                ttq.page();
            }(window, document, 'ttq');
        </script>
        <!-- DO NOT MODIFY -->

        <script type="text/javascript">
            ! function(e, t, n) {
                function a() {
                    var e = t.getElementsByTagName("script")[0],
                        n = t.createElement("script");
                    n.type = "text/javascript", n.async = !0, n.src = "https://beacon-v2.helpscout.net", e.parentNode
                        .insertBefore(n, e)
                }
                if (e.Beacon = n = function(t, n, a) {
                        e.Beacon.readyQueue.push({
                            method: t,
                            options: n,
                            data: a
                        })
                    }, n.readyQueue = [], "complete" === t.readyState) return a();
                e.attachEvent ? e.attachEvent("onload", a) : e.addEventListener("load", a, !1)
            }(window, document, window.Beacon || function() {});
        </script>
        <script type="text/javascript">
            window.Beacon('init', '68878b8d-2c34-49da-ab9a-1d3f32063680')
        </script>

        <!-- Clarity -->
        <script type="text/javascript">
            (function(c, l, a, r, i, t, y) {
                c[a] = c[a] || function() {
                    (c[a].q = c[a].q || []).push(arguments)
                };
                t = l.createElement(r);
                t.async = 1;
                t.src = "https://www.clarity.ms/tag/" + i;
                y = l.getElementsByTagName(r)[0];
                y.parentNode.insertBefore(t, y);
            })(window, document, "clarity", "script", "ck0rnzyvkw");
        </script>
    <?php } ?>
</head>

<body <?php body_class(); ?>>

    <?php do_action('baketivity_insert_after_open_body'); ?>

    <?php if (wp_get_environment_type() == "production") { ?>
        <!-- Google Tag Manager (noscript) -->
        <?php if (!is_account_page()) : ?>
            <noscript>
                <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M9T5R8J" height="0" width="0" style="display:none;visibility:hidden"></iframe>
            </noscript>
        <?php endif ?>
        <!-- End Google Tag Manager (noscript) -->
    <?php } ?>

    <?php do_action('baketivity_before_site');  ?>

    <header class="header-checkout" role="banner">
        <div class="header-checkout__container">
            <div class="header-checkout__col-full">
                <div class="header-checkout__site-logo">
                    <a href="<?php echo esc_url(home_url()); ?>" class="custom-logo-link" rel="home">
                        <img src="<?php echo esc_url(home_url()) . '/wp-content/themes/baketivity/images/logo-red.png'; ?>" class="custom-logo" alt="logo-alt-red" width="103" height="30">
                    </a>
                </div>
                <div class="baketivity-primary-navigation">
                    <div class="tab-pane-back">
                        <a class="tab-pane-back__link" href="<?php echo esc_url(home_url()); ?>"><?php echo __('Back to Your Cart', 'baketivity'); ?></a>
                    </div>
                    <div class="tab-pane-checkout">
                        <?php if (!is_wc_endpoint_url('order-received')) : ?>
                            <?php if (is_cart()) : ?>
                                <div class="tab-pane-checkout__title"><?php echo __('Your Cart', 'baketivity'); ?></div>
                            <?php endif; ?>

                            <?php if (is_checkout() && !isset($_GET['summary'])) : ?>
                                <div class="tab-pane-checkout__title"><?php echo __('Checkout', 'baketivity'); ?></div>
                            <?php endif; ?>

                            <?php if (is_checkout() && isset($_GET['summary'])) : ?>
                                <div class="tab-pane-checkout__title"><?php echo __('Complete Order', 'baketivity'); ?></div>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="tab-pane-checkout__title"><?php echo __('Summary', 'baketivity'); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="header-checkout__site-info">
                    <div class="header-checkout__site-info__desktop">
                        <?= _e('Need some help? Call us!', 'baketivity'); ?>
                        <strong>845-867-BAKE <sub>(2253)</sub></strong>
                    </div>
                    <?php if (!is_wc_endpoint_url('order-received')) : ?>
                        <div class="header-checkout__site-info__mobile-inside">
                            <div class="header-checkout__site-info__mobile animate__animated animate__fadeIn" id="js-view-order">
                                <!-- Total Cart -->
                                <?php if (is_cart()) : ?>
                                    <strong><?php _e('Total', 'baketivity'); ?>&nbsp;<?php echo WC()->cart->get_cart_total(); ?></strong>
                                <?php else : ?>
                                    <strong><?php _e('Total', 'baketivity'); ?>&nbsp;<?php wc_cart_totals_order_total_html(); ?></strong>
                                <?php endif; ?>
                                <a href="#" class="header-checkout__site-info__mobile__cta">View your order</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div id="page" class="hfeed site <?php echo is_cart() ? 'woocommerce-new-cart' : 'woocommerce-new-checkout'; ?>">
        <?php do_action('baketivity_before_content'); ?>
        <div id="content" class="site-content" tabindex="-1">
            <div class="col-full">
                <?php if (is_cart()) : ?>
                    <a class="woocommerce-new-cart__backtocart" href="<?php echo esc_url('/shop'); ?>">Back to Shop</a>
                    <div class="woocommerce-new-cart__page-title">Your Cart</div>
                <?php endif; ?>
                <?php if (is_checkout() && !is_wc_endpoint_url('order-received')) : ?>
                    <a class="woocommerce-new-checkout__backtocart" href="<?php echo esc_url(wc_get_cart_url()); ?>">Back to Your Cart</a>
                    <div class="woocommerce-new-checkout__page-title">Checkout</div>
                <?php endif; ?>