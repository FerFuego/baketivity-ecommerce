</div>
<!-- Close product content -->

<!-- Full width module -->
<div class="video-promo" style="background-color: <?php the_field('bg-color', 'option'); ?>">
    <div class="video-promo__header">
        <h2 class="video-promo__title"><?php the_field('title', 'option'); ?></h2>
    </div>
    <div class="video-promo__container">
        <div class="video-promo__content-text">
            <div class="video-promo__items">
                <?php if ( have_rows('steps','option')) : ?>
                    <?php while ( have_rows('steps','option')) : the_row(); ?>
                        <div class="video-promo__item">
                            <div class="video-promo__item-icon">
                                <img src="<?php echo get_sub_field('icon')['sizes']['medium']; ?>" alt="icon">
                            </div>
                            <div class="video-promo__item-text"><?php the_sub_field('text'); ?></div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="video-promo__content-video">
            <div class="video-promo__video">
                <?php videoSupport([
                    'video_url' => get_field('video_url', 'option'),
                    'button_content' => '<svg xmlns="http://www.w3.org/2000/svg" width="118.369" height="75.225" viewBox="0 0 118.369 75.225"><rect width="118.369" height="75.225" rx="15" transform="translate(0 0)" fill="#e52441"/><path d="M23.231,0,46.463,39.825H0Z" transform="translate(82.969 14.381) rotate(90)" fill="#fff"/></svg>',
                    'placeholder_url' => get_field('video_image_placeholder','option')['url'],
                ]); ?>
            </div>
        </div>
    </div>
</div>
<!-- Close full width module -->

<!-- Open product content -->
<div class="product type-product product_cat-shop-baking-kits">