<style scoped>
.hero-baketivity-time-bg-behavior {
    background-image: url(<?php echo get_sub_field('background_desktop'); ?>); 
}
@media (max-width: 768px) {
    .hero-baketivity-time-bg-behavior {   
        background-image: url(<?php echo get_sub_field('background_mobile'); ?>);
    }
}
</style>
<div class="hero-baketivity-time hero-baketivity-time-bg-behavior">
    <div class="hero-baketivity-time__container-fluid">
        <div class="hero-baketivity-time__container">
            <div class="hero-baketivity-time__left">
                <div class="hero-baketivity-time__content">
                    <h1 class="hero-baketivity-time__title"><?php echo get_sub_field('title'); ?></h1>
                    <div class="hero-baketivity-time__subtitle"><?php echo get_sub_field('subtitle'); ?></div>
                    <?php if (get_sub_field('cta')): ?>
                        <a class="hero-baketivity-time__button button-hovered" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="hero-baketivity-time__right">
            </div>
        </div>
    </div>
</div>