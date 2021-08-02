<?php
/**
* Liquid Themes Theme Framework
* The Liquid_Theme_Options initiate the theme option machine.
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Theme_Options extends Liquid_Base {

	public $ReduxFramework = null;
	public $theme = null;
	public $args 	 = array();
	public $sections = array();

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		if ( !class_exists( 'ReduxFramework' ) ) {
			return;
		}

		$this->theme = wp_get_theme();

		$this->set_arguments();

		if( ! isset( $this->args['opt_name'] ) ) {
			return;
		}

		$this->set_sections();

		// If Redux is running as a plugin, this will remove the demo notice and links
		$this->add_action( 'redux/loaded', 'remove_demo' );

		$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
	}

	public function get_redux() {
		return $this->ReduxFramework;
	}
	
	/**
	 * All the possible arguments for Redux.
	 * @see https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments - For full documentation on arguments.
	 */
	public function set_arguments() {

		$this->args = array(

			'opt_name'             => liquid()->get_option_name(), //

			'display_name'         => $this->theme->get( 'Name' ), //
	        'display_version'      => $this->theme->get( 'Version' ), //

	        'menu_type'            => 'submenu', //

	        'menu_title'           => esc_html__( 'Theme Options', 'ave' ), //
	        'page_title'           => esc_html__( 'Theme Options', 'ave' ), //

			'global_variable'      => 'liquid_options',

			'async_typography'     => false,
	        'admin_bar'            => false,
	        'dev_mode'             => false,
			'show_options_object'  => false,
	        'customizer'           => true,

	        'page_parent'          => 'liquid',
	        'page_permissions'     => 'manage_options',
	        'page_slug'            => 'liquid-theme-options',
			'templates_path'		=> get_template_directory() . '/templates/redux/'
		  );

	}

	/**
	 * Remove the demo link and the notice of integrated demo from the redux-framework plugin
	 * @method remove_demo
	 * @return [type]      [description]
	 */
	function remove_demo() {

		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {

			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::instance(), 'plugin_metalinks' ), null, 2);
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
		}
	}

	/**
	 * [setSections description]
	 * @method setSections
	 */
	public function set_sections() {

		$sections = get_theme_support( 'liquid-theme-options' );
		$sections = isset( $sections[0] ) ? $sections[0] : false;

		if( ! $sections ) {
			return;
		}

		$path = get_template_directory() . '/theme/';
		foreach( $sections as $section ) {
			$file = "theme-options/liquid-{$section}.php";
			include_once $path . $file;
		}
	}
}
