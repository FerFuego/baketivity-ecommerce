<?php

/**
 * Popup cart template
 *
 * @author  YITH
 * @package YITH WooCommerce Added to Cart Popup
 * @version 1.0.0
 */

if (!defined('YITH_WACP')) {
	exit;
} // Exit if accessed directly

$spoiler_settings = get_field('theme_settings_spoiler_alert', 'option');
$enable = $spoiler_settings['enable'];
$product_id =  $spoiler_settings['product'];
$cart_total = WC()->cart->subtotal;
$minimum = $spoiler_settings['amount'];
$product = wc_get_product($product_id);
$product_price = $product->get_price();
?>

<div class="popup-cart-d">
	<div class="cart-d">
		<?php if (class_exists('Baketivity_Starter_Kit')) do_action('baketivity_starter_kit_action'); ?>
		<?php if (class_exists('Free_Shipping_Meter')) do_action('free_shipping_meter_action'); ?>
		<table class="cart-list">
			<tbody>
				<?php
				foreach (WC()->cart->get_cart() as $item_key => $item) :
					if ($enable == true) {
						if ($item['product_id'] ==  $product_id) {
							if ($cart_total >= $minimum) {
								$item['data']->set_price(0);
							} else {
								$item['data']->set_price($product_price);
							}
						}
					}
					$_product = apply_filters('woocommerce_cart_item_product', $item['data'], $item, $item_key);

					if ($_product && $_product->exists() && $item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $item, $item_key)) :
						$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($item) : '', $item, $item_key);
				?>
						<tr class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'single-cart-item', $item, $item_key)); ?>">

							<?php if ($thumb) : ?>
								<td class="item-thumb" style="vertical-align:top;">
									<?php
									$thumbnail = '<img src="' . wp_get_attachment_url($_product->get_image_id()) . '" alt="' . $_product->get_name() . '">';

									if (!$product_permalink) {
										echo $thumbnail; // PHPCS: XSS ok.
									} else {
										printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
									}
									?>
								</td>
							<?php endif; ?>

							<td colspan="2" class="item-info">
								<?php
								// Print the name.
								$_product_name = is_callable(array($_product, 'get_name')) ? $_product->get_name() : $_product->get_title();
								if ($_product->is_visible()) {
									$_product_name_html = '<a class="item-name" href="' . esc_url($_product->get_permalink()) . '">' . $_product_name . '</a>';
								} else {
									$_product_name_html = '<span class="item-name">' . $_product_name . '</span>';
								}
								echo apply_filters('woocommerce_cart_item_name', $_product_name_html, $item, $item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								// Meta data.
								echo yith_wacp_get_formatted_cart_item_data($item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								?>
								<div class="quick-cart__quantity">
									<!-- Show price -->
									<?php echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_subtotal',
										WC()->cart->get_product_subtotal($_product, 1),
										$item,
										$item_key
									);
									?>
									<div class="quick-cart__form quick-qty">
										<?php
										if ($_product->get_price() == 0) :
											echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $item_key, $item); // PHPCS: XSS ok.
										else : ?>
											<?php
											if ($_product->is_sold_individually()) {
												sprintf('1 <input type="hidden" name="cart[%s][qty]" class="quick-cart__input-individual" value="1" />', $item_key);
											} else { ?>
												<!-- Show minus -->
												<!-- <span class="quick-cart__minus dec qtybtn" data-id="<?php //echo $index_gift 
																											?>">-</span> -->
												<!-- Show input -->
												<?php $product_quantity = woocommerce_quantity_input(
													array(
														'input_name'   => $item_key,
														'class'		   => "quick-cart__input-grupal",
														'input_value'  => $item['quantity'],
														'max_value'    => $_product->get_max_purchase_quantity(),
														'min_value'    => '1',
														'product_name' => $_product->get_name(),
													),
													$_product,
													true
												); ?>
												<!-- Show plus -->
												<!-- <span class="quick-cart__plus inc qtybtn" data-id="<?php //echo $index_gift 
																										?>">+</span> -->
											<?php
											}
											?>

										<?php endif; ?>
									</div>
								</div>
								<div class="quick-cart__remove item-remove">
									<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove yith-wacp-remove-cart" aria-label="%s" data-item_key="%s">Remove</a>',
											esc_url(yith_wacp_get_cart_remove_url($item_key)),
											__('Remove item', 'yith-woocommerce-added-to-cart-popup'),
											$item_key
										),
										$item_key
									);
									?>
								</div>
							</td>
						</tr>
				<?php
					endif;
				endforeach;
				?>
			</tbody>
		</table>

		<script>
			jQuery(document).ready(function() {
				// quantity quickcart
				var proQty1 = jQuery('.quick-qty');
				proQty1.on('click', '.qtybtn', function() {
					var $button = jQuery(this);
					var oldValue = $button.parent().find('input').val();
					var newVal;
					if ($button.hasClass('inc')) {
						newVal = parseFloat(oldValue) + 1;
					} else {
						// Don't allow decrementing below zero
						if (oldValue > 0) {
							newVal = parseFloat(oldValue) - 1;
						} else {
							newVal = 0;
						}
					}
					var input = $button.parent().find('input');
					input.val(newVal);
					input.change();
				});

			});
		</script>
		<?php do_action('yith_wacp_add_cart_info'); ?>