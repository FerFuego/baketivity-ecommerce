<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<div class="woocommerce-products-header mt-4">
	<?php if (apply_filters( 'woocommerce_show_page_title', true )) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
		$page_id = 300761; // shop page id
		$layout = 'shop';
		$current_category = get_queried_object();
		if ( $current_category->slug  == 'buy-with-prime') : ?>
			<div class="buy-with-prime <?= $layout; ?>" style="display:block!important;">
				<div class="buy-with-prime__container">
					<div class="buy-with-prime__content" style="background-color: <?= get_field('bg_color', $page_id); ?>;">
						<div class="buy-with-prime__logo-prime">
							<?php $prime_logo = get_field('logo', $page_id); ?>
							<?php if ($prime_logo) : ?>
								<?php echo wp_get_attachment_image( $prime_logo['id'], 'full', false, [ 'loading' => 'false', 'class' => 'buy-with-prime__logo', 'alt' => 'logo amazon prime'] ); ?>
							<?php endif ?>
						</div>
						<div class="buy-with-prime__text">
							<h2 class="buy-with-prime__title"><?= get_field('title', $page_id); ?></h2>
							<h4 class="buy-with-prime__subtitle"><?= get_field('subtitle', $page_id); ?></h4>
						</div>
						<?php if ($layout == 'shop') : ?>
							<input class="d-none" id="coupon_prime" value="<?= get_field('coupon_code', $page_id); ?>">
							<button class="buy-with-prime__cta" onclick="copyToClipboard(this);">Copy code</button>
						<?php else : ?>
							<a class="buy-with-prime__cta-link" href="<?php echo esc_url(home_url('/')) . '/shop/?cat=buy-with-prime'; ?>">View Products</a>
						<?php endif ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</div>
<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			//wc_get_template_part( 'content', 'product' );
			set_query_var('product_id', get_the_ID());
			set_query_var('order_by', 'prime');
			get_template_part( 'template_parts/partials/product-card' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );