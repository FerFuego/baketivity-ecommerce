/* 
 * Class Checkout
 * @constructor
 * @param {object} options
 * Add Event listener into form checkout to validate required fields
 * Created by: Fer Catalano 
 */

/* Constructor */
function Checkout() {
	var date = new Date();
	var time = date.getSeconds();
	// load checkout functions
	if (window.location.href.split('/')[3] === "checkout" || window.location.href.split('/')[4] === "checkout") {
		window.addEventListener('load', this.init);
	}
}

Checkout.prototype.init = function () {
	Checkout.prototype.disableEnterKey();
	Checkout.prototype.validation();	 /* Validation Billing Form */
	Checkout.prototype.changeFormType(); /* Change Form Type */
	Checkout.prototype.registerUser(); /* Register User */
	Checkout.prototype.stepNext(); 	 /* Step Next - Payment */
	Checkout.prototype.stepPrevious();  /* Step Previous - Billing */
	Checkout.prototype.hideEmptyListSavedCards(); /* Hide Empty List Saved Cards */
	Checkout.prototype.uncheckedCheckboxShipping(); /* Unchecked Checkbox Shipping Address */
	Checkout.prototype.listenerCheckboxShipping(); /* Listener Checkbox Shipping Address*/
	Checkout.prototype.hideShowGiftInformation(); /* Hide/Show Gift Information */
	Checkout.prototype.loginform(); /* Login Form */
	Checkout.prototype.viewOrder(); /* View Order Mobile */
	Checkout.prototype.listenerZipCode(); /* Listener Zip Code */
	Checkout.prototype.amazonPayment(); /* Amazon Payment */
	Checkout.prototype.listenerShippingMethod(); /* On shipping method change, refresh the total */
	Checkout.prototype.removeCouponRefresh(); /* Remove Coupon Refresh Page */
};

Checkout.prototype.changeFormType = function () {
	const formLogin = document.getElementById('js-login-form');
	const formRegiter = document.getElementById('js-register');
	const formLoginCta = document.querySelector('.woocommerce-form-login__cta-change');
	const formRegiterCta = document.querySelector('.woocommerce-form-register__cta-change-2');

	if (formLoginCta) {
		formLoginCta.addEventListener('click', function (e) {
			e.preventDefault();
			formRegiter.classList.add('animate__fadeIn');
			formLogin.classList.add('d-none');
			formRegiter.classList.remove('d-none');
		});
	}

	if (formRegiterCta) {
		formRegiterCta.addEventListener('click', function (e) {
			e.preventDefault();
			formLogin.classList.add('animate__fadeIn');
			formLogin.classList.remove('d-none');
			formRegiter.classList.add('d-none');
		});
	}
};

Checkout.prototype.validateEmail = function (input) {
	var re = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

	if (!re.test(input.value)) return false;
	return true;
};

// Disable enter to prevent form submission
Checkout.prototype.disableEnterKey = function () {
	var form = document.querySelector('form.woocommerce-cart-form-js');
	if (form) {
		form.addEventListener('keydown', function (e) {
			if (e.keyCode === 13) {
				console.log('enter pressed');
				e.preventDefault();
			}
		});
	}
};

Checkout.prototype.loginform = function () {
	var loginform = document.querySelector('.woocommerce-form-login');
	var loginCtaArrow = document.querySelector('.cta-down-arrow');
	var loginCta = document.querySelector('.nm-login-form-cta');
	if (loginform && loginCta) {
		loginCta.addEventListener('click', function (e) {
			e.preventDefault();
			loginform.classList.toggle('d-none');
			loginCtaArrow.classList.toggle('complete');
		});
	}
};

