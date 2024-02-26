<?php

/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<div class="baketivity-my-account__dashboard">
    <div class="baketivity-my-account__dashboard__body">
        <div class="baketivity-my-account__dashboard__content-data">
            <h3 class="baketivity-my-account__dashboard__title"><?php _e('Account Settings', 'baketivity'); ?></h3>
            <div class="baketivity-my-account__dashboard__items">

                <!-- Personal Information -->
                <div class="baketivity-my-account__dashboard__item">
                    <h4 class="baketivity-my-account__dashboard__item-title"><?php _e('Personal Information', 'baketivity'); ?> <a href="<?php echo wc_get_endpoint_url('edit-account'); ?>"><?php _e('Edit', 'baketivity'); ?></a></h4>
                    <ul class="baketivity-my-account__dashboard__item-ul">
                        <li class="baketivity-my-account__dashboard__item-li"><b><?php _e('First Name', 'baketivity'); ?></b>: <?php echo $current_user->user_firstname; ?></li>
                        <li class="baketivity-my-account__dashboard__item-li"><b><?php _e('Last Name', 'baketivity'); ?></b>: <?php echo $current_user->user_lastname; ?></li>
                        <li class="baketivity-my-account__dashboard__item-li"><b><?php _e('Email', 'baketivity'); ?></b>: <?php echo $current_user->user_email; ?></li>
                    </ul>
                </div>

                <!-- Payment Method -->
                <div class="baketivity-my-account__dashboard__item">
                    <h4 class="baketivity-my-account__dashboard__item-title"><?php _e('Payment Method', 'baketivity'); ?> <a href="/my-account/payment-methods/"><?php _e('Edit', 'baketivity'); ?></a></h4>
                    <?php
                    $saved_methods = wc_get_customer_saved_methods_list(get_current_user_id());
                    $has_methods   = (bool) $saved_methods;
                    ?>
                    <ul class="baketivity-my-account__dashboard__item-ul">
                        <?php if ($has_methods) : ?>
                            <?php foreach ($saved_methods as $type => $methods) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
                            ?>
                                <?php foreach ($methods as $method) : ?>
                                    <?php if ($method['is_default'] == 1) : ?>
                                        <li class="baketivity-my-account__dashboard__item-li">
                                            <div class="baketivity-my-account__dashboard__item-li-img">
                                                <?php
                                                $link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";
                                                $file = $link . '/wp-content/themes/baketivity/images/cards/' . strtolower($method['method']['brand']) . '.svg';
                                                $content = file_get_contents($file);
                                                if ($content) : ?>
                                                    <img src="<?php echo $file; ?>" width="34px" height="19px" alt="<?php _e($method['method']['brand'], 'bavetivity'); ?>">
                                                <?php else : ?>
                                                    <img src="/wp-content/themes/baketivity/images/cards/credit-card.svg" width="34px" height="19px" alt="<?php _e($method['method']['brand'], 'bavetivity'); ?>">
                                                <?php endif; ?>
                                                <?php echo $type; ?> <?php _e('ending in', 'baketivity'); ?>: <?php echo esc_html($method['method']['last4']); ?>
                                            </div>
                                            <b><?php _e('Expires', 'baketivity'); ?></b>: <?php echo esc_html($method['expires']); ?>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li class="baketivity-my-account__dashboard__item-li"><?php esc_html_e('No saved methods found.', 'woocommerce'); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Billing Address -->
                <?php if ($current_user->billing_address_1) : ?>
                    <div class="baketivity-my-account__dashboard__item">
                        <h4 class="baketivity-my-account__dashboard__item-title"><?php _e('Billing Information', 'baketivity'); ?> <a href="<?php echo wc_get_endpoint_url('edit-address'); ?>"><?php _e('Edit', 'baketivity'); ?></a></h4>
                        <ul class="baketivity-my-account__dashboard__item-ul">
                            <li class="baketivity-my-account__dashboard__item-li"><?php echo $current_user->billing_first_name; ?> <?php echo $current_user->billing_last_name; ?></li>
                            <li class="baketivity-my-account__dashboard__item-li"><?php echo $current_user->billing_address_1; ?> <?php echo $current_user->billing_address_2; ?></li>
                            <li class="baketivity-my-account__dashboard__item-li"><?php echo $current_user->billing_city; ?>, <?php echo $current_user->billing_postcode; ?>, <?php echo $current_user->billing_state; ?></li>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Shipping Addres -->
                <?php if ($current_user->shipping_address_1) : ?>
                    <div class="baketivity-my-account__dashboard__item">
                        <h4 class="baketivity-my-account__dashboard__item-title"><?php _e('Shipping Information', 'baketivity'); ?> <a href="<?php echo wc_get_endpoint_url('edit-address'); ?>"><?php _e('Edit', 'baketivity'); ?></a></h4>
                        <ul class="baketivity-my-account__dashboard__item-ul">
                            <li class="baketivity-my-account__dashboard__item-li"><?php echo $current_user->shipping_first_name; ?> <?php echo $current_user->shipping_last_name; ?></li>
                            <li class="baketivity-my-account__dashboard__item-li"><?php echo $current_user->shipping_address_1; ?> <?php echo $current_user->shipping_address_2; ?></li>
                            <li class="baketivity-my-account__dashboard__item-li"><?php echo $current_user->shipping_city; ?>, <?php echo $current_user->shipping_postcode; ?>, <?php echo $current_user->shipping_state; ?></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Order -->
        <div class="baketivity-my-account__dashboard__content">
            <h3 class="baketivity-my-account__dashboard__title"><?php _e('Recent Orders', 'baketivity'); ?></h3>
            <div class="baketivity-my-account__dashboard__items">
                <?php
                $user_id    = get_current_user_id(); // Get the current user ID
                $customer   = new WC_Customer($user_id); // Get the WC_Customer instance Object from current user ID
                $last_order = $customer->get_last_order(); // Get the last WC_Order Object instance from current customer
                if ($last_order) :
                    $order_id     = $last_order->get_id(); // Get the order id
                    $order_data   = $last_order->get_data(); // Get the order unprotected data in an array
                    $order_status = $last_order->get_status(); // Get the order status

                    foreach ($last_order->get_items() as $item) :
                        $product    = wc_get_product($item->get_product_id());
                        $name       = $product->get_name();
                        $price      = $product->get_regular_price();
                        $image_id   = $product->get_image_id();
                ?>
                        <div class="baketivity-my-account__dashboard__item-order">
                            <div class="baketivity-my-account__dashboard__item-order-container">
                                <div class="baketivity-my-account__dashboard__item-order-img">
                                    <img src="<?php echo wp_get_attachment_url($image_id); ?>" alt="<?php echo $name; ?>">
                                </div>
                                <p class="baketivity-my-account__dashboard__item-order-title"><?php echo $name; ?></p>
                            </div>
                            <div class="baketivity-my-account__dashboard__item-order-price">
                                <small><?php echo $item->get_quantity(); ?> x </small><?php echo get_woocommerce_currency_symbol(); ?><?php echo $price; ?>
                            </div>
                        </div>
                    <?php endforeach;
                else : ?>
                    <p class="baketivity-my-account__dashboard__item-order-empty"><?php _e('No recent order found.', 'baketivity'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */