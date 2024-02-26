/*
 * Class Shop
 * @constructor
 * Created by: Fer Catalano
 */

/* Constructor */
function Shop() {
    if (window.location.href.split('/')[3] === "shop" ||
        window.location.href.split('/')[4] === "shop" ||
        window.location.href.split('/')[3] === "search" ||
        window.location.href.split('/')[4] === "search") {
        window.addEventListener('scroll', this.scroll);
        window.addEventListener('load', function () {
            Shop.prototype.filters();
            Shop.prototype.grid();
            Shop.prototype.mobile();
            Shop.prototype.clearAll();
            Shop.prototype.searchParams();
            Shop.prototype.modificationDOM();
            Shop.prototype.scroll();
        });
    }
}

Shop.prototype.category = [];
Shop.prototype.price = null;
Shop.prototype.sortBy = null;
Shop.prototype.type = null;
Shop.prototype.age = null;
Shop.prototype.t1 = 2000;
Shop.prototype.t2 = 2000;
Shop.prototype.t3 = 2000;
Shop.prototype.t4 = 2000;
Shop.prototype.t5 = 2000;
Shop.prototype.breadcrumb = window.innerWidth > 768 ? '#js-shop-breadcrumbs' : '#js-shop-breadcrumbs-mobile';

/* Listener Resize */
if (window.location.href.split('/')[3] === "shop" ||
    window.location.href.split('/')[4] === "shop" ||
    window.location.href.split('/')[3] === "search" ||
    window.location.href.split('/')[4] === "search") {
    window.addEventListener('resize', function () {
        // modifications
        Shop.prototype.breadcrumb = window.innerWidth > 768 ? '#js-shop-breadcrumbs' : '#js-shop-breadcrumbs-mobile';
        Shop.prototype.modificationDOM();
    });
}

Shop.prototype.scroll = function () {
    var navbar = document.querySelector(".filters-shop");
    if (!navbar) return;

    var sticky = navbar.offsetTop;
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }
};

/**
 * Filters controls
 */
