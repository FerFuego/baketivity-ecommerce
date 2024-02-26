<?php

/**
 * Template Name: Baketivity Time
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="baketivity-time">
	<?php
	while (have_rows('page__flexible-content')) :
		the_row();
		set_query_var('page', 'cooking-club'); // fix module what-is-inside
		get_template_part('template_parts/modules/module', get_row_layout());
	endwhile;
	?>
</main>

<?php get_footer(); ?>