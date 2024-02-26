<?php

/**
 * Template Name: Blog Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="blog-page">
    <?php if (have_rows('blog__flexible-content')) : ?>
        <?php while (have_rows('blog__flexible-content')) : the_row(); ?>

            <?php if (get_row_layout() == 'blog-header') : ?>
                <?php get_template_part('template_parts/modules/module', 'blog-header'); ?>
                <?php get_template_part('template_parts/modules/module', 'blog-body'); ?>
            <?php elseif (get_row_layout() == 'blog-banner-cta-1') : ?>
                <?php get_template_part('template_parts/modules/module', 'blog-banner-cta-1'); ?>
            <?php elseif (get_row_layout() == 'blog-banner-cta-2') : ?>
                <?php get_template_part('template_parts/modules/module', 'blog-banner-cta-2'); ?>
            <?php elseif (get_row_layout() == 'faq') : ?>
                <?php get_template_part('template_parts/modules/module', 'accordion-faq'); ?>
            <?php endif; ?>

        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>