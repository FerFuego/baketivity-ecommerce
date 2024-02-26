<div class="whats-the-occasion">

    <div class="whats-the-occasion__container">

        <div class="whats-the-occasion__header">
            <h3 class="whats-the-occasion__title filson-pro-black"><?php echo get_sub_field('title'); ?></h3>
            <p class="whats-the-occasion__subtitle filson-pro-medium"><?php echo get_sub_field('copy'); ?></p>
        </div>

        <div class="whats-the-occasion__occasions">

            <?php if( have_rows('occasions') ): ?>
                <?php while( have_rows('occasions') ): the_row(); 
                    $image = get_sub_field('icon');
                ?>
                    <div class="cat-item" style="background-color: <?= the_sub_field('background_color') ?> ">

                        <div class="cat-item-icon">
                            <img src="<?php echo $image['url']; ?>" alt="">
                        </div>
                        <h3 class="cat-item-title filson-pro-bold">
                            <?php the_sub_field('title'); ?>
                        </h3>

                    </div>
                <?php endwhile; ?>
            <?php endif; ?>                

        </div>

    </div>

</div>




