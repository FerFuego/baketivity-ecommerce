<div class="buy-with-prime <?= $layout; ?>" style="<?= Baketivity::module_banner_prime($layout); ?>">
    <div class="buy-with-prime__container">
        <div class="buy-with-prime__content" style="background-color: <?= Baketivity::conditional_function($layout)('bg_color'); ?>;">
            <div class="buy-with-prime__logo-prime">
                <?php $prime_logo = Baketivity::conditional_function($layout)('logo'); ?>
                <?php if ($prime_logo) : ?>
                    <?php echo wp_get_attachment_image($prime_logo['id'], 'full', false, ['loading' => 'false', 'class' => 'buy-with-prime__logo', 'alt' => 'logo amazon prime']); ?>
                <?php endif ?>
            </div>
            <div class="buy-with-prime__text">
                <h2 class="buy-with-prime__title"><?= Baketivity::conditional_function($layout)('title'); ?></h2>
                <h4 class="buy-with-prime__subtitle"><?= Baketivity::conditional_function($layout)('subtitle'); ?></h4>
            </div>
            <?php if ($layout == 'shop') : ?>
                <?php if (Baketivity::conditional_function($layout)('coupon_code') !== '') : ?>
                    <input class="d-none" id="coupon_prime" value="<?= Baketivity::conditional_function($layout)('coupon_code'); ?>">
                    <button class="buy-with-prime__cta" onclick="copyToClipboard(this);">Copy code</button>
                <?php else : ?>
                    <div></div>
                <?php endif ?>
            <?php else : ?>
                <a class="buy-with-prime__cta-link" href="<?php echo esc_url(home_url('/')) . '/shop/?cat=buy-with-prime'; ?>">View Products</a>
            <?php endif ?>
        </div>
    </div>
</div>