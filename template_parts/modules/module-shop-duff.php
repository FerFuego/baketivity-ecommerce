<div class="grid-shop-duff">
    <div class="grid-shop-duff__title-container">
        <?php if (get_sub_field('title_1')) : ?>
            <h2 class="grid-shop-duff__title-1"><?php echo get_sub_field('title_1'); ?></h2>
        <?php endif; ?>
        <?php if (get_sub_field('title_2')) : ?>
            <h2 class="grid-shop-duff__title-2"><?php echo get_sub_field('title_2'); ?></h2>
        <?php endif; ?>
        <?php if (get_sub_field('title_3')) : ?>
            <h2 class="grid-shop-duff__title-3"><?php echo get_sub_field('title_3'); ?></h2>
        <?php endif; ?>
    </div>
    <div class="grid-shop-duff__container" id="js-shop-grid">
        <?php
            $prod_per_page = 6;
            $current_page = get_query_var('paged') ? (int) get_query_var('paged') : 1;

            $query = new WC_Product_Query(array(
                'limit' => $prod_per_page,
                'orderby' => 'date',
                'order' => 'DESC',
                'paginate' => true,
                'page' => $current_page,
                'return' => 'ids',
                'status' => 'publish',
                'category' => array('duff-kits'),
            ));
            $result = $query->get_products();

            if (!empty($result)):
                $total_products = $result->total;
                $num_pages = $result->max_num_pages;
                //--------------------
                // Product Cards
                //--------------------
                foreach ($result->products as $p):
                    set_query_var('product_id', $p);
                    get_template_part('template_parts/partials/product-card-duff');
                endforeach;
            else: ?>
                <h2 class="mb-5 pb-5">No product found</h2>
        <?php endif;?>
    </div>


</div>