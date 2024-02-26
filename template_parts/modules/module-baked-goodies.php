<div class="baked-goodies" style="background-color: <?php echo get_sub_field('bg_color'); ?>">
    <div class="baked-goodies__container">
        <div class="baked-goodies__title"><?php echo get_sub_field('title'); ?></div>
        <div class="baked-goodies__content">
            <?php if (have_rows('items')) : ?>
            <?php while (have_rows('items')) : the_row(); ?>
                <div class="baked-goodies__item">
                    <img class="baked-goodies__item-image" src="<?php echo get_sub_field('icon'); ?>" alt="<?php echo get_row_index(); ?>">
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>