Shop.prototype.filters = function () {
    var category = document.querySelector('.filter-category');
    var elem = category.querySelector('.ms-drop');
    var caret = category.querySelector('.icon-caret');
    // Category open/close
    jQuery('.filter-category button').on('click', function () {
        caret.classList.toggle('open');
        elem.classList.toggle('active');
    });

    if (window.screen.width > 769) {
        jQuery('.filter-category').on('mouseover', function () {
            // reset timeout
            clearTimeout(Shop.prototype.t1);

        }).on('mouseleave', function () {
            Shop.prototype.t1 = setTimeout(function () {
                caret.classList.remove('open');
                elem.classList.remove('active');
            }, 1000);
        });
    }

    // Category filter Change
    jQuery("input[name='selectItemsearchCategory']").change(function () {
        Shop.prototype.selectedItems();
        Shop.prototype.addSelectionBreadcrumb();
        Shop.prototype.searchBaketivityShop();
    });

    var price = document.querySelector('.filter-price');
    var elem2 = price.querySelector('.ms-drop');
    var caret2 = price.querySelector('.icon-caret');

    // Price open/close
    jQuery('.filter-price').on('click', function () {
        caret2.classList.toggle('open');
        elem2.classList.toggle('active');
    });

    if (window.screen.width > 769) {
        jQuery('.filter-price').on('mouseover', function () {
            // reset timeout
            clearTimeout(Shop.prototype.t2);

        }).on('mouseleave', function () {
            Shop.prototype.t2 = setTimeout(function () {
                caret2.classList.remove('open');
                elem2.classList.remove('active');
            }, 1000);
        });
    }

    // Price filter change
    jQuery("input[name='selectItemsearchPrice']").change(function () {
        Shop.prototype.selectedItems();
        Shop.prototype.addSelectionBreadcrumb();
        Shop.prototype.searchBaketivityShop();
        Shop.prototype.close();
    });

    var order = document.querySelector('.filter-order');
    var elem3 = order.querySelector('.ms-drop');
    var caret3 = order.querySelector('.icon-caret');

    // Sort open/close
    jQuery('.filter-order').on('click', function () {
        caret3.classList.toggle('open');
        elem3.classList.toggle('active');
    });

    if (window.screen.width < 769) {
        // Filter Outside
        var orderM = document.querySelector('.filter-order-mobile');
        var elem3M = orderM.querySelector('.ms-drop');
        jQuery('.filter-order-mobile').on('change', function () {
            elem3M.classList.remove('active');
            elem3M.classList.remove('active-dropdown');
        }).on('mouseleave', function () {
            elem3M.classList.remove('active');
            elem3M.classList.remove('active-dropdown');
        });
        window.addEventListener('scroll', function () {
            elem3M.classList.remove('active');
            elem3M.classList.remove('active-dropdown');
        });
    }

    if (window.screen.width > 769) {
        jQuery('.filter-order').on('mouseover', function () {
            // reset timeout
            clearTimeout(Shop.prototype.t3);

        }).on('mouseleave', function () {
            Shop.prototype.t3 = setTimeout(function () {
                if (window.screen.width > 769) caret3.classList.remove('open');
                elem3.classList.remove('active');
            }, 1000);
        });
    }

    // Sort filter change
    jQuery("input[name='selectItemsortBy']").change(function () {
        Shop.prototype.selectedItems();
        Shop.prototype.addSelectionBreadcrumb();
        Shop.prototype.searchBaketivityShop();
        Shop.prototype.close();
    });

    var type = document.querySelector('.filter-type');
    var elem4 = type.querySelector('.ms-drop');
    var caret4 = type.querySelector('.icon-caret');

    // Sort open/close
    jQuery('.filter-type').on('click', function () {
        caret4.classList.toggle('open');
        elem4.classList.toggle('active');
    });

    if (window.screen.width > 769) {
        jQuery('.filter-type').on('mouseover', function () {
            // reset timeout
            clearTimeout(Shop.prototype.t4);

        }).on('mouseleave', function () {
            Shop.prototype.t4 = setTimeout(function () {
                caret4.classList.remove('open');
                elem4.classList.remove('active');
            }, 1000);
        });
    }

    // Sort filter change
    jQuery("input[name='selectItemsearchType']").change(function () {
        Shop.prototype.selectedItems();
        Shop.prototype.addSelectionBreadcrumb();
        Shop.prototype.searchBaketivityShop();
        Shop.prototype.close();
    });

    var age = document.querySelector('.filter-age');
    var elem5 = age.querySelector('.ms-drop');
    var caret5 = age.querySelector('.icon-caret');

    // Sort open/close
    jQuery('.filter-age').on('click', function () {
        caret5.classList.toggle('open');
        elem5.classList.toggle('active');
    });

    if (window.screen.width > 769) {
        jQuery('.filter-age').on('mouseover', function () {
            // reset timeout
            clearTimeout(Shop.prototype.t5);

        }).on('mouseleave', function () {
            Shop.prototype.t5 = setTimeout(function () {
                caret5.classList.remove('open');
                elem5.classList.remove('active');
            }, 1000);
        });
    }

    // Sort filter change
    jQuery("input[name='selectItemsearchAge']").change(function () {
        Shop.prototype.selectedItems();
        Shop.prototype.addSelectionBreadcrumb();
        Shop.prototype.searchBaketivityShop();
        Shop.prototype.close();
    });

    // Listeners to close filters
    jQuery('#js-hero-shop').on('click', function () {
        Shop.prototype.close();
    });
    jQuery(Shop.prototype.breadcrumb).on('click', function (e) {
        Shop.prototype.close();
    });
    jQuery('.grid-shop').on('click', function (e) {
        Shop.prototype.close();
    });
};

Shop.prototype.close = function () {
    if (window.screen.width > 769) {
        // close price
        var price = document.querySelector('.filter-price');
        var elem = price.querySelector('.ms-drop');
        var caret = price.querySelector('.icon-caret');
        caret.classList.remove('open');
        elem.classList.remove('active');
        // close category
        var category1 = document.querySelector('.filter-category');
        var elem1 = category1.querySelector('.ms-drop');
        var caret1 = category1.querySelector('.icon-caret');
        caret1.classList.remove('open');
        elem1.classList.remove('active');
        // close sort
        var order = document.querySelector('.filter-order');
        var elem2 = order.querySelector('.ms-drop');
        var caret2 = order.querySelector('.icon-caret');
        caret2.classList.remove('open');
        elem2.classList.remove('active');
        // close type
        var type = document.querySelector('.filter-type');
        var elem3 = type.querySelector('.ms-drop');
        var caret3 = type.querySelector('.icon-caret');
        caret3.classList.remove('open');
        elem3.classList.remove('active');
        // close age
        var age = document.querySelector('.filter-age');
        var elem4 = age.querySelector('.ms-drop');
        var caret4 = age.querySelector('.icon-caret');
        caret4.classList.remove('open');
        elem4.classList.remove('active');
    }
};

