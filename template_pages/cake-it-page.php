<?php

/**
 * Template Name: Cake IT Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="cake-it">
  <?php if (have_rows('cake__flexible_content')) : ?>
    <?php while (have_rows('cake__flexible_content')) : the_row(); ?>

      <?php if (get_row_layout() == 'hero_cake_it') : ?>
        <?php get_template_part('template_parts/modules/module', 'hero-cake-it'); ?>

      <?php elseif (get_row_layout() == 'how_to_cash_it') : ?>
        <?php get_template_part('template_parts/modules/module', 'how-to-cash-it'); ?>

      <?php elseif (get_row_layout() == 'cake_book') : ?>
        <?php get_template_part('template_parts/modules/module', 'cake-book'); ?>

      <?php elseif (get_row_layout() == 'subscription_cake') : ?>

        <?php if (get_sub_field('alternative_module')) {
          get_template_part('template_parts/modules/module', 'subscription-cake-alt');
        } else {
          get_template_part('template_parts/modules/module', 'subscription-cake');
        }
        ?>

      <?php elseif (get_row_layout() == 'have_your_cake') : ?>
        <?php get_template_part('template_parts/modules/module', 'have-your-cake'); ?>

      <?php elseif (get_row_layout() == 'video') : ?>
        <?php get_template_part('template_parts/modules/module', 'video'); ?>

      <?php elseif (get_row_layout() == 'banner_social_network') : ?>
        <?php get_template_part('template_parts/modules/module', 'banner-social-network'); ?>
      <?php endif; ?>

    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php get_footer(); ?>