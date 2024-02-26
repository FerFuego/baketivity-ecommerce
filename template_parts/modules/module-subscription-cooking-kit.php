<div class="m-subscription" id="subscription-module">
    <?php echo do_shortcode( '[pricingtable_cooking_kits]');  ?>
    <div class="m-subscription__shipping">
        <h3 class="m-subscription__title"><?php echo get_sub_field('title'); ?></h3>
        <p class="m-subscription__copy"><?php echo get_sub_field('copy'); ?></p>
        <?php if (get_sub_field('cta')) : ?>
            <a class="m-subscription__link"  href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
        <?php endif; ?>
    </div>
</div>