/**
 * Slider per Product
 */
Shop.prototype.grid = function () {
    var items = document.querySelectorAll('.product-shop');
    if (items.length > 0) {
        items.forEach(function (item) {
            var slider = item.querySelector('.product-shop__ul');
            var slides = item.querySelectorAll('.product-shop__li');
            if (slides.length > 1) {
                var totalScroll = slider.scrollWidth - slider.offsetWidth;
                // hover
                item.addEventListener('mouseover', function () {
                    var prev = item.querySelector('.product-shop__control_prev');
                    prev.style.visibility = 'visible';
                    prev.addEventListener('click', function () {
                        slider.scrollLeft -= 290;
                    });
                    var next = item.querySelector('.product-shop__control_next');
                    next.style.visibility = 'visible';
                    next.addEventListener('click', function () {
                        slider.scrollLeft += 290;
                    });
                });
                // leave
                item.addEventListener('mouseleave', function () {
                    slider.scrollLeft = 0;
                    var prev = item.querySelector('.product-shop__control_prev');
                    prev.style.visibility = 'hidden';
                    var next = item.querySelector('.product-shop__control_next');
                    next.style.visibility = 'hidden';
                });
                // slider
                slider.addEventListener('scroll', function () {
                    var currentScroll = item.querySelector('.product-shop__ul').scrollLeft;
                    var prev = item.querySelector('.product-shop__control_prev');
                    var next = item.querySelector('.product-shop__control_next');
                    if (currentScroll === 0 || currentScroll < 0) {
                        prev.classList.add('inactive');
                    } else {
                        prev.classList.remove('inactive');

                        if (totalScroll === currentScroll || currentScroll > totalScroll) {
                            next.classList.add('inactive');
                        } else {
                            next.classList.remove('inactive');
                        }
                    }
                });
            }
        });
    }
};

/**
* Shop Search
*/
Shop.prototype.searchBaketivityShop = function (current) {
    var current_page = (current) ? current : jQuery('#current_page').val();
    var banner_shop = document.querySelector('.hero-shop-banner');
    var categoryComplete = [];
    var search = document.querySelector('.search-field__module');
    var action = 'get_baketivity_products'; // shop class
    var buy_with_prime = document.querySelector('.buy-with-prime');

    /* Deal of the month */
    if (banner_shop) {
        var banner_shop_category = banner_shop.attributes['data-category'].value;
        if (banner_shop && Shop.prototype.category.includes(banner_shop_category)) {
            jQuery(".hero-shop").slideUp();
            jQuery(".hero-shop-banner").slideDown();
            jQuery(".hero-shop-banner__promo").slideUp();
        } else {
            jQuery(".hero-shop").slideDown();
            jQuery(".hero-shop-banner").slideUp();
            jQuery(".hero-shop-banner__promo").slideDown('slow');
        }
    }

    /* Buy with Prime */
    if (buy_with_prime && Shop.prototype.category.includes('buy-with-prime')) {
        jQuery(".hero-shop-banner__promo").slideUp();
        jQuery(".buy-with-prime.shop").slideDown();
    } else {
        jQuery(".hero-shop-banner__promo").slideDown('slow');
        jQuery(".buy-with-prime.shop").slideUp();
    }

    if (window.location.href.split('/')[3] === "search" || window.location.href.split('/')[4] === "search") {
        action = 'search_baketivity_filters'; // search class
    }

    // append item if no into category
    if (Shop.prototype.type && !categoryComplete.includes(Shop.prototype.type)) {
        categoryComplete.push(Shop.prototype.category);
        categoryComplete.push(Shop.prototype.type);
    } else {
        categoryComplete.push(Shop.prototype.category);
    }

    var formData = new FormData();
    formData.append('action', action);
    formData.append('current_page', current_page);
    formData.append('category', categoryComplete);
    formData.append('price', Shop.prototype.price);
    formData.append('age', Shop.prototype.age);
    formData.append('sortBy', Shop.prototype.sortBy);
    if (search) formData.append('search', search.value);

    jQuery.ajax({
        cache: false,
        url: ajax.url,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            jQuery('#js-shop-filter-loader').show().html('<div class="grid-shop__loader"><span></span></div>');
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        },
        success: function (response) {
            jQuery('#js-shop-filter-loader').hide().html('');
            jQuery('#js-shop-paginator').removeClass('d-none');
            jQuery('#js-shop-grid').html(response.data.html);
            jQuery('#js-shop-paginator').html(response.data.paginator);
            Shop.prototype.grid();
        }
    });

};

