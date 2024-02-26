<?php
$product = wc_get_product($product_id);
if (!$product) return;
$product_permalink = get_permalink($product->get_id());
$thumbnail = '<img src="' . wp_get_attachment_url($product->get_image_id()) . '" alt="' . $product->get_name() . '">';
?>
<tr class="woocommerce-cart-form__cart-item cart-related-product-item">
    <td class="product-thumbnails geeks" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
        <div class="d-thumbnails">
            <?php
            if (!$product_permalink) {
                echo $thumbnail; // PHPCS: XSS ok.
            } else {
                printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
            }
            ?>
        </div>
    </td>

    <td class="producto-name geeks" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
        <?php
        if (!$product_permalink) {
            echo wp_kses_post($product->get_name() . '&nbsp;');
        } else {
            echo wp_kses_post(sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $product->get_name()));
        }
        ?>

        <!-- Display only mobile devices -->
        <?php if (wp_is_mobile()) : ?>
            <div class="producto-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
                <?php echo get_woocommerce_currency_symbol() . $product->get_price(); ?>
                <?php if ($product->get_sale_price()) : ?>
                    <del><?php echo get_woocommerce_currency_symbol() . $product->get_regular_price(); ?></del>
                <?php endif; ?>
            </div>

            <div class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                <div class="quantity-related d-flex justify-content-center align-items-center">
                    <input class="minus qtybtn" type="button" value="-">
                    <input type="number" class="qty" name="<?php echo 'quantity_' . $product->get_id(); ?>" min="1" max="100" value="1">
                    <input class="plus qtybtn" type="button" value="+">
                </div>
            </div>
            <div class="producto-agregar add-product">
                <?php echo do_shortcode('[add_to_cart id="' . $product->get_id() . '" show_price="false" style="border:none"]'); ?>
            </div>
            </div>
        <?php endif; ?>
        <!-- End Display mobile devices -->
    </td>

    <?php if (!wp_is_mobile()) : ?>
        <td class="producto-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
            <?php echo get_woocommerce_currency_symbol() . $product->get_price(); ?>
            <?php if ($product->get_sale_price()) : ?>
                <del><?php echo get_woocommerce_currency_symbol() . $product->get_regular_price(); ?></del>
            <?php endif; ?>
        </td>

        <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
            <div class="quantity-related d-flex justify-content-center align-items-center">
                <input class="minus qtybtn" type="button" value="-">
                <input type="number" class="qty" name="<?php echo 'quantity_' . $product->get_id(); ?>" min="1" max="100" value="1">
                <input class="plus qtybtn" type="button" value="+">
            </div>
        </td>
        <td class="producto-agregar add-product">
            <?php echo do_shortcode('[add_to_cart id="' . $product->get_id() . '" show_price="false" style="border:none"]'); ?>
        </td>
    <?php endif; ?>
    </td>
</tr>