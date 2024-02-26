<style scoped>
.get-the-physical__behavior {
    background-image: url(<?php echo get_sub_field('background_desktop'); ?>); 
}
@media (max-width: 768px) {
    .get-the-physical__behavior {   
        background-image: url(<?php echo get_sub_field('background_mobile'); ?>);
    }
}
</style>
<div class="get-the-physical get-the-physical__behavior" style="background-color: <?php echo get_sub_field('background_color'); ?>">
    <div class="get-the-physical__container">
        <div class="get-the-physical__content">
            <h2 class="get-the-physical__title"><?php echo get_sub_field('title'); ?></h2>
            <p class="get-the-physical__subtitle"><?php echo get_sub_field('subtitle'); ?></p>
            <?php if (get_sub_field('cta')) : ?>
                <a class="get-the-physical__cta button-hovered" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>