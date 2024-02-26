<?php 
add_action('woocommerce_single_product_summary_designer','d_custom_product_title',5);
add_action('woocommerce_single_product_summary_designer','woocommerce_template_single_rating',15);
add_action('woocommerce_single_product_summary_designer','woocommerce_template_single_price',20);
add_action('woocommerce_single_product_summary_designer','woocommerce_template_single_excerpt',10);
add_action('woocommerce_single_product_summary_designer','woocommerce_template_single_add_to_cart',25);
/** cambio de posición del extracto **/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt' , 20); 
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt' , 31);  
/** End cambio de posición del extracto **/

add_action('woocommerce_before_single_product_designer','single_product_designer_thumb');
function single_product_designer_thumb (){
	global $product;
	?>
	<img class="showmobi-des-thumb" style="display: none;" src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" />
	<style type="text/css">
		@media(max-width: 767px){
			img.showmobi-des-thumb {
			    display: block !important;
			    margin-top: -60px;
			}
		}
	</style>
	<?php
}

add_action('woocommerce_single_product_summary_designer','d_woocommerce_template_single_title_before',9);

function d_woocommerce_template_single_title_before(){
	echo '<h1 style="
        color: #0AA8AA;
    text-transform: unset;
    font-size: 19px !important;
    text-transform: uppercase;
">Great tasting Cookies With Your Picture On Them!</h1>';
}

