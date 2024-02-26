<div class="bake-a-talent-form">
    <div class="bake-a-talent-form__container">
        <div class="bake-a-talent-form__body">
            <?php if ( get_sub_field('gform_id') ) : ?>
                <?php echo do_shortcode('[gravityform id="' . get_sub_field('gform_id') . '" title="false" description="false" ajax="true"]'); ?>
            <?php endif; ?>
        </div>
    </div>
</div>