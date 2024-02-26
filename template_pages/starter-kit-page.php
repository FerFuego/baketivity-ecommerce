<?php

/**
 * Template Name: Starter Kit Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="starter-kit">
  <?php if (have_rows('starter__flexible_content')) : ?>
    <?php while (have_rows('starter__flexible_content')) : the_row(); ?>

      <?php if (get_row_layout() == 'hero-starter-kit') : ?>
        <?php get_template_part('template_parts/modules/module', 'hero-starter-kit'); ?>

      <?php elseif (get_row_layout() == 'steps-starter-kit') : ?>
        <?php get_template_part('template_parts/modules/module', 'steps-starter-kit'); ?>

      <?php elseif (get_row_layout() == 'get-a-taste') : ?>
        <?php get_template_part('template_parts/modules/module', 'get-a-taste'); ?>

      <?php elseif (get_row_layout() == 'sign-up-for-your-free-kit') : ?>
        <?php get_template_part('template_parts/modules/module', 'sign-up-for-your-free-kit'); ?>

      <?php elseif (get_row_layout() == 'video-promo') : ?>
        <?php get_template_part('template_parts/modules/module', 'video-promo'); ?>

      <?php elseif (get_row_layout() == 'video_streaming') : ?>
        <?php get_template_part('template_parts/modules/module', 'video_streaming'); ?>

      <?php endif; ?>

    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>