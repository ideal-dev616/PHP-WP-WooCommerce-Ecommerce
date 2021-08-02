<?php
/**
 * Liquid Themes Theme Framework
 * The Liquid_Theme initiate the theme engine
 */

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

// Include base class
include_once( get_template_directory() . '/liquid/liquid-base.php' );

// For developers to hook.
liquid_action( 'before_init' );

/**
 * Liquid Theme
 */
class Liquid_Theme extends Liquid_Base {

	/**
	 * [$version description]
	 * @var string
	 */
	private $version = '1.0.0';

	/**
	 * Theme options values
	 * @var array
	 */
	protected $theme_options_values = array();

	/**
     * Hold an instance of Liquid_Theme class.
     * @var Liquid_Theme
     */
	 protected static $instance = null;

	/**
	 * Main Liquid_Theme instance.
	 *
	 * @return Liquid_Theme - Main instance.
	 */
	public static function instance() {
        if(null == self::$instance) {
            self::$instance = new Liquid_Theme();
        }

        return self::$instance;
    }

	/**
	 * [__construct description]
	 * @method __construct
	 */
	private function __construct() {

		$this->init_hooks();
	}

	/**
	 * [init_hooks description]
	 * @method init_hooks
	 * @return [type]     [description]
	 */
	private function init_hooks() {

		$this->add_action( 'after_setup_theme', 'includes', 2 );
		$this->add_action( 'after_setup_theme', 'setup_theme', 7 );
		$this->add_action( 'after_setup_theme', 'admin', 7 );
		$this->add_action( 'after_setup_theme', 'extensions', 25 );

		// For developers to hook.
		liquid_action( 'loaded' );
	}

	/**
	 * [includes description]
	 * @method includes
	 * @return [type]   [description]
	 */
	public function includes() {

		// Load Core
		include_once( get_template_directory() . '/liquid/liquid-helpers.php' );
		include_once( get_template_directory() . '/liquid/liquid-template-tags.php' );
		include_once( get_template_directory() . '/liquid/liquid-media.php' );
		include_once( get_template_directory() . '/liquid/liquid-theme-options-init.php' );
		include_once( get_template_directory() . '/liquid/liquid-meta-boxes-init.php' );
		include_once( get_template_directory() . '/liquid/liquid-dynamic-css.php' );
		include_once( get_template_directory() . '/liquid/liquid-responsive-css.php' );

		// Load Structure
		include_once( get_template_directory() . '/liquid/structure/markup.php' );
		include_once( get_template_directory() . '/liquid/structure/header.php' );
		include_once( get_template_directory() . '/liquid/structure/footer.php' );
		include_once( get_template_directory() . '/liquid/structure/posts.php' );
		include_once( get_template_directory() . '/liquid/structure/comments.php' );

		// Load Woocommerce stuff
		if( class_exists( 'WooCommerce' ) ) {
			include_once( get_template_directory() . '/liquid/vendors/woocommerce/liquid-woocommerce-init.php' );
		}

		// Load Aqua Resizer
		include_once( get_template_directory() . '/liquid/extensions/aq_resizer/aq_resizer.php' );
		
		// Load Register and updater classes
		include_once( get_template_directory() . '/liquid/admin/updater/liquid-register-admin.php' );

		// Front-end
		if( ! is_admin() ) {
			$this->layout = include_once( get_template_directory() . '/liquid/liquid-theme-layout.php' );
		}

        // Load "Optimization" functionality
        if ( 0 && (! isset($_GET['optimization']) || $_GET['optimization'] !== '0')  ) {
            include_once( get_template_directory() . '/liquid/extensions/optimization/optimization.php' );
        }

	}

	/**
	 * [setup_theme description]
	 * @method setup_theme
	 * @return [type]      [description]
	 */
	public function setup_theme() {

		// Set Content Width
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 780;
		}

		// Localization
		load_theme_textdomain( 'ave', trailingslashit( WP_LANG_DIR ) . 'themes/' ); // From Wp-Content
        load_theme_textdomain( 'ave', get_stylesheet_directory()  . '/languages' ); // From Child Theme
        load_theme_textdomain( 'ave', get_template_directory()    . '/languages' ); // From Parent Theme

		// Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        // Enable support for WooCommerce
        add_theme_support( 'woocommerce' );

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'liquid-assets'
        ));

		// Allow shortcodes in widgets.
		add_filter( 'widget_text', 'do_shortcode' );

		// Theme Specific Setup
		$this->load_theme_part( 'liquid-setup' );

		// Get options for globals
		$GLOBALS[$this->get_option_name()] = get_option( $this->get_option_name(), array() );

		$this->load_theme_part( 'liquid-scripts' );
		$this->load_theme_part( 'liquid-hooks' );
		$this->load_theme_part( 'liquid-template-tags' );
		$this->load_theme_part( 'liquid-dynamic-css' );
		$this->load_theme_part( 'liquid-responsive-css' );
		$this->load_theme_part( 'liquid-walkers' );

		if( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {
			$this->load_theme_part( 'liquid-vc-templates-panel-editor' );
			$this->load_theme_part( 'liquid-vc-templates' );
		}	
		
	}

	/**
	 * [admin description]
	 * @method admin
	 * @return [type] [description]
	 */
	public function admin() {

		if( is_admin() ) {
			include_once( get_template_directory() . '/liquid/admin/liquid-admin-init.php' );
		}

	}

	/**
	 * [extensions description]
	 * @method extensions
	 * @return [type]     [description]
	 */
	public function extensions() {

		// check
		$extensions = get_theme_support( 'liquid-extension' );
		if( empty( $extensions ) || empty( $extensions[0] ) ) {
			return;
		}

		// Load
		$extensions = $extensions[0];
		foreach( $extensions as $extension ) {
			$this->load_extension( $extension );
		}
	}

	/**
	 * [set_option_name description]
	 * @method set_option_name
	 * @param  string          $name [description]
	 */
	public function set_option_name( $name = '' ) {

		if( $name ) {
			$this->theme_options_name = $name;
		}
	}

	/**
	 * [get_option_name description]
	 * @method get_option_name
	 * @param  string          $name [description]
	 * @return [type]                [description]
	 */
	public function get_option_name( $name = '' ) {
		return $this->theme_options_name;
	}

	// Helper ----------------------------------------

	/**
	 * [get_version description]
	 * @method get_version
	 * @return [type]      [description]
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * [load_theme_part description]
	 * @method load_theme_part
	 * @param  [type]          $slug [description]
	 * @param  [type]          $args [description]
	 * @return [type]                [description]
	 */
	public function load_theme_part( $slug, $args = null ) {
		liquid_helper()->get_template_part( 'theme/' . $slug, $args );
	}

	/**
	 * [load_library description]
	 * @method load_library
	 * @param  [type]       $slug [description]
	 * @param  [type]       $args [description]
	 * @return [type]             [description]
	 */
	public function load_library( $slug, $args = null ) {
		liquid_helper()->get_template_part( 'liquid/libs/' . $slug, $args );
	}

	public function load_assets( $slug ) {
		return get_template_directory_uri() . '/liquid/assets/' . $slug;
	}
}

/**
 * Main instance of Liquid_Theme.
 *
 * Returns the main instance of Liquid_Theme to prevent the need to use globals.
 *
 * @return Liquid_Theme
 */
function liquid() {
	return Liquid_Theme::instance();
}
liquid(); // init it

// For developers to hook.
liquid_action( 'init' );