<?php
/**
* Shortcode Content Box Table
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly
	
/**
* LD_Shortcode
*/
class LD_Content_Box_Table extends LD_Shortcode {

	/**
	 * Construct
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug            = 'ld_content_box_table';
		$this->title           = esc_html__( 'Fancy Box Table', 'ave-core' );
		$this->description     = esc_html__( 'Fancy box table container', 'ave-core' );
		$this->icon            = 'fa fa-th-large';
		$this->content_element = true;
		$this->is_container    = true;
		$this->as_parent       = array( 'only' => 'ld_content_box_cell' );

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array(
			array(
				'type'        => 'liquid_checkbox',
				'param_name'  => 'enable_header',
				'heading'     => esc_html__( 'Header?', 'ave-core' ),
				'description' => esc_html__( 'Check to enable the row as header of the table', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'std'         => '',
			)
		);

		$this->add_extras();
	}
	
	protected function is_header() {
		
		if( !$this->atts['enable_header'] ) {
			return 'fancy-box-heading-sm';
		}
		
		return 'fancy-box-offer-header';

	}


}
new LD_Content_Box_Table;
class WPBakeryShortCode_LD_Content_Box_Table extends WPBakeryShortCodesContainer {}