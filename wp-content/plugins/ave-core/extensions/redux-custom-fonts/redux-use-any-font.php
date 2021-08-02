<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if( class_exists( 'ReduxFramework' ) ) {
	
	class Liquid_Use_Any_Font {
		
		/**
		 * [$params description]
		 * @var array
		 */
		private $use_any_font_fonts = null;


		/**
		 * [__construct description]
		 * @method __construct
		 */
		function __construct() {

			add_filter( 'redux/liquid_one_opt/field/typography/custom_fonts', array( $this, 'add_use_any_fonts_to_redux') );

		}		
		
		/**
		 * add_typekit_fonts_to_redux
		 * @return  [arr] fonts array
		 */
		function add_use_any_fonts_to_redux( $fonts = array() ) {

			$this->use_any_font_fonts = $this->get_use_any_font_fonts_array();

			if ( empty( $this->use_any_font_fonts ) || ! is_array( $this->use_any_font_fonts ) ) {
				return $fonts;
			}

			if( isset( $fonts['Typekit Fonts'] ) ) {
				$all_fonts = array_merge( $fonts['Typekit Fonts'], $this->use_any_font_fonts );	
			} else {
				$all_fonts = $this->use_any_font_fonts;	
			}

 			$fonts_label = esc_html__( 'Custom Fonts', 'one' );
 			$fonts = array( $fonts_label => $all_fonts );
			
			return $fonts;

		}
		
		/**
		 * get_typekit_fonts_array
		 * 
		 * @param  string $kit_id optional
		 * @return [arr] fonts array
		 */
		function get_use_any_font_fonts_array() {

			$ret = array();
	        $fontsRawData = get_option( 'uaf_font_data' );
	        
			if( empty( $fontsRawData ) ) {
				return;
			}

			$fontsData = json_decode( $fontsRawData, true );
			
			if( empty( $fontsData ) ) {
				return;
			}			
			
			foreach( $fontsData as $uafont ) {
				if( isset($uafont['font_name'] ) ) {
					$slug = $uafont['font_name'];
					$name = $uafont['font_name'];
					$ret[$slug] = $name;
				}
			}

			return $ret;

		}

	}
	
	new Liquid_Use_Any_Font;
	
}