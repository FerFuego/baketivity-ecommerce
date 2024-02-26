/*
 * Class Cart
 * @constructor
 * Created by: Fer Catalano
 */

/* Constructor */
function Cart() {
	if (window.location.href.split('/')[3] === "cart" || window.location.href.split('/')[4] === "cart") {
		window.addEventListener('load', this.init);
		jQuery(document).on('updated_wc_div', this.init);
	}
}

Cart.prototype.init = function () {
	Cart.prototype.viewOrder();  /* View Order */
	Cart.prototype.updateCart();  /* Update Cart */
	Cart.prototype.quantityCart(); /* Quantity Cart */
	Cart.prototype.quantityCartRelated(); /* Quantity Related */
	Cart.prototype.changeAddToCart(); /* Change Add To Cart */
	Cart.prototype.showMoreUpsellProducts(); /* Show More Upsell Products */
	Cart.prototype.removeClassScroll(); /* Remove Class Scroll - Do not remove */
	Cart.prototype.refreshTotal(); /* Refresh Total - Do not remove */
};

Cart.prototype.viewOrder = function () {
	var cta = document.querySelector('#js-view-order');
	var order = document.querySelector('#order_review');
	var close = document.querySelector('#order_review_heading');
	if (cta) {
		cta.addEventListener('click', function () {
			order.classList.add('is-visible');
		});
	}

	if (close) {
		close.addEventListener('click', function () {
			order.classList.remove('is-visible');
		});
	}
};

Cart.prototype.updateCart = function () {
	var button = document.querySelector('button[name="update_cart"]');
	button.removeAttribute('disabled');
};

Cart.prototype.changeAddToCart = function () {
	// Change label Add To Cart
	var buttons = document.querySelectorAll('.add_to_cart_button');
	buttons.forEach(function (button) {
		if (button.querySelector('span')) {
			button.querySelector('span').innerHTML = 'Add';
		}
	});
};

/*-----------------------------------
	Quantity change Cart Product
---------------------------------- */
Cart.prototype.quantityCart = function () {
	var proQty2 = jQuery('.quantity');
	proQty2.addClass('custom-aligment');
	proQty2.on('click', '.qtybtncart', function () {
		var newVal2;
		var $button = jQuery(this);
		var oldValue = $button.parent().find('input.qty').val();
		if ($button.hasClass('plus')) {
			newVal2 = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				newVal2 = parseFloat(oldValue) - 1;
			} else {
				newVal2 = 0;
			}
		}
		$button.parent().find('input.qty').val(newVal2);
		Cart.prototype.simulateClickUpdateCart();
	});
};

/*-----------------------------------
	Quantity change Related Product
---------------------------------- */
Cart.prototype.quantityCartRelated = function () {
	var proQty1 = jQuery('.quantity-related');
	proQty1.on('click', '.qtybtn', function () {
		var newVal;
		var $button = jQuery(this);
		var oldValue = $button.parent().find('input.qty').val();
		if ($button.hasClass('plus')) {
			newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 0;
			}
		}
		$button.parent().find('input.qty').val(newVal); // Update the value
		$button.parent().parent().parent().parent().find('.ajax_add_to_cart').attr('data-quantity', newVal); // Update the quantity
	});
};

Cart.prototype.showMoreUpsellProducts = function () {
	jQuery('.js-show-more-products').on('click', function (e) {
		e.preventDefault();
		jQuery('.show-more-upsell-products').show();
		jQuery('.show-more-button-container').hide();
	});

	//Remove cart side popup on cart page when add product in upsell products
	if (jQuery('body.woocommerce-cart').length) {
		jQuery('#yith-wacp-popup').hide();
	}
};

Cart.prototype.toggleCoupon = function () {
	//toggle arrow in gift form
	jQuery("#nm-coupon-btn").before().click(function () {
		jQuery(".coupon-form-toggle").toggleClass("active");
		jQuery("#pwgc-redeem-button").val("Apply");
	});
};

Cart.prototype.ajaxApplyCoupon = function () {
	// Only found in cart page
	var formCoupon = document.querySelector("#js-coupon-form");
	if (formCoupon) {
		formCoupon.addEventListener("submit", function (e) {
			e.preventDefault();
			var couponCode = formCoupon.querySelector('#coupon_code').value;
			var security = formCoupon.querySelector('#woocommerce_apply_coupon_nonce').value;
			var loader = document.querySelector(".js-coupon-loader");
			loader.style.display = "block";

			// Add coupon with ajax in cart page
			var data = {
				action: "woocommerce_apply_coupon",
				coupon_code: couponCode,
				security: security,
				wc_ajax: true
			};

			jQuery.post("/?wc-ajax=apply_coupon", data).done(function (data) {
				// append message into woocommerce-notices-wrapper
				jQuery(".woocommerce-notices-wrapper").append(data);
				// remove disabled attribute from update cart button
				jQuery('button[name="update_cart"]').removeAttr('disabled');
				// simule click on update cart button
				jQuery('[name="update_cart"]').trigger('click');
				// hide loader
				loader.style.display = "none";
				// Refresh total
				Cart.prototype.refreshTotal();
				// close view order
				var order = document.querySelector('#order_review');
				if (order) {
					order.classList.remove('is-visible');
				}
			});
		});
	}
};

Cart.prototype.simulateClickUpdateCart = function () {
	var btn = document.querySelector('button[name="update_cart"]');
	if (btn) {
		document.querySelector('button[name="update_cart"]').click();
	}
};

Cart.prototype.removeClassScroll = function () {
	document.querySelector('html').classList.remove('yith_wacp_open');
};

Cart.prototype.refreshTotal = function () {
	if (window.innerWidth < 769) {
		jQuery(".header-checkout__site-info__mobile-inside").load(location.href + " #js-view-order");

		setTimeout(function () {
			Cart.prototype.viewOrder();
		}, 3000);
	}
};

var cart = new Cart();