<?php 
    $heading    = get_sub_field('heading');
    $cta        = get_sub_field('cta');
    $table      = get_sub_field('table_desktop');
    $desktop      = get_sub_field('bg_desktop');
    $mobile       = get_sub_field('bg_mobile');
    $mobile_main  = get_sub_field('table_mobile_main');
?>

<section class="module module-comparison">
    <?php if( $desktop && $mobile ): ?>
        <picture>
            <source media="(max-width: 650px)" srcset="<?= $mobile['url'] ?>" />
            <source media="(min-width: 651px)" srcset="<?= $desktop['url'] ?>" />
            <img src="<?= $desktop['url'] ?>" class="bg" alt="" />
        </picture>
    <?php endif ?>

    <div class="wrapper">
        <h2 class="module--title"><?= $heading ?></h2>
        <img src="<?= $table['url'] ?>" alt="" class="desktop">

        <div class="mobile">
            <div class="mobile--main">
                <img src="<?= $mobile_main['url']?>" alt="">
            </div>
            <div class="mobile--slider">
                <div class="js-mobile-slider">
                    <?php while( have_rows('table_mobile') ): the_row(); ?>
                        <div class="js-mobile-slider__item">
                            <img src="<?= get_sub_field('image')['url'] ?>" alt="">
                        </div>
                    <?php endwhile ?>
                </div>
            </div>
        </div>

        <?php if( $cta ): ?>
            <a href="<?= $cta['url'] ?>" class="btn btn--primary"><?= $cta['title'] ?></a>
        <?php endif ?>
    </div>

    <img src="<?= get_stylesheet_directory_uri() ?>/images/choco.png" class="decor-bottom-left" alt="">
</section>