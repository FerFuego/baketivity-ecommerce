/**
 * Class My_Account
 * @constructor
 * @param {string} My_Account
 * My_Account pages
 * Created by: Fer Catalano 
 */

/* Constructor */
function My_Account() {
    if (window.location.href.split('/')[3] === "my-account" || window.location.href.split('/')[4] === "my-account") {
        window.addEventListener('load', this.init);
    }
}

My_Account.prototype.init = function () {
    let toggle = document.querySelector('.baketivity-my-account__dashboard__breadcrumb-mobile__toggler');
    if (toggle) {
        toggle.addEventListener('click', function () {
            document.querySelector('.baketivity-my-account__dashboard__navigation').classList.toggle('active');
            document.querySelector('.baketivity-my-account__dashboard__breadcrumb-mobile__toggler').classList.toggle('active');
        });
    }
};

new My_Account();