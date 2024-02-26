<div class="soft-reviews">
    <div class="soft-reviews__container">
        <div class="soft-reviews__left">
            <div class="soft-reviews__score">
                <div class="soft-reviews__score-value"><?= get_sub_field('score'); ?></div>
                <div class="soft-reviews__score-stars">
                    <div class="soft-reviews__score-stars-container">
                        <img src="<?= get_stylesheet_directory_uri() . '/images/cooking-kits/stars-rating.webp'; ?>" alt="stars rating">
                    </div>
                    <div class="soft-reviews__score-total"><?= get_sub_field('total_reviews'); ?></div>
                </div>
            </div>
            <div class="soft-reviews__title"><?= get_sub_field('title'); ?></div>
            <div class="soft-reviews__arrows">
                <div class="soft-reviews__thumbs soft-reviews__arrow-left"></div>
                <div class="soft-reviews__thumbs soft-reviews__arrow-right"></div>
            </div>
        </div>
        <div class="soft-reviews__right">
            <div class="soft-reviews__items" id="js-soft-reviews">
                <?php if (have_rows('reviews')) : ?>
                    <?php while (have_rows('reviews')) : the_row(); ?>
                        <div class="soft-reviews__item">
                            <div class="soft-reviews__item-title"><?= get_sub_field('name'); ?></div>
                            <img class="soft-reviews__item-stars" src="<?= get_stylesheet_directory_uri() . '/images/cooking-kits/stars.webp'; ?>" alt="stars-testimonials">
                            <div class="soft-reviews__item-text"><?= get_sub_field('review'); ?></div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>