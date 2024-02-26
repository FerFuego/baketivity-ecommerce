<?php $device = (wp_is_mobile()) ? 'mobile' : 'desktop'; ?>

<style scoped>
    .banner-image {
        margin-top: <?php echo $device == 'mobile' ? get_sub_field('margin-top_mobile') : get_sub_field('margin-top'); ?>;
        margin-bottom: <?php echo $device == 'mobile' ? get_sub_field('margin-bottom_mobile') : get_sub_field('margin-bottom'); ?>;
    }
</style>

<?php $cta = ($device == 'mobile') ? get_sub_field('banner_cta_mobile') : get_sub_field('banner_cta'); ?>

<div class="banner-image">
    <div class="banner-image__container">
        <?php if ($cta) : ?>
            <a href="<?php echo $cta; ?>">
        <?php endif; ?>
        
        <img class="banner-image__img" src="<?php echo $device == 'mobile' ? get_sub_field('banner_image_mobile') : get_sub_field('banner_image'); ?>" alt="banner image">

        <?php if ($cta) : ?>
            </a>
        <?php endif; ?>
    </div>
</div>