<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */

get_header(); ?>

<div id="primary" class="content-area baketivity-single-post">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post();

			do_action( 'storefront_single_post_before' ); ?>

			<a class="back-to-blog" href="/blog/">
				<img class="back-to-blog__icon" src="/wp-content/themes/baketivity/images/blog/recipes.webp" alt="recipes">
				<spane class="back-to-blog__label">Back to Blog</span>
			</a>

			<?php get_template_part( 'content', 'single' );

			do_action( 'storefront_single_post_after' );

		endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
do_action( 'storefront_bottom');
do_action( 'storefront_bottom_post');

get_footer();