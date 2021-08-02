jQuery(document).ready(function($) {
	
	function IsEmail( email ) {
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if( !regex.test( email ) ) {
			return false;
		} else {
			return true;
		}
	}

	var subscribeForm = $('.ld-sf');

	subscribeForm.each(function() {

		var sf = $(this).find('.ld_sf_form');
	
		sf.on( 'submit', function(e) {
			
			var email = jQuery(".email", sf).val();
			var spinner = $('span.ld-sf-spinner', sf);
			
			if ( email == "" ) {
				$('.email', sf).focus();
				console.log('Empty email field');
				return false;
			} 
			
			if( IsEmail( email ) == false ) {
				$('.email', sf).focus();
				console.log('Wrong email format');
				return false;				
			}

			sf.addClass('form-submitting');

			$.ajax({
				type: 'POST',
				url: ajax_liquid_mailchimp_form_object.ajaxurl,
				data: { 
					'action': 'add_mailchimp_user',
					'list_id': $('.list_id', sf).val(),
					'email': $('.email', sf).val(),
					'fname': $('#lname', sf).val(), 
					'lname': $('#fname', sf).val() },
				success: function(data){
					sf.removeClass('form-submitting');
					sf.nextAll( '.ld_sf_response' ).html(data);
				},
				error: function( jqXHR, textStatus, errorThrown ) {
					console.log(jqXHR.status); // I would like to get what the error is
				}
			} );

			e.preventDefault();

		});

	});
	
});