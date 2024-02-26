<div class="experience">
    <div class="experience__container">
        <div class="experience__header">
            <h2 class="experience__title"><?php echo get_sub_field('title'); ?></h2>
            <p class="experience__subtitle"><?php echo get_sub_field('subtitle'); ?></p>
        </div>
        <div class="experience__body">
            <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="experience__item" style="background-color:<?php echo get_sub_field('color'); ?>;">
                        <div class="experience__item-title"><?php echo get_sub_field('title'); ?></div>
                        <div class="experience__item-content">
                            <div class="experience__item-text"><?php echo get_sub_field('text'); ?></div>
                            <a class="experience__item-link custom_link_<?= get_row_index(); ?>" href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>"><?php echo get_sub_field('link')['title']; ?></a>
                        </div>
                        <?php $image_id = get_sub_field('image')['id']; ?>
                        <?php $image_mobile_id = get_sub_field('image_mobile')['id']; ?>
                        <img class="experience__item-image" src="<?php echo wp_get_attachment_image_url($image_id, 'large'); ?>" alt="find-a-kit-<?php echo get_sub_field('title'); ?>">
                        <img class="experience__item-image-mobile" src="<?php echo wp_get_attachment_image_url($image_mobile_id, 'large'); ?>" alt="find-a-kit-<?php echo get_sub_field('title'); ?>">
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>