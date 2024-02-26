<?php

/**
 * Baketivity engine room
 *
 * @package baketivity
 */


if (!defined('THEME_VERSION')) {
    // Replace the version number of the theme on each release.
    define('THEME_VERSION', '1.5');
}

if (!defined('WPB_VC_VERSION')) {
    // Replace the version number of the theme on each release.
    define('WPB_VC_VERSION', 'THEME_VERSION');
}

/*------------------------------------*\
        Custom Global Variables
\*------------------------------------*/

define('TEMPPATH', get_bloginfo('stylesheet_directory'));
define('IMAGES', TEMPPATH . "/images");

/*------------------------------------*\
        Baketivity Classes
\*------------------------------------*/
require_once('inc/baketivity.class.php');
require_once('inc/register-login.class.php');
require_once('inc/template_function.php');
require_once('inc/shortcodes.class.php');
require_once('inc/big-menu.class.php');
require_once('inc/video-oembed-acf.php');
require_once('inc/acf-custom-function.php');
require_once('inc/shop.class.php');
require_once('inc/checkout.class.php');
require_once('inc/curl.class.php');
require_once('inc/checkout-gift.class.php');
require_once('inc/free-shipping-meter.class.php');
require_once('inc/starter-kit.class.php');
require_once('inc/search.class.php');
require_once('inc/api-rest.class.php');
require_once('inc/cart.class.php');
require_once('inc/sticky-button.class.php');

add_filter('woocommerce_package_rates', 'backup_all_shipping', 1);

function backup_all_shipping($rates)
{
    $GLOBALS['backup_all_shipping'] = $rates;
    return $rates;
}

add_filter('avf_file_upload_capability', 'avia_file_upload_capability', 10, 1);
function avia_file_upload_capability($cap)
{
    $cap = 'edit_posts';
    return $cap;
}



add_filter('comment_form_default_fields', 'tu_filter_comment_fields', 20);
function tu_filter_comment_fields($fields)
{
    $commenter = wp_get_current_commenter();

    $consent   = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';

    $fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">Save my name, email in this browser next time I Comment</label></p>';
    return $fields;
}



// Removed in 29-05-23
//add_action( 'woocommerce_cart_calculate_fees', 'custom_fee_based_on_cart_total', 10, 1 );
function custom_fee_based_on_cart_total($cart)
{

    $quantity = 0;
    $product_id = array();
    $d_type = array();

    foreach (WC()->cart->get_cart() as $cart_item) {

        $_product = $cart_item['data'];
        $parent_id = $_product->get_id();
        if ($_product->get_type() == 'variation') {
            $variation = wc_get_product($_product->get_id());
            $parent_id = $variation->get_parent_id();
        }

        array_push($d_type, $_product->get_type());
        if ($parent_id == '17425') {
            $quantity = $quantity + $cart_item['quantity'];
        }
        $product_id[] = $parent_id;
    }

    $product_id =  array_unique($product_id);

    if ((in_array("17425", $product_id) && count($product_id) == 2 && !in_array("subscription", $d_type)) || (in_array("17425", $product_id) && count($product_id) >= 2)) {
        $d_price = $quantity * 9.99;
        if (empty($cart->recurring_cart_key)) {
            $cart->add_fee('Bake-A-Camp Shipping<br><span>Shipped in 5-7 Business Days</span>', $d_price);
        }
    }
}

add_filter('woocommerce_subscriptions_frontend_view_subscription_script_parameters', 'd_script_params', 10, 1);

function d_script_params($script_params)
{
    global $wp;
    $subscription   = wcs_get_subscription($wp->query_vars['view-subscription']);
    $script_params['auto_renew_nonce'] =  check_renew_toggle($subscription) ? wp_create_nonce("toggle-auto-renew-{$subscription->get_id()}") : false;
    return $script_params;
}


add_filter('wcs_view_subscription_actions', 'd_remove_cancel_action', 10, 2);

function d_remove_cancel_action($actions, $subscription)
{
    unset($actions['cancel']);
    return $actions;
}


function send_ajax_response_cs($subscription)
{
    wp_send_json(array(
        'payment_method' => esc_attr($subscription->get_payment_method_to_display('customer')),
        'is_manual'      => wc_bool_to_string($subscription->is_manual()),
    ));
}




add_action('wp_ajax_wcs_enable_auto_renew', 'd_enable_renew_cs', 1);
function d_enable_renew_cs()
{
    $subscription_id = absint($_POST['subscription_id']);
    check_ajax_referer("toggle-auto-renew-{$subscription_id}", 'security');

    $subscription = wcs_get_subscription($subscription_id);

    if (wc_get_payment_gateway_by_order($subscription)) {
        $subscription->set_requires_manual_renewal(false);
        $subscription->add_order_note('Payment changed from manual renewal to auto renewal', false);
        $subscription->save();

        send_ajax_response_cs($subscription);
    }
}

add_action('wp_ajax_wcs_disable_auto_renew', 'disable_auto_renew_cs', 1);

function disable_auto_renew_cs()
{
    $subscription_id = absint($_POST['subscription_id']);
    check_ajax_referer("toggle-auto-renew-{$subscription_id}", 'security');

    $subscription = wcs_get_subscription($subscription_id);

    if (wc_get_payment_gateway_by_order($subscription)) {
        $subscription->set_requires_manual_renewal(true);
        $subscription->set_payment_method('');
        $subscription->add_order_note('Payment changed from auto renewal to manual renewal', false);
        $subscription->save();

        send_ajax_response_cs($subscription);
    }
}

function d_change_has_payment_gateway($script_params)
{
    $script_params['has_payment_gateway'] = false;
    return $script_params;
}


add_action('baketivity_before_site', 'd_bar_nf');
function d_bar_nf()
{
    if (get_field('enable', 'option') && !is_page_template('home-page-redesign.php')) : ?>
        <div class="d-bar" style="<?php echo (wp_is_mobile()) ? 'padding: 5px;' : 'padding: 10px;'; ?>">
            <div class="d-bar-message col-full" style="text-align: center;">
                <?php echo get_field('message', 'option'); ?>
            </div>
        </div>
    <?php endif;
}

/**
 * Add floating PromoBar - bottom page
 */
add_action('baketivity_before_site', 'floating_footer');
function floating_footer()
{
    if (is_cart() || is_checkout()) return;

    if (get_field('floating_footer_enable', 'option') == true) :

        $from = get_field('visible_from', 'option') . " EST";
        $until = get_field('visible_until', 'option') . " EST";
        $from_time = strtotime($from);
        $until_time =  strtotime($until);
        $date = new DateTime("now", new DateTimeZone('US/Eastern'));
        $now = strtotime($date->format('F j Y H:i:s') . " EST");

        $link = get_field('floating_footer_link', 'option');
        $classes = get_field('where_to_display', 'option');


        if ($from_time < $now and $until_time > $now) {
            echo "<div id='floating-footer' class='" . $classes . "'>";
            echo "<a class='desktop_message' href='" . $link . "' target='blank'>" . get_field('message_desktop', 'option') . "</a>";
            echo "<a class='mobile_message' href='" . $link . "' target='blank'>" . get_field('message_mobile', 'option') . "</a>";
            echo "<div class='close-floating-footer'>X</div>";
            echo "</div>";
        }

    endif;
}


add_action('wp_enqueue_scripts', 'disable_cart_fragments', 999);
function disable_cart_fragments()
{
    global $wp_scripts;

    $handle = 'wc-cart-fragments';

    $load_cart_fragments_path = $wp_scripts->registered[$handle]->src;
    $wp_scripts->registered[$handle]->src = null;
    wp_add_inline_script(
        'woocommerce',
        '
        function optimocha_getCookie(name) {
          var v = document.cookie.match("(^|;) ?" + name + "=([^;]*)(;|$)");
          return v ? v[2] : null;
        }

        function optimocha_check_wc_cart_script() {
        var cart_src = "' . $load_cart_fragments_path . '";
        var script_id = "optimocha_loaded_wc_cart_fragments";

          if( document.getElementById(script_id) !== null ) {
            return false;
          }

          if( optimocha_getCookie("woocommerce_cart_hash") ) {
            var script = document.createElement("script");
            script.id = script_id;
            script.src = cart_src;
            script.async = true;
            document.head.appendChild(script);
          }
        }

        optimocha_check_wc_cart_script();
        document.addEventListener("click", function(){setTimeout(optimocha_check_wc_cart_script,1000);});
        '
    );
}
add_action('init', 'function_to_add_author_woocommerce', 999);

