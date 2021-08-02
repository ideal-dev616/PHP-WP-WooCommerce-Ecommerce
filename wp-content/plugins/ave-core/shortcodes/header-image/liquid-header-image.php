<?php
/**
* Shortcode Header Menu
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Image extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_image';
		$this->title       = esc_html__( 'Logo', 'ave-core' );
		$this->description = esc_html__( 'Add logo', 'ave-core' );
		$this->icon        = 'fa fa-file-image-o';
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );

		parent::__construct();

	}
	
	public function get_params() {

		$this->params = array(
			
			
			array(
				'type'        => 'checkbox',
				'param_name'  => 'uselogo',
				'heading'     => esc_html__( 'Use Logo?', 'ave-core' ),
				'description' => esc_html__( 'Use logo set in theme options panel', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'linkhome',
				'heading'     => esc_html__( 'Link to homepage?', 'ave-core' ),
				'description' => esc_html__( 'Link the logo to homepage', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'edit_field_class' => 'vc_col-sm-6',
				'std'         => 'yes',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'image',
				'heading'    => esc_html__( 'Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'ave-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'retina_image',
				'heading'    => esc_html__( 'Retina Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add retina image from gallery or upload new', 'ave-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'light_image',
				'heading'    => esc_html__( 'Light Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'ave-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'retina_light_image',
				'heading'    => esc_html__( 'Retina Light Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add retina image from gallery or upload new', 'ave-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'dark_image',
				'heading'    => esc_html__( 'Dark Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'ave-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'retina_dark_image',
				'heading'    => esc_html__( 'Retina Dark Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add retina image from gallery or upload new', 'ave-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'        => 'checkbox',
				'param_name'  => 'usestickylogo',
				'heading'     => esc_html__( 'Use Sticky Logo?', 'ave-core' ),
				'description' => esc_html__( 'Use sticky logo set in theme options panel', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'std'         => 'yes'
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'sticky_image',
				'heading'    => esc_html__( 'Sticky Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new for sticky header', 'ave-core' ),
				'dependency' => array(
					'element' => 'usestickylogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'retina_sticky_image',
				'heading'    => esc_html__( 'Retina Sticky Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add retina image from gallery or upload new for sticky header', 'ave-core' ),
				'dependency' => array(
					'element' => 'usestickylogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'hover_image',
				'heading'    => esc_html__( 'Hover Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add image from gallery or upload new', 'ave-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'liquid_attach_image',
				'param_name' => 'hover_retina_image',
				'heading'    => esc_html__( 'Hover Retina Image', 'ave-core' ),
				'descripton' => esc_html__( 'Add retina image from gallery or upload new', 'ave-core' ),
				'dependency' => array(
					'element' => 'uselogo',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'vc_link',
				'param_name' => 'link',
				'heading'    => esc_html__( 'Url', 'ave-core' ),
				'descripton' => esc_html__( 'Input an url for the logo', 'ave-core' ),
				'dependency' => array(
					'element'  => 'linkhome',
					'is_empty' => true,
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'alignment',
				'heading'    => esc_html__( 'Logo Alignment', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Center', 'ave-core' )  => 'justify-content-lg-center',
					esc_html__( 'Right', 'ave-core' )   => 'justify-content-lg-end',
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'padding_top',
				'heading'     => esc_html__( 'Top space', 'ave-core' ),
				'description' => esc_html__( 'Add top padding for logo', 'ave-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 30,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'padding_right',
				'heading'     => esc_html__( 'Right space', 'ave-core' ),
				'description' => esc_html__( 'Add right padding for logo', 'ave-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 0,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'padding_bottom',
				'heading'     => esc_html__( 'Bottom space', 'ave-core' ),
				'description' => esc_html__( 'Add bottom padding for logo', 'ave-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 30,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'padding_left',
				'heading'     => esc_html__( 'Left space', 'ave-core' ),
				'description' => esc_html__( 'Add left padding for logo', 'ave-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 0,
				'edit_field_class' => 'vc_col-sm-6',
			),

		);
		
		$this->add_extras();

	}
	
	protected function get_image() {
		
		$src         = get_template_directory_uri() . '/assets/img/logo/logo-1.svg';
		$retina_src  = $scrset = '';
		
		$logo = $this->atts['image'];
		$retina_logo = $this->atts['retina_image'];
		
		if( $this->atts['uselogo'] ) {
			$img_array    = liquid_helper()->get_option( 'header-logo' );
			$retina_array = liquid_helper()->get_option( 'header-logo-retina' );
			
			if( is_array( $img_array ) && !empty( $img_array['url'] ) ) {
				$src = esc_url( $img_array['url'] );
			}
			
			if( is_array( $retina_array ) && !empty( $retina_array['url'] ) ) {
				$retina_src = esc_url( $retina_array['url'] );
			}
			else {
				$retina_src = '';
			}
		}
		else {
			if( $logo ) {
				$src = liquid_get_image( $logo, 'full' );
			}
			if( $retina_logo ) {
				$retina_src = liquid_get_image( $retina_logo, 'full' );
			}
		}
		
		$alt = get_bloginfo( 'title' );
		$image_opts = array(
			'class' => 'logo-default',
			'alt' => esc_attr( $alt ),
		);

		if( !empty( $retina_src ) ) {
			$scrset = 'srcset="' . $retina_src . ' 2x"';
		}

		$image = sprintf( '<img class="logo-default" src="%s" alt="%s" %s />', $src, $alt, $scrset );
		
		return $image;

	}
	
	protected function get_sticky_image() {
	
		$src = $retina_src  = $scrset = $image = '';
		
		$logo = $this->atts['sticky_image'];
		$retina_logo = $this->atts['retina_sticky_image'];

		if( $this->atts['usestickylogo'] ) {
			$img_array    = liquid_helper()->get_option( 'header-sticky-logo' );
			$retina_array = liquid_helper()->get_option( 'header-sticky-logo-retina' );
			
			if( is_array( $img_array ) && !empty( $img_array['url'] ) ) {
				$src = esc_url( $img_array['url'] );
			}
			
			if( is_array( $retina_array ) && !empty( $retina_array['url'] ) ) {
				$retina_src = esc_url( $retina_array['url'] );
			}
			else {
				$retina_src = '';
			}
		}
		else {
			if( $logo ) {
				$src = liquid_get_image( $logo, 'full' );
			}
			if( $retina_logo ) {
				$retina_src = liquid_get_image( $retina_logo, 'full' );
			}
		}
		
		$alt = get_bloginfo( 'title' );
		$image_opts = array(
			'class' => 'logo-sticky',
			'alt' => esc_attr( $alt ),
		);

		if( !empty( $retina_src ) ) {
			$scrset = 'srcset="' . $retina_src . ' 2x"';
		}

		if( !empty( $src ) ) {
			$image = sprintf( '<img class="logo-sticky" src="%s" alt="%s" %s />', $src, $alt, $scrset );	
		}
		
		return $image;
		
	}
	
	protected function get_light_image() {
	
		$src = $retina_src  = $scrset = $image = '';
		
		$logo = $this->atts['light_image'];
		$retina_logo = $this->atts['retina_light_image'];

		if( $this->atts['uselogo'] ) {
			$img_array    = liquid_helper()->get_option( 'header-light-logo' );
			$retina_array = liquid_helper()->get_option( 'header-light-logo-retina' );
			
			if( is_array( $img_array ) && !empty( $img_array['url'] ) ) {
				$src = esc_url( $img_array['url'] );
			}
			
			if( is_array( $retina_array ) && !empty( $retina_array['url'] ) ) {
				$retina_src = esc_url( $retina_array['url'] );
			}
			else {
				$retina_src = '';
			}
		}
		else {
			if( $logo ) {
				$src = liquid_get_image( $logo, 'full' );
			}
			if( $retina_logo ) {
				$retina_src = liquid_get_image( $retina_logo, 'full' );
			}
		}
		
		$alt = get_bloginfo( 'title' );
		$image_opts = array(
			'class' => 'logo-sticky',
			'alt' => esc_attr( $alt ),
		);

		if( !empty( $retina_src ) ) {
			$scrset = 'srcset="' . $retina_src . ' 2x"';
		}

		if( !empty( $src ) ) {
			$image = sprintf( '<img class="logo-light" src="%s" alt="%s" %s />', $src, $alt, $scrset );	
		}
		
		return $image;
		
	}
	
	protected function get_dark_image() {
	
		$src = $retina_src  = $scrset = $image = '';
		
		$logo = $this->atts['dark_image'];
		$retina_logo = $this->atts['retina_dark_image'];

		if( $this->atts['uselogo'] ) {
			$img_array    = liquid_helper()->get_option( 'header-dark-logo' );
			$retina_array = liquid_helper()->get_option( 'header-dark-logo-retina' );
			
			if( is_array( $img_array ) && !empty( $img_array['url'] ) ) {
				$src = esc_url( $img_array['url'] );
			}
			
			if( is_array( $retina_array ) && !empty( $retina_array['url'] ) ) {
				$retina_src = esc_url( $retina_array['url'] );
			}
			else {
				$retina_src = '';
			}
		}
		else {
			if( $logo ) {
				$src = liquid_get_image( $logo, 'full' );
			}
			if( $retina_logo ) {
				$retina_src = liquid_get_image( $retina_logo, 'full' );
			}
		}
		
		$alt = get_bloginfo( 'title' );
		$image_opts = array(
			'class' => 'logo-sticky',
			'alt' => esc_attr( $alt ),
		);

		if( !empty( $retina_src ) ) {
			$scrset = 'srcset="' . $retina_src . ' 2x"';
		}

		if( !empty( $src ) ) {
			$image = sprintf( '<img class="logo-dark" src="%s" alt="%s" %s />', $src, $alt, $scrset );	
		}
		
		return $image;
		
	}
	
	protected function get_hover_image() {
		
		 
		$src = $retina_src  = $scrset = $image = '';
		
		$logo = $this->atts['hover_image'];
		$retina_logo = $this->atts['hover_retina_image'];
		
		if( $this->atts['uselogo'] ) {
			$img_array    = liquid_helper()->get_option( 'hover-header-logo' );
			$retina_array = liquid_helper()->get_option( 'hover-header-logo-retina' );
			
			if( is_array( $img_array ) && !empty( $img_array['url'] ) ) {
				$src = esc_url( $img_array['url'] );
			}
			
			if( is_array( $retina_array ) && !empty( $retina_array['url'] ) ) {
				$retina_src = esc_url( $retina_array['url'] );
			}
			else {
				$retina_src = '';
			}
		}
		else {
			if( $logo ) {
				$src = liquid_get_image( $logo, 'full' );
			}
			if( $retina_logo ) {
				$retina_src = liquid_get_image( $retina_logo, 'full' );
			}
		}
		
		$alt = get_bloginfo( 'title' );
		$image_opts = array(
			'class' => 'logo-default',
			'alt' => esc_attr( $alt ),
		);

		if( !empty( $retina_src ) ) {
			$scrset = 'srcset="' . $retina_src . ' 2x"';
		}
		
		if( !empty( $src ) ) {
			$image = sprintf( '<span class="navbar-brand-hover"><img class="logo-default" src="%s" alt="%s" %s /></span><!-- /.navbar-brand-hover -->', $src, $alt, $scrset );	
		}
		
		return $image;

	}

	protected function get_mobile_logo() {

		$src = $retina_src = $retina_logo = $logo = $scrset = '';
		
		$img_array    = liquid_helper()->get_option( 'menu-logo' );
		$retina_array = liquid_helper()->get_option( 'menu-logo-retina' );		

		if( empty( $img_array['url'] ) ) {
			return;
		}
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
		
		return $image;
		
	}
	
	protected function get_logo() {
		
		$mobile_logo  = $this->get_mobile_logo();
		$image        = $this->get_image();
		$hover_image  = $this->get_hover_image();
		$sticky_image = $this->get_sticky_image();
		
		$light_image  = $this->get_light_image();
		$dark_image   = $this->get_dark_image();

		if( empty( $image ) ) {
			return;
		}
		
		if( !empty( $mobile_logo ) ) {
			$image = $mobile_logo . $image;
		}
		
		$href = esc_url( home_url( '/' ) );
		$custom_link = liquid_get_link_attributes( $this->atts['link'], false );
		
		if( !empty ( $custom_link['href'] ) && !$this->atts['linkhome'] ) {
			$href = $custom_link['href'];	
		}
		
		printf( '<a class="navbar-brand" href="%s" rel="home"><span class="navbar-brand-inner">%s %s %s %s %s</span></a>', $href, $light_image, $dark_image, $hover_image,$sticky_image, $image ) ;
		
	}
	
	protected function get_mobile_trigger() {
		
		echo '<button type="button" class="navbar-toggle collapsed nav-trigger style-mobile" data-toggle="collapse" data-target="#main-header-collapse" aria-expanded="false" data-changeclassnames=\'{ "html": "mobile-nav-activated overflow-hidden" }\'>
				<span class="sr-only">' . esc_html__( 'Toggle navigation', 'ave-core' ) . '</span>
				<span class="bars">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</span>
			</button>';
	}
	
	protected function generate_css() {
		
		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( '30' !== $padding_top ) {
			$elements[ liquid_implode( '.navbar-brand' ) ]['padding-top'] = $padding_top . 'px';
		}
		if( '0' !== $padding_right ) {
			$elements[ liquid_implode( '.navbar-brand' ) ]['padding-right'] = $padding_right . 'px';
		}
		if( '30' !== $padding_top ) {
			$elements[ liquid_implode( '.navbar-brand' ) ]['padding-bottom'] = $padding_bottom . 'px';
		}
		if( '0' !== $padding_left ) {
			$elements[ liquid_implode( '.navbar-brand' ) ]['padding-left'] = $padding_left . 'px';
		}


		$this->dynamic_css_parser( $id, $elements );

	}

}
new LD_Header_Image;