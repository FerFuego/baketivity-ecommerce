<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>

<style scoped>
	.site-content {
		background-color: #F8F8F8;
	}

	.col-full {
		margin: 0 !important;
		max-width: 100% !important;
		padding-bottom: 0 !important;
	}
</style>

<div class="woocommerce-order thankyou-page">

	<?php if ($order) :

		do_action('woocommerce_before_thankyou', $order->get_id()); ?>

		<?php if ($order->has_status('failed')) : ?>

			<!-- ERROR PAGE -->
			<div class="thankyou-page__container">
				<img class="thankyou-page__image" src="<?php echo get_stylesheet_directory_uri() . '/images/fail.png'; ?>" alt="fail">
				<h3 class="thankyou-page__title"><?= esc_html_e('Ups! An error occurred!', 'baketivity'); ?></h3>
				<p class="thankyou-page__copy"><?= esc_html_e('Please try again!', 'baketivity'); ?></p>
				<a class="thankyou-page__button" href="<?php echo esc_url(home_url('/')); ?>"><?= esc_html_e('Go to Home', 'baketivity'); ?></a>
			</div>

		<?php else : ?>

			<!-- SUCCESS PAGE -->
			<div class="thankyou-page__container">
				<div class="thankyou-page__hero">
					<img class="thankyou-page__image" src="<?php echo get_stylesheet_directory_uri() . '/images/checkout/icon_success_summary.webp'; ?>" alt="icon success summary">
					<h3 class="thankyou-page__title"><?= esc_html_e('Sweet! Your order was received!', 'baketivity'); ?></h3>
					<p class="thankyou-page__copy"><?= esc_html_e('Look out for an email confirming the delicious details!', 'baketivity'); ?></p>
					<!-- <form class="thankyou-page__hero-form">
						<label for="how-hear" class="thankyou-page__hero-form-label"><?= esc_html_e('How did you hear about Baketivity?', 'baketivity'); ?></label>
						<div class="thankyou-page__hero-form-row">
							<select class="thankyou-page__hero-form-select" name="how-hear" id="how-hear">
								<option value="" selected><?php //echo esc_html_e('Select an option', 'baketivity'); 
															?></option>
								<option value="google"><?php //echo esc_html_e('Google', 'baketivity'); 
														?></option>
								<option value="instagram"><?php //echo esc_html_e('Instagram', 'baketivity'); 
															?></option>
								<option value="facebook"><?php //echo esc_html_e('Facebook', 'baketivity'); 
															?></option>
								<option value="other"><?php //echo esc_html_e('Other', 'baketivity'); 
														?></option>
							</select>
							<input class="thankyou-page__hero-form-submit" type="submit" value="<?php //echo esc_html_e('Submit', 'baketivity'); 
																								?>">
						</div>
					</form> -->
					<a class="thankyou-page__button" href="<?php echo esc_url(home_url('/shop')); ?>"><?= esc_html_e('Continue shopping', 'baketivity'); ?></a>
				</div>
			</div>

			<div class="thankyou-page__container">
				<div class="thankyou-page__banner">
					<h3 class="thankyou-page__title">
						<?php printf(
							'%1$s <strong>%2$s</strong> %3$s',
							esc_html__('Get', 'baketivity'),
							'10%off',
							esc_html__('on your next order', 'baketivity')
						); ?>
					</h3>
					<p class="thankyou-page__copy"><?= esc_html_e('Share the joy of baking with friends and win $10 for every referral. Every buddy you invite gets $10 OFF their first kit. And you get a $10 credit when they make their first purchase.', 'baketivity'); ?></p>
					<a class="thankyou-page__button" href="/referral">Refer a friend</a>
					<!-- <form class="thankyou-page__form">
						<input class="thankyou-page__input" type="email" name="email" placeholder="<?php //echo esc_html__('Add your friend’s emails', 'baketivity'); 
																									?>">
						<button class="thankyou-page__button thankyou-page__button--submit" type="submit"><?php //echo esc_html__('Get it!', 'baketivity'); 
																											?></button>
					</form> -->
				</div>
			</div>

			<div class="thankyou-page__resume">
				<div class="thankyou-page__content-1">
					<?php do_action('woocommerce_thankyou', $order->get_id()); ?>
					<div class="woocommerce-column woocommerce-column--3 woocommerce-column--payment-method col-3">
						<h2 class="woocommerce-column__title"><?= esc_html_e('Payment Methods', 'baketivity'); ?></h2>
						<address>
							<?php echo wp_kses_post($order->get_payment_method_title()); ?>
						</address>
					</div>
					<div class="thankyou-page__terms"><?= esc_html_e('Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.', 'baketivity'); ?></div>
				</div>
				<div class="thankyou-page__content-2">
					<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
						<li class="woocommerce-order-overview__order order">
							<?php esc_html_e('Order number:', 'woocommerce'); ?>
							<strong>
								<?php echo $order->get_order_number(); ?></strong>
						</li>
						<li class="woocommerce-order-overview__date date">
							<?php esc_html_e('Date:', 'woocommerce'); ?>
							<strong><?php echo wc_format_datetime($order->get_date_created()); ?></strong>
						</li>
					</ul>
					<?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
				</div>
			</div>

			<?php do_action('woocommerce_after_thankyou', $order->get_id()); ?>

		<?php endif; ?>

	<?php else : ?>

		<!-- ERROR PAGE -->
		<div class="thankyou-page__container">
			<img class="thankyou-page__image" src="<?php echo get_stylesheet_directory_uri() . '/images/fail.png'; ?>" alt="fail">
			<h3 class="thankyou-page__title"><?= esc_html_e('Ups! An error occurred!', 'baketivity'); ?></h3>
			<p class="thankyou-page__copy"><?= esc_html_e('Please try again!', 'baketivity'); ?></p>
			<a class="thankyou-page__button" href="<?php echo esc_url(home_url('/')); ?>"><?= esc_html_e('Go to Home', 'baketivity'); ?></a>
		</div>

	<?php endif; ?>

</div>