/**
 * Mobile
 */
Shop.prototype.mobile = function () {
    if (window.screen.width < 769) {
        var filter = document.querySelector('#js-filter-mobile');
        var close = document.querySelector('.filters-shop__close');
        var filters_dropdown = document.querySelectorAll('.filters-shop__input');
        var apply = document.querySelector('.filters-shop__submit');
        var clear = document.querySelector('.js-shop-clear');

        if (filters_dropdown) {
            filters_dropdown.forEach(function (item) {
                item.querySelector('button').addEventListener('click', function () {
                    item.querySelector('.ms-drop').classList.toggle('active-dropdown');
                });
            });
        }

        if (filter) {
            filter.addEventListener('click', function () {
                document.querySelector('.filters-shop__mobile').classList.add('fs-active');
                document.body.classList.add("stop-scrolling");
                document.querySelector('#masthead').classList.remove('sticky');
            });
            close.addEventListener('click', function () {
                document.body.classList.remove("stop-scrolling");
                document.querySelector('.filters-shop__mobile').classList.remove('fs-active');
            });
        }

        if (apply) {
            apply.addEventListener('click', function () {
                document.body.classList.remove("stop-scrolling");
                document.querySelector('.filters-shop__mobile').classList.remove('fs-active');
            });
        }

        if (clear) {
            clear.addEventListener('click', function () {
                document.body.classList.remove("stop-scrolling");
                document.querySelector('.filters-shop__mobile').classList.remove('fs-active');
            });
        }
    }
};

/**
 * Add Selection Breadcrumb
 */
