<?php

/**
 * Template Name: Duff Goldman's Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="duff-goldman">
    <?php if (have_rows('duff__flexible_content')) : ?>
        <?php while (have_rows('duff__flexible_content')) : the_row(); ?>

            <?php if (get_row_layout() == 'hero_duff') : ?>
                <?php get_template_part('template_parts/modules/module', 'hero-duff'); ?>

            <?php elseif (get_row_layout() == 'subscription_duff') : ?>
                <?php get_template_part('template_parts/modules/module', 'subscription-duff'); ?>
            <?php endif; ?>

            <?php if (get_row_layout() == 'shop_duff') : ?>
                <?php get_template_part('template_parts/modules/module', 'shop-duff'); ?>
            <?php endif; ?>

            <?php if (get_row_layout() == 'video_duff') : ?>
                <?php get_template_part('template_parts/modules/module', 'video-duff'); ?>
            <?php endif; ?>

            <?php if (get_row_layout() == 'content_duff') : ?>
                <?php get_template_part('template_parts/modules/module', 'content-duff'); ?>
            <?php endif; ?>

            <?php if (get_row_layout() == 'banner_social_network_duff') : ?>
                <?php get_template_part('template_parts/modules/module', 'banner-social-network-duff'); ?>
            <?php endif; ?>


        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>