<?php
/**
 * The Asset Manager
 * Enqueue scripts and styles for the frontend
 */

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Theme_Assets extends Liquid_Base {

    /**
     * Hold data for wa_theme for frontend
     * @var array
     */
    private static $theme_json = array();

	/**
	 * [__construct description]
	 * @method __construct
	 */
    public function __construct() {

        // Frontend
        $this->add_action( 'wp_enqueue_scripts', 'dequeue', 2 );
        $this->add_action( 'wp_enqueue_scripts', 'register' );
        $this->add_action( 'wp_enqueue_scripts', 'enqueue' );
        $this->add_action( 'wp_enqueue_scripts', 'add_color_variables' );
        $this->add_action( 'wp_enqueue_scripts', 'woo_register' );
        $this->add_action( 'wp_enqueue_scripts', 'add_ajax_single_product' );
		$this->add_action( 'enqueue_block_editor_assets', 'gutenberg' );
        $this->add_action( 'wp_footer', 'script_data' );
        $this->add_action( 'liquid_before', 'add_head_vars', 0 ); 
		$this->add_action( 'wp_head', 'add_head_liquidparams' );
        $this->add_action( 'vc_frontend_editor_enqueue_js_css', 'enqueue' );

        self::add_config( 'uris', array(
            'ajax'    => admin_url('admin-ajax.php', 'relative')
        ));
    }

    /**
     * Unregister Scripts and Styles
     * @method dequeue
     * @return [type]  [description]
     */
    public function dequeue() {

    }

    /**
     * Register Scripts and Styles
     * @method register
     * @return [type]   [description]
     */
    public function register() {

        // Styles -----------------------------------------------------------

		// Icons
		$this->style( 'liquid-icons', $this->get_vendor_uri( 'liquid-icon/liquid-icon.min.css' ) );
		$this->style( 'font-awesome', $this->get_vendor_uri( 'font-awesome/css/font-awesome.min.css' ) );
		
		// Vendors
		$this->style( 'bootstrap', $this->get_vendor_uri( 'bootstrap/css/bootstrap.min.css' ) );
		$this->style( 'bootstrap-rtl', $this->get_vendor_uri( 'bootstrap/css/bootstrap-rtl.min.css' ) );
		$this->style( 'jquery-ui', $this->get_vendor_uri( 'jquery-ui/jquery-ui.css' ) );
		$this->style( 'flickity', $this->get_vendor_uri( 'flickity/flickity.min.css' ) );
		$this->style( 'fresco', $this->get_vendor_uri( 'fresco/css/fresco.css' ) );
		$this->style( 'lity', $this->get_vendor_uri( 'lity/lity.min.css' ) );
		$this->style( 'jquery-ytplayer', $this->get_vendor_uri( 'jqury.mb.YTPlayer/jquery.mb.YTPlayer-min.css' ) );
		
		//Theme Css
		$this->style( 'liquid-base', get_template_directory_uri() . '/style.css' );
		$this->style( 'liquid-light-scheme', $this->get_css_uri ( 'theme-scheme-light.min' ) );
		
		$this->style( 'liquid-theme', $this->get_css_uri( 'theme.min' ) );
		$this->style( 'liquid-rtl', $this->get_css_uri('theme-rtl.min' ) );
		
		$this->style( 'liquid-bbpress', $this->get_css_uri( 'theme-bbpress.min' ) );
		
		//Custom Css
		$this->style( 'liquid-custom', $this->get_css_uri( 'custom' ) );

		// Register ----------------------------------------------------------
		// Essentials
		$this->script( 'modernizr', $this->get_vendor_uri( 'modernizr.min.js' ), array( 'jquery' ), false );
		
		//Vendors
		$this->script( 'bootstrap', $this->get_vendor_uri( 'bootstrap/js/bootstrap.min.js' ), array( 'jquery' ) );
		$this->script( 'intersection-observer', $this->get_vendor_uri( 'intersection-observer.js' ), array( 'jquery' ) );
		$this->script( 'jquery-lazyload', $this->get_vendor_uri( 'lazyload.min.js' ), array( 'jquery' ) );
		$this->script( 'imagesloaded', $this->get_vendor_uri( 'imagesloaded.pkgd.min.js' ), array( 'jquery' ) );
		$this->script( 'jquery-ui', $this->get_vendor_uri( 'jquery-ui/jquery-ui.min.js' ), array( 'jquery' ) );
		$this->script( 'jquery-anime', $this->get_vendor_uri( 'anime.min.js' ), array( 'jquery' ) );
		$this->script( 'jquery-vivus', $this->get_vendor_uri( 'vivus.min.js' ), array( 'jquery' ) );
		$this->script( 'flickity', $this->get_vendor_uri( 'flickity/flickity.pkgd.min.js' ), array( 'jquery' ) );
		$this->script( 'flickity-fade', $this->get_vendor_uri( 'flickity/flickity-fade.min.js' ), array( 'jquery' ) );
		$this->script( 'jquery-fresco', $this->get_vendor_uri( 'fresco/js/fresco.js' ), array( 'jquery' ) );
		$this->script( 'splittext', $this->get_vendor_uri( 'greensock/utils/SplitText.min.js' ), array( 'jquery' ) );
		$this->script( 'scrollmagic', $this->get_vendor_uri( 'scrollmagic/ScrollMagic.min.js' ), array( 'jquery' ) );
		$this->script( 'isotope', $this->get_vendor_uri( 'isotope/isotope.pkgd.min.js' ), array( 'jquery' ) );
		$this->script( 'packery-mode', $this->get_vendor_uri( 'isotope/packery-mode.pkgd.min.js' ), array( 'jquery', 'isotope' ) );
		$this->script( 'jquery-particles', $this->get_vendor_uri( 'particles.min.js' ), array( 'jquery' ) );
		$this->script( 'circle-progress', $this->get_vendor_uri( 'circle-progress.min.js' ), array( 'jquery' ) );
		$this->script( 'lity', $this->get_vendor_uri( 'lity/lity.min.js' ), array( 'jquery' ) );
		$this->script( 'stackblur', $this->get_vendor_uri( 'StackBlur.js' ), array( 'jquery' ) );
		$this->script( 'jquery-countdown-plugin', $this->get_vendor_uri( 'countdown/jquery.plugin.min.js' ), array( 'jquery' ) );
		$this->script( 'jquery-countdown', $this->get_vendor_uri( 'countdown/jquery.countdown.min.js' ), array( 'jquery', 'jquery-countdown-plugin' ) );
		$this->script( 'jquery-fontfaceobserver', $this->get_vendor_uri( 'fontfaceobserver.js' ), array( 'jquery' ) );
		$this->script( 'jquery-ytplayer', $this->get_vendor_uri( 'jqury.mb.YTPlayer/jquery.mb.YTPlayer.min.js' ), array( 'jquery' ) );
		$this->script( 'jquery-tinycolor', $this->get_vendor_uri( 'tinycolor-min.js' ), array( 'jquery' ) );
		
		$this->script( 'pagePiling', $this->get_vendor_uri( 'pagePiling/dist/jquery.pagepiling.min.js' ), array( 'jquery' ) );

		$this->script( 'liquid-mailchimp-form', $this->get_js_uri( 'mailchimp-form' ), array( 'jquery' ) );
		wp_localize_script( 'liquid-mailchimp-form', 'ajax_liquid_mailchimp_form_object', array(
			'ajaxurl'        => admin_url( 'admin-ajax.php' ),
		));

		$deps = array(
			'modernizr',
			'bootstrap',
			'intersection-observer',
			'imagesloaded',
			'jquery-ui',
			'jquery-anime',
			'scrollmagic',
			'jquery-fontfaceobserver',
		);
		
		// LazyLoad
		$enable_lazyload = liquid_helper()->get_option( 'enable-lazy-load' );
		if( 'on' === $enable_lazyload ) {
			array_push( $deps,
				'jquery-lazyload'
			);
		}
		// Header Js
		$enable_header = liquid_helper()->get_option( 'header-enable-switch' );
		if( 'on' === $enable_header ) {
			array_push( $deps,
				'jquery-tinycolor'
			);
		}
		$enabled_stack = liquid_helper()->get_option( 'page-enable-stack' );
		if( 'on' === $enabled_stack ) {
			array_push( $deps,
				'pagePiling'
			);
		}
		if( is_archive() ) {
			array_push( $deps,
				'flickity',
				'packery-mode'
			);
		}
	    if( class_exists( 'WooCommerce' ) ) {
		    array_push( $deps,
				'flickity',
				'packery-mode'
			);

		}
		if( is_singular( 'liquid-portfolio' ) ) {
			array_push( $deps,
				'flickity',
				'packery-mode',
				'splittext'
			);
		}
		if( is_post_type_archive( 'liquid-portfolio' ) || is_tax( 'liquid-portfolio-category' ) ) {
			array_push( $deps,
				'flickity',
				'packery-mode'
			);
		}
		if( is_singular( 'post' ) ) {
			array_push( $deps,
				'flickity',
				'jquery-fresco',
				'splittext'
			);
		}
		if( is_page() ) {
			array_push( $deps,
				'splittext',
				'jquery-tinycolor'
			);
		}
		if( is_404() ) {
			array_push( $deps,
				'jquery-particles'
			);
		}
		
		
		
		// At the End
		$this->script( 'liquid-theme', $this->get_js_uri( 'theme.min' ), $deps );
		$this->script( 'google-maps-api', $this->google_map_api_url() );
		
    }

    /**
     * Enqueue Scripts and Styles
     * @method enqueue
     * @return [type]  [description]
     */
    public function enqueue() {
	    
        // Styles-----------------------------------------------------
		$font_icons = liquid_helper()->get_theme_option( 'font-icons' );
		if( !empty( $font_icons ) ) {
			foreach( $font_icons as $handle ) {
				wp_enqueue_style( $handle );
			}
		}
		else {
			wp_enqueue_style( 'liquid-icons' );
		}
		$page_color_scheme = liquid_helper()->get_option( 'body-color-scheme' );
	
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'bootstrap' );
		if( is_rtl() ) {
			wp_enqueue_style( 'bootstrap-rtl' );
		}
		wp_enqueue_style( 'jquery-ui' );
		
		//Enqueue portfolio.css only on portfolio css
		if( is_singular( 'liquid-portfolio' )          || 
			is_post_type_archive( 'liquid-portfolio' ) || 
			is_tax( 'liquid-portfolio-category' ) 
		) {
			wp_enqueue_style( 'flickity' );
		}
		
		if( is_singular( 'post' ) ) {
			wp_enqueue_style( 'fresco' );
			wp_enqueue_style( 'flickity' );
		}
		
		do_action( 'liquid_shortcodes_styles' );
		
		//Base css files
		wp_enqueue_style( 'liquid-base' );
		wp_enqueue_style( 'liquid-theme' );

		if( is_rtl() ) {
			wp_enqueue_style( 'liquid-rtl' );
		}


		if( 'light' === $page_color_scheme )  {
			wp_enqueue_style( 'liquid-light-scheme' );	
		}
		
		if ( class_exists('bbPress') ) {
			wp_enqueue_style( 'liquid-bbpress' );
		}
		
        // Scripts -----------------------------------------------------
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		wp_enqueue_script( 'liquid-theme' );
		if( !class_exists( 'ReduxFrameworkPlugin' ) ) {
			wp_enqueue_style( 'google-font-roboto', $this->google_default_fonts_url(), array(), '1.0' );
		}

	}
		
	//Adding Gutenberg support
	public function gutenberg() {

		// Load the theme styles within Gutenberg.
		wp_enqueue_style( 'liquid-gutenberg', $this->get_css_uri( 'theme-gutenberg' ) );

	}

	public function google_map_api_url() {

		$api_key = liquid_helper()->get_theme_option( 'google-api-key' );
		$google_map_api = add_query_arg( 'key', $api_key, '//maps.googleapis.com/maps/api/js' );

		return $google_map_api;
	}

	public function google_default_fonts_url() {
		 $font_url = add_query_arg( 'family', urlencode( 'Roboto:400,500&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
		 return $font_url;
	}

    //Register the woocommerce  shop styles
    public function woo_register() {

	    //check if woocommerce is activated and styles are loaded
	    if( class_exists( 'WooCommerce' ) ) {
			$deps = array( 'woocommerce-layout', 'woocommerce-smallscreen', 'woocommerce-general' );
			$this->style( 'theme-shop', $this->get_css_uri('theme-shop.min'), $deps );
			wp_enqueue_style( 'flickity' );
			wp_enqueue_style( 'theme-shop' );
	    }

    }
    
	public function add_ajax_single_product() {
		
		if( class_exists( 'WooCommerce' ) && apply_filters( 'liquid_ajax_add_to_cart_single_product', '__return_true' ) ) {
	    
			wp_enqueue_script( 'liquid_add_to_cart_ajax', get_template_directory_uri() . '/liquid/vendors/woocommerce/js/liquid_add_to_cart_ajax.js', array( 'jquery' ), null, true );
			wp_localize_script( 'liquid_add_to_cart_ajax', 'liquid_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	    
	    }
	    
    }
	
	public function add_color_variables() {

		wp_enqueue_script( 'color-variable', $this->get_vendor_uri( 'inline.js' ), array(), '1.0' );
		wp_add_inline_script( 'color-variable', 'function testCSSVariables(){var e="rgb(255, 198, 0)",o=document.createElement("span");o.style.setProperty("--color",e),o.style.setProperty("background","var(--color)"),document.body.appendChild(o);var r=getComputedStyle(o).backgroundColor===e;return document.body.removeChild(o),r};' );
	
	}
	
	public function add_head_vars() {
		
		echo '<script type="text/javascript">
				(function() {
					if(!testCSSVariables()){var script=document.createElement("script"),body=document.querySelector("body");script.onreadystatechange = function () { if (this.readyState == \'complete\' || this.readyState == \'loaded\') { cssVars(); } };script.onload = function() { cssVars(); };script.src="assets/vendors/css-vars-ponyfill.min.js",body.insertBefore(script,body.lastChild);};
				}());
			</script>';	
	}
	
	public function add_head_liquidparams() {

		$media_mobile_nav = liquid_helper()->get_option( 'media-mobile-nav' );
		$mobileBreakpoint = !empty( $media_mobile_nav ) ? $media_mobile_nav : '1199';
		$tat = $scroll_speed = '';
		
		$enable = liquid_helper()->get_option( 'enable-animations-threshold' );
		if( 'on' == $enable ) {
			$tat = 'tat:0,';
		}
		
		$local_scroll_speed = liquid_helper()->get_option( 'pagescroll-speed' );
		if( !empty( $local_scroll_speed ) ) {
			$scroll_speed = 'localscrollSpeed:' . $local_scroll_speed . ',';
		}
		
		echo '<script type="text/javascript">
				window.liquidParams = {'
					.$tat.
					$scroll_speed.
					'mobileNavBreakpoint:' . $mobileBreakpoint . '
				}	
			  </script>';
	}

    /**
     * Localize Data Object
     * @method script_data
     * @return [type]      [description]
     */
    public function script_data() {

        wp_localize_script( 'liquid-theme', 'liquidTheme', self::$theme_json );
    }

    // Register Helpers ----------------------------------------------------------
    public function script( $handle, $src, $deps = null, $in_footer = true, $ver = null ) {
        wp_register_script( $handle, $src, $deps, $ver, $in_footer);
    }

    public function style( $handle, $src, $deps = null, $ver = null, $media = 'all' ) {
        wp_register_style( $handle, $src, $deps, $ver, $media );
    }

    /**
     * Add items to JSON object
     * @method add_config
     * @param  [type]     $id    [description]
     * @param  string     $value [description]
     */
    public static function add_config( $id, $value = '' ) {

        if(!$id) {
            return;
        }

        if(isset(self::$theme_json[$id])) {
            if(is_array(self::$theme_json[$id])) {
                self::$theme_json[$id] = array_merge(self::$theme_json[$id],$value);
            }
            elseif(is_string(self::$theme_json[$id])) {
                self::$theme_json[$id] = self::$theme_json[$id].$value;
            }
        }
        else {
            self::$theme_json[$id] = $value;
        }
    }

    // Uri Helpers ---------------------------------------------------------------

    public function get_theme_uri($file = '') {
        return get_template_directory_uri() . '/' . $file;
    }

    public function get_child_uri($file = '') {
        return get_stylesheet_directory_uri() . '/' . $file;
    }

    public function get_css_uri($file = '') {
        return $this->get_theme_uri('assets/css/'.$file.'.css');
    }

    public function get_elements_uri( $file = '' ) {
		return $this->get_theme_uri( 'assets/css/elements/' . $file . '.css' );
    }

    public function get_js_uri($file = '') {
        return $this->get_theme_uri('assets/js/'.$file.'.js');
    }

    public function get_vendor_uri($file = '') {
        return $this->get_theme_uri('assets/vendors/'.$file);
    }
}
new Liquid_Theme_Assets;