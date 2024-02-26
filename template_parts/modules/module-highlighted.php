<div class="highlighted">
    <div class="highlighted__container" id="js-highlighted">
        <?php if (have_rows('items')) : ?>
            <?php while (have_rows('items')) : the_row(); ?>
                <div class="highlighted__step">
                    <?php $image_id = get_sub_field('icon')['id'] ?>
                    <img class="highlighted__img" src="<?php echo wp_get_attachment_image_url($image_id, 'large'); ?>" alt="<?php echo get_sub_field('title'); ?>">
                    <h3 class="highlighted__title"><?php echo get_sub_field('title'); ?></h3>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>