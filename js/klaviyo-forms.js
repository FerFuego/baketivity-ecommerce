/* 
 * Class Baketivity_Klaviyo
 * @constructor
 * Created by: Fer Catalano 
 */

/* Constructor */
function Baketivity_Klaviyo () {
	window.addEventListener('load', this.init);
}

Baketivity_Klaviyo.prototype.init = function () {
    if( document.querySelector('#kla_embed_klaviyo_emailsignup_widget--1')) {
        KlaviyoSubscribe.attachToForms("#kla_embed_klaviyo_emailsignup_widget--1", {
            hide_form_on_success: true
        });
    }
    if( document.querySelector('#kla_embed_klaviyo_emailsignup_widget--3')) {
        KlaviyoSubscribe.attachToForms("#kla_embed_klaviyo_emailsignup_widget--3", {
            hide_form_on_success: true
        });
    }
    if( document.querySelector('#kla_embed_klaviyo_emailsignup_widget--5')) {
        KlaviyoSubscribe.attachToForms('#kla_embed_klaviyo_emailsignup_widget--5', {
            hide_form_on_success: true,
            custom_success_message: true
        });
    }
    if( document.querySelector('#kla_embed_klaviyo_emailsignup_widget--10')) {
        KlaviyoSubscribe.attachToForms("#kla_embed_klaviyo_emailsignup_widget--10", {
            hide_form_on_success: true,
            custom_success_message: true
        });
    }
    if( document.querySelector('#kla_embed_klaviyo_emailsignup_widget--13')) {
        KlaviyoSubscribe.attachToForms("#kla_embed_klaviyo_emailsignup_widget--13", {
            hide_form_on_success: true,
            custom_success_message: true
        });
    }
    if( document.querySelector('#kla_embed_klaviyo_emailsignup_widget--14')) {
        KlaviyoSubscribe.attachToForms("#kla_embed_klaviyo_emailsignup_widget--14", {
            hide_form_on_success: true,
            custom_success_message: true
        });
    }
    if( document.querySelector('#kla_embed_klaviyo_emailsignup_widget--footer')) {
        KlaviyoSubscribe.attachToForms("#kla_embed_klaviyo_emailsignup_widget--footer", {
            hide_form_on_success: true
        });
    }
};

var baketivityKlaviyoClass = new Baketivity_Klaviyo();