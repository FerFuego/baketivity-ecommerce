<?php

/**
 * Template Name: Contact Us
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="contact-us">
    <?php
    if (have_rows('contact-us__flexible-content')) :
        while (have_rows('contact-us__flexible-content')) :
            the_row();
            get_template_part('template_parts/modules/module', get_row_layout());
        endwhile;
    endif;
    ?>
</main>
<?php get_footer('2022'); ?>