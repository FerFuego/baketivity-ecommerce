<?php

/**
 * Template Name: Baketivity Time Invite
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="landing-page">

    <div class="u-columns baketivity-time-invite__login-section" id="login-section">
        <h3 class="baketivity-time-invite__title"><?php _e('You’re in! See you soon for delicious memories', 'baketivity'); ?></h3>
        <p class="baketivity-time-invite__subtitle"><?php _e('Spread the love by inviting friends and family to create memories of their own!', 'baketivity'); ?></p>
        <form class="woocommerce-form woocommerce-form-login baketivity-time-invite__form login" method="post">
            <label class="baketivity-time-invite__label"><?php _e('Enter the emails of family and friends you’d like to invite below:', 'baketivity'); ?></label>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input placeholder="Email address" type="text" class="input-text baketivity-time-invite__input" name="username" id="username" autocomplete="username" value="">
            </p>

            <p class="form-row baketivity-time-invite__actions">
                <input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="b60b431e5b"><input type="hidden" name="_wp_http_referer" value="/my-account/">
                <button type="submit" class="baketivity-time-invite__submit button-hovered btn-spinner" name="send" id="js-login" value="send" disabled=""><?php _e('Send', 'baketivity'); ?></button>
            </p>
            <div class="baketivity-time-invite__response" id="js-register-messageForm"></div>
        </form>
    </div>

    <?php get_template_part('template_parts/modules/module', 'banner-login'); ?>

</main>

<?php get_footer(); ?>