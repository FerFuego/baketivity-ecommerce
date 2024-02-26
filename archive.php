<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */

get_header(); 

$term = get_queried_object();
$data = get_field('layout',$term);
switch ($data) {
	case 'full':
		$classes = 'full_widthcss';
		break;
	
	default:
		$classes = 'right_sidebarcss';
		break;
} ?>

<div id="primary" class="content-area <?php echo $classes; ?>">
	<main id="main" class="site-main" role="main">

	<?php if ( have_posts() ) :
		
		if(get_field('layout',$term) == 'full'){
			get_template_part( 'loop' );
		}else{
			get_template_part( 'loop-sidebar');
		}

	else :

		get_template_part( 'content', 'none' );

	endif; ?>

	</main><!-- #main -->
	<?php if ( get_field('layout',$term) == 'righsider'): ?>
		<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'blog_sidebar' ); ?>
		</div><!-- #primary-sidebar -->
	<?php endif;  ?>
</div><!-- #primary -->

<?php get_footer();