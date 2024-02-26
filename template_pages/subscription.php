<?php

/**
 * Template Name: Subscriptions
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php if (get_field('campain_header')) : ?>
	<?php get_header('campain'); ?>
<?php else : ?>
	<?php get_header(); ?>
<?php endif; ?>

<main class="subscriptions">

	<?php
	while (have_rows('subscriptions__flexible-content')) :
		the_row();
		if (get_field('campain_header')) set_query_var('campain_header', true);
		get_template_part('template_parts/modules/module', get_row_layout());
	endwhile;
	?>

</main>

<?php get_footer(); ?>