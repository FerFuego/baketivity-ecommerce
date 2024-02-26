<?php

/**
 * Template Name: Birthday Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="birthday-page">
    <?php if (have_rows('page__flexible-content')) : ?>
        <?php while (have_rows('page__flexible-content')) : the_row(); ?>

            <?php if (get_row_layout() == 'hero') : ?>
                <?php get_template_part('template_parts/modules/module', 'hero-home'); ?>

            <?php elseif (get_row_layout() == 'bundle-includes') : ?>
                <?php get_template_part('template_parts/modules/module', 'bundle-includes'); ?>

            <?php elseif (get_row_layout() == 'birthday-how-it-works') : ?>
                <?php get_template_part('template_parts/modules/module', 'birthday-how-it-works'); ?>

            <?php elseif (get_row_layout() == 'let-the-celebration-begin') : ?>
                <?php get_template_part('template_parts/modules/module', 'let-the-celebration-begin'); ?>

            <?php elseif (get_row_layout() == 'birthday-box') : ?>
                <?php get_template_part('template_parts/modules/module', 'birthday-box'); ?>

            <?php elseif (get_row_layout() == 'birthday-kid') : ?>
                <?php get_template_part('template_parts/modules/module', 'birthday-kid'); ?>

            <?php elseif (get_row_layout() == 'birthday-banner-footer') : ?>
                <?php get_template_part('template_parts/modules/module', 'baking-banner-footer'); ?>
            <?php endif; ?>

        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>