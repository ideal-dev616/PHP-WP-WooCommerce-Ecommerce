<?php
/**
* Liquid Themes Theme Framework
* The Liquid_Admin_Import class
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Admin_Import extends Liquid_Admin_Page {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		$this->id = 'liquid-import-demos';
		$this->page_title = esc_html__( 'Liquid Import Demos', 'ave' );
		$this->menu_title = esc_html__( 'Import Demos', 'ave' );
		$this->parent = 'liquid';
		$this->position = '10';

		parent::__construct();
	}

	/**
	 * [display description]
	 * @method display
	 * @return [type]  [description]
	 */
	public function display() {
		include_once( get_template_directory() . '/liquid/admin/views/liquid-demos.php' );
	}

	/**
	 * [save description]
	 * @method save
	 * @return [type] [description]
	 */
	public function save() {

	}
}
new Liquid_Admin_Import;