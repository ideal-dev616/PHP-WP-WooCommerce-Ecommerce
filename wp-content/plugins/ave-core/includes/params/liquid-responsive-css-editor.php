<?php
/**
* Liquid Responsive Options
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
 * [liquid_param_select_preview description]
 * @method liquid_param_select_preview
 * @param  [type]               $settings [description]
 * @param  [type]               $value    [description]
 * @return [type]                         [description]
 */
/*
vc_add_shortcode_param( 'css_responsive_editor', 'liquid_param_responsive_options' );
function liquid_param_responsive_options( $settings, $value ) {

	return 'Hi';
	
}
*/
if( ! class_exists( 'Liquid_Responsive_Css_Editor' ) ) {

	class Liquid_Responsive_Css_Editor  {
		
		/**
		 * @var array
		 */
		protected $layers = array( 'margin', 'border', 'padding', 'content' );
		/**
		 * @var array
		 */
		protected $positions = array( 'top', 'right', 'bottom', 'left' );
		/**
		 * @var array
		 */
		protected $devices = array( 'small', 'medium', 'large' );
		
		protected $icons = array( 
			'small'  => 'vc-composer-icon vc-c-icon-layout_portrait-tablets', 
			'medium' => 'vc-composer-icon vc-c-icon-layout_landscape-tablets' , 
			'large'  => 'vc-composer-icon vc-c-icon-layout_default' 
		);
		
		function __construct() {

			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param('responsive_css_editor', array( $this, 'responsive_param' ) );
			}
		}

		function responsive_param( $settings, $value ) {
			
			$label = isset( $settings['label'] ) ? $settings['label'] : esc_html__( 'Responsive Options', 'ave-core' );
			$values = $this->get_responsive_values( $value );
			$output = '<div class="liquid-responsive-css-container vc_css-editor vc_row vc_ui-flex-row">';
				
			$devices = $this->devices;
			$icons = $this->icons;
			$i = 0;

			foreach( $devices as $device ) {
				
				$output .= '<div class="liquid-main-responsive-wrapper">';
				$output .= '<h3 class="liquid-responsive-css-heading '. $device .'" title="' . $device . '"><i class="' . $icons[ $device ] . '"></i></h3>';
				$output .= '<div class="liquid-inner-wrap">';
				$output .=  $this->onionLayout( $device, $values );	
				$output .= '</div>';
				$output .= '</div>';
				
				$i++;	
			};
			
			$output .= '</div>';
			$output .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			
			return $output;
			
		}
		
		public static function get_responsive_values( $value ) {
			return vc_parse_multi_attribute( $value, array( 'margin_top_large' => '', 'margin_right_large' => '', 'margin_bottom_large' => '', 'margin_left_large' => '', 'border_top_large' => '', 'border_right_large' => '', 'border_bottom_large' => '', 'border_left_large' => '', 'padding_top_large' => '', 'padding_right_large' => '', 'padding_bottom_large' => '', 'padding_left_large' => '', 'margin_top_medium' => '', 'margin_right_medium' => '', 'margin_bottom_medium' => '', 'margin_left_medium' => '', 'border_top_medium' => '', 'border_right_medium' => '', 'border_bottom_medium' => '', 'border_left_medium' => '', 'padding_top_medium' => '', 'padding_right_medium' => '', 'padding_bottom_medium' => '', 'padding_left_medium' => '', 'margin_top_small' => '', 'margin_right_small' => '', 'margin_bottom_small' => '', 'margin_left_small' => '', 'border_top_small' => '', 'border_right_small' => '', 'border_bottom_small' => '', 'border_left_small' => '', 'padding_top_small' => '', 'padding_right_small' => '', 'padding_bottom_small' => '', 'padding_left_small' => '' ) );
		}

		/**
		 * @return string
		 */
		function onionLayout( $prefix = '', $values = array() ) {

			$output = '<div class="vc_layout-onion vc_col-xs-12">'
			          . '    <div class="vc_margin">' . $this->layerControls( 'margin', $prefix, $values )
			          . '      <div class="vc_border">' . $this->layerControls( 'border', $prefix, $values )
			          . '          <div class="vc_padding">' . $this->layerControls( 'padding', $prefix, $values )
			          . '              <div class="vc_content"><i></i></div>'
			          . '          </div>'
			          . '      </div>'
			          . '    </div>'
			          . '</div>';

			return $output;
		}
		
		/**
		 * @param $name
		 * @param string $prefix
		 *
		 * @return string
		 */
		protected function layerControls( $name, $prefix = '', $values = array() ) {

			$output = '<label>' . $name . '</label>';

			foreach ( $this->positions as $pos ) {
				$output .= '<input type="text" name="' . $name . '_' . $pos . ( '' !== $prefix ? '_' . $prefix : '' ) . '" data-name="' . $name . '-' . $pos . ( '' !== $prefix ? '-' . $prefix : '' ) . '" class="vc_' . $pos . '" placeholder="-" value="' .  $values['' . $name . '_' . $pos . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] . '">';
			}

			return $output;
		
		}
		
		public static function generate_css( $value, $id = '' ) {
			
			if( empty( $value ) ){
				return;
			}
			
			$values = Liquid_Responsive_Css_Editor::get_responsive_values( $value );
			$resolutions = array( 'small', 'medium', 'large' );
			$positions = array( 'top', 'right', 'bottom', 'left' );
			$atts = array( 'margin', 'padding', 'border' );
			$media_query = array(
				'small'  => '@media (min-width: 768px)',
				'medium'  => '@media (min-width: 992px)',
				'large' => '@media (min-width: 1200px)',
			);
			
			$res_css = '';
			$res_style = array( 'small' => '', 'medium' => '', 'large' => '' );

			foreach ( $atts as $attr ) {
				foreach( $positions as $pos ) {

					if(  isset( $values['' . $attr . '_' . $pos .'_small'] ) && $values['' . $attr . '_' . $pos .'_small'] != '' ) {
						if( 'border' === $attr ){
							$res_style['small'] .= $attr . '-' . $pos . '-width:' . $values['' . $attr . '_' . $pos .'_small'] . ' !important; ';							
						}
						else {
							$res_style['small'] .= $attr . '-' . $pos . ':' . $values['' . $attr . '_' . $pos .'_small'] . ' !important; ';	
						}
					}
					if(  isset( $values['' . $attr . '_' . $pos .'_medium'] ) && $values['' . $attr . '_' . $pos .'_medium'] != '' ) {
						if( 'border' === $attr ){
							$res_style['medium'] .= $attr . '-' . $pos . '-width:' . $values['' . $attr . '_' . $pos .'_medium'] . ' !important; ';	
						}
						else {
							$res_style['medium'] .= $attr . '-' . $pos . ':' . $values['' . $attr . '_' . $pos .'_medium'] . ' !important; ';
						}
					} 
					if(  isset( $values['' . $attr . '_' . $pos .'_large'] ) && $values['' . $attr . '_' . $pos .'_large'] != '' ) {
						if( 'border' === $attr ){
							$res_style['large'] .= $attr . '-' . $pos . '-width:' . $values['' . $attr . '_' . $pos .'_large'] . ' !important; ';	
						}
						else {
							$res_style['large'] .= $attr . '-' . $pos . ':' . $values['' . $attr . '_' . $pos .'_large'] . ' !important; ';
						}
					} 
				}
			}			

			if( isset( $res_style['small'] ) && $res_style['small'] !== '' ) {
				$res_css .= $media_query['small'] . ' { '. '.' . $id . ' {' . $res_style['small'] . ' }  } ';
			}
			if( isset( $res_style['medium'] ) && $res_style['medium'] !== '' ) {
				$res_css .= $media_query['medium'] . ' { '. '.' . $id . ' {' . $res_style['medium'] . ' }  } ';
			}
			if( isset( $res_style['large'] ) && $res_style['large'] !== '' ) {
				$res_css .= $media_query['large'] . ' { '. '.' . $id . ' {' . $res_style['large'] . ' }  } ';
			}

			return $res_css;		
		}
	}
}

new Liquid_Responsive_Css_Editor;