Checkout.prototype.registerUser = function () {
	const registerform = document.querySelector('#js-register');
	const registerCta = document.querySelector('#js-register-cta');
	const message = document.querySelector('#js-register-messageForm');

	if (registerform && registerCta) {
		registerCta.addEventListener('click', function (e) {
			e.preventDefault();

			var firstname = registerform.querySelector('#firstname');
			var lastname = registerform.querySelector('#lastname');
			var email = registerform.querySelector('#email');
			var password = registerform.querySelector('#reg_password');
			var error = false;

			if (firstname.value == '' || firstname.length < 2) {
				firstname.placeholder = 'This field is required *';
				firstname.classList.add('is-invalid');
				firstname.focus();
				error = true;
			} else {
				firstname.classList.remove('is-invalid');
			}

			if (lastname.value == '' || lastname.length < 2) {
				lastname.placeholder = 'This field is required *';
				lastname.classList.add('is-invalid');
				lastname.focus();
				error = true;
			} else {
				lastname.classList.remove('is-invalid');
			}

			if (email.value == '') {
				email.placeholder = 'This field is required *';
				email.classList.add('is-invalid');
				email.focus();
				error = true;
			}

			if (!Checkout.prototype.validateEmail(email)) {
				email.placeholder = 'Please enter a valid email.';
				email.classList.add('is-invalid');
				email.value = '';
				email.focus();
				error = true;
			} else {
				email.classList.remove('is-invalid');
			}

			if (password.value == '') {
				password.placeholder = 'This field is required *';
				password.classList.add('is-invalid');
				password.focus();
				error = true;
			}

			if (password.value.length < 8) {
				password.placeholder = 'Password must be at least 8 characters long.';
				password.classList.add('is-invalid');
				password.value = '';
				password.focus();
				error = true;
			} else {
				password.classList.remove('is-invalid');
			}

			if (error) return;

			var formData = new FormData();
			formData.append('action', 'baketivity_register');
			formData.append('firstname', firstname.value);
			formData.append('lastname', lastname.value);
			formData.append('email', email.value);
			formData.append('password', password.value);
			formData.append('login', true);

			jQuery.ajax({
				cache: false,
				url: ajax.url,
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				beforeSend: function () {
					registerCta.classList.add('disabled');
					registerCta.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
				},
				success: function (response) {
					registerCta.classList.remove('disabled');
					registerCta.innerHTML = 'Create an account';

					if (response.success == true) {
						message.innerHTML = '<p class="text-success">' + response.data + '</p>';
						// reload page
						location.reload();
					} else {
						message.innerHTML = '<p class="text-danger">' + response.data + '</p>';
					}
				}
			});
		});
	}
};

Checkout.prototype.validation = function () {
	var _form = document.querySelector('form.woocommerce-cart-form-js');
	if (_form) {
		// persistente listener
		setInterval(function () {
			var elements = _form.querySelectorAll(".form-row");
			elements.forEach(function (el) {
				if (el.classList.contains('woocommerce-invalid-required-field')) {
					var input = el.querySelector('input');
					if (input) {
						input.placeholder = 'This field is required *';
					}
				}
			});

			let message = document.querySelector('.woocommerce-message');
			let boxMessage = document.querySelector('.woocommerce-notices-wrapper');
			if (message && boxMessage) {
				// if message parent node is not .woocommerce-notices-wrapper 
				// insert message into .woocommerce-notices-wrapper
				if (!message.parentNode.classList.contains('woocommerce-notices-wrapper')) {
					boxMessage.appendChild(message);
				}
			}

			let recipient_email = document.querySelector('#recipient_email');
			if (recipient_email.value.length > 0) {
				Checkout.prototype.validateEmail(recipient_email);
			}
		}, 1000);
	}
};

