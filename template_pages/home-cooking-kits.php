<?php

/**
 * Template Name: Home Cooking Kits
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="page-cooking-kits">
  <?php if (have_rows('page__flexible-content')) : ?>
    <?php while (have_rows('page__flexible-content')) : the_row(); ?>

      <?php if (get_row_layout() == 'hero') : ?>
        <?php get_template_part('template_parts/modules/module', 'hero-cooking'); ?>

      <?php elseif (get_row_layout() == 'banner-full-width') : ?>
        <?php get_template_part('template_parts/modules/module', 'banner-full-width'); ?>

      <?php elseif (get_row_layout() == 'cooking-reinventing') : ?>
        <?php get_template_part('template_parts/modules/module', 'cooking-reinventing'); ?>

      <?php elseif (get_row_layout() == 'how-it-works') : ?>
        <?php get_template_part('template_parts/modules/module', 'how-it-works'); ?>

      <?php elseif (get_row_layout() == 'subscription') : ?>
        <?php get_template_part('template_parts/modules/module', 'subscription-cooking-kit'); ?>

      <?php elseif (get_row_layout() == 'shipping') : ?>
        <?php get_template_part('template_parts/modules/module', 'shipping'); ?>

      <?php elseif (get_row_layout() == 'who-its-for') : ?>
        <?php get_template_part('template_parts/modules/module', 'who-its-for'); ?>

      <?php elseif (get_row_layout() == 'inside-home') : ?>
        <?php get_template_part('template_parts/modules/module', 'inside-home'); ?>

      <?php elseif (get_row_layout() == 'cta-reclaim') : ?>
        <?php get_template_part('template_parts/modules/module', 'cta-reclaim'); ?>
      <?php endif; ?>

    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>