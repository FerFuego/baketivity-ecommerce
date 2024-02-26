<div class="logo-reels">
    <div class="logo-reels__container">
        <?php if ( get_sub_field('title') ) : ?>
            <h4 class="logo-reels__title"><?php echo get_sub_field('title'); ?></h4>
        <?php endif; ?>
        <?php if (have_rows('lr_items')) : ?>
            <div class="logo-reels__body" id="slider-logo-reel">
                <?php while (have_rows('lr_items')) : the_row(); ?>
                    <div class="logo-reels__item">
                        <img class="logo-reels__img" src="<?php echo get_sub_field('lr_item_image'); ?>" alt="logo-brands-<?php echo get_row_index(); ?>">
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>