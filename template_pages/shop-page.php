<?php

/**
 * Template Name: Shop Page
 *
 * @package Baketivity
 * @subpackage Baketivity
 * @since Baketivity
 */
?>

<?php get_header(); ?>

<main class="shop-page">

    <?php if (have_rows('shop_flexible-content')) :
        while (have_rows('shop_flexible-content')) : the_row();

            if (get_row_layout() == 'hero-shop') :
                get_template_part('template_parts/modules/module', 'hero-shop');
            endif;

            if (get_row_index() == 1) :
                /*-- MODULE: FILTERS -- */
                get_template_part('template_parts/partials/product', 'filters-shop'); ?>

                <!-- MODULE: MESSAGE -->
                <div class="hero-shop-banner__promo" style="<?= Baketivity::module_banner_promo(); ?>">
                    <div class="hero-shop-banner__message">
                        <img class="hero-shop-banner__car" src="/wp-content/themes/baketivity/images/shop/car-bake.svg" alt="icon cart">
                        <span><?php echo get_field('message_banner_promo'); ?></span>
                    </div>
                </div>

                <!-- <div class="hero-shop-banner__magazine">
                    <?php
                    //global $woocommerce;
                    //$cart_totals = floatval(preg_replace('#[^\d.]#', '', WC()->cart->total));
                    //if ($cart_totals < 100) : 
                    ?>
                        <a class="woocommerce-cart-form__free-magazine" href="<?php //echo esc_url(home_url('/shop')); 
                                                                                ?>">
                            <img class="display_desktop" src="<?php //echo get_template_directory_uri(); 
                                                                ?>/../baketivity/images/checkout/free-magazine-desktop.png" alt="free magazine desktop">
                            <img class="display_mobile" src="<?php //echo get_template_directory_uri(); 
                                                                ?>/../baketivity/images/checkout/free-magazine-mobile.png" alt="free magazine mobile">
                        </a>
                    <?php //endif; 
                    ?>
                </div> -->

    <?php
                /* -- MODULE: BUY WITH PRIME -- */
                if (get_field('title')) {
                    set_query_var('layout', 'shop');
                    get_template_part('template_parts/modules/module', 'buy-with-prime');
                }

                /* -- SHOP GRID LAYOUT -- */
                get_template_part('template_parts/modules/module', 'shop');
            endif;

            if (get_row_layout() == 'subscription') :
                /* -- MODULE: SUBSCRIPTION -- */
                get_template_part('template_parts/modules/module', 'subscription');
            endif;

        endwhile;
    endif; ?>

    <?php get_template_part('template_parts/modules/module', 'product_page_cta'); ?>

</main>

<?php get_footer(); ?>