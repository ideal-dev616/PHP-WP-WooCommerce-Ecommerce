<?php
/**
* Shortcode Banner
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Deal extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_deal';
		$this->title       = esc_html__( 'Banner', 'ave-core' );
		$this->icon        = 'fa fa-dot-circle-o';
		$this->description = esc_html__( 'Create a banner', 'ave-core' );
		$this->styles      = array( 'fresco', 'lity' );

		parent::__construct();
	}
	
	public function get_params() {

		$button = vc_map_integrate_shortcode( 'ld_button', 'bn_', esc_html__( 'Button', 'ave-core' ),
			array(
				'exclude' => array(
					'el_id',
					'el_class',
					'sh_shadowbox',
					'enable_row_shadowbox',
					'button_box_shadow',
					'hover_button_box_shadow'
				),
			),
			array(
				'element' => 'show_button',
				'value'   => 'yes',
			)
		);

		$general = array(

			array( 
				'id' => 'title',
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'subtitle',
				'heading'    => esc_html__( 'Subtitle', 'ave-core' ),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'info',
				'heading'    => esc_html__( 'Label/Additional Info', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_attach_image',
				'param_name'  => 'image',
				'heading'     => esc_html__( 'Image', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'       => 'textarea_html',
				'param_name' => 'content',
				'heading'    => esc_html__( 'Text', 'ave-core' ),
				'holder'     => 'div',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'ave-core' ),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
			),
			
		);
		
		$design = array(

			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'color',
				'heading'     => esc_html__( 'Title Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a custom color for the title color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a custom color for the label/subtitle background color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			)

		);

		$this->params = array_merge( $general, $button, $design );
		$this->add_extras();
	}
	
	protected function get_title() {

		if( empty( $this->atts[ 'title' ] ) ) {
			return;
		}

		printf( '<h3 class="ld-bnr-title">%s</h3>', esc_html( $this->atts['title'] ) );

	}
	
	protected function get_subtitle() {

		if( empty( $this->atts[ 'subtitle' ] ) ) {
			return;
		}

		printf( '<h6 class="ld-bnr-subtitle">%s</h6>', esc_html( $this->atts['subtitle'] ) );

	}
	
	protected function get_content() {

		// check
		if( empty( $this->atts['content'] ) ) {
			return '';
		}

		$content = ld_helper()->do_the_content( $this->atts['content'] );

		echo $content;
	}
	
	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'bn_' );
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}
	
	protected function get_image() {

		// check
		if( empty( $this->atts['image'] ) ) {
			return;
		}
		
		$image_opts = array();
		$alt = get_post_meta( $this->atts['image'], '_wp_attachment_image_alt', true );
		
		if( preg_match( '/^\d+$/', $this->atts['image'] ) ){
			$retina_image = wp_get_attachment_image_src( $this->atts['image'], 'full' );
			$image  = wp_get_attachment_image( $this->atts['image'], 'full', false, $image_opts );
		} else {
			$image = '<img src="' . esc_url( $this->atts['image'] ) . '" alt="' . esc_attr( $alt ) . '" />';
		}
		
		$image = sprintf( '<div class="ld-bnr-img"><figure>%s</figure></div>', $image );
		
		echo $image;
	}

	protected function get_info() {
		
		if( empty( $this->atts[ 'info' ] ) ) {
			return;
		}
		
		printf( '<span class="ld-bnr-label"><span>%s</span></span>', wp_kses_post( $this->atts['info'] ) );

	}


	protected function generate_css() {
		
		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();

		if( !empty( $primary_color ) ) {
			$elements[ liquid_implode( '%1$s .ld-bnr-subtitle,%1$s .ld-bnr-label:after' ) ]['background'] = esc_attr( $primary_color );
		}
		if( !empty( $color ) ) {
			$elements[ liquid_implode( '%1$s .ld-bnr-title' ) ]['color'] = esc_attr( $color );
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Deal;