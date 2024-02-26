<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>
</div>
	<div class="related-products">
		<section class="container">
			<div class="related-products__header">
				<h3 class="related-products__title"><?php esc_html_e( 'You may also like', 'woocommerce' ); ?></h3>
			</div>
			<div class="related-products__content" id="js-related-products">
				<?php 
					$salida = array_slice($related_products, 0, 10); // Limit the number of related products to 10.
					foreach ( $salida as $related_product ) :
						$post_object = get_post( $related_product->get_id() );
						setup_postdata( $GLOBALS['post'] =& $post_object ); ?>
						<div class="related-products__product">
							<!-- Product image -->
							<div class="related-products__product-image"><?php the_post_thumbnail( 'shop_catalog' ); ?></div>
							<!-- Pruduct title -->
							<h4 class="related-products__product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<!-- Product price -->
							<div class="related-products__product-price"><?php echo $related_product->get_price_html(); ?></div>
							<!-- Add to cart -->
							<?php echo do_shortcode( '[add_to_cart id='.$related_product->get_id().']' ); ?>
						</div>
						<?php wp_reset_postdata();
					endforeach; 
				?>
			</div>
		</section>
<?php endif;

wp_reset_postdata();
