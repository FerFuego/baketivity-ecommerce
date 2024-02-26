<style scoped>
.hero-bake4good-bg-behavior {
    background-image: url(<?php echo get_sub_field('background_desktop'); ?>); 
}
@media (max-width: 768px) {
    .hero-bake4good-bg-behavior {   
        background-image: url(<?php echo get_sub_field('background_mobile'); ?>);
    }
}
</style>
<div class="hero-bake4good hero-bake4good-bg-behavior">
    <div class="hero-bake4good__container-fluid">
        <div class="hero-bake4good__container">
            <div class="hero-bake4good__left">
                <div class="hero-bake4good__content">
                    <div class="hero-bake4good__container-logos">
                        <?php if (get_sub_field('logo_1')) : ?>
                            <img class="hero-bake4good__logo-1" src="<?php echo get_sub_field('logo_1'); ?>" alt="Logo Bake4Good">
                        <?php endif; ?>
                        <?php if (get_sub_field('logo_2')) : ?>
                            <img class="hero-bake4good__logo-2" src="<?php echo get_sub_field('logo_2'); ?>" alt="Logo Baketivity">
                        <?php endif; ?>
                    </div>
                    <div class="hero-bake4good__container-title">
                        <h1 class="hero-bake4good__title"><?php echo get_sub_field('title'); ?></h1>
                    </div>
                    <div class="hero-bake4good__subtitle"><?php echo get_sub_field('subtitle'); ?></div>
                    <?php if (get_sub_field('cta')): ?>
                        <a class="hero-bake4good__button" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="hero-bake4good__right">
            </div>
        </div>
    </div>
</div>