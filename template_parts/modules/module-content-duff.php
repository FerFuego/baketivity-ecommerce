<style scoped>
.duff-bg-behavior {
    background-image: url(<?php echo get_sub_field('image')['url'];
    ?>);
}

@media (max-width: 992px) {
    .duff-bg-behavior {
        background-image: url(<?php echo get_sub_field('image_mobile')['url'];
        ?>);
    }
}
</style>
<div class="content-duff">
    <div class="content-duff__container">
        <div class="content-duff__header">
            <h2 class="content-duff__title title_desktop">
                <?php echo get_sub_field('title_1'); ?>
            </h2>
            <h2 class="content-duff__title title_mobile">
                <?php echo get_sub_field('title_1_mobile'); ?>
            </h2>
            <h2 class="content-duff__title-2">
                <?php echo get_sub_field('title_2'); ?>
            </h2>
            <p class="content-duff__content"> <?php echo get_sub_field('content'); ?></p>
        </div>
        <div class="content-duff__image duff-bg-behavior"></div>
    </div>
</div>