Checkout.prototype.firstValidation = function () {
	var validated = [];

	// Billing Inputs
	var container1 = document.querySelector('.col-1');
	var fields = container1.querySelectorAll('.validate-required');
	fields.forEach(function (el) {
		var inputs = el.querySelectorAll('input');
		if (inputs) {
			inputs.forEach(function (input) {
				if (input.value == '') {
					input.placeholder = 'This field is required *';
					el.classList.add('woocommerce-invalid');
					el.classList.add('woocommerce-invalid-required-field');
					validated.push('Please confirm your ' + input.name.replace(/_/g, ' ') + '.');
				}
			});
		}

		var selects = el.querySelectorAll('select');
		if (selects) {
			selects.forEach(function (select) {
				if (select.value == '') {
					el.classList.add('woocommerce-invalid');
					el.classList.add('woocommerce-invalid-required-field');
					validated.push('Please confirm your ' + select.name.replace(/_/g, ' ') + '.');
				}
			});
		}
	});

	// Shipping Inputs 
	var container2 = document.querySelector('.col-2');
	var checkbox = container2.querySelector('#ship-to-different-address-checkbox');
	if (checkbox && checkbox.checked) {
		var fields0 = container2.querySelectorAll('.validate-required');
		fields0.forEach(function (el) {
			var inputs = el.querySelectorAll('input');
			if (inputs) {
				inputs.forEach(function (input) {
					if (input.value == '' && input.id !== 'recipient_email') {
						input.placeholder = 'This field is required *';
						el.classList.add('woocommerce-invalid');
						el.classList.add('woocommerce-invalid-required-field');
						validated.push('Please confirm your ' + input.name.replace(/_/g, ' ') + '.');
					}
				});
			}
		});
	} else {
		Checkout.prototype.uncheckedCheckboxShipping();
	}

	// This is a Gift
	var giftContainer = document.querySelector('.wcsg_add_recipient_fields');
	var giftCheckbox = document.querySelector('#gifting_option');
	if (giftCheckbox && giftCheckbox.checked) {
		var field1 = giftContainer.querySelector('input');
		var field2 = giftContainer.querySelector('textarea');
		// NOTE: input recipient email is not required
		/* if (field1.value == '') {
			field1.placeholder = 'This field is required *';
			field1.parentNode.classList.add('woocommerce-invalid');
			field1.parentNode.classList.add('woocommerce-invalid-required-field');
			validated.push('Please confirm your ' + field1.name.replace(/_/g, ' ') + '.');
		} */
		if (field2.value == '') {
			field2.placeholder = 'This field is required *';
			field2.parentNode.classList.add('woocommerce-invalid');
			field2.parentNode.classList.add('woocommerce-invalid-required-field');
			validated.push('Please confirm your ' + field2.name.replace(/_/g, ' ') + '.');
		}
	} else {
		Checkout.prototype.uncheckedCheckboxGift();
	}

	Checkout.prototype.addNotificationCheckout(validated);

	if (validated.length == 0) {
		return true;
	} else {
		return false;
	}
};

Checkout.prototype.shippingValidation = function () {
	var validated = false;
	var notice = document.querySelector('.notice-shipping-validation');
	var container1 = document.querySelector('#shipping_method li');
	if (!container1) return true;
	var container2 = document.querySelector('#shipping_method');
	var checkbox = container2.querySelectorAll('input[type="radio"]');
	if (checkbox.length > 0) {
		checkbox.forEach(function (el) {
			if (el.checked) {
				validated = true;
			}
		});
	}

	if (!validated) {
		if (!notice) jQuery(".woocomerce-custom-sidebar-checkout").prepend('<div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout notice-shipping-validation"><ul class="woocommerce-error" role="alert"><li>Please select a Shipping method.</li></ul></div>');
		window.scrollTo(0, 0);
	} else {
		if (notice) document.querySelector('.notice-shipping-validation').remove();
	}

	return validated;
};

Checkout.prototype.stepNext = function () {
	var payment_step = document.querySelector('#place_continue');
	if (payment_step) {
		payment_step.addEventListener('click', function () {

			var notification = document.querySelector('.woocommerce-notices-wrapper');
			if (notification) notification.innerHTML = '';

			var validation = Checkout.prototype.firstValidation();
			var shipping = Checkout.prototype.shippingValidation();
			var btn = document.querySelector('#place_continue');
			var control = false;

			var formData = new FormData();
			formData.append('action', 'woocommerce_custom_validation');
			formData.append('billing_email', jQuery('#billing_email').val());
			formData.append('billing_postcode', jQuery('#billing_postcode').val());
			formData.append('billing_country', jQuery('#billing_country').val());

			var container2 = document.querySelector('.col-2');
			var checkbox = container2.querySelector('#ship-to-different-address-checkbox');
			if (checkbox && checkbox.checked) {
				formData.append('shipping_postcode', jQuery('#shipping_postcode').val());
				formData.append('shipping_country', jQuery('#shipping_country').val());
			}

			jQuery.ajax({
				cache: false,
				url: ajax.url,
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				beforeSend: function () {
					btn.classList.add('disabled');
					btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
				},
				success: function (response) {

					btn.classList.remove('disabled');
					btn.innerHTML = 'Continue';

					if (response.status == 'error') {
						control = true;
						// set error message
						Checkout.prototype.addNotificationCheckout(response.message);
						//toggle login in checkout
						jQuery('.cta-login-form').click(function () {
							jQuery('.woocommerce-form-login').toggleClass('d-none');
							jQuery(this).toggleClass('complete');
							jQuery([document.documentElement, document.body]).animate({
								scrollTop: jQuery("#js-login-form").offset().top - 50
							}, 250);
						});

						// Add invalid class
						jQuery('#' + response.field + '_field').addClass('woocommerce-invalid');

						window.scrollTo(0, 0);
					}

					if (!validation && !control) {
						window.scrollTo(0, 0);
					}

					if (response.status == 'success' && validation && shipping) {
						var notification = document.querySelector('.woocommerce-notices-wrapper');
						if (notification) notification.innerHTML = '';

						var loader = document.querySelector('.js-payment-loader');
						loader.style.display = 'block';

						var payment_container = document.querySelector('.custom-payment-methods');
						payment_container.style.opacity = '1';
						payment_container.style.display = 'block';
						payment_container.style.filter = 'grayscale(0%)';
						payment_container.querySelector('.payment-methods').style.display = 'block';

						var prev_step = document.querySelector('.woocommerce-billing-fields');
						prev_step.classList.add('complete');

						var col_0_step = document.querySelector('.col-0');
						col_0_step.classList.add('complete');

						var prev_step_cont = document.querySelector('.woocommerce-billing-fields__field-wrapper');
						prev_step_cont.style.display = 'none';

						// Resume
						var prev_step_resume = document.querySelector('.woocommerce-billing-fields__field-wrapper-resume');
						prev_step_resume.style.display = 'block';
						Checkout.prototype.resume();

						var prev_child = document.querySelector('.col-2');
						prev_child.style.display = 'none';

						// Scroll to element
						document.querySelector('#payment_method_step').scrollIntoView();

						var place_order = document.querySelector('#place_order');
						if (place_order) {
							// remove disabled attribute
							place_order.removeAttribute('disabled');
						}

						setTimeout(function () {
							loader.style.display = 'none';
						}, 2000);
					}
				}
			});

		});
	}
};