Shop.prototype.addSelectionBreadcrumb = function () {
    Shop.prototype.category = []; // clear array
    var category = document.querySelectorAll('.filter-category .ms-drop ul li');
    var price = document.querySelectorAll('.filter-price .ms-drop ul li');
    var order = document.querySelectorAll('.filter-order .ms-drop ul li');
    var type = document.querySelectorAll('.filter-type .ms-drop ul li');
    var age = document.querySelectorAll('.filter-age .ms-drop ul li');
    var clear = document.querySelector('.filters-shop__clear');
    var orderOutside = document.querySelectorAll('.filter-order-mobile .ms-drop ul li');
    var selected = document.querySelector(Shop.prototype.breadcrumb);
    selected.innerHTML = '';

    category.forEach(function (item) {
        if (item.classList.contains('selected')) {
            var input = item.querySelector('input');
            var spanOrigin = item.querySelector('span').innerHTML;
            var label = input.value.replace('-', ' ').replace('_', ' ');
            var slug = input.value;
            if (label.length > 0) {
                Shop.prototype.category.push(slug);
                var span = document.createElement('span');
                span.setAttribute('slug', slug);
                span.setAttribute('type', 'searchCategory');
                span.innerHTML = spanOrigin;
                selected.appendChild(span);
            }
        }
    });

    price.forEach(function (item) {
        if (item.classList.contains('selected')) {
            var input = item.querySelector('input');
            var spanOrigin = item.querySelector('span').innerHTML;
            var label = input.value.replace('-', ' ').replace('_', ' ');
            var slug = input.value;
            if (label.length > 0) {
                Shop.prototype.price = slug;
                var span = document.createElement('span');
                span.setAttribute('slug', slug);
                span.setAttribute('type', 'searchPrice');
                span.innerHTML = spanOrigin;
                selected.appendChild(span);
            }
        }
    });

    type.forEach(function (item) {
        if (item.classList.contains('selected')) {
            var input = item.querySelector('input');
            var spanOrigin = item.querySelector('span').innerHTML;
            var label = input.value.replace('-', ' ').replace('_', ' ');
            var slug = input.value;
            if (label.length > 0) {
                Shop.prototype.type = slug;
                var span = document.createElement('span');
                span.setAttribute('slug', slug);
                span.setAttribute('type', 'searchType');
                span.innerHTML = spanOrigin;
                selected.appendChild(span);
            }
        }
    });

    age.forEach(function (item) {
        if (item.classList.contains('selected')) {
            var input = item.querySelector('input');
            var spanOrigin = item.querySelector('span').innerHTML;
            var label = input.value.replace('-', ' ').replace('_', ' ');
            var slug = input.value;
            if (label.length > 0) {
                Shop.prototype.age = slug;
                var span = document.createElement('span');
                span.setAttribute('slug', slug);
                span.setAttribute('type', 'searchAge');
                span.innerHTML = spanOrigin;
                selected.appendChild(span);
            }
        }
    });

    if (selected.innerHTML.length > 0 && window.innerWidth > 769) {
        selected.prepend('Filtered by:   ');
    }

    order.forEach(function (item) {
        if (item.classList.contains('selected')) {
            var input = item.querySelector('input');
            var spanOrigin = item.querySelector('span').innerHTML;
            var label = input.value.replace('-', ' ').replace('_', ' ');
            var slug = input.value;
            if (label.length > 0) {
                Shop.prototype.sortBy = slug;
                var div = document.createElement('div');
                div.setAttribute('slug', slug);
                var span = document.createElement('span');
                span.setAttribute('slug', slug);
                span.setAttribute('type', 'sortBy');
                span.innerHTML = spanOrigin;
                div.innerHTML = 'Sorted by:   ';
                div.appendChild(span);
                selected.appendChild(div);
            }
        }
    });

    orderOutside.forEach(function (item) {
        if (item.classList.contains('selected')) {
            var input = item.querySelector('input');
            var spanOrigin = item.querySelector('span').innerHTML;
            var label = input.value.replace('-', ' ').replace('_', ' ');
            var slug = input.value;
            if (label.length > 0) {
                Shop.prototype.sortBy = slug;
                var div = document.createElement('div');
                div.setAttribute('slug', slug);
                var span = document.createElement('span');
                span.setAttribute('slug', slug);
                span.setAttribute('type', 'sortBy');
                span.innerHTML = spanOrigin;
                div.innerHTML = 'Sorted by:   ';
                div.appendChild(span);
                selected.appendChild(div);
            }
        }
    });

    selected.classList.add('active');

    if (clear) clear.classList.add('active');
    Shop.prototype.removeFilter();
    //Shop.prototype.addParamsToUrl();
    Shop.prototype.domCountfilters();
};

/**
 * Add class selected to filter
 */
Shop.prototype.selectedItems = function () {

    var boxes1 = jQuery("input[name='selectItemsearchCategory']");
    if (boxes1.length > 0) {
        boxes1.each(function (item) {
            if (jQuery(this).is(':checked')) {
                jQuery(this).parent().parent().addClass('selected'); // add class to parent node
            } else {
                jQuery(this).parent().parent().removeClass('selected'); // remove class from parent node
            }
        });
    }

    var boxes2 = jQuery("input[name='selectItemsearchPrice']");
    if (boxes2.length > 0) {
        boxes2.each(function () {
            if (jQuery(this).is(':checked')) {
                jQuery(this).parent().parent().addClass('selected'); // add class to parent node
            } else {
                jQuery(this).parent().parent().removeClass('selected'); // remove class from parent node
            }
        });
    }

    var boxes3 = jQuery("input[name='selectItemsortBy']");
    if (boxes3.length > 0) {
        boxes3.each(function () {
            if (jQuery(this).is(':checked')) {
                jQuery(this).parent().parent().addClass('selected'); // add class to parent node
            } else {
                jQuery(this).parent().parent().removeClass('selected'); // remove class from parent node
            }
        });
    }

    var boxes4 = jQuery("input[name='selectItemsearchType']");
    if (boxes4.length > 0) {
        boxes4.each(function () {
            if (jQuery(this).is(':checked')) {
                jQuery(this).parent().parent().addClass('selected'); // add class to parent node
            } else {
                jQuery(this).parent().parent().removeClass('selected'); // remove class from parent node
            }
        });
    }

    var boxes5 = jQuery("input[name='selectItemsearchAge']");
    if (boxes5.length > 0) {
        boxes5.each(function () {
            if (jQuery(this).is(':checked')) {
                jQuery(this).parent().parent().addClass('selected'); // add class to parent node
            } else {
                jQuery(this).parent().parent().removeClass('selected'); // remove class from parent node
            }
        });
    }

};

