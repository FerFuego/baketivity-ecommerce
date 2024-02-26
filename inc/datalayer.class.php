<?php
/*
 * @package baketivity
 * @since baketivity
 * DataLayer class 
 */
class Datalayer
{

	public function __construct()
	{
		add_action('wp_head', [$this, 'script_tag_gtm_header']);
		add_action('wp_head', [$this, 'datalayer_scripts_hook']);
		add_action('baketivity_insert_after_open_body', [$this, 'script_tag_gtm_body']);
	}

	/**
	 *  GTM/G4A - Google Tag Manager
	 *  Head
	 */
	public function script_tag_gtm_header()
	{
		if (!is_account_page() && wp_get_environment_type() == "production") : ?>
			<!-- Google Tag Manager -->
			<script>
				(function(w, d, s, l, i) {
					w[l] = w[l] || [];
					w[l].push({
						'gtm.start': new Date().getTime(),
						event: 'gtm.js'
					});
					var f = d.getElementsByTagName(s)[0],
						j = d.createElement(s),
						dl = l != 'dataLayer' ? '&l=' + l : '';
					j.async = true;
					j.src =
						'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
					f.parentNode.insertBefore(j, f);
				})(window, document, 'script', 'dataLayer', 'GTM-KKHGKV8Z');
			</script>
			<!-- End Google Tag Manager -->
		<?php endif;

		if (!is_account_page() && wp_get_environment_type() == "staging") : ?>
			<!-- Google Tag Manager -->
			<script>
				(function(w, d, s, l, i) {
					w[l] = w[l] || [];
					w[l].push({
						'gtm.start': new Date().getTime(),
						event: 'gtm.js'
					});
					var f = d.getElementsByTagName(s)[0],
						j = d.createElement(s),
						dl = l != 'dataLayer' ? '&l=' + l : '';
					j.async = true;
					j.src =
						'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
					f.parentNode.insertBefore(j, f);
				})(window, document, 'script', 'dataLayer', 'GTM-N86W7H3B');
			</script>
			<!-- End Google Tag Manager -->
		<?php endif;
	}

	/**
	 *  GTM - Google Tag Manager
	 *  Body
	 */
	public function script_tag_gtm_body()
	{
		if (wp_get_environment_type() == "production") :  ?>
			<!-- Google Tag Manager (noscript) -->
			<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KKHGKV8Z" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<!-- End Google Tag Manager (noscript) -->
		<?php endif;

		if (wp_get_environment_type() == "staging") : ?>
			<!-- Google Tag Manager (noscript) -->
			<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N86W7H3B" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<!-- End Google Tag Manager (noscript) -->
		<?php endif;
	}