Checkout.prototype.stepPrevious = function () {
	jQuery('.woocommerce-billing-fields h3').after().click(function () {
		var payment_container = document.querySelector('.custom-payment-methods');
		payment_container.style.opacity = '0.5';
		payment_container.style.filter = 'grayscale(100%)';
		payment_container.querySelector('.payment-methods').style.display = 'none';

		var prev_step = document.querySelector('.woocommerce-billing-fields__field-wrapper');
		prev_step.style.display = 'flex';

		var prev_step_cont = document.querySelector('.woocommerce-billing-fields');
		prev_step_cont.classList.remove('complete');

		var col_0_step = document.querySelector('.col-0');
		col_0_step.classList.remove('complete');

		var prev_step_resume = document.querySelector('.woocommerce-billing-fields__field-wrapper-resume');
		prev_step_resume.style.display = 'none';

		var prev_child = document.querySelector('.col-2');
		prev_child.style.display = 'block';

		var shipping_container = document.querySelector('.custom-shipping-methods');
		if (shipping_container) {
			shipping_container.style.display = 'none';
			shipping_container.classList.remove('complete');
		}

		var place_order = document.querySelector('#place_order');
		if (place_order) {
			// add disabled attribute
			place_order.setAttribute('disabled', 'disabled');
		}
	});
};

Checkout.prototype.getFields = function () {
	var fields = {};
	var form = document.querySelector('form.woocommerce-cart-form-js');
	var elements = form.querySelectorAll(".form-row");
	elements.forEach(function (el) {
		var input = el.querySelector('input');
		var select = el.querySelector('select');
		var textarea = el.querySelector('textarea');
		var radio = el.querySelector('input[type="radio"]');
		var checkbox = el.querySelector('input[type="checkbox"]');
		if (input) fields[input.name] = input.value;
		if (select) fields[select.name] = select.value;
		if (textarea) fields[textarea.name] = textarea.value;
		if (radio) fields[radio.name] = radio.value;
		if (checkbox) fields[checkbox.name] = checkbox.value;
	});
	var ele = document.getElementsByName('payment_method');
	ele.forEach(function (el) {
		var val = null;
		if (el.checked) {
			if (el.value == 'cod') val = 'Cash on Delivery';
			if (el.value == 'bacs') val = 'Bank Transfer';
			if (el.value == 'paypal') val = 'Paypal';
			if (el.value == 'stripe') val = 'Stripe';
			fields[el.name] = (val) ? val : el.value;
		}
	});

	return fields;
};

Checkout.prototype.getShipping = function () {
	var fields = {};
	if (jQuery("#shipping_method").length > 0) {
		var form = document.querySelector('#shipping_method');
		var elements = form.querySelectorAll("li");
		elements.forEach(function (el) {
			// input checked
			var input = el.querySelector('input');
			if (input.checked) {
				fields[input.name] = input.value;
				fields.shipping_method_title = el.querySelector('label').innerText;
			}
		});
	}
	return fields;
};

