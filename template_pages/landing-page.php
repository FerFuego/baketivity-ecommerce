<?php
/**
 * Template Name: Landing Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="landing-page">
    <?php
		while (have_rows('contents')) :
			the_row();
			$module = get_row_layout();
            get_template_part('template_parts/modules/module-landing', $module);
		endwhile;
    ?>
</main>

<?php get_footer(); ?>