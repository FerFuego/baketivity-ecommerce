<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<div class="woocommerce-cart-container">
	<form class="woocommerce-cart-form animate__animated animate__bounceInLeft" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
		<?php do_action('woocommerce_before_cart_table'); ?>

		<!-- WOOCOMMERCE LOOP CART -->
		<?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
			$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
			$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key); ?>

			<!-- IF SUBSCRIPTIONS -->
			<?php if ($_product && $_product->exists() && $_product->get_type() == 'subscription' && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) :
				$subscription__items[] = [
					'cart_item'		=> $cart_item,
					'cart_item_key'	=> $cart_item_key,
					'_product'		=> $_product,
					'product_id'	=> $product_id,
					'product_name'	=> $product_name
				];
			endif; ?>

			<!-- IF SIMPLE -->
			<?php if ($_product && $_product->exists() && $_product->get_type() == 'simple' && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) :
				$simple__items[] = [
					'cart_item'		=> $cart_item,
					'cart_item_key'	=> $cart_item_key,
					'_product'		=> $_product,
					'product_id'	=> $product_id,
					'product_name'	=> $product_name
				];
			endif; ?>
		<?php endforeach; ?>

		<!-- SUBSCRIPTIONS HTML TABLE -->
		<?php if (!empty($subscription__items)) : ?>
			<div class="woocommerce-cart-form__table-container">
				<h4 class="woocommerce-cart-form__table-title">Subscriptions</h4>
				<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents table-custom-styles gfg" cellspacing="0">
					<?php do_action('woocommerce_before_cart_contents'); ?>
					<tbody>
						<!-- items -->
						<?php foreach ($subscription__items as $subscription__item) :
							$cart_item		= $subscription__item['cart_item'];
							$cart_item_key	= $subscription__item['cart_item_key'];
							$_product		= $subscription__item['_product'];
							$product_id		= $subscription__item['product_id'];
							$product_name	= $subscription__item['product_name'];
							# print template part
							set_query_var('cart_item', $cart_item);
							set_query_var('cart_item_key', $cart_item_key);
							set_query_var('_product', $_product);
							set_query_var('product_id', $product_id);
							set_query_var('product_name', $product_name);
							set_query_var('product_permalink', apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key));
							wc_get_template_part('content', 'cart_item');
						endforeach; ?>
						<?php do_action('woocommerce_after_cart_contents'); ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>

		<!-- SIMPLE HTML TABLE -->
		<?php if (!empty($simple__items)) : ?>
			<div class="woocommerce-cart-form__table-container">
				<h4 class="woocommerce-cart-form__table-title">Products</h4>
				<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents table-custom-styles gfg" cellspacing="0">
					<?php do_action('woocommerce_before_cart_contents'); ?>
					<tbody>
						<!-- items -->
						<?php foreach ($simple__items as $simple__item) :
							$cart_item		= $simple__item['cart_item'];
							$cart_item_key	= $simple__item['cart_item_key'];
							$_product		= $simple__item['_product'];
							$product_id		= $simple__item['product_id'];
							$product_name	= $simple__item['product_name'];
							# print template part
							set_query_var('cart_item', $cart_item);
							set_query_var('cart_item_key', $cart_item_key);
							set_query_var('_product', $_product);
							set_query_var('product_id', $product_id);
							set_query_var('product_name', $product_name);
							set_query_var('product_permalink', apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key));
							wc_get_template_part('content', 'cart_item');
						endforeach; ?>

						<?php do_action('woocommerce_after_cart_contents'); ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>

		<?php do_action('woocommerce_cart_contents'); ?>

		<!-- Update Cart Button-->
		<button type="submit" class="button woocommerce-cart__update-btn" name="update_cart" value="Update cart">Update cart</button>
		<?php do_action('woocommerce_cart_actions'); ?>
		<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
		<!-- End Update Cart Button-->

		<?php do_action('woocommerce_after_cart_table'); ?>

		<p class="woocommerce-cart-form__disclamer"><?= esc_html_e('Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.', 'baketivity'); ?></p>

	</form>

	<div class="column-collaterals animate__animated animate__bounceInRight" id="order_review">
		<?php do_action('woocommerce_before_cart_collaterals'); ?>

		<div class="cart-collaterals">
			<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action('woocommerce_cart_collaterals');
			?>
		</div>
	</div>

	<div class="woocommerce-new-cart__proced-to-checkout-mobile">
		<!-- Show only in mobile -->
		<a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button wc-forward btn-spinner"><?php esc_html_e('Secure Checkout', 'woocommerce'); ?></a>
	</div>
</div>

<?php do_action('woocommerce_after_cart'); ?>