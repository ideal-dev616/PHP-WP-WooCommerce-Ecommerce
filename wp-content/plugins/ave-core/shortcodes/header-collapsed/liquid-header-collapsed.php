<?php
/**
* Shortcode Collapsed Container
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Header_Collapsed extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_header_collapsed';
		$this->title           = esc_html__( 'Navigation Container', 'ave-core' );
		$this->description     = esc_html__( 'Use this container before to add navigation menu', 'ave-core' );
		$this->icon            = 'fa fa-file-image-o';
		$this->content_element = true;
		$this->is_container    = true;
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );

		parent::__construct();
	}

	public function get_params() {

		$this->params = array(

			array(
				'type'        => 'checkbox',
				'param_name'  => 'visible',
				'heading'     => esc_html__( 'Hide?', 'ave-core' ),
				'description' => esc_html__( 'Hide container and display it only if pressed on trigger button', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'navbar-visible-ontoggle' ),
			),

		);

		$this->add_extras();	

	}


}
new LD_Header_Collapsed;
class WPBakeryShortCode_LD_Header_Collapsed extends WPBakeryShortCodesContainer {}