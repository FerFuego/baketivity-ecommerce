<?php

/**
 * Template Name: Search Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="shop-page search-page">
    <?php get_template_part('template_parts/modules/module', 'hero-search'); ?>
    <?php get_template_part('template_parts/partials/search', 'filters'); ?>
    <?php get_template_part('template_parts/modules/module', 'search'); ?>
</main>

<?php get_footer(); ?>