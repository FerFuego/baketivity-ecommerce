/**
 * Referral Class
 */
function Referral() {
    if (window.location.href.split('/')[3] === "referral" || window.location.href.split('/')[3] === "new-referral") {
        window.addEventListener('load', this.init);
    }
}

Referral.prototype.init = function () {
    let a_form = document.querySelector('.aw-email-referral-form');
    let btn_submit = a_form.querySelector('button[type="submit"]');

    if (btn_submit) {
        btn_submit.addEventListener('click', function (e) {
            e.preventDefault();
            Referral.prototype.validate();
        });
    }
};

Referral.prototype.validate = function () {
    let a_form = document.querySelector('.aw-email-referral-form');
    let inputs = a_form.querySelectorAll('input.woocommerce-Input');
    let r_message = document.querySelector('#js-referral-message');
    r_message.innerHTML = '';

    if (a_form && inputs) {
        const lastItem = inputs[inputs.length - 1];
        let email = lastItem.value;
        let f_error = 0;

        if (lastItem.value == '') {
            lastItem.placeholder = 'This field is required *';
            lastItem.parentNode.classList.add('woocommerce-invalid');
            f_error++;
        }
        const validateEmail = (email) => {
            return email.match(
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
        };

        if (f_error > 0 || !validateEmail(email)) {
            r_message.innerHTML = '<p class="text-danger">Please enter a valid email.</p>';
            return false;
        }

        if (f_error == 0) {
            lastItem.parentNode.classList.remove('woocommerce-invalid');
            r_message.innerHTML = '';
            a_form.submit();
        }
    }
};

var referral = new Referral();