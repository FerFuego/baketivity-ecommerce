<div class="m-subscription m-subscription--alternative" id="anchor-subscriptions">
    <!-- Header -->
    <div class="m-subscription__header">
        <?php if(get_sub_field('header-title')): ?>
            <h2 class="m-subscription__header-title"><?php echo esc_html(get_sub_field('header-title')); ?></h2>
        <?php endif; ?>
        <?php if(get_sub_field('header-copy')): ?>
            <p class="m-subscription__header-copy"><?php echo esc_html(get_sub_field('header-copy')); ?></p>
        <?php endif; ?>
    </div>
    <!-- Pricing Table -->
    <?php echo do_shortcode( '[pricingtable]');  ?>
    <!-- Shipping -->
    <div class="m-subscription__shipping">
        <h3 class="m-subscription__title"><?php echo get_sub_field('title'); ?></h3>
        <p class="m-subscription__copy"><?php echo get_sub_field('copy'); ?></p>
        <?php if (get_sub_field('cta')) : ?>
            <a class="m-subscription__link"  href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
        <?php endif; ?>
    </div>
</div>