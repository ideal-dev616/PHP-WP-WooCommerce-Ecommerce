<?php

/**
 * Shortcode Title: Icon
 * Shortcode: ld_icon
 */
add_shortcode( 'ld_icon', 'ld_sc_icon' );
function ld_sc_icon( $atts, $content = null ) {

	extract( shortcode_atts(array(
		'icon'      => false,
		'container' => false,
		'span'      => false,
		'container_class' => 'icon-container'
    ), $atts ));

	if ( ! $icon ) {
		return '';
	}

	if ( $container ) {
		return sprintf( '<span class="%2$s"><i class="%1$s"></i></span>', ld_helper()->sanitize_html_classes( $icon ), $container_class );
	}

	if ( $span ) {
		return sprintf( '<span class="%1$s"></span>', ld_helper()->sanitize_html_classes( $icon ) );
	} else {
		return sprintf( '<i class="%1$s"></i>', ld_helper()->sanitize_html_classes( $icon ) );
	}

}

/**
 * Shortcode Title: Link
 * Shortcode: ld_link
 */
add_shortcode( 'ld_link', 'ld_sc_link' );
function ld_sc_link( $atts, $content = null ) {

	extract( shortcode_atts(array(
		'href'   => '#',
		'class'  => false,
		'target' => false,

    ), $atts ));
	
	if( ! empty( $class ) ) {
		$class = 'class="'. $class .'"';
	}

	if( ! empty( $target ) ) {
		$target = 'target="'. $target .'"';
	}

	return '<a '. $class .' href="'. esc_url( $href ) .'" '. $target .'  >' . do_shortcode( $content ) . '</a>';
}

/**
 * Shortcode Title: Category Title
 * Shortcode: ld_category_title
 */
add_shortcode( 'ld_category_title', 'ld_sc_category_title' );
function ld_sc_category_title( $atts, $content = null ) {
	return single_cat_title( '', false );
}

/**
 * Shortcode Title: Tag Title
 * Shortcode: ld_tag_title
 */
add_shortcode( 'ld_tag_title', 'ld_sc_tag_title' );
function ld_sc_tag_title( $atts, $content = null ) {
	return single_tag_title( '', false );
}

/**
 * Shortcode Title: Author
 * Shortcode: ld_author
 */
add_shortcode( 'ld_author', 'ld_sc_author' );
function ld_sc_author( $atts, $content = null ) {
	return get_the_author();
}

/**
 * Shortcode Title: Typed
 * Shortcode: ld_typed
 */

add_shortcode( 'ld_typed', 'ld_sc_typed' );
function ld_sc_typed( $atts, $content = null ) {

	extract( shortcode_atts(array(

		'words' => false,

	), $atts ));
	
	if ( empty( $words ) ) {
		return;
	}

	$out = '';
	$words = explode( '|', $words );
	
	$out .= '<span class="typed-keywords">';
	$i = 1;
	foreach ( $words as $word ) {
		$active = ( $i == 1 ) ? ' active' : '';
		$out .= '<span class="keyword' . $active . '">' . $word . '</span>';
		$i++;
	}
	$out .= '</span><!-- /.typed-keywords -->';
	
	return $out;
	
}

/**
 * Shortcode Title: Typed String
 * Shortcode: ld_string
 */
add_shortcode( 'ld_string', 'ld_sc_string' );
function ld_sc_string( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		
		'words' => false,
		
	), $atts ));

	if ( empty( $words ) ) {
		return;
	}
	
	$out = '';
	$words = explode( '|', $words );
	
	$out .= '<span class="typed-strings">';
	foreach ( $words as $word ) {
		$out .= '<span>' . $word . '</span>';
	}
	$out .= '</span><!-- /.typed-strings -->';

	return $out;	

}


/**
 * Shortcode Title: DropCap
 * Shortcode: ld_dropcap
 */
add_shortcode( 'ld_dropcap', 'ld_sc_dropcap' );
function ld_sc_dropcap( $atts, $content = null ) {

	return '<span class="dropcap">' . esc_html( $content ) . '</span>';
}

/**
 * Shortcode Title: Highlight
 * Shortcode: ld_highlight
 */