function function_to_add_author_woocommerce()
{
    add_post_type_support('product', 'author');
}

add_filter('woocommerce_subscription_price_string', 'd_total', 10, 2);

function d_total($wcc, $cart)
{
    // if( WC()->cart->recurring_carts ) {
    //var_dump($cart);
    // }
    // var_dump($wcc['recurring_amount']);
    return $wcc;
}

// Hook in
add_filter('woocommerce_default_address_fields', 'custom_override_default_address_fields');

// Our hooked in function - $address_fields is passed via the filter!
function custom_override_default_address_fields($address_fields)
{
    $address_fields['address_2']['label'] = 'Apt/Suite #';
    $address_fields['address_2']['placeholder'] = 'Apt/Suite';

    return $address_fields;
}


add_action('woocommerce_admin_order_data_after_shipping_address', 'bbloomer_shipping_phone_checkout_display');

function bbloomer_shipping_phone_checkout_display($order)
{
    echo '<p><b>Shipping Phone:</b> ' . get_post_meta($order->get_id(), '_shipping_phone', true) . '</p>';
    echo '<p><b>Shipping Email:</b> ' . get_post_meta($order->get_id(), '_shipping_email', true) . '</p>';
}

// add the filter
add_filter('woocommerce_customer_default_location_array', 'filter_woocommerce_customer_default_location_array', 10, 1);
function filter_woocommerce_customer_default_location_array($location)
{
    // make filter magic happen here...
    $location['state'] = null;
    return $location;
}

add_action('wp_enqueue_scripts', 'dequeue_woocommerce_cart_fragments', 11);
function dequeue_woocommerce_cart_fragments()
{
    if (is_front_page()) wp_dequeue_script('wc-cart-fragments');
}

function filter_woocommerce_product_get_rating_html($rating_html, $rating, $count)
{
    $rating_html  = '<div class="star-rating">';
    $rating_html .= wc_get_star_rating_html($rating, $count);
    $rating_html .= '</div>';

    return $rating_html;
}

add_filter('woocommerce_product_get_rating_html', 'filter_woocommerce_product_get_rating_html', 10, 3);
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'     => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));
}

function wpa_filter_list_comments($args)
{
    $args['reverse_top_level'] = false;
    return $args;
}

add_filter('wc_product_reviews_pro_product_review_list_args', 'wpa_filter_list_comments', 10, 2);


add_filter('vc_gitem_template_attribute_case_study_title', 'vc_gitem_template_attribute_case_study_title', 10, 2);
function vc_gitem_template_attribute_case_study_title($value, $data)
{
    extract(array_merge(array(
        'post' => null,
        'data' => '',
    ), $data));
    $atts_extended = array();
    parse_str($data, $atts_extended);
    //$atts = $atts_extended['atts'];
    $product = new WC_Product($post->ID);

    // write all your widget code in here using queries etc
    $title = $product->get_slug();

    ob_start();
    $product = new WC_Product($post->ID);
    wc_get_template_part('content', 'product_grid');
    return ob_get_clean();
}

add_filter('woocommerce_register_post_type_product', function ($post_type) {
    $post_type['has_archive'] = false;
    return $post_type;
});

add_filter('vc_grid_item_shortcodes', 'case_study_title_shortcodes');
function case_study_title_shortcodes($shortcodes)
{
    $shortcodes['vc_case_study_title'] = array(
        'name' => __('Case Study Title', 'sage'),
        'base' => 'vc_case_study_title',
        'icon' => get_template_directory_uri() . '/assets/images/icon.svg',
        'category' => __('Content', 'sage'),
        'description' => __('Displays the case study title with correct icon', 'sage'),
        'post_type' => Vc_Grid_Item_Editor::postType()
    );
    return $shortcodes;
}



// define the single_product_archive_thumbnail_size callback
add_filter('single_product_archive_thumbnail_size', 'filter_single_product_archive_thumbnail_size', 10, 1);
function filter_single_product_archive_thumbnail_size($size)
{
    // make filter magic happen here...
    $size = 'thumb-medium';
    return $size;
}

add_action('woocommerce_before_single_product_summary', 'bbloomer_new_badge_shop_page', 3);
function bbloomer_new_badge_shop_page()
{
    global $product;
    $newness_days = 30;
    $created = strtotime($product->get_date_created());
    $timestamp = (time() - (60 * 60 * 24 * $newness_days));
    ob_start(); ?>

    <?php if ($timestamp < $created) : ?>
        <div class="product-shop__badges ribbon-new">
            <div class="product-shop__badges-label"><?php echo esc_html__('NEW', 'woocommerce') ?></div>
        </div>
    <?php elseif (get_field('on_sale', $product->get_ID())) : ?>
        <style>
            span.onsale {
                display: none !important;
            }

            /* hide old badge */
        </style>
        <div class="product-shop__badges ribbon-sale">
            <div class="product-shop__badges-label"><?php echo esc_html__('SALE', 'woocommerce') ?></div>
        </div>
    <?php elseif (get_field('prime', $product->get_ID())) : ?>
        <style>
            /* hide old badge */
            span.onsale {
                display: none !important;
            }
        </style>
        <!-- <div class="product-shop__badges ribbon-prime">
            <div class="product-shop__badges-label-prime">
                <?php //echo esc_html__('30% OFF', 'woocommerce'); 
                ?></div>
        </div> -->
        <div class="product-shop__badges-prime">
            <img src="/wp-content/themes/baketivity/images/prime/buy-with-prime.png" alt="buy with prime">
        </div>
    <?php endif;

    if (get_field('custom_badge', $product->get_ID())) : ?>
        <!-- Product Custom New Badge -->
        <div class=" product-shop__new-badge" style="background-color:<?= get_field('custom_badge_bg', $product->get_ID()); ?>; color:<?= get_field('custom_badge_color', $product->get_ID()); ?>">
            <?= get_field('custom_badge', $product->get_ID()); ?>
        </div>
    <?php endif;

    echo ob_get_clean();
}

// Remove the sale to evite the double badge
add_filter('woocommerce_sale_flash', 'lw_hide_sale_flash');
function lw_hide_sale_flash()
{
    global $product;
    if (!get_field('on_sale', $product->get_ID()))  return false;
}


add_action('wp_head', 'font_face');
function font_face()
{
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery(document).on('click', 'a.subscription-auto-renew-toggle', function() {
                if (jQuery(this).hasClass('subscription-auto-renew-toggle--off')) {
                    WCSViewSubscription.has_payment_gateway = '';
                }
            });
        });
    </script>
    <?php
}

add_action('init', 'modify_storefront_funcs');
function modify_storefront_funcs()
{
    remove_action('storefront_post_header_before', 'storefront_post_meta', 10);
    remove_action('storefront_loop_post', 'storefront_post_header', 10);
    remove_action('storefront_loop_post', 'storefront_post_content', 30);
    remove_action('storefront_header', 'storefront_product_search', 40);
    remove_action('storefront_header', 'storefront_secondary_navigation', 30);
    remove_action('storefront_header', 'storefront_header_cart', 60);
    add_action('storefront_top_header', 'storefront_header_cart', 60);
    add_action('storefront_top_header', 'storefront_secondary_navigation', 30);
    remove_action('storefront_single_post_bottom', 'storefront_display_comments', 20);
    //remove_action('storefront_header','storefront_primary_navigation_wrapper', 42);
    //remove_action('storefront_header','storefront_header_container_close', 41);
    add_action('storefront_post_header_before', 'storefront_post_meta_tag', 20);
    add_action('storefront_post_header_after', 'storefront_post_meta_excerpt', 20);
    add_action('storefront_post_header_after', 'storefront_post_meta_author', 30);
    remove_action('storefront_single_post_bottom', 'storefront_post_nav', 10);
    remove_action('storefront_header', 'storefront_skip_links', 5);
    remove_action('storefront_before_content', 'woocommerce_breadcrumb', 10);
    add_action('storefront_loop_post', 'post_loop_in_cat', 20);
}


