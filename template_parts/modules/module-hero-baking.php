<style scoped>
.baking-bg-behavior {
    background-image: url(<?php echo get_sub_field('background'); ?>); 
}
@media (max-width: 768px) {
    .baking-bg-behavior {   
        background-image: url(<?php echo get_sub_field('background_mobile'); ?>);
    }
}
</style>
<div class="hero-baking baking-bg-behavior">
    <div class="hero-baking__container-fluid">
        <div class="hero-baking__container">
            <div class="hero-baking__left">
                <div class="hero-baking__content">
                    <div class="hero-baking__container-title">
                        <h1 class="hero-baking__title"><?php echo get_sub_field('title'); ?></h1>
                    </div>
                    <div class="hero-baking__copy"><?php echo get_sub_field('copy'); ?></div>
                    <?php if (get_sub_field('cta')): ?>
                        <a class="hero-baking__button" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="hero-baking__right">
            </div>
        </div>
    </div>
</div>