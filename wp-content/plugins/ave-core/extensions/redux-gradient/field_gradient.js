(function( $ ) {
	"use strict";
	
	redux.field_objects = redux.field_objects || {};
	redux.field_objects.gradient = redux.field_objects.gradient || {};
	
	redux.field_objects.gradient.init = function( selector, skipCheck) {
		
		if ( !selector ) {
			selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-gradient:visible' );
		}
		
		var $css = selector.find('.liquid-gradient-css'),
			$field = selector.find('.regular-text'),
			value = $field.val(),
			element = selector.find('.liquid-gradient'),
			gradientDir = element.siblings('.liquid-gradient-direction');

		var gp = new Grapick({
			el: element.get(0),
			height: '40px',
			colorEl: '<input id="colorpicker"/>'
		});

		gp.setColorPicker(function(handler) {
			
			var el = handler.getEl().querySelector('#colorpicker');
	
			$(el).spectrum({
				color: handler.getColor(),
				preferredFormat: "hex",
				showAlpha: true,
				showInput: true,
				showPalette: true,
				palette: [
					['#3ed2a7', '#ffb09f']
				],
				containerClassName: 'liquid-gradient-picker-container',
				replacerClassName: 'liquid-gradient-picker-replacer',
				change(color) {
					handler.setColor(color.toRgbString());
				},
				move(color) {
					handler.setColor(color.toRgbString(), 0);
				}
			});

		});

		gp.addHandler(0, '#4fda91');
		gp.addHandler(100, '#34dbc5');

		function update() {

			$(gp.el).siblings('.liquid-gradient-css').val(gp.getSafeValue());
			$field.val(gp.getSafeValue());
			$(gp.el).siblings('.liquid-gradient-preview').children('.liquid-gradient-preview-inner').css('background-image', gp.getSafeValue());

		}

		update();

		gradientDir.on('change', function(e) {

			var value = this.options[this.selectedIndex].value;

			gp.setDirection(value);

		});

		gp.on('change', update );

		if ('undefined' !== typeof value) {

			var val = $field.val();
			
			gp.setValue(value);

		}
		
		// if( 'undefined' !== typeof value && '' !== value ) {
		// 	value = value.split('|');
		// 	bg = '{"' + value[1].replace(/: /g, '":"').replace(/;/g,'","').slice(0,-2) + '}';
			
		// 	startingGradient = value[0];
		// 	startingBgProps = JSON.parse(bg);
		// }
		
		// var options = {
		// 	interface: [ 'gradient', 'background' ],
		// 	targetInputElement: $css,
		// 	targetBgInputElement: $bg,
		// 	startingGradient: startingGradient,
		// 	startingBgProps: startingBgProps
		// };
		
		// selector.find('.liquid-gradient').icsge(options);
		// selector.find('.liquid-gradient-css').on( 'change', function(){
			
		// 	var val = $css.val();

		// 	$field.val(val);

		// });

	};
	
})( jQuery );