add_shortcode( 'ld_highlight', 'ld_sc_highlight' );
function ld_sc_highlight( $atts, $content = null ) {

	return '<mark class="lqd-highlight"><span class="lqd-highlight-txt">' . esc_html( $content ) . '</span><span class="lqd-highlight-inner"></span></mark>';

}


/**
 * Shortcode Title: Span
 * Shortcode: ld_span
 */
add_shortcode( 'ld_span', 'ld_sc_span' );
function ld_sc_span( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'color' => '',
	), $atts ) );
	
	
	if( ! empty( $color ) ) {
		
		return '<span style="color:' . esc_attr( $color ) . '">' . esc_html( $content ) . '</span>';
	}
	
	return '<span>' . esc_html( $content ) . '</span>';
}

/**
 * Shortcode Title: Break
 * Shortcode: ld_br
 */
add_shortcode( 'ld_br', 'ld_sc_break' );
function ld_sc_break( $atts, $content = null ) {

	return '<br />';
}

//Header Row Shortcode 
add_shortcode( 'ld_header_row', 'ld_header_row_shortcode' );
function ld_header_row_shortcode( $atts, $content ) {

	extract( shortcode_atts( array(
		'header_full_width'  => '',
		'header_type'        => 'mainbar',
		'css'                => '',
		'row_box_shadow'     => '',
		'gradient_bg'        => '',
		'el_id'              => '',
		'el_class'           => '',
	), $atts ) );

	$output = $shadow_box_id = $trigger = '';
	$container = 'container';
	
	if( $header_full_width ) {
		$container = 'container-fluid';
	}
	
	$row_box_shadow = vc_param_group_parse_atts( $row_box_shadow );
	if( !empty( $row_box_shadow ) ) {
		$shadow_box_id = uniqid('liquid-header-shadowbox-');
		$shadow_css    = liquid_get_shadow_css( $row_box_shadow, $shadow_box_id );
	}

	$the_id = $bg_styles = '';
	if ( ! empty( $el_id ) ) {
		$the_id = 'id="' . esc_attr( $el_id ) . '"';
	}
	
	if( !empty( $gradient_bg ) ) {
		$bg_styles = 'style="background:' . esc_attr( $gradient_bg ) . ';"';
	}
	
	if( 'mainbar' === $header_type ) {
		
		$classes = array(
			'mainbar-wrap',
			$el_class,
			vc_shortcode_custom_css_class( $css ),
			$shadow_box_id
		);
		
		if( !liquid_helper()->str_contains( 'ld_header_image', $content ) ) {
			
			$src = $retina_src = $retina_logo = $logo = $scrset = '';
			
			$img_array    = liquid_helper()->get_option( 'menu-logo' );
			if( empty( $img_array['url'] ) ) {
				$img_array = liquid_helper()->get_option( 'header-logo' ); 
			}
			$retina_array = liquid_helper()->get_option( 'menu-logo-retina' );
			$src = esc_url( $img_array['url'] );
			
			if( is_array( $retina_array ) && !empty( $retina_array['url'] ) ) {
				$retina_src = esc_url( $retina_array['url'] );
			}
			else {
				$retina_src = '';
			}
			
			if( !empty( $retina_src ) ) {
				$scrset	= 'srcset="' . $retina_src . ' 2x"';	
			}
			
			$alt = get_bloginfo( 'title' );
			$image = sprintf( '<img class="mobile-logo-default" src="%s" alt="%s" %s />', $src, $alt, $scrset );
			
			$trigger = '<div class="navbar-header hidden-lg">
						<a class="navbar-brand" href="' . esc_url( home_url( '/' ) ) . '" rel="home"><span class="navbar-brand-inner">' . $image . '</span></a>
						<button type="button" class="navbar-toggle collapsed nav-trigger style-mobile" data-toggle="collapse" data-target="#main-header-collapse" aria-expanded="false" data-changeclassnames=\'{ "html": "mobile-nav-activated overflow-hidden" }\'>
				<span class="sr-only">' . esc_html__( 'Toggle navigation', 'ave-core' ) . '</span>
				<span class="bars">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</span>
			</button></div>';	
		}
		
		if ( !empty( $shadow_css ) ) {
			$output .= '<style>' . $shadow_css . '</style>';
		}
		$output .= '<div ' . $the_id . ' class="' . join( ' ', $classes ) . '" ' . $bg_styles . '>';
		$output .= '<span class="megamenu-hover-bg"></span>';
		$output .= '	<div class="' . $container . ' mainbar-container">';
		$output .= '		<div class="mainbar">';
		$output .= '			<div class="row mainbar-row align-items-lg-stretch">';
		$output .= 					$trigger;
		$output .=					do_shortcode( $content );
		$output .= '			</div><!-- /.row mainbar-row -->';
		$output .= '		</div><!-- /.mainbar -->';
		$output .= '	</div><!-- /.container -->';
		$output .= '</div><!-- /.mainbar-wrap -->';
		
	}
	else {
		
		$classes = array(
			'secondarybar-wrap',
			vc_shortcode_custom_css_class( $css ),
			$el_class
		);
		
		$output .= '<div ' . $the_id . ' class="' . join( ' ', $classes ) . '" ' . $bg_styles . '>';
		$output .= '	<div class="' . $container . ' secondarybar-container">';
		$output .= '		<div class="secondarybar">';
		$output .= '			<div class="row secondarybar-row align-items-center">';
	
		$output .=					do_shortcode( $content );
	
		$output .= '			</div><!-- /.row secondarybar-row -->';
		$output .= '		</div><!-- /.secondarybar -->';
		$output .= '	</div><!-- /.container -->';
		$output .= '</div><!-- /.secondarybar-wrap -->';		
	}
	
	return $output;
	
}

