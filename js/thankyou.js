/* 
 * Class Thankyou
 * @constructor
 * Created by: Fer Catalano 
 */

/* Constructor */
function Thankyou () {
	if(window.location.href.split('/')[4] === "order-received") {
		window.addEventListener('load', this.init);
    }
}
	
Thankyou.prototype.init = function () {
	//Thankyou.prototype.changeLogo();	/* Change Logo Page */
	// if mobile devices
	if (window.innerWidth < 768) {
		Thankyou.prototype.mobileHeader(); /* Mobile Cart */
		Thankyou.prototype.mobileHeaderClose(); /* Mobile Cart Close */
	}
};

Thankyou.prototype.changeLogo = function () {
	var logo = document.querySelector('.custom-logo');
		logo.src = origin + '/wp-content/themes/baketivity/images/logo-red.png';
		logo.srcset = origin + '/wp-content/themes/baketivity/images/logo-red.png';
};

Thankyou.prototype.mobileHeader = function () {
	var header = document.querySelector('#masthead');
		header.classList.add('cart-mobile-header');
};

Thankyou.prototype.mobileHeaderClose = function () {
	jQuery('#masthead').after().click( function () {
		window.location.href = origin;
	});
};

var thankyou = new Thankyou();