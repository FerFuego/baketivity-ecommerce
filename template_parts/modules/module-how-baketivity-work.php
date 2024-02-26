<div class="how-baketivity-work">
    <div class="how-baketivity-work__container" style="background-color: <?php echo get_sub_field('bg-color'); ?>">
        <div class="how-baketivity-work__header">
            <h2 class="how-baketivity-work__title"><?php echo get_sub_field('title'); ?></h2>
        </div>
        <div class="how-baketivity-work__body">
            <div class="how-baketivity-work__left">
                <?php $image_1_id = get_sub_field('image_1')['id']; ?>
                <img class="how-baketivity-work__image-1" src="<?php echo wp_get_attachment_image_url($image_1_id, 'full'); ?>" alt="<?php echo get_sub_field('image_1')['alt']; ?>">
                <?php $image_2_id = get_sub_field('image_2')['id']; ?>
                <img class="how-baketivity-work__image-2" src="<?php echo wp_get_attachment_image_url($image_2_id, 'full'); ?>" alt="<?php echo get_sub_field('image_1')['alt']; ?>">
            </div>
            <?php if (have_rows('items')) : ?>
                <div class="how-baketivity-work__right">
                    <?php while (have_rows('items')) : the_row(); ?>
                        <div class="how-baketivity-work__step">
                            <?php $image_id = get_sub_field('icon')['id']; ?>
                            <img class="how-baketivity-work__image" src="<?php echo wp_get_attachment_image_url($image_id, 'large'); ?>">
                            <div class="how-baketivity-work__content">
                                <h3 class="how-baketivity-work__step-title"><?php echo get_sub_field('title'); ?></h3>
                                <p class="how-baketivity-work__step-copy"><?php echo get_sub_field('copy'); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>