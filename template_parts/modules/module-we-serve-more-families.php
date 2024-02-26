<div class="we-serve-more-families" style="background-color: <?php echo get_sub_field('bg_color'); ?>">
    <div class="we-serve-more-families__container">
        <div class="we-serve-more-families__left">
            <h2 class="we-serve-more-families__title"><?php echo get_sub_field('title'); ?></h2>
            <div class="we-serve-more-families__content"><?php echo get_sub_field('description'); ?></div>
            <?php if (get_sub_field('cta')) : ?>
                <a class="we-serve-more-families__button" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                <?php endif; ?>
            </div>
            <div class="we-serve-more-families__right">
            <div class="we-serve-more-families__image-mobile" style="background-image: url(<?php echo get_sub_field('image_mobile'); ?>);"></div>
            <div class="we-serve-more-families__image-desktop" style="background-image: url(<?php echo get_sub_field('image'); ?>);"></div>
        </div>
    </div>
</div>