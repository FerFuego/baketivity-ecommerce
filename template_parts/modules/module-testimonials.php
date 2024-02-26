<div class="testimonials test-wrapper" style="background-color:<?php echo get_sub_field('t_background_color'); ?>; background-image:url(<?php echo get_sub_field('t_background_image'); ?>);">
    <div class="testimonials__container">
        <?php if (get_sub_field('title')) : ?>
            <div class="testimonials__title"><?php echo get_sub_field('title'); ?></div>
        <?php endif; ?>
        <?php $stars = get_sub_field('t_stars'); ?>
        <div class="col-full slider-test" id="slider-test">
            <?php if (have_rows('t_items')) : ?>
                <?php while (have_rows('t_items')) : the_row(); ?>
                    <div class="testimonials__item">
                        <?php if (get_sub_field('t_items_photo')) : ?>
                            <img class="testimonials__t_photo" src="<?php echo get_sub_field('t_items_photo'); ?>" alt="avatar-testimonials-<?php echo strip_tags(get_sub_field('t_items_name')); ?>">
                        <?php else : ?>
                            </br></br>
                        <?php endif; ?>
                        <div class="testimonials__t_name" id="slick-slide-control3<?php echo (get_row_index() - 1); ?>"><?php echo get_sub_field('t_items_name'); ?></div>
                        <?php if (get_sub_field('t_items_state')) : ?>
                            <div class="testimonials__t_email"><?php echo get_sub_field('t_items_state'); ?></div>
                        <?php endif; ?>
                        <?php if ($stars) : ?>
                            <img class="testimonials__t_stars" src="<?php echo $stars; ?>" alt="stars-testimonials-<?php echo get_row_index(); ?>">
                        <?php endif; ?>
                        <div class="testimonials__t_text">"<?php echo get_sub_field('t_item_text'); ?>"</div>
                    </div>
                <?php endwhile ?>
            <?php endif; ?>
        </div>	
    </div>
</div>