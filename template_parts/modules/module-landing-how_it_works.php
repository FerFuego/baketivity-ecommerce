<?php 
    $heading    = get_sub_field('heading');
    $intro      = get_sub_field('intro');
    $cta        = get_sub_field('cta');

    $desktop = get_sub_field('bg_desktop');
    $mobile  = get_sub_field('bg_mobile');
?>

<section class="module module-how-it-works">
    <?php if( $desktop && $mobile ): ?>
        <picture>
            <source media="(max-width: 650px)" srcset="<?= $mobile['url'] ?>" />
            <source media="(min-width: 651px)" srcset="<?= $desktop['url'] ?>" />
            <img src="<?= $desktop['url'] ?>" class="bg" alt="" />
        </picture>
    <?php endif ?>
    <div class="wrapper">
        <h2 class="module--title"><?= $heading ?></h2>
        <?= $intro ?>

        <?php if( have_rows('steps') ): ?>
            <div class="steps">
            <?php $i = 1; ?>
            <?php while( have_rows('steps') ): the_row(); ?>
                <?php
                    $img   = get_sub_field('photo');
                    $title = get_sub_field('title');
                    $desc  = get_sub_field('desc');
                ?>
                <div class="steps--item">
                    <div class="steps--thumb">
                        <img src="<?= $img['url'] ?>" alt="">
                        <span><?= $i ?></span>
                    </div>
                    <div class="steps--text">
                        <h3><?= $title ?></h3>
                        <?= $desc ?>
                    </div>
                </div>
            <?php $i++ ?>
            <?php endwhile ?>
            </div>
        <?php endif ?>

        <?php if( $cta ): ?>
            <a href="<?= $cta['url'] ?>" class="btn btn--primary"><?= $cta['title'] ?></a>
        <?php endif ?>
    </div>
</section>