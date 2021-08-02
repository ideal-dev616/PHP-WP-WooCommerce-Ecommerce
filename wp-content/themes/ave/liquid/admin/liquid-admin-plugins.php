<?php
/**
* Liquid Themes Theme Framework
* The dashbaord class
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Admin_Plugins extends Liquid_Admin_Page {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		$this->id = 'liquid-plugins';
		$this->page_title = esc_html__( 'Install Liquid Plugins', 'ave' );
		$this->menu_title = esc_html__( 'Install Plugins', 'ave' );
		$this->parent = 'liquid';

		parent::__construct();
	}

	/**
	 * [display description]
	 * @method display
	 * @return [type]  [description]
	 */
	public function display() {
		include_once( get_template_directory() . '/liquid/admin/views/liquid-plugins.php' );
	}

	/**
	 * [save description]
	 * @method save
	 * @return [type] [description]
	 */
	public function save() {

	}
}
new Liquid_Admin_Plugins;