//Header Columns Shortcode
add_shortcode( 'ld_header_column', 'ld_header_column_shortcode' );
function ld_header_column_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'width'            => '',
		'offset'           => '',
		'align'            => '',
		'responsive_align' => '',
		'header_col_width' => 'col',
		'css'              => '',
		'el_id'              => '',
		'el_class'           => '',
	), $atts ) );
	
	$width = wpb_translateColumnWidthToSpan( $width );
	$width = vc_column_offset_class_merge( $offset, $width );
	
	$classes = array(
		$header_col_width,
		$width,
		vc_shortcode_custom_css_class( $css ),
		$el_class
	);
	$the_id = '';
	if ( ! empty( $el_id ) ) {
		$the_id = 'id="' . esc_attr( $el_id ) . '"';
	}
	
	if( !empty( $align ) ) {
		$classes[] = $align;
	}
	if( !empty( $responsive_align ) ) {
		$classes[] = $responsive_align;
	}
	
	$output = '';
	
	$output .= '<div ' . $the_id . ' class="' . implode( ' ', $classes ) . '">';
	$output .=	do_shortcode( $content );		
	$output .= '</div>';
	
	return $output;
	
}

//Megamenu Columns Shortcode
add_shortcode( 'ld_megamenu_column', 'ld_megamenu_column_shortcode' );
function ld_megamenu_column_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'align'            => '',
		'responsive_align' => '',
		'offset'           => '',
		'width'            => '',
		'css'              => ''
	), $atts ) );

	$width = wpb_translateColumnWidthToSpan( $width );
	$width = vc_column_offset_class_merge( $offset, $width );

	$classes = array(
		'megamenu-column',
		$width,
		vc_shortcode_custom_css_class( $css ),
	);
	
	if( !empty( $align ) ) {
		$classes[] = $align;
	}
	if( !empty( $responsive_align ) ) {
		$classes[] = $responsive_align;
	}
	
	$output = '';
	
	$output .= '<div class="' . implode( ' ', $classes ) . '">';
	$output .=	do_shortcode( $content );		
	$output .= '</div>';
	
	return $output;
	
}

//Megamenu Columns Shortcode
add_shortcode( 'ld_megamenu_row', 'ld_megamenu_row_shortcode' );
function ld_megamenu_row_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'css'              => ''
	), $atts ) );

	$classes = array(
		'vc_row',
		'megamenu-inner-row',
		vc_shortcode_custom_css_class( $css ),
	);
	
	if( !empty( $align ) ) {
		$classes[] = $align;
	}
	if( !empty( $responsive_align ) ) {
		$classes[] = $responsive_align;
	}
	
	$output = '';
	
	$output .= '<div class="' . implode( ' ', $classes ) . '">';
	$output .=	do_shortcode( $content );		
	$output .= '</div>';
	
	return $output;
	
}