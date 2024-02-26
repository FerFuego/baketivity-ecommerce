<?php 
    $heading    = get_sub_field('heading');
    $image      = get_sub_field('featured_image');
    $cta        = get_sub_field('cta');
?>
<section class="module module-inclusions" style="background-image: url('<?= $image['url'] ?>')">
    <div class="wrapper">
        <h2 class="module--title"><?= $heading ?></h2>

        <?php if( have_rows('inclusion') ): ?>
            <div class="inclusions">
                <div class="inclusion inclusion--left">
                    <?php $a = 0; ?>
                    <?php while( have_rows('inclusion') ): the_row(); ?>
                        <?php 
                            $photo = get_sub_field('photo');    
                            $title = get_sub_field('title');    
                            $desc  = get_sub_field('desc');    
                        ?>
                        <?php if( $a < 2 ): ?>
                            <div class="inclusion--item">
                                <div class="inclusion--content">
                                    <div class="inclusion--image"><img src="<?= $photo['url'] ?>" alt=""></div>
                                    <div class="inclusion--copy">
                                        <h4><?= $title ?></h4>
                                        <?= $desc ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php $a++ ?>
                    <?php endwhile; ?>
                </div>
                <div class="inclusion inclusion--right">
                    <?php $a = 0; ?>
                    <?php while( have_rows('inclusion') ): the_row(); ?>
                        <?php 
                            $photo = get_sub_field('photo');    
                            $title = get_sub_field('title');    
                            $desc  = get_sub_field('desc');    
                        ?>
                        <?php if( $a > 1 && $a < 4): ?>
                            <div class="inclusion--item">
                                <div class="inclusion--content">
                                    <div class="inclusion--image"><img src="<?= $photo['url'] ?>" alt=""></div>
                                    <div class="inclusion--copy">
                                        <h4><?= $title ?></h4>
                                        <?= $desc ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php $a++ ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif ?>

        <?php if( have_rows('extras') ): ?>
            <h3><span>More extras you'll get:</span></h3>
            <div class="extras">
                <?php while( have_rows('extras') ): the_row(); ?>
                    <?php 
                        $icon = get_sub_field('Icon');
                        $desc = get_sub_field('desc');
                    ?>
                    <div class="extras--item">
                        <div class="extras--content">
                            <div class="extras--image"><img src="<?= $icon['url'] ?>" alt=""></div>
                            <div class="extras--text">
                                <?= $desc ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            </div>
        <?php endif ?>

        <?php if( $cta ): ?>
            <a href="<?= $cta['url'] ?>" class="btn btn--primary"><?= $cta['title'] ?></a>
        <?php endif ?>
    </div>
</section>