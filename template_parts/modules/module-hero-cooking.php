<style scoped>
.cooking-bg-behavior {
    background-image: url(<?php echo get_sub_field('background')['url']; ?>); 
}
@media (max-width: 768px) {
    .cooking-bg-behavior {   
        background-image: url(<?php echo get_sub_field('background_mobile')['url']; ?>);
    }
}
</style>
<div class="hero-cooking cooking-bg-behavior">
    <div class="hero-cooking__container-fluid">
        <div class="hero-cooking__container">
            <div class="hero-cooking__left">
                <div class="hero-cooking__content">
                    <img class="hero-cooking__logo" src="<?php echo get_sub_field('logo')['url']; ?>" alt="logo">
                    <h1 class="hero-cooking__title"><?php echo get_sub_field('title'); ?></h1>
                    <p class="hero-cooking__subtitle"><?php echo get_sub_field('copy'); ?></p>
                    <?php if (get_sub_field('cta')): ?>
                        <a class="hero-cooking__button" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="hero-cooking__right">
            </div>
        </div>
    </div>
</div>