(function ($) {
  
  'use strict';
  
  $(document).on('click', '.single_add_to_cart_button:not(.disabled)', function(e) {
    
    const $thisbutton = $(this);
    const $form = $thisbutton.closest('form.cart');
    const data = $('input:not([name="product_id"]), select, button, textarea', $form).serializeArray() || 0;
    
    $.each(data, function (i, item) {
      if (item.name == 'add-to-cart') {
        item.name = 'product_id';
        item.value = $form.find('input[name=variation_id]').val() || $thisbutton.attr('data-product_id');
      }
    });
    
    e.preventDefault();
    
    $(document.body).trigger('adding_to_cart', [$thisbutton, data]);
    
    $.ajax({
      type: 'POST',
      url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
      data: data,
      beforeSend: function(response) {
        $thisbutton.removeClass('added').addClass('loading');
      },
      complete: function(response) {
        $thisbutton.addClass('added').removeClass('loading');
      },
      success: function(response) {
        
        // if ( ! response ) {
        // 	return;
        // }
        
        if ( response.error && response.product_url ) {
          window.location = response.product_url;
          return;
        }
        
        // Redirect to cart option
        if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
          window.location = wc_add_to_cart_params.cart_url;
          return;
        }
        
        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
        
      }
    });
    
    return false;
    
  });
  
})(jQuery);