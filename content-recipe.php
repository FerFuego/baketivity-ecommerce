<?php
/**
 * Template used to display post content on single pages.
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="d-video">
		<?php if(get_field('video_')): ?>
			<video width="" height="" controls>
				<source src="<?php echo get_field('video_'); ?>" type="video/mp4">
				Your browser does not support the video tag.
			</video>
			<span class="play"></span>
		<?php endif; ?>
	</div>
</article><!-- #post-## -->
