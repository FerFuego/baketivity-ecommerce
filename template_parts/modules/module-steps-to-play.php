<div class="steps-to-play">
    <div class="steps-to-play__container">
        <div class="steps-to-play__header">
            <h2 class="steps-to-play__title"><?php echo get_sub_field('title'); ?></h2>
            <h4 class="steps-to-play__subtitle"><?php echo get_sub_field('subtitle'); ?></h4>
        </div>
        <div class="steps-to-play__body" id="js-steps-to-play">
            <?php if (have_rows('home_steps')) : ?>
                <?php while (have_rows('home_steps')) : the_row(); ?>
                    <div class="steps-to-play__item">
                        <div class="steps-to-play__number" style="background-color: <?php echo get_sub_field('color'); ?>"><?php echo get_row_index(); ?></div>
                        <div>
                            <h4 class="steps-to-play__item-title" id="slick-slide-control5<?php echo (get_row_index() - 1); ?>" style="background-image: url(<?php echo get_sub_field('home_steps_image'); ?>);"><?php echo get_sub_field('home_steps_title'); ?></h4>
                            <p class="steps-to-play__item-description"><?php echo get_sub_field('home_steps_text'); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>