/**
 * Class Menu
 * @constructor
 * @param {string} menu
 * Add buttons to menu module
 * Created by: Fer Catalano 
 */

/* Constructor */
function Menu() {
	window.addEventListener('load', this.init);
}

Menu.prototype.init = function () {
	var menu = document.querySelector('.mobile-navigation');
	if (menu) {
		Menu.prototype.navigation_cta();
		Menu.prototype.navigation_close();
		Menu.prototype.add_search_menu_mobile();
		Menu.prototype.mobileMenu();
	}
	if (window.innerWidth < 769) {
		Menu.prototype.mobileMenuFooter();
	}
};

Menu.prototype.navigation_cta = function () {
	var menu = document.querySelector('.mobile-navigation');
	var cta = document.querySelector('.b-navbar__toggler');
	if (cta) {
		cta.addEventListener('click', function () {
			menu.classList.toggle('is-visible');
		});
	}
};

Menu.prototype.add_search_menu_mobile = function () {
	this.menu = document.querySelector('.mobile-navigation');
	var m_mobile = this.menu.querySelector('.mobile-navigation__menu-mobile');
	var li_mobile = this.menu.querySelector('#mega-menu');
	var html = '<form role="search" method="GET" class="woocommerce-product-search" action="/search/">' +
		'<input type="search" class="search-field" placeholder="Search" value="" name="search" title="Product name">' +
		'<button type="submit" value="Search"><span class="d-none" alt="accesibility">Search</span><i class="search-mobile"></i></button>' +
		'</form>';
	var search_container = document.createElement('div');
	search_container.classList.add('search-container');
	search_container.innerHTML = html;

	var li = document.createElement('li');
	li.classList.add('menu-item', 'menu-item-type-custom', 'menu-item-object-custom', 'custom-referral-link');
	var a = document.createElement('a');
	a.setAttribute('href', '/referral/');
	a.innerHTML = 'Refer a Friend';
	li.innerHTML = a.outerHTML;
	li_mobile.appendChild(li);

	m_mobile.prepend(search_container);
};

Menu.prototype.navigation_close = function () {
	var menu = document.querySelector('.mobile-navigation');
	var close = document.querySelector('.mobile-navigation__close');
	if (close) {
		close.addEventListener('click', function () {
			menu.classList.remove('is-visible');
		});
	}
};

Menu.prototype.mobileMenu = function () {
	var li = document.querySelectorAll('.mobile-navigation .has-mega-menu');
	if (li) {
		li.forEach(function (el) {
			//remove link parent Dropdown
			el.querySelector('a').setAttribute('href', '#');

			el.addEventListener('click', function (e) {
				// remove open class
				li.forEach(function (ele) {
					if (ele !== el) {
						ele.classList.remove('is-open');
						ele.querySelector('.big-menu').classList.remove('is-visible');
					}
				});
				// add open class
				el.classList.toggle('is-open');
				el.querySelector('.big-menu').classList.toggle('is-visible');
			});
		});
	}
};

// Footer
Menu.prototype.mobileMenuFooter = function () {
	var li = document.querySelectorAll('.footer-2023__menu-title');
	if (li) {
		li.forEach(function (elem) {
			elem.addEventListener('click', function () {
				// title toggle
				this.classList.toggle('open');
				// add open class
				var list = this.parentNode.querySelector('.footer-2023__menu-ul');
				list.classList.toggle('open');
			});
		});
	}
};

var menuClass = new Menu();