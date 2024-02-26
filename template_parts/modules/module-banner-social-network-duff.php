<div class="banner-social-network-duff">
    <div class="banner-social-network-duff__container">
        <div class="banner-social-network-duff__icons-container">
            <?php if (get_sub_field('social_icons')): ?>
            <?php while (the_repeater_field('social_icons')): ?>
                <a href="<?php the_sub_field('link');?>" target="_blank" class="banner-social-network-duff__icon">
                    <img src="<?php the_sub_field('icon');?>" />
                </a>
            <?php endwhile;?>
            <?php endif;?>
        </div>
        <div class="banner-social-network-duff__content">
            <div class="banner-social-network-duff__col-title">
                <h3 class="banner-social-network-duff__title">
                    <?php echo get_sub_field('title'); ?>
                </h3>
                <img class="banner-social-network-duff__logo" src="<?php echo get_sub_field('logo')['url']; ?>" alt="duff_1">
            </div>
            <div class="banner-social-network-duff__text"><?php echo get_sub_field('text'); ?></div>
        </div>
    </div>
</div>