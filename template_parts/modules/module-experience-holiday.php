<div class="experience-holiday" style="background-color: <?php echo get_sub_field('bg_color'); ?>;">
    <div class="experience-holiday__container">
        <div class="experience-holiday__header">
            <h2 class="experience-holiday__title"><?php echo get_sub_field('title'); ?></h2>
            <p class="experience-holiday__subtitle"><?php echo get_sub_field('subtitle'); ?></p>
        </div>
        <div class="experience-holiday__body" id="js-slide-holiday-experience">
            <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="experience-holiday__item" style="background-color:<?php echo get_sub_field('color'); ?>;">
                        <div class="experience-holiday__item-title"><?php echo get_sub_field('title'); ?></div>
                        <div class="experience-holiday__item-image">
                            <img src="<?php echo get_sub_field('image')['url'] ?>" alt="find-a-kit-<?php echo get_sub_field('title'); ?>">
                            <?php if (get_sub_field('extra-sign')) : ?>
                                <div class="experience-holiday__extra-sign" style="border-color: <?php echo get_sub_field('color'); ?>"><?php echo get_sub_field('extra-sign'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="experience-holiday__item-content" id="slick-slide-control1<?php echo (get_row_index() - 1); ?>">
                            <div class="experience-holiday__item-text"><?php echo get_sub_field('text'); ?></div>
                            <a class="experience-holiday__item-link" href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>"><?php echo get_sub_field('link')['title']; ?></a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>	
        </div>
    </div>
</div>