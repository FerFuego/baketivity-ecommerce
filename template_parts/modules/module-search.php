<?php
    $search = get_query_var( 'search' ) ? get_query_var( 'search' ) : null;
    $search_baketivity = new Search_Baketivity();
    $result = $search_baketivity->get_products_search_page($search);
?>
<div class="grid-shop">

    <?php if (is_page('search') && !empty($result)) : ?>
        <div class="grid-shop__header">
            <h2 class="grid-shop__title">Search results for: <span class="grid-shop__title--highlight"><?php echo $search; ?></span></h2>
            <div class="grid-shop__results">
                <span class="grid-shop__results--highlight"><?php echo $result['total']; ?></span> products found
            </div>
        </div>
    <?php endif; ?>

    <div class="grid-shop__container" id="js-shop-grid">
        <?php if (!empty($result) && $result['total'] > 0) :
            //--------------------
            // Product Cards
            //--------------------
            foreach ($result['products'] as $p) :
                set_query_var( 'product_id', $p );
                get_template_part( 'template_parts/partials/product-card' );
            endforeach;
        else : ?>
            <h2 class="grid-shop__no-products mb-5 pb-5">No product found for your search</h2>
        <?php endif; ?>
    </div>

</div>