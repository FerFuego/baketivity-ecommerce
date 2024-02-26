<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<?php 
    $user_id = get_current_user_id(); 
    $current_user = wp_get_current_user();
?>

<nav class="woocommerce-MyAccount-navigation baketivity-my-account__dashboard__navigation">
    <div class="baketivity-my-account__dashboard__account">
        <div class="baketivity-my-account__dashboard__account-avatar">
            <?php echo get_avatar( $user_id, 100 ); ?>
        </div>
        <div class="baketivity-my-account__dashboard__account-avatar-name">
            <h4><?php _e('Hello', 'baketivity'); ?> <?php echo $current_user->user_firstname; ?>!</h4>
            <p><?php echo $current_user->user_email; ?></p>
            <a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
        </div>
    </div>
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
