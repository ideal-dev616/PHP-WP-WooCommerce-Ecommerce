<?php
/**
* Gradient Params
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
 * [liquid_param_gradient description]
 * @method liquid_param_gradient
 * @param  [type]               $settings [description]
 * @param  [type]               $value    [description]
 * @return [type]                         [description]
 */
vc_add_shortcode_param( 'gradient', 'liquid_param_gradient' );
function liquid_param_gradient( $settings, $value ) {
	$output = '';

	$output .= sprintf( '<input type="text" class="hidden wpb_vc_param_value" id="%1$s" name="%1$s" value="%2$s">', $settings['param_name'], $value );
	$output .= sprintf( '<input type="text" class="hidden liquid-gradient-css">', $settings['param_name'] );
	// $output .= sprintf( '<input type="text" class="liquid-gradient-bg">', $settings['param_name'] );
	$output .= sprintf( '<select class="liquid-gradient-direction">' . 
		'<option selected value="to right">To Right</option>' .
		'<option value="to top">To Top</option>' .
		'<option value="to bottom">To Bottom</option>' .
		'<option value="to left">To Left</option>' .
		'<option value="to top left">To Top Left</option>' .
		'<option value="to top right">To Top Right</option>' .
		'<option value="to bottom right">To Bottom Right</option>' .
		'<option value="to bottom left">To Bottom Left</option>' .
	'</select>', $settings['param_name'] );
	$output .= sprintf( '<div id="%1$s-gradient" class="liquid-gradient"></div>', $settings['param_name'] );
	$output .= sprintf( '<div class="liquid-gradient-preview"><div class="liquid-gradient-preview-inner"></div></div>', $settings['param_name'] );

	return $output;
}

/**
 * [liquid_parse_gradient description]
 * @method liquid_parse_gradient
 * @param  [type]               $value [description]
 * @return [type]                      [description]
 */
function liquid_parse_gradient( $value, $return = 'array' ) {

		$css = sprintf( 'background-image:%s;%s', $value[0], $value[1] );

		return $css;

}
