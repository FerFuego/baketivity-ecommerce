<?php
/*
 * Template name: Checkout
 *
 */
get_header('checkout'); ?>

<?php $total_cart_items = WC()->cart->get_cart_contents_count(); ?>

<!--Show empty cart image & button-->
<?php if($total_cart_items == 0 && !is_wc_endpoint_url('order-received')) { ?>
	<div class="custom-woocommerce-cart-empty">
		<div class="custom-woocommerce-message">
			<?php do_action( 'woocommerce_cart_is_empty' ); ?>
		</div>
		<i class="shopping-cart-empty"></i>
		<p class="return-to-shop">
			<a class="btn-custom-return" href="<?php echo esc_url(home_url('/shop/')); ?>">
				<i class="return-icon"></i>
				<?php esc_html_e( 'Return to shop', 'woocommerce' ); ?>
			</a>
		</p>
	</div>
<?php } ?>

<!-- Content-->
<?php the_content(); ?>

<!-- Footer-->
<?php get_footer('checkout'); ?>