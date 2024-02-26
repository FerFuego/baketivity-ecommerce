<div class="baking-tab-cta" style="background-color: <?php echo get_sub_field('color'); ?>">
    <div class="baking-tab-cta__container">
        <h3 class="baking-tab-cta__title"><?php echo get_sub_field('title'); ?></h3>
        <div class="baking-tab-cta__cta-container">
            <?php if ( get_sub_field('baking_cta')) : ?>
                <a class="baking-tab-cta__cta <?php echo (is_page_template('template_pages/baking-club-page.php')) ? 'active-baking': ''; ?>" href="<?php echo get_sub_field('baking_cta')['url']; ?>" target="<?php echo get_sub_field('baking_cta')['target']; ?>"><?php echo get_sub_field('baking_cta')['title']; ?></a>
            <?php endif; ?>
            <?php if ( get_sub_field('cooking_cta')) : ?>
                <a class="baking-tab-cta__cta <?php echo (is_page_template('template_pages/cooking-club-page.php')) ? 'active-cooking': ''; ?>" href="<?php echo get_sub_field('cooking_cta')['url']; ?>" target="<?php echo get_sub_field('cooking_cta')['target']; ?>"><?php echo get_sub_field('cooking_cta')['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>