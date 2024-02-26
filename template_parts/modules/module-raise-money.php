<style scoped>
.raise-money-behavior {
    background-image: url(<?php echo get_sub_field('image_desktop'); ?>); 
}
@media (max-width: 768px) {
    .raise-money-behavior {   
        background-image: url(<?php echo get_sub_field('image_mobile'); ?>);
    }
}
</style>
<div class="raise-money">
    <div class="raise-money__container">
        <div class="raise-money__left">
            <div class="raise-money__img raise-money-behavior"></div>
        </div>
        <div class="raise-money__right">
            <div class="raise-money__title"><?php echo get_sub_field('title'); ?></div>
            <div class="raise-money__header"><?php echo get_sub_field('header'); ?></div>
            <div class="raise-money__list">
                <?php if (have_rows('items')) : ?>
                <?php while (have_rows('items')) : the_row(); ?>
                    <div class="raise-money__item-title"><?php echo get_sub_field('title'); ?></div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>