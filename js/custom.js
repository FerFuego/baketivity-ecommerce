// LANDING PAGE
jQuery(document).ready(function () {

	// LANDING PAGE
	jQuery('.faq--question').click(function () {
		jQuery(this).parent().toggleClass('active');
	});

	jQuery(window).scroll(function () {
		let _height = jQuery('.module-hero').height();

		setTimeout(function () {
			if (scrollY > _height + 250) {
				jQuery('.module-header').addClass('is-scrolling');
			} else {
				jQuery('.module-header').removeClass('is-scrolling');
			}
		}, 1000);
	});

	var _thumbs = jQuery('.products--thumb');

	_thumbs.each(function () {
		var _parent = jQuery(this);

		jQuery('ul', _parent).slick({
			dots: true,
			asNavFor: jQuery('.thumbnails', _parent)
		});

		jQuery('.thumbnails', _parent).slick({
			arrows: false,
			dots: false,
			vertical: true,
			slidesToShow: 2,
			slidesToScroll: 1,
			centerMode: true,
			infinite: true,
			asNavFor: jQuery('ul', _parent)
		});

		jQuery('.thumbnails .slick-slide').click(function () {
			var _index = jQuery(this).data('slick-index');

			jQuery('ul', _parent).slick('slickGoTo', _index);
		});
	});

	var _subs = jQuery('.products--item');

	jQuery('.rating a').click(function () {
		jQuery('html, body').animate({
			scrollTop: jQuery('.module-testimonials').offset().top - 90
		});
	});

	jQuery('.landing-page a[href="#module-subscribe"]').click(function () {
		var _id = jQuery(this).attr('href');

		jQuery('html, body').animate({
			scrollTop: jQuery(_id).offset().top - 90
		});
	});

	_subs.each(function () {
		var _parent = jQuery(this);

		var _price = jQuery('#display-item', _parent).attr('data-price');
		_price = _price.substr(0, _price.lastIndexOf('/'));

		jQuery('.price--value', _parent).html(_price);

		jQuery('#display-item', _parent).click(function (e) {
			e.preventDefault();
			jQuery('.subscriptions--item', _parent).toggleClass('open');
		});

		jQuery('.hidden-item', _parent).click(function (e) {
			e.preventDefault();

			jQuery('.hidden-item', _parent).removeClass('open');
			var _html = jQuery(this).html();
			var _id = jQuery(this).attr('data-id');
			var _price = jQuery(this).attr('data-price');
			_price = _price.substr(0, _price.lastIndexOf('/'));

			jQuery('#display-item', _parent).html(_html);
			jQuery('.price--value', _parent).html(_price);

			jQuery('.atc-item', _parent).removeClass('active');
			jQuery('#atc-' + _id, _parent).addClass('active');
			jQuery('#display-item', _parent).removeClass('open');


		});
	});

	var testimonialCarousel = jQuery('.testimonial-carousel');
	if (testimonialCarousel.length > 0) {
		testimonialCarousel.slick({
			autoplay: true,
			autoplaySpeed: 5000,
			fade: true,
			adaptiveHeight: true,
			asNavFor: '.testimonial-thumb'
		});
	}

	var testimonialThumb = jQuery('.testimonial-thumb');
	if (testimonialThumb.length > 0) {
		testimonialThumb.slick({
			autoplay: true,
			autoplaySpeed: 5000,
			asNavFor: '.testimonial-carousel',
			dots: true,
			arrows: false,
			slidesToShow: 6,
			slidesToScroll: 1,
			centerMode: true,
			infinite: true,
			responsive: [
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 3,
						centerMode: true,
					}
				}
			]
		});
	}

	var mobileSlider = jQuery('.js-mobile-slider');
	if (mobileSlider.length > 0) {
		mobileSlider.slick({
			autoplay: true,
			autoplaySpeed: 5000,
			dots: true,
			arrows: true,
			slidesToShow: 1,
			slidesToScroll: 1,
		});
	}

	var steps = jQuery('.steps');
	if (steps.length > 0) {
		steps.slick({
			autoplay: true,
			autoplaySpeed: 5000,
			arrows: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			infinite: true,
			responsive: [
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 1,
						centerMode: true,
					}
				}
			]
		});
	}

	var extras = jQuery('.extras');
	if (extras.length > 0) {
		extras.slick({
			autoplay: true,
			autoplaySpeed: 15000,
			arrows: true,
			slidesToShow: 2,
			slidesToScroll: 1,
			infinite: true,
			adaptiveHeight: true,
			responsive: [
				{
					breakpoint: 9999,
					settings: 'unslick'
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 1,
						centerMode: true,
						adaptiveHeight: true
					}
				}
			]
		});
	}

	jQuery('.overlay--wrapper').click(function (e) {
		e.preventDefault();

		var _target = e.target.classList;

		if (_target.contains('overlay--wrapper') || _target.contains('js-close-video')) {
			jQuery('.overlay--wrapper').removeClass('is-open');
		}
	});

	jQuery('.js-video').click(function (e) {
		e.preventDefault();
		jQuery('.overlay--wrapper').addClass('is-open');
	});
});
// END LANDING PAGE



