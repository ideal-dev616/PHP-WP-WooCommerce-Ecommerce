<?php
/**
* Modal Window Button
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Modal_Window extends LD_Shortcode {
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_modal_window';
		$this->title       = esc_html__( 'Modal Box', 'ave-core' );
		$this->icon        = 'fa fa-window-maximize';
		$this->description = esc_html__( 'Create a modal Box', 'ave-core' );
		$this->scripts      = array( 'jquery-fresco', 'lity' );
		$this->styles       = array( 'fresco', 'lity' );
		$this->is_container = true;

		parent::__construct();
	}
	
	public function get_params() {

		$this->params = array(
			array( 
				'id' => 'title',
			),
		);
		$this->add_extras();
	}

	protected function get_title() {
		
		if( empty( $this->atts['title'] ) ) {
			return;
		}
		echo esc_html( $this->atts['title'] );		
	}
	

}
new LD_Modal_Window;
class WPBakeryShortCode_LD_Modal_Window extends WPBakeryShortCodesContainer {}