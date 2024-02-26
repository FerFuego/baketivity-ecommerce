<style scoped>
.corporate-bg-behavior {
    background-image: url(<?php echo get_sub_field('bg-image-desktop'); ?>); 
}
@media (max-width: 768px) {
    .corporate-bg-behavior {   
        background-image: url(<?php echo get_sub_field('bg-image-mobile'); ?>);
    }
}
</style>
<div class="hero-corporate corporate-bg-behavior">
    <div class="hero-corporate__container-fluid">
        <div class="hero-corporate__container">
            <div class="hero-corporate__left">
                <div class="hero-corporate__content">
                    <?php if (get_sub_field('title')) : ?>
                        <h1 class="hero-corporate__title"><?php echo get_sub_field('title'); ?></h1>
                    <?php endif; ?>
                    <?php if (get_sub_field('copy')) : ?>
                        <p class="hero-corporate__subtitle"><?php echo get_sub_field('copy'); ?></p>
                    <?php endif; ?>
                    <?php if (get_sub_field('cta')) : ?>
                        <a class="hero-corporate__button" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="hero-corporate__right">
            </div>
        </div>
    </div>
</div>