jQuery(document).on('click', 'button.d-searc-open', function () {
	jQuery('.d-search-popup').fadeIn();
});

jQuery(document).on('click', '.close-searh-pop', function () {
	jQuery('.d-search-popup').fadeOut();
});

jQuery(document).ready(function () {
	jQuery(".popup-shop .fas").on("click", function () {
		jQuery(".popup-shop").remove();
	});

	jQuery(document).on('click', '.prev-thumb', function (e) {
		e.preventDefault();
		jQuery(this).next(".link-image").find("img").toggleClass("on-hover-thumb");
	});

	jQuery(document).on('click', '.next-thumb', function (e) {
		e.preventDefault();
		jQuery(this).prev(".link-image").find("img").toggleClass("on-hover-thumb");
	});
});

jQuery(document).ready(function () {
	//Close footer popup
	jQuery('.close-floating-footer').click(function () {
		jQuery("#floating-footer").hide();
	});

	jQuery('.d-tab-cs .d-week').click(function () {
		var did = jQuery(this).attr('id');
		jQuery(this).addClass('active').siblings().removeClass('active');
		jQuery('.ult_tab_li a').each(function () {
			var daid = jQuery(this).attr('id');
			if (daid == did) {
				jQuery(this).trigger('click');
			}
		});
	});

	jQuery('.widget_nav_menu span.gamma.widget-title').click(function () {
		jQuery(this).parent().toggleClass('active');
		jQuery(this).parent().find('.menu').slideToggle();
	});

	jQuery('body').on('change', '.woocommmerce.yith-wacp-related input.input-text.qty.text', function () {
		jQuery(this).parents('li').find('a.button').attr('data-quantity', jQuery(this).val());
	});

	jQuery('body').on('a.subscription-auto-renew-toggle.subscription-auto-renew-toggle--off', 'click', function () {
		console.log('21321');
	});

	jQuery(document).on('click', 'a.subscription-auto-renew-toggle.subscription-auto-renew-toggle--off', function () {
		console.log("success");
	});

	jQuery('.page-id-165818 .ajax_add_to_cart').each(function (i, el) {
		if (jQuery(el).is('div')) {
			jQuery(el).removeClass('ajax_add_to_cart');
			var link = jQuery(el).children('a');
			link.addClass(' ajax_add_to_cart add_to_cart_button button gift_ajax_add_to_cart');//add_to_cart_button

			if (link.attr('href')) {
				var addr = new URL(link.attr('href')),
					searchParams = new URLSearchParams(addr.search);

				if (searchParams.has('add-to-cart')) {
					link.attr('data-product_id', searchParams.get('add-to-cart'));
				}
			}
		}
	});

	window.onscroll = function () {
		mobile_sticky_menu();
	};


	function mobile_sticky_menu() {
		var header = document.getElementById("masthead");
		if (header) {
			var sticky = header.offsetTop;
			if (window.pageYOffset > sticky) {
				header.classList.add("sticky");
			} else {
				header.classList.remove("sticky");
			}
		}
	}

	//Promo bar - mobile
	promoBarMobile();
});

