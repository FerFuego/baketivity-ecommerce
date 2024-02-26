<div class="gifting-is-better" style="background-color: <?php echo get_sub_field('bg_color'); ?>;">
    <div class="gifting-is-better__header">
        <h2 class="gifting-is-better__header-title"><?php echo get_sub_field('title'); ?></h2>
    </div>
    <div class="gifting-is-better__container">
        <div class="gifting-is-better__left">
           <div class="gifting-is-better__image-desktop">
                <img class="gifting-is-better__image" src="<?php echo get_sub_field('image')['url']; ?>" alt="gifting image">
           </div>
        </div>
        <div class="gifting-is-better__right">
            <div class="gifting-is-better__content" id="<?php echo (get_sub_field('slider_mobile')) ? 'js-gifting-slider':''; ?>">
                <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="gifting-is-better__item">
                        <?php if (get_sub_field('item_image')) : ?>
                            <img class="gifting-is-better__item-image" src="<?php echo get_sub_field('item_image')['url']; ?>" alt="gifting icon <?php echo get_row_index(); ?>">
                        <?php endif; ?>
                        <div class="gifting-is-better__item-content"><?php echo get_sub_field('item_copy'); ?></div>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>