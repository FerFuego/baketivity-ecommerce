<div class="give-more-with-baketivity"
    style="background-color: <?php echo get_sub_field('give-more-with-baketivity-background-color') ? get_sub_field('give-more-with-baketivity-background-color') : '#5353E2'; ?>">

    <div class="container">

        <div class="give-more-with-baketivity__header">
            <h3 class="give-more-with-baketivity__title filson-pro-black"><?php echo get_sub_field('give-more-with-baketivity-title'); ?></h3>
            <p class="give-more-with-baketivity__subtitle filson-pro-medium"><?php echo get_sub_field('give-more-with-baketivity-copy'); ?></p>
        </div>
        <span id="find-the-perfect-kit"></span>
        <?php get_template_part( 'template_parts/modules/module', 'one-time-kits' ); ?>
        <div class="give-more-with-baketivity__separator"></div>
        <?php get_template_part( 'template_parts/modules/module', 'subscription-alternative' ); ?>

    </div>

</div>