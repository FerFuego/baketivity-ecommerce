<?php

/**
 * Template Name: Home Principal
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="page-home">
  <?php if (have_rows('page__flexible-content')) : ?>
    <?php while (have_rows('page__flexible-content')) : the_row(); ?>

      <?php if (get_row_layout() == 'hero-home') : ?>
        <?php get_template_part('template_parts/modules/module', 'hero-home'); ?>

      <?php elseif (get_row_layout() == 'hero-slider') : ?>
        <?php get_template_part('template_parts/modules/module', 'hero-slider'); ?>

      <?php elseif (get_row_layout() == 'hero-home-simple') : ?>
        <?php get_template_part('template_parts/modules/module', 'hero-home-simple'); ?>

      <?php elseif (get_row_layout() == 'highlighted') : ?>
        <?php get_template_part('template_parts/modules/module', 'highlighted'); ?>

      <?php elseif (get_row_layout() == 'how-baketivity-work') : ?>
        <?php get_template_part('template_parts/modules/module', 'how-baketivity-work'); ?>

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

      <?php elseif (get_row_layout() == 'video-promo') : ?>
        <?php get_template_part('template_parts/modules/module', 'video-promo'); ?>

      <?php elseif (get_row_layout() == 'video_streaming') : ?>
        <?php get_template_part('template_parts/modules/module', 'video_streaming'); ?>

      <?php elseif (get_row_layout() == 'buy-with-prime') :
        set_query_var('layout', 'home');
        get_template_part('template_parts/modules/module', 'buy-with-prime'); ?>

      <?php elseif (get_row_layout() == 'banner-dynamic') : ?>
        <?php get_template_part('template_parts/modules/module', 'banner-dynamic'); ?>
      <?php endif; ?>

    <?php endwhile; ?>
  <?php endif; ?>
  <!-- Popup -->
  <?php get_template_part('template_parts/modules/module', 'cooking-popup'); ?>
</main>

<?php get_footer(); ?>