function s25_sharing_caring()
{
    $post_type = get_post_type();
    $include = array('post');
    if (is_single() && in_array($post_type, $include)) : ?>
        <!-- end .share -->
    <?php endif;
}
/* Fer Catalano */
function storefront_post_meta_excerpt()
{ ?>
    <div class="post-excerpt"><?php echo get_the_excerpt();  ?></div>
<?php
}
/* Fer Catalano */
function storefront_post_meta_author()
{ ?>
    <div class="post-meta">
        <span class="author-name">
            <?php echo get_field('author_label');  ?> <?php echo get_field('author_name');  ?>
        </span>
        <?php if (get_field('author_link')) : ?>
            <a class="post-date" href="<?php echo get_field('author_link')['url']; ?>" target="<?php echo get_field('author_link')['target'];  ?>">
                - <?php echo get_field('author_link')['title']; ?>
            </a>
        <?php endif; ?>
    </div>
<?php
}

add_filter('storefront_menu_toggle_text', 'd_remove_text');
function d_remove_text()
{
    return false;
}

function storefront_site_branding()
{ ?>
    <div class="site-logo">
        <?php storefront_site_title_or_logo(); ?>
    <?php
}

function storefront_credit()
{

    if (is_page_template('home-page-redesign.php')) return;

    $links_output = '';

    if (apply_filters('', true)) {
        $links_output .= '<a href="https://woocommerce.com" target="_blank" title="' . esc_attr__('WooCommerce - The Best eCommerce Platform for WordPress', 'storefront') . '" rel="author">' . esc_html__('Built with Storefront &amp; WooCommerce', 'storefront') . '</a>.';
    }

    if (apply_filters('storefront_privacy_policy_link', true) && function_exists('the_privacy_policy_link')) {
        $separator = '<span role="separator" aria-hidden="true"></span>';
        $links_output = get_the_privacy_policy_link('', (!empty($links_output) ? $separator : '')) . $links_output;
    }

    $links_output = apply_filters('storefront_credit_links_output', $links_output);
    ?>
        <div class="footer-menu">
            <?php
            // wp_nav_menu(
            // 	array(
            // 		'theme_location'  => 'footer-menu',
            // 		'container_class' => 'footer-menu-navigation',
            // 	)
            // );
            ?>
        </div>
        <div class="site-info">
            <p class="copyright">
                <?php echo esc_html(apply_filters('storefront_copyright_text', $content = '&copy; ' . date('Y') . ' All rights reserved Baketivity. ')); ?>
            </p>
            <div class="wpautoterms-footer">
                <a href="<?php echo home_url(); ?>/wpautoterms/return-policy/">Return Policy</a><span class="separator">
                </span><a href="<?php echo home_url(); ?>/wpautoterms/terms-and-conditions/">Terms and Conditions</a><span class="separator"> </span><a href="<?php echo home_url(); ?>/wpautoterms/privacy-policy/">Privacy
                    Policy</a>
            </div>
        </div>

        <!-- .site-info -->
    <?php
}

function my_text_strings($translated_text, $text, $domain)
{
    switch ($translated_text) {
        case 'Search products&hellip;':
            $translated_text = __('SEARCH BAKETIVITY', 'woocommerce');
            break;
        case 'Shipping via %s':
            $translated_text = __('%s', 'woocommerce-subscriptions');
            break;
        case 'Proceed to checkout':
            $translated_text = __('Checkout', 'woocommerce-subscriptions');
            break;
        case '%s months':
            $translated_text = __('<b>%s months</b>', 'woocommerce-subscriptions');
            break;
    }
    return $translated_text;
}
add_filter('gettext', 'my_text_strings', 20, 3);





add_filter('woocommerce_output_related_products_args', 'jk_related_products_args', 20);
function jk_related_products_args($args)
{
    $args['posts_per_page'] = -1; // 4 related products
    $args['columns'] = 4; // arranged in 2 columns
    return $args;
}

