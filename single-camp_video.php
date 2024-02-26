<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main camp-vd" role="main">

		<?php
		while ( have_posts() ) :
			the_post();

			//do_action( 'storefront_single_post_before' );

			get_template_part( 'content', 'camp');

			do_action( 'storefront_single_post_after' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
		<?php //if ( get_field('layout',$term) == 'righsider'): ?>
			<!-- <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
				<?php //dynamic_sidebar( 'blog_sidebar' ); ?>
			</div> --><!-- #primary-sidebar -->
		<?php // endif;  ?>
	</div><!-- #primary -->
</div>
<div class="bottom-single-post">

<?php
do_action( 'd_camp_video_bottom_content');
//do_action( 'storefront_bottom');
if ( comments_open() || 0 !== intval( get_comments_number() ) ) :
			comments_template();
		endif;
do_action( 'storefront_bottom_post');
do_action( 'd_camp_video_bottom');
get_footer();
