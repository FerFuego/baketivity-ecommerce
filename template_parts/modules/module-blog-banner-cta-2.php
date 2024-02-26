<style scoped>
.blog-banner-2-bg-behavior {
    background-image: url(<?php echo get_sub_field('bg_desktop'); ?>); 
}
@media (max-width: 768px) {
    .blog-banner-2-bg-behavior {   
        background-image: url(<?php echo get_sub_field('bg_mobile'); ?>);
    }
}
</style>
<div class="blog-banner-cta-2">
    <div class="blog-banner-cta-2__container blog-banner-2-bg-behavior">
        <div class="blog-banner-cta-2__left">
            <div class="blog-banner-cta-2__title"><?php echo get_sub_field('title'); ?></div>
        </div>
        <div class="blog-banner-cta-2__center">
            <div class="blog-banner-cta-2__subtitle"><?php echo get_sub_field('subtitle'); ?></div>
        </div>
        <div class="blog-banner-cta-2__right">
            <form id="kla_embed_klaviyo_emailsignup_widget--3" class="d-lg-flex align-items-center" action="//manage.kmail-lists.com/subscriptions/subscribe" method="GET" novalidate="novalidate" target="_blank" data-ajax-submit="//manage.kmail-lists.com/ajax/subscriptions/subscribe">
                <input name="g" type="hidden" value="Kirj9b" />
                <div class="klaviyo_field_group d-flex align-items-center">
                    <label style="display: none;" for="kla_email_klaviyo_emailsignup_widget--3">Email</label>
                    <input id="kla_email_klaviyo_emailsignup_widget--3" class="filson-pro-medium" name="email" type="text" placeholder="<?php echo (wp_is_mobile()) ? 'Join our Newsletter' : 'Your email'; ?>" required/>
                    <button class="klaviyo_submit_button filson-pro-medium" id="sign-up-message-button" type="submit"><?php echo get_sub_field('cta')['title']; ?></button>
                </div>
                <div class="klaviyo_messages">
                    <div class="success_message" style="display: none;"></div>
                    <div class="error_message" style="display: none;"></div>
                </div>
            </form>
        </div>
    </div>
</div>