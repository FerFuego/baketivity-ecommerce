<div class="proud-partners">
    <div class="proud-partners__container">
        <div class="proud-partners__header">
            <div class="proud-partners__title"><?php echo get_sub_field('title'); ?></div>
            <div class="proud-partners__subtitle"><?php echo get_sub_field('subtitle'); ?></div>
        </div>
        <div class="proud-partners__body" id="js-proud-partners">
            <?php if (have_rows('items')) : ?>
            <?php while (have_rows('items')) : the_row(); ?>
                <div class="proud-partners__item">
                    <div class="proud-partners__item-container-icon">
                        <img class="proud-partners__item-icon" src="<?php echo get_sub_field('icon'); ?>" alt="steps icon <?php echo get_row_index(); ?>">
                    </div>
                    <div class="proud-partners__item-copy"><?php echo get_sub_field('copy'); ?></div>
                    <div class="proud-partners__item-cta"><?php echo (get_sub_field('cta')) ? get_sub_field('cta')['title'] : ''?></div>
                    <!-- <a class="proud-partners__item-cta" href="<?php //echo get_sub_field('cta')['url']; ?>" target="<?php //echo get_sub_field('cta')['target']; ?>"><?php //echo get_sub_field('cta')['title']; ?></a> -->
                    <div class="proud-partners__item-footer"><?php echo get_sub_field('footer'); ?></div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>