<div class="have-your-cake" style="background-color: <?php echo get_sub_field('bg_color'); ?>;">
    <div class="have-your-cake__container">
        <div class="have-your-cake__left">
           <div class="have-your-cake__image-desktop">
                <img class="have-your-cake__image" src="<?php echo get_sub_field('image')['url']; ?>" alt="Have your cake image">
           </div>
        </div>
        <div class="have-your-cake__right">
            <div class="have-your-cake__icon-container">
                <img class="have-your-cake__icon" src="<?php echo get_sub_field('image_icon')['url']; ?>" alt="Have your cake profile">
            </div>
            <h2 class="have-your-cake__title"><?php echo get_sub_field('title'); ?></h2>
            <div class="have-your-cake__image-mobile" style="background-image: url(<?php echo get_sub_field('image')['url']; ?>);"></div>
            <div class="have-your-cake__content"><?php echo get_sub_field('content'); ?></div>
        </div>
    </div>
</div>