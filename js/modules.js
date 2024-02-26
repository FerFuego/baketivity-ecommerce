if (window.location.href.split('/')[3] !== "cart" && window.location.href.split('/')[4] !== "cart" &&
	window.location.href.split('/')[3] !== "checkout" && window.location.href.split('/')[4] !== "checkout") {

	jQuery(document).ready(function ($) {
		/* --- About Us Page (New) --- */
		// Family Focused Slider
		if (window.innerWidth < 767) {
			$('.js-family-focused-slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: true,
				appendArrows: $('#js-familiy-focused-slider-arrows'),
				prevArrow: "<div class='slick-prev'><svg width='10' height='21' viewBox='0 0 10 21' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M8.05469 19.071L0.999688 10.246L8.05469 1.00005' stroke='#4D4D4F' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/></svg></div>",
				nextArrow: "<div class='slick-next'><svg width='10' height='21' viewBox='0 0 10 21' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M1.37012 1L8.24291 9.96763L1.00004 19.0672' stroke='#4D4D4F' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/></svg></div>",
				adaptiveHeight: true,
				dotsClass: 'family-focused__dots',
			});
		}

		// Baketivity at the beginning Slider
		if (window.innerWidth < 767) {
			$('#js-baketivity-begining-copy').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				adaptiveHeight: true,
				arrows: false,
				dots: true,
				dotsClass: 'baketivity-begining__dots',
			});
		}

		/* --- Holiday Planner (Temporal Landing Page) --- */

		// Steps Slider (Mobile)
		if (window.innerWidth < 767) {
			$('#js-holiday-planner-steps').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: true,
				centerMode: true,
				centerPadding: '50px',
				infinite: false,
			});
		}

		$(".single_variation_wrap").on("show_variation", function (event, variation) {
			$('img.attachment-shop_single.size-shop_single.wp-post-image').attr('src', variation.image.src).change();
			$('img.attachment-shop_single.size-shop_single.wp-post-image').attr('currentSrc', variation.image.src).change();
			$('img.attachment-shop_single.size-shop_single.wp-post-image').attr('datasrc', variation.image.src).change();
			$('img.attachment-shop_single.size-shop_single.wp-post-image').attr('srcset', variation.image.src).change();
			$('a.venobox.vbox-item').attr('href', variation.image.url).change();
			// Fired when the user selects all the required dropdowns / attributes
			// and a final variation is selected / shown
		});

		$('.flexslider ul').slick({
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 4,
			centerPadding: '40px',
			responsive: [{
				breakpoint: 1024,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 4,

				}
			},
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
			]
		});

		/* Module Related Products - Product Page */

		/* Module Whats included boxes - Product Page */
		var items = document.querySelectorAll('.whats-included-boxes__item');
		var whatsIncludedBoxes = $('#js-whats-included-boxes');
		if (whatsIncludedBoxes.length > 0) {
			whatsIncludedBoxes.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: false,
				arrows: false,
				dots: false,
				align: 'center',
				centerMode: true,
				centerPadding: '15%',
				dotsClass: 'whats-included-boxes__dots',
				responsive: [{
					breakpoint: 9999,
					//settings: "unslick"
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1,
						centerMode: false,
						dots: items.length > 4 ? true : false,
						arrows: items.length > 4 ? true : false,
					}
				}, {
					breakpoint: 1100,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						centerMode: false,
						dots: true,
						arrows: true
					}
				}, {
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						centerMode: true,
						dots: true,
						arrows: true
					}
				}]
			});
		}

		var its = document.querySelectorAll('#js-related-products .related-products__product');
		if (its.length > 4) {
			jQuery('#js-related-products').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				infinite: false,
				arrows: false,
				dots: false,
				variableWidth: true,
				dotsClass: 'related-products__dots',
				responsive: [{
					breakpoint: 9999,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1,
						centerMode: false,
						dots: false,
						arrows: true,
					}
				}, {
					breakpoint: 1100,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
						centerMode: false,
						align: 'center',
						centerPadding: '15%',
						dots: true,
						arrows: true
					}
				}, {
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						centerMode: true,
						align: 'center',
						centerPadding: '15%',
						dots: true,
						arrows: true
					}
				}]
			});
		} else {
			jQuery('#js-related-products').css('justify-content', 'center');
		}

		/* Reviews Load More By Manu Verrastro */
		//jQueery(".review").slice(0, 3).show();
		var itemx = document.querySelectorAll('.review');
		if (itemx.length > 0) {
			itemx.forEach(function (item, index) {
				if (index < 3) {
					item.style.display = 'block';
				}
			});
		}
		jQuery("#loadMore").on("click", function (e) {
			e.preventDefault();
			jQuery(".review:hidden").slice(0, 4).show();
			if (jQuery(".review:hidden").length == 0) {
				jQuery("#loadMore").text("No more reviews").addClass("noContent");
			}
		});
	});
}
