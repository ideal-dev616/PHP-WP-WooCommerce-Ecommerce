<?php
/**
* Shortcode Spacer
*/
//vc_hidden-lg vc_hidden-md vc_hidden-sm vc_hidden-xs

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Spacer extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_spacer';
		$this->title       = esc_html__( 'Liquid Spacer', 'ave-core' );
		$this->icon        = 'fa fa-long-arrow-down';
		$this->description = esc_html__( 'Add responsive empty space', 'ave-core' );

		parent::__construct();
	}


	public function get_params() {
	
		$this->params = array(
			
			array(
				'type'       => 'textfield',
				'heading'    => wp_kses_post( __( 'Height: <small>This value applies to all devices unless another value is inserted</small>', 'ave-core' ) ),
				'param_name' => 'height',
				'value'       => '32px',
				'admin_label' => true,
				'description' => wp_kses_post( __( 'Height <strong style="color: #000;">This value applies to all devices unless another value is inserted</strong> (Note: CSS measurement units allowed).', 'ave-core' ) ),
				'edit_field_class' => 'vc_col-sm-9 vc_column-with-padding'
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'hide',
				'heading'    => esc_html__( 'Hide', 'ave-core' ),
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'vc_hidden-xs' ),
				'description' => '',
				'edit_field_class' => 'vc_col-sm-3'
			),
			
			array(
				'type'        => 'subheading',
				'param_name'  => 'sm_devices',
				'heading'     => esc_html__( 'Small Device Height (Tablet)', 'ave-core' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Small Device Height (Tablet)', 'ave-core' ),
				'param_name' => 'sm_height',
				'description' => esc_html__('Larger devices inherit from smaller devices (Note: CSS measurement units allowed).', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-9',
				'admin_label' => true,
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'sm_hide',
				'heading'    => esc_html__( 'Hide', 'ave-core' ),
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'vc_hidden-sm' ),
				'description' => '',
				'edit_field_class' => 'vc_col-sm-3'
				
			),
			
			array(
				'type'        => 'subheading',
				'param_name'  => 'md_devices',
				'heading'     => esc_html__( 'Medium Devices', 'ave-core' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Medium Devices Height', 'ave-core' ),
				'param_name' => 'md_height',
				'description' => esc_html__( 'Larger devices inherit from smaller devices (Note: CSS measurement units allowed).', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-9',
				'admin_label' => true,
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'md_hide',
				'heading'    => esc_html__( 'Hide', 'ave-core' ),
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'vc_hidden-md' ),
				'description' => '',
				'edit_field_class' => 'vc_col-sm-3'
				
			),

			array(
				'type'        => 'subheading',
				'param_name'  => 'lg_devices',
				'heading'     => esc_html__( 'Large Devices', 'ave-core' ),
			),			
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Large Devices Height', 'ave-core' ),
				'param_name' => 'lg_height',
				'description' => esc_html__( 'Large Devices Height (Note: CSS measurement units allowed).', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-9',
				'admin_label' => true,
			),
			array(
				'type'       => 'checkbox',
				'param_name' => 'lg_hide',
				'heading'    => esc_html__( 'Hide', 'ave-core' ),
				'value'      => array( esc_html__( 'Yes', 'ave-core' ) => 'vc_hidden-lg' ),
				'description' => '',
				'edit_field_class' => 'vc_col-sm-3'
				
			),
			
			
		);

		$this->add_extras();

	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' . $this->get_id();
		
		$pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
		// allowed metrics: http://www.w3schools.com/cssref/css_units.asp
		
		//All
		$regexr = preg_match( $pattern, $height, $matches );
		$value  = isset( $matches[1] ) ? (float) $matches[1] : (float) $height;
		$unit   = isset( $matches[2] ) ? $matches[2] : 'px';
		$height = $value . $unit;
		if( !empty( $value ) ) {
			$elements[ liquid_implode( '%1$s' ) ]['height'] = $height;
		}

		//Small		
		$regexr = preg_match( $pattern, $sm_height, $matches );
		$sm_value  = isset( $matches[1] ) ? (float) $matches[1] : (float) $sm_height;
		$sm_unit   = isset( $matches[2] ) ? $matches[2] : 'px';
		$sm_height = $sm_value . $sm_unit;
		if( !empty( $sm_value ) ) {
			$elements[ liquid_implode( '@media (min-width: 768px) { %1$s' ) ]['height'] = $sm_height . '}';
		}

		//Medium
		$regexr = preg_match( $pattern, $md_height, $matches );
		$md_value  = isset( $matches[1] ) ? (float) $matches[1] : (float) $md_height;
		$md_unit   = isset( $matches[2] ) ? $matches[2] : 'px';
		$md_height = $md_value . $md_unit;
		if( !empty( $md_value ) ) {
			$elements[ liquid_implode( '@media (min-width: 992px) { %1$s' ) ]['height'] = $md_height . '}';
		}
		
		//Large
		$regexr = preg_match( $pattern, $lg_height, $matches );
		$lg_value  = isset( $matches[1] ) ? (float) $matches[1] : (float) $lg_height;
		$lg_unit   = isset( $matches[2] ) ? $matches[2] : 'px';
		$lg_height = $lg_value . $lg_unit;
		if( !empty( $lg_value ) ) {
			$elements[ liquid_implode( '@media (min-width: 1200px) { %1$s' ) ]['height'] = $lg_height . '}';
		}

		$this->dynamic_css_parser( $id, $elements );

	}
	
	
	
	
}

new LD_Spacer;