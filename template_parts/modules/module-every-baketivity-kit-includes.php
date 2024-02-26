<div class="every-baketivity-kit-includes">
    <div class="every-baketivity-kit-includes__container">
        <h3 class="every-baketivity-kit-includes__title"><?php echo get_sub_field('title'); ?></h3>
        <div class="every-baketivity-kit-includes__content">
            <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="every-baketivity-kit-includes__item">
                        <img class="every-baketivity-kit-includes__item-icon" src="<?php echo get_sub_field('icon') ?>" alt="find-a-kit-<?php echo get_sub_field('icon'); ?>">
                        <div class="every-baketivity-kit-includes__item-title"><?php echo get_sub_field('title'); ?></div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>	
        </div>
    </div>
</div>