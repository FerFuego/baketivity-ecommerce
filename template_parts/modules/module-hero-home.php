<style scoped>
.home-bg-behavior {
    background-image: url(<?php echo get_sub_field('bg_desktop'); ?>); 
}
@media (max-width: 768px) {
    .home-bg-behavior {   
        background-image: url(<?php echo get_sub_field('bg_mobile'); ?>);
    }
}
</style>
<div class="hero-home home-bg-behavior">
    <div class="hero-home__container-fluid">
        <div class="hero-home__container">
            <div class="hero-home__left">
                <div class="hero-home__content">
                    <h1 class="hero-home__title">
                        <?php echo get_sub_field('title'); ?>
                        <?php if (get_sub_field('highlight')) : ?>
                            <span class="hero-home__highlight"><?php echo get_sub_field('highlight'); ?></span>
                        <?php endif; ?>
                    </h1>
                    <p class="hero-home__subtitle"><?php echo get_sub_field('text'); ?></p>
                    <?php if (get_sub_field('cta')) : ?>
                        <a class="hero-home__button" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="hero-home__right">
            </div>
        </div>
    </div>
</div>