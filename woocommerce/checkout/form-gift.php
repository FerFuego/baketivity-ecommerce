<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<fieldset id="custom-form-gift-checkout">
    <input name="g" type="hidden" value="YmDKfK" />
    <label class="d-gifting" for="gifting_option">
        <input type="checkbox" name="gifting_option" id="gifting_option" class="woocommerce_subscription_gifting_checkbox" value="gift">
        <span><?php esc_html_e("This is a gift?", 'woocommerce-gifting'); ?></span>
    </label>
    <div class="wcsg_add_recipient_fields">
        <p class="form-row validate-required" id="recipient_email_field" data-priority="">
            <label for="recipient_email" class=""><?php esc_html_e("Recipient's Email Address: (optional)", 'woocommerce-gifting'); ?> <!-- <span class="optional">(optional)</span> --></label>
            <span class="woocommerce-input-wrapper">
                <input type="email" class="input-text " name="recipient_email" id="recipient_email" placeholder="" value="" autocomplete="nope">
            </span>
        </p>
        <p class="form-row validate-required" id="recipient_message_field" data-priority="">
            <label for="recipient_message" class=""><?php esc_html_e("Gift Message:", 'woocommerce-gifting'); ?> <!-- <span class="optional">(optional)</span> --></label>
            <span class="woocommerce-input-wrapper">
                <textarea name="recipient_message" class="input-text " id="recipient_message" cols="10" rows="3" autocomplete="nope"></textarea>
            </span>
        </p>
    </div>
</fieldset>