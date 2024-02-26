<?php $button_default_value = get_field('sign_up_alert_button_text','option'); ?>

<div id="sign-up-alert-success" class="sign-up-message bg-green display-flex justify-content-center align-items-center display-none filson-pro-medium">
    <span class="sign-up-message-text">
        <?php echo get_field('sign_up_alert_success_text','option'); ?>
    </span>
    <span class="sign-up-message-close" data-create-cookie="true">
        <img src="<?php echo home_url() ?>/wp-content/themes/baketivity/images/svg/cross-close-white.svg" alt="close"/>
    </span>
</div>

<div id="sign-up-alert-error" class="sign-up-message bg-red display-flex justify-content-center align-items-center display-none filson-pro-medium">
    <span class="sign-up-message-text">
        <?php echo get_field('sign_up_alert_error_text','option'); ?>
    </span>
    <span class="sign-up-message-close" data-create-cookie="false">
        <img src="<?php echo home_url() ?>/wp-content/themes/baketivity/images/svg/cross-close-white.svg" alt="close"/>
    </span>
</div>

<div id="sign-up-message" class="sign-up-message bg-green display-flex justify-content-center align-items-center filson-pro-medium">
    <span class="sign-up-message-text"><?php echo get_field('sign_up_alert_text','option'); ?></span>
    <form id="kla_embed_klaviyo_emailsignup_widget--1" class="d-lg-flex align-items-center" action="//manage.kmail-lists.com/subscriptions/subscribe" method="GET" novalidate="novalidate" target="_blank" data-ajax-submit="//manage.kmail-lists.com/ajax/subscriptions/subscribe">
        <input name="g" type="hidden" value="Kirj9b" />
        <div class="klaviyo_field_group d-flex align-items-center">
            <label style="display: none;" for="kla_email_klaviyo_emailsignup_widget--1">Email</label>
            <input id="kla_email_klaviyo_emailsignup_widget--1" class="filson-pro-medium" name="email" type="text" placeholder="<?php echo (wp_is_mobile()) ? 'Join our Newsletter' : 'Your email'; ?>" required/>
            <button class="klaviyo_submit_button filson-pro-medium" id="sign-up-message-button" type="submit"><?php echo $button_default_value; ?></button>
        </div>
        <div class="sign-up-message-close" data-create-cookie="true">
            <img src="<?php echo home_url() ?>/wp-content/themes/baketivity/images/svg/cross-close-white.svg" alt="close"/>
        </div>
        <div class="klaviyo_messages">
            <div class="success_message" style="display: none;"></div>
            <div class="error_message" style="display: none;"></div>
        </div>
    </form>
</div>