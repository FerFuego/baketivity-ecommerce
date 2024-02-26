/**
 * Class navbar
 * @constructor
 * @param {string} navbar
 * Add buttons to navbar module
 * Created by: Fer Catalano 
 */

/* Constructor */
if (window.location.href.split('/')[3] !== "cart" &&
    window.location.href.split('/')[4] !== "cart" &&
    window.location.href.split('/')[3] !== "checkout" &&
    window.location.href.split('/')[4] !== "checkout") {
    var initInterval = window.setInterval(navbar, 100);
}

function navbar() {
    if (window.innerWidth < 768 && jQuery('#js-user-navbar').is(':visible')) {
        navbar.prototype.init();
        clearInterval(initInterval);
    }

    if (jQuery('#js-search-navbar').is(':visible')) {
        navbar.prototype.init();
        clearInterval(initInterval);
    }
}

navbar.prototype.t = 3000;

navbar.prototype.init = function () {
    var search = document.querySelector('#js-search-navbar');
    if (search) {
        navbar.prototype.active_search_dropdown();
        navbar.prototype.close_search_dropdown();
    }

    var user = document.querySelector('#js-user-navbar');
    if (user) {
        navbar.prototype.active_user_dropdown();
    }

    var items = document.querySelectorAll('li.has-mega-menu');
    if (items) {
        navbar.prototype.active_mega_menu(items);
    }
};

navbar.prototype.active_search_dropdown = function () {
    var search = document.querySelector('#js-search-navbar');
    var module = document.querySelector('#js-module-search');
    var input = document.querySelector('#search-field');
    search.addEventListener('click', function () {
        module.classList.toggle('search-bar__active');
        input.focus();
    });
};

navbar.prototype.close_search_dropdown = function () {
    var module = document.querySelector('#js-module-search');
    var close = document.querySelector('#js-close-search');
    close.addEventListener('click', function () {
        module.classList.remove('search-bar__active');
    });
};

navbar.prototype.active_mega_menu = function (items) {
    items.forEach(function (item) {
        var item_active = false;
        //remove link parent Dropdown
        item.querySelector('a').setAttribute('href', 'javascript:void(0);');

        item.addEventListener('click', function (e) {
            // reset timeout
            clearTimeout(navbar.prototype.t);
            // show mega menu
            item.classList.toggle('mega-menu__active');
            // hide all mega menu
            item_active = item;
            navbar.prototype.hide_all_dropdown(items, item_active);
        });
        item.addEventListener('mouseleave', function () {
            navbar.prototype.t = setTimeout(function () {
                item.classList.remove('mega-menu__active');
            }, 2000);
        });
        item.addEventListener('mouseover', function () {
            clearTimeout(navbar.prototype.t);
        });
    });
};

navbar.prototype.active_user_dropdown = function () {
    var user = document.querySelector('#js-user-navbar');
    var module = document.querySelector('#js-module-user');
    // mobile
    if (window.innerWidth < 768) {
        user.addEventListener('click', function () {
            module.classList.toggle('big-menu-user__active');
            user.classList.toggle('big-menu-user__cta-active');
        });
    } else {
        user.addEventListener('click', function () {
            clearTimeout(navbar.prototype.t);
            navbar.prototype.hide_all_dropdown_user();
            module.classList.toggle('big-menu-user__active');
            user.classList.toggle('big-menu-user__cta-active');
        });
        user.addEventListener('mouseleave', function () {
            navbar.prototype.t = setTimeout(function () {
                module.classList.remove('big-menu-user__active');
                user.classList.remove('big-menu-user__cta-active');
            }, 2000);
        });
        user.addEventListener('mouseover', function () {
            clearTimeout(navbar.prototype.t);
        });
    }
};

navbar.prototype.hide_all_dropdown = function (items, item_active) {
    document.querySelector('#js-user-navbar').classList.remove('big-menu-user__cta-active');
    document.querySelector('#js-module-user').classList.remove('big-menu-user__active');
    document.querySelectorAll('.has-mega-menu').forEach(function (item) {
        if (item.id !== item_active.id) {
            item.classList.remove('mega-menu__active');
        }
    });
};

navbar.prototype.hide_all_dropdown_user = function (items, item_active) {
    document.querySelectorAll('.has-mega-menu').forEach(function (item) {
        item.classList.remove('mega-menu__active');
    });
};

var search = new navbar();