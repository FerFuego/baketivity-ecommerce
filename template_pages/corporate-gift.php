<?php

/**
 * Template Name: Corporate Gift Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="corporate-gift">
    <?php if (have_rows('corporate__flexible-content')) : ?>
        <?php while (have_rows('corporate__flexible-content')) : the_row(); ?>

            <?php if (get_row_layout() == 'hero-corporate') : ?>
                <?php get_template_part('template_parts/modules/module', 'hero-corporate'); ?>

            <?php elseif (get_row_layout() == 'gifting-is-better') : ?>
                <?php get_template_part('template_parts/modules/module', 'gifting-is-better'); ?>

            <?php elseif (get_row_layout() == 'simple-step-by-step-giving') : ?>
                <?php get_template_part('template_parts/modules/module', 'simple-step-by-step-giving'); ?>

            <?php elseif (get_row_layout() == 'corporate-gift') : ?>
                <?php get_template_part('template_parts/modules/module', 'corporate-gift'); ?>

            <?php elseif (get_row_layout() == 'sweeten-your-gifts') : ?>
                <?php get_template_part('template_parts/modules/module', 'sweeten-your-gifts'); ?>

            <?php elseif (get_row_layout() == 'corporate-gift-contact-us') : ?>
                <?php get_template_part('template_parts/modules/module', 'corporate-gift-contact-us'); ?>

            <?php elseif (get_row_layout() == 'baked-goodies') : ?>
                <?php get_template_part('template_parts/modules/module', 'baked-goodies'); ?>

            <?php elseif (get_row_layout() == 'testimonials') : ?>
                <?php get_template_part('template_parts/modules/module', 'testimonials'); ?>

            <?php elseif (get_row_layout() == 'corporate-banner-cta') : ?>
                <?php get_template_part('template_parts/modules/module', 'corporate-banner-cta'); ?>

            <?php endif; ?>

        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>