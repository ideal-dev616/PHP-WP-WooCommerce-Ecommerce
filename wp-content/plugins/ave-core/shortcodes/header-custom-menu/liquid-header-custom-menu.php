<?php
/**
* Shortcode Custom Menu
*/

if ( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Header_Custom_Menu extends LD_Shortcode { 
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_header_custom_menu';
		$this->title       = esc_html__( 'Liquid Header Custom Menu', 'ave-core' );
		$this->icon        = 'fa fa-list';
		$this->description = esc_html__( 'Create custom menu.', 'ave-core' );
		$this->category    = esc_html__( 'Header Modules', 'ave-core' );

		parent::__construct();
	}
	
	public function get_params() {

		$this->params = vc_map_integrate_shortcode( 'ld_custom_menu', 'cm_', '' );
		$this->add_extras();
	}
	
	protected function get_menu() {

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_custom_menu', $this->atts, 'cm_' );
		$data['el_class'] = ' ' . $this->get_id();
		
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_custom_menu' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}


}
new LD_Header_Custom_Menu;