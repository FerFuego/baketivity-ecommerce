<?php if (get_sub_field('banner_promo')) : ?>
    <style scoped>
        @media (min-width: 560px) {
            .hero-shop-banner-behavior {
                <?php if (get_sub_field('background_color')) : ?>
                    background: linear-gradient(to bottom, <?php echo get_sub_field('color_1'); ?>, <?php echo get_sub_field('color_2'); ?>);
                <?php else : ?>
                    background: <?php echo get_sub_field('color_fijo'); ?>;
                <?php endif; ?>
            }
        }
        @media (max-width: 560px) {
            .hero-shop-banner-behavior {
                background-image: url(<?php echo get_sub_field('background_mobile'); ?>);
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        }
    </style>
    <div class="hero-shop-banner hero-shop-banner-behavior" data-category="<?php echo get_sub_field('shop_category')->slug; ?>" style="<?php echo (in_array('deal-of-the-month', explode(',', sanitize_text_field($_GET['cat'])))) ? 'display:block;':''; ?>">
        <img class="hero-shop-banner__img" src="<?php echo get_sub_field('background_desktop'); ?>" alt="banner promo">
    </div>
<?php endif; ?>

<div class="hero-shop" id="js-hero-shop" style="background-color: <?php echo get_sub_field('bg_color'); ?>;<?php echo (in_array('deal-of-the-month', explode(',', sanitize_text_field($_GET['cat'])))) ? 'display:none;':''; ?>" data-category="<?php echo get_sub_field('shop_category')->slug; ?>">
    <div class="hero-shop__container" style="background-image: url(<?php echo get_sub_field('bg_image'); ?>);">
        <div class="hero-shop__content">
            <h3 class="hero-shop__title-1"><?php echo get_sub_field('title_1'); ?></h3>
            <h1 class="hero-shop__title-2"><?php echo get_sub_field('title_2'); ?></h1>
            <p class="hero-shop__copy"><?php echo get_sub_field('copy'); ?></p>
        </div>
    </div>
</div>