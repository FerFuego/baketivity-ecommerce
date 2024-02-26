<?php

/**
 * Template Name: Holiday
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="page-home holiday">
  <?php if (have_rows('page__flexible-content')) : ?>
    <?php while (have_rows('page__flexible-content')) : the_row(); ?>

      <?php if (get_row_layout() == 'hero-home') : ?>
        <?php get_template_part('template_parts/modules/module', 'hero-home'); ?>

      <?php elseif (get_row_layout() == 'steps-to-play') : ?>
        <?php get_template_part('template_parts/modules/module', 'steps-to-play'); ?>

      <?php elseif (get_row_layout() == 'experience') : ?>
        <?php get_template_part('template_parts/modules/module', 'experience'); ?>

      <?php elseif (get_row_layout() == 'plan-for-plan') : ?>
        <?php get_template_part('template_parts/modules/module', 'plan-for-plan'); ?>

      <?php elseif (get_row_layout() == 'what-is-inside') : ?>
        <?php get_template_part('template_parts/modules/module', 'what-is-inside'); ?>

      <?php elseif (get_row_layout() == 'subscription') : ?>
        <?php get_template_part('template_parts/modules/module', 'subscription'); ?>

      <?php elseif (get_row_layout() == 'share') : ?>
        <?php get_template_part('template_parts/modules/module', 'share'); ?>

      <?php elseif (get_row_layout() == 'banner-duff') : ?>
        <?php get_template_part('template_parts/modules/module', 'banner-duff'); ?>

      <?php elseif (get_row_layout() == 'one-time-kits') : ?>
        <?php get_template_part('template_parts/modules/module', 'one-time-kits'); ?>

      <?php elseif (get_row_layout() == 'find-a-kit') : ?>
        <?php get_template_part('template_parts/modules/module', 'find-a-kit'); ?>

      <?php elseif (get_row_layout() == 'testimonials') : ?>
        <?php get_template_part('template_parts/modules/module', 'testimonials'); ?>

      <?php elseif (get_row_layout() == 'logo-reels') : ?>
        <?php get_template_part('template_parts/modules/module', 'logo-reels'); ?>

      <?php elseif (get_row_layout() == 'banner-cta') : ?>
        <?php get_template_part('template_parts/modules/module', 'product_page_cta'); ?>

      <?php elseif (get_row_layout() == 'banner-promo') : ?>
        <?php get_template_part('template_parts/modules/module', 'banner-promo'); ?>

      <?php elseif (get_row_layout() == 'holiday-season') : ?>
        <?php get_template_part('template_parts/modules/module', 'holiday-season'); ?>

      <?php elseif (get_row_layout() == 'experience-holiday') : ?>
        <?php get_template_part('template_parts/modules/module', 'experience-holiday'); ?>

      <?php endif; ?>

    <?php endwhile; ?>
  <?php endif; ?>
  <!-- Popup -->
  <?php get_template_part('template_parts/modules/module', 'cooking-popup'); ?>
</main>

<?php get_footer(); ?>