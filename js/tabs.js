/**
 * Class tabsBaking
 * @constructor
 * @param {string} tabsBaking
 * Add event to tabs module
 * Created by: Fer Catalano 
 */

/* Constructor */
function tabsBaking () {
	window.addEventListener('load', this.init);
}

tabsBaking.prototype.init = function () {
	var tabs = document.querySelectorAll('.lets-get-baking__tab');
	if (tabs) {
        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var tab = this;
                var tabId = tab.id;
                var tabContent = document.querySelector('.lets-get-baking__tabs-content[data-tab="' + tabId + '"]');
                var shoppingContent = document.querySelector('.shopping-list[data-tab="' + tabId + '"]');
                var tabs = document.querySelectorAll('.lets-get-baking__tab');
                var tabsContent = document.querySelectorAll('.lets-get-baking__tabs-content');
                var shoppingsContent = document.querySelectorAll('.shopping-list');
                
                for (var j = 0; j < tabs.length; j++) {
                    tabs[j].classList.remove('active');
                }
                
                for (var k = 0; k < tabsContent.length; k++) {
                    tabsContent[k].classList.remove('active');
                }
                
                tab.classList.add('active');
                tabContent.classList.add('active');

                if (shoppingsContent) {
                    for (var l = 0; l < shoppingsContent.length; l++) {
                        shoppingsContent[l].classList.remove('active');
                        shoppingsContent[l].classList.add('d-none');
                    }
                    shoppingContent.classList.remove('d-none');
                    shoppingContent.classList.add('active');
                }
            });
        });
	}
};

var tabsBaking = new tabsBaking();