jQuery(document).on('click', '#nm-coupon-btn', function (event) {
    event.preventDefault();
    jQuery('.coupon').slideToggle(200);
});

jQuery(document).on('click', '#nm-gift-btn', function (event) {
    event.preventDefault();
    jQuery('div#pwgc-redeem-gift-card-form').slideToggle(200);
});

jQuery(document).on('click', '.d-default-cat.cat-item-title', function (event) {
    event.preventDefault();
    jQuery('.d-option').slideToggle(200);
});

jQuery(document).ready(function ($) {
    jQuery('a.cat-item-link.current').click(function (e) {
        e.preventDefault();
        jQuery('.d-option').slideUp(200);
    });

    // if no is cart url
    if (!jQuery('body').hasClass('woocommerce-cart') && !jQuery('body').hasClass('woocommerce-checkout')) {
        // Single Product Page
        $(document).on('click', '.plus', function (e) { // replace '.quantity' with document (without single quote)
            $input = $(this).prev('input.qty');
            var val = parseInt($input.val());
            var step = $input.attr('step');
            step = 'undefined' !== typeof (step) ? parseInt(step) : 1;
            $input.val(val + step).change();
        });
        // Single Product Page
        $(document).on('click', '.minus', function (e) { // replace '.quantity' with document (without single quote)
            $input = $(this).next('input.qty');
            var val = parseInt($input.val());
            var step = $input.attr('step');
            step = 'undefined' !== typeof (step) ? parseInt(step) : 1;
            if (val > 0) {
                $input.val(val - step).change();
            }
        });
    }

});