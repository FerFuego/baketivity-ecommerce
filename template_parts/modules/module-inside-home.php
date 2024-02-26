<style scoped>
.inside-bg-behavior {
    background-image: url(<?php echo get_sub_field('background')['url']; ?>); 
}
@media (max-width: 768px) {
    .inside-bg-behavior {   
        background-image: url(<?php echo get_sub_field('background_mobile')['url']; ?>);
    }
}
</style>
<div class="inside-home">
    <div class="inside-home__container">
        <div class="inside-home__content">
            <h2 class="inside-home__title">
                <span>
                    <?php echo get_sub_field('title'); ?>
                    <?php echo (get_sub_field('logo')['url']) ? '<img src="' . get_sub_field('logo')['url'] . '" alt="' . get_sub_field('title') . '">' : ''; ?> 
                </span>
            </h2>
            <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="inside-home__item">
                        <h4 class="inside-home__item-title"><?php echo get_sub_field('title'); ?></h4>
                        <p class="inside-home__item-copy"><?php echo get_sub_field('copy'); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <div class="inside-home__photo inside-bg-behavior"></div>
    </div>
</div>