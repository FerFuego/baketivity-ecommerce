<?php

/**
 * Template Name: Gifting Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="page-gifting">
  <?php if (have_rows('page__flexible-content')) : ?>
    <?php while (have_rows('page__flexible-content')) : the_row(); ?>

      <?php if (get_row_layout() == 'hero-gifting') : ?>
        <?php get_template_part('template_parts/modules/module', 'hero-about-us'); ?>

      <?php elseif (get_row_layout() == 'give-more-with-baketivity') : ?>
        <?php get_template_part('template_parts/modules/module', 'give-more-with-baketivity'); ?>

      <?php elseif (get_row_layout() == 'whats-the-occasion') : ?>
        <?php get_template_part('template_parts/modules/module', 'gifting-whats-the-occasion'); ?>

      <?php elseif (get_row_layout() == 'everything-you-want-in-a-gift') : ?>
        <?php get_template_part('template_parts/modules/module', 'everything-you-want-in-a-gift'); ?>

      <?php elseif (get_row_layout() == 'the-sweetest-gift-their-choice') : ?>
        <?php get_template_part('template_parts/modules/module', 'the-sweetest-gift-their-choice'); ?>

      <?php elseif (get_row_layout() == 'make-it-extra-special') : ?>
        <?php get_template_part('template_parts/modules/module', 'make-it-extra-special'); ?>

      <?php elseif (get_row_layout() == 'testimonials') : ?>
        <?php get_template_part('template_parts/modules/module', 'testimonials'); ?>

      <?php endif; ?>

    <?php endwhile; ?>
  <?php endif; ?>


</main>

<?php get_footer(); ?>