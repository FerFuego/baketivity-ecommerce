<section class="module module-testimonial-carousel">
    <div class="wrapper">
        <div class="testimonial-carousel">
            <?php if( have_rows('testimonials') ): ?>
                <?php while( have_rows('testimonials') ): the_row(); ?>
                    <div class="testimonial-carousel__item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36.5" height="28.9" viewBox="0 0 36.5 28.9">
                            <path id="Path_32362" data-name="Path 32362" d="M325.25,9.2l-2.2.9a14.064,14.064,0,0,0-7.1,6.1,19.288,19.288,0,0,0-2.2,9.6V37.9h14.9V23h-4.3a6.492,6.492,0,0,1,.7-2.1,4.336,4.336,0,0,1,2.5-2.2l3-1.3Zm19.6.2-2.1.9a14.636,14.636,0,0,0-7.1,6.1,19.288,19.288,0,0,0-2.2,9.6V38.1h14.9V23.2h-4.3a5.306,5.306,0,0,1,.7-2.1,5.491,5.491,0,0,1,2.5-2.2l3-1.3Z" transform="translate(-313.75 -9.2)" fill="#d9b12e"/>
                        </svg>

                        <?= get_sub_field('testimonial') ?>
                    </div>
                <?php endwhile ?>
            <?php endif ?>
        </div>

        <div class="testimonial-thumb">
            <?php if( have_rows('testimonials') ): ?>
                <?php while( have_rows('testimonials') ): the_row(); ?>
                    <div class="testimonial-thumb__item">
                        <img src="<?= get_sub_field('logo')['url'] ?>" alt="">
                    </div>
                <?php endwhile ?>
            <?php endif ?>
        </div>
    </div>
</section>