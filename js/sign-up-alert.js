jQuery(document).ready(function ($) {
	function toggleButton(text, status) {
		$('#sign-up-message-form input[type="submit"]')
			.val(text)
			.attr('disabled', status);
	}

	if (!getCookie('sign-up-alert')) {
		$('#sign-up-message').removeClass('display-none');
	}

	$('.sign-up-message-close').on('click', function () {
		if ($(this).data('create-cookie') == true) {
			setCookie('sign-up-alert', 'off', 7);	
		} else {
			$('#sign-up-message').removeClass('display-none');
		}

		$('.sign-up-message').addClass('display-none');
	});

});