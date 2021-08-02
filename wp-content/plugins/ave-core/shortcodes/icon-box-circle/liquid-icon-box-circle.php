<?php
/**
* Shortcode Icon Box Circle
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Icon_Box_Circle extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_icon_box_circle';
		$this->title       = esc_html__( 'Icon Box Circle', 'ave-core' );
		$this->description = esc_html__( 'Create circle with icon box.', 'ave-core' );
		$this->icon        = 'fa fa-bullseye';
		$this->content_element = true;
		$this->is_container    = true;
		$this->as_parent       = array( 'only' => 'ld_icon_box_circle_item' );
		$this->scripts      = array( 'jquery-vivus' );

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Enable 3D Animation?', 'ave-core' ),
				'param_name'  => 'enable_animation',
				'description' => esc_html__( 'If checked the will enable the 3D animation', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'primary_color',
				'heading'     => esc_html__( 'Primary Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color as primary', 'ave-core' ),
				'group'       => esc_html__( 'Design Options', 'ave-core' ),
			),

		);

		$this->add_extras();
	}
	
	protected function get_animation() {
		
		if( 'yes' === $this->atts['enable_animation'] ) {
			echo 'data-hover3d="true"';
		}

	}
	
	protected function generate_css() {

		$elements = array();
		extract( $this->atts );
		$id = '.' .$this->get_id();

		if( !empty( $primary_color ) && isset( $primary_color ) )  {
			$elements[liquid_implode( '%1$s .one-ib-circ-icn span:before' )]['background'] = $primary_color;
		}

		$this->dynamic_css_parser( $id, $elements );
	}

}

new LD_Icon_Box_Circle;
class WPBakeryShortCode_LD_Icon_Box_Circle extends WPBakeryShortCodesContainer {}