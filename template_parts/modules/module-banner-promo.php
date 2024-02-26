<style scoped>
.promo-bg-behavior {
    background-image: url(<?php echo get_sub_field('banner_image'); ?>); 
}
.promo-margin {
    margin-top: <?php echo get_sub_field('margin-top'); ?>;
    margin-bottom: <?php echo get_sub_field('margin-bottom'); ?>;
}
@media (max-width: 1024px) {
    .promo-bg-behavior {   
        background-image: url(<?php echo get_sub_field('banner_image_mobile'); ?>);
    }
    .promo-margin {
        margin-top: <?php echo get_sub_field('margin-top_mobile'); ?>;
        margin-bottom: <?php echo get_sub_field('margin-bottom_mobile'); ?>;
    }
}
</style>

<div class="banner-promo promo-margin">
    <div class="banner-promo__container">
        <div class="banner-promo__img promo-bg-behavior">
            <div class="banner-promo__content-left">
                <h2 class="banner-promo__title"><?php echo get_sub_field('title'); ?></h2>
                <p class="banner-promo__subtitle"><?php echo get_sub_field('subtitle'); ?></p>
                <span class="banner-promo__copy"><?php echo get_sub_field('copy'); ?></span>
            </div>
            <div class="banner-promo__content-right">
                <div class="banner-promo__item">
                    <p class="banner-promo__item-title">Use code:</p>
                    <p class="banner-promo__item-code"><?php echo get_sub_field('code_1'); ?></p>
                    <a class="banner-promo__item-btn" href="<?php echo get_sub_field('promo_1')['url']; ?>"><?php echo get_sub_field('promo_1')['title']; ?></a>
                </div>
                <div class="banner-promo__item">
                    <p class="banner-promo__item-title">Use code:</p>
                    <p class="banner-promo__item-code"><?php echo get_sub_field('code_2'); ?></p>
                    <a class="banner-promo__item-btn" href="<?php echo get_sub_field('promo_2')['url']; ?>"><?php echo get_sub_field('promo_2')['title']; ?></a>
                </div>
                <div class="banner-promo__item">
                    <p class="banner-promo__item-title">Use code:</p>
                    <p class="banner-promo__item-code"><?php echo get_sub_field('code_3'); ?></p>
                    <a class="banner-promo__item-btn" href="<?php echo get_sub_field('promo_3')['url']; ?>"><?php echo get_sub_field('promo_3')['title']; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>