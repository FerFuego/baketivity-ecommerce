<section class="hero-about-us">

    <!-- Background Img (Desktop) -->
    <?php $bgImgDesktop = get_sub_field('hero-about-us__background-image-desktop'); ?>
    <?php if ($bgImgDesktop) : ?>
        <?php echo wp_get_attachment_image( $bgImgDesktop, 'full', false, [ 'loading' => 'false', 'class' => 'hero-about-us__bg-img hero-about-us__bg-img--desktop'] ); ?>
    <?php endif ?>
    <!-- Background Img (Mobile) -->
    <?php $bgImgMobile = get_sub_field('hero-about-us__background-image-mobile'); ?>
    <?php if ($bgImgMobile) : ?>
        <?php echo wp_get_attachment_image( $bgImgMobile, 'full', false, [ 'loading' => 'false', 'class' => 'hero-about-us__bg-img hero-about-us__bg-img--mobile'] ); ?>
    <?php endif ?>

    <!-- Container -->
    <div class="hero-about-us__container">
        <div class="hero-about-us__subcontainer">
            <!-- Title -->
            <?php if(get_sub_field('hero-about-us__title')): ?>
                <h1 class="hero-about-us__title"><?php echo esc_html(get_sub_field('hero-about-us__title')); ?></h1>
            <?php endif; ?>
            <!-- Copy -->
            <?php if(get_sub_field('hero-about-us__copy')): ?>
                <p class="hero-about-us__copy"><?php echo esc_html(get_sub_field('hero-about-us__copy')); ?></p>
            <?php endif; ?>
            <!-- CTA -->
            <?php $cta = get_sub_field('hero-about-us__cta'); ?>
            <?php if ($cta) : ?>
                <a href='<?php echo $cta['url']; ?>' target='<?php echo $cta['target']; ?>' class="hero-about-us__cta"><?php echo $cta['title']; ?></a>
            <?php endif; ?>
        </div>
    </div>

</section>