Checkout.prototype.stepEdit = function () {
	var billing = document.querySelector('.js-billing-cta');
	var shipping = document.querySelector('.js-shipping-cta');
	var payment = document.querySelector('.js-payment-cta');

	billing.addEventListener('click', function () {

		var payment_container = document.querySelector('.custom-payment-methods');
		payment_container.style.opacity = '0.5';
		payment_container.style.filter = 'grayscale(100%)';
		payment_container.querySelector('.payment-methods').style.display = 'none';

		var prev_step = document.querySelector('.woocommerce-billing-fields__field-wrapper');
		prev_step.style.display = 'flex';

		var first_step = document.querySelector('.col-1');
		first_step.style.display = 'block';

		var prev_child = document.querySelector('.col-2');
		prev_child.style.display = 'block';

		var third_step = document.querySelector('.col-3');
		third_step.style.display = 'block';
	});

	shipping.addEventListener('click', function () {

		var payment_container = document.querySelector('.custom-payment-methods');
		payment_container.style.opacity = '0.5';
		payment_container.style.filter = 'grayscale(100%)';
		payment_container.querySelector('.payment-methods').style.display = 'none';

		var first_step = document.querySelector('.col-1');
		first_step.style.display = 'block';

		var second_step = document.querySelector('.col-2');
		second_step.style.display = 'block';

		var third_step = document.querySelector('.col-3');
		third_step.style.display = 'block';
	});

	payment.addEventListener('click', function () {
		var first_step = document.querySelector('.col-1');
		first_step.style.display = 'none';

		var second_step = document.querySelector('.col-2');
		second_step.style.display = 'none';

		var third_step = document.querySelector('.col-3');
		third_step.style.display = 'block';
	});
};

Checkout.prototype.hideEmptyListSavedCards = function () {
	var stripeListCards = document.querySelector('.wc-saved-payment-methods');
	if (stripeListCards) {
		var stripeListCardsList = stripeListCards.getAttribute('data-count');
		if (stripeListCardsList <= 0) {
			stripeListCards.classList.add('d-none');
		}
	}
};

Checkout.prototype.listenerCheckboxShipping = function () {
	var checkbox = document.querySelector('#ship-to-different-address-checkbox');
	if (checkbox) {
		checkbox.addEventListener('change', function () {
			Checkout.prototype.uncheckedCheckboxShipping();
		});
	}
};

Checkout.prototype.hideShowGiftInformation = function () {
	var checkbox = document.querySelector('#gifting_option');

	if (checkbox) {
		var gift = document.querySelector('.wcsg_add_recipient_fields');
		checkbox.addEventListener('change', function () {
			gift.classList.toggle('active');
			if (!checkbox.checked) {
				document.querySelector('#recipient_email').value = '';
				document.querySelector('#recipient_message').value = '';
			}
		});
	}

};

Checkout.prototype.uncheckedCheckboxShipping = function () {
	var container2 = document.querySelector('.col-2');
	var checkbox = document.querySelector('#ship-to-different-address-checkbox');
	if (checkbox) {
		if (!checkbox.checked) {
			var container3 = container2.querySelector('.shipping_address');
			var inputs = container3.querySelectorAll('input');
			inputs.forEach(function (input) {
				input.value = '';
			});
		}
	}
};

Checkout.prototype.resume = function () {
	var html = '';
	var data = Checkout.prototype.getFields();
	var resume = document.querySelector('.woocommerce-billing-fields__field-wrapper-resume');
	if (resume) {
		html += '<div class="resume__content__item__content__item__content"><b>Billing Address :</b><br>' + data.billing_first_name + ' ' + data.billing_last_name + '<br>' + data.billing_email + '<br>' + data.billing_phone + '<br>' + data.billing_address_1 + ', ' + data.billing_address_2 + '<br>' + data.billing_city + ', ' + data.billing_state + ', ' + data.billing_postcode + ', ' + data.billing_country + '</div>';
		if (data.recipient_email) {
			html += '<div class="resume__content__item__content__item__content"><br><b>Gift Information : </b><br>' + data.recipient_email + ', ' + data.recipient_message + '</div>';
		}
		if (data.shipping_first_name) {
			html += '<div class="resume__content__item__content__item__content"><br><b>Shipping Address : </b><br>' + data.shipping_first_name + ' ' + data.shipping_last_name + '<br>' + data.shipping_company + '<br>' + data.shipping_address_1 + ', ' + data.shipping_address_2 + '<br>' + data.shipping_city + ', ' + data.shipping_state + ', ' + data.shipping_postcode + ', ' + data.shipping_country + '</div>';
		}
		if (data.order_comments) {
			html += '<div class="resume__content__item__content__item__content"><br><b>Order Comments : </b><br>' + data.order_comments + '</div>';
		}
	}
	resume.innerHTML = html;
};

