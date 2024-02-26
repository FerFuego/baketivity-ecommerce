<?php

/**
 * Return Product Categories
 * This class is also used for the search page
 */
class Shop_Baketivity
{

    // Baking subscription: '630', '845', '847', '848'
    // Cooking subscription: '294137', '300280', '300283', '300284'
    // Spoiler Box: '296118', '306189'
    // Gift Hat & Knife set: '340652', '340651'
    // Starter kit: '416413'
    // Starter kit category: 325
    private $prod_per_page = 20;
    private $exclude_products = array();
    private $exclude_categories = array();
    private $exclude_products_search = array('340652', '340651', '296118', '306189', '416413');

    public function __construct()
    {
        $this->exclude_products = explode(',', get_field('exclude_products', 'option'));
        $this->exclude_categories = explode(',', get_field('exclude_categories', 'option'));
        add_action('wp_ajax_get_baketivity_products', array($this, 'get_baketivity_products'));
        add_action('wp_ajax_nopriv_get_baketivity_products', array($this, 'get_baketivity_products'));
        //add_action('rest_api_init', array($this, 'baketivity_product_rest_api_init') );
        add_action('pre_get_posts', [$this, 'products_pre_get_posts']);
    }

    /*
    * Add custom endpoint - (not in use)
    */
    public function baketivity_product_rest_api_init()
    {
        register_rest_route('wp/v2', 'baketivity-products', [
            'methods' => WP_REST_SERVER::READABLE,
            'callback' => array($this, 'get_baketivity_products')
        ]);
    }

    /**
     * Return Categories
     */
    public function get_shop_categories()
    {
        return get_terms(array(
            'taxonomy'  => 'product_cat',
            'parent'    => 0,
            'exclude'   => $this->exclude_categories,
        ));
    }

    public static function get_child_categories($cat_slud)
    {
        // get category by slug
        $category = get_term_by('slug', $cat_slud, 'product_cat');
        if (!$category) return;

        return get_terms([
            'taxonomy'  => 'product_cat',
            'child_of'  => $category->term_id,
            'hide_empty' => false
        ]);
    }

    private function priceQuery($price_range)
    {
        if ('' !== $price_range) {
            return array(
                'relation' => 'AND',
                array(
                    'key'     => '_price',
                    'value'   => $price_range,
                    'compare' => 'BETWEEN',
                    'type'    => 'NUMERIC'
                )
            );
        }
    }

    /**
     * Filter By Metas
     */
    private function getMetaQuery($price_range)
    {
        $meta[] = array(
            'key'   => '_stock_status',
            'value' => array('onbackorder', 'outofstock', 'pre_order'),
            'compare' => 'NOT IN'
        );

        if ('' !== $price_range) {
            $meta[] = array(
                'relation' => 'AND',
                $this->priceQuery($price_range),
            );
        }

        return $meta;
    }

