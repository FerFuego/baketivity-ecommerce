<div class="comments-starter-kit">
    <div class="comments-starter-kit__container">
        <div class="comments-starter-kit__body">
            <?php if (have_rows('comments')) : ?>
                <?php while (have_rows('comments')) : the_row(); ?>
                    <div class="comments-starter-kit__box">
                        <div class="comments-starter-kit__avatar">
                            <img class="comments-starter-kit__img" src="<?php echo get_sub_field('avatar')['url']; ?>" alt="avatar">
                            <p class="comments-starter-kit__name"><?php echo get_sub_field('name'); ?></p>
                        </div>
                        <div class="comments-starter-kit__content">
                            <div class="comments-starter-kit__rating">
                                <?php 
                                    $rating = get_sub_field('rating'); 
                                    for($i = 1; $i <= 5; $i++) :
                                        if ($rating >= $i) : ?>
                                            <img class="comments-starter-kit__star" src="<?php echo get_stylesheet_directory_uri().'/images/starter-kit/star-gold.svg'; ?>" alt="star-gold-<?php echo get_row_index(); ?>">
                                        <?php else : ?>
                                            <img class="comments-starter-kit__star" src="<?php echo get_stylesheet_directory_uri().'/images/starter-kit/star-silver.svg'; ?>" alt="star-silver-<?php echo get_row_index(); ?>">
                                        <?php endif;
                                    endfor; 
                                ?>
                            </div>
                            <div class="comments-starter-kit__comment">
                                <?php echo get_sub_field('comment'); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>