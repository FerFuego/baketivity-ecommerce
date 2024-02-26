<div class="cooking-reinventing">
    <div class="cooking-reinventing__container">
        <div class="cooking-reinventing__left">
            <?php $image_id = get_sub_field('image')['id']; ?>
            <img  class="cooking-reinventing__img" src="<?php echo wp_get_attachment_image_url( $image_id, 'large' ); ?>" alt="cooking kit - set chef">
        </div>
        <div class="cooking-reinventing__right">
            <h2 class="cooking-reinventing__title"><?php echo get_sub_field('title'); ?></h2>
            <h4 class="cooking-reinventing__subtitle"><?php echo get_sub_field('subtitle'); ?></h4>
            <div class="cooking-reinventing__copy"><?php echo get_sub_field('Text'); ?></div>
        </div>
    </div>
</div>