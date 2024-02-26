<?php

/**
 * Description: Add the option to free shipping order in WooCommerce
 * Author: Fer Catalano
 */
class Free_Shipping_Meter
{

	private $free_shipping 	= 99999;
	private $activate 		= false;
	private $starter_kit 	= false;
	private $has_free_shipping = false;
	private $discount_DOM = 'wdr_free_shipping';

	public function __construct()
	{
		$this->free_shipping = get_field('cost', 'option');
		$this->starter_kit 	 = get_field('starter_kit', 'option');
		$this->activate		 = get_field('activate_free_shipping_meter', 'option');
		// Check if Free Shipping is active
		if (!$this->activate) return;
		// Check if admin
		if (is_admin()) return;
		// Check if edit page
		$screen = get_current_screen();
		if (!is_null($screen) && $screen->parent_base == 'edit') {
			return;
		}
		// Disable cache shipping
		add_action('after_setup_theme', function () {
			WC_Cache_Helper::get_transient_version('shipping', true);
		});
		// check if cart has starter kit
		add_action('wp_loaded', function () {
			// Check if admin
			if (is_admin()) return;
			// check if cart is empty
			try {
				$cart = WC()->cart;
				// Get cart content
				$cart = @WC()->cart->get_cart();
				// check if cart has starter kit
				$product_ids = array_column($cart, 'product_id');

				if ($this->starter_kit && in_array($this->starter_kit, $product_ids)) {
					// Starter Kit is IN Cart
					return;
				} else {
					// Starter Kit is not in Cart
					add_action('free_shipping_meter_action', [$this, 'free_shipping_meter_html']); // quickcart
					add_action('woocommerce_before_cart_totals', [$this, 'free_shipping_meter_html'], 10); // cart
					add_filter('woocommerce_package_rates', [$this, 'apply_custom_free_shipping_rule'], 99999999999, 2);
				}
			} catch (\Throwable $th) {
				//throw $th;
			}
		});
	}

	// Add custom rule to provide free shipping for orders over a certain amount
	public function apply_custom_free_shipping_rule($rates, $package)
	{
		// check if cart has a DOM discount
		$rates_id = array_column($rates, 'method_id');
		if (in_array($this->discount_DOM, $rates_id)) {
			remove_action('free_shipping_meter_action', [$this, 'free_shipping_meter_html']); // quickcart
			remove_action('woocommerce_before_cart_totals', [$this, 'free_shipping_meter_html'], 10); // cart
			add_action('free_shipping_meter_action', [$this, 'force_free_shipping_meter']); // quickcart
			add_action('woocommerce_before_cart_totals', [$this, 'force_free_shipping_meter'], 10); // cart
			return $rates;
		}
		$new_rates = $rates;
		// Get cart subtotal without subscriptinos
		$cart_total = $this->get_cart_total_without_subscriptions();
		// Check if cart subtotal is greater than or equal to minimum amount for free shipping
		if ($cart_total > 0 && $cart_total >= $this->free_shipping) {
			// Loop through rates and set all shipping costs to zero
			foreach ($new_rates as $rate_id => $rate) {
				if ('Standard Shipping' == $rate->label) {
					// change rate name to simule Free Shipping
					$new_rates[$rate_id]->label = 'Free Shipping';
					$new_rates[$rate_id]->cost = 0;
				}
				if ($rate->label == 'Express Shipping') {
					unset($new_rates[$rate_id]);
				}
			}
			$this->has_free_shipping = true; // Set flag to indicate free shipping has been applied
		}
		// If free shipping has not been applied, return original rates
		if (!$this->has_free_shipping) {
			return $rates;
		}
		// Otherwise, return updated rates with free shipping
		return $new_rates;
	}

