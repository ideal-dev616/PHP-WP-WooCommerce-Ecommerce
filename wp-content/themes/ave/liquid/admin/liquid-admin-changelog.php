<?php
/**
* Liquid Themes Theme Framework
* The Liquid_Changelog class
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Admin_Changelog extends Liquid_Admin_Page {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		$this->id = 'liquid-changelog';
		$this->page_title = esc_html__( 'Liquid Changelog', 'ave' );
		$this->menu_title = esc_html__( 'Changelog', 'ave' );
		$this->parent = 'liquid';
		$this->position = '99';

		parent::__construct();
	}

	/**
	 * [display description]
	 * @method display
	 * @return [type]  [description]
	 */
	public function display() {
		include_once( get_template_directory() . '/liquid/admin/views/liquid-changelog.php' );
	}

	/**
	 * [save description]
	 * @method save
	 * @return [type] [description]
	 */
	public function save() {

	}
}
new Liquid_Admin_Changelog;