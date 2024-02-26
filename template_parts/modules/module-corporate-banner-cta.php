<div class="corporate-banner-cta <?php echo get_sub_field('link_2') ? 'corporate-banner-cta-2' : ''; ?>">
    <div class="corporate-banner-cta__container">
        <div class="corporate-banner-cta__content">
            <h3 class="corporate-banner-cta__title"><?php echo get_sub_field('title'); ?></h3>
            <?php if (get_sub_field('link')) : ?>
                <a class="corporate-banner-cta__button" href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>"><?php echo get_sub_field('link')['title']; ?></a>
            <?php endif; ?>
            <?php if (get_sub_field('link_2')) : ?>
                <a class="corporate-banner-cta__button-2" href="<?php echo get_sub_field('link_2')['url']; ?>" target="<?php echo get_sub_field('link_2')['target']; ?>"><?php echo get_sub_field('link_2')['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>