Checkout.prototype.shippingResume = function () {
	if (jQuery('.woocommerce-shipping-fields__field-wrapper-resume').length > 0) {
		var html = '';
		var data = Checkout.prototype.getShipping();
		var resume = document.querySelector('.woocommerce-shipping-fields__field-wrapper-resume');
		if (resume && data.shipping_method_title) {
			html += '<div class="resume__content__item__content__item__content"><b>Shipping Method : </b> ' + data.shipping_method_title + '</div>';
		} else {
			html += '<div class="resume__content__item__content__item__content"><b>Shipping Method : </b> Free Shipping</div>';
		}
		resume.innerHTML = html;
	}
};

Checkout.prototype.mobileSelectorPaymentMethod = function () {
	var place_order_paypal = document.querySelectorAll('#ppcp-hosted-fields'); /* Paypal Place order buttons */
	if (place_order_paypal) {
		place_order_paypal.forEach(function (pop) {
			pop.style.display = 'none';
		});
	}

	var ele = document.querySelectorAll('input[name="payment_method"]');
	if (ele) {
		ele.forEach(function (el) {
			el.addEventListener('click', function (e) {
				if (el.checked && el.value == 'ppcp-credit-card-gateway') { /* Paypal */
					place_order_paypal.forEach(function (pop) {
						pop.style.display = 'block';
					});
				} else {
					place_order_paypal.forEach(function (pop) {
						pop.style.display = 'none';
					});
				}
			});
		});
	}
};

Checkout.prototype.addNotificationCheckout = function (validated) {

	var notification = document.querySelector('.woocommerce-notices-wrapper');
	if (notification && validated.length > 0) {
		notification.style.display = 'block';
		notification.classList.add('woo-custom-error');
		if (!document.querySelector('.woocommerce-error')) {
			notification.innerHTML += '<ul class="woocommerce-error" role="alert"></ul>';
		}
		if (!document.querySelector('.woocommerce-error-close')) {
			notification.innerHTML += '<span class="woocommerce-error-close">Close</span>';
		}
		document.querySelector('.woocommerce-error-close').addEventListener('click', function (e) {
			notification.style.display = 'none';
			notification.innerHTML = '';
		});
	} else {
		notification.style.display = 'none';
	}

	var errList = document.querySelector('.woocommerce-error');
	if (errList) {
		validated.forEach(function (el) {
			errList.innerHTML += '<li>' + el + '</li>';
		});
	}
};

Checkout.prototype.uncheckedCheckboxGift = function () {
	var checkbox = document.querySelector('#gifting_option');
	if (checkbox) {
		checkbox.checked = false;
	}
};

/* Not used - because the discount not work in afterpay if not reshesh the page */
Checkout.prototype.ajaxApplyCoupon = function () {
	// Only found in cart page
	var formCoupon = document.querySelector("#js-coupon-form-checkout");
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
				// simule click on update checkout
				jQuery(document.body).trigger('update_checkout');
				// add notification
				Checkout.prototype.addCouponNotificationCheckout(data);
				// hide loader
				loader.style.display = "none";
			});
		});
	}
};

Checkout.prototype.removeCouponRefresh = function () {
	jQuery(document).ajaxComplete(function (event, xhr, settings) {
		//if (settings.url === '/?wc-ajax=apply_coupon' || settings.url === '/?wc-ajax=remove_coupon') {
		if (settings.url === '/?wc-ajax=remove_coupon') {
			window.location.replace(location.href);
		}
	});
};

