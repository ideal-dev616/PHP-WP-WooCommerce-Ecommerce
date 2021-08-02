<?php
/**
* Liquid Themes Theme Framework
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Admin_License extends Liquid_Admin_Page {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		$this->id         = 'liquid-license';
		$this->page_title = esc_html__( 'Liquid License', 'ave' );
		$this->menu_title = esc_html__( 'License', 'ave' );
		$this->position   = '55';
		$this->parent     = 'liquid';

		parent::__construct();
	}

	/**
	 * [display description]
	 * @method display
	 * @return [type]  [description]
	 */
	public function display() {
		include_once( get_template_directory() . '/liquid/admin/views/liquid-login.php' );
	}

	/**
	 * [save description]
	 * @method save
	 * @return [type] [description]
	 */
	public function save() {

	}
}
new Liquid_Admin_License;
