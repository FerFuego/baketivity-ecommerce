<style scoped>
.blog-banner-bg-behavior {
    background-image: url(<?php echo get_sub_field('bg_desktop'); ?>); 
}
@media (max-width: 768px) {
    .blog-banner-bg-behavior {   
        background-image: url(<?php echo get_sub_field('bg_mobile'); ?>);
    }
}
</style>
<div class="blog-banner-cta-1">
    <div class="blog-banner-cta-1__container blog-banner-bg-behavior">
        <div class="blog-banner-cta-1__left">
            <div class="blog-banner-cta-1__title"><?php echo get_sub_field('title'); ?></div>
            <a class="blog-banner-cta-1__cta" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
        </div>
        <div class="blog-banner-cta-1__right">
            <a href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>" title="<?php echo get_sub_field('cta')['title']; ?>">
                <img class="blog-banner-cta-1__kit zoom-in-out-box" src="<?php echo get_sub_field('kit_image'); ?>" alt="kit to subscribe">
            </a>
            <a class="blog-banner-cta-1__cta--mobile" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
        </div>
    </div>
</div>