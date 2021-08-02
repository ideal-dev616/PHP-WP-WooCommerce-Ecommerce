<?php
/**
* Shortcode Content Box Table
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Content_Box_Cell extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_content_box_cell';
		$this->title           = esc_html__( 'Fancy Box Cell', 'ave-core' );
		$this->description     = esc_html__( 'Fancy box cell container', 'ave-core' );
		$this->icon            = 'fa fa-th-large';
		$this->content_element = false;
		$this->is_container    = true;
		$this->as_child        = array( 'only' => 'ld_content_box_table' );
		$this->js_view         = 'VcColumnView';

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array();

		$this->add_extras();
	}


}
new LD_Content_Box_Cell;
class WPBakeryShortCode_LD_Content_Box_Cell extends WPBakeryShortCodesContainer {}