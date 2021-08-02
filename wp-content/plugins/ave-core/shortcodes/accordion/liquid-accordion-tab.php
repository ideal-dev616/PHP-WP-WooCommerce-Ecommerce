<?php

/**
* Shortcode Accordion
*/

if( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Accordion_Tab extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'vc_accordion_tab';
		$this->title        = esc_html__( 'Accordion Section', 'ave-core' );
		$this->icon         = 'fa fa-navicon';
		$this->description  = esc_html__( 'Create an accordion.', 'ave-core' );
		$this->is_container = true;
		$this->js_view      = 'VcAccordionTabView';
		$this->allowed_container_element = 'vc_row';
		$this->deprecated   = '';
		$this->as_child     = array( 'only' => 'vc_accordion' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array_merge(
		
			array(
	
				array( 'id' => 'title' ),
				
				array(
					'type' => 'el_id',
					'param_name' => 'tab_id',
					'settings' => array(
						'auto_generate' => true,
					),
					'heading'     => esc_html__( 'Section ID', 'ave-core' ),
					'description' =>  wp_kses_post( __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'ave-core' ) ),
				),
				// CSS
				array(
					'type'        => 'textfield',
					'param_name'  => 'el_class',
					'heading'     => esc_html__( 'Extra class name', 'ave-core' ),
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ave-core' ),
					'group'       => esc_html__( 'Extras', 'ave-core' )
				),
			),
			liquid_get_icon_params( true, '', array( 'fontawesome', 'linea' ), array( 'align', 'color', 'hcolor', 'size' ) )
		
		);
	

	}

	public function render( $atts, $content = '' ) {

		global $liquid_accordion_tabs;

		$atts = vc_map_get_attributes( $this->slug, $atts );
		$atts = $this->before_output( $atts, $content );
		$atts['_id'] = $atts['tab_id'];
		$atts['extra'] = $atts['el_class'];
		$atts['content'] = ld_helper()->do_the_content( $content );
		$atts['icon'] = liquid_get_icon( $atts );

		$liquid_accordion_tabs[]  = $atts;
	}
}
new LD_Accordion_Tab;