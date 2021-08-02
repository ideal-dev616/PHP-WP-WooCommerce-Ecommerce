(function( $ ) {
	'use strict';

	$(document).on( 'click', '.liquid-post-like', function(){

		var button = $(this),
			post_id = button.attr('data-id'),
			security = button.attr('data-security');

		if( '' === post_id ) {
			return false;
		}

		$.ajax({
			type: 'POST',
			url: liquidTheme.uris.ajax,
			data : {
				action : 'save_post_like',
				post_id : post_id,
				nonce : security
			},
			beforeSend:function() {
				button.append('<div class="like-loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
			},
			complete: function() {
				button.find('.like-loader').remove();
			},
			success: function(response) {

				if( ! response ) {
					return;
				}

				if( 'unliked' === response.status ) {
					button.parent().removeClass('liked');
					button.find('.post-likes-count').text(response.likes);
				}
				else {
					button.parent().addClass('liked');
					button.find('.post-likes-count').text(response.likes);
				}
			}
		});

		return false;
	});
})( jQuery );
