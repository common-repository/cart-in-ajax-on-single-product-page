(function($) {
    'use strict';

		jQuery(function($) {
        if (typeof wc_add_to_cart_params === 'undefined') {
            return false;
        }
		        var cartUrl = Cartinajax.cartUrl;
		        var ViewCart = Cartinajax.viewcaer;
		
            $('form.cart').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var button = form.find('.single_add_to_cart_button');
                form.block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });

                var formData = new FormData(form[0]);
                formData.append('add-to-cart', form.find('[name=add-to-cart]').val() );
                // Ajax action.
                $.ajax({
                    url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'ace_add_to_cart' ),
                    data: formData,
                    type: 'POST',
                    processData: false,
                    contentType: false,

                    complete: function(response) {
                    if (!response) {
                        return;
                    }
                    if (response.error & response.product_url) {
                        window.location = response.product_url;
                        return;
                    }
                    $(document.body).trigger('single_add_to_cart_button', [response.fragments, response.cart_hash, button]);
                        //form.unblock();

					$('.single_add_to_cart_button').addClass("added");

					$('.single_add_to_cart_button' ).after('<a href='+cartUrl +' class="added_to_cart wc-forward" title="View cart">'+ViewCart +'</a>');
                 form.unblock();
                }
                });
            });
        });

})(jQuery);