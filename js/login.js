/**
 * Ajax Login
 * Created by: Fer Catalano 
 */

/* Constructor */
if (window.location.href.split('/')[3] == "my-account" ||
    window.location.href.split('/')[4] == "my-account" ||
    window.location.href.split('/')[3] == "checkout" ||
    window.location.href.split('/')[4] == "checkout") {
    var initIntervalLogin = window.setInterval(Login, 100);
}

function Login() {
    if (jQuery('#js-login').is(':visible')) {
        Login.prototype.init();
        Login.prototype.searchParams();
        Login.prototype.login();
        clearInterval(initIntervalLogin);
    }
}

Login.prototype.init = function () {
    var username = getParameterByName('username');
    if (username !== undefined) {
        jQuery('#username').val(username);
        var redirect = jQuery('#redirect').val();
    }

    var btnRegister = document.querySelector('#js-register-section');
    if (btnRegister) {
        Login.prototype.registerCTA(btnRegister);
    }

    var btnLogin = document.querySelector('#js-login-section');
    if (btnLogin) {
        Login.prototype.loginCTA(btnLogin);
    }

    var email = document.querySelector('#reg_email');
    if (email) {
        Login.prototype.validateEmail(email);
        email.addEventListener('keyup', function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                if (email.value == '') {
                    email.placeholder = 'This field is required *';
                    email.classList.add('is-invalid');
                } else {
                    document.querySelector('#firstname').focus();
                    email.classList.remove('is-invalid');
                }
            }
        });
    }

    var firstname = document.querySelector('#firstname');
    if (firstname) {
        firstname.addEventListener('keyup', function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                if (firstname.value == '') {
                    firstname.placeholder = 'This field is required *';
                    firstname.classList.add('is-invalid');
                } else {
                    document.querySelector('#lastname').focus();
                    firstname.classList.remove('is-invalid');
                }
            }
        });
    }

    var lastname = document.querySelector('#lastname');
    if (lastname) {
        lastname.addEventListener('keyup', function (event) {
            if (lastname.value !== '') {
                lastname.classList.remove('is-invalid');
                // activate button remove attr disabled
                var btnSubmit = document.querySelector('#js-register');
                btnSubmit.removeAttribute('disabled');
            }
            if (event.keyCode === 13) {
                event.preventDefault();
                if (lastname.value == '') {
                    lastname.placeholder = 'This field is required *';
                    lastname.classList.add('is-invalid');
                }
            }
        });
    }

    if (username) {
        username.addEventListener('keyup', function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                if (username.value == '') {
                    username.placeholder = 'This field is required *';
                    username.classList.add('is-invalid');
                } else {
                    document.querySelector('#password').focus();
                    username.classList.remove('is-invalid');
                }
            }
        });
    }

    var password = document.querySelector('#password');
    if (password) {
        password.addEventListener('keyup', function (event) {
            if (password.value !== '') {
                password.classList.remove('is-invalid');
                // activate button remove attr disabled
                var btnSubmit = document.querySelector('#js-login');
                btnSubmit.removeAttribute('disabled');
            }

            if (event.keyCode === 13) {
                event.preventDefault();
                if (password.value == '') {
                    password.classList.add('is-invalid');
                    password.placeholder = 'This field is required *';
                }
            }
        });
    }
};

