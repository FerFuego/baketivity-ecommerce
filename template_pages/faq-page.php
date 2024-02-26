<?php

/**
 * Template Name: FAQ page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="page-faq">
  <?php if (have_rows('page__flexible-content')) : ?>
    <?php while (have_rows('page__flexible-content')) : the_row(); ?>

      <?php if (get_row_layout() == 'hero-faq') : ?>
        <?php get_template_part('template_parts/modules/module', 'hero-faq'); ?>

      <?php elseif (get_row_layout() == 'accordion_faq') : ?>
        <?php get_template_part('template_parts/modules/module', 'accordion-faq'); ?>

      <?php elseif (get_row_layout() == 'contact_faq') : ?>
        <?php get_template_part('template_parts/modules/module', 'contact-faq'); ?>

      <?php endif; ?>

    <?php endwhile; ?>
  <?php endif; ?>


</main>

<?php get_footer(); ?>