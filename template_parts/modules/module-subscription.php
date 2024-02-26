<div class="m-subscription" id="subscription-module">
    <?php echo do_shortcode('[pricingtable]');  ?>
    <div class="m-subscription__shipping">
        <h3 class="m-subscription__title"><?php echo get_sub_field('title') ? get_sub_field('title') : _e('Free shipping in USA', 'baketivity'); ?></h3>
        <p class="m-subscription__copy"><?php echo get_sub_field('copy') ? get_sub_field('copy') : _e('All subscriptions renew automatically. You can cancel or pause at any time. Subscription crates will be shipped on the 10th of each month.', 'baketivity'); ?></p>
        <?php if (get_sub_field('cta')) : ?>
            <a class="m-subscription__link" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
        <?php endif; ?>
    </div>
</div>