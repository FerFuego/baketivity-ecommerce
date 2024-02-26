<?php

/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_reset_password_form');
?>

<div class="baketivity-my-account__reset-section">

	<h3 class="baketivity-my-account__login-page__title"><?php esc_html_e('Reset password', 'woocommerce'); ?></h3>

	<form method="post" class="woocommerce-ResetPassword lost_reset_password baketivity-my-account__reset-password" id="resetPasswordForm">

		<p><?php echo apply_filters('woocommerce_reset_password_message', esc_html__('Enter a new password below.', 'woocommerce')); ?></p><?php // @codingStandardsIgnoreLine 
																																			?>

		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
			<label for="password_1"><?php esc_html_e('New password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--text input-text baketivity-my-account__input" name="password_1" id="password_1" autocomplete="new-password" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
			<label for="password_2"><?php esc_html_e('Re-enter new password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--text input-text baketivity-my-account__input" name="password_2" id="password_2" autocomplete="new-password" />
		</p>

		<input type="hidden" name="reset_key" value="<?php echo esc_attr($args['key']); ?>" />
		<input type="hidden" name="reset_login" value="<?php echo esc_attr($args['login']); ?>" />

		<div class="clear"></div>

		<?php do_action('woocommerce_resetpassword_form'); ?>

		<p class="woocommerce-form-row form-row baketivity-my-account__container">
			<input type="hidden" name="wc_reset_password" value="true" />
			<button type="submit" class="woocommerce-Button button baketivity-my-account__button" value="<?php esc_attr_e('Save', 'woocommerce'); ?>"><?php esc_html_e('Save', 'woocommerce'); ?></button>
		</p>

		<div class="baketivity-my-account__login-page__response mt-3" id="js-reset-messageForm"></div>

		<?php wp_nonce_field('reset_password', 'woocommerce-reset-password-nonce'); ?>

	</form>

	<!-- Validate reset password form with js -->
	<script>
		function validateResetPasswordForm(passwordId, confirmPasswordId) {
			var passwordInput = document.getElementById(passwordId);
			var confirmPasswordInput = document.getElementById(confirmPasswordId);
			var message = document.getElementById("js-reset-messageForm");
			message.innerHTML = "";

			if (passwordInput.value !== confirmPasswordInput.value) {
				// Display an error message indicating that the passwords do not match
				message.innerHTML = "<p class='text-danger'>Passwords do not match.</p>";
				return false;
			}

			if (passwordInput.value.length < 8) {
				// Display an error message indicating that the password should have 8 or more characters
				message.innerHTML = "<p class='text-danger'>Password should have 8 or more characters.</p>";
				return false;
			}

			if (passwordInput.value.indexOf(' ') !== -1) {
				// Display an error message indicating that the password should not contain spaces
				message.innerHTML = "<p class='text-danger'>Password should not contain spaces.</p>";
				return false;
			}

			return true;
		}

		var resetPasswordForm = document.getElementById("resetPasswordForm");

		resetPasswordForm.addEventListener("submit", function(event) {
			event.preventDefault(); // Prevent the form from submitting

			var message = document.getElementById("js-reset-messageForm");
			message.innerHTML = "";

			// Call the validateResetPasswordForm function, passing the IDs of the password and confirm password input fields
			if (validateResetPasswordForm("password_1", "password_2")) {
				// The password and confirm password inputs match, submit the form				
				resetPasswordForm.submit();
				// If the passwords match and the form is valid, send message
				message.innerHTML = "<p class='text-success'>Password changed! refreshing...</p>";
			}
		});
	</script>

</div>
<?php
do_action('woocommerce_after_reset_password_form');
