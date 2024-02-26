<div class="birthday-kid">
    <div class="birthday-kid__header">
        <h2 class="birthday-kid__header-title"><?php _e(get_sub_field('title'), 'baketivity'); ?></h2>
    </div>
    <div class="birthday-kid__container">
        <?php if (have_rows('items')) : ?>
            <div class="birthday-kid__items">
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="birthday-kid__item">
                        <div class="birthday-kid__item-icon" style="background-image: url(<?php echo get_sub_field('image')['sizes']['thumbnail'];?>);"></div>
                        <div>
                            <?php if (get_sub_field('title')) : ?>
                                <div class="birthday-kid__item-title"><?php _e(get_sub_field('title'), 'baketivity'); ?></div>
                            <?php endif; ?>
                            <?php if (get_sub_field('text')) : ?>
                                <div class="birthday-kid__item-text"><?php _e(get_sub_field('text'), 'baketivity'); ?></div>
                            <?php endif; ?>
                            <?php if (get_sub_field('cta')) : ?>
                                <a class="birthday-kid__item-cta" href="<?php echo get_sub_field('cta')['url']?>" target="<?php echo get_sub_field('cta')['target']?>" rel="noopener noreferrer"><?php echo get_sub_field('cta')['title']?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>  
            </div>
        <?php endif; ?>
    </div>
</div>