<style scoped>
.bake-talent-behavior {
    background-image: url(<?php echo get_sub_field('bg_desktop'); ?>); 
}
@media (max-width: 768px) {
    .bake-talent-behavior {   
        background-image: url(<?php echo get_sub_field('bg_mobile'); ?>);
    }
}
</style>
<section class="bake-talent-hero bake-talent-behavior">
    <div class="bake-talent-hero__container container">
        <div class="bake-talent-hero__header">
            <h1 class="bake-talent-hero__header-title"><?php echo get_sub_field('title'); ?></h1>
            <p class="bake-talent-hero__header-copy"><?php echo get_sub_field('subtitle'); ?></p>
            <a href="<?php echo get_sub_field('cta')['url']; ?>" class="bake-talent-hero__header-cta button button--primary"><?php echo get_sub_field('cta')['title']; ?></a>
        </div>
    </div>
</section>