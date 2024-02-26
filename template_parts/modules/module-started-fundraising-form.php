<div class="started-fundraising-form" id="bake4good-form">
    <div class="started-fundraising-form__container">
        <div class="started-fundraising-form__header">
            <h3 class="started-fundraising-form__title"><?php echo get_sub_field('title'); ?></h3>
            <h3 class="started-fundraising-form__title-mobile"><?php echo get_sub_field('title_mobile'); ?></h3>
            <div class="started-fundraising-form__subtitle"><?php echo get_sub_field('subtitle'); ?></div>
        </div>
        <div class="started-fundraising-form__body">
            <?php if ( get_sub_field('gform_id') ) : ?>
                <?php echo do_shortcode('[gravityform id="' . get_sub_field('gform_id') . '" title="false" description="false" ajax="true"]'); ?>
            <?php endif; ?>
        </div>
    </div>
</div>