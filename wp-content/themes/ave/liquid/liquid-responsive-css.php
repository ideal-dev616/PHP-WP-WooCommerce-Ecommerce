<?php
/**
* LiquidThemes Theme Framework
* The Liquid_Responsive_CSS initiate dynamic css.
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Responsive_CSS extends Liquid_Base {

	public static $mode;
	
	public static $version = '100';

	public function __construct() {

		// Set mode
		$this->add_action( 'wp', 'set_mode' );

		// Add the CSS
		$this->add_action( 'wp_enqueue_scripts', 'enqueue_responsive_css', 999 );
	}
	
	// Set mode -----------------------------------------------

	/**
	 * Determine if we're using file mode or inline mode.
	 */
	public function set_mode() {

		// Check if we're using file mode or inline mode.
		$mode = 'file';

		// Attempt to write to the file.
		if( !file_exists( $this->file( 'path' ) ) || $this->check_the_value() ) {
			$mode = ( $this->can_write() && $this->make_css() ) ? 'file' : 'inline';	
		}
		// Does again if the file exists.
		if ( 'file' == $mode ) {
			$mode = ( file_exists( $this->file( 'path' ) ) ) ? 'file' : 'inline';
		}


		self::$mode = $mode;
	}

	/**
	 * This function takes care of creating the CSS.
	 *
	 * @return  bool 	true/false depending on whether the file is successfully created or not.
	 */
	public function make_css() {

		global $wp_filesystem;

		// Initialize the WordPress filesystem.
		if ( empty( $wp_filesystem ) ) {
			require_once( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		$content = "/********* Compiled - Do not edit *********/\n" . $this->responsive_css_cached();

		// Take care of domain mapping
		if ( defined( 'DOMAIN_MAPPING' ) && DOMAIN_MAPPING ) {

			if ( function_exists( 'domain_mapping_siteurl' ) && function_exists( 'get_original_url' ) ) {

				$mapped_domain   = domain_mapping_siteurl( false );
				$mapped_domain   = str_replace( 'https://', '//', $domain_mapping );
				$mapped_domain   = str_replace( 'http://', '//', $mapped_domain );

				$original_domain = get_original_url( 'siteurl' );
				$original_domain = str_replace( 'https://', '//', $original_domain );
				$original_domain = str_replace( 'http://', '//', $original_domain );

				$content = str_replace( $original_domain, $mapped_domain, $content );
			}
		}

		// Replace wp-content url with relative path
		$upload_dir = wp_upload_dir();
		$content    = str_replace( $upload_dir['baseurl'], '..', $content );
		$content    = str_replace( content_url(), '../..', $content );

		// Strip protocols. This helps avoid any issues with https sites.
		$content = str_replace( 'https://', '//', $content );
		$content = str_replace( 'http://', '//', $content );
		if ( !defined( 'FS_CHMOD_FILE' ) ) {
			define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );
		}
		if ( ! $wp_filesystem->put_contents( $this->file( 'path' ), $content, FS_CHMOD_FILE ) ) {

			// Fail!
			return false;

		}
	}


	/*
	 * Determines if the CSS file is writable.
	 */
	public function can_write() {

		// Get the blog ID.
		$blog_id = 1;
		if ( is_multisite() ) {
			$current_site = get_blog_details();
			$blog_id      = $current_site->blog_id;
		}

		// Get the upload directory for this site.
		$upload_dir = wp_upload_dir();

		$version = self::$version;
		$file_name   = '/liquid-responsive-' . $version . '.css';
		$folder_path = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'liquid-styles';

		// Does the folder exist?
		if ( file_exists( $folder_path ) ) {
			// Folder exists, but is the folder writable?
			if ( ! is_writable( $folder_path ) ) {
				// Folder is not writable.
				// Does the file exist?
				if ( ! file_exists( $folder_path . $file_name ) ) {
					// File does not exist, therefore it can't be created
					// since the parent folder is not writable.
					return false;
				} else {
					// File exists, but is it writable?
					if ( ! is_writable( $folder_path . $file_name ) ) {
						// Nope, it's not writable.
						return false;
					}
				}
			} else {
				// The folder is writable.
				// Does the file exist?
				if ( file_exists( $folder_path . $file_name ) ) {
					// File exists.
					// Is it writable?
					if ( ! is_writable( $folder_path . $file_name ) ) {
						// Nope, it's not writable
						return false;
					}
				}
			}
		} else {
			// Can we create the folder?
			// returns true if yes and false if not.
			return wp_mkdir_p( $folder_path );
		}

		// all is well!
		return true;
	}

	/*
	 * Gets the css path or url to the stylesheet
	 *
	 * @var 	string 	path/url
	 * @return 	string  path or url to the file depending on the $target var.
	 */
	public function file( $target = 'path' ) {

		// Get the blog ID.
		$blog_id = 1;
		if ( is_multisite() ) {
			$current_site = get_blog_details();
			$blog_id      = $current_site->blog_id;
		}

		// Get the upload directory for this site.
		$upload_dir = wp_upload_dir();

		$version = self::$version;
		$file_name   = '/liquid-responsive-' . $version . '.css';

		$folder_path = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'liquid-styles';

		// The complete path to the file.
		$file_path = $folder_path . DIRECTORY_SEPARATOR . $file_name;
		// Get the URL directory of the stylesheet
		$css_uri_folder = $upload_dir['baseurl'];

		$css_uri = trailingslashit( $css_uri_folder ) . 'liquid-styles' . $file_name;

		// Take care of domain mapping
		if ( defined( 'DOMAIN_MAPPING' ) && DOMAIN_MAPPING ) {
			if ( function_exists( 'domain_mapping_siteurl' ) && function_exists( 'get_original_url' ) ) {
				$mapped_domain   = domain_mapping_siteurl( false );
				$original_domain = get_original_url( 'siteurl' );
				$css_uri = str_replace( $original_domain, $mapped_domain, $css_uri );
			}
		}

		// Strip protocols
		$css_uri = str_replace( 'https://', '//', $css_uri );
		$css_uri = str_replace( 'http://', '//', $css_uri );

		if ( 'path' == $target ) {
			return $file_path;
		}
		elseif ( 'url' == $target || 'uri' == $target ) {
			$timestamp = ( file_exists( $file_path ) ) ? '?timestamp=' . filemtime( $file_path ) : '';
			return $css_uri . $timestamp;
		}
	}
	
	public function check_the_value() {
		
		$the_value       = liquid_helper()->get_option( 'media-mobile-nav' );
		$old_value       = get_option( 'liquid_responsive_value', array() );
		$site_layout     = liquid_helper()->get_option( 'page-layout' );
		$old_site_layout = get_option( 'liquid_page_layout', array() );
		$site_width      = liquid_helper()->get_option( 'site-width' );
		$old_site_width  = get_option( 'liquid_site_width', array() );
		
		if( $the_value === $old_value && $site_layout === $old_site_layout && $site_width === $old_site_width ) {
			return false;
		}
		else {
			update_option( 'liquid_responsive_value', $the_value );
			update_option( 'liquid_page_layout', $site_layout );
			update_option( 'liquid_site_width', $site_width );
			return true;
		}
	}

	// Dynamic CSS Helpers -----------------------------------------------

	/**
	 * Returns the dynamic CSS.
	 * If possible, it also caches the CSS using WordPress transients
	 * @method dynamic_css_cached
	 * @return  string  the dynamically-generated CSS.
	 */
	public function responsive_css_cached() {

		$responsive_css = $this->responsive_css();

		return $responsive_css;
	}

	/**
	 * [dynamic_css description]
	 * @method dynamic_css
	 * @return [type]      [description]
	 */
	public function responsive_css() {

		/**
		 * Calculate the dynamic CSS
		 */
		$responsive_css = liquid_responsive_css();

		return $responsive_css;
	}

	// Add the CSS -----------------------------------------------

	/**
	 * Enqueue the dynamic CSS.
	 */
	public function enqueue_responsive_css() {
		
		// Yay! we're using a file for our CSS, so enqueue it.
		wp_enqueue_style( 'liquid-generated-responsive', $this->file( 'uri' ) );

	}
}
if( !class_exists( 'Liquid_Addons' ) ) {
	new Liquid_Responsive_CSS;
}
