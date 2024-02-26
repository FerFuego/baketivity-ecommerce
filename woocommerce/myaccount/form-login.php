<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

do_action('woocommerce_before_customer_login_form'); ?>

<!-- LOGIN FORM -->
<div class="u-columns baketivity-my-account__login-page__login-section" id="login-section">
	<h3 class="baketivity-my-account__login-page__title"><?php esc_html_e('Sign in', 'woocommerce'); ?></h3>
	<form class="woocommerce-form woocommerce-form-login baketivity-my-account__login-page__form login" method="post">

		<?php do_action('woocommerce_login_form_start'); ?>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<input placeholder="Email address" type="text" class="input-text baketivity-my-account__login-page__input" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																																					?>
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<input placeholder="Password" class="input-text baketivity-my-account__login-page__input" type="password" name="password" id="password" autocomplete="current-password" />
			<i class="baketivity-my-account__login-page__eye baketivity-my-account__login-page__eye--close" id="js-action-eye" onclick="showPassword(this, 'password');"></i>
		</p>

		<?php do_action('woocommerce_login_form'); ?>

		<div class="form-row baketivity-my-account__login-page__content">
			<label for="rememberme" class="woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme baketivity-my-account__login-page__label">
				<input class="woocommerce-form__input woocommerce-form__input-checkbox baketivity-my-account__login-page__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
			</label>
			<div class="woocommerce-LostPassword lost_password baketivity-my-account__login-page__lostcontainer">
				<a class="baketivity-my-account__login-page__lostpassword" href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Forgot your password?', 'woocommerce'); ?></a>
			</div>
		</div>

		<p class="form-row baketivity-my-account__login-page__actions">
			<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
			<button type="submit" class="baketivity-my-account__login-page__submit button-hovered" name="login" id="js-login" value="<?php esc_attr_e('login', 'woocommerce'); ?>" disabled><?php esc_html_e('Sign in', 'woocommerce'); ?></button>
			<?php //echo do_shortcode('[google_login button_text="Sign in with Google" force_display="yes" /]'); 
			?>
		<div class="baketivity-my-account__login-page__response" id="js-register-messageForm"></div>
		</p>

		<?php printf(
			'<div class="baketivity-my-account__login-page__text">%s <a href="#register-section" id="js-register-section" class="baketivity-my-account__login-page__cta-signup btn-action-myaccount">%s</a></div>',
			esc_html__('Don’t have an account?', 'baketivity'),
			esc_html__('Sign up', 'woocommerce')
		); ?>

		<?php do_action('woocommerce_login_form_end'); ?>

	</form>
</div>

<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

	<!-- REGISTER FORM -->
	<div class="u-column2 baketivity-my-account__login-page__register-section" style="display: none;" id="register-section">

		<h3 class="baketivity-my-account__login-page__title"><?php esc_html_e('Sign up', 'woocommerce'); ?></h3>

		<form method="post" id="js-register-form" class="woocommerce-form woocommerce-form-register baketivity-my-account__login-page__form register">

			<?php do_action('woocommerce_register_form_start'); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide baketivity-my-account__login-page__input-email">
				<input type="email" placeholder="Email Address" class="input-text baketivity-my-account__login-page__input" name="email" id="reg_email" autocomplete="email" />
			</p>

			<?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="input-text baketivity-my-account__login-page__input" name="password" id="reg_password" autocomplete="new-password" />
				</p>

			<?php else : ?>

				<div class="baketivity-my-account__login-page__instructions"><?php esc_html_e('An email with instructions to set your password will be sent to this address.', 'baketivity'); ?></div>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<input type="text" class="input-text baketivity-my-account__login-page__input" name="firstname" id="firstname" placeholder="First name" autocomplete="none" />
			</p>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<input type="text" class="input-text baketivity-my-account__login-page__input" name="lastname" id="lastname" placeholder="Last name" autocomplete="none" />
			</p>

			<div class="baketivity-my-account__login-page__register-content">
				<label for="newsletter" class="woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme baketivity-my-account__login-page__label-register">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox baketivity-my-account__login-page__input-checkbox" name="newsletter" type="checkbox" id="newsletter" value="newsletter">
					<span>I want to receive Baketivity emails</span>
				</label>
			</div>

			<div class="baketivity-my-account__login-page__instructions baketivity-my-account__login-page__instructions--last"><?php esc_html_e('Get ready to enjoy subscriber-only content such as exclusive promos, new kits announcements, and more.', 'baketivity'); ?></div>

			<?php //do_action( 'woocommerce_register_form' ); 
			?>

			<p class="woocommerce-form-row form-row baketivity-my-account__login-page__register-submit">
				<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
				<button type="submit" class="baketivity-my-account__login-page__submit button-hovered btn-spinner" name="register" id="js-register" value="<?php esc_attr_e('Sign up', 'baketivity'); ?>" disabled><?php esc_html_e('Sign up', 'baketivity'); ?></button>
			<div class="baketivity-my-account__login-page__response" id="js-register-messageForm"></div>
			</p>

			<?php printf(
				'<div class="baketivity-my-account__login-page__last-row"><a href="#login-section" id="js-login-section" class="baketivity-my-account__login-page__cta-signin btn-action-myaccount">%s</a></div>',
				esc_html__('Sign in instead', 'woocommerce')
			); ?>

			<?php do_action('woocommerce_register_form_end'); ?>

		</form>

	</div>

<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>