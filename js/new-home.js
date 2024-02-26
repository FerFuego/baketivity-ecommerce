function showSubscriptionType(e) {
	if (!e.is(':checked')) {
		jQuery('#hs-content').removeClass('bg-yellow');
		jQuery('#hs-one').removeClass('d-none');
		jQuery('#hs-wi-one').removeClass('d-none');
		jQuery('#hs-two').addClass('d-none');
		jQuery('#hs-wi-two').addClass('d-none');
	} else {
		jQuery('#hs-content').addClass('bg-yellow');
		jQuery('#hs-one').addClass('d-none');
		jQuery('#hs-wi-one').addClass('d-none');
		jQuery('#hs-two').removeClass('d-none');
		jQuery('#hs-wi-two').removeClass('d-none');
	}
}

jQuery(document).ready(function ($) {
	showSubscriptionType($('#color_mode'));

	$("#color_mode").on("change", function (e) {
		showSubscriptionType($(this));
	});

	var sliderHome = $('.slider-home');
	if (sliderHome.length > 0) {
		sliderHome.slick({
			arrows: false,
		});
	}

	var sliderSteps = $('#slider-steps');
	if (sliderSteps.length > 0) {
		sliderSteps.slick({
			arrows: false,
			dots: true
		});
	}

	var sliderOtk = $('#slider-otk');
	if (sliderOtk.length > 0) {
		sliderOtk.slick({
			arrows: true,
			dots: true,
			slidesToShow: 4,
			slidesToScroll: 2,
			responsive: [
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						infinite: false,
						centerMode: true,
						variableWidth: true,
					}
				}
			]
		});
	}

	var sliders_fak = document.getElementsByClassName('slider-fak-item').length;
	var screen = window.screen.width;
	var dots = false;
	if (screen < 768) {
		dots = true;
	} else if (screen > 768 && sliders_fak > 4) {
		dots = true;
	} else {
		dots = false;
	}

	var sliderFak = $('#slider-fak');
	if (sliderFak.length > 0) {
		sliderFak.slick({
			arrows: true,
			dots: dots,
			slidesToShow: 4,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 769,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
						centerMode: false,
						infinite: false
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						centerMode: true,
						centerPadding: '17%',
						infinite: false
					}
				},
				{
					breakpoint: 380,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						centerMode: true,
						infinite: false
					}
				}
			]
		});
	}

	var sliderTest = $('#slider-test');
	if (sliderTest.length > 0) {
		sliderTest.slick({
			arrows: true,
			dots: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						centerMode: true,
						infinite: false
					}
				}
			]
		});
	}

	var sliderLogoReelSlider = $('#slider-logo-reel');
	if (sliderLogoReelSlider.length > 0) {
		sliderLogoReelSlider.slick({
			arrows: true,
			slidesToShow: 5,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 376,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 321,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		});
	}

	var hsPlansSlider = $('#hs-plans');
	if (hsPlansSlider.length > 0) {
		hsPlansSlider.slick({
			arrows: false,
			dots: false,
			slidesToShow: 4,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						centerMode: true,
						infinite: false
					}
				}
			]
		});
	}

	var hsWiItwmaSlider = $('#hs-wi-items');
	if (hsWiItwmaSlider.length > 0) {
		hsWiItwmaSlider.slick({
			arrows: true,
			dots: true,
			slidesToShow: 1,
			slidesToScroll: 1
		});
	}

	var stepsToPlaySlider = $('#js-steps-to-play');
	if (stepsToPlaySlider.length > 0) {
		stepsToPlaySlider.slick({
			arrows: false,
			dots: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			responsive: [{
				breakpoint: 9999,
				settings: "unslick"
			}, {
				breakpoint: 767,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					infinite: false
				}
			}]
		});
	}

	// Highlighted
	var highlighted = $('#js-highlighted');
	if (highlighted.length > 0) {
		highlighted.slick({
			arrows: false,
			dots: false,
			autoplay: true,
			speed: 1000,
			slidesToShow: 1,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 9999,
					settings: "unslick"
				}, {
					breakpoint: 767,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
						infinite: true
					}
				}, {
					breakpoint: 380,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		});
	}
});


// Subscriptions plans slider
function goToSlide(slide) {
	var slideno = slide.getAttribute('data-slide');
	jQuery('#hs-plans').slick('slickGoTo', slideno);
	jQuery('.hs-plans-tablinks').removeClass('active');
	jQuery('.hs-plans-tablinks[data-slide="' + slideno + '"]').addClass('active');
}