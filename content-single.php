<?php
/**
 * Template used to display post content on single pages.
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php do_action( 'storefront_single_post_top' ); ?>

	<div class="entry-header">
		<div class="entry-header__container">
			<!-- TITLE -->
			<h1 class="entry-title"><?php the_title(); ?></h1>    
			<!-- EXCERPT -->
			<?php if (get_the_excerpt()) : ?>
			<div class="post-excerpt"><?php echo get_the_excerpt();  ?></div>
			<?php endif; ?>
			<!-- AUTHOR -->
			<?php if (get_field('author_name')) : ?>
			<div class="post-meta">
				<span class="author-name">
					<?php echo get_field('author_label');  ?> <?php echo get_field('author_name');  ?>
				</span>
				<?php if (get_field('author_link')) : ?>
					<a class="post-date" href="<?php echo get_field('author_link')['url']; ?>" target="<?php echo get_field('author_link')['target'];  ?>">
						- <?php echo get_field('author_link')['title']; ?>
					</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<!-- TIME -->
			<?php if (get_field('recipe-time') || get_field('recipe-servings')) : ?>
				<div class="recipe-data">
					<?php if (get_field('recipe-time')) : ?>
						<div class="recipe-data__time">
							<img src="/wp-content/themes/baketivity/images/blog/hour.svg" alt="hour">
							<span><?php echo get_field('recipe-time'); ?></span>
						</div>
					<?php endif; ?>

					<?php if (get_field('recipe-time') && get_field('recipe-servings')) : ?>
						<hr>
					<?php endif; ?>

					<?php if (get_field('recipe-servings'))	: ?>
						<div class="recipe-data__servings">
							<img src="/wp-content/themes/baketivity/images/blog/portion.svg" alt="portions">
							<span><?php echo get_field('recipe-servings'); ?></span>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- PRINT -->
	<div class="entry-print">
		<?php if (get_field('recipe-print')) : ?>
			<button class="recipe-print" type="button" onclick="javascript:printScreenPost('printMe');">
				<svg xmlns="http://www.w3.org/2000/svg" width="11.931" height="13.297" viewBox="0 0 11.931 13.297">
				<path id="Trazado_14110" data-name="Trazado 14110" d="M196.931,112.592h1.657v-4.58a.449.449,0,0,1,.452-.452h6.807a.453.453,0,0,1,.457.452v4.58h1.653a.453.453,0,0,1,.452.457v5.567a.453.453,0,0,1-.452.457H206.3V120.4a.457.457,0,0,1-.457.457h-6.807a.453.453,0,0,1-.452-.457v-1.327h-1.657a.456.456,0,0,1-.452-.457v-5.567A.456.456,0,0,1,196.931,112.592Zm9.373,5.572h1.2V113.5H197.388v4.663h1.2v-1.448a.452.452,0,0,1,.452-.452h6.807a.456.456,0,0,1,.457.452v1.448Zm-.909-1h-5.9v2.779h5.9Zm-5.9-4.576h5.9v-4.128h-5.9Zm6.555,1.614a.561.561,0,1,1-.561.561A.56.56,0,0,1,206.048,114.206Z" transform="translate(-196.479 -107.559)" fill="#717171"/>
				</svg>
				Print It
			</button>
		<?php endif; ?>
	</div>

	<div class="entry-content" id="printMe">
		<!-- THUMBNAIL -->
		<?php if (has_post_thumbnail()) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail('medium_large'); ?>
			</div>
		<?php endif; ?>

		<!-- CONTENT -->
		<?php the_content(); ?>
	</div>

	<?php
	/**
	 * Functions hooked in to storefront_single_post_bottom action
	 *
	 * @hooked storefront_post_nav         - 10
	 * @hooked storefront_display_comments - 20
	 */
	do_action( 'storefront_single_post_bottom' );
	?>

</article><!-- #post-## -->