/**
 * Remove and unselect all filters
 */
Shop.prototype.removeFilter = function () {
    var selected = document.querySelectorAll(Shop.prototype.breadcrumb + ' span');
    selected.forEach(function (item) {
        item.addEventListener('click', function () {
            var type = item.getAttribute('type');
            var slug = item.getAttribute('slug');
            document.querySelectorAll('#' + type + ' input').forEach(function (item) {
                if (item.value == slug) {
                    item.checked = false; // unselect
                    item.parentElement.parentElement.classList.remove('selected'); // remove class from menu checkboxes

                    // remove item from global vars
                    if (type == 'searchCategory') {
                        Shop.prototype.category = Shop.prototype.category.filter(function (item) {
                            return item !== slug;
                        });
                    } else if (type == 'searchPrice') {
                        Shop.prototype.price = null;
                    } else if (type == 'sortBy') {
                        Shop.prototype.sortBy = null;
                        /* Unselect sortByOutside */
                        document.querySelectorAll('#sortByOutside input').forEach(function (item) {
                            item.checked = false;
                            item.parentNode.parentNode.classList.remove('selected');
                        });
                    } else if (type == 'searchType') {
                        Shop.prototype.type = null;
                    } else if (type == 'searchAge') {
                        Shop.prototype.age = null;
                    }
                }
            });
            // remove pill
            item.remove();
            // search again
            Shop.prototype.searchBaketivityShop();

            var filter = document.querySelector(Shop.prototype.breadcrumb);

            // check if there are no more filters
            if (Shop.prototype.price == null && Shop.prototype.sortBy == null && Shop.prototype.category.length == 0 && Shop.prototype.type == null && Shop.prototype.age == null) {
                filter.innerHTML = '';
                filter.classList.remove('active');
            }
            // remove sort by label if no filters
            if (Shop.prototype.sortBy == null) {
                var div = document.querySelector(Shop.prototype.breadcrumb + ' div');
                if (div) div.remove();
            }
            //Shop.prototype.addParamsToUrl();
            Shop.prototype.domCountfilters();
        });
    });
};

/**
 * Clear All
 */
Shop.prototype.clearAll = function () {
    var clear = document.querySelectorAll('.js-shop-clear');
    if (clear) {
        clear.forEach(function (cls) {
            cls.addEventListener('click', function () {
                var filter = document.querySelector(Shop.prototype.breadcrumb);
                filter.innerHTML = '';
                filter.classList.remove('active');
                document.querySelectorAll('.filter-category .ms-drop ul li').forEach(function (item) {
                    item.classList.remove('selected');
                });
                document.querySelectorAll('.filter-price .ms-drop ul li').forEach(function (item) {
                    item.classList.remove('selected');
                });
                document.querySelectorAll('.filter-order .ms-drop ul li').forEach(function (item) {
                    item.classList.remove('selected');
                });
                document.querySelectorAll('.filter-type .ms-drop ul li').forEach(function (item) {
                    item.classList.remove('selected');
                });
                document.querySelectorAll('.filter-age .ms-drop ul li').forEach(function (item) {
                    item.classList.remove('selected');
                });
                document.querySelectorAll(Shop.prototype.breadcrumb + ' span').forEach(function (item) {
                    item.remove();
                });
                document.querySelectorAll('.filter-category .ms-drop ul li input').forEach(function (item) {
                    item.checked = false;
                });
                document.querySelectorAll('.filter-price .ms-drop ul li input').forEach(function (item) {
                    item.checked = false;
                });
                document.querySelectorAll('.filter-order .ms-drop ul li input').forEach(function (item) {
                    item.checked = false;
                });
                document.querySelectorAll('.filter-type .ms-drop ul li input').forEach(function (item) {
                    item.checked = false;
                });
                document.querySelectorAll('.filter-age .ms-drop ul li input').forEach(function (item) {
                    item.checked = false;
                });
                if (window.screen.width < 768) document.querySelector('.filters-shop__mobile').classList.remove('fs-active');
                if (window.screen.width > 769) document.querySelector('.filters-shop__clear').classList.remove('active');
                // hide categories
                var category = document.querySelector('.filter-category');
                var elem1 = category.querySelector('.ms-drop');
                var caret1 = category.querySelector('.icon-caret');
                if (window.screen.width > 769) caret1.classList.remove('open');
                if (window.screen.width > 769) elem1.classList.remove('active');
                // hide price
                var price = document.querySelector('.filter-price');
                var elem2 = price.querySelector('.ms-drop');
                var caret2 = price.querySelector('.icon-caret');
                if (window.screen.width > 769) caret2.classList.remove('open');
                if (window.screen.width > 769) elem2.classList.remove('active');
                // hide order
                var order = document.querySelector('.filter-order');
                var elem3 = order.querySelector('.ms-drop');
                if (window.screen.width > 769) {
                    var caret3 = order.querySelector('.icon-caret');
                    caret3.classList.remove('open');
                    elem3.classList.remove('active');
                }
                // reset global vars
                Shop.prototype.category = [];
                Shop.prototype.price = null;
                Shop.prototype.sortBy = null;
                Shop.prototype.type = null;
                Shop.prototype.age = null;
                // search again
                Shop.prototype.searchBaketivityShop();
                // update count filters
                Shop.prototype.domCountfilters();
            });
        });
    }
};

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
        function (m, key, value) {
            vars[key] = value;
        });
    return vars;
}

