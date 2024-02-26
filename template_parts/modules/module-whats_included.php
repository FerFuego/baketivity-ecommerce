<div class="whats-included">
    <div class="container">
        <div class="whats-included__header">
            <h2 class="whats-included__title"><?php echo get_sub_field('title') ?></h2>
            <?php if (get_sub_field('short_description')) : ?>
                <p class="whats-included__copy"><?php echo get_sub_field('short_description'); ?></p>
            <?php endif; ?>
        </div>
        <div class="whats-included__body" style="<?php echo get_sub_field('large_description') ? 'margin-bottom:46.37px;':''; ?>">
            <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="whats-included__item">
                        <img class="whats-included__item-icon" src="<?php echo get_sub_field('icon')['url']; ?>" alt="icon"/>
                        <h5 class="whats-included__item-title"><?php echo get_sub_field('title'); ?></h5>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php if (get_sub_field('large_description')) : ?>
            <div class="whats-included__footer">
                <p class="whats-included__description"><?php echo get_sub_field('large_description'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>