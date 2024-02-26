<?php
/**
 * Template used to display post content.
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="thum-top">
		<?php echo get_the_tag_list('<p class="tag-css">',' ','</p>');?>
		<a href="<?php echo the_permalink(); ?>" class="thumb-top">
			<?php the_post_thumbnail('thumb-cat-sidebar'); ?>
		</a>
	</div>	
	<a href="<?php echo the_permalink(); ?>"><h3><?php echo get_the_title(); ?></h3></a>
	<div class="post-meta">
		<div class="author-avatar">
			<?php $avatar_url = get_avatar_url ( get_the_author_meta('ID')); ?>

			 <img src="<?php echo $avatar_url; ?>" alt="">
		</div>
		<span class="author-name">
			<?php echo get_the_author_meta('display_name');  ?>
		</span>
		<span class="post-date">
			- <?php echo get_the_date('M d, Y'); ?>
		</span>
		
	</div>
	<p><?php echo excerpt(40); ?></p>

</article><!-- #post-## -->
