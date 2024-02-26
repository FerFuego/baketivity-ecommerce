<div class="best-sellers">
    <div class="best-sellers__container">
        <h3 class="best-sellers__title"><?php echo get_sub_field('title'); ?></h3>
        <div class="best-sellers__items" id="js-best-sellers">
            <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="best-sellers__item" style="background-color: <?php echo get_sub_field('color'); ?>">
                        <img class="best-sellers__item-image" src="<?php echo get_sub_field('image'); ?>" alt="<?php echo get_sub_field('title'); ?>">
                        <div class="best-sellers__item-title"><?php echo get_sub_field('title'); ?></div>
                        <div class="best-sellers__item-price"><?php echo get_sub_field('price'); ?></div>
                        <div class="best-sellers__item-copy"><?php echo get_sub_field('copy'); ?></div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>