	/**
	 *  DataLayer 
	 *  Events: ( Shop Page - Product Page - Cart - Begin Checkout - Purchase )
	 */
	public function datalayer_scripts_hook()
	{
		// Product Page
		if (is_singular('product')) : ?>

			<?php $product = wc_get_product(get_the_ID()); ?>

			<script type="text/javascript">
				document.addEventListener('DOMContentLoaded', function() {

					let dataLayer = window.dataLayer || [];

					<?php
					$categories = get_the_terms($product->get_id(), 'product_cat');
					$categs 	= array_map(function ($categ) {
						return $categ->name;
					}, $categories);
					$discount = round($product->get_regular_price() - $product->get_price(), 2);
					?>

					// View Product
					dataLayer.push({
						ecommerce: null
					});
					dataLayer.push({
						event: "view_item",
						ecommerce: {
							currency: "USD",
							item_list_name: null,
							value: null,
							items: [{
								item_id: <?= '"' . $product->get_id()  . '"'; ?>,
								item_sku: <?= '"' . $product->get_sku()  . '"'; ?>,
								item_name: <?= '"' . $product->get_name()  . '"'; ?>,
								affiliation: "Baketivity",
								coupon: null,
								currency: "USD",
								discount: parseFloat(<?= $discount; ?>),
								index: 0,
								item_brand: "Baketivity",
								item_category: <?= '"' . implode(', ', $categs) . '"'; ?>,
								item_list_name: null,
								price: parseFloat(<?= $product->get_price(); ?>),
								item_variant: null,
								quantity: 1
							}]
						}
					});

					// On add to cart
					var btnAddToCart = document.querySelector(".single_add_to_cart_button");
					btnAddToCart.addEventListener("click", function(e) {

						var input = document.querySelector("input[name='quantity']");

						if (input.value > 0) {
							dataLayer.push({
								ecommerce: null
							});
							dataLayer.push({
								event: "add_to_cart",
								ecommerce: {
									currency: "USD",
									item_list_name: null,
									value: parseFloat(<?= $product->get_price(); ?>),
									items: [{
										item_id: <?= '"' . $product->get_id()  . '"'; ?>,
										item_sku: <?= '"' . $product->get_sku()  . '"'; ?>,
										item_name: <?= '"' . $product->get_name()  . '"'; ?>,
										affiliation: "Baketivity",
										coupon: null,
										currency: "USD",
										discount: parseFloat(<?= $discount; ?>),
										index: 0,
										item_brand: "Baketivity",
										item_category: <?= '"' . implode(', ', $categs) . '"'; ?>,
										item_list_name: null,
										price: parseFloat(<?= $product->get_price(); ?>),
										item_variant: null,
										quantity: parseInt(input.value)
									}]
								}
							});
						}
					});
				});
			</script>

		<?php endif;

		// Cart
		if (is_cart()) : ?>

			<?php if (!WC()->cart->is_empty()) { ?>

				<script type="text/javascript">
					document.addEventListener('DOMContentLoaded', function() {

						let dataLayer = window.dataLayer || [];
						let prod_temp = [];
						<?php $index = 0; ?>

						// view cart
						dataLayer.push({
							ecommerce: null
						});
						dataLayer.push({
							event: "view_cart",
							ecommerce: {
								items: [
									<?php foreach (WC()->cart->get_cart() as $key => $cart_item) {
										// Get product object
										$product    = wc_get_product($cart_item['product_id']);
										$categories = get_the_terms($product->get_id(), 'product_cat');
										$discount 	= round($product->get_regular_price() - $product->get_price(), 2);
										$categs 	= array_map(function ($categ) {
											return $categ->name;
										}, $categories); ?>

										<?= '{'; ?>
										item_id: <?= '"' . $product->get_id() . '"'; ?>,
										item_sku: <?= '"' . $product->get_sku() . '"'; ?>,
										item_name: <?= '"' . $product->get_name() . '"'; ?>,
										item_category: <?= '"' . implode(', ', $categs) . '"'; ?>,
										item_list_name: null,
										price: <?= $cart_item['data']->get_price(); ?>,
										quantity: <?= $cart_item['quantity']; ?>,
										index: <?= $index++; ?>,
										affiliation: "Baketivity",
										item_brand: "Baketivity",
										currency: "USD",
										coupon: null,
										discount: parseFloat(<?= $discount; ?>),
										<?= '},'; ?>

									<?php } // end foreach 
									?>
								],
								currency: "USD",
								item_list_name: null,
								coupon: <?= '"' . (!empty(WC()->cart->get_applied_coupons()) ? WC()->cart->get_applied_coupons() : null) . '"'; ?>,
								discount: <?= (!empty(WC()->cart->get_discount_total()) ? WC()->cart->get_discount_total() : 0); ?>,
								value: <?= WC()->cart->total; ?>,
								shipping: <?= WC()->cart->get_shipping_total(); ?>,
							}
						});

						// on load cart
						jQuery(document).ready(listenersQuantity());
						// on update cart
						jQuery(document).on('updated_wc_div', listenersQuantity());

						function listenersQuantity() {
							return function() {
								// get items from cart
								var itemsCart = document.querySelectorAll('.shop_table .cart_item');
								itemsCart.forEach(item => {
									if (!item.getAttribute('product_id') || !item.querySelector('.plus')) return;
									// btn add to cart
									let btnAddToCart = item.querySelector('.plus');
									btnAddToCart.addEventListener("click", function(e) {
										let input = item.querySelector("input.qty");
										let Fname = item.querySelector(".producto-name a").innerText;
										let Vtext = item.querySelector(".amount bdi").innerHTML;
										let Vamount = Vtext.replace('<span class="woocommerce-Price-currencySymbol">$</span>', '');

										if (input.value > 0) {
											dataLayer.push({
												ecommerce: null
											});
											dataLayer.push({
												event: "add_to_cart",
												ecommerce: {
													currency: "USD",
													item_list_name: null,
													value: Vamount * input.value,
													items: [{
														item_id: item.getAttribute('product_id'),
														item_sku: item.getAttribute('product_sku'),
														item_name: Fname.trim(),
														affiliation: "Baketivity",
														coupon: null,
														currency: "USD",
														discount: 0,
														index: parseInt(jQuery(item).index()),
														item_brand: "Baketivity",
														item_category: item.getAttribute('product_categs'),
														item_list_name: null,
														price: parseFloat(Vamount),
														quantity: 1
													}]
												}
											});
										}

									});
									// btn rest to cart
									let btnRemoveToCart = item.querySelector('.minus');
									btnRemoveToCart.addEventListener("click", function(e) {
										let input = item.querySelector("input.qty");
										let Fname = item.querySelector(".producto-name a").innerText;
										let Vtext = item.querySelector(".amount bdi").innerHTML;
										let Vamount = Vtext.replace('<span class="woocommerce-Price-currencySymbol">$</span>', '');

										if (input.value > 0) {
											dataLayer.push({
												ecommerce: null
											});
											dataLayer.push({
												event: "remove_from_cart",
												ecommerce: {
													currency: "USD",
													item_list_name: null,
													value: Vamount * input.value,
													items: [{
														item_id: item.getAttribute('product_id'),
														item_sku: item.getAttribute('product_sku'),
														item_name: Fname.trim(),
														affiliation: "Baketivity",
														coupon: null,
														currency: "USD",
														discount: 0,
														index: parseInt(jQuery(item).index()),
														item_brand: "Baketivity",
														item_category: item.getAttribute('product_categs'),
														item_list_name: null,
														price: parseFloat(Vamount),
														quantity: 1
													}]
												}
											});
										}
									});
									// on remove item from X
									let remove = item.querySelector('.remove');
									let Fname = item.querySelector('.producto-name a').innerText;
									let Vtext = item.querySelector(".amount bdi").innerHTML;
									let price = Vtext.replace('<span class="woocommerce-Price-currencySymbol">$</span>', '');
									let Vtotal = item.querySelector('.producto-subtotal bdi').innerText;
									let total = Vtotal.replace('<span class="woocommerce-Price-currencySymbol">$</span>', '');
									let value = item.querySelector('.qty').value;
									remove.addEventListener('click', function(e) {
										dataLayer.push({
											ecommerce: null
										});
										dataLayer.push({
											event: "remove_from_cart",
											ecommerce: {
												currency: "USD",
												item_list_name: null,
												value: parseFloat(total),
												items: [{
													item_id: item.getAttribute('product_id'),
													item_sku: item.getAttribute('product_sku'),
													item_name: Fname.trim(),
													affiliation: "Baketivity",
													coupon: null,
													currency: "USD",
													discount: 0,
													index: 0,
													item_brand: "Baketivity",
													item_category: item.getAttribute('product_categs'),
													item_list_name: null,
													price: parseFloat(price),
													quantity: parseInt(value)
												}]
											}
										});
									});
								});
							}
						}

					});
				</script>

			<?php } ?>

		<?php endif;

		// Begin Checkout
		if (is_checkout() && !is_wc_endpoint_url('order-received')) : ?>

			<?php if (!WC()->cart->is_empty()) { ?>
				<script type="text/javascript">
					document.addEventListener('DOMContentLoaded', function() {

						let dataLayer = window.dataLayer || [];
						let prod_temp = [];
						<?php $i = 0; ?>

						// view cart
						dataLayer.push({
							ecommerce: null
						}); // Clear the previous ecommerce object.
						dataLayer.push({
							event: "begin_checkout",
							ecommerce: {
								items: [
									<?php foreach (WC()->cart->get_cart() as $key => $cart_item) :
										$product    = wc_get_product($cart_item['product_id']);
										$discount 	= round($product->get_regular_price() - $product->get_price(), 2);
										$categories = get_the_terms($product->get_id(), 'product_cat');
										$categs = array_map(function ($categ) {
											return $categ->name;
										}, $categories); ?>

										<?= '{'; ?>
										item_id: <?= '"' . $product->get_id() . '"'; ?>,
										item_sku: <?= '"' . $product->get_sku() . '"'; ?>,
										item_name: <?= '"' . $product->get_name() . '"'; ?>,
										item_category: <?= '"' . implode(', ', $categs) . '"'; ?>,
										item_list_name: null,
										item_variant: null,
										price: <?= $cart_item['data']->get_price(); ?>,
										quantity: <?= $cart_item['quantity']; ?>,
										index: <?= $i++; ?>,
										affiliation: "Baketivity",
										item_brand: "Baketivity",
										currency: "USD",
										coupon: null,
										discount: parseFloat(<?= $discount; ?>),
										<?= '},'; ?>

									<?php endforeach; ?>
								],
								shipping: <?= WC()->cart->get_shipping_total(); ?>,
								currency: "USD",
								item_list_name: null,
								coupon: <?= '"' . (!empty(WC()->cart->get_applied_coupons()) ? WC()->cart->get_applied_coupons() : null) . '"'; ?>,
								discount: <?= (!empty(WC()->cart->get_discount_total()) ? WC()->cart->get_discount_total() : 0); ?>,
								value: <?= WC()->cart->total; ?>,
							}
						});

						// on load checkout
						jQuery(document).ready(listenersQuantity());
						// on update checkout
						jQuery(document).on('updated_checkout', listenersQuantity());

						function listenersQuantity() {
							return function() {
								// get items from cart
								var itemsCart = document.querySelectorAll('.cart_item');
								itemsCart.forEach(item => {
									if (!item.getAttribute('product_id') || !item.querySelector('.plus')) return;
									// btn add to cart
									let btnAddToCart = item.querySelector('.plus');
									btnAddToCart.addEventListener("click", function(e) {
										let input = item.querySelector("input.qty");
										let Fname = item.querySelector(".product-name-resume-checkout").getAttribute("data-name");
										let Vtext = item.querySelector(".amount bdi").innerHTML;
										let Vamount = Vtext.replace('<span class="woocommerce-Price-currencySymbol">$</span>', '');

										if (input.value > 0) {
											dataLayer.push({
												ecommerce: null
											});
											dataLayer.push({
												event: "add_to_cart",
												ecommerce: {
													currency: "USD",
													item_list_name: null,
													value: Vamount * input.value,
													items: [{
														item_id: item.getAttribute('product_id'),
														item_sku: item.getAttribute('product_sku'),
														item_name: Fname.trim(),
														affiliation: "Baketivity",
														coupon: null,
														currency: "USD",
														discount: null,
														index: parseInt(jQuery(item).index()),
														item_brand: "Baketivity",
														item_category: item.getAttribute('product_categs'),
														item_list_name: null,
														price: parseFloat(Vamount),
														item_variant: null,
														quantity: 1
													}]
												}
											});
										}
									});
									// btn rest to cart
									let btnRemoveToCart = item.querySelector('.minus');
									btnRemoveToCart.addEventListener("click", function(e) {
										let input = item.querySelector("input.qty");
										let Fname = item.querySelector(".product-name-resume-checkout").getAttribute("data-name");
										let Vtext = item.querySelector(".amount bdi").innerHTML;
										let Vamount = Vtext.replace('<span class="woocommerce-Price-currencySymbol">$</span>', '');

										if (input.value > 0) {
											dataLayer.push({
												ecommerce: null
											});
											dataLayer.push({
												event: "remove_from_cart",
												ecommerce: {
													currency: "USD",
													item_list_name: null,
													value: Vamount * input.value,
													items: [{
														item_id: item.getAttribute('product_id'),
														item_sku: item.getAttribute('product_sku'),
														item_name: Fname.trim(),
														affiliation: "Baketivity",
														coupon: null,
														currency: "USD",
														discount: null,
														index: parseInt(jQuery(item).index()),
														item_brand: "Baketivity",
														item_category: item.getAttribute('product_categs'),
														item_list_name: null,
														price: parseFloat(Vamount),
														item_variant: null,
														quantity: 1
													}]
												}
											});
										}
									});
									// on remove item from X
									let remove = item.querySelector('.product-remove a');
									let Fname = item.querySelector('.product-name').innerText;
									let Vtext = item.querySelector(".amount bdi").innerHTML;
									let price = Vtext.replace('<span class="woocommerce-Price-currencySymbol">$</span>', '');
									let Vtotal = item.querySelector('.amount bdi').innerText;
									let total = Vtotal.replace('<span class="woocommerce-Price-currencySymbol">$</span>', '');
									let value = item.querySelector('.qty').value;

									remove.addEventListener('click', function(e) {
										dataLayer.push({
											ecommerce: null
										});
										dataLayer.push({
											event: "remove_from_cart",
											ecommerce: {
												currency: "USD",
												item_list_name: null,
												value: parseFloat(total),
												items: [{
													item_id: item.getAttribute('product_id'),
													item_name: Fname.trim(),
													affiliation: "Baketivity",
													coupon: null,
													currency: "USD",
													discount: null,
													index: 0,
													item_brand: "Baketivity",
													item_category: item.getAttribute('product_categs'),
													item_list_name: null,
													item_variant: null,
													price: parseFloat(price),
													quantity: parseInt(value)
												}]
											}
										});
									});
								});
							}
						}
					});
				</script>
			<?php }

		endif;

		// Purchase
		if (is_checkout() && is_wc_endpoint_url('order-received')) :

			global $wp;
			$order_id = absint($wp->query_vars['order-received']); // The order ID
			$order    = wc_get_order($order_id); // The WC_Order object 
			?>
			<script type="text/javascript">
				document.addEventListener('DOMContentLoaded', function() {

					let dataLayer = window.dataLayer || [];

					dataLayer.push({
						ecommerce: null
					}); // Clear the previous ecommerce object.
					dataLayer.push({
						event: "purchase",
						ecommerce: {
							order_id: <?= '"' . $order_id . '"'; ?>,
							transaction_id: <?= '"' . $order->get_order_number() . '"'; ?>,
							currency: "USD",
							item_list_name: null,
							value: <?= $order->get_total(); ?>,
							affiliation: "Baketivity",
							coupon: <?= '"' . (!empty($order->get_coupon_codes())    ? $order->get_coupon_codes()    : null) . '"'; ?>,
							discount: <?= (!empty($order->get_discount_total())  ? $order->get_discount_total()  : 0); ?>,
							shipping: <?= $order->get_shipping_total(); ?>,
							tax: <?= $order->get_total_tax(); ?>,
							items: [
								<?php
								$i = 0;
								$oitems = $order->get_items();
								foreach ($oitems as $key => $item) :
									$product    = wc_get_product($item['product_id']);
									$discount 	= round($product->get_regular_price() - $product->get_price(), 2);
									$categories = get_the_terms($item['product_id'], 'product_cat');
									$categs = array_map(function ($categ) {
										return $categ->name;
									}, $categories); ?>

									<?= '{'; ?>
									item_id: <?= '"' . $item['product_id'] . '"'; ?>,
									item_sku: <?= '"' . $product->get_sku() . '"'; ?>,
									item_name: <?= '"' . $item->get_name() . '"'; ?>,
									item_category: <?= '"' . implode(', ', $categs) . '"'; ?>,
									item_list_name: null,
									item_variant: null,
									price: <?= $item->get_total(); ?>,
									quantity: <?= $item->get_quantity(); ?>,
									index: <?= $i++; ?>,
									affiliation: "Baketivity",
									item_brand: "Baketivity",
									currency: "USD",
									coupon: null,
									discount: parseFloat(<?= $discount; ?>),
									<?= '},'; ?>

								<?php endforeach; ?>
							]
						}
					});
				});
			</script>
<?php endif;
	}
}