/**
 * @param String name
 * @return String
 * Created by: Fer Catalano
 */
function getParameterByName(name) {
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


/**
 * Function convert string into Promo Bar
 * @return String
 * Created by: Fer Catalano
 */
function promoBarMobile() {
	var input = document.querySelector("#kla_email_klaviyo_emailsignup_widget--1");
	var btnSubmit = document.querySelector('.klaviyo_submit_button');
	if (window.innerWidth < 768 && input && btnSubmit) {
		btnSubmit.innerHTML = "Get 10% off";
		input.placeholder = "Join our newsletter";
	}
}

/**
 * Function to fix error eccesibility
 * Remove empty labels
 * Add Text hamburger menu
 */
jQuery(document).ready(function ($) {
	var form_1 = document.querySelector('#kla_embed_klaviyo_emailsignup_widget--1');
	var form_2 = document.querySelector('#kla_embed_klaviyo_emailsignup_widget-2');
	var hamburger = document.querySelector('.menu-toggle');
	var div = document.createElement("div");
	div.classList.add('d-none');
	div.innerHTML = 'Menu';

	if (form_1) form_1.querySelector('label').innerHTML = 'Enter your Email';
	if (form_2) form_2.querySelector('label').innerHTML = 'Enter your Email';
	if (hamburger) hamburger.append(div);
});


/* Add Slick slider to Module How-its-works */
jQuery(document).ready(function ($) {
	var howItWorksSlider = $('#js-how-it-works-slider');
	if (howItWorksSlider.length > 0) {
		howItWorksSlider.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: false,
			arrows: false,
			dots: false,
			align: 'center',
			centerMode: true,
			centerPadding: '15%',
			dotsClass: 'how-it-works__dots',
			responsive: [{
				breakpoint: 9999,
				settings: "unslick"
			}, {
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: true,
					arrows: true
				}
			}, {
				breakpoint: 321,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: '10%',
					dots: true,
					arrows: true
				}
			}, {
				breakpoint: 281,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: '4%',
					dots: true,
					arrows: true
				}
			}]
		});
	}

	var whoItForSlider = $('#js-who-its-for-slider');
	if (whoItForSlider.length > 0) {
		whoItForSlider.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			arrows: false,
			dots: false,
			align: 'center',
			dotsClass: 'who-its-for__dots',
			responsive: [{
				breakpoint: 9999,
				settings: "unslick"
			}, {
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: true,
					arrows: true
				}
			}]
		});
	}

	var howToCashItSlider = $('#js-how-to-cash-it-slider');
	if (howToCashItSlider.length > 0) {
		howToCashItSlider.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			arrows: false,
			dots: false,
			align: 'center',
			centerMode: true,
			centerPadding: '15%',
			dotsClass: 'how-to-cash-it__dots',
			responsive: [{
				breakpoint: 9999,
				settings: "unslick"
			}, {
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: true,
					arrows: true
				}
			}]
		});
	}

	var theJoyOfBakingSlider = $('#js-the-joy-of-baking-slider');
	if (theJoyOfBakingSlider.length > 0) {
		theJoyOfBakingSlider.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
			dotsClass: 'the-joy-of-baking__dots',
			responsive: [{
				breakpoint: 9999,
				settings: "unslick"
			}, {
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerMode: true,
					infinite: false,
					dots: true,
					arrows: true
				}
			}]
		});
	}

	var experienceSlider = $('#js-experience-slider');
	if (experienceSlider.length > 0) {
		experienceSlider.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			arrows: false,
			dots: false,
			align: 'center',
			centerMode: true,
			centerPadding: '10%',
			dotsClass: 'experience__dots',
			responsive: [{
				breakpoint: 9999,
				settings: "unslick"
			}, {
				breakpoint: 1100,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					dots: true,
					arrows: true
				}
			}, {
				breakpoint: 769,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					centerPadding: '5%',
					dots: true,
					arrows: true
				}
			}, {
				breakpoint: 600,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: '18%',
					dots: true,
					arrows: true
				}
			}, {
				breakpoint: 426,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: '21%',
					dots: true,
					arrows: true
				}
			}, {
				breakpoint: 376,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: '15%',
					dots: true,
					arrows: true
				}
			}, {
				breakpoint: 321,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: '10%',
					dots: true,
					arrows: true
				}
			}]
		});
	}

	var holidaySeason = $('#js-slide-holiday-season');
	if (holidaySeason.length > 0) {
		holidaySeason.slick({
			arrows: true,
			dots: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 99999,
					settings: "unslick"
				},
				{
					breakpoint: 769,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
						infinite: false
					}
				},
				{
					breakpoint: 460,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						infinite: false
					}
				}
			]
		});
	}

	var holidayExperience = $('#js-slide-holiday-experience');
	if (holidayExperience.length > 0) {
		holidayExperience.slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: true,
			dots: true,
			infinite: false,
			variableWidth: true,
			centerMode: false,
			dotsClass: 'experience-holiday__dots',
			responsive: [{
				breakpoint: 1100,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					dots: true,
					arrows: true
				}
			}, {
				breakpoint: 768,
				settings: "unslick"
			}]
		});
	}

	var giftingSlider = $('#js-gifting-slider');
	if (giftingSlider.length > 0) {
		giftingSlider.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			dots: true,
			infinite: false,
			dotsClass: 'gifting-is-better__dots',
			responsive: [{
				breakpoint: 9999,
				settings: "unslick"
			}, {
				breakpoint: 500,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: true,
					arrows: true
				}
			}]
		});
	}

	var corporateSlider = $('#js-corporate-slider');
	if (corporateSlider.length > 0) {
		corporateSlider.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			dots: true,
			infinite: false,
			dotsClass: 'corporate-gift-slider__dots'
		});
	}

	var m_subscription = $('#js-m-subscription');
	if (m_subscription.length > 0) {
		m_subscription.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
			infinite: false,
			initialSlide: 2,
			centerMode: true,
			responsive: [{
				breakpoint: 9999,
				settings: "unslick"
			}, {
				breakpoint: 500,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				}
			}]
		});
		// active current item into nav
		$('#js-m-subscription').on('afterChange', function () {
			var dataId = $('#js-m-subscription .slick-current').attr("data-slick-index");
			var navitems = $('button.tablinks');
			navitems.removeClass('active');
			navitems[dataId].classList.add('active');
		});
		// go to slide
		$('button.tablinks[data-slide]').click(function (e) {
			e.preventDefault();
			$('button.tablinks').removeClass('active');
			$(this).addClass('active');
			var slideno = $(this).data('slide');
			m_subscription.slick('slickGoTo', slideno - 1);
		});
	}

	var proudPartners = $('#js-proud-partners');
	if (proudPartners.length > 0) {
		proudPartners.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			dots: false,
			infinite: false,
			centerMode: true,
			responsive: [{
				breakpoint: 9999,
				settings: "unslick"
			}, {
				breakpoint: 500,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				}
			}]
		});
	}

	var bestSellers = $('#js-best-sellers');
	if (bestSellers.length > 0) {
		bestSellers.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			dots: false,
			infinite: true,
			centerMode: true,
			responsive: [{
				breakpoint: 9999,
				settings: "unslick"
			}, {
				breakpoint: 1025,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
				}
			},
			{
				breakpoint: 769,
				settings: {
					infinite: false,
					centerMode: false,
					slidesToShow: 3,
					slidesToScroll: 1,
				}
			}, {
				breakpoint: 500,
				settings: {
					infinite: false,
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: '15%',
				}
			}, {
				breakpoint: 376,
				settings: {
					infinite: false,
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: '18%',
				}
			}, {
				breakpoint: 321,
				settings: {
					infinite: false,
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: '10%',
				}
			}]
		});
	}
});

