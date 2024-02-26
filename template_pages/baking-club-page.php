<?php

/**
 * Template Name: Baking Club
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="baking-page">
    <?php if (have_rows('page__flexible-content')) : ?>
        <?php while (have_rows('page__flexible-content')) : the_row(); ?>

            <?php if (get_row_layout() == 'hero-baking') : ?>
                <?php get_template_part('template_parts/modules/module', 'hero-baking'); ?>

            <?php elseif (get_row_layout() == 'hero-home-simple') : ?>
                <?php get_template_part('template_parts/modules/module', 'hero-home-simple'); ?>

            <?php elseif (get_row_layout() == 'baking-tab-cta') : ?>
                <?php get_template_part('template_parts/modules/module', 'baking-tab-cta'); ?>

            <?php elseif (get_row_layout() == 'subscription') : ?>
                <?php get_template_part('template_parts/modules/module', 'title-subscription'); ?>
                <?php get_template_part('template_parts/modules/module', 'subscription'); ?>

            <?php elseif (get_row_layout() == 'baking-club-duff') : ?>
                <?php set_query_var('page', 'baking-club'); ?>
                <?php get_template_part('template_parts/modules/module', 'baking-club-duff'); ?>

            <?php elseif (get_row_layout() == 'red-banner-cta') : ?>
                <?php get_template_part('template_parts/modules/module', 'red-banner-cta'); ?>

            <?php elseif (get_row_layout() == 'what-is-inside') : ?>
                <?php set_query_var('page', 'baking-club'); ?>
                <?php get_template_part('template_parts/modules/module', 'cooking-what-is-inside'); ?>

            <?php elseif (get_row_layout() == 'what-is-inside-2') : ?>
                <?php set_query_var('page', 'baking-club'); ?>
                <?php get_template_part('template_parts/modules/module', 'cooking-what-is-inside-2'); ?>

            <?php elseif (get_row_layout() == 'lets-get-baking') : ?>
                <?php get_template_part('template_parts/modules/module', 'lets-get-baking'); ?>

            <?php elseif (get_row_layout() == 'shopping-list') : ?>
                <?php get_template_part('template_parts/modules/module', 'shopping-list'); ?>

            <?php elseif (get_row_layout() == 'baking-banner-footer') : ?>
                <?php get_template_part('template_parts/modules/module', 'baking-banner-footer'); ?>

            <?php elseif (get_row_layout() == 'video-promo') : ?>
                <?php get_template_part('template_parts/modules/module', 'video-promo'); ?>

            <?php elseif (get_row_layout() == 'video_streaming') : ?>
                <?php get_template_part('template_parts/modules/module', 'video_streaming'); ?>

            <?php elseif (get_row_layout() == 'soft-reviews') : ?>
                <?php get_template_part('template_parts/modules/module', 'soft-reviews'); ?>

            <?php endif; ?>

        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>