    private function getTaxQuery($categories, $sortBy, $age)
    {
        $categ = [];

        if ('' == $categories && '' == $age && $sortBy == 'menu_order') {
            return array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id', // Or 'name' or 'term_id'
                    'terms'    => array('15', '26', '303'),
                    'operator' => 'NOT IN', // Excluded
                )
            );
        }

        if ($age && '' !== $age && !empty($age) && 'null' !== $age) {
            array_push(
                $categ,
                array(
                    'relation' => 'AND',
                    array(
                        'taxonomy'  => 'product_cat',
                        'field'     => 'slug', // can be 'term_id', 'slug' or 'name'
                        'terms'     => $age,
                    )
                )
            );
        }

        if ('' !== $categories) {
            $c = array('relation' => 'OR');

            foreach ($categories as $category) {
                array_push(
                    $c,
                    array(
                        'taxonomy'  => 'product_cat',
                        'field'     => 'slug', // can be 'term_id', 'slug' or 'name'
                        'terms'     => $category,
                    )
                );
            }

            array_push($categ, $c);
        }

        return $categ;
    }

    private function orderQuery($sortBy)
    {
        switch ($sortBy) {
            case 'date':
                return 'DESC';
                break;
            case 'name':
                return 'ASC';
                break;
            case 'popular':
                return 'DESC';
                break;
            case 'higher_price':
                return 'DESC';
                break;
            case 'lower_price':
                return 'ASC';
                break;
            case 'menu_order':
                return 'ASC';
                break;
            default:
                return '';
                break;
        }
    }

    private function orderByQuery($sortBy)
    {
        switch ($sortBy) {
            case 'date':
                return 'post_date';
                break;
            case 'name':
                return 'post_title';
                break;
            case 'popular':
                return 'meta_value_num';
                break;
            case 'higher_price':
                return 'meta_value_num';
                break;
            case 'lower_price':
                return 'meta_value_num';
                break;
            case 'menu_order':
                return 'menu_order title';
                break;
            default:
                return '';
                break;
        }
    }

    /**
     * Processing of the request of Baketivity
     * @return html
     */
    public function get_baketivity_products($current_page = 1, $categories = [], $price_range = '', $sortBy = 'menu_order', $age = '')
    {
        if (isset($_POST['current_page'])) {
            $current_page   = ($_POST['current_page']) ? (int) sanitize_text_field($_POST['current_page']) : 1;
            $categories     = ($_POST['category'] && $_POST['category'] !== 'null') ? explode(',', sanitize_text_field($_POST['category'])) : [];
            $price_range    = ($_POST['price'] && $_POST['price'] !== 'null') ? explode('-', sanitize_text_field($_POST['price'])) : '';
            $age            = ($_POST['age'] && $_POST['age'] !== '') ? sanitize_text_field($_POST['age']) : '';
            $sortBy         = ($_POST['sortBy'] && $_POST['sortBy'] !== 'null') ? sanitize_text_field($_POST['sortBy']) : 'menu_order';
        } else {
            $current_page   = $current_page;
            $categories     = $categories;
            $price_range    = $price_range;
            $sortBy         = $sortBy;
            $age            = $age;
        }

        $query = array(
            'post_status'    => 'publish',
            'post_type'      => 'product',
            'paged'          => $current_page,
            'posts_per_page' => $this->prod_per_page,
            'post__not_in'   => $this->exclude_products,
            'tax_query'      => $this->getTaxQuery($categories, $sortBy, $age),
            'meta_query'     => $this->getMetaQuery($price_range),
            'orderby'        => $this->orderByQuery($sortBy),
            'order'          => $this->orderQuery($sortBy),
        );

        if ($sortBy == 'popular') $query['meta_key'] = 'post_views_count';
        if ($sortBy == 'higher_price') $query['meta_key'] = '_price';
        if ($sortBy == 'lower_price') $query['meta_key'] = '_price';

        $result = new WP_Query($query);

        if (!isset($_POST['current_page'])) return $result;

        ob_start();
        if ($result->have_posts()) :
            $total_products = $result->total;
            $num_pages      = $result->max_num_pages;
            //--------------------
            // Product Cards
            //--------------------
            foreach ($result->posts as $p) :
                set_query_var('product_id', $p->ID);
                if (in_array('buy-with-prime', $categories)) {
                    set_query_var('order_by', 'prime');
                }
                get_template_part('template_parts/partials/product-card');
            endforeach;
        else : ?>
            <h2 class="grid-shop__no-products">No product found for your search</h2>
<?php endif;

        $html = ob_get_contents();
        ob_end_clean();

        ob_start();
        set_query_var('current_page', $current_page);
        set_query_var('num_pages', $num_pages);
        set_query_var('total_products', $total_products);
        get_template_part('template_parts/partials/product-paginator');
        $paginator = ob_get_contents();
        ob_end_clean();

        wp_send_json_success([
            'html'      => $html,
            'paginator' => $paginator
        ]);
    }

    /*
    * Set post views count using post meta
    */
    public static function setPostViews($postID)
    {
        $countKey = 'post_views_count';
        $count = get_post_meta($postID, $countKey, true);
        if ($count == '') {
            $count = 0;
            delete_post_meta($postID, $countKey);
            add_post_meta($postID, $countKey, '0');
        } else {
            $count++;
            update_post_meta($postID, $countKey, $count);
        }
    }

    /**
     * First load products
     * @return html
     */
    public function get_products_module_shop($current_page)
    {

        $current_page   = sanitize_text_field($current_page);

        $query = new WC_Product_Query(array(
            'limit'     => $this->prod_per_page,
            'orderby'   => 'title menu_order',
            'order'     => 'ASC',
            'paginate'  => true,
            'page'      => $current_page,
            'return'    => 'ids',
            'exclude'   => $this->exclude_products,
            'status'    => 'publish',
            'stock_status' => 'instock'
        ));

        $query->set('tax_query', array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id', // Or 'name' or 'term_id'
                'terms'    => array('15', '26', '303'),
                'operator' => 'NOT IN', // Excluded
            )
        ));

        return $query->get_products();
    }

    public function get_products_search_page($current_page, $search)
    {
        global $wpdb;
        $sql_where = [];
        $current_page = sanitize_text_field($current_page);
        $search = sanitize_text_field($search);
        $tmp = explode(' ', $search);

        $sql_where[] = "$wpdb->posts.post_title LIKE '%$search%'";

        foreach ($tmp as $param) {
            if (strlen(trim($param)) < 3) continue;
            $sql_where[] = "$wpdb->posts.post_title LIKE '%$param%'";
        }

        $query = "  SELECT  $wpdb->posts.ID
                    FROM    $wpdb->posts
                    WHERE   $wpdb->posts.post_type = 'product'
                    AND    (" . implode(' AND ', $sql_where) . ")
                    AND     $wpdb->posts.post_status = 'publish'
                    AND     $wpdb->posts.ID NOT IN(" . implode(',', $this->exclude_products_search) . ")
                    GROUP BY $wpdb->posts.ID
                    ORDER BY $wpdb->posts.post_title";

        $total_query = "SELECT COUNT(1) FROM ($query) AS combined_table";
        $total = $wpdb->get_var($total_query);
        $page = isset($current_page) ? abs((int) $current_page) : 1;
        $offset = ($page * $this->prod_per_page) - $this->prod_per_page;
        $result = $wpdb->get_results($query . " LIMIT $offset, $this->prod_per_page");
        return $result;
    }

    /* 
    * Exclude products from search of Wordpress
    */
    public function products_pre_get_posts($query)
    {
        if (!is_admin() && is_search()) {
            $query->set('post__not_in', $this->exclude_products_search);
        }
    }
}
