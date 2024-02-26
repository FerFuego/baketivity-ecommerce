<?php

function change_wp_search_size($queryVars)
{
	if (isset($_REQUEST['s']) && !is_admin()) // Make sure it is a search page
		$queryVars['posts_per_page'] = 12; // Change 10 to the number of posts you would like to show
	return $queryVars; // Return our modified query variables
}
add_filter('request', 'change_wp_search_size'); //


// define the woocommerce_get_stock_html callback
function filter_woocommerce_get_stock_html($html, $product)
{

	$hide = get_field('hide_the_inventory_amount', $product->get_id());

	if ($hide) {
		$html = '';
	}
	// make filter magic happen here...
	return $html;
};

// add the filter
add_filter('woocommerce_get_stock_html', 'filter_woocommerce_get_stock_html', 10, 2);

add_action('wp_head', 'd_search_popup');
function d_search_popup()
{ ?>
	<div class="d-search-popup" style="display: none;">
		<div class="d-search-inner">
			<?php get_product_search_form(); ?>
		</div>
	</div>
<?php
}

// Remove by Fer Catalano
// This function is already in product html
//add_filter( 'woocommerce_sale_flash', 'misha_change_on_sale_badge', 10, 2 );
//function misha_change_on_sale_badge( $badge_html, $post ) {
//	$badge_html = '';
//	if(get_field('on_sale',$post->ID)){
//		$badge_html = '<span class="onsale test">sale</span>';
//	}
// 	return $badge_html;
//}

function d_remove_password_strength()
{
	wp_dequeue_script('wc-password-strength-meter');
}
add_action('wp_print_scripts', 'd_remove_password_strength', 10);

