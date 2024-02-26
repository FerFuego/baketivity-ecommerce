<?php
/**
 * Template used to display post content on blog and category pages.
 *
 * @package baketivity
 */
?>

<article class="blog-body__item-post" style="background-color: <?php echo $color; ?>;" id="post-<?php the_ID(); ?>">
    <h3 class="blog-body__item-post-title"><?php echo get_the_title(); ?></h3>
    <div class="blog-body__item-post-cont-img post-thumb-zoom">
        <?php $image_id = get_post_thumbnail_id(get_the_ID()); ?>
        <?php $thumb = wp_get_attachment_image_url( $image_id, 'medium_large' ); ?>
        <a class="blog-body__item-post-img post-thumb-child" style="background-image: url(<?php echo $thumb ? $thumb : '/wp-content/themes/baketivity/images/blog/default.webp'; ?>);" href="<?php echo the_permalink(); ?>"></a>
    </div>
    <h3 class="blog-body__item-post-title--mobile"><?php echo get_the_title(); ?></h3>
    <?php if ( excerpt(15) ) : ?>
        <p class="blog-body__item-post-text"><?php echo excerpt(15); ?>...</p>
    <?php else : ?>
        <p class="blog-body__item-post-text">Read the latest news, recipes, and special content</p>
    <?php endif; ?>
	<a class="blog-body__item-post-btn button-hovered" href="<?php echo the_permalink(); ?>"><?php echo $label; ?></a>
</article><!-- #post-## -->