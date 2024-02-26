<style scoped>
    .contact-form-behavior {
        background-image: url(<?php echo get_sub_field('image_desktop'); ?>); 
    }
    @media (max-width: 768px) {
        .contact-form-behavior {   
            background-image: url(<?php echo get_sub_field('image_mobile'); ?>);
        }
    }
</style>
<div class="contact-form" id="contact-form">
    <div class="contact-form__container">
        <div class="contact-form__left contact-form-behavior"></div>
        <div class="contact-form__right">
            <div class="contact-form__header">
                <h3 class="contact-form__title"><?php echo get_sub_field('title'); ?></h3>
                <h4 class="contact-form__copy"><?php echo get_sub_field('copy'); ?></h4>
            </div>
            <div class="contact-form__body">
                <div class="contact-form__form-title"><?php echo get_sub_field('form_title'); ?></div>
                <?php if (get_sub_field('form_id')) : ?>
                    <div class="contact-form__form"><?php echo do_shortcode('[gravityform id="'.get_sub_field('form_id').'" title="false" description="false" ajax="true"]'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>