<div class="the-joy-of-baking">
    <div class="the-joy-of-baking__container">
        <div class="the-joy-of-baking__header">
            <h2 class="the-joy-of-baking__title"><?php echo get_sub_field('title'); ?></h2>
            <h4 class="the-joy-of-baking__subtitle"><?php echo get_sub_field('subtitle'); ?></h4>
        </div>
        <div class="the-joy-of-baking__body" id="js-the-joy-of-baking-slider">
            <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="the-joy-of-baking__item">
                        <div class="the-joy-of-baking__item-img" style="background-image: url(<?php echo get_sub_field('image')['url']; ?>);"></div>
                        <div class="the-joy-of-baking__item-content">
                            <div class="the-joy-of-baking__item-step"><?php echo get_row_index(); ?></div>
                            <h4 class="the-joy-of-baking__item-title"><?php echo get_sub_field('title'); ?></h4>
                            <p class="the-joy-of-baking__item-description"><?php echo get_sub_field('text'); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>