	private function get_subscriptions_total()
	{
		$subscriptions_total = 0;
		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$product = $cart_item['data'];
			if ($product->is_type('subscription')) {
				$subscriptions_total += $product->get_price() * $cart_item['quantity'];
			}
		}
		return $subscriptions_total;
	}

	private function get_cart_total_without_subscriptions()
	{
		$cart_total = WC()->cart->get_cart_contents_total();
		$cart_total = (float) str_replace(',', '', $cart_total);
		$cart_total = $cart_total - $this->get_subscriptions_total();
		return $cart_total;
	}

	private function free_shipping_calc()
	{
		$cart = WC()->cart->get_cart();
		// Get the total amount of the cart without subscriptions
		$cart_total = $this->get_cart_total_without_subscriptions();
		$remaining	= (float) $this->free_shipping - $cart_total;
		$remaining	= number_format($remaining, 2);
		$progress 	= ($cart_total * 100) / (int) $this->free_shipping;
		$translate	= '0';

		if ($progress > 10) $translate = '-36px';
		if ($progress > 50) $translate = '-50px';
		if ($progress > 90) $translate = '-57px';

		// Case: free coupon
		if ($cart && ($cart_total < 0 || WC()->cart->total == 0)) {
			$cart_total = $this->free_shipping;
			$progress  = 100;
			$translate = '-57px';
			$remaining = 0;
		}

		// Case: more than free-shipping
		if ($cart_total >= $this->free_shipping) {
			$cart_total = $this->free_shipping;
			$progress  = 100;
			$translate = '-57px';
			$remaining = 0;
		}

		return [
			'remaining'  => $remaining,
			'progress'   => $progress,
			'translate'	 => $translate,
			'cart_total' => $cart_total
		];
	}

	public function free_shipping_meter_html()
	{
		ob_start();
		$free_shipping_meter = $this->free_shipping_calc();
		$remaining	= $free_shipping_meter['remaining'];
		$progress 	= $free_shipping_meter['progress'];
		$translate	= $free_shipping_meter['translate'];
		$cart_total = $free_shipping_meter['cart_total'];
		$class = (is_page('cart')) ? 'cart' : 'quickcart';
?>

		<?php if ($cart_total < $this->free_shipping) : ?>
			<div class="free-shipping-meter <?php echo $class; ?>">
				<div class="free-shipping-meter__title"><?php _e('You are', 'baketivity'); ?> <b>$<?php echo $remaining; ?></b> <?php _e('away from', 'baketivity'); ?> <b><?php _e('free shipping', 'baketivity'); ?></b> <?php _e('in the US on non-subscription kits!', 'baketivity'); ?> <a href="/shop/"><?php _e('Shop more', 'baketivity'); ?></a> <?php _e('and get it!', 'baketivity'); ?></div>
				<div class="free-shipping-meter__content">
					<div class="free-shipping-meter__progress">
						<progress class="free-shipping-meter__progress-bar" value="<?php echo $progress; ?>" style="width:<?php echo $progress; ?>%;"></progress>
					</div>
					<img class="free-shipping-meter__image" style="left:<?php echo $progress; ?>%; transform:translate3d(<?php echo $translate; ?>,0,0); -webkit-transform: translate3d(<?php echo $translate; ?>,0,0);" src="/wp-content/themes/baketivity/images/checkout/car-shipping.svg" alt="car shipping">
				</div>
			</div>
		<?php else : ?>
			<div class="free-shipping-meter-success <?php echo $class; ?>">
				<img class="free-shipping-meter-success__image" src="/wp-content/themes/baketivity/images/checkout/car-shipping.svg" alt="car shipping">
				<div class="free-shipping-meter-success__title"><?php _e('Congrats! You have', 'baketivity'); ?> <span><?php _e('US-free shipping!', 'baketivity'); ?></span></div>
			</div>
		<?php endif;
		$content = ob_get_clean();
		echo $content;
	}

	public function force_free_shipping_meter()
	{
		ob_start();
		$class = (is_page('cart')) ? 'cart' : 'quickcart';
		?>
		<div class="free-shipping-meter-success <?php echo $class; ?>">
			<img class="free-shipping-meter-success__image" src="/wp-content/themes/baketivity/images/checkout/car-shipping.svg" alt="car shipping">
			<div class="free-shipping-meter-success__title"><?php _e('Congrats! You have', 'baketivity'); ?> <span><?php _e('US-free shipping!', 'baketivity'); ?></span></div>
		</div>
<?php
		$content = ob_get_clean();
		echo $content;
	}
}
