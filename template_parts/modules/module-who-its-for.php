<div class="who-its-for" style="background-color: <?php echo get_sub_field('background'); ?>">
    <div class="who-its-for__container">
        <div class="who-its-for__right">
            <h2 class="who-its-for__header who-its-for__desktop"><?php echo get_sub_field('title'); ?></h2>
            <div class="who-its-for__content" id="js-who-its-for-slider">
                <?php if (have_rows('items')) : ?>
                    <?php while (have_rows('items')) : the_row(); ?>
                        <div class="who-its-for__item">
                            <div class="who-its-for__item-icon" style="background-image: url('<?php echo get_sub_field('icon')['url']; ?>');"></div>
                            <div class="who-its-for__item-content">
                                <h4 class="who-its-for__item-title"><?php echo get_sub_field('title'); ?></h4>
                                <p class="who-its-for__item-copy"><?php echo get_sub_field('copy'); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="who-its-for__left">
            <h2 class="who-its-for__header who-its-for__mobile"><?php echo get_sub_field('title'); ?></h2>
            <?php $image_id = get_sub_field('image')['id']; ?>
            <img class="who-its-for__photo" src="<?php echo wp_get_attachment_image_url( $image_id, 'large' ); ?>" alt="photo 3 persons">
        </div>
        <div class="who-its-for__right who-its-for__mobile">
            <h2 class="who-its-for__header"><?php echo get_sub_field('title'); ?></h2>
            <img class="who-its-for__photo--mobile" src="<?php echo get_sub_field('image_mobile')['url']; ?>" alt="photo family">
        </div>
    </div>
</div>