<style scoped>
.sign-up-baketivity-time__behavior {
    background-image: url(<?php echo get_sub_field('background_desktop')['url']; ?>); 
}
@media (max-width: 768px) {
    .sign-up-baketivity-time__behavior {   
        background-image: url(<?php echo get_sub_field('background_mobile')['url']; ?>);
    }
}
</style>
<div class="sign-up-baketivity-time sign-up-baketivity-time__behavior" style="background-color: <?php echo get_sub_field('background_color'); ?>">
    <div class="sign-up-baketivity-time__container">
        <div class="sign-up-baketivity-time__content">
            <h2 class="sign-up-baketivity-time__title"><?php echo get_sub_field('title'); ?></h2>
            <?php if (get_sub_field('cta')) : ?>
                <a class="sign-up-baketivity-time__cta button-hovered" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>