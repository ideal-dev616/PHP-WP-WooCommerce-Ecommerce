<?php
/**
* Liquid Themes Theme Framework
* The Liquid_Admin initiate the theme admin
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Admin extends Liquid_Base {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Envato Market
		get_template_part( 'liquid/libs/importer/liquid', 'importer' );

		$this->add_action( 'init', 'init', 7 );
		$this->add_action( 'admin_init', 'save_plugins' );
		$this->add_action( 'admin_enqueue_scripts', 'enqueue', 99 );
		$this->add_action( 'admin_menu', 'fix_parent_menu', 999 );

		$this->add_action( 'vc_backend_editor_enqueue_js_css', 'vc_iconpicker_editor_jscss' );
		$this->add_action( 'vc_frontend_editor_enqueue_js_css', 'vc_iconpicker_editor_jscss' );
		$this->add_action( 'vc_frontend_editor_enqueue_js_css', 'vc_frontend_editor_js' );
		
		//Add filters for header custom posts
		$this->add_filter( 'vc_add_element_categories', 'vc_header_elements_tabs' );
		$this->add_filter( 'default_content', 'default_header_content', 10, 2 );

	}

	/**
	 * [init description]
	 * @method init
	 * @return [type] [description]
	 */
	public function init() {

		liquid()->load_theme_part( 'liquid-register-plugins' );

		include_once( get_template_directory() . '/liquid/admin/liquid-admin-page.php' );
		include_once( get_template_directory() . '/liquid/admin/liquid-admin-dashboard.php' );
		include_once( get_template_directory() . '/liquid/admin/liquid-admin-plugins.php' ) ;
		include_once( get_template_directory() . '/liquid/admin/liquid-admin-import.php' );
		include_once( get_template_directory() . '/liquid/admin/liquid-admin-support.php' );
	}

	/**
	 * [enqueue description]
	 * @method enqueue
	 * @return [type] [description]
	 */
    public function enqueue() {
	    
	    global $pagenow;
		
		//RTL Bootstrap
		if( is_rtl() ) {
			wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/assets/vendors/bootstrap-rtl/bootstrap-rtl.min.css' );	
		}

		if( 'nav-menus.php' == $pagenow || 'widgets.php' == $pagenow ) {
			//iconpicker
			wp_enqueue_style( 'liquid-icon-picker-main-css', liquid()->load_assets( 'vendors/iconpicker/css/jquery.fonticonpicker.min.css' ) );
			wp_enqueue_style( 'liquid-icon-picker-main-css-theme', liquid()->load_assets( 'vendors/iconpicker/themes/grey-theme/jquery.fonticonpicker.grey.min.css' ) );
		}

		//imagepicker
		wp_enqueue_style( 'liquid-imagepicker-css', liquid()->load_assets( 'vendors/image-picker/image-picker.css' ) );
		wp_enqueue_style( 'jquery-confirm-css', liquid()->load_assets( 'css/jquery-confirm.min.css' ) );

		if( 'nav-menus.php' == $pagenow || 'widgets.php' == $pagenow ) {
			wp_enqueue_script( 'liquid-icon-picker', liquid()->load_assets( 'vendors/iconpicker/jquery.fonticonpicker.min.js' ), array( 'jquery' ), false, true );
			wp_enqueue_script( 'liquid-custom-icon-upload', liquid()->load_assets( 'js/liquid-custom-icon-upload.js' ), array( 'jquery' ), false, true );
			wp_localize_script(
				'liquid-custom-icon-upload', 'liquidMenuCustomIcon', array(
					'l10n'     => array(
						'uploaderTitle'      => esc_html__( 'Choose an image/svg icon', 'ave' ),
						'uploaderButtonText' => esc_html__( 'Select', 'ave' ),
					),
					'settings' => array(
						'nonce' => wp_create_nonce( 'update-menu-item' ),
					),
				)
			);
			wp_enqueue_media();
		}
		
		wp_enqueue_style( 'lqd-dashboard', liquid()->load_assets( 'css/liquid-dashboard.min.css' ) );
		wp_enqueue_script( 'intersection-observer', get_template_directory_uri() . '/assets/vendors/intersection-observer.js', array( 'jquery' ), false, true );

		wp_enqueue_script( 'liquid-image-picker', liquid()->load_assets( 'vendors/image-picker/image-picker.min.js' ), array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-confirm', liquid()->load_assets( 'js/jquery-confirm.min.js' ), array( 'jquery' ), false, true );
		wp_enqueue_script( 'liquid-admin', liquid()->load_assets( 'js/liquid-admin.js' ), array( 'jquery', 'intersection-observer', 'underscore', 'liquid-image-picker' ), false, true );
		wp_localize_script( 'liquid-admin', 'liquid_admin_messages', array(
			'reset_title'     => wp_kses_post( __( '<span class="dashicons dashicons-info"></span> Reset', 'ave' ) ),
			'reset_message'   => esc_html__( 'Remove posts, pages, media and any other content on your current site, We strongly recommend to reset before importing ( even if this is a fresh site ) to avoid any overlap or conflict with your current content.<br/><strong>Note:</strong> Don\'t use the reset option if you are trying to import some parts only ( For example if you are going to import theme options only then you may continue without reset )', 'ave' ),
			'reset_confirm'   => esc_html__( 'Reset Then Import', 'ave' ),
			'reset_continue'  => esc_html__( 'Keep Importing Without Resetting', 'ave' ),
			'reset_final_confirm' => esc_html__( 'I understand', 'ave' ),
			'reset_final_title'   => wp_kses_post( __( '<span class="dashicons dashicons-warning"></span> Warning', 'ave' ) ),
			'reset_final_message' => esc_html__( 'Since you selected to reset before importing please be aware this action cannot be reversed ( Any removed content cannot be restored )', 'ave' )
		) );
		
		
		$enable_help_beacon = liquid_helper()->get_option( 'enable-help-beacon' );
		if( 'on' == $enable_help_beacon ) {
			wp_enqueue_script( 'liquid-helpscout', liquid()->load_assets( 'js/lqd-helpscout.js' ), array( 'jquery' ), false, true );	
		}

		// Icons
		$uri = get_template_directory_uri() . '/assets/vendors/' ;
		wp_register_style('liquid-icons', $uri . 'liquid-icon/liquid-icon.min.css' );

    }

	public function vc_frontend_editor_js() {
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
			'jquery-lazyload',
			'imagesloaded',
			'jquery-ui',
			'jquery-anime',
			'jquery-vivus',
			'flickity',
			'jquery-fresco',
			'splittext',
			'scrollmagic',
			'packery-mode',
			'jquery-particles',
			'circle-progress',
			'lity',
			'stackblur',
			'jquery-countdown',
			'jquery-fontfaceobserver',
			'jquery-ytplayer',
			'jquery-tinycolor'
		);
		
		$enabled_stack = liquid_helper()->get_option( 'page-enable-stack' );
		if( 'on' === $enabled_stack ) {
			array_push( $deps,
				'pagePiling'
			);
		}
		
		// At the End
		$this->script( 'liquid-theme', $this->get_js_uri( 'theme.min' ), $deps );
		wp_enqueue_script( 'liquid-theme' );
	}

	public function vc_iconpicker_editor_jscss() {

		$font_icons = liquid_helper()->get_theme_option( 'font-icons' );
		if( !empty( $font_icons ) ) {
			foreach( $font_icons as $handle ) {
				wp_enqueue_style( $handle );
			}
		}
		else {
			wp_enqueue_style( 'liquid-icons' );
		}
	}
	
	public function admin_redirects() {

		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			wp_redirect( admin_url( 'admin.php?page=liquid' ) );
			exit;
		}
	}
	
	public function default_header_content( $content, $post ) {
		
		global $post_type;
	 	
	    if( 'liquid-header' !== $post_type ) {
		    return $content;
		}
		
		$content = '[vc_row header_type="secondarybar"][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][/vc_row][vc_row][vc_column width="1/3"][ld_header_image uselogo="yes"][/vc_column][vc_column width="1/3"][ld_header_collapsed][ld_header_menu hover_style="underline-2" menu_slug="primary"][/ld_header_collapsed][/vc_column][vc_column width="1/3" align="text-right" responsive_align="text-lg-right"][ld_header_button ib_style="btn-default" ib_title="Purchase now" ib_transformation="text-uppercase" ib_border="border-thick" ib_fs="13px" ib_fw="700" ib_ls="0.2em"][/vc_column][/vc_row][vc_row header_type="secondarybar"][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][vc_column width="1/3"][/vc_column][/vc_row]';

	    return $content;
	}    
    
    public function vc_header_elements_tabs( $tabs ) {
	    
		global $post_type;

		if( 'liquid-header' !== $post_type ) {
			
			foreach( $tabs as $key => $tab ) {
				if( 'Header Containers' === $tab['name'] || 'Header Modules' === $tab['name'] ) {
					unset( $tabs[$key] );
				}
			}
			return $tabs;
		}

	    $tabs = array(
			array(
				'name' => esc_html__( 'Header Modules', 'ave' ),
				'active' => false,
				'filter' => '.js-category-' . md5( 'Header Modules' ),
			),
		);
	    
	    return $tabs; 
	    
    }
    
	// Register Helpers ----------------------------------------------------------
    public function script( $handle, $src, $deps = null, $in_footer = true, $ver = null ) {
        wp_register_script( $handle, $src, $deps, $ver, $in_footer);
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

	/**
	 * [fix_parent_menu description]
	 * @method fix_parent_menu
	 * @return [type]          [description]
	 */
	public function fix_parent_menu() {

        if ( !current_user_can( 'edit_theme_options' ) ) {
            return;
        }
		
		global $submenu;

		$submenu['liquid'][0][0] = esc_html__( 'Dashboard', 'ave' );

		remove_submenu_page( 'themes.php', 'tgmpa-install-plugins' );
		remove_submenu_page( 'tools.php', 'redux-about' );
	}

	/**
	 * [save_plugins description]
	 * @method save_plugins
	 * @return [type]       [description]
	 */
	public function save_plugins() {

        if ( !current_user_can( 'edit_theme_options' ) ) {
            return;
        }

		// Deactivate Plugin
        if ( isset( $_GET['liquid-deactivate'] ) && 'deactivate-plugin' == $_GET['liquid-deactivate'] ) {

			check_admin_referer( 'liquid-deactivate', 'liquid-deactivate-nonce' );

			$plugins = TGM_Plugin_Activation::$instance->plugins;

			foreach( $plugins as $plugin ) {
				if ( $plugin['slug'] == $_GET['plugin'] ) {

					deactivate_plugins( $plugin['file_path'] );

                    wp_redirect( admin_url( 'admin.php?page=' . $_GET['page'] ) );
					exit;
				}
			}
		}

		// Activate plugin
		if ( isset( $_GET['liquid-activate'] ) && 'activate-plugin' == $_GET['liquid-activate'] ) {

			check_admin_referer( 'liquid-activate', 'liquid-activate-nonce' );

			$plugins = TGM_Plugin_Activation::$instance->plugins;

			foreach( $plugins as $plugin ) {
				if ( $plugin['slug'] == $_GET['plugin'] ) {

					activate_plugin( $plugin['file_path'] );

					wp_redirect( admin_url( 'admin.php?page=' . $_GET['page'] ) );
					exit;
				}
			}
		}
    }
}
new Liquid_Admin;
