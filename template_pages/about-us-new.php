<?php

/**
 * Template Name: About Us (New)
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="about-us">

	<?php

	while (have_rows('about-us__flexible-content')) :
		the_row();
		$module = get_row_layout();
		get_template_part('template_parts/modules/module', $module);

	endwhile;
	?>

</main>

<?php get_footer(); ?>