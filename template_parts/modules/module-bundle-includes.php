<div class="bundle-includes" style="background-color: <?php echo get_sub_field('bg_color'); ?>">
    <div class="bundle-includes__container">
        <?php if (get_sub_field('title')) : ?>
            <div class="bundle-includes__header">
                <h2 class="bundle-includes__title"><?php _e(get_sub_field('title'),'baketivity'); ?></h2>
                <?php if (get_sub_field('subtitle')) : ?>
                    <p class="bundle-includes__subtitle"><?php _e(get_sub_field('subtitle'), 'baketivity'); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?> 

        <?php $text = get_sub_field('text'); ?>

        <?php if (have_rows('items')) : ?>
            <div class="bundle-includes__body">
                <div class="bundle-includes__items">
                    <div class="bundle-includes__item">
                        <div class="bundle-includes__item-text">
                            <?php _e($text, 'baketivity'); ?>
                            <img class="bundle-includes__item-underline" src="/wp-content/themes/baketivity/images/birthday/underline-green.svg" alt="underline">
                        </div>
                    </div>
                    <?php while (have_rows('items')) : the_row(); ?>
                        <div class="bundle-includes__item">
                            <div class="bundle-includes__item-icon" style="background-image: url(<?php echo get_sub_field('icon')['sizes']['medium']; ?>);"></div>
                            <div class="bundle-includes__item-content">
                                <h3 class="bundle-includes__item-title"><?php _e(get_sub_field('title'), 'baketivity'); ?></h3>
                                <?php if (get_sub_field('gift')) : ?>
                                    <div class="bundle-includes__item-gift">
                                        <img src="/wp-content/themes/baketivity/images/birthday/gift.svg" alt="gift">
                                        <span><?php _e('Included for free', 'baketivity'); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>