<?php
/*
Plugin Name: Ave Portfolio
Plugin URI: http://ave.liquid-themes.com/
Description: Modern and Diversified Portfolio Plugin, exclusively Ave WordPress Theme.
Version: 1.0
Author: Liquid Themes
Author URI: https://themeforest.net/user/liquidthemes
Text Domain: ave-portfolio
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

class Liquid_Portfolio {

	/**
	 * Hold an instance of Liquid_Portfolio class.
	 * @var Liquid_Portfolio
	 */
	protected static $instance = null;
	
	/**
	 * Main Liquid_Portfolio instance.
	 *
	 * @return Liquid_Portfolio - Main instance.
	 */
	public static function instance() {

		if(null == self::$instance) {
			self::$instance = new Liquid_Portfolio();
		}

		return self::$instance;
	}

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'liquid_init', array( $this, 'init_hooks' ) );
		add_action( 'admin_notices', array( $this, 'activate_addons_notice' ) );

	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain( 'ave-portfolio', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * [init_hooks description]
	 * @method init_hooks
	 * @return [type]     [description]
	 */
	public function init_hooks() {

		add_action( 'init', array( $this, 'load_post_types' ), 1 );

	}	

	public function activate_addons_notice() {

		if( class_exists( 'Liquid_Addons' ) ) {
			return;
		}
	?>
		<div class="updated not-h2">
			<p><strong><?php esc_html_e( 'Please activate the Ave Core to use the Ave Portfolio plugin.', 'ave-portfolio' ); ?></strong></p>
			<?php
				$screen = get_current_screen();
				if ($screen -> base != 'plugins'):
			?>
				<p><a href="<?php echo esc_url( admin_url( 'plugins.php' ) ); ?>"><?php esc_html_e( 'Activate Ave Core', 'ave-portfolio' ); ?></a></p>
			<?php endif; ?>
		</div>
	<?php
	}

	/**
	 * [load_post_types description]
	 * @method load_post_types
	 * @return [type]          [description]
	 */
	public function load_post_types() {
		
		if( ! class_exists( 'Liquid_Addons' ) ) {
			return;
		}

		if( function_exists( 'require_if_theme_supports' ) ) {
			require_if_theme_supports( 'liquid-portfolio', $this->plugin_dir() . 'post-types/liquid-portfolio.php' );
		}

	}

	/**
	 * Plugin activation
	 */
	public static function activate() {
		flush_rewrite_rules();
	}

	/**
	 * Plugin deactivation
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

	public function plugin_uri() {
		return plugin_dir_url( __FILE__ );
	}

	public function plugin_dir() {
		return plugin_dir_path( __FILE__ );
	}
	
}

/**
 * Main instance of Liquid_Portfolio.
 *
 * Returns the main instance of Liquid_Portfolio to prevent the need to use globals.
 *
 * @return Liquid_Portfolio
 */
function liquid_portfolio() {
	return Liquid_Portfolio::instance();
}
liquid_portfolio(); // init i

register_activation_hook( __FILE__, array( 'Liquid_Portfolio', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Liquid_Portfolio', 'deactivate' ) );