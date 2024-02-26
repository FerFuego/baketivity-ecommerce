<div class="plan-for-plan" style="background-color: <?php echo get_sub_field('bg_color'); ?>">
    <div class="plan-for-plan__container">
        <div class="plan-for-plan__left">
            <h2 class="plan-for-plan__title plan-for-plan__title--mobile"><?php echo get_sub_field('title'); ?></h2>
            <div class="plan-for-plan__image" style="background-image: url(<?php echo get_sub_field('image')['url']; ?>)"></div>
            <div class="plan-for-plan__icon" style="background-image: url(<?php echo get_sub_field('icon')['url']; ?>)"></div>
        </div>
        <div class="plan-for-plan__right">
            <h2 class="plan-for-plan__title"><?php echo get_sub_field('title'); ?></h2>
            <p class="plan-for-plan__subtitle"><?php echo get_sub_field('subtitle'); ?></p>
            <div class="plan-for-plan__text"><?php echo get_sub_field('text'); ?></div>
        </div>
    </div>
</div>