function d_custom_product_title(){
	the_title( '<h2 style="
    color: #ee324d;
    text-transform: unset;
    font-family: "FilsonPro";
    font-size: 42px; font-weight: bold; margin-bottom: 0;" class="product_title entry-title">', '</h2>' );
}

add_action('woocommerce_after_single_product_designer','d_woocommerce_template_single_content',35);

add_action('woocommerce_after_single_product_summary_designer','woocommerce_output_product_data_tabs');
function d_woocommerce_template_single_content(){
	echo d_get_page_content(29370);
}

add_action('woocommerce_after_single_product_designer_bot','d_woocommerce_template_single_content_bot');
function d_woocommerce_template_single_content_bot(){
	echo d_get_page_content(29371);
}

add_action('wp_footer','d_js_product_des');
function d_js_product_des(){
 ?>
 <script type="text/javascript">
 	jQuery(document).ready(function(){
		jQuery('a.d-start-des').click(function(e){
			e.preventDefault();
			jQuery(this).parents('main#main').find('button.single_add_to_cart_button.button').trigger('click');
		})
	});
 </script>
 <?php
}

// Commented by Fer Catalano
// define the woocommerce_product_single_add_to_cart_text callback 
//function filter_woocommerce_product_single_add_to_cart_text( $var, $instance ) { 
	//global $product;
    // make filter magic happen here... 
    //if ( zakeke_is_customizable( $product->get_id() ) ) {
	//	$var = __( 'START DESIGNING', 'zakeke' );
	//}
    //return $var; 
//};     
// add the filter 
//add_filter( 'woocommerce_product_single_add_to_cart_text', 'filter_woocommerce_product_single_add_to_cart_text', 100, 2 ); 




// add_action()
// function dafds(){
// 	echo d_get_page_content(20726);
// }

// Register Custom Taxonomy
function custom_taxonomy_product_designer() {

	$labels = array(
		'name'                       => _x( 'Designer', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Designer', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Designer', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'product_designer', array( 'product' ), $args );

}
add_action( 'init', 'custom_taxonomy_product_designer', 0 );

function sp_comment_moderation_recipients( $emails, $comment_id ) {
	$comment = get_comment( $comment_id );
    $post = get_post( $comment->comment_post_ID );
    if($post->post_type == 'baking_kit_video'){
      $emails = array('yanky@baketivity.com');
    }

    if($post->post_type == 'post'){
      $emails = array('madison@baketivity.com');
    }

    return $emails;
}
add_filter( 'comment_moderation_recipients', 'sp_comment_moderation_recipients', 10, 2 );
add_filter( 'comment_notification_recipients', 'sp_comment_moderation_recipients', 10, 2 );

//add_shortcode('dtest','d_functions_test');
function d_functions_test(){
	$subscriptions = wcs_get_subscriptions(['subscriptions_per_page' => 2000,'subscription_status'    => array( 'active' )]);

	//Loop through subscriptions protected objects
	foreach ( $subscriptions as $subscription ) {

	    // Unprotected data in an accessible array
	    $data = $subscription->get_data();

		$notes = wc_get_order_notes( array(
	        'order_id' => $subscription->get_id(),
	        'type'     => 'internal', // use 'internal' for admin and system notes, empty for all
	    ) );
	    $check = true;
	    $product = $subscription->get_items();

	    $str = strlen($notes['0']->content);

	    $relared_orders_ids_array = $subscription->get_related_orders();

		$order = new WC_Order( $data['parent_id'] );
		$items = $order->get_items();


		foreach ( $items as $product ) {
			$product_id = $product->get_product_id();
			$products = wc_get_product( $product_id );
			$period = WC_Subscriptions_Product::get_period( $products ); 
			$lenght   = WC_Subscriptions_Product::get_interval($products);

			if($period == 'year' && $lenght == 1){
				$check = false;
			}

			if($period  == 'month' && $lenght == 1){
				$check = false;
			}
		}

	    $count = count($relared_orders_ids_array);
	    if( $count == 1 && !$subscription->is_manual() && $str== '38' && $check == true){
	    	echo $subscription->get_id().' ';
	 	}

	}

}

//add_action( 'woocommerce_checkout_order_review', 'd_woocommerce_order_note', 15 );
function d_woocommerce_order_note(){
	?>
	<div class="d_woocommerce_order_note">
		<h3>shipping notice</h3>
		<p>Due to the Passover holiday, our offices are closed from May 14 - 18. Order will be processed, and shipping will resume, on May 19. Thank you for your patience!</p>
	</div>
	<?php
}

/**
 *  Display Breadcrumbs On Single Product Page
 * @author Fer Catalano
 */
function prefix_wp_breadcrumb() {
    if ( is_product() ) {
		echo '<div class="single-product__breadcrumb">'
			.'<a href="'.home_url().'">Home</a>'
			.'<span class="separator">/</span>'
			.'<a href="'.home_url().'/shop/">Shop</a>'
			.'<span class="separator">/</span>'
			.'<a href="'.home_url().'/product-category/'.get_the_terms( get_the_ID(), 'product_cat' )[0]->slug.'/">'.get_the_terms( get_the_ID(), 'product_cat' )[0]->name.'</a>'
			.'<span class="separator">/</span>'
			.'<a class="active" href="'.get_permalink().'">'.get_the_title().'</a>'
			.'</div>';
    }
}
add_action( 'woocommerce_before_single_product_summary', 'prefix_wp_breadcrumb', 5 );

/**
 * Display Product ACF On Single Product Page
 * List of modules to display on single product page
 * Add your modules with each 'elseif' condition
 * @author Fer Catalano
 */
add_action( 'woocommerce_after_single_product_summary', 'baketivity_display_content', 0 );
function baketivity_display_content() {
	if(get_field('video_unboxing')):
		get_template_part( 'template_parts/modules/module', 'video-unboxing' );
	endif;
	if ( have_rows( 'product__flexible_content' ) ) :
		while ( have_rows('product__flexible_content' ) ) : the_row();
			if ( get_row_layout() == 'whats_included' ) :
				get_template_part( 'template_parts/modules/module', 'whats_included' );
			elseif ( get_row_layout() == 'whats_included_boxes' ) :
				get_template_part( 'template_parts/modules/module', 'whats_included_boxes' );
			elseif ( get_row_layout() == 'product_full_description' ) :
				get_template_part( 'template_parts/modules/module', 'product_full_description' );
			elseif ( get_row_layout() == 'video-promo' ) :
				get_template_part( 'template_parts/modules/module', 'video-promo' );
			endif;
		endwhile;
	endif;
}

/**
 * Display Product ACF On Single Product Page (FAQ Section)
 * List of modules to display on single product page
 * Add your modules with each 'elseif' condition
 * @author Marcos Vallejos
 */
add_action( 'woocommerce_after_single_product', 'baketivity_display_content_faq_section', 0);
function baketivity_display_content_faq_section() {
	if( get_field('show_faq_section') ) {
		if ( have_rows( 'faq_section' ) ) :
			while ( have_rows('faq_section' ) ) : the_row();
				if ( get_row_layout() == 'hero' ) :
					get_template_part( 'template_parts/modules/module', 'hero-faq' );				
				elseif ( get_row_layout() == 'accordion' ) :
					get_template_part( 'template_parts/modules/module', 'accordion-faq' );
				elseif ( get_row_layout() == 'contact' ) :
					get_template_part( 'template_parts/modules/module', 'contact-faq' );
				endif;
			endwhile;
		endif;	
	}
}
/**
 * Add a cta module into footer product page
 * @author Fer Catalano
 */
add_action('woocommerce_after_main_content','section_bottom',30);
function section_bottom(){
	get_template_part( 'template_parts/modules/module', 'product_page_cta' );
}

/**
 * Remove tabs from product page
 * @author Fer Catalano
 */
add_filter( 'woocommerce_product_tabs', 'my_remove_all_product_tabs', 98 );
function my_remove_all_product_tabs( $tabs ) {
  unset( $tabs['description'] ); // Remove the description tab
  //unset( $tabs['reviews'] );       // Remove the reviews tab
  unset( $tabs['additional_information'] );    // Remove the additional information tab
  unset( $tabs['test_tab'] );    // Remove the test_tab tab
  return $tabs;
}

/* And then moving review tab after main content */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_main_content', 'woocommerce_output_product_data_tabs', 10 );


