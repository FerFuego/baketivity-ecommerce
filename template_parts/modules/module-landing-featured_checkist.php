<?php 
    $heading = get_sub_field('heading');
    $intro   = get_sub_field('intro');
    $cta     = get_sub_field('cta');
    $img     = get_sub_field('featured_image');

    $desktop = get_sub_field('bg_desktop');
    $mobile  = get_sub_field('bg_mobile');

?>
<section class="module module-checklist">
    <?php if( $desktop && $mobile ): ?>
        <picture>
            <source media="(max-width: 650px)" srcset="<?= $mobile['url'] ?>" />
            <source media="(min-width: 651px)" srcset="<?= $desktop['url'] ?>" />
            <img src="<?= $desktop['url'] ?>" class="bg" alt="" />
        </picture>
    <?php endif ?>

    
    <div class="wrapper">
        <img src="<?= $img['url'] ?>" alt="" class="featured-image">
        <div class="checklist">
            <div class="checklist--content">
                <h2 class="module--title"><?= $heading ?></h2>
                <?= $intro ?>

                <?php if( have_rows('checklist') ): ?>
                    <div class="checklist--list">
                        <?php while( have_rows('checklist') ): the_row(); ?>
                            <div class="checklist--item">
                                <?php 
                                    $img   = get_sub_field('image');
                                    $title = get_sub_field('title');
                                    $desc  = get_sub_field('description');
                                ?>

                                <div class="checklist--image">
                                    <img src="<?= $img['url'] ?>" alt="">
                                </div>
                                <div class="checklist--texts">
                                    <h3><?= $title ?></h3>
                                    <?= $desc ?>
                                </div>
                            </div>
                        <?php endwhile ?>
                    </div>
                <?php endif ?>

                <?php if( $cta ): ?>
                    <a href="<?= $cta['url'] ?>" class="btn btn--primary"><?= $cta['title'] ?></a>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>