<style scoped>
.whatinside-bg-behavior {
    background-image: url(<?php echo get_sub_field('bg_desktop'); ?>); 
}
@media (max-width: 768px) {
    .whatinside-bg-behavior {   
        background-image: url(<?php echo get_sub_field('bg_mobile'); ?>);
    }
}
</style>
<div class="what-is-inside">
    <div class="what-is-inside__header">
        <div class="what-is-inside__content">
            <img class="what-is-inside__img-left" src="<?php echo get_sub_field('image_left'); ?>" alt="what-is-inside-1" />
            <h3 class="what-is-inside__title"><?php echo get_sub_field('title'); ?></h3>
            <img class="what-is-inside__img-right" src="<?php echo get_sub_field('image_right'); ?>" alt="what-is-inside-2" />
        </div>
    </div>
    <div class="what-is-inside__body whatinside-bg-behavior">
        <div class="what-is-inside__container">
            <div class="what-is-inside__inner"> 
                <?php if (have_rows('items')) : ?>
                    <?php while (have_rows('items')) : the_row(); ?>
                        <div class="what-is-inside__item">
                            <h5 class="what-is-inside__item-title"><?php echo get_sub_field('title'); ?></h5>
                            <p class="what-is-inside__item-copy"><?php echo get_sub_field('text'); ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if (get_sub_field('cta')) : ?>
                    <a class="what-is-inside__cta" href="<?php echo get_sub_field('cta')['url']; ?>" target="<?php echo get_sub_field('cta')['target']; ?>"><?php echo get_sub_field('cta')['title']; ?></a>
                <?php endif; ?>
            </div>   
        </div>
    </div>
</div>