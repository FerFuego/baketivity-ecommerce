<?php

/**
 * Template Name: Referral Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="referral-page">
  <?php if (have_rows('referral__flexible_content')) : ?>
    <?php while (have_rows('referral__flexible_content')) : the_row(); ?>

      <?php if (get_row_layout() == 'hero-referral') : ?>
        <?php get_template_part('template_parts/modules/module', 'hero-referral'); ?>

      <?php elseif (get_row_layout() == 'spread-sweet-moments') : ?>
        <?php get_template_part('template_parts/modules/module', 'spread-sweet-moments'); ?>

      <?php elseif (get_row_layout() == 'the-joy-of-baking') : ?>
        <?php get_template_part('template_parts/modules/module', 'the-joy-of-baking'); ?>

      <?php elseif (get_row_layout() == 'banner-referral') : ?>
        <?php get_template_part('template_parts/modules/module', 'banner-referral'); ?>
      <?php endif; ?>

    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_template_part('/template_parts/modules/module', 'form-login'); ?>

<?php get_template_part('template_parts/modules/module', 'footer-referral'); ?>

<?php get_footer(); ?>