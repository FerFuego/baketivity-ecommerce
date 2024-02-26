<div class="hero-faq"
    style="background-color: <?php echo get_sub_field('background_color') ? get_sub_field('background_color') : '#5353E2'; ?>">
    <div class="container">
        <div class="hero-faq__col-1">
            <h3 class="hero-faq__title filson-pro-black"><?php echo get_sub_field('title'); ?></h3>
            <p class="hero-faq__subtitle filson-pro-heavy"><?php echo get_sub_field('copy'); ?></p>
        </div>
        <div class="hero-faq__col-2">
            <div class="hero-faq__img-content">
                <img class="hero-faq__img-1" src="<?php echo get_sub_field('image')['url']; ?>" alt="faq_1">
            </div>
        </div>
    </div>
</div>