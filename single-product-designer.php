<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area right_sidebarcss">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :
			the_post();

			do_action( 'storefront_single_post_before' );

			get_template_part( 'content', 'single' );

			do_action( 'storefront_single_post_after' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
		<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'blog_sidebar' ); ?>
		</div><!-- #primary-sidebar -->
	</div><!-- #primary -->
</div>
<div class="bottom-single-post">

<?php
if ( comments_open() || 0 !== intval( get_comments_number() ) ) :
	comments_template();
endif;

get_footer();
