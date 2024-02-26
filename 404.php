<?php

/**
 * Template Name: Page 404
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<div class="baketivity-404">

    <div class="baketivity-404__content">
        <h1 class="baketivity-404__title"><?php _e('Whoops! <br> Page not found', 'baketivity'); ?></h1>
        <a class="baketivity-404__button button-hovered" href="<?php echo esc_url(home_url()); ?>" rel="noopener noreferrer"><?php _e('Go to home', 'baketivity'); ?></a>
    </div>

    <?php get_template_part('template_parts/modules/module', 'banner-login'); ?>

</div>

<?php get_footer(); ?>