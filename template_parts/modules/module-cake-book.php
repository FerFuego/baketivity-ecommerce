<div class="cake-book" style="background-color: <?php echo get_sub_field('bg_color'); ?>;">
    <div class="cake-book__container">
        <div class="cake-book__left">
           <div class="cake-book__image-desktop" style="background-image: url(<?php echo get_sub_field('image')['url']; ?>);"></div>
        </div>
        <div class="cake-book__right">
            <h2 class="cake-book__title"><?php echo get_sub_field('title'); ?></h2>
            <div class="cake-book__image-mobile" style="background-image: url(<?php echo get_sub_field('image')['url']; ?>);"></div>
            <div class="cake-book__content"><?php echo get_sub_field('text'); ?></div>
            <?php if (get_sub_field('button')) : ?>
                <a class="cake-book__button" href="<?php echo get_sub_field('button')['url']; ?>"><?php echo get_sub_field('button')['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>