Checkout.prototype.addCouponNotificationCheckout = function (data) {
	// get response html from ajax and convert to html element
	var doc = new DOMParser().parseFromString(data, "text/xml");
	var text = doc.firstChild.innerHTML;
	var notification = document.querySelector('.woocommerce-notices-wrapper');

	if (notification) {
		notification.innerHTML = '';
		notification.style.display = 'none';

		if (text.trim() == 'Coupon code applied successfully.' || text.trim() == 'Coupon code removed successfully.') {
			notification.innerHTML += data;
			notification.style.display = 'block';
			return;
		}
		notification.style.display = 'block';

		if (data) {
			notification.innerHTML += data;
		}
		if (!document.querySelector('.woocommerce-error-close')) {
			notification.innerHTML += '<span class="woocommerce-error-close">Close</span>';
		}

		document.querySelector('.woocommerce-error-close').addEventListener('click', function (e) {
			notification.style.display = 'none';
			notification.innerHTML = '';
		});
	}
};

Checkout.prototype.viewOrder = function () {
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

Checkout.prototype.continueGuest = function () {

	var guestContent = document.querySelector('.nm-login-form__cta');

	/* --- Show info guest --- */
	var content = '';
	content += '<div class="nm-login-form__content">';
	content += '<div class="nm-login-form__user-data">';
	content += '<div class="nm-login-form__user-profile">';
	content += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" /></svg>';
	content += '</div>';
	content += 'Guest';
	content += '</div>';
	content += '<p></p>';
	content += '<a href="/checkout">Sign in</a>';
	content += '</div>';

	guestContent.innerHTML = content;

	/* --- Hide form Guest --- */
	var guestForm = document.querySelector('#js-register-guest');
	if (guestForm) {
		guestForm.classList.add('d-none');
	}

	/* --- Hide form Login --- */
	var loginForm = document.querySelector('#js-login-form');
	if (loginForm) {
		loginForm.classList.add('d-none');
	}

	/* --- Hide form Register --- */
	var checkoutForm = document.querySelector('#js-register');
	if (checkoutForm) {
		checkoutForm.classList.add('d-none');
	}

	/* --- Add complete step --- */
	var firstStep = document.querySelector('.nm-login-form');
	if (firstStep) {
		firstStep.classList.add('complete');
	}

	/* --- Active step 2 --- */
	var secondStep = document.querySelector('.col-0');
	if (secondStep) {
		secondStep.classList.add('active');
		Checkout.prototype.shipping_method(); /* Hide Shipping Method title */
	}

};

Checkout.prototype.shipping_method = function () {
	var shipping_method = document.querySelector('.shipping-methods-container');
	var shipping_methods = document.querySelectorAll('#shipping_method li');
	if (shipping_methods.length > 0) {
		shipping_method.classList.remove('d-none');
	} else {
		shipping_method.classList.add('d-none');
	}
};

Checkout.prototype.listenerZipCode = function () {
	var zipCode = document.querySelector('#billing_postcode');
	if (zipCode) {
		zipCode.addEventListener('keyup', function () {
			zipCode.value = zipCode.value.trim();
		});
	}
};

Checkout.prototype.amazonPayment = function () {

	jQuery(document).on("ajaxComplete", function (event, xhr, settings) {
		var amazonPayment = document.querySelector('#amazon_customer_details');
		var placeOrderButton = document.querySelector('#place_order');

		if (amazonPayment && placeOrderButton) {
			placeOrderButton.disabled = false;
			placeOrderButton.removeAttribute('disabled');
			placeOrderButton.classList.remove('disabled');
		}
	});

};

Checkout.prototype.listenerShippingMethod = function () {
	jQuery('form.checkout').on('change', 'input[name^="shipping_method"]', function () {
		var val = jQuery(this).val();
		if (val) {
			Checkout.prototype.refreshTotal();
		}
	});
};

Checkout.prototype.refreshTotal = function () {
	if (window.innerWidth < 769) {
		jQuery(".header-checkout__site-info__mobile-inside").load(location.href + " #js-view-order");

		// Wait 3 seconds to update total
		setTimeout(function () {
			Checkout.prototype.updateTotal();
			Checkout.prototype.viewOrder();
		}, 3000);
	}
};

Checkout.prototype.updateTotal = function () {

	let oldTotal = document.querySelector('#js-view-order strong');
	var formData = new FormData();
	formData.append('action', 'get_checkout_total_order');

	jQuery.ajax({
		cache: false,
		url: ajax.url,
		type: 'POST',
		data: formData,
		contentType: false,
		processData: false,
		beforeSend: function () {
			oldTotal.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
		},
		success: function (response) {
			oldTotal.innerHTML = '';
			oldTotal.innerHTML = 'Total ' + response.replace('0', '');
		}
	});
};

var checkout = new Checkout();