<div class="how-it-works">
    <div class="how-it-works__container">
        <div class="how-it-works__header">
            <h2 class="how-it-works__title"><?php echo get_sub_field('title'); ?></h2>
        </div>
        <div class="how-it-works__body" id="js-how-it-works-slider">
            <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="how-it-works__step" style="background-color: <?php echo get_sub_field('color'); ?>">
                        <div class="how-it-works__image" style="background-image: url(<?php echo get_sub_field('image')['url']; ?>);"></div>
                        <div class="how-it-works__content">
                            <span class="how-it-works__step-number"><?php echo get_row_index(); ?></span>
                            <h3 class="how-it-works__step-title"><?php echo get_sub_field('title'); ?></h3>
                            <p class="how-it-works__step-description"><?php echo get_sub_field('copy'); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>