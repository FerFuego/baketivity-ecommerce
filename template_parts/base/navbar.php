<?php
//ACF
$navLogo = get_field('c-navbar__logo', 'option');
$navLogoMobile = get_field('c-navbar__logo__mobile', 'option');

global $woocommerce;
?>

<div class="b-navbar">
    <div class="b-navbar__container">
        <!-- Navbar logo desktop -->
        <?php if ($navLogo) : ?>
            <a class="display_only_desktop" href="<?php echo esc_url(home_url()); ?>" alt="logo desktop link to home">
                <img width="215" height="33.38" src="<?php echo $navLogo['url']; ?>" alt="Logo Baketivity" class="b-navbar__logo">
            </a>
        <?php endif; ?>

        <!-- Toggler button for mobile -->
        <button class="b-navbar__toggler" aria-expanded="false" toggler-menu>
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="b-navbar__body">

            <!-- Navbar logo mobile -->
            <?php if ($navLogoMobile) : ?>
                <a href="<?php echo esc_url(home_url()); ?>" alt="logo mobile link to home">
                    <img width="112" src="<?php echo $navLogoMobile['url']; ?>" alt="Logo Mobile Baketivity" class="b-navbar__logo-mobile">
                </a>
            <?php endif; ?>

            <?php
            //Nav menu 
            wp_nav_menu(
                array(
                    'menu_id' => 'mega-menu',
                    'theme_location' => 'mega-menu', //Nav menu selector
                    'container_class' => 'menu b-navbar__menu'
                ) //Nav menu class
            );
            ?>

        </div>
        <div class="b-navbar__actions">
            <!-- Search icon -->
            <div class="b-navbar__cta-search" id="js-search-navbar">
                <img src="<?php echo home_url() ?>/wp-content/themes/baketivity/images/navbar/search-icon.svg" alt="search icon">
            </div>
            <!-- User icon -->
            <div class="b-navbar__user" id="js-user-navbar">
                <img src="<?php echo home_url() ?>/wp-content/themes/baketivity/images/navbar/user-icon.svg" class="b-navbar__user-caret" alt="user icon">
                <?php
                // User dropdown
                get_template_part('template_parts/base/user_dropdown');
                ?>
            </div>
            <!-- Cart icon -->
            <a class="b-navbar__cart" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'storefront'); ?>">
                <img src="<?php echo home_url() ?>/wp-content/themes/baketivity/images/navbar/cart-icon.svg" alt="cart icon">
                <span class="cart-contents-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            </a>
        </div>
    </div>

    <!-- Mobile -->
    <div class="mobile-navigation">
        <div class="mobile-navigation__header">
            <div></div>
            <img width="112" src="<?php echo $navLogoMobile['url']; ?>" alt="Logo Mobile Baketivity" class="b-navbar__logo-mobile">
            <span class="mobile-navigation__close">&times;</span>
        </div>
        <?php
        //Nav menu 
        wp_nav_menu(
            array(
                'menu_id' => 'mega-menu',
                'theme_location' => 'mega-menu', //Nav menu selector
                'container_class' => 'mobile-navigation__menu-mobile'
            ) //Nav menu class
        );
        ?>

        <?php
        // User mobile
        get_template_part('template_parts/base/user_mobile');
        ?>
    </div>
</div>