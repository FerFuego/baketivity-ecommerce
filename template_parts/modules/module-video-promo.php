<?php if (is_product()) : ?>
</div>
<?php endif; ?>


<div class="video-promo" style="background-color: <?php echo get_sub_field('bg-color'); ?>">
    <div class="video-promo__header">
        <h2 class="video-promo__title"><?php echo get_sub_field('title'); ?></h2>
    </div>
    <div class="video-promo__container">
        <div class="video-promo__content-text">
            <div class="video-promo__items">
                <?php if ( have_rows('items')) : ?>
                    <?php while ( have_rows('items')) : the_row(); ?>
                        <div class="video-promo__item">
                            <div class="video-promo__item-icon">
                                <img src="<?php echo get_sub_field('icon'); ?>" alt="icon">
                            </div>
                            <div class="video-promo__item-text"><?php echo get_sub_field('text'); ?></div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="video-promo__content-video">
            <div class="video-promo__video">
                <?php videoSupport([
                    'field' => 'video_url',
                    'button_content' => '<svg xmlns="http://www.w3.org/2000/svg" width="118.369" height="75.225" viewBox="0 0 118.369 75.225"><rect width="118.369" height="75.225" rx="15" transform="translate(0 0)" fill="#e52441"/><path d="M23.231,0,46.463,39.825H0Z" transform="translate(82.969 14.381) rotate(90)" fill="#fff"/></svg>',
                    'placeholder_url' => get_sub_field('video_image_placeholder')['url'],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<?php if (is_product()) : ?>
<div class="product type-product product_cat-shop-baking-kits">
<?php endif; ?>