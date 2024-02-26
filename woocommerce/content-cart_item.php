<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

    <td class="product-thumbnail">
        <div class="d-thumbnails">
            <?php
            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
            printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
            ?>
        </div>
    </td>

    <td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
        <?php
        if (!$product_permalink) {
            echo wp_kses_post($product_name . '&nbsp;');
        } else {
            echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
        }

        do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

        // Meta data.
        echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

        // Backorder notification.
        if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
            echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
        }
        ?>
    </td>

    <td class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
        <?php echo get_woocommerce_currency_symbol() . $_product->get_price(); ?>
        <?php if ($_product->get_sale_price()) : ?>
            <del><?php echo get_woocommerce_currency_symbol() . $_product->get_regular_price(); ?></del>
        <?php endif; ?>
    </td>

    <td class="product-quantity" data-cart_item_key="<?php echo esc_attr($cart_item_key); ?>" data-product_id="<?php echo absint($product_id); ?>" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
        <?php
        if ($_product->is_sold_individually()) {
            $min_quantity = 1;
            $max_quantity = 1;
        } else {
            $min_quantity = 0;
            $max_quantity = $_product->get_max_purchase_quantity();
        }

        $product_quantity = woocommerce_quantity_input(
            array(
                'input_name'   => "cart[{$cart_item_key}][qty]",
                'input_value'  => $cart_item['quantity'],
                'max_value'    => $max_quantity,
                'min_value'    => $min_quantity,
                'product_name' => $product_name,
            ),
            $_product,
            false
        );

        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
        ?>
    </td>

    <td class="product-remove">
        <?php
        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            'woocommerce_cart_item_remove_link',
            sprintf(
                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',
                esc_url(wc_get_cart_remove_url($cart_item_key)),
                esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                esc_attr($product_id),
                esc_attr($_product->get_sku()),
            ),
            $cart_item_key
        );
        ?>
    </td>
</tr>