<?php

/**
 * Template Name: Shopping List Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="shopping-list-page">
    <?php
    if (have_rows('content__flexible-content')) :
        while (have_rows('content__flexible-content')) : the_row();

            if (get_row_layout() == 'hero') :
                get_template_part('template_parts/modules/module', 'hero-home');

            elseif (get_row_layout() == 'next_list') :
                get_template_part('template_parts/modules/module', 'block-list');

            elseif (get_row_layout() == 'grid_3_columns') :
                get_template_part('template_parts/modules/module', 'block-list-grid-3');

            elseif (get_row_layout() == 'grid_4_columns') :
                get_template_part('template_parts/modules/module', 'block-list-grid-4');

            elseif (get_row_layout() == 'footer_banner') :
                get_template_part('template_parts/modules/module', 'footer-ready-to-become');
            endif;

        endwhile;
    endif;
    ?>
</main>

<?php get_footer('2022'); ?>