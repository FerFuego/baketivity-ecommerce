<div class="spread-sweet-moments">
    <div class="spread-sweet-moments__container">
        <div class="spread-sweet-moments__left">
            <div class="spread-sweet-moments__image" style="background-image: url(<?php echo wp_is_mobile() ? get_sub_field('image_mobile')['url'] : get_sub_field('image_desktop')['url'];?>);"></div>
        </div>
        <div class="spread-sweet-moments__right">
            <h3 class="spread-sweet-moments__title"><?php echo get_sub_field('title'); ?></h3>
            <h5 class="spread-sweet-moments__subtitle"><?php echo get_sub_field('subtitle'); ?></h5>
            <div class="spread-sweet-moments__copy"><?php echo get_sub_field('copy'); ?></div>
        </div>
    </div>
</div>