/**
 * Add a custom function to add product into cart.
 * Module Subscriptions Cake
 * @author Fer Catalano
 */
jQuery(document).ready(function ($) {
	$('input[type=radio][name=subscription]').change(function () {
		// radio button checked
		var inputList = document.querySelector('.js-radio-list input:checked');
		var submitList = document.querySelector('.js_add_to_cart');
		submitList.setAttribute('data-product_id', inputList.getAttribute('data-product_id'));
		submitList.setAttribute('data-product_sku', inputList.getAttribute('data-product_sku'));
		submitList.setAttribute('aria-label', inputList.getAttribute('aria-label'));
		submitList.setAttribute('product_name', inputList.getAttribute('product_name'));
		submitList.setAttribute('product_price', inputList.getAttribute('product_price'));
		submitList.removeAttribute('disabled');
	});

	jQuery('#js-the-joy-of-baking-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
		if (nextSlide > 0) {
			jQuery('#js-the-joy-of-baking-slider').addClass('remove-before');
		} else {
			jQuery('#js-the-joy-of-baking-slider').removeClass('remove-before');
		}
	});

});

jQuery(document).ready(function () {
	var productShop = document.querySelectorAll(".product-shop");
	if (productShop.length > 0) {
		productShop.forEach(function (item) {
			var slider = item.querySelector(".product-shop__ul");
			var slides = item.querySelectorAll(".product-shop__li");
			if (slides.length > 1) {
				var totalScroll = slider.scrollWidth - slider.offsetWidth;
				// hover
				item.addEventListener("mouseover", function () {
					var prev = item.querySelector(".product-shop__control_prev");
					prev.style.visibility = "visible";
					prev.addEventListener("click", function () {
						slider.scrollLeft -= 290;
					});
					var next = item.querySelector(".product-shop__control_next");
					next.style.visibility = "visible";
					next.addEventListener("click", function () {
						slider.scrollLeft += 290;
					});
				});
				// leave
				item.addEventListener("mouseleave", function () {
					slider.scrollLeft = 0;
					var prev = item.querySelector(".product-shop__control_prev");
					prev.style.visibility = "hidden";
					var next = item.querySelector(".product-shop__control_next");
					next.style.visibility = "hidden";
				});
				// slider
				slider.addEventListener("scroll", function () {
					var currentScroll = item.querySelector(".product-shop__ul").scrollLeft;
					var prev = item.querySelector(".product-shop__control_prev");
					var next = item.querySelector(".product-shop__control_next");
					if (currentScroll === 0 || currentScroll < 0) {
						prev.classList.add("inactive");
					} else {
						prev.classList.remove("inactive");

						if (totalScroll === currentScroll || currentScroll > totalScroll) {
							next.classList.add("inactive");
						} else {
							next.classList.remove("inactive");
						}
					}
				});
			}
		});
	}

	var items = document.querySelectorAll(".product-shop-duff");
	if (items.length > 0) {
		items.forEach(function (item) {
			var slider = item.querySelector(".product-shop-duff__ul");
			var slides = item.querySelectorAll(".product-shop-duff__li");
			if (slides.length > 1) {
				var totalScroll = slider.scrollWidth - slider.offsetWidth;
				// hover
				item.addEventListener("mouseover", function () {
					var prev = item.querySelector(".product-shop-duff__control_prev");
					prev.addEventListener("click", function () {
						slider.scrollLeft -= 290;
					});
					var next = item.querySelector(".product-shop-duff__control_next");
					next.addEventListener("click", function () {
						slider.scrollLeft += 290;
					});
				});
				// leave
				item.addEventListener("mouseleave", function () {
					slider.scrollLeft = 0;
					var prev = item.querySelector(".product-shop-duff__control_prev");
					var next = item.querySelector(".product-shop-duff__control_next");
				});
				// slider
				slider.addEventListener("scroll", function () {
					var currentScroll = item.querySelector(
						".product-shop-duff__ul"
					).scrollLeft;
					var prev = item.querySelector(".product-shop-duff__control_prev");
					var next = item.querySelector(".product-shop-duff__control_next");
					if (currentScroll === 0 || currentScroll < 0) {
						prev.classList.add("inactive");
					} else {
						prev.classList.remove("inactive");

						if (totalScroll === currentScroll || currentScroll > totalScroll) {
							next.classList.add("inactive");
						} else {
							next.classList.remove("inactive");
						}
					}
				});
			}
		});
	}
});