function custom_post_type_baking_kit_video()
{

	$labels = array(
		'name'                  => _x('Baking Kit videos', 'Post Type General Name', 'text_domain'),
		'singular_name'         => _x('Baking Kit video', 'Post Type Singular Name', 'text_domain'),
		'menu_name'             => __('Baking Kit videos', 'text_domain'),
		'name_admin_bar'        => __('Baking Kit videos', 'text_domain'),
		'archives'              => __('Item Archives', 'text_domain'),
		'attributes'            => __('Item Attributes', 'text_domain'),
		'parent_item_colon'     => __('Parent Item:', 'text_domain'),
		'all_items'             => __('All Items', 'text_domain'),
		'add_new_item'          => __('Add New Item', 'text_domain'),
		'add_new'               => __('Add New', 'text_domain'),
		'new_item'              => __('New Item', 'text_domain'),
		'edit_item'             => __('Edit Item', 'text_domain'),
		'update_item'           => __('Update Item', 'text_domain'),
		'view_item'             => __('View Item', 'text_domain'),
		'view_items'            => __('View Items', 'text_domain'),
		'search_items'          => __('Search Item', 'text_domain'),
		'not_found'             => __('Not found', 'text_domain'),
		'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
		'featured_image'        => __('Featured Image', 'text_domain'),
		'set_featured_image'    => __('Set featured image', 'text_domain'),
		'remove_featured_image' => __('Remove featured image', 'text_domain'),
		'use_featured_image'    => __('Use as featured image', 'text_domain'),
		'insert_into_item'      => __('Insert into item', 'text_domain'),
		'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
		'items_list'            => __('Items list', 'text_domain'),
		'items_list_navigation' => __('Items list navigation', 'text_domain'),
		'filter_items_list'     => __('Filter items list', 'text_domain'),
	);
	$args = array(
		'label'                 => __('Baking Kit video', 'text_domain'),
		'description'           => __('Post Type Description', 'text_domain'),
		'labels'                => $labels,
		'supports'              => array('title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'rewrite' => array('slug' => 'baking-video', 'with_front' => false),
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type('baking_kit_video', $args);
}
add_action('init', 'custom_post_type_baking_kit_video', 0);



// Register Custom Taxonomy
function custom_taxonomy_baking_kit_type()
{

	$labels = array(
		'name'                       => _x('Baking Kit Type', 'Taxonomy General Name', 'text_domain'),
		'singular_name'              => _x('Baking Kit Type', 'Taxonomy Singular Name', 'text_domain'),
		'menu_name'                  => __('Baking Kit Type', 'text_domain'),
		'all_items'                  => __('All Items', 'text_domain'),
		'parent_item'                => __('Parent Item', 'text_domain'),
		'parent_item_colon'          => __('Parent Item:', 'text_domain'),
		'new_item_name'              => __('New Item Name', 'text_domain'),
		'add_new_item'               => __('Add New Item', 'text_domain'),
		'edit_item'                  => __('Edit Item', 'text_domain'),
		'update_item'                => __('Update Item', 'text_domain'),
		'view_item'                  => __('View Item', 'text_domain'),
		'separate_items_with_commas' => __('Separate items with commas', 'text_domain'),
		'add_or_remove_items'        => __('Add or remove items', 'text_domain'),
		'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
		'popular_items'              => __('Popular Items', 'text_domain'),
		'search_items'               => __('Search Items', 'text_domain'),
		'not_found'                  => __('Not Found', 'text_domain'),
		'no_terms'                   => __('No items', 'text_domain'),
		'items_list'                 => __('Items list', 'text_domain'),
		'items_list_navigation'      => __('Items list navigation', 'text_domain'),
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
	register_taxonomy('taxonomy_baking_kit_type', array('baking_kit_video'), $args);
}
add_action('init', 'custom_taxonomy_baking_kit_type', 0);


add_filter('woocommerce_add_to_cart_fragments', 'refresh_cart_count', 50, 1);
function refresh_cart_count($fragments)
{
	ob_start();
	$cart_count = WC()->cart->cart_contents_count;
?>
	<script>
		/* Update the custom cart into new navbar */
		jQuery(document).ready(function($) {
			$('.cart-contents-count').html('<?php echo $cart_count; ?>');
		});
	</script>
	<div class="cart-count" id="d-cart-count">
		<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('Your Cart'); ?>">
			<?php _e('Your Cart'); ?>
		</a>
	</div>
	<?php
	$fragments['#d-cart-count'] = ob_get_clean();

	return $fragments;
}

add_filter('gform_plupload_settings', function ($plupload_init) {
	$plupload_init['chunk_size'] = '50mb';
	return $plupload_init;
}, 10, 3);


add_shortcode('video_camp', 'func_video_camp');

function func_video_camp($atts)
{
	extract(shortcode_atts(array(
		'type' => 'camp_video',
		'perpage' => 4
	), $atts));

	$args = array(
		'post_type' => $type,
		'posts_per_page' => $perpage,
		'order' => 'ASC'
	);
	$d_query = new  WP_Query($args);
	ob_start();

	echo '<div class="d-camp-videos">';
	while ($d_query->have_posts()) : $d_query->the_post(); ?>
		<div class="d-camp-video">
			<div class="d-video-content">
				<?php if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				<?php } ?>
			</div>
			<h3 class="dad"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="tag">
				<?php
				$dtaxonomy = 'taxonomy_camp_type';
				if ($type == 'baking_kit_video') {
					$dtaxonomy = 'taxonomy_baking_kit_type';
				}
				echo get_the_term_list(get_the_ID(), $dtaxonomy, '', ',', '');

				?>
			</div>
		</div>
	<?php
	endwhile;
	wp_reset_postdata();
	echo '</div>';
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}

// Register Custom Post Type
function custom_post_type_template()
{

	$labels = array(
		'name'                  => _x('Post Types', 'Post Type General Name', 'text_domain'),
		'singular_name'         => _x('VC template', 'Post Type Singular Name', 'text_domain'),
		'menu_name'             => __('VC template', 'text_domain'),
		'name_admin_bar'        => __('VC template', 'text_domain'),
		'archives'              => __('Item Archives', 'text_domain'),
		'attributes'            => __('Item Attributes', 'text_domain'),
		'parent_item_colon'     => __('Parent Item:', 'text_domain'),
		'all_items'             => __('All Items', 'text_domain'),
		'add_new_item'          => __('Add New Item', 'text_domain'),
		'add_new'               => __('Add New', 'text_domain'),
		'new_item'              => __('New Item', 'text_domain'),
		'edit_item'             => __('Edit Item', 'text_domain'),
		'update_item'           => __('Update Item', 'text_domain'),
		'view_item'             => __('View Item', 'text_domain'),
		'view_items'            => __('View Items', 'text_domain'),
		'search_items'          => __('Search Item', 'text_domain'),
		'not_found'             => __('Not found', 'text_domain'),
		'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
		'featured_image'        => __('Featured Image', 'text_domain'),
		'set_featured_image'    => __('Set featured image', 'text_domain'),
		'remove_featured_image' => __('Remove featured image', 'text_domain'),
		'use_featured_image'    => __('Use as featured image', 'text_domain'),
		'insert_into_item'      => __('Insert into item', 'text_domain'),
		'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
		'items_list'            => __('Items list', 'text_domain'),
		'items_list_navigation' => __('Items list navigation', 'text_domain'),
		'filter_items_list'     => __('Filter items list', 'text_domain'),
	);
	$args = array(
		'label'                 => __('VC template', 'text_domain'),
		'description'           => __('Post Type Description', 'text_domain'),
		'labels'                => $labels,
		'supports'              => array('title', 'editor'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
	);
	register_post_type('d_template_vc', $args);
}
add_action('init', 'custom_post_type_template', 0);


add_action('baketivity_before_content', 'heade_single_post_camp', 10);
function heade_single_post_camp()
{
	if (is_singular('camp_video') || is_singular('baking_kit_video')) { ?>
		<div class="post-header-banner d-banner-vd">
			<h3><?php the_title(); ?></h3>
			<div class="tag">
				<?php
				echo get_the_term_list(get_the_ID(), 'taxonomy_camp_type', '', ',', '');
				echo get_the_term_list(get_the_ID(), 'taxonomy_baking_kit_type', '', ',', '');
				?>
			</div>
		</div>
		<?php
	}
}


add_action('vc_before_init', 'your_name_integrateWithVC');
function your_name_integrateWithVC()
{

	$args = array(
		'numberposts'      => -1,
		'category'         => 0,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'd_template_vc',

	);
	$camp_video = get_posts($args);
	$list = array();
	if ($camp_video) {

		foreach ($camp_video as $camp) {
			$list[$camp->post_title] = $camp->ID;
		}
	}

	vc_map(array(
		"name" => __("Global template", "my-text-domain"),
		"base" => "d_vc_template",
		"class" => "",
		"category" => __("Content", "my-text-domain"),
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Template", "my-text-domain"),
				"param_name" => "template",
				"value" => $list,
			)
		)
	));
}


add_shortcode('d_vc_template', 'd_vc_template_func');
function d_vc_template_func($atts, $content, $tag)
{
	$atts = vc_map_get_attributes($tag, $atts);
	echo d_get_page_content($atts['template']);
}

function d_get_page_content($id)
{
	$my_query = new WP_Query(array(
		'post_type' => 'd_template_vc',
		'p' => (int) $id,
	));
	WPBMap::addAllMappedShortcodes();
	while ($my_query->have_posts()) {
		$my_query->the_post();
		if (get_the_ID() === (int) $id) {
			ob_start();
			visual_composer()->addFrontCss();
			$content = get_the_content();
			echo $content;
			$output .= ob_get_clean();
			$output = do_shortcode($output);
		}
		wp_reset_postdata();
	}

	return $output;
}

add_action('d_camp_video_bottom', 'd_bt_content', 20);
function d_bt_content()
{
	echo d_get_page_content(20726);
}

add_action('d_camp_kit_video_bottom', 'd_bt_kit_content', 20);
function d_bt_kit_content()
{
	echo d_get_page_content(85842);
}


add_filter('ultimate_front_scripts_post_content', 'd_camp_filter', 10, 2);
function d_camp_filter($post_content, $post)
{
	if ($post && $post->post_type  == 'camp_video') {
		$post_content .= '[ult_sticky_section][ult_buttons]';
	}
	return $post_content;
}


add_action('d_camp_video_bottom', 'd_camp_video_related', 10);
function d_camp_video_related()
{
	$post = 'camp_video';
	$taxonomy = 'taxonomy_camp_type';
	if (is_singular('baking_kit_video')) {
		$taxonomy = 'taxonomy_baking_kit_type';
		$post = 'baking_kit_video';
	}
	$campterms = get_the_terms(get_the_ID(), $taxonomy);

	if ($campterms) {

		$campvterms[] = 0;

		foreach ($campterms as $campterm) {

			$campvterms[] = $campterm->name;
		}
		$args = array(
			'post_type' => $post,
			'order' => 'ASC',
			'posts_per_page' => 4,
		);
		$query = new WP_Query($args);
		if ($query->have_posts()) { ?>

			<section class="product-related-camp col-full">

				<div class="d-camp-videos">

					<?php while ($query->have_posts()) : $query->the_post(); ?>

						<div class="d-camp-video">
							<div class="d-video-content">
								<?php if (has_post_thumbnail()) { ?>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail(); ?>
									</a>
								<?php } ?>
							</div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h3></a>
							<div class="tag">
								<?php echo get_the_term_list(get_the_ID(), 'taxonomy_camp_type', '', ',', ''); ?>
							</div>
						</div>

					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

				</div>

			</section>

	<?php }
	}
}


add_action('d_camp_video_bottom_content', 'd_btn_camp');
function d_btn_camp()
{ ?>
	<div class="d-camp-action">
		<?php if (get_field('intructions')) : ?>
			<a download class="btn white" href="<?php echo get_field('intructions'); ?>">PRINT INSTRUCTIONS</a>
		<?php endif; ?>
		<?php if (get_field('shopping_list')) : ?>
			<a download class="btn red" href="<?php echo get_field('shopping_list'); ?>">PRINT SHOPPING LIST</a>
		<?php endif; ?>
	</div>
<?php
}


add_filter('wpdiscuz_mu_allowed_posttypes', 'd_add_video_camp', 10, 1);
function d_add_video_camp($args)
{
	$args =  ["post", "page", "attachment", "camp_video"];
	return $args;
}

// Normal Subscription
function getFreeProductId()
{
	//return 12326; // OLD
	return 340652;
}
// Cooking Subscription
function getFreeCookingProductId()
{
	//return 299875; // OLD
	return 340651;
}
// Cooking Subscription
function getCookingSubscriptionIds()
{
	return [294137, 300280, 300283, 300284];
}

// Normal Subscription
function processCartSubscriptionFreeProduct($freeProductId, $keysToRemove, $subscriptionQty, $actionProductId, $cart)
{
	if ($actionProductId) {
		$actionProduct = wc_get_product($actionProductId);
		if (!$actionProduct) return false;

		if ($actionProduct->get_type() != 'subscription') {
			return false;
		}
	}

	if (!empty($keysToRemove)) {
		foreach ($keysToRemove as $keyToRemove) {
			$cart->remove_cart_item($keyToRemove);
		}
	}

	if (!empty($subscriptionQty)) {
		$cart->add_to_cart($freeProductId, $subscriptionQty, '', [], ['price' => 'yes']);

		foreach ($cart->get_cart() as $key => $item) {
			if ($item['product_id'] == $freeProductId) {
				$item['data']->set_price(0);

				if (!empty($item['data']->awdr_product_original_price)) {
					$item['data']->awdr_product_original_price = 0;
				}

				break;
			}
		}
	}

	return true;
}
// Normal Subscription
function handleCartSubscriptionFreeProduct($actionProductId = null, $cart = null)
{
	$freeProductId = getFreeProductId();
	$keysToRemove = [];
	$subscriptionQty = 0;

	if (!$cart) {
		$cart = WC()->cart;
	}

	foreach ($cart->get_cart() as $key => $item) {

		if ($item['data']->get_type() == 'subscription' && !empty($item['quantity']) && !in_array($item['data']->get_ID(), getCookingSubscriptionIds())) {
			$subscriptionQty += (int) $item['quantity'];
			continue;
		}

		if ($item['product_id'] == $freeProductId) {
			$keysToRemove[] = $key;
		}
	}

	processCartSubscriptionFreeProduct($freeProductId, $keysToRemove, $subscriptionQty, $actionProductId, $cart);
}

// Cooking Subscription
function processCartSubscriptionCookingFreeProduct($freeProductId, $keysToRemove, $subscriptionQty, $actionProductId, $cart)
{
	if ($actionProductId) {
		$actionProduct = wc_get_product($actionProductId);
		if (!$actionProduct) return false;

		if ($actionProduct->get_type() != 'subscription') {
			return false;
		}
	}

	if (!empty($keysToRemove)) {
		foreach ($keysToRemove as $keyToRemove) {
			$cart->remove_cart_item($keyToRemove);
		}
	}

	if (!empty($subscriptionQty)) {
		$cart->add_to_cart($freeProductId, $subscriptionQty, '', [], ['price' => 'yes']);

		foreach ($cart->get_cart() as $key => $item) {
			if ($item['product_id'] == $freeProductId) {
				$item['data']->set_price(0);

				if (!empty($item['data']->awdr_product_original_price)) {
					$item['data']->awdr_product_original_price = 0;
				}

				break;
			}
		}
	}

	return true;
}
// Cooking Subscription
function handleCartSubscriptionCookingFreeProduct($actionProductId = null, $cart = null)
{
	$freeProductId = getFreeCookingProductId();
	$keysToRemove = [];
	$subscriptionQty = 0;

	if (!$cart) {
		$cart = WC()->cart;
	}

	foreach ($cart->get_cart() as $key => $item) {
		if (in_array($item['data']->get_ID(), getCookingSubscriptionIds()) && !empty($item['quantity'])) {
			$subscriptionQty += (int) $item['quantity'];
			continue;
		}

		if ($item['product_id'] == $freeProductId) {
			$keysToRemove[] = $key;
		}
	}

	processCartSubscriptionCookingFreeProduct($freeProductId, $keysToRemove, $subscriptionQty, $actionProductId, $cart);
}

// Normal Subscription
// Cooking Subscription
function updatedCartItemQuantityHandler($cart)
{
	handleCartSubscriptionFreeProduct();
	handleCartSubscriptionCookingFreeProduct();
}
add_action('woocommerce_after_cart_item_quantity_update', 'updatedCartItemQuantityHandler', 99, 1);

// Normal Subscription
// Cooking Subscription
function removedCartItemHandler($cartItemKey, $cart)
{
	$lineItem = $cart->removed_cart_contents[$cartItemKey];
	$productId = (!empty($lineItem) && !empty($lineItem['product_id'])) ? $lineItem['product_id'] : null;
	handleCartSubscriptionFreeProduct($productId, $cart);
	handleCartSubscriptionCookingFreeProduct($productId, $cart);
}
add_action('woocommerce_cart_item_removed', 'removedCartItemHandler', 99, 2);

// Normal Subscription
function checkCartSubscriptionFreeProduct($cart)
{
	$freeProductId = getFreeProductId();
	$subscriptionQty = 0;

	foreach ($cart->get_cart() as $key => $item) {
		if ($item['data']->get_type() == 'subscription' && !empty($item['quantity']) && !in_array($item['data']->get_ID(), getCookingSubscriptionIds())) {
			$subscriptionQty += (int) $item['quantity'];
		}
	}

	foreach ($cart->get_cart() as $key => $item) {
		if ($item['product_id'] == $freeProductId && $item['quantity'] == $subscriptionQty) {
			$item['data']->set_price(0);

			if (!empty($item['data']->awdr_product_original_price)) {
				$item['data']->awdr_product_original_price = 0;
			}

			return true;
		}
	}

	return false;
}
add_action('woocommerce_before_calculate_totals', 'checkCartSubscriptionFreeProduct', 10, 1);

// Cooking Subscription
function checkCartSubscriptionFreeCookingProduct($cart)
{
	$freeProductId = getFreeCookingProductId();
	$subscriptionQty = 0;

	foreach ($cart->get_cart() as $key => $item) {
		if (in_array($item['data']->get_ID(), getCookingSubscriptionIds()) && !empty($item['quantity'])) {
			$subscriptionQty += (int) $item['quantity'];
		}
	}

	foreach ($cart->get_cart() as $key => $item) {
		if ($item['product_id'] == $freeProductId && $item['quantity'] == $subscriptionQty) {
			$item['data']->set_price(0);

			if (!empty($item['data']->awdr_product_original_price)) {
				$item['data']->awdr_product_original_price = 0;
			}
			return true;
		}
	}

	return false;
}
add_action('woocommerce_before_calculate_totals', 'checkCartSubscriptionFreeCookingProduct', 10, 1);

// Normal Subscription
// Cooking Subscription
function action_woocommerce_ajax_added_to_cart($productId)
{
	if (in_array($productId, getCookingSubscriptionIds())) {
		handleCartSubscriptionCookingFreeProduct($productId);
	} else {
		handleCartSubscriptionFreeProduct($productId);
	}
	WC()->cart->calculate_totals();
}
add_action('woocommerce_ajax_added_to_cart', 'action_woocommerce_ajax_added_to_cart', 10, 1);

// Normal Subscription
// Cooking Subscription
add_action('advanced_woo_discount_rules_discounted_price_of_cart_item', function ($price, $cart_item, $cart_object, $calculated_cart_item_discount) {
	$freeProductId = getFreeProductId();
	$freeCookingProductId = getFreeCookingProductId();

	if (checkCartSubscriptionFreeProduct(WC()->cart) && $cart_item['product_id'] == $freeProductId) {
		$price = 0;
	}

	if (checkCartSubscriptionFreeCookingProduct(WC()->cart) && $cart_item['product_id'] == $freeCookingProductId) {
		$price = 0;
	}

	return $price;
}, 99, 4);

// Normal Subscription
// Cooking Subscription
function d_add_product_to_cart_automatically()
{
	$freeProductId = getFreeProductId();
	$freeCookingProductId = getFreeCookingProductId();
	handleCartSubscriptionFreeProduct($freeProductId);
	handleCartSubscriptionCookingFreeProduct($freeCookingProductId);
	WC()->cart->calculate_totals();
}
add_action('template_redirect', 'd_add_product_to_cart_automatically');

// Normal Subscription
// Cooking Subscription
add_filter('woocommerce_cart_item_quantity', 'wc_cart_item_quantity', 10, 3);
function wc_cart_item_quantity($product_quantity, $cart_item_key, $cart_item)
{
	if ((is_checkout() || is_cart()) && $cart_item['data']->get_price() == 0) {
		$product_quantity = sprintf('%2$s <input type="hidden" name="cart[%1$s][qty]" value="%2$s" />', $cart_item_key, $cart_item['quantity']);
	}
	return $product_quantity;
}

add_action('woocommerce_update_cart_action_cart_updated', 'on_action_cart_updated', 20, 1);

function on_action_cart_updated($cart_updated)
{
	WC()->cart->calculate_totals();
}

add_action('init', 'remove_cptc');
function remove_cptc()
{
	remove_action('comment_form_after_fields', 'gglcptch_commentform_display');
	remove_action('comment_form_logged_in_after', 'gglcptch_commentform_display');
	remove_action('pre_comment_on_post', 'gglcptch_commentform_check');
}

add_action('pre_comment_on_post', 'gglcptch_commentform_check_cs', 999);


function add_capt_to_comment_form($args)
{
	$args['submit_button'] = '<div class="d-cpt">' . gglcptch_display() . '</div><input name="%1$s" type="submit" id="%2$s" class="%3$s dafds" value="%4$s" />';
	return $args;
}

// add_action('pre_comment_on_post','gglcptch_commentform_check_cs');
// function gglcptch_commentform_check_cs($comment_post_id){
// 	echo 'test';
// }
// function gglcptch_commentform_check_cs() {
// 		$gglcptch_check = gglcptch_check( 'comments_form' );
// 		var_dump($gglcptch_check);
// 		if ( ! $gglcptch_check['response'] && is_singular('post') ) {
// 			$message = gglcptch_get_message($gglcptch_check['reason']) . "<br />";
// 			$error_message = sprintf(
// 				'<strong>%s</strong>:&nbsp;%s&nbsp;%s',
// 				__( 'Error', 'google-captcha' ),
// 				$message,
// 				__( 'Click the BACK button on your browser and try again 12.', 'google-captcha' )
// 			);
// 			wp_die( $error_message );
// 		}
// 		return;
// 	}

function create_cat_from_submission($entry, $form)
{
	//First need to create the post in its basic form
	// $bday = new DateTime($entry[10]); // Your date of birth
	// $today = new Datetime(date('m.d.y'));
	// $diff = $today->diff($bday);
	//printf(' Your age : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
	//printf("\n");
	$name = $entry[8] . ' ' . $entry[9];
	$new_cat = array(
		'post_title' => $entry[11],
		'post_status' => 'publish',
		'post_type' => 'recipe'
	);
	//From creating it, we now have its ID
	$ID = wp_insert_post($new_cat);
	$video = explode('"', $entry[2]);
	update_post_meta($ID, 'parentlegal_guardian_first_name', $entry[3]);
	update_post_meta($ID, 'parentlegal_last_name', $entry[4]);
	update_post_meta($ID, 'street_address', $entry['1.1']);
	update_post_meta($ID, 'apt_suite', $entry['1.2']);
	update_post_meta($ID, 'country', $entry['1.6']);
	update_post_meta($ID, 'state', $entry['1.4']);
	update_post_meta($ID, 'town__city', $entry['1.3']);
	update_post_meta($ID, 'zip', $entry['1.5']);
	update_post_meta($ID, 'phone', $entry[5]);
	update_post_meta($ID, 'email_address', $entry[6]);
	update_post_meta($ID, 'child_first_name', $entry[8]);
	update_post_meta($ID, 'child_last_name', $entry[9]);
	update_post_meta($ID, 'child_birthday', $entry[10]);
	update_post_meta($ID, 'how_did_you_hear_about_this', $entry[13]);
	update_post_meta($ID, 'are_you_a_baketivity_subscriber', $entry[14]);
}

add_filter('gettext', 'g_change_upload_field_names', 20, 3);
/**
 * Change comment form default field names.
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function g_change_upload_field_names($translated_text, $text, $domain)
{
	switch ($translated_text) {
		case 'Drop files here or':
			$translated_text = __('Drag & Drop your video here', 'baketivity');
			break;

		case 'Select files':
			$translated_text = __('Browse Files', 'baketivity');
			break;
	}
	return $translated_text;
}


function rd_duplicate_post_as_draft()
{
	global $wpdb;
	if (!(isset($_GET['post']) || isset($_POST['post'])  || (isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action']))) {
		wp_die('No post to duplicate has been supplied!');
	}

	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	/*
	 * and all the original post data then
	 */
	$post = get_post($post_id);

	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;

	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset($post) && $post != null) {

		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);

		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post($args);

		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy);
			for ($i = 0; $i < count($post_terms); $i++) {
				wp_set_object_terms($new_post_id, $post_terms[$i]->slug, $taxonomy, true);
			}
		}

		/*
		 * duplicate all post meta
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos) != 0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query .= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}


		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action('admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft');

/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link($actions, $post)
{
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}

add_filter('post_row_actions', 'rd_duplicate_post_link', 10, 2);


if (!function_exists('pagination')) :
	function pagination($paged = '', $max_page = '', $year)
	{
		$big = 999999999; // need an unlikely integer
		if (!$paged)
			$paged = get_query_var('paged');
		if (!$max_page)
			$max_page = $wp_query->max_num_pages;

		if ($max_page > 1) {
			echo '<div class="page-cs">';

			echo paginate_links(array(
				'base'       => home_url('/bake-away-vote/') . '%_%',
				'format'     => '?paged=%#%',
				'add_args'   => ['year' => $year],
				'current'    => max(1, $paged),
				'total'      => $max_page,
				'mid_size'   => 1,
				'end_size' => 1,
				'prev_text' => '<i class="fas fa-chevron-left"></i>',
				'next_text' => '<i class="fas fa-chevron-right"></i>',
				'prev_next'    => true,
				'type'       => 'list'
			));
			echo '</div></div>';
		}
	}
endif;


// Recent Approval search
add_action('wp_ajax_recipe_data_fetch', 'recipe_data_fetch');
add_action('wp_ajax_nopriv_recipe_data_fetch', 'recipe_data_fetch');
function recipe_data_fetch()
{
	$paged = 1;
	if (isset($_POST['paged']) && !empty($_POST['paged'])) {
		$paged = $_POST['paged'];
	}

	if (isset($_POST['yera']) && !empty($_POST['year'])) {
		$year = $_POST['year'];
	} else {
		$year = date('Y');
	}
	ob_start();
	$results = array();

	$args = array(
		'posts_per_page' => 12,
		'paged' => $paged,
		'post_status' =>  array('publish'),
		'post_type' => 'recipe',
		'date_query' => array(
			array(
				'year' => $year
			),
		)
	);

	$the_query = new WP_Query($args);
	/* --- Necessary since Visual Compoer V 4.9 --- */
	//WPBMap::addAllMappedShortcodes();
	if ($the_query->have_posts()) :
		$results['response'] = true;
		echo '<div class="d-recipes">';
		while ($the_query->have_posts()) : $the_query->the_post();
			get_template_part('template_parts/content', 'recipe');
		endwhile;
		echo pagination($paged, $the_query->max_num_pages, $year);
	else :

		$results['response'] = false;
	endif;
	$output_string = ob_get_contents();
	ob_end_clean();
	$results['content'] = $output_string;
	$results['debug'] = $args;
	wp_reset_postdata();

	die(json_encode($results));
}



