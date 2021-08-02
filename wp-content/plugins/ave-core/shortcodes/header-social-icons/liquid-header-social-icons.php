<?php
/**
* Shortcode Social Icons
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Social_Icons extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_social_icons';
		$this->title       = esc_html__( 'Social Icons', 'ave-core' );
		$this->description = esc_html__( 'Add social icons header module', 'ave-core' );
		$this->icon        = 'fa fa-star';
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );

		parent::__construct();
	}

	public function get_params() {
		
		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/social-icons/';

		$this->params = array(
			
			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'ave-core' ),
				'value'      => array(

					array(
						'value' => '',
						'label' => esc_html__( 'Default', 'ave-core' ),
						'image' => $url . 'default.svg'
					),

					array(
						'label' => esc_html__( 'Brand Colors', 'ave-core' ),
						'value' => 'branded-text',
						'image' => $url . 'brand-color.svg'
					),

					array(
						'label' => esc_html__( 'Brand Fills', 'ave-core' ),
						'value' => 'branded',
						'image' => $url . 'brand-fill.svg'
					),
				),
				'save_always' => true,
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'shape',
				'heading'    => esc_html__( 'Shape', 'ave-core' ),
				'value'      => array(
					esc_html__( 'None', 'ave-core' )       => '',
					esc_html__( 'Square', 'ave-core' )     => 'square',
					esc_html__( 'Bordered', 'ave-core' ) => 'rectangle bordered',
					esc_html__( 'Round', 'ave-core' )      => 'round',
					esc_html__( 'Circle', 'ave-core' )     => 'circle',
				),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to'  => array( 'text-only' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'visibility',
				'heading'    => esc_html__( 'Visibility', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Normal', 'ave-core' ) => '',
					esc_html__( 'Faded', 'ave-core' )  => 'faded',
				),
				'edit_field_class' => 'vc_col-sm-4',
			),

			array(
				'type'       => 'dropdown',
				'param_name' => 'size',
				'heading'    => esc_html__( 'Size', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Small', 'ave-core' )  => 'social-icon-sm',
					esc_html__( 'Medium', 'ave-core' ) => 'social-icon-md',
					esc_html__( 'Large', 'ave-core' )  => 'social-icon-lg'
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'scheme',
				'heading'    => esc_html__( 'Scheme', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Dark', 'ave-core' )    => 'scheme-dark',
					esc_html__( 'Light', 'ave-core' )   => 'scheme-white',
					esc_html__( 'Gray', 'ave-core' )    => 'scheme-gray'
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'orientation',
				'heading'    => esc_html__( 'Orientation', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Horizontal', 'ave-core' ) => '',
					esc_html__( 'Vertical', 'ave-core' )   => 'vertical'
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'text_transform',
				'heading'    => esc_html__( 'Text Transform', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'None', 'ave-core' )    => 'text-transform-none',
					esc_html__( 'Uppercase', 'ave-core' )   => 'text-uppercase',
					esc_html__( 'Lowercase', 'ave-core' )    => 'text-lowercase',
					esc_html__( 'Capitalize', 'ave-core' )    => 'text-capitalize'
				),
				'dependency'  => array(
					'element' => 'style',
					'value'  => array( 'text-only' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'letter_spacing',
				'heading'     => esc_html__( 'Letter Spacing', 'ave-core' ),
				'description' => esc_html__( 'Add letter spacing for texts', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value'  => array( 'text-only' )
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'title',
				'heading'     => esc_html__( 'Title', 'ave-core' ),
				'description' => esc_html__( 'Add title for social icons', 'ave-core' ),
				'admin_label' => true,
			),
			array(
				'type'       => 'param_group',
				'param_name' => 'identities',
				'heading'    => esc_html__( 'Identities', 'ave-core' ),
				'params'     => array(

					array(
						'id' => 'network',
						'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding'
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'url',
						'heading'     => esc_html__( 'URL (Link)', 'ave-core' ),
						'description' => esc_html__(  'Add social link', 'ave-core' ),
						'edit_field_class' => 'vc_col-sm-6'
					)
				)
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'font_size',
				'heading'     => esc_html__( 'Size', 'ave-core' ),
				'description' => esc_html__( 'Add size in pixels e.g 15px', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'hover_color',
				'heading'     => esc_html__( 'Hover Color', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),

		);

		$this->add_extras();
	}
	
	protected function get_title() {
		
		if( empty( $this->atts['title'] ) ) {
			return;
		}

		printf( '<h6 class="module-title">%s</h6>', esc_html( $this->atts['title'] ) );
		
	}

	public function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();
		$out = '';
		
		if( !empty( $font_size ) ) {
			$elements['%1$s.social-icon']['font-size'] = $font_size;
		}
		if( !empty( $primary_color ) ) {
			$elements['%1$s.social-icon a']['color'] = $primary_color . ' !important';
		}
		if( !empty( $hover_color ) ) {
			$elements['%1$s.social-icon li a:hover']['color'] = $hover_color . ' !important';
		}


		$this->dynamic_css_parser( $id, $elements );
	}
}
new LD_Header_Social_Icons;