/**
 * Add a custom function to add product into cart.
 * Module Corporate Gift
 * @author Fer Catalano
 */
jQuery(document).ready(function ($) {
	// quantity all
	var proQty1 = jQuery('.pro-qty');
	proQty1.on('click', '.qtybtn', function () {
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
		var product_id = input.attr('id');
		var qtyLink = document.querySelector("a.corporate-gift-slider__product-button[data-product_id='" + product_id + "']");
		qtyLink.setAttribute('data-quantity', newVal);
	});

	// quantity form gift card
	var proQty2 = jQuery('.gift-card-quantity');
	if (proQty2.length > 0) {
		proQty2.on('click', '.qtybtn', function () {
			var $button = jQuery(this);
			var oldValue = $button.parent().find('input').val();
			var newVal;
			var idCard = $button.data("id");
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
			var qtyLink = document.querySelector('.corporate-gift-slider__product-button[data-card-id="' + idCard + '"]');
			qtyLink.setAttribute('data-quantity', newVal);
		});
	}

	// amount
	var proAmount = jQuery('.gift-card-amount');
	proAmount.on('change', function (e) {
		var $button = jQuery(this);
		var newVal = $button.val();
		var idCard = $button.data("id");
		var qtyLink = document.querySelector('.corporate-gift-slider__product-button[data-card-id="' + idCard + '"]');
		qtyLink.setAttribute('data-product_id', newVal);
	});

	var $addToCardLink = $('.corporate-gift-slider__product-button');
	$addToCardLink.click(function (evt) {

		var hasAmountSelect = $(this).data('gif-card-amount');
		var idCard = $(this).data("card-id");

		if (hasAmountSelect) {
			var amountSelectVal = jQuery('.gift-card-amount[data-id="' + idCard + '"]').val();

			if (!amountSelectVal) {
				jQuery('.gift-card-amount__select-an-amount[data-id="' + idCard + '"]').show().delay(1000).fadeOut();

				evt.stopPropagation();
				evt.preventDefault();
			}

		}

	});
});

