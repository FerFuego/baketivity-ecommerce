<?php

class Search_Baketivity
{

    private $prod_per_page = 20;
    private $exclude_products = array();
    private $exclude_categories = array();
    private $exclude_products_search = array('340652', '340651', '296118', '306189', '416413');

    public function __construct()
    {
        $this->exclude_products = explode(',', get_field('exclude_products', 'option'));
        $this->exclude_categories = explode(',', get_field('exclude_categories', 'option'));
        add_action('wp_ajax_search_baketivity_filters', array($this, 'search_baketivity_filters'));
        add_action('wp_ajax_nopriv_search_baketivity_filters', array($this, 'search_baketivity_filters'));
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

    public function get_products_search_page($search)
    {
        global $wpdb;

        add_action('pre_get_posts', [$this, 'products_pre_get_posts']);

        $sql_where_0 = '';
        $sql_where_1 = [];
        $search = sanitize_text_field($search);
        $tmp = explode(' ', $search);

        $sql_where_0 = "$wpdb->posts.post_title LIKE '%$search%'";

        foreach ($tmp as $param) {
            if (strlen(trim($param)) < 3) continue;
            $sql_where_1[] = "$wpdb->posts.post_title LIKE '%$param%'";
        }

        $query = "  SELECT  $wpdb->posts.ID
                    FROM    $wpdb->posts, $wpdb->postmeta
                    WHERE   $wpdb->posts.post_type = 'product'
                    AND     $wpdb->posts.post_status = 'publish'
                    AND     $wpdb->posts.ID NOT IN(" . implode(',', $this->exclude_products_search) . ")
                    AND     $wpdb->postmeta.post_id = $wpdb->posts.ID
                    AND     $wpdb->postmeta.meta_key = '_stock_status'
                    AND     $wpdb->postmeta.meta_value NOT IN('onbackorder', 'outofstock', 'pre_order')
                    AND     ((" . implode(' AND ', $sql_where_1) . ") OR (" . $sql_where_0 . "))
                    GROUP BY $wpdb->posts.ID
                    ORDER BY $wpdb->posts.post_title
                    LIMIT 0, 999";

        $total_query = "SELECT COUNT(1) FROM ($query) AS combined_table";
        $total = $wpdb->get_var($total_query);
        //$page   = isset( $current_page ) ? abs( (int) $current_page) : 1;
        //$offset = ( $page * $this->prod_per_page ) - $this->prod_per_page;
        //$result = $wpdb->get_results( $query . " LIMIT $offset, $this->prod_per_page" );
        $result = $wpdb->get_results($query, ARRAY_A);

        $products = array_column($result, 'ID');

        $resume = [
            'products' => $products,
            'total'    => $total
        ];

        return $resume;
    }

    /**
     * Return Categories
     */
    public function get_shop_categories($search)
    {
        return get_terms(array(
            'taxonomy'  => 'product_cat',
            'exclude'   => $this->exclude_categories,
        ));
    }

    /**
     * Return Count Categories
     */
    public function get_all_count_categories($search)
    {

        $query = new WC_Product_Query(array(
            's'         => $search,
            'exclude'   => $this->exclude_products_search,
            'include'   => $this->get_products_search_page($search)['products'],
            'status'    => 'publish',
            'stock_status' => 'instock',
            'orderby'   => 'title',
            'order'     => 'ASC',
            'return'    => 'ids',
            'limit'     => -1,
        ));

        $result = $query->get_products();
        $categories = array();

        if (!empty($result)) {
            foreach ($result as $p) {
                $product = wc_get_product($p);
                if (!$product || $product->get_category_ids() == null) continue;
                foreach ($product->get_category_ids() as $key => $categ) {
                    $c = get_term_by('id', $categ, 'product_cat')->slug;
                    if (array_key_exists($c, $categories)) {
                        $categories[$c]++;
                    } else {
                        $categories[$c] = 1;
                    }
                }
            }
        }

        return $categories;
    }

    private function getMetaQuery($price_range)
    {
        $meta[] = array(
            'relation' => 'AND',
            array(
                'key' => '_stock_status',
                'value' => 'instock'
            )
        );

        if ('' !== $price_range) {
            $meta[] = array(
                'relation' => 'AND',
                array(
                    'key'     => '_price',
                    'value'   => $price_range,
                    'compare' => 'BETWEEN',
                    'type'    => 'NUMERIC'
                )
            );
        }

        return $meta;
    }

    private function getTaxQuery($categories, $sortBy)
    {
        if ('' == $categories && $sortBy == 'menu_order') {
            return array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id', // Or 'name' or 'term_id'
                    'terms'    => array('15', '26', '303'),
                    'operator' => 'NOT IN', // Excluded
                )
            );
        }

        if ('' !== $categories) {
            $categ = array('relation' => 'OR');
            foreach ($categories as $category) {
                array_push(
                    $categ,
                    array(
                        'taxonomy'  => 'product_cat',
                        'field'     => 'slug', // can be 'term_id', 'slug' or 'name'
                        'terms'     => $category,
                    )
                );
            }
            return $categ;
        }
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
     * Return product filtered
     * * @return html
     */
    public function search_baketivity_filters()
    {
        $categories     = ($_POST['category'] && $_POST['category'] !== '') ? explode(',', sanitize_text_field($_POST['category'])) : '';
        $price_range    = ($_POST['price'] && $_POST['price'] !== 'null') ? explode('-', sanitize_text_field($_POST['price'])) : '';
        $sortBy         = ($_POST['sortBy'] && $_POST['sortBy'] !== 'null') ? sanitize_text_field($_POST['sortBy']) : 'menu_order';
        $search         = ($_POST['search']) ? sanitize_text_field($_POST['search']) : null;

        // Insertar los ID's en la query
        $query = array(
            'post_status'    => 'publish',
            'post_type'      => 'product',
            'post__not_in'   => $this->exclude_products,
            'post__in'       => $this->get_products_search_page($search)['products'],
            'tax_query'      => $this->getTaxQuery($categories, $sortBy),
            'meta_query'     => $this->getMetaQuery($price_range),
            'orderby'        => $this->orderByQuery($sortBy),
            'order'          => $this->orderQuery($sortBy),
            'posts_per_page' => 9999
        );

        if ($sortBy == 'popular') $query['meta_key'] = 'post_views_count';
        if ($sortBy == 'higher_price') $query['meta_key'] = '_price';
        if ($sortBy == 'lower_price') $query['meta_key'] = '_price';

        ob_start();

        $result = new WP_Query($query);

        if ($result->have_posts()) :
            while ($result->have_posts()) : $result->the_post();
                set_query_var('product_id', get_the_ID());
                get_template_part('template_parts/partials/product-card');
            endwhile;
        else : ?>
            <h2 class="grid-shop__no-products">No product found for your search</h2>
<?php endif;
        $html = ob_get_contents();
        ob_end_clean();

        wp_send_json_success([
            'html' => $html
        ]);
    }
}
