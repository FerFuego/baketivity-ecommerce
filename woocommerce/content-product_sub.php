<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class( '', $product ); ?>>
	
	<?php 
	$price_sale =  WC_Subscriptions_Product::get_price( $product ); 
	$get_regular_price =  WC_Subscriptions_Product::get_regular_price( $product ); 
	$period = WC_Subscriptions_Product::get_period( $product ); 
	$lenght = WC_Subscriptions_Product::get_length( $product );
	$lenght   = WC_Subscriptions_Product::get_interval($product);  
	$hardcode_title = null;

	if ($product->get_ID() == '294137') {
		$hardcode_title = 'Monthly';
	}
	if ($product->get_ID() == '300280') {
		$hardcode_title = '3 Months';
	}
	if ($product->get_ID() == '300283') {
		$hardcode_title = '6 Months';
	}
	if ($product->get_ID() == '300284') {
		$hardcode_title = 'Yearly';
		echo '<div class="year-bage"><span>BEST VALUE Over 2 free kits!</span><svg id="Group_76896" data-name="Group 76896" xmlns="http://www.w3.org/2000/svg" width="28.695" height="40.057" viewBox="0 0 28.695 40.057"><path id="Path_32353" data-name="Path 32353" d="M36.563-82.541c.5-.52,3.271-1.337,2.777-.826a53.723,53.723,0,0,0-8.918,11.414c-.908,1.689-2.38,4.531-.306,5.922,2.219,1.489,6.664.128,9.006-.327,2.585-.5,12.508-3.981,14.242-.359.443.926-.023,2.072-.322,2.949-.88,2.574-2.1,5.089-3.148,7.6q-1.452,3.486-2.924,6.965,2.5-1.627,5.007-3.257c1.556-1.013,3.8,1.339,2.084,2.459l-9.618,6.258a1.768,1.768,0,0,1-2.669-1.484q-.227-5.736-.453-11.47c-.077-1.948,3.18-1.339,3.253.506q.122,3.069.243,6.141,1.043-2.481,2.084-4.965c1.1-2.639,2.59-5.367,3.344-8.122.245-.9.5-1.9-.208-2.651-1.706-1.822-6.484-.289-8.488.105a84.072,84.072,0,0,1-9.588,1.675c-1.692.133-4.709.4-5.672-1.435-.978-1.86.651-4.552,1.554-6.094a59.981,59.981,0,0,1,8.72-11Z" transform="translate(-25.987 83.529)" fill="#ee324d"/></svg></div>';
	}
	?>

	<div class="sub-top ">
		<?php  if(get_query_var('title_tag') == 'span'): ?>
			<span class="d-sub-title">
				<?php echo ($hardcode_title) ? $hardcode_title : get_the_title(); ?>
			</span>
		<?php else: ?>
			<h2 class="d-sub-title">
				<?php echo ($hardcode_title) ? $hardcode_title : get_the_title(); ?>
			</h2>
		<?php endif; ?>

		<?php if ($period == 'month') {
				$price_sale_per_month = $price_sale / $lenght;
				$get_regular_price_per_month = $get_regular_price /  $lenght;
			}else if ($period == 'year') {
				$lenght = $lenght * 12;
				$price_sale_per_month = $price_sale / $lenght;
				$get_regular_price_per_month = $get_regular_price / $lenght;
			} else {
				$price_sale_per_month = 0;
				$get_regular_price_per_month =0;
			}
			if($price_sale_per_month > 0 && $get_regular_price_per_month > 0 ){ ?>
				<h4><?php echo wc_price($price_sale_per_month);  ?></h4>
				<span class="per-month">PER MONTH</span>
				<span class="sub-total">Total <?php echo wc_price($price_sale); ?></span>
		<?php 
			} else {
				woocommerce_template_loop_price();
			}   
		?>
	</div>

	<a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>?add-to-cart=<?php echo $product->get_id(); ?>" data-quantity="1" class="button product_type_subscription add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product->get_id(); ?>" data-product_sku="<?php echo $product->get_sku(); ?>" aria-label="Add “3 MONTHS” to your cart" rel="nofollow" product_name="<?php echo $product->get_name(); ?>" product_price="<?php echo $product->get_price(); ?>" product_type="<?php echo $product->get_type(); ?>"><span>JOIN THIS PLAN</span></a> 

	<div class="meta-sub">
		<span class="free-sp-alert">FREE SHIPPING IN USA</span>
		<span class="cancel-cs">cancel renewal anytime</span>
	</div>

	<span class="sub-save-price">
		<div>save</div><div><?php echo wc_price($get_regular_price - $price_sale,array( 'decimals' => 0 )); ?>!</div>
	</span>

</div>