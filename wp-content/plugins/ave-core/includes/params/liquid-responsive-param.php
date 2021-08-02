<?php

/**
* Liquid Responsive Param
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

if( !class_exists( 'Liquid_Responsive_Param' ) ) {

	class Liquid_Responsive_Param  {
		
		
		protected $css = null;
		
		/**
		 * @var array
		 */
		protected $positions = array( 'top', 'right', 'bottom', 'left' );

		/**
		 * @var array
		 */
		protected $devices = array( 'small', 'medium', 'large', 'all' );
		
		protected $icons = array(
			'all'   => 'vc-composer-icon vc-c-icon-layout_default',
			'small'  => 'vc-composer-icon vc-c-icon-layout_portrait-smartphones', 
			'medium'  => 'vc-composer-icon vc-c-icon-layout_portrait-tablets', 
			'large' => 'vc-composer-icon vc-c-icon-layout_landscape-tablets'
		);
		
		function __construct() {

			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param( 'liquid_responsive', array( $this, 'responsive_param' ) );
			}

		}
		
		function responsive_param( $settings, $value ) {
			
			$label = isset( $settings['label'] ) ? $settings['label'] : esc_html__( 'Responsive Parameters', 'ave-core' );
			$devices = $this->devices;
			$icons  = $this->icons;

			$values = $this->get_responsive_values( $value );
			$attribute = isset( $settings['css'] ) ? $settings['css'] : '';
			$this->css = $attribute;
			

			$output .= '<div class="liquid-responsive-container vc_css-editor vc_row vc_ui-flex-row">';
				
			
			foreach( $devices as $device ) {
				
				$output .= '<div class="liquid-main-responsive-wrapper">';
				$output .= '<h3 class="liquid-responsive-css-heading '. $device .'"><i class="' . $icons[ $device ] . '"></i> ' . $attribute . '</h3>';
				
				$output .= '<div class="liquid-inner-wrap">';
				$output .=  $this->onionLayout( $device, $values );	
				$output .= '</div>';
				$output .= '</div>';
				
			};
			
			$output .= '</div>';

			$output .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
			
			return $output;

		}

		public static function get_responsive_values( $value ) {
			return vc_parse_multi_attribute( $value, array( 'top_all' => '', 'right_all' => '', 'bottom_all' => '', 'left_all' => '','top_large' => '', 'right_large' => '', 'bottom_large' => '', 'left_large' => '', 'top_medium' => '', 'right_medium' => '', 'bottom_medium' => '', 'left_medium' => '', 'top_small' => '', 'right_small' => '', 'bottom_small' => '', 'left_small' => '' ) );
		}
		
		/**
		 * @return string
		 */
		function onionLayout( $prefix = '', $values = array() ) {

			$output = '<div class="vc_layout-onion vc_col-xs-12">'
			          . '    <div class="vc_margin">' . $this->layerControls( $this->css, $prefix, $values )
			          . '   	<div class="vc_content"><i></i></div>'
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
				$output .= '<input type="text" name="' . $pos . ( '' !== $prefix ? '_' . $prefix : '' ) . '" data-name="' . $pos . ( '' !== $prefix ? '-' . $prefix : '' ) . '" class="vc_' . $pos . '" placeholder="-" value="' .  $values['' . $pos . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] . '">';
			}

			return $output;
		
		}
		
		public static function generate_css( $css,  $value, $id = '' ) {
			
			if( empty( $value ) ){
				return;
			}

			$values = Liquid_Responsive_Param::get_responsive_values( $value );

			$resolutions = array( 'all','small', 'medium', 'large' );
			$positions = array( 'top', 'right', 'bottom', 'left' );
			
			$atts = array( $css );

			$media_query = array(
				'medium'  => '@media (min-width: 768px)',
				'large'   => '@media (min-width: 992px)',
				'all'     => '@media (min-width: 1200px)',
			);
			
			$res_css = '';
			$res_style = array( 'all' => '', 'small' => '', 'medium' => '', 'large' => '' );


			foreach( $positions as $pos ) {

				if(  isset( $values[ $pos .'_all'] ) && $values[ $pos .'_all'] != '' ) {
					if( 'border' === $css ){
						$res_style['all'] .= $css . '-' . $pos . '-width:' . $values[ $pos .'_all'] . ' !important; ';	
					}
					elseif( 'position' === $css ) {
						$res_style['all'] .= $pos . ':' . $values[ $pos .'_all'] . ' !important; ';
					}
					else {
						$res_style['all'] .= $css . '-' . $pos . ':' . $values[ $pos .'_all'] . ' !important; ';
					}
				}
				if(  isset( $values[ $pos .'_small'] ) && $values[ $pos .'_small'] != '' ) {
					if( 'border' === $css ){
						$res_style['small'] .= $css . '-' . $pos . '-width:' . $values[ $pos .'_small'] . ' !important; ';							
					}
					elseif( 'position' === $css ) {
						$res_style['small'] .= $pos . ':' . $values[ $pos .'_small'] . ' !important; ';
					}
					else {
						$res_style['small'] .= $css . '-' . $pos . ':' . $values[ $pos .'_small'] . ' !important; ';
					}
				}
				if(  isset( $values[ $pos .'_medium'] ) && $values[ $pos .'_medium'] != '' ) {
					if( 'border' === $css ){
						$res_style['medium'] .= $css . '-' . $pos . '-width:' . $values[ $pos .'_medium'] . ' !important; ';	
					}
					elseif( 'position' === $css ) {
						$res_style['medium'] .= $pos . ':' . $values[ $pos .'_medium'] . ' !important; ';
					}
					else {
						$res_style['medium'] .= $css . '-' . $pos . ':' . $values[ $pos .'_medium'] . ' !important; ';
					}
				}
				if(  isset( $values[ $pos .'_large'] ) && $values[ $pos .'_large'] != '' ) {
					if( 'border' === $css ){
						$res_style['large'] .= $css . '-' . $pos . '-width:' . $values[ $pos .'_large'] . ' !important; ';	
					}
					elseif( 'position' === $css ) {
						$res_style['large'] .= $pos . ':' . $values[ $pos .'_large'] . ' !important; ';
					}
					else {
						$res_style['large'] .= $css . '-' . $pos . ':' . $values[ $pos .'_large'] . ' !important; ';
					}
				}
			}

			if( isset( $res_style['small'] ) && $res_style['small'] !== '' ) {
				$res_css .= '.' . $id . ' {' . $res_style['small'] . ' } ';
			}
			if( isset( $res_style['medium'] ) && $res_style['medium'] !== '' ) {
				$res_css .= $media_query['medium'] . ' { '. '.' . $id . ' {' . $res_style['medium'] . ' }  } ';
			}
			if( isset( $res_style['large'] ) && $res_style['large'] !== '' ) {
				$res_css .= $media_query['large'] . ' { '. '.' . $id . ' {' . $res_style['large'] . ' }  } ';
			}
			if( isset( $res_style['all'] ) && $res_style['all'] !== '' ) {
				$res_css .= $media_query['all'] . ' { '. '.' . $id . ' {' . $res_style['all'] . ' }  } ';
			}

			return $res_css;		
		}
			
	}
	
}

new Liquid_Responsive_Param;