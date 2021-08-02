<?php
/**
* Font Params
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

function liquid_get_font( $slug, $atts, $param, $tag = 'h6' ) {

	if ( isset( $atts[ $param ] ) && '' !== trim( $atts[ $param ] ) ) {

		if ( isset( $atts[ 'use_custom_fonts_' . $param ] ) && 'true' === $atts[ 'use_custom_fonts_' . $param ] ) {
			$custom_heading = visual_composer()->getShortCode( 'vc_custom_heading' )->shortcodeClass();
			$h_atts = vc_map_integrate_parse_atts( $slug, 'vc_custom_heading', $atts, $param . '_' );
			// print_r($h_atts);
			$data = $custom_heading->getAttributes( $h_atts );
			// print_r($data);
			$styles = $custom_heading->getStyles( '', '', $data['google_fonts_data'], $data['font_container_data'], $h_atts );
			//print_r($styles);
			$styles['tag'] = isset( $data['font_container_data']['values']['tag'] ) ? $data['font_container_data']['values']['tag'] : $tag;

			if ( ( ! isset( $h_atts['use_theme_fonts'] ) || 'yes' !== $h_atts['use_theme_fonts'] ) && ! empty( $data['google_fonts_data'] ) && isset( $data['google_fonts_data']['values']['font_family'] ) ) {
				$styles['font_family'] = $data['google_fonts_data']['values']['font_family'];
			}
			else {
				$styles['font_family'] = false;
			}

			unset( $styles['css_class'] );

			return $styles;
		}
		else {
			return array(
				'tag' => $tag,
				'styles' => array(),
				'font_family' => false
			);
		}
	}

	return false;
}

function liquid_get_font_params( $prefix, $title, $dependency = array() ) {

	require_once vc_path_dir( 'CONFIG_DIR', 'content/vc-custom-heading-element.php' );

	$custom = vc_map_integrate_shortcode( vc_custom_heading_element_params(), $prefix, $title, array(
		'exclude' => array(
			'source',
			'text',
			'link',
			'el_class',
			'css',
		),
	), $dependency );

	// This is needed to remove custom heading _tag and _align options.
	if ( is_array( $custom ) && ! empty( $custom ) ) {
		foreach ( $custom as $key => &$param ) {

			// text_align
			if ( is_array( $param ) && isset( $param['type'] ) && 'font_container' === $param['type'] ) {
				$custom[ $key ]['value'] = '';
				if ( isset( $param['settings'] ) && is_array( $param['settings'] ) && isset( $param['settings']['fields'] ) ) {
					$sub_key = array_search( 'text_align', $param['settings']['fields'] );
					if ( false !== $sub_key ) {
						unset( $custom[ $key ]['settings']['fields'][ $sub_key ] );
					} elseif ( isset( $param['settings']['fields']['text_align'] ) ) {
						unset( $custom[ $key ]['settings']['fields']['text_align'] );
					}
				}
			}
		}
	}

	return $custom;
}

if ( !function_exists( 'liquid_google_vc_fonts' ) ) {

	function liquid_google_vc_fonts( $fonts_list ) {
	  
		$amiri->font_family = 'Amiri';
		$amiri->font_types = '400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic';
		$amiri->font_styles = 'regular,italic,700,700italic';
		$amiri->font_family_description = esc_html_e( 'Select font family', 'ave-core' );
		$amiri->font_style_description = esc_html_e( 'Select font styling', 'ave-core' );
		
		$fonts_list[] = $amiri;
		
		$teko->font_family = 'Teko';
		$teko->font_types = '300 light regular:300:normal,400 regular:400:normal';
		$teko->font_styles = '300,regular';
		$teko->font_family_description = esc_html_e( 'Select font family', 'ave-core' );
		$teko->font_style_description = esc_html_e( 'Select font styling', 'ave-core' );
		
		$fonts_list[] = $teko;
		
		$rubik->font_family = 'Rubik';
		$rubik->font_types = '300 light regular:300:normal,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic';
		$rubik->font_styles = '300,regular,italic,700,700italic';
		$rubik->font_family_description = esc_html_e( 'Select font family', 'ave-core' );
		$rubik->font_style_description = esc_html_e( 'Select font styling', 'ave-core' );
		
		$fonts_list[] = $rubik;
		
		$heebo->font_family = 'Heebo';
		$heebo->font_types = '100 thin regular:100:normal,300 light regular:300:normal,400 regular:400:normal,500 regular:500:normal,700 bold regular:700:normal,800 extra bold regular:800:normal,900 black regular:900:normal';
		$heebo->font_styles = '100,300,regular,500,700,800,900';
		$heebo->font_family_description = esc_html_e( 'Select font family', 'ave-core' );
		$heebo->font_style_description = esc_html_e( 'Select font styling', 'ave-core' );
		
		$fonts_list[] = $heebo;
		
		$poppins->font_family = 'Poppins';
		$poppins->font_types = '100 thin regular:100:normal,100 thin italic:100:italic,200 extra-light regular:200:normal,200 extra-light italic:200:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 medium regular:500:normal,500 medium italic:500:italic,600 semi-bold regular:600:normal,600 semi-bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 extra-bold regular:800:normal,800 extra-bold italic:800:italic,900 black regular:900:normal,900 black italic:900:italic';
		$poppins->font_styles = '100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
		$poppins->font_family_description = esc_html_e( 'Select font family', 'ave-core' );
		$poppins->font_style_description = esc_html_e( 'Select font styling', 'ave-core' );
		
		$fonts_list[] = $poppins;

		return $fonts_list;

	}
}
add_filter( 'vc_google_fonts_get_fonts_filter', 'liquid_google_vc_fonts' );
