<?php
    $current_page = get_query_var('paged') ? (int) get_query_var('paged') : 1;
    $price_range  = isset($_GET['price'])  ? sanitize_text_field($_GET['price']) : '';
    $sortBy       = isset($_GET['sort'])   ? sanitize_text_field($_GET['sort'])  : 'menu_order';
    $category     = isset($_GET['cat'])    ? explode(',', sanitize_text_field($_GET['cat']))   : '';
    $shop   = new Shop_Baketivity();
    $result = $shop->get_baketivity_products($current_page, $category, $price_range, $sortBy);
?>
<div class="grid-shop">
    <div class="grid-shop__container" id="js-shop-grid">
        <?php if ($result->have_posts()) :
            $total_products = $result->total;
            $num_pages      = $result->max_num_pages;
            //--------------------
            // Product Cards
            //--------------------
            foreach ($result->posts as $p) :
                set_query_var( 'product_id', $p );
                get_template_part( 'template_parts/partials/product-card' );
            endforeach;
        else : ?>
            <h2 class="grid-shop__no-products mb-5 pb-5">No product found for your search</h2>
        <?php endif; ?>
    </div>

    <!---------------------
    // Paginator
    //-------------------->
    <div id="js-shop-paginator">
        <?php 
            set_query_var( 'current_page', $current_page );
            set_query_var( 'num_pages', $num_pages );
            set_query_var( 'total_products', $total_products );
            get_template_part( 'template_parts/partials/product-paginator' ); 
        ?>
    </div>
</div>