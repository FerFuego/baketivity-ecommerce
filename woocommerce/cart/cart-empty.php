<?php

/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

?>

<style>
	.entry-header {
		display: none !important;
	}

	.column-collaterals {
		display: none !important;
	}
</style>
<div class="custom-woocommerce-cart-empty">
	<div class="custom-woocommerce-message">
		<?php
		/*
		* @hooked wc_empty_cart_message - 10
		*/
		do_action('woocommerce_cart_is_empty');
		?>
	</div>

	<i class="shopping-cart-empty"></i>

	<p class="return-to-shop">
		<a class="btn-custom-return" href="<?php echo esc_url(home_url('/shop/')); ?>">
			<i class="return-icon"></i>
			<?php esc_html_e('Return to shop', 'woocommerce'); ?>
		</a>
	</p>
</div>