add_action('woocommerce_after_add_to_cart_form', 'buy_now_submit_form');
function buy_now_submit_form()
{ ?>
        <script>
            jQuery(document).ready(function() {
                // listen if someone clicks 'Buy Now' button
                jQuery('#buy_now_button').click(function() {
                    // set value to 1
                    jQuery('#is_buy_now').val('1');
                    //submit the form
                    jQuery('form.cart').submit();
                });
            });
        </script>
        <?php
    }


    add_action('wp_footer', 'testimonial_script', 200);
    function testimonial_script()
    {

        if (is_page_template('home-page-redesign.php')) return;

        if (is_category()) { ?>

            <script type="text/javascript">
                jQuery(document).ready(function() {

                    jQuery(".slider-in-cat").owlCarousel({
                        loop: true,
                        pagination: false,
                        dots: false,
                        margin: 0,
                        nav: true,
                        navText: ["<i class='fal fa-arrow-left'></i>", "<i class='fal fa-arrow-right'></i>"],
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 2
                            },
                            1000: {
                                items: 4
                            },
                            1100: {
                                items: 5
                            },
                            1200: {
                                items: 6
                            }
                        }
                    })

                })
            </script>

        <?php
        }
        if (is_singular('product')) { ?>
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    jQuery(".single_variation_wrap").on("show_variation", function(event, variation) {
                        jQuery('img.attachment-shop_single.size-shop_single.wp-post-image').attr('src', variation['image']['src']).change();
                        jQuery('img.attachment-shop_single.size-shop_single.wp-post-image').attr('currentSrc', variation['image']['src']).change();
                        jQuery('img.attachment-shop_single.size-shop_single.wp-post-image').attr('datasrc', variation['image']['src']).change();
                        jQuery('img.attachment-shop_single.size-shop_single.wp-post-image').attr('srcset', variation['image']['src']).change();
                        jQuery('a.venobox.vbox-item').attr('href', variation['image']['url']).change();
                        // Fired when the user selects all the required dropdowns / attributes
                        // and a final variation is selected / shown
                    });

                    jQuery('.flexslider ul').slick({
                        infinite: true,
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        centerPadding: '40px',
                        responsive: [{
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 4,
                                    slidesToScroll: 4,

                                }
                            },
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 3,
                                    slidesToScroll: 3
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 2
                                }
                            }
                            // You can unslick at a given breakpoint now by adding:
                            // settings: "unslick"
                            // instead of a settings object
                        ]
                    });
                });
            </script>
        <?php
        }

        if (is_singular('post')) { ?>
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    jQuery('.related-post-in').slick({
                        infinite: true,
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        centerPadding: '40px',
                        responsive: [{
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 4,
                                    slidesToScroll: 4,

                                }
                            },
                            {
                                breakpoint: 600,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 2
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    centerMode: true,
                                    variableWidth: true,
                                    centerPadding: '0px',
                                    slidesToShow: 2,
                                    slidesToScroll: 1
                                }
                            }
                            // You can unslick at a given breakpoint now by adding:
                            // settings: "unslick"
                            // instead of a settings object
                        ]
                    });
                });
            </script>
        <?php
        }
    }
    function is_realy_woocommerce_page()
    {

        if (function_exists("is_woocommerce") && is_woocommerce()) {
            return true;
        }

        $woocommerce_keys = array(
            "woocommerce_shop_page_id",
            "woocommerce_terms_page_id",
            "woocommerce_cart_page_id",
            "woocommerce_checkout_page_id",
            "woocommerce_pay_page_id",
            "woocommerce_thanks_page_id",
            "woocommerce_myaccount_page_id",
            "woocommerce_edit_address_page_id",
            "woocommerce_view_order_page_id",
            "woocommerce_change_password_page_id",
            "woocommerce_logout_page_id",
            "woocommerce_lost_password_page_id"
        );

        foreach ($woocommerce_keys as $wc_page_id) {
            if (get_the_ID() == get_option($wc_page_id, 0)) {
                return true;
            }
        }
        return false;
    }

    function badge_shop_page_wrap_open()
    {
        echo '<div class="badges">';
    }

    //define the woocommerce_product_add_to_cart_text callback
    function filter_woocommerce_product_add_to_cart_text($var, $instance)
    {
        // make filter magic happen here...
        $var = "<i class='fas fa-shopping-cart'></i><span>" . $var . "</span>";
        return $var;
    }

    function bbloomer_redirect_checkout_add_cart($url)
    {
        $url = get_permalink(get_option('woocommerce_checkout_page_id'));
        return $url;
    }

    //add_filter( 'woocommerce_add_to_cart_redirect', 'bbloomer_redirect_checkout_add_cart' );
    // add the filter
    //add_filter( 'woocommerce_product_add_to_cart_text', 'filter_woocommerce_product_add_to_cart_text', 10, 2 );

    //dd_filter( 'woocommerce_loop_add_to_cart_link', 'filter_loop_add_to_cart_link', 20, 3 );
    function filter_loop_add_to_cart_link($button, $product, $args = array())
    {
        $button = "<i class='fas fa-shopping-cart'></i>" . $button;
        return strip_tags($button, '<i><a>');;
    }

    function badge_shop_page_wrap_close()
    {
        echo '</div>';
    }

    function product_button_details()
    {
        echo '<a href="' . get_permalink() . '"><i class="fas fa-list"></i></a>';
    }

    function action_wrap_open()
    {
        echo '<div class="actions">';
    }

    function action_wrap_close()
    {
        echo '</div>';
    }

    function product_single_button_details()
    {
        echo '<a href="' . home_url('/shop/') . '"><i class="fas fa-list"></i></a>';
    }

    function product_single_cart_page()
    {
        echo '<a href="' . get_permalink(wc_get_page_id('cart')) . '"><i class="fas fa-shopping-cart"></i></a>';
    }
    add_filter('woocommerce_single_product_image_gallery_classes', 'bbloomer_5_columns_product_gallery');

    function bbloomer_5_columns_product_gallery($wrapper_classes)
    {
        $columns = 3; // change this to 2, 3, 5, etc. Default is 4.
        $wrapper_classes[2] = 'woocommerce-product-gallery--columns-' . absint($columns);
        return $wrapper_classes;
    }

    add_filter('woocommerce_single_product_carousel_options', 'ud_update_woo_flexslider_options');
    function ud_update_woo_flexslider_options($options)
    {
        $options['directionNav'] = true;
        return $options;
    }

    function des_shop_page_wrap_open()
    {
        echo '<div class="des-product">';
    }

    function des_shop_page_wrap_close()
    {
        echo '</div>';
    }
    function d_klaviyo_cs()
    {
        global $product, $loop;

        $ImageUrl = '';
        if (is_object($loop)) {
            $ImageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($loop->post->ID), 'single-post-thumbnail')[0];
        }

        $ItemId = $product->id;
        $Title = $product->get_title();
        $ProductUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $Price = $product->get_sale_price();
        $RegularPrice = $product->get_regular_price();
        $DiscountAmount = 0;
        if ($Price) {
            $DiscountAmount = $RegularPrice - $Price;
        }

        $terms = get_terms('product_tag');
        ?>
        <script>
            var Title = "<?php echo $Title; ?>";
            var ItemId = "<?php echo $ItemId; ?>";
            var ImageUrl = "<?php echo $ImageUrl; ?>";
            var ProductUrl = "<?php echo $ProductUrl; ?>";
            var Price = "<?php echo $Price; ?>";
            var DiscountAmount = "<?php echo $DiscountAmount; ?>";
            var RegularPrice = "<?php echo $RegularPrice; ?>";
            var _learnq = _learnq || [];

            _learnq.push(['track', 'Viewed Product', {
                Title: Title,
                ItemId: ItemId,
                ImageUrl: ImageUrl,
                Url: ProductUrl,
                Metadata: {
                    Price: Price,
                    DiscountAmount: DiscountAmount,
                    RegularPrice: RegularPrice
                }
            }]);
        </script>
    <?php
    }

    add_filter('woocommerce_product_description_heading', function () {
        return false;
    });

    add_action('init', 'modify_actions');
    function modify_actions()
    {

        add_action('woocommerce_single_product_summary', 'd_klaviyo_cs', 10);
        add_action('woocommerce_before_add_to_cart_button', 'action_wrap_open', 16, 0);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

        add_action('woocommerce_before_add_to_cart_button', 'product_single_button_details', 20, 0);
        add_action('woocommerce_before_add_to_cart_button', 'product_single_cart_page', 30, 0);
        add_action('woocommerce_before_add_to_cart_button', 'action_wrap_close', 60, 0);

        add_action('woocommerce_before_shop_loop_item_title', 'badge_shop_page_wrap_open', 3);
        add_action('woocommerce_before_shop_loop_item_title', 'bbloomer_new_badge_shop_page', 4);
        add_action('woocommerce_before_single_product_summary', 'des_shop_page_wrap_open', 1);
        add_action('woocommerce_before_single_product_summary', 'badge_shop_page_wrap_open', 2);

        add_action('woocommerce_single_product_summary', 'des_shop_page_wrap_close', 70);
        remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
        add_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 4);

        add_action('woocommerce_before_single_product_summary', 'badge_shop_page_wrap_close', 6);
        add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 5);
        //add_action( 'woocommerce_before_shop_loop_item_title', 'product_button_details', 6);
        add_action('woocommerce_before_shop_loop_item_title', 'badge_shop_page_wrap_close', 7);

        //add_action( 'woocommerce_after_shop_loop_item', 'action_wrap_open', 5);
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
        add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 25);
        //add_action( 'woocommerce_after_shop_loop_item', 'product_button_details', 20);
        //add_action( 'woocommerce_after_shop_loop_item', 'action_wrap_close', 30 );

        //remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
        add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open_cs', 8);
        add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close_cs', 15);

        //remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
        remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 6);
        remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
        add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15);
    }

    function woocommerce_template_loop_product_link_open_cs()
    {
        global $product;
        echo '<div class="thumb-css">';
        echo '<svg class="prev-thumb" xmlns="http://www.w3.org/2000/svg" width="10.101" height="23.973" viewBox="0 0 10.101 23.973"><path id="Path_1877" data-name="Path 1877" d="M-1607,171.208l9.07,11.407-9.07,11.952" transform="translate(-1597.297 194.87) rotate(180)" fill="none" stroke="#4d4d4f" stroke-width="1"/></svg>';
        echo '<a href="' . get_the_permalink() . '" class="link-image">';
        $attachment_ids = $product->get_gallery_image_ids();
        if (is_array($attachment_ids) && !empty($attachment_ids)) {
            // Full image
            //$first_image_url = wp_get_attachment_url( $attachment_ids[0] );
            // Change by Fer Catalano - Small image
            $first_image_url = wp_get_attachment_image_src($attachment_ids[0], 'medium')[0];
            echo '<img class="on-hover-thumb" alt="' . get_the_title() . '" src="' . $first_image_url . '">';
        }
    }

    function woocommerce_template_loop_product_link_close_cs()
    {
        echo '</a>';
        echo '<svg class="next-thumb" xmlns="http://www.w3.org/2000/svg" width="10.101" height="23.973" viewBox="0 0 10.101 23.973"><path id="Path_1875" data-name="Path 1875" d="M-1607,171.208l9.07,11.407-9.07,11.952" transform="translate(1607.399 -170.897)" fill="none" stroke="#4d4d4f" stroke-width="1"/></svg>';
        echo '</div>';
    }

    add_filter('woocommerce_format_sale_price', 'ss_format_sale_price', 100, 3);
    function ss_format_sale_price($price, $regular_price, $sale_price)
    {
        $price = '<ins>' . (is_numeric($sale_price) ? wc_price($sale_price) : $sale_price) . '</ins><del>' . (is_numeric($regular_price) ? wc_price($regular_price) : $regular_price) . '</del> ';
        return $price;
    }

    function my_post_thumbnail_fallback($html, $post_id, $post_thumbnail_id, $size, $attr)
    {
        if (empty($html)) {
            // return you fallback image either from post of default as html img tag.
        }
        return $html;
    }

    function woocommerce_template_loop_product_title()
    {
        echo '<h4 class="' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title')) . '">' . get_the_title() . '</h4>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * Custom text for 'woocommerce_product_add_to_cart_text' filter for all product types/ cases.
     *
     * @link   https://gist.github.com/deckerweb/cf466e017fd01d503469
     *
     * @global $product
     *
     * @return string String for add to cart text.
     */
    add_filter('woocommerce_product_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text');
    function custom_woocommerce_product_add_to_cart_text($var)
    {
        global $product;
        if ($product) {
            $product_type = $product->get_type();
            switch ($product_type) {
                case 'external':
                    return __('<span>Buy product</span>', 'woocommerce');
                    break;
                case 'grouped':
                    return __('<span>View products</span>', 'woocommerce');
                    break;
                case 'simple':
                    return __('<span>Add to cart</span>', 'woocommerce');
                    break;
                case 'variable':
                    return __('<span>Select options</span>', 'woocommerce');
                    break;
                case 'subscription':
                    return 'Select this plan';
                    break;
                default:
                    return __('<span>Read more</span>', 'woocommerce');
            }  // end switch
        }
    }  // end function

    function my_assets()
    {
        $themecsspath = dirname(__FILE__) . '/style.min.css';
        $themejspath = dirname(__FILE__) . '/js/app.min.js';

        if (!is_cart() && !is_checkout()) {
            wp_enqueue_style('d_camp_enqueue', get_stylesheet_directory_uri() . '/css/d-camp-styles.css');
            wp_enqueue_style('d-mediaelement', get_stylesheet_directory_uri() . '/css/mediaelement.css');
            wp_enqueue_script('flexslider_cs', get_stylesheet_directory_uri() . '/assets/js/flex-slider.js', array('jquery'), WPB_VC_VERSION, true);
        }

        wp_enqueue_script('jquery-modal-js', get_stylesheet_directory_uri() . '/assets/js/jquery.modal.min.js', array('jquery'));
        wp_enqueue_style('fa-one', get_stylesheet_directory_uri() . '/assets/css/fontawesome-pro-5.8.1/css/all.css', null);
        wp_enqueue_style('jquery-modal-css', get_stylesheet_directory_uri() . '/css/jquery.modal.min.css');
        wp_enqueue_script('klaviyo', '//www.klaviyo.com/media/js/public/klaviyo_subscribe.js');

        wp_enqueue_script('app-js', get_stylesheet_directory_uri() . '/js/app.min.js', array('jquery'), filemtime($themejspath));

        // Load API and Ajax vars
        wp_localize_script('app-js', 'ajax', array(
            'rootapiurl' => esc_url_raw(rest_url()),
            'nonce'      => wp_create_nonce('wp_rest'),
            'url'        => admin_url('admin-ajax.php'),
            'nonce'      => wp_create_nonce('ajax-nonce'),
        ));
    }

    add_action('wp_enqueue_scripts', 'my_assets');


    function excerpt($limit)
    {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt) >= $limit) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt);
        } else {
            $excerpt = implode(" ", $excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
        $excerpt = preg_replace('#\[[^\]]+\]#', '', $excerpt);
        return $excerpt;
    }


    function content($limit)
    {
        $content = explode(' ', get_the_ex(), $limit);
        if (count($content) >= $limit) {
            array_pop($content);
            $content = implode(" ", $content) . '...';
        } else {
            $content = implode(" ", $content);
        }
        $content = preg_replace('/[.+]/', '', $content);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]>', $content);
        $content = preg_replace('#\[[^\]]+\]#', '', $content);

        return $content;
    }

    function woocommerce_cart_item_subtotal_cs($subtotal, $cart_item, $cart_item_key)
    {
        $_product =  wc_get_product($cart_item['product_id']);
        if ($_product->is_type('subscription')) {
            $price_sale =  WC_Subscriptions_Product::get_price($_product);
            $get_regular_price =  WC_Subscriptions_Product::get_regular_price($_product);
            $period = WC_Subscriptions_Product::get_period($_product);
            $lenght   = WC_Subscriptions_Product::get_interval($_product);

            $target = in_category('local-msr') ? 'target="_blank"' : '';
            $none  = '';
            if ($lenght > 1) {
                $none  = 's';
            }

            $subtotal =  wc_price($price_sale);
        }

        return $subtotal;
    }
    add_filter('woocommerce_cart_item_subtotal', 'woocommerce_cart_item_subtotal_cs', 10, 3);



    function sv_change_product_price_cart($price, $cart_item, $cart_item_key)
    {
        $_product =  wc_get_product($cart_item['product_id']);
        if ($_product->is_type('subscription')) {
            $price_sale =  WC_Subscriptions_Product::get_price($_product);
            $get_regular_price =  WC_Subscriptions_Product::get_regular_price($_product);
            $period = WC_Subscriptions_Product::get_period($_product);
            $lenght   = WC_Subscriptions_Product::get_interval($_product);

            $target = in_category('local-msr') ? 'target="_blank"' : '';
            $none  = '';
            if ($lenght > 1) {
                $none  = 's';
            }

            $price = '<div class="first-payment-date">' . wc_price($price_sale) . '<small class="d-renewed">auto renewed after ' . $lenght . ' ' . $period . $none . '</small></div>';
        }

        return $price;
    }
    add_filter('woocommerce_cart_item_price', 'sv_change_product_price_cart', 10, 3);



    add_filter('manage_edit-shop_order_columns', 'custom_shop_order_column', 90);
    function custom_shop_order_column($columns)
    {
        $ordered_columns = array();

        foreach ($columns as $key => $column) {
            $ordered_columns[$key] = $column;
            if ('order_date' == $key) {
                $ordered_columns['order_notes'] = __('Notes', 'woocommerce');
            }
        }

        return $ordered_columns;
    }

    add_action('manage_shop_order_posts_custom_column', 'custom_shop_order_list_column_content', 10, 1);
    function custom_shop_order_list_column_content($column)
    {
        global $post, $the_order;

        $customer_note = $post->post_excerpt;

        if ($column == 'order_notes') {

            if ($the_order->get_customer_note()) {
                echo '<span class="note-on customer tips" data-tip="' . wc_sanitize_tooltip($the_order->get_customer_note()) . '">' . __('Yes', 'woocommerce') . '</span>';
            }

            if ($post->comment_count) {

                $latest_notes = wc_get_order_notes(array(
                    'order_id' => $post->ID,
                    'limit'    => 1,
                    'orderby'  => 'date_created_gmt',
                ));

                $latest_note = current($latest_notes);

                if (isset($latest_note->content) && 1 == $post->comment_count) {
                    echo '<span class="note-on tips" data-tip="' . wc_sanitize_tooltip($latest_note->content) . '">' . __('Yes', 'woocommerce') . '</span>';
                } elseif (isset($latest_note->content)) {
                    // translators: %d: notes count
                    echo '<span class="note-on tips" data-tip="' . wc_sanitize_tooltip($latest_note->content . '<br/><small style="display:block">' . sprintf(_n('Plus %d other note', 'Plus %d other notes', ($post->comment_count - 1), 'woocommerce'), $post->comment_count - 1) . '</small>') . '">' . __('Yes', 'woocommerce') . '</span>';
                } else {
                    // translators: %d: notes count
                    echo '<span class="note-on tips" data-tip="' . wc_sanitize_tooltip(sprintf(_n('%d note', '%d notes', $post->comment_count, 'woocommerce'), $post->comment_count)) . '">' . __('Yes', 'woocommerce') . '</span>';
                }
            }
        }
    }

    // Set Here the WooCommerce icon for your action button
    add_action('admin_head', 'add_custom_order_status_actions_button_css');
    function add_custom_order_status_actions_button_css()
    {
        echo '<style>
    td.order_notes > .note-on { display: inline-block !important;}
    span.note-on.customer { margin-right: 4px !important;}
    span.note-on.customer::after { font-family: woocommerce !important; content: "\e026" !important;}
    </style>';
    }

    function check_renew_toggle($subscription)
    {

        // Cannot change to auto-renewal for a subscription with status other than active
        if (!$subscription->has_status('active')) {
            return false;
        }
        // // Cannot change to auto-renewal for a subscription with 0 total
        // if ( 0 == $subscription->get_total() ) { // Not using strict comparison intentionally
        // 	return false;
        // }
        // Cannot change to auto-renewal for a subscription in the final billing period. No next renewal date.
        if (0 == $subscription->get_date('next_payment')) { // Not using strict comparison intentionally
            return false;
        }
        // If it is not a manual subscription, and the payment gateway is PayPal Standard
        if (!$subscription->is_manual() && $subscription->payment_method_supports('gateway_scheduled_payments')) {
            return false;
        }

        // Looks like changing to auto-renewal is indeed possible
        return true;
    }

    // add the action
    add_action('woocommerce_email_order_details', 'action_woocommerce_email_order_details', 10, 4);
    add_action('woocommerce_subscriptions_email_order_details', 'action_woocommerce_email_order_details', 30, 4);
    function action_woocommerce_email_order_details($order, $sent_to_admin, $plain_text, $email)
    {
        if ($email->id == 'customer_completed_order' || $email->id == 'recipient_completed_renewal_order') {

            $label_ids = get_posts(array(
                'posts_per_page' => -1,
                'post_type'      => 'wc_stamps_label',
                'post_parent'    => $order->get_id(),
            ));

            if (!empty($label_ids)) {
                $output = '<div><p>';
                foreach ($label_ids as $p) {
                    $tracking = $p->post_title;
                    $date = esc_html(date_i18n(get_option('date_format'), strtotime($p->post_date)));
                    $output .= 'Your order was shipped on ' . $date . ' .Tracking number ' . $tracking . '. ';
                    $output .= '<a target="_blank" href="https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=' . esc_attr($tracking) . '">Click here to track you shipment</a>';
                }
                $output .= '</p></div>';
                echo $output;
            }
        }
    }

    add_action('woocommerce_order_details_before_order_table', 'so_32457241_before_order_itemmeta', 10, 1);
    function so_32457241_before_order_itemmeta($order)
    {

        $label_ids = get_posts(array(
            'posts_per_page' => -1,
            'post_type'      => 'wc_stamps_label',
            'post_parent'    => $order->get_id(),
        ));

        if (!empty($label_ids)) {
            $output = '<div><p>';
            foreach ($label_ids as $p) {
                $tracking = $p->post_title;
                $date = esc_html(date_i18n(get_option('date_format'), strtotime($p->post_date)));
                $output .= 'Your order was shipped on ' . $date . ' .Tracking number ' . $tracking . '. ';
                $output .= '<a target="_blank" href="https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=' . esc_attr($tracking) . '">Click here to track you shipment</a>';
            }
            $output .= '</p></div>';
            echo $output;
        }
    }

    function disable_media_comment($open, $post_id)
    {
        if (get_post_type($post_id) == 'attachment') {
            return false;
        }
        return $open;
    }
    add_filter('comments_open', 'disable_media_comment', 100, 2);

    function storefront_post_taxonomy()
    {
        return false;
    }

    function add_custom_body_class($classes)
    {
        if (is_category()) {
            $option = get_field('layout', 'option');

            switch ($option) {
                case 'fullwidth':
                    $classes[] = 'full_widthcss';
                    break;

                default:
                    $classes[] = 'right_sidebarcss';
                    break;
            }
        }
        return $classes;
    }

    function post_loop_in_cat()
    { ?>
        <a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail('thumb-post-size'); ?></a>
        <a href="<?php echo the_permalink(); ?>">
            <h3><?php echo get_the_title(); ?></h3>
        </a>
        <p><?php echo excerpt(30); ?></p>
    <?php
    }

    function storefront_paging_nav()
    {
        global $wp_query;

        $args = array(
            'type'      => 'list',
            'mid_size' => 1,
            'next_text' => _x('<i class="fas fa-chevron-right"></i>', 'Next post', 'storefront'),
            'prev_text' => _x('<i class="fas fa-chevron-left"></i>', 'Previous post', 'storefront'),
        );

        the_posts_pagination($args);
    }


    function arphabet_widgets_init()
    {

        register_sidebar(array(
            'name'          => 'BLog Sidebar',
            'id'            => 'blog_sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>',
        ));
    }
    add_action('widgets_init', 'arphabet_widgets_init');


    add_filter('widget_text', 'do_shortcode');

    function kc_widget_form_extend($instance, $widget)
    {
        if (!isset($instance['classes']))
            $instance['classes'] = null;
        $row = "<p>";
        $row .= "Class:\t<input type='text' name='widget-{$widget->id_base}[{$widget->number}][classes]' id='widget-{$widget->id_base}-{$widget->number}-classes' class='widefat' value='{$instance['classes']}'/>\n";
        $row .= "</p>\n";

        echo $row;
        return $instance;
    }
    add_filter('widget_form_callback', 'kc_widget_form_extend', 10, 2);

    function kc_widget_update($instance, $new_instance)
    {
        $instance['classes'] = $new_instance['classes'];
        return $instance;
    }
    add_filter('widget_update_callback', 'kc_widget_update', 10, 2);

    function kc_dynamic_sidebar_params($params)
    {
        global $wp_registered_widgets;
        $widget_id    = $params[0]['widget_id'];
        $widget_obj    = $wp_registered_widgets[$widget_id];
        $widget_opt    = get_option($widget_obj['callback'][0]->option_name);
        $widget_num    = $widget_obj['params'][0]['number'];

        if (isset($widget_opt[$widget_num]['classes']) && !empty($widget_opt[$widget_num]['classes']))
            $params[0]['before_widget'] = preg_replace('/class="/', "class=\"{$widget_opt[$widget_num]['classes']} ", $params[0]['before_widget'], 1);
        return $params;
    }
    add_filter('dynamic_sidebar_params', 'kc_dynamic_sidebar_params');

    function storefront_comment($comment, $args, $depth)
    {
        if ('div' === $args['style']) {
            $tag       = 'div';
            $add_below = 'comment';
        } else {
            $tag       = 'li';
            $add_below = 'div-comment';
        }
    ?>
        <<?php echo esc_attr($tag); ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
            <div class="comment-body">
                <div class="comment-meta commentmetadata">
                    <div class="comment-author vcard">
                        <?php echo get_avatar($comment, 128); ?>

                    </div>
                    <?php if ('0' === $comment->comment_approved) : ?>
                        <em class="comment-awaiting-moderation"><?php esc_attr_e('Your comment is awaiting moderation.', 'storefront'); ?></em>
                        <br />
                    <?php endif; ?>
                    <div class="comment-metabox">
                        <?php printf(wp_kses_post('<cite class="fn">%s</cite>', 'storefront'), get_comment_author_link()); ?>
                        <a href="<?php echo esc_url(htmlspecialchars(get_comment_link($comment->comment_ID))); ?>" class="comment-date">
                            <?php echo ' - <time datetime="' . get_comment_date('c') . '">' . get_comment_date() . '</time>'; ?>
                        </a>
                    </div>


                </div>
                <?php if ('div' !== $args['style']) : ?>
                    <div id="div-comment-<?php comment_ID(); ?>" class="comment-content">
                    <?php endif; ?>
                    <div class="comment-text">
                        <?php comment_text(); ?>
                    </div>
                    <div class="reply">
                        <?php
                        comment_reply_link(
                            array_merge(
                                $args,
                                array(
                                    'add_below' => $add_below,
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                )
                            )
                        );
                        ?>
                        <?php edit_comment_link(__('Edit', 'storefront'), '  ', ''); ?>
                    </div>
                    </div>
                    <?php if ('div' !== $args['style']) : ?>
            </div>
        <?php endif; ?>
    <?php
    }


    add_filter('comment_form_default_fields', 'comment_form_cs', 10, 2);
    function comment_form_cs($fields)
    {
        unset($fields['url']);
        return $fields;
    }

    add_filter('comment_form_fields', 'wpb_move_comment_field_to_bottom');
    function wpb_move_comment_field_to_bottom($fields)
    {
        $comment_field = $fields['comment'];
        $cookies = $fields['cookies'];
        unset($fields['comment']);
        unset($fields['cookies']);

        $fields['comment'] = $comment_field;
        $fields['cookies'] = $cookies;
        return $fields;
    }

    add_filter('comment_form_field_comment', 'my_update_comment_field');
    function my_update_comment_field($comment_field)
    {

        $comment_field =
            '<p class="comment-form-comment">
            <label for="comment"></label>
            <textarea required id="comment" name="comment" placeholder="' . esc_attr__("Your comment", "text-domain") . '" cols="45" rows="8" aria-required="true"></textarea>
        </p>';

        return $comment_field;
    }


    add_filter('comment_form_default_fields', 'my_update_comment_fields');
    function my_update_comment_fields($fields)
    {

        $commenter = wp_get_current_commenter();
        $req       = get_option('require_name_email');
        $label     = $req ? '*' : ' ' . __('(optional)', 'text-domain');
        $aria_req  = $req ? "aria-required='true'" : '';

        $fields['author'] =
            '<p class="comment-form-author">
			<label for="author"><i class="fas fa-user"></i></label>
			<input id="author" name="author" type="text" placeholder="' . esc_attr__("Name", "text-domain") . '" value="' . esc_attr($commenter['comment_author']) .
            '" size="30" ' . $aria_req . ' />
		</p>';

        $fields['email'] =
            '<p class="comment-form-email">
			<label for="author"><i class="fa fa-envelope" aria-hidden="true"></i></label>
			<input id="email" name="email" type="email" placeholder="' . esc_attr__("Email", "text-domain") . '" value="' . esc_attr($commenter['comment_author_email']) .
            '" size="30" ' . $aria_req . ' />
		</p>';

        return $fields;
    }

    add_filter('wp_get_attachment_image_attributes', 'change_attachement_image_attributes', 20, 2);
    function change_attachement_image_attributes($attr, $attachment)
    {
        // Get post parent
        $parent = get_post_field('post_parent', $attachment);

        // Get post type to check if it's product
        $type = get_post_field('post_type', $parent);
        if ($type != 'product'  || $attr['class'] == 'custom-logo') {
            return $attr;
        }

        /// Get title
        $title = get_post_field('post_title', $parent);

        $attr['alt'] = $title;
        $attr['title'] = $title;

        return $attr;
    }

    add_filter('woocommerce_structured_data_product', 'd_structured_data_poduct', 10, 2);
    function d_structured_data_poduct($markup, $product)
    {
        $gtin = get_post_meta($product->get_id(), '_gtin', true);
        $markup['brand'] = 'Baketivity'; // Set sku to product id.
        $markup['gtin8'] = $gtin;
        return $markup;
    }

    add_action('woocommerce_product_options_inventory_product_data', 'woocommerce_render_gtin_field');
    function woocommerce_render_gtin_field()
    {
        $input   = array(
            'id'          => '_gtin',
            'label'       => sprintf(
                '<abbr title="%1$s">%2$s</abbr>',
                _x('Global Trade Identification Number', 'field label', 'my-theme'),
                _x('GTIN', 'abbreviated field label', 'my-theme')
            ),
            'value'       => get_post_meta(get_the_ID(), '_gtin', true),
            'desc_tip'    => true,
            'description' => __('Enter the Global Trade Identification Number (UPC, EAN, ISBN, etc.)', 'my-theme'),
        );
    ?>

        <div id="gtin_attr" class="options_group">
            <?php woocommerce_wp_text_input($input); ?>
        </div>
    <?php
    }


    /**
     * Save the product's GTIN number, if provided.
     *
     * @param int $product_id The ID of the product being saved.
     */
    add_action('woocommerce_process_product_meta', 'woocommerce_save_gtin_field');
    function woocommerce_save_gtin_field($product_id)
    {
        if (
            !isset($_POST['_gtin'], $_POST['woocommerce_meta_nonce'])
            || (defined('DOING_AJAX') && DOING_AJAX)
            || !current_user_can('edit_products')
            || !wp_verify_nonce($_POST['woocommerce_meta_nonce'], 'woocommerce_save_data')
        ) {
            return;
        }

        $gtin = sanitize_text_field($_POST['_gtin']);

        update_post_meta($product_id, '_gtin', $gtin);
    }

    // define the woocommerce_loop_add_to_cart_args callback
    add_filter('woocommerce_loop_add_to_cart_args', 'filter_woocommerce_loop_add_to_cart_args', 10, 2);
    function filter_woocommerce_loop_add_to_cart_args($wp_parse_args, $product)
    {
        $wp_parse_args['attributes']['product_name'] =  $product->get_name();
        $wp_parse_args['attributes']['product_price'] =  $product->get_price();
        $wp_parse_args['attributes']['product_type'] =  $product->get_type();

        return $wp_parse_args;
    }

    add_action('comment_post', 'baketivity_notify_my_mail', 15, 3);
    function baketivity_notify_my_mail($comment_id, $comment_approved, $commentdata)
    {
        if ($commentdata['comment_type'] == 'review') {
            $comment = get_comment($comment_id);
            // $adminEmail = get_option( 'admin_email' );
            $adminEmail = 'meny@baketivity.com';
            $subject = sprintf('New Comment by: %s', $comment->comment_author);
            $message = sprintf('Hi admin, <br/>New comment added on %s <br/>Comment content : %s', get_the_title($comment->comment_post_ID), $comment->comment_content);
            wp_mail($adminEmail, $subject, $message);
        }
    }

    require 'inc/vote_function.php';
    require 'inc/shipping_functions.php';
    require 'inc/payment_functions.php';
    require 'inc/product_designer_functions.php';
    require 'inc/invitation_functions.php';
    require 'inc/restart_workflow.php';
    require 'inc/errors/class-log-events.php';

    function write($message)
    {
        file_put_contents(
            get_theme_file_path() . '/checkout-log.log',
            date('d-M-Y H:i:s') . ' - ' . $message . PHP_EOL,
            FILE_APPEND
        );
    }

    function dumper($data, $die = false)
    {
        if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '109.86.229.110', '134.249.136.215', '192.168.10.1'])) {
            echo '<pre>';
            var_dump($data);
            echo '</pre>';
            if ($die) die('---');
        }
    }
    /////////////////////////////////////////////////////////////////////

    function createRecipeFromZapier($prepared_post)
    {
        $postData = array(
            'post_title' => $prepared_post->post_title,
            'post_status' => 'publish',
            'post_type' => 'recipe'
        );

        $postId = wp_insert_post($postData);

        if (!empty($prepared_post->post_excerpt)) {
            $postMetaKeys = [
                'email_address',
                'phone',
                'town__city',
                'state',
                'street_address',
                'zip',
                'country',
                'child_first_name',
                'child_last_name',
                'parentlegal_guardian_first_name',
                'parentlegal_last_name',
                'are_you_a_baketivity_subscriber',
                'child_birthday',
                'how_did_you_hear_about_this',
                'video_'
            ];

            $postMeta = explode(' || ', $prepared_post->post_excerpt);

            if (!empty($postMeta)) {
                foreach ($postMeta as $postMetaKey => $postMetaValue) {
                    if ($postMetaKey != 15) {
                        if (!empty($postMetaKeys[$postMetaKey])) {
                            update_post_meta($postId, $postMetaKeys[$postMetaKey], trim($postMetaValue));
                        }
                    } else {
                        $entryId = (int) $postMetaValue;

                        if (!empty($entryId)) {
                            $entry = RGFormsModel::get_lead($entryId);

                            if (!empty($entry) && !empty($entry[35])) {
                                $postData = [
                                    'ID' => $postId,
                                    'post_content' => $entry[35],
                                ];

                                wp_update_post($postData);
                            }
                        }

                        //file_put_contents('zapier.txt', print_r([], true) . PHP_EOL, FILE_APPEND);
                    }
                }
            }
        }
    }

    add_filter('rest_pre_insert_post', 'rest_pre_insert_post_handler', 10, 2);
    function rest_pre_insert_post_handler($prepared_post, $request)
    {
        if (!empty($prepared_post) && !empty($prepared_post->post_author) && $prepared_post->post_author == 2850) {
            createRecipeFromZapier($prepared_post);
        }

        return $prepared_post;
    }

    function woocommerce_after_add_to_cart_form_add_button_invite()
    {
        global $product;
        if (in_array($product->get_id(), array(198943))) {
            echo '<a href="/choose-your-template/"><button class="invite ubtn-normal">Send Invite</button></a>';
            echo '<style>button.invite {font-weight: normal;
        border-radius: 20px;
        border-width: 3px;
        border-color: #ee324d;
        border-style: solid;
        background: #ee324d;
        color: #ffffff;
        font-family: "smoothy";
        text-transform: uppercase;
        margin-top: 10px;
        width: 186px;
        font-size:24px;}
        button.invite:hover{
        background: #fff;
        color: #ee324d;
        }
        @media all and (max-width: 460px){
            button.invite{ width: 250px;}
        }

        </style>';
        }
    };

    add_action('woocommerce_after_add_to_cart_form', 'woocommerce_after_add_to_cart_form_add_button_invite', 10, 0);

    ////// fixed shipping in subscription
    add_action('woocommerce_checkout_create_subscription', 'filter_subscriber_shipping_payment');
    function filter_subscriber_shipping_payment($subscription)
    {
        $subscription_id = $subscription->id;
        fixed_shipping_subscription_from_order($subscription_id);
    }

    add_action('wcs_webhook_subscription_updated', 'wcs_webhook_subscription_updated_callback');
    function wcs_webhook_subscription_updated_callback($subscription_id)
    {
        fixed_shipping_subscription_from_order($subscription_id);
    }

    function fixed_shipping_subscription_from_order($subscription_id)
    {
        $order = wc_get_order($subscription_id);
        $order_parent = wc_get_order($subscription_id);
        if (!$order || !$order_parent) return false;

        // backup
        if ($order->get_shipping_address_1()) {
            update_post_meta($subscription_id, 'backup_shipping_address_1', $order->get_shipping_address_1());
            update_post_meta($subscription_id, '_shipping_address_1', $order->get_shipping_address_1());
        }
        if ($order->get_shipping_address_2()) {
            update_post_meta($subscription_id, 'backup_shipping_address_2', $order->get_shipping_address_2());
            update_post_meta($subscription_id, '_shipping_address_2', $order->get_shipping_address_2());
        }
        if ($order->get_shipping_city()) {
            update_post_meta($subscription_id, 'backup_shipping_city', $order->get_shipping_city());
            update_post_meta($subscription_id, '_shipping_city', $order->get_shipping_city());
        }
        if ($order->get_shipping_state()) {
            update_post_meta($subscription_id, 'backup_shipping_state', $order->get_shipping_state());
            update_post_meta($subscription_id, '_shipping_state', $order->get_shipping_state());
        }
        if ($order->get_shipping_postcode()) {
            update_post_meta($subscription_id, 'backup_shipping_postcode', $order->get_shipping_postcode());
            update_post_meta($subscription_id, '_shipping_postcode', $order->get_shipping_postcode());
        }
        if ($order->get_shipping_country()) {
            update_post_meta($subscription_id, 'backup_shipping_country', $order->get_shipping_country());
            update_post_meta($subscription_id, '_shipping_country', $order->get_shipping_country());
        }
        if ($order->get_shipping_first_name()) {
            update_post_meta($subscription_id, 'backup_shipping_first_name', $order->get_shipping_first_name());
            update_post_meta($subscription_id, '_shipping_first_name', $order->get_shipping_first_name());
        }
        if ($order->get_shipping_last_name()) {
            update_post_meta($subscription_id, 'backup_shipping_last_name', $order->get_shipping_last_name());
            update_post_meta($subscription_id, '_shipping_last_name', $order->get_shipping_last_name());
        }
    }
    ////// fixed shipping in subscription

    ///// zeroing the coupon if a gift card is used
    function pw_gift_card_prevent_coupons($is_valid, $coupon)
    {
        $gift_cards_applied = false;


        if (defined('PWGC_SESSION_KEY')) {
            $session_data = (array) WC()->session->get(PWGC_SESSION_KEY);
            if (isset($session_data['gift_cards']) && count($session_data['gift_cards']) > 0) {
                $gift_cards_applied = true;
            }
        }

        if ($gift_cards_applied) {
            // Do not allow any coupon if there is a gift card applied.
            $is_valid = false;
        }

        return $is_valid;
    }

    //add_filter( 'woocommerce_coupon_is_valid_for_cart', 'pw_gift_card_prevent_coupons', 99999, 2 );
    //add_filter( 'woocommerce_coupon_is_valid_for_product', 'pw_gift_card_prevent_coupons', 99999, 2 );
    ///// zeroing the coupon if a gift card is used

    add_filter('fixed_shipping_total_received', 'fixed_shipping_total_received');
    function fixed_shipping_total_received($value)
    {
        if ($value == 'Shipping') $value = 'Free Shipping';
        return $value;
    }

    ////// rename Fee in subscription => Split order
    add_filter('gettext', 'fixed_fees_translate', 20, 3);
    function fixed_fees_translate($translated_text, $text, $domain)
    {
        global $pagenow, $typenow;

        $current_text = "Fees:";
        $new_text     = "Split Order:";

        if (is_admin() && in_array($pagenow, ['post.php', 'post-new.php']) && 'shop_order' == $typenow && $current_text == $text) {
            if (isset($_GET['post']) && !empty($_GET['post'])) {
                $post_id = intval($_GET['post']);
                $_save_base_shipping_total = get_post_meta($post_id, '_save_base_shipping_total', true);
                $_save_base_recurring_shipping_total = get_post_meta($post_id, '_save_base_recurring_shipping_total', true);
                if ($_save_base_shipping_total !== false && $_save_base_recurring_shipping_total !== false) {
                    $translated_text =  __($new_text, $domain);
                }
            }
        }
        return $translated_text;
    }
    ////// end rename Fee in subscription => Split order

    function get_woocommerce_order_splitter_for_subscription_and_simple_products()
    {
        if (class_exists('WooCommerceOrderSplitterForSubscriptionAndSimple')) {
            return WooCommerceOrderSplitterForSubscriptionAndSimple::get_woocommerce_order_splitter_for_subscription_and_simple_products();
        }
        return false;
    }

    //// get ACF image url by any get field result
    function get_acf_image_url($get_field_result)
    {
        if (is_array($get_field_result)) {
            return $get_field_result['url'];
        } else if (is_int($get_field_result)) {
            $image = wp_get_attachment_image_src($get_field_result, 'full');
            return isset($image[0]) ? $image[0] : false;
        } else {
            return $get_field_result;
        }
    }

    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    function replace_link_open()
    {
        echo "<div class='woocommerce-LoopProduct-link woocommerce-loop-product__link'>";
    }
    add_action('woocommerce_before_shop_loop_item', 'replace_link_open', 10);

    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 10);
    function replace_link_close()
    {
        echo "</div>";
    }
    add_action('woocommerce_after_shop_loop_item', 'replace_link_close', 10);


    remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    function link_title()
    {
        global $product;

        $link = apply_filters('woocommerce_template_loop_product_title', get_the_permalink(), $product);
        echo '<a href="' . esc_url($link) . '"class="link-title"><h4 class="' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title')) . '">' . get_the_title() . '</h4></a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    add_action('woocommerce_shop_loop_item_title', 'link_title', 10, 2);

    add_action('init', function () {
        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
        add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    });

    if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
        function woocommerce_template_loop_product_thumbnail()
        {
            echo woocommerce_get_product_thumbnail();
        }
    }

    if (!function_exists('woocommerce_get_product_thumbnail')) {
        function woocommerce_get_product_thumbnail($size = 'thumb-medium')
        {
            global $post, $woocommerce;
            $output = '';

            if (has_post_thumbnail()) {
                $output .= get_the_post_thumbnail($post->ID, $size);
            } else {
                $output .= wc_placeholder_img($size);
                // Or alternatively setting yours width and height shop_catalog dimensions.
                // $output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
            }
            //$output .= '</div>';
            return $output;
        }
    }

    /**
     * Trim text, strip shortcodes and excerpt return 
     * 
     * @param Int $post - Post ID (optional)
     * @param String $text - Text or get_the_conten() (optional)
     * @param Int $words - Number of words to return
     * 
     * @return string - "Ex: This is my text trim and..."
     * 
     * Use: echo custom_trim_excerpt($post_id, '', 20 ); 
     * Use: echo custom_trim_excerpt('', get_the_content(), 20 ); 
     * Use: echo custom_trim_excerpt('', $my_text, 20 ); 
     * Print: "This is my text trim and..."
     */
    function custom_trim_excerpt($post, $text, $words, $dots)
    {

        if ($post) {
            $content = get_the_content('', false, $post);
        }
        if ($text) {
            $content = $text;
        }

        $content = excerpt_remove_blocks($content);
        $content = apply_filters('the_content', $content);
        $content = strip_shortcodes($content);
        $content = str_replace(']]>', ']]&gt;', $content);

        if ($dots) {
            $dots = '...';
        }

        if ($words) {
            $content = wp_trim_words($content, $words, $dots);
        }

        return $content;
    }


    function cc_mime_types($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
    add_filter('upload_mimes', 'cc_mime_types');

    /*----------------------------------------*\
    Data layer for GTM & UA4
\*----------------------------------------*/

    require_once('inc/datalayer.class.php'); // Google Tag Manager
    require_once('inc/tracking-pixels.class.php'); // Tracking pixels
    //require_once ('inc/seo-metadata-importer.php'); // Importer title & description for SEO (Not used)
    require_once('inc/amazon-pixels.class.php'); // Amazon tracking pixels  & Amazon Cart
