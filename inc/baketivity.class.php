<?php

/**
 * Class Kernel Baketivity
 * @date 2022-10-27
 * @author Fer Catalano
 */
class Baketivity
{

    private static $instance;

    private function __construct()
    {
        $this->init();
    }

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new Baketivity();
        }

        return self::$instance;
    }

    public function init()
    {
        add_action('init', [$this, 'register_baketivity_custom_features'], 0);
        add_action('init', [$this, 'load_core_classes']);
        add_action('wp',   [$this, 'bbloomer_remove_zoom_lightbox_theme_support'], 99);
        add_action('after_setup_theme', [$this, 'baketivity_setup']);
        add_filter('upload_mimes', [$this, 'cc_mime_types']);
        add_action('admin_init',   [$this, 'rm34_jetpack_deactivate_modules']);
        add_action('wp_enqueue_scripts', [$this, 'grd_woocommerce_script_cleaner'], 99);
        //add_filter( 'woocommerce_is_purchasable', [$this, 'woocommerce_baketivity_unpurchasable'], 10, 2); DO NOT WORK PROPERLY
        add_filter('gform_validation_message', [$this, 'gwp_change_message'], 10, 2);
        add_action('storefront_bottom_post', [$this, 'relate_post'], 20);
        add_action('storefront_bottom_post', [$this, 'contact_faqs'], 30);
        add_action('get_header', [$this, 'remove_sidebar_site']);
        add_filter('body_class', [$this, 'add_my_account_body_class'], 10, 1);
        add_action('get_header', [$this, 'change_simple_product_page']);
        add_action('wp_loaded', [$this, 'module_banner_prime']);
        add_action('wp_loaded', [$this, 'module_banner_promo']);
        add_action('wp_loaded', [$this, 'conditional_function']);
        add_action('wp_loaded', [$this, 'webroom_add_multiple_products_to_cart'], 15);
        add_filter('woocommerce_add_to_cart_fragments', [$this, 'woocommerce_header_add_to_cart_fragment']);
        add_action('wp_footer', [$this, 'add_footer_scripts'], 10);
    }

    public function baketivity_setup()
    {
        add_theme_support('woocommerce');
        add_image_size('thumb-medium', 530, 9999); // Crop to 520px width, unlimited height
        add_image_size('thumb-post-size', 530, 440, true); // Crop to 520px width, unlimited height
        add_image_size('thumb-post-sidebar', 400, 400, true);
        add_image_size('thumb-cat-sidebar', 735, 425, true);
        add_image_size('variation-size', 80, 100, true);
    }


    // Register Custom Post Type, Taxonomy and Menues
    public function register_baketivity_custom_features()
    {
        // Register Custom menu
        register_nav_menus([
            'simplest-navbar' => __('Mega Navbar'),
            'mega-menu' => __('Mega Menu')
        ]);

        // Register Footer menu
        register_nav_menus([
            'footer-menu' => __('Footer Menu'),
        ]);

        $labels_camp_video = array(
            'name'                  => _x('Camp videos', 'Post Type General Name', 'text_domain'),
            'singular_name'         => _x('Camp video', 'Post Type Singular Name', 'text_domain'),
            'menu_name'             => __('Camp videos', 'text_domain'),
            'name_admin_bar'        => __('Camp videos', 'text_domain'),
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
        $args_cap_video = array(
            'label'                 => __('Camp video', 'text_domain'),
            'description'           => __('Post Type Description', 'text_domain'),
            'labels'                => $labels_camp_video,
            'supports'              => array('title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats'),
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
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type('camp_video', $args_cap_video);


        $labels_testimonial = array(
            'name'                  => _x('Testimonials', 'Post Type General Name', 'text_domain'),
            'singular_name'         => _x('Testimonial', 'Post Type Singular Name', 'text_domain'),
            'menu_name'             => __('Testimonials', 'text_domain'),
            'name_admin_bar'        => __('Testimonial', 'text_domain'),
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
        $args_testimonials = array(
            'label'                 => __('Testimonial', 'text_domain'),
            'description'           => __('Post Type Description', 'text_domain'),
            'labels'                => $labels_testimonial,
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
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type('testimonial', $args_testimonials);


        $labels_recipe = array(
            'name'              => _x('Recipes', 'taxonomy general name', 'textdomain'),
            'singular_name'     => _x('Recipe', 'taxonomy singular name', 'textdomain'),
            'search_items'      => __('Search Recipes', 'textdomain'),
            'all_items'         => __('All Recipes', 'textdomain'),
            'parent_item'       => __('Parent Recipe', 'textdomain'),
            'parent_item_colon' => __('Parent Recipe:', 'textdomain'),
            'edit_item'         => __('Edit Recipe', 'textdomain'),
            'update_item'       => __('Update Recipe', 'textdomain'),
            'add_new_item'      => __('Add New Recipe', 'textdomain'),
            'new_item_name'     => __('New Recipe Name', 'textdomain'),
            'menu_name'         => __('Recipe', 'textdomain'),
        );
        $args_recipe = array(
            'label'                 => esc_html__('Recipe', 'Baketivity'),
            'description'           => esc_html__('Recipe description', 'Baketivity'),
            'labels'                => $labels_recipe,
            'supports'              => array('title', 'editor', 'excerpt', 'revisions', 'author', 'thumbnail'),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => false,
            'has_archive'           => false,
            'exclude_from_search'   => true,
            'publicly_queryable'    => false,
            'capability_type'       => 'post',
            'query_var'             => false // disables item single view and redirects it to 404 page

        );
        register_post_type('recipe', $args_recipe);

        // Register Custom Taxonomy
        $labels = array(
            'name'                       => _x('Camp Type', 'Taxonomy General Name', 'text_domain'),
            'singular_name'              => _x('Camp Type', 'Taxonomy Singular Name', 'text_domain'),
            'menu_name'                  => __('Camp Type', 'text_domain'),
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
        register_taxonomy('taxonomy_camp_type', array('camp_video'), $args);
    }

    // Load Amazon Pixels
    public function load_core_classes()
    {
        if (class_exists('Register_Login')) new Register_Login();
        if (class_exists('BaketivityMenu')) new BaketivityMenu();
        if (class_exists('Shop_Baketivity')) new Shop_Baketivity();
        if (class_exists('Search_Baketivity')) new Search_Baketivity();
        if (class_exists('Free_Shipping_Meter')) new Free_Shipping_Meter();
        if (class_exists('Baketivity_Starter_Kit')) new Baketivity_Starter_Kit();
        if (class_exists('Shortcodes')) new Shortcodes();
        if (class_exists('Datalayer')) new Datalayer();
        if (class_exists('AmazonPixels')) new AmazonPixels();
        if (class_exists('Api_Rest')) new Api_Rest();
        if (class_exists('Checkout_Gift_Extra_Fields')) new Checkout_Gift_Extra_Fields();
        if (class_exists('Baketivity_Checkout')) new Baketivity_Checkout();
        if (class_exists('Tracking_Class')) new Tracking_Class();
        if (class_exists('Sticky_Button')) new Sticky_Button();
    }

    // Mime Types
    public function cc_mime_types($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['webp'] = 'image/webp';
        return $mimes;
    }

    //Remove Zoom and fix lightbox - Single Product
    public function bbloomer_remove_zoom_lightbox_theme_support()
    {
        remove_theme_support('wc-product-gallery-zoom');
        //remove_theme_support( 'wc-product-gallery-lightbox' );
        //remove_theme_support( 'wc-product-gallery-slider' );
    }

    //Remove Module Notes by Error from JetPack
    public function rm34_jetpack_deactivate_modules()
    {
        if (class_exists('Jetpack') && Jetpack::is_module_active('notes')) {
            Jetpack::deactivate_module('notes');
        }
    }

    // Manage WooCommerce styles and scripts.
    public function grd_woocommerce_script_cleaner()
    {

        // Remove the generator tag
        //remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
        wp_deregister_script('wc-password-strength-meter');

        // Unless we're in the store, remove all the cruft!
        if (!is_woocommerce() && !is_cart() && !is_checkout()) {
            wp_dequeue_style('woocommerce_frontend_styles');
            wp_dequeue_style('woocommerce-general');
            wp_dequeue_style('woocommerce-layout');
            wp_dequeue_style('woocommerce-smallscreen');
            wp_dequeue_style('woocommerce_fancybox_styles');
            wp_dequeue_style('woocommerce_chosen_styles');
            wp_dequeue_style('woocommerce_prettyPhoto_css');
            wp_dequeue_script('wc-add-payment-method');
            wp_dequeue_script('wc-lost-password');
            wp_dequeue_script('wc_price_slider');
            wp_dequeue_script('wc-single-product');
            //wp_dequeue_script( 'wc-add-to-cart' );
            //wp_dequeue_script( 'wc-cart-fragments' );
            wp_dequeue_script('wc-credit-card-form');
            wp_dequeue_script('wc-checkout');
            wp_dequeue_script('wc-add-to-cart-variation');
            wp_dequeue_script('wc-single-product');
            wp_dequeue_script('wc-cart');
            wp_dequeue_script('wc-chosen');
            wp_dequeue_script('woocommerce');
            wp_dequeue_script('prettyPhoto');
            wp_dequeue_script('prettyPhoto-init');
            //wp_dequeue_script( 'jquery-blockui' );
            wp_dequeue_script('jquery-placeholder');
            wp_dequeue_script('jquery-payment');
            wp_dequeue_script('fancybox');
            //wp_dequeue_script( 'jqueryui' );
            wp_dequeue_script('selectWoo');
            wp_deregister_script('selectWoo');
        }

        // Remove WooCommerce block CSS
        if (is_cart() || is_checkout()) {

            remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');
            remove_action('admin_enqueue_scripts', 'wp_common_block_scripts_and_styles');

            $wstyles = array(
                'wp-block-library',
                'wc-blocks-style',
                'wc-blocks-style-active-filters',
                'wc-blocks-style-add-to-cart-form',
                'wc-blocks-packages-style',
                'wc-blocks-style-all-products',
                'wc-blocks-style-all-reviews',
                'wc-blocks-style-attribute-filter',
                'wc-blocks-style-breadcrumbs',
                'wc-blocks-style-catalog-sorting',
                'wc-blocks-style-customer-account',
                'wc-blocks-style-featured-category',
                'wc-blocks-style-featured-product',
                'wc-blocks-style-mini-cart',
                'wc-blocks-style-price-filter',
                'wc-blocks-style-product-add-to-cart',
                'wc-blocks-style-product-button',
                'wc-blocks-style-product-categories',
                'wc-blocks-style-product-image',
                'wc-blocks-style-product-image-gallery',
                'wc-blocks-style-product-query',
                'wc-blocks-style-product-results-count',
                'wc-blocks-style-product-reviews',
                'wc-blocks-style-product-sale-badge',
                'wc-blocks-style-product-search',
                'wc-blocks-style-product-sku',
                'wc-blocks-style-product-stock-indicator',
                'wc-blocks-style-product-summary',
                'wc-blocks-style-product-title',
                'wc-blocks-style-rating-filter',
                'wc-blocks-style-reviews-by-category',
                'wc-blocks-style-reviews-by-product',
                'wc-blocks-style-product-details',
                'wc-blocks-style-single-product',
                'wc-blocks-style-stock-filter',
                'wc-blocks-style-cart',
                'wc-blocks-style-checkout',
                'wc-blocks-style-mini-cart-contents',
                'classic-theme-styles-inline',
                'wp-block-library-theme',
                'wc-block-style',
                'storefront-gutenberg-blocks',
                'prettyPhoto',
                'prettyPhoto-init',
                'fancybox'
            );

            foreach ($wstyles as $wstyle) {
                wp_deregister_style($wstyle);
                wp_dequeue_style($wstyle);
            }

            $wscripts = array(
                'wc-blocks-middleware',
                'wc-blocks-data-store'
            );

            foreach ($wscripts as $wscript) {
                wp_deregister_script($wscript);
            }
        }
    }

    // Unpurchasable products
    // DO NOT WORK PROPERLY
    public function woocommerce_baketivity_unpurchasable($purchasable, $product)
    {
        $unpurchasable = [340651, 340652]; // knife-set, chef-hat

        if (in_array($product->id, $unpurchasable)) {
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
        }

        //return (in_array($product->id, $unpurchasable) ? false : $purchasable);
        return $purchasable;
    }

    /**
     * Changing default error message Gravity Forms (GF2.5)
     */
    public function gwp_change_message($message, $form)
    {
        return '<h2 class="gform_submission_error hide_summary">
                    <span class="gform-icon">x</span>
                    Please fill out all required fields before submitting the form. 
                </h2>';
    }

    public function relate_post()
    {
        //for use in the loop, list 5 post titles related to first tag on current post
        global $post;
        $row = 0;
        $tags = wp_get_post_categories($post->ID);
        $array_color = array('#FD9A7E', '#FFD64F', '#AEAEFC', '#C0DD52');
        if ($tags) {
            echo '<div class="related-post">';
            echo '<h3 class="related-post__title">You might also like</h3>';
            echo '<div class="related-post-in col-full">';
            $args = array(
                'category__in'      => $tags,
                'post__not_in'      => array($post->ID),
                'posts_per_page'    => -1,
                'caller_get_posts'  => 1
            );
            $my_query = new WP_Query($args);
            if ($my_query->have_posts()) :
                while ($my_query->have_posts()) : $my_query->the_post();
                    $num = $row % count($array_color);
                    $color = $array_color[$num]; ?>
                    <div class="related-post__card item">
                        <div class="inner-item" style="background-color: <?php echo $color; ?>;">
                            <div class="related-post__card-title"><?php echo $this->cute_string(get_the_title(), 40); ?></div>
                            <a class="related-post__card-img" href="<?php the_permalink() ?>" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>);" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"></a>
                        </div>
                        <a class="related-post__cta" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Recipe</a>
                    </div>
        <?php
                    $row++;
                endwhile;
            endif;
            echo '</div>';
            echo '</div>';
        }
        wp_reset_query();
    }

    public function contact_faqs()
    {
        get_template_part('template_parts/modules/module', 'accordion-faq-posts');
    }

    public static function cute_string($string, $length = 100)
    {
        $string = strip_tags($string);
        if (strlen($string) > $length) {
            $stringCut = substr($string, 0, $length);
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
        }
        return $string;
    }

    public function remove_sidebar_site()
    {
        remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }

    /**
     * Add Class to body to identify login page and target CSS
     */
    public function add_my_account_body_class($classes)
    {
        if (is_page('my-account') && !is_user_logged_in()) {
            $classes[] = 'baketivity-my-account__login-page';
        }
        if (is_page('my-account') && isset($_GET['reset-link-sent'])) {
            $classes[] = 'baketivity-my-account__reset-link-sent';
        }
        if (is_page('my-account') && is_user_logged_in()) {
            $classes[] = 'baketivity-my-account__dashboard';
        }
        return $classes;
    }

    // Storefront product pages
    public function change_simple_product_page()
    {
        if (is_product()) {
            remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);
            remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
            add_action('woocommerce_after_single_product_summary', function () {
                get_template_part('template_parts/modules/module', 'subscription');
            }, 30);
        }
    }

    public static function module_banner_promo()
    {
        $display = $categ = '';
        if (isset($_GET['cat'])) :
            $categ = explode(',', sanitize_text_field($_GET['cat']));
            $display = (in_array('buy-with-prime', $categ)) ? 'display:none;' : 'display:block;';
        else :
            $display = 'display:block;';
        endif;

        return $display;
    }

    public static function module_banner_prime($layout)
    {
        $display = $categ = '';

        if ($layout == 'home') {
            return 'display:block;';
        }

        if (isset($_GET['cat'])) :
            $categ = explode(',', sanitize_text_field($_GET['cat']));
            $display = (in_array('buy-with-prime', $categ)) ? 'display:block;' : 'display:none;';
        endif;

        return $display;
    }

    public static function conditional_function($layout)
    {
        return $layout == 'shop' ? 'get_field' : 'get_sub_field';
    }

    /** 
     * Fire before the WC_Form_Handler::add_to_cart_action callback.
     */
    public function webroom_add_multiple_products_to_cart($url = false)
    {
        // Make sure WC is installed, and add-to-cart qauery arg exists, and contains at least one comma.
        if (!class_exists('WC_Form_Handler') || empty($_REQUEST['add-to-cart']) || false === strpos($_REQUEST['add-to-cart'], ',')) {
            return;
        }

        // Remove WooCommerce's hook, as it's useless (doesn't handle multiple products).
        remove_action('wp_loaded', array('WC_Form_Handler', 'add_to_cart_action'), 20);

        $product_ids = explode(',', $_REQUEST['add-to-cart']);
        $count       = count($product_ids);
        $number      = 0;

        foreach ($product_ids as $id_and_quantity) {
            // Check for quantities defined in curie notation (<product_id>:<product_quantity>)

            $id_and_quantity = explode(':', $id_and_quantity);
            $product_id = $id_and_quantity[0];

            $_REQUEST['quantity'] = !empty($id_and_quantity[1]) ? absint($id_and_quantity[1]) : 1;

            if (++$number === $count) {
                // Ok, final item, let's send it back to woocommerce's add_to_cart_action method for handling.
                $_REQUEST['add-to-cart'] = $product_id;

                return WC_Form_Handler::add_to_cart_action($url);
            }

            $product_id        = apply_filters('woocommerce_add_to_cart_product_id', absint($product_id));
            $was_added_to_cart = false;
            $adding_to_cart    = wc_get_product($product_id);

            if (!$adding_to_cart) {
                continue;
            }

            $add_to_cart_handler = apply_filters('woocommerce_add_to_cart_handler', $adding_to_cart->get_type(), $adding_to_cart);

            // Variable product handling
            if ('variable' === $add_to_cart_handler) {
                $this->woo_hack_invoke_private_method('WC_Form_Handler', 'add_to_cart_handler_variable', $product_id);

                // Grouped Products
            } elseif ('grouped' === $add_to_cart_handler) {
                $this->woo_hack_invoke_private_method('WC_Form_Handler', 'add_to_cart_handler_grouped', $product_id);

                // Custom Handler
            } elseif (has_action('woocommerce_add_to_cart_handler_' . $add_to_cart_handler)) {
                do_action('woocommerce_add_to_cart_handler_' . $add_to_cart_handler, $url);

                // Simple Products
            } else {
                $this->woo_hack_invoke_private_method('WC_Form_Handler', 'add_to_cart_handler_simple', $product_id);
            }
        }
    }

    /**
     * Invoke class private method
     *
     * @since   0.1.0
     *
     * @param   string $class_name
     * @param   string $methodName
     *
     * @return  mixed
     */
    public function woo_hack_invoke_private_method($class_name, $methodName)
    {
        if (version_compare(phpversion(), '5.3', '<')) {
            throw new Exception('PHP version does not support ReflectionClass::setAccessible()', __LINE__);
        }

        $args = func_get_args();
        unset($args[0], $args[1]);
        $reflection = new ReflectionClass($class_name);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        //$args = array_merge( array( $class_name ), $args );
        $args = array_merge(array($reflection), $args);
        return call_user_func_array(array($method, 'invoke'), $args);
    }

    /**
     * Show cart contents / total Ajax
     * Update cart count in header
     */
    public function woocommerce_header_add_to_cart_fragment($fragments)
    {
        global $woocommerce;

        ob_start(); ?>

        <span class="cart-contents-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>

        <?php
        $fragments['a.cart-customlocation'] = ob_get_clean();
        return $fragments;
    }

    public function add_footer_scripts()
    {
        if (!is_admin() && !is_cart() && !is_checkout() && !is_account_page()) :
        ?>
            <script defer type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<?php
        endif;
    }
}

add_action('after_setup_theme', array('Baketivity', 'get_instance'));