// Add event to open table FundraisingGoals
function openTableFundraisingGoals(btn) {
	var table = jQuery('#calculate-fundraising-brochure');
	table.toggleClass('open');

	if (table.hasClass('open')) {
		btn.innerHTML = 'Collapse';
	} else {
		btn.innerHTML = 'Calculate now';
	}

	if (window.innerWidth < 768) {
		var total = 0;
		var _table = document.querySelector('#calculate-fundraising-brochure-mobile');
		var data = _table.querySelector('.fundraising-goals__data');
		var _percentage = data.getAttribute('data-percentage');
		var _comission = data.getAttribute('data-comission');
		var inputOne = _table.querySelector('#one_mobile');
		var inputTwo = _table.querySelector('#two_mobile');
		var inputThree = _table.querySelector('#three_mobile');

		inputOne.addEventListener('input', function () {
			if (inputOne.value > 0 && inputTwo.value > 0 && percentage > 0 && comission > 0) {
				total = inputOne.value * inputTwo.value;
				total = total + (total * (percentage / 100));
				total = total + (total * (comission / 100));
				inputThree.value = '$' + (Math.round(total * 100) / 100).toFixed(2);
			}
		});

		inputTwo.addEventListener('input', function () {
			if (inputOne.value > 0 && inputTwo.value > 0 && percentage > 0 && comission > 0) {
				total = inputOne.value * inputTwo.value;
				total = total + (total * (percentage / 100));
				total = total + (total * (comission / 100));
				inputThree.value = '$' + (Math.round(total * 100) / 100).toFixed(2);
			}
		});

	} else {

		var __total = 0;
		var __table = document.querySelector('#calculate-fundraising-brochure');
		var __data = __table.querySelector('.fundraising-goals__data');
		var percentage = __data.getAttribute('data-percentage');
		var comission = __data.getAttribute('data-comission');
		var __inputOne = __table.querySelector('#one');
		var __inputTwo = __table.querySelector('#two');
		var ____datainputThree = __table.querySelector('#three');

		__inputOne.addEventListener('input', function () {
			if (__inputOne.value > 0 && __inputTwo.value > 0 && _percentage > 0 && _comission > 0) {
				__total = __inputOne.value * __inputTwo.value;
				__total = __total + (__total * (_percentage / 100));
				__total = __total + (__total * (_comission / 100));
				____datainputThree.value = '$' + (Math.round(__total * 100) / 100).toFixed(2);
			}
		});

		__inputTwo.addEventListener('input', function () {
			if (__inputOne.value > 0 && __inputTwo.value > 0 && _percentage > 0 && _comission > 0) {
				__total = __inputOne.value * __inputTwo.value;
				__total = __total + (__total * (_percentage / 100));
				__total = __total + (__total * (_comission / 100));
				____datainputThree.value = '$' + (Math.round(__total * 100) / 100).toFixed(2);
			}
		});
	}

}

