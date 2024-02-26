<div class="simple-step-by-step-giving">
    <div class="simple-step-by-step-giving__header">
        <div class="simple-step-by-step-giving__title"><?php echo get_sub_field('title'); ?></div>
        <?php if (get_sub_field('description')) : ?>
            <p class="simple-step-by-step-giving__subtitle"><?php echo get_sub_field('description'); ?></p>
        <?php endif; ?>
    </div>
    <div class="simple-step-by-step-giving__container">
        <div class="simple-step-by-step-giving__body">
            <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="simple-step-by-step-giving__item">
                        <div class="simple-step-by-step-giving__item-head">
                            <?php if (get_sub_field('icon')) : ?>
                                <img class="simple-step-by-step-giving__item-image" src="<?php echo get_sub_field('icon'); ?>" alt="steps icon <?php echo get_row_index(); ?>">
                            <?php endif; ?>
                            <div class="simple-step-by-step-giving__item-num"><?php echo get_row_index(); ?></div>
                        </div>
                        <div class="simple-step-by-step-giving__item-body">
                            <div class="simple-step-by-step-giving__item-title"><?php echo get_sub_field('title'); ?></div>
                            <div class="simple-step-by-step-giving__item-content"><?php echo get_sub_field('copy'); ?></div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <div class="simple-step-by-step-giving__footer">
            <?php echo (get_sub_field('footer_text')) ? get_sub_field('footer_text') : ''; ?>
            <?php if (get_sub_field('cta')) : ?>
                <a class="simple-step-by-step-giving__cta button-hovered" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>