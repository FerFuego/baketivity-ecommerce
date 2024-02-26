<div class="how-to-cash-it" id="how-to-cash-it">
    <div class="how-to-cash-it__container">
        <div class="how-to-cash-it__header">
            <h2 class="how-to-cash-it__title"><?php echo get_sub_field('title'); ?></h2>
            <h4 class="how-to-cash-it__subtitle"><?php echo get_sub_field('subtitle'); ?></h4>
            <p class="how-to-cash-it__paragraph"><?php echo get_sub_field('intro'); ?></p>
            <?php $instagram_url = get_sub_field('instagram_url'); ?>
        </div>
        <div class="how-to-cash-it__body">
            <div class="how-to-cash-it__content" id="js-how-to-cash-it-slider">
            <?php if (have_rows('steps')) : ?>
                <?php while (have_rows('steps')) : the_row(); ?>
                    <a class="how-to-cash-it__item" href="<?php echo $instagram_url; ?>" target="_blank" title="Go to Instgram">
                        <div class="how-to-cash-it__item-icon">
                            <img src="<?php echo get_sub_field('image')['url']; ?>" alt="how-to-cash-it-<?php echo get_row_index(); ?>">
                        </div>
                        <div class="how-to-cash-it__item-text">
                            <span class="how-to-cash-it__item-num"><?php echo get_row_index(); ?></span>
                            <h3 class="how-to-cash-it__item-title"><?php echo get_sub_field('title_step'); ?></h3>
                            <?php if (get_sub_field('text')) : ?>
                                <p class="how-to-cash-it__item-paragraph"><?php echo get_sub_field('text'); ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
        <div class="how-to-cash-it__footer">
            <p class="how-to-cash-it__footer-text-1"><?php echo get_sub_field('copy'); ?></a>
            <div class="how-to-cash-it__footer-text-2">
                <?php echo get_sub_field('copy2'); ?>
                <?php if (get_sub_field('copy3')) : ?>
                    <a class="how-to-cash-it__footer-text-3" href="#popup1">Official Rules</a>
                <?php endif; ?>
            </div>            
        </div>
    </div>
    <!-- Popup -->
    <?php if (get_sub_field('copy3')) : ?>
        <div id="popup1" class="how-to-cash-it__overlay">
            <div class="how-to-cash-it__popup">
                <a class="how-to-cash-it__close" href="#how-to-cash-it">&times;</a>
                <div class="how-to-cash-it__content-pop">
                    <?php echo get_sub_field('copy3'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>