/* Print Screen */
function printScreenPost(id) {
	var printContents = document.getElementById(id).innerHTML;
	w = window.open();
	w.document.write(printContents);
	w.document.close(); // necessary for IE >= 10
	w.focus(); // necessary for IE >= 10
	w.print();
	w.close();
	return true;
}

// Birtdhay page - scroll to section
jQuery(document).ready(function () {
	var birthdayCta = document.querySelector('.birthday-page .hero-home__button');
	if (birthdayCta) {
		birthdayCta.addEventListener('click', function () {
			var attrSrc = birthdayCta.getAttribute('href');
			jQuery([document.documentElement, document.body]).animate({
				scrollTop: jQuery(attrSrc).offset().top - 80
			}, 250);
		});
	}
	var birthdayCtaFooter = document.querySelector('.baking-banner-footer__cta');
	if (birthdayCtaFooter) {
		birthdayCtaFooter.addEventListener('click', function () {
			var attrSrc = birthdayCtaFooter.getAttribute('href');
			jQuery([document.documentElement, document.body]).animate({
				scrollTop: jQuery(attrSrc).offset().top - 80
			}, 250);
		});
	}
});


/* 
* Copy to clipboad function
* BTN Amazon Prime
*/
function copyToClipboard(obj) {
	// Get the text field
	var copyText = document.getElementById("coupon_prime");
	// Select the text field
	copyText.select();
	copyText.setSelectionRange(0, 99999); // For mobile devices
	// Copy the text inside the text field
	navigator.clipboard.writeText(copyText.value);
	// Change Label
	obj.innerHTML = 'Coupon copied!';
}


/**
 * Add slider
 * Modules - Slider
 * @author Fer Catalano
 */
jQuery(document).ready(function ($) {
	var m_hero_slider = $('#js-hero-slider');
	if (m_hero_slider.length > 0) {
		m_hero_slider.slick({
			autoplay: true,
			autoplaySpeed: 5000,
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			dots: true,
			infinite: true
		});
	}

	var what_is_inside = $('#js-what-is-inside');
	if (what_is_inside.length > 0) {
		what_is_inside.slick({
			autoplay: true,
			autoplaySpeed: 5000,
			slidesToShow: 4,
			slidesToScroll: 1,
			centerMode: false,
			centerPadding: '10%',
			cssEase: 'linear',
			variableWidth: true,
			variableHeight: true,
			startPosition: 3,
			arrows: true,
			dots: false,
			infinite: false,
			responsive: [{
				breakpoint: 1025,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					centerMode: true
				}
			}, {
				breakpoint: 769,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerMode: true,
					dots: true
				}
			}, {
				breakpoint: 376,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerPadding: '0',
					centerMode: true,
					dots: true,
				}
			}]
		});
	}

	var soft_reviews = $('#js-soft-reviews');
	if (soft_reviews.length > 0) {
		soft_reviews.slick({
			autoplaySpeed: 5000,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: false,
			infinite: true,
			arrows: true,
			dots: false,
			cssEase: 'linear',
			variableWidth: true,
			variableHeight: true,
			prevArrow: $('.soft-reviews__arrow-left'),
			nextArrow: $('.soft-reviews__arrow-right'),
			responsive: [{
				breakpoint: 1025,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				}
			}, {
				breakpoint: 769,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: true,
					arrows: false,
					centerMode: true,
					centerPadding: '0',
				}
			}]
		});
	}
});