Login.prototype.login = function () {
    var btnSubmit = document.querySelector('#js-login');
    if (btnSubmit) {
        btnSubmit.addEventListener('click', function (event) {

            event.preventDefault();

            var username = document.querySelector('#username');
            var password = document.querySelector('#password');

            if (username.value == '') {
                username.placeholder = 'This field is required *';
                username.classList.add('is-invalid');
            }

            if (password.value == '') {
                password.classList.add('is-invalid');
                password.placeholder = 'This field is required *';
            }

            if (username.value == '' || password.value == '') return;

            var formData = new FormData();
            formData.append('action', 'baketivity_login');
            formData.append('username', jQuery('#username').val());
            formData.append('password', jQuery('#password').val());
            formData.append('rememberme', jQuery('#rememberme').val());

            jQuery.ajax({
                cache: false,
                url: ajax.url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    // checkout page
                    btnSubmit.classList.add('disabled');
                    btnSubmit.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
                },
                success: function (response) {
                    // Checkout page
                    btnSubmit.classList.remove('disabled');
                    btnSubmit.innerHTML = 'Sign in';

                    if (response.success == true) {
                        // login page
                        jQuery("#js-register-messageForm").html('<p class="text-success">' + response.data.message + '</p>');
                        // checkout page
                        jQuery("#js-login-messageForm").html('<p class="text-success">' + response.data.message + '</p>');
                        window.location.hash = '#';
                        location.reload();
                    } else {
                        // login page
                        jQuery("#js-register-messageForm").html('<p class="text-danger">' + response.data.message + '</p>');
                        // checkout page
                        jQuery("#js-login-messageForm").html('<p class="text-danger">' + response.data.message + '</p>');
                    }
                }
            });
            return false;
        });
    }
};

Login.prototype.register = function () {
    var formRegister = document.querySelector('#js-register-form');
    var btnSubmit = document.querySelector('#js-register');
    if (btnSubmit) {
        btnSubmit.addEventListener('click', function (event) {

            event.preventDefault();

            var email = document.querySelector('#reg_email');
            var firstname = document.querySelector('#firstname');
            var lastname = document.querySelector('#lastname');

            if (email.value == '') {
                email.placeholder = 'This field is required *';
                email.classList.add('is-invalid');
            }

            if (firstname.value == '') {
                firstname.placeholder = 'This field is required *';
                firstname.classList.add('is-invalid');
            }

            if (lastname.value == '') {
                lastname.classList.add('is-invalid');
                lastname.placeholder = 'This field is required *';
            }

            if (email.value == '' || firstname.value == '' || lastname.value == '') return;

            // Custom register
            /* var formData = new FormData();
                formData.append('action', 'baketivity_register' );
                formData.append('email', email );
                formData.append('firstname', firstname );
                formData.append('lastname', lastname );
                formData.append('rememberme', jQuery('#rememberme').val() );

            jQuery.ajax({
                cache: false,
                url: ajax.url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    jQuery("#js-register-messageForm").fadeIn('fast');
                    jQuery("#js-register-messageForm").html('<p class="text-info">sending....</p>');
                },
                success: function ( response ) {
                    if ( response.success == true ) {
                        jQuery("#js-register-messageForm").html('<p class="text-success">' + response.data.message + '</p>');
                        window.location.hash = '#';
                        location.reload();
                    } else {
                        jQuery("#js-register-messageForm").html('<p class="text-danger">' + response.data.message + '</p>');
                    }
                }
            }); */

            // Default submit # not working
            formRegister.submit();
        });
    }
};

Login.prototype.registerCTA = function (btnRegister) {
    btnRegister.addEventListener('click', function (e) {
        e.preventDefault();
        jQuery(this).parents('.baketivity-my-account__login-page__login-section').hide();
        var data = jQuery(this).attr('href');
        jQuery(data).show();
    });
};

Login.prototype.loginCTA = function (btnLogin) {
    btnLogin.addEventListener('click', function (e) {
        e.preventDefault();
        jQuery(this).parents('.baketivity-my-account__login-page__register-section').hide();
        var data = jQuery(this).attr('href');
        jQuery(data).show();
    });
};

Login.prototype.validateEmail = function (input) {
    input.addEventListener('keyup', function (event) {
        var re = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
        if (!re.test(input.value)) {
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    });
};

Login.prototype.searchParams = function () {
    var url = window.location.href;
    var tabUrl = url.split('#');

    if (tabUrl[1] === 'register-section') {
        jQuery('#login-section').hide();
        jQuery('#register-section').show();
    }
};

// Switch show password
function showPassword(eye, id) {
    var x = document.getElementById(id);
    if (x.type === "password") {
        x.type = "text";
        jQuery(eye).addClass('baketivity-my-account__login-page__eye--open').removeClass('baketivity-my-account__login-page__eye--close');
    } else {
        x.type = "password";
        jQuery(eye).addClass('baketivity-my-account__login-page__eye--close').removeClass('baketivity-my-account__login-page__eye--open');
    }
}

var login = new Login();