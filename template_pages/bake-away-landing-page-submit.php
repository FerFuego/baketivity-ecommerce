<?php

/**
 * Template Name: Bake Away Submit Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="bake-away-submit">
    <?php
    while (have_rows('page__flexible-content')) :
        the_row();
        get_template_part('template_parts/modules/module', get_row_layout());
    endwhile;
    ?>
</main>

<?php get_footer(); ?>