add_action('wp_head', 'admin_ajax_url');
function admin_ajax_url()
{
?>
	<script type="text/javascript">
		var d_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

		var getUrlParameter = function getUrlParameter(url, sParam) {
			var sPageURL = url,
				sURLVariables = sPageURL.split('?'),
				sParameterName,
				i;

			for (i = 0; i < sURLVariables.length; i++) {
				sParameterName = sURLVariables[i].split('=');

				if (sParameterName[0] === sParam) {
					return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
				}
			}
		};
		jQuery(document).ready(function() {

			jQuery(document).on('click', '.page-cs a', function(e) {
				// Commented function to use php pagination by Fer Catalano
				// Pagination ajax not found

				//e.preventDefault();
				//var url = jQuery(this).attr('href');
				//ajax_recent(url);

			})

			function ajax_recent(url) {
				var paged = 1;
				var content = jQuery('.d-section-rp');
				paged = getUrlParameter(url, 'paged');
				jQuery.ajax({
					url: d_ajaxurl,
					type: 'post',
					data: {
						action: 'recipe_data_fetch',
						paged: paged,
					},
					beforeSend: function() {
						jQuery(content).addClass('loading');
					},
					success: function(data) {
						var json = jQuery.parseJSON(data);
						console.log(json['debug']);
						if (json['response'] == true) {
							jQuery(content).html(json['content']);

						}
						jQuery(content).removeClass('loading');
						jQuery('html, body').animate({
							scrollTop: jQuery(content).offset().top - 190
						}, 500);
						jQuery(window).trigger('resize');

						jQuery('.d-video video').bind('stop pause', function() {
							jQuery(this).parent().removeClass('active');
						});
						if (typeof addthis !== 'undefined') {
							addthis.layers.refresh();
						}
					}
				});

			}
		})
	</script>

	<?php
}


add_action('admin_head', 'wpse_59652_list_terms_exclusions');
function wpse_59652_list_terms_exclusions()
{
	global $current_screen;
	if ('recipe' == $current_screen->post_type) : ?>
		<style type="text/css">
			#postexcerpt {
				display: none;
			}
		</style>
	<?php endif;
	// Do your stuff
}

// Add message to cart
function baketivity_coupon_message_below_checkout_button()
{
	echo '<p class="text-danger"><small>Coupons cannot be combined with the free book promotion. To use a coupon code, please remove the free book from your cart.</small></p>';
}

add_action('woocommerce_after_add_to_cart_button', 'add_prime_buy_button');
function add_prime_buy_button()
{
	$product = wc_get_product();
	echo '<!-- Beginning of Buy With Prime Widget -->' ?>
	<div style="display:block; margin:20px 0; position:relative;">
		<script async fetchpriority='high' src='https://code.buywithprime.amazon.com/bwp.js'></script>
		<div id="amzn-buy-now" data-site-id="fa9sxfb5f7" data-widget-id="w-2X6XTKFNzr4nnBeb6DLsC3" data-sku="<?php echo $product->get_sku(); ?>"></div>
	</div>
<?php echo '<!-- End of Buy With Prime Widget -->';
}
