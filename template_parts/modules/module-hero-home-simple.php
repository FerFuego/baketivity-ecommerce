<?php $backgroundImage = get_sub_field('bg_desktop'); ?>
<?php $backgroundImageMobile = get_sub_field('bg_mobile'); ?>
<?php $link = get_sub_field('link'); ?>

<div class="hero-home-simple">
    <!-- Image -->
    <div class="hero-home-simple__container-fluid">
        <?php if ($backgroundImage) : ?>
            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="hero-home-simple__bg-desktop">
                <?php echo wp_get_attachment_image($backgroundImage['id'], 'full', false, ['loading' => 'lazyload', 'class' => 'hero__background-image display_desktop']); ?>
            </a>

            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="hero-home-simple__bg-desktop">
                <?php echo wp_get_attachment_image($backgroundImageMobile['id'], 'full', false, ['loading' => 'lazyload', 'class' => 'hero__background-image display_mobile']); ?>
            </a>
        <?php endif ?>
    </div>
</div>