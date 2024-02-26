<style scoped>
.cake-bg-behavior {
    background-image: url(<?php echo get_sub_field('background')['url']; ?>); 
}
@media (max-width: 768px) {
    .cake-bg-behavior {   
        background-image: url(<?php echo get_sub_field('background_module')['url']; ?>);
    }
}
</style>
<div class="hero-cake-it cake-bg-behavior">
    <div class="hero-cake-it__container-fluid">
        <div class="hero-cake-it__container">
            <div class="hero-cake-it__left">
                <div class="hero-cake-it__content">
                    <img class="hero-cake-it__logo" src="<?php echo get_sub_field('logo')['url']; ?>" alt="logo">
                    <h1 class="hero-cake-it__title"><?php echo get_sub_field('title'); ?></h1>
                    <p class="hero-cake-it__subtitle"><?php echo get_sub_field('copy'); ?></p>
                    <a class="hero-cake-it__button" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                </div>
            </div>
            <div class="hero-cake-it__right">
            </div>
        </div>
    </div>
</div>