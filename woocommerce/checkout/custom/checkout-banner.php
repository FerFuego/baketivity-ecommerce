<?php if (have_rows('checkout_banner')) : ?>
    <?php while (have_rows('checkout_banner')) : the_row(); ?>
        <?php $cart_totals = floatval(preg_replace('#[^\d.]#', '', WC()->cart->total)); ?>
        <?php if (get_sub_field('checkout_banner_available')  && $cart_totals < (the_sub_field('checkout_banner_top_amount') ? the_sub_field('checkout_banner_top_amount') : 100)) : ?>
            <a class="woocommerce-cart-form__free-magazine" href="<?= esc_url(home_url('/shop')); ?>">
                <?php $checkout_banner_desktop_image = get_sub_field('checkout_banner_desktop_image'); ?>
                <?php if ($checkout_banner_desktop_image) : ?>
                    <img class="display_desktop mb-3" src="<?php echo esc_url($checkout_banner_desktop_image['url']); ?>" alt="<?php echo esc_attr($checkout_banner_desktop_image['alt']); ?>">
                <?php endif; ?>
                <?php $checkout_banner_mobile = get_sub_field('checkout_banner_mobile'); ?>
                <?php if ($checkout_banner_mobile) : ?>
                    <img class="display_mobile mb-3" src="<?php echo esc_url($checkout_banner_mobile['url']); ?>" alt="<?php echo esc_attr($checkout_banner_mobile['alt']); ?>">
                <?php endif; ?>
            </a>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>