/**
 * Search Baketivity Shop
 * @param {string} query vars
 */
Shop.prototype.searchParams = function () {
    // Page load with params /shop/:params
    var url = window.location.href;
    var tabUrl = url.split('/')[3];
    var params = url.split('/')[4];
    params = decodeURIComponent((params + '').replace(/\+/g, '%20'));

    if ((tabUrl === 'shop') && params !== '') {
        if (getUrlVars().cat) {
            Shop.prototype.category = getUrlVars().cat.toString().split(",");
        } else {
            Shop.prototype.category = [];
        }

        if (getUrlVars().price) {
            Shop.prototype.price = getUrlVars().price;
        } else {
            Shop.prototype.price = null;
        }

        if (getUrlVars().sort) {
            Shop.prototype.sortBy = getUrlVars().sort;
        } else {
            Shop.prototype.sortBy = null;
        }

        Shop.prototype.addUrltoBreadcrumb();
        //Shop.prototype.searchBaketivityShop();
    }
};

/**
 * Add Selection Breadcrumb from URL
 */
Shop.prototype.addUrltoBreadcrumb = function () {
    var category = document.querySelectorAll('.filter-category .ms-drop ul li');
    var price = document.querySelectorAll('.filter-price .ms-drop ul li');
    var order = document.querySelectorAll('.filter-order .ms-drop ul li');
    var type = document.querySelectorAll('.filter-type .ms-drop ul li');
    var age = document.querySelectorAll('.filter-age .ms-drop ul li');
    var clear = document.querySelector('.filters-shop__clear');
    var selected = document.querySelector(Shop.prototype.breadcrumb);
    selected.innerHTML = '';

    category.forEach(function (item) {
        var input = item.querySelector('input');
        var spanOrigin = item.querySelector('span').innerHTML;
        var slug = input.value;
        if (Shop.prototype.category.includes(slug)) {
            item.classList.add('selected');
            input.checked = true;
            var span = document.createElement('span');
            span.setAttribute('slug', slug);
            span.setAttribute('type', 'searchCategory');
            span.innerHTML = spanOrigin;
            selected.appendChild(span);
        }
    });

    price.forEach(function (item) {
        var input = item.querySelector('input');
        var spanOrigin = item.querySelector('span').innerHTML;
        var slug = input.value;
        if (slug === Shop.prototype.price) {
            item.classList.add('selected');
            input.checked = true;
            var span = document.createElement('span');
            span.setAttribute('slug', slug);
            span.setAttribute('type', 'searchPrice');
            span.innerHTML = spanOrigin;
            selected.appendChild(span);
        }
    });

    type.forEach(function (item) {
        var input = item.querySelector('input');
        var spanOrigin = item.querySelector('span').innerHTML;
        var slug = input.value;
        if (slug === Shop.prototype.type) {
            item.classList.add('selected');
            input.checked = true;
            var span = document.createElement('span');
            span.setAttribute('slug', slug);
            span.setAttribute('type', 'searchType');
            span.innerHTML = spanOrigin;
            selected.appendChild(span);
        }
    });

    age.forEach(function (item) {
        var input = item.querySelector('input');
        var spanOrigin = item.querySelector('span').innerHTML;
        var slug = input.value;
        if (slug === Shop.prototype.age) {
            item.classList.add('selected');
            input.checked = true;
            var span = document.createElement('span');
            span.setAttribute('slug', slug);
            span.setAttribute('type', 'searchAge');
            span.innerHTML = spanOrigin;
            selected.appendChild(span);
        }
    });

    if (selected.innerHTML.length > 0) {
        selected.prepend('Filtered by  ');
    }

    order.forEach(function (item) {
        var input = item.querySelector('input');
        var spanOrigin = item.querySelector('span').innerHTML;
        var slug = input.value;
        if (slug === Shop.prototype.sortBy) {
            item.classList.add('selected');
            input.checked = true;
            var div = document.createElement('div');
            div.setAttribute('slug', slug);
            var span = document.createElement('span');
            span.setAttribute('slug', slug);
            span.setAttribute('type', 'sortBy');
            span.innerHTML = spanOrigin;
            div.innerHTML = 'Sorted by   ';
            div.appendChild(span);
            selected.appendChild(div);
        }
    });

    selected.classList.add('active');
    if (clear) clear.classList.add('active');
    Shop.prototype.removeFilter();
};

/**
 * Add Params to URL
 */
Shop.prototype.addParamsToUrl = function () {
    var url = window.location.href;
    var tabUrl = url.split('/')[3];
    var params = url.split('/')[4];
    params = decodeURIComponent((params + '').replace(/\+/g, '%20'));
    var newParams = '';
    var newUrl = '';

    if (Shop.prototype.category.length > 0) {
        newParams += 'cat=' + Shop.prototype.category;
    } else {
        newParams += 'cat=';
        newParams = newParams.replace('cat=null', '');
        newParams = newParams.replace('cat=', '');
    }
    if (Shop.prototype.price !== null) {
        newParams += '&price=' + Shop.prototype.price;
    } else {
        newParams += '&price=';
        newParams = newParams.replace('&price=null', '');
        newParams = newParams.replace('&price=', '');

    }
    if (Shop.prototype.sortBy !== null) {
        newParams += '&sort=' + Shop.prototype.sortBy;
    } else {
        newParams += '&sort=';
        newParams = newParams.replace('&sort=null', '');
        newParams = newParams.replace('&sort=', '');
    }

    if (newParams.length > 0) {
        newUrl = '/shop/?' + newParams;
    } else {
        newUrl = '/shop/';
    }

    if (tabUrl === 'shop') {
        window.history.pushState('', '', newUrl);
    }
};

/**
* Update count filters
*/
Shop.prototype.domCountfilters = function () {
    if (window.innerWidth < 769) {
        var filters = document.querySelectorAll(Shop.prototype.breadcrumb + ' span');
        var totalFilters = filters.length;
        var domCountfilters = document.querySelector('.filters-shop__count-filters');
        domCountfilters.innerHTML = '';
        if (totalFilters > 0) {
            domCountfilters.innerHTML = '(' + totalFilters + ')';
        }
    }
};

Shop.prototype.modificationDOM = function () {
    var category = document.querySelector('.filter-category');
    var placeholderCat = category.querySelector('.placeholder');
    var age = document.querySelector('.filter-age');
    var placeholderAge = age.querySelector('.placeholder');
    var range = document.querySelector('.filter-price');
    var placeholderRan = range.querySelector('.placeholder');

    if (window.innerWidth > 768) {
        placeholderCat.innerHTML = 'Shop by Category';
        placeholderAge.innerHTML = 'Filter by Age';
        placeholderRan.innerHTML = 'Filter by Price';
    }

    if (window.innerWidth < 769) {
        placeholderCat.innerHTML = 'Category';
        placeholderAge.innerHTML = 'Age';
        placeholderRan.innerHTML = 'Price Range';
    }
};

var shop = new Shop();