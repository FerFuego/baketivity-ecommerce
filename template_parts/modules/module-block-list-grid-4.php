<div class="block-list-grid-4">
    <div class="block-list-grid-4__container">
        <?php if (have_rows('items')) : ?>
            <?php while (have_rows('items')) : the_row(); ?>
            <div class="block-list-grid-4__item">
                <div class="block-list-grid-4__block" style="background-image: url(<?php echo get_sub_field('image'); ?>);"></div>
                <?php if (get_sub_field('link')) : ?>
                    <a class="block-list-grid-4__link button-hovered" href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>"><?php echo get_sub_field('link')['title']; ?></a>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>