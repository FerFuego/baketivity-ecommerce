<style scoped>
.duff-bg-behavior-hero {
    background-image: url(<?php echo get_sub_field('background')['url'];
    ?>);
}

@media (max-width: 768px) {
    .duff-bg-behavior-hero {
        background-image: url(<?php echo get_sub_field('background_module')['url'];
        ?>);
    }
}
</style>
<div class="hero-duff duff-bg-behavior-hero">
    <div class="hero-duff__container-fluid">
        <div class="hero-duff__container">
            <div class="hero-duff__left">
                <div class="hero-duff__content">
                    <img class="hero-duff__logo" src="<?php echo get_sub_field('logo')['url']; ?>" alt="logo">
                    <h1 class="hero-duff__title">
                        <div><?php echo get_sub_field('title'); ?></div>
                    </h1>
                    <p class="hero-duff__subtitle"><?php echo get_sub_field('copy'); ?></p>
                    <a class="hero-duff__button" href="<?php echo get_sub_field('cta')['url']; ?>" id="duff-products"
                        target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                </div>
            </div>
            <div class="hero-duff__right">
            </div>
        </div>
    </div>
</div>