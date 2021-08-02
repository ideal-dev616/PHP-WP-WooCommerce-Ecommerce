<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if( class_exists( 'ReduxFramework' ) ) {
	
	class Liquid_Custom_Fonts {
		
		/**
		 * [$params description]
		 * @var array
		 */
		private $liquid_custom_fonts = null;
		
		
		/**
		 * [$params description]
		 * @var array
		 */
		private $liquid_custom_fonts_woff2 = null;
		
		/**
		 * [$params description]
		 * @var array
		 */
		private $liquid_custom_fonts_woff = null;
		
		/**
		 * [$params description]
		 * @var array
		 */
		private $liquid_custom_fonts_ttf = null;

		/**
		 * [$params description]
		 * @var array
		 */
		private $liquid_custom_fonts_weight = null;
		

		/**
		 * [__construct description]
		 * @method __construct
		 */
		function __construct() {
			
			add_action( 'redux/loaded', array( $this, 'get_custom_fonts' ) );
			//add_action( 'init', array( $this, 'add_font_face_css' ) );
			add_filter( 'redux/liquid_one_opt/field/typography/custom_fonts', array( $this, 'add_custom_fonts_to_redux'), 30 );
			add_filter( 'liquid_dynamic_css', array( $this, 'add_font_face_css') );

		}		
		
		/**
		 * add_typekit_fonts_to_redux
		 * @return  [arr] fonts array
		 */
		function add_custom_fonts_to_redux( $fonts = array() ) {
			
			$get_fonts = $this->get_custom_fonts_array();
			
			if( empty( $get_fonts ) ) {
				return $fonts;
			}
			
			if( isset( $fonts['Typekit Fonts'] ) ) {
				$all_fonts = array_merge( $fonts['Typekit Fonts'], $get_fonts );
			} 
			elseif( isset( $fonts['Custom Fonts'] ) ) {
				$all_fonts = array_merge( $fonts['Custom Fonts'], $get_fonts );				
			}
			else {
				$all_fonts = $get_fonts;	
			}
			
			$fonts_label = esc_html__( 'Custom Fonts', 'one' );
			$fonts       = array( $fonts_label => $all_fonts );
			
			return $fonts;

		}

		function get_custom_fonts_array() {
			
			if ( empty( $this->liquid_custom_fonts ) ) {
				return;
			}
			
			$ret = array();
			$fontsData = $this->liquid_custom_fonts;
			
			foreach($fontsData as $cfont ) {
				if( isset( $cfont ) && ! empty( $cfont ) ) {
					$slug = $cfont;
					$name = $cfont;
					$ret[$slug] = $name;
				}
			}

			return $ret;
			
		}
		
		function add_font_face_css( $css ) {
			
			$font_face = '';
			
			$get_fonts = array();
			
			$get_fonts = $this->liquid_custom_fonts;
			$woff2_arr = $this->liquid_custom_fonts_woff2;
			$woff_arr  = $this->liquid_custom_fonts_woff;
			$ttf_arr   = $this->liquid_custom_fonts_ttf;
			$font_weight = $this->liquid_custom_fonts_weight;
			
			if( is_array( $get_fonts ) ) {
				$get_fonts = array_filter( $get_fonts );	
			}

			if( empty( $get_fonts ) ) {
				return $css;
			}
				
			foreach( $get_fonts as $key => $font_name ) {
				
				$urls = array();
				if( isset( $woff2_arr[ $key ] ) && ! empty( $woff2_arr[ $key ] ) ) {
					$urls[] = 'url(' . esc_url( $woff2_arr[ $key ] ) . ')';
				}
				if( isset( $woff_arr[ $key ] ) &&  ! empty( $woff_arr[ $key ] ) ) {
					$urls[] = 'url(' . esc_url( $woff_arr[ $key ] ) . ')';	
				}
				if( isset( $ttf_arr[ $key ] ) && ! empty( $ttf_arr[ $key ] ) ) {
					$urls[] = 'url(' . esc_url( $ttf_arr[ $key ] ) . ')';
				}
				
				$font_face .= '@font-face {' . "\n";
				$font_face .= 'font-family:"' . esc_attr( $font_name ) . '";' . "\n";
				$font_face .= 'src:';
				$font_face .= implode( ', ', $urls ) . ';';
				if( !empty( $font_weight ) ) {
					$font_face .= 'font-weight:' . esc_attr( $font_weight[ $key ] ) . ';' . "\n";	
				}
				$font_face .= 'font-display:swap;' . "\n";
				$font_face .= '}' . "\n";
			}				

			return $font_face . $css;

		}
		
		/**
		 * get_custom_fonts_array
		 * 
		 * @return [arr] fonts array
		 */
		function get_custom_fonts() {
		
			global $liquid_options;
			
			$this->liquid_custom_fonts = ! empty( $liquid_options['custom_font_title'] ) ? $liquid_options['custom_font_title'] : null;
			$this->liquid_custom_fonts_woff2 = ! empty( $liquid_options['custom_font_woff2'] ) ? $liquid_options['custom_font_woff2'] : null;
			$this->liquid_custom_fonts_woff = ! empty( $liquid_options['custom_font_woff'] ) ? $liquid_options['custom_font_woff'] : null;
			$this->liquid_custom_fonts_ttf = ! empty( $liquid_options['custom_font_ttf'] ) ? $liquid_options['custom_font_ttf'] : null;
			$this->liquid_custom_fonts_weight = ! empty( $liquid_options['custom_font_weight'] ) ? $liquid_options['custom_font_weight'] : null;
		
		}

	}
	
	new Liquid_Custom_Fonts;
	
}