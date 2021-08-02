<?php
/**
* LiquidThemes Theme Framework
* The Liquid_Dynamic_CSS initiate dynamic css.
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Dynamic_CSS extends Liquid_Base {

	public static $mode;

	public function __construct() {

		$this->add_options();

		// Set mode
		$this->add_action( 'wp', 'set_mode' );

		// When a post is saved, reset its caches to force-regenerate the CSS.
		$this->add_action( 'save_post', 'reset_post_transient' );
		$this->add_action( 'save_post', 'post_update_option' );

		// When we change the options, reset all caches so that all CSS can be re-generated
		// Make sure caches are reset when saving/resetting options
		$opt_name = liquid()->get_option_name();
		$this->add_action( 'redux/options/' . $opt_name . '/reset', 'reset_all_caches' );
		$this->add_action( 'redux/options/' . $opt_name . '/section/reset', 'reset_all_caches' );
		$this->add_action( 'redux/options/' . $opt_name . '/saved', 'reset_all_caches' );
		$this->add_action( 'customize_save_after', 'reset_all_caches' );

		// Add the CSS
		$this->add_action( 'wp_enqueue_scripts', 'enqueue_dynamic_css', 999 );
		$this->add_action( 'wp_head', 'add_inline_css', 999 );
	}

	// Set mode -----------------------------------------------

	/**
	 * Determine if we're using file mode or inline mode.
	 */
	public function set_mode() {

		// Check if we're using file mode or inline mode.
		$mode = liquid_helper()->get_theme_option( 'dynamic_css_compiler' ) ? 'file' : 'inline';

		// ALWAYS use 'inline' mode when in the customizer.
		global $wp_customize;
		if ( $wp_customize ) {
			return 'inline';
		}

		// Additional checks for file mode.
		if ( 'file' == $mode && $this->needs_update() ) {
			// Only allow processing 1 file every 5 seconds.
			$current_time = (int) time();
			$last_time    = (int) get_option( 'liquid_dynamic_css_time' );

			if ( 5 <= ( $current_time - $last_time ) ) {
				// Attempt to write to the file.
				$mode = ( $this->can_write() && $this->make_css() ) ? 'file' : 'inline';
				// Does again if the file exists.
				if ( 'file' == $mode ) {
					$mode = ( file_exists( $this->file( 'path' ) ) ) ? 'file' : 'inline';
				}
			} else {
				// It's been less than 5 seconds since we last compiled a CSS file
				// In order to prevent server meltdowns on weak servers we'll use inline mode instead.
				$mode = 'inline';
			}
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

		$content = "/********* Compiled - Do not edit *********/\n" . $this->dynamic_css_cached();

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
		else {

			// Update the opion in the db so that we know the css for this post has been successfully generated.
			$page_id = $this->page_id() ? $this->page_id() : 'global';
			$option  = get_option( 'liquid_dynamic_css_posts', array() );
			$option[$page_id] = true;
			update_option( 'liquid_dynamic_css_posts', $option );

			// Update the 'dynamic_css_time' option.
			$this->update_saved_time();

			// Success!
			return true;
		}
	}

	/**
	 * Do we need to update the CSS file?
	 */
	public function needs_update() {

		// Get the 'liquid_dynamic_css_posts' option from the DB
		$option  = get_option( 'liquid_dynamic_css_posts', array() );

		// Get the current page ID
		$page_id = ( $this->page_id() ) ? $this->page_id() : 'global';

		// If the CSS file does not exist then we definitely need to regenerate the CSS.
		if ( ! file_exists( $this->file( 'path' ) ) ) {
			return true;
		}

		// If the current page ID exists in the array of pages defined in the 'liquid_dynamic_css_posts' option
		// then the page has already been compiled and we don't need to re-compile it.
		// If it's not in the array then it has not been compiled before so we need to update it.
		return ( ! isset( $option[ $page_id ] ) || ! $option[ $page_id ] ) ? true : false;
	}

	/**
	 * get the current page ID.
	 */
	public function page_id() {

		global $post;
		$id = false;

		if ( isset( $post ) ) {

			// If this is a  singular page/post then set ID to the page ID.
			// If not, then set it to false.
			$id = is_singular() ? $post->ID : false;

			// If we're on the WooCommerce shop page, get the ID of the page
			// using the 'woocommerce_shop_page_id' option
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				$id = get_option( 'woocommerce_shop_page_id' );
			}

			// If we're on the posts page, get the ID of the page
			// using the 'page_for_posts' option.
			if ( is_home() ) {
				$id = get_option( 'page_for_posts' );
			}
		}

		return $id;
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

		// If this is a multisite installation, append the blogid to the filename
		$blog_id = ( is_multisite() && $blog_id > 1 ) ? '_blog-' . $blog_id : null;
		$page_id = ( $this->page_id() ) ? $this->page_id() : 'global';

		$file_name   = '/liquid-css' . $blog_id . '-' . $page_id . '.css';
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

		// If this is a multisite installation, append the blogid to the filename
		$blog_id = ( is_multisite() && $blog_id > 1 ) ? '_blog-' . $blog_id : null;
		$page_id = ( $this->page_id() ) ? $this->page_id() : 'global';

		$file_name   = 'liquid-css' . $blog_id . '-' . $page_id . '.css';
		$folder_path = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'liquid-styles';

		// The complete path to the file.
		$file_path = $folder_path . DIRECTORY_SEPARATOR . $file_name;
		// Get the URL directory of the stylesheet
		$css_uri_folder = $upload_dir['baseurl'];

		$css_uri = trailingslashit( $css_uri_folder ) . 'liquid-styles/' . $file_name;

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

	// Dynamic CSS Helpers -----------------------------------------------

	/**
	 * Returns the dynamic CSS.
	 * If possible, it also caches the CSS using WordPress transients
	 * @method dynamic_css_cached
	 * @return  string  the dynamically-generated CSS.
	 */
	public function dynamic_css_cached() {

		$page_id = $this->page_id();

		/**
		 * do we have WP_DEBUG set to true?
		 * If yes, then do not cache.
		 */
		$cache = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? false : true;

		/**
		 * If the dynamic_css_db_caching option is not set
		 * or set to off, then do not cache.
		 */
		$cache = ( $cache && ( null == liquid_helper()->get_theme_option( 'dynamic_css_db_caching' ) || ! liquid_helper()->get_theme_option( 'dynamic_css_db_caching' ) ) ) ? false : $cache;

		/**
		 * Check if we're using file mode or inline mode.
		 * This simply checks the dynamic_css_compiler options.
		 */
		$mode = self::$mode;

		/**
		 * ALWAYS use 'inline' mode when in the customizer.
		 */
		global $wp_customize;
		if ( $wp_customize ) {
			$mode = 'inline';
		}

		$cache = ( $cache && 'file' == $mode ) ? false : $cache;

		if( $cache ) {

			/*
			 * Get the Page ID
			 */
			$page_id = $this->page_id();

			/**
		 	 * Build the transient name
		 	 */
			$transient_name = $page_id ? 'liquid_dynamic_css_' . $page_id : 'liquid_dynamic_css_global';

			/**
			 * Check if the dynamic CSS needs updating
			 * If it does, then calculate the CSS and then update the transient.
			 */
			if ( $this->needs_update() ) {

				$dynamic_css = $this->dynamic_css();

				/**
				 * Set the transient for an hour
				 */
				set_transient( $transient_name, $dynamic_css, 60 * 60 );

			}
			else {

				/**
				 * Check if the transient exists.
				 * If it does not exist, then generate the CSS and update the transient.
				 */
				if ( false === ( $dynamic_css = get_transient( $transient_name ) ) ) {

					$dynamic_css = $this->dynamic_css();

					/**
					 * Set the transient for an hour
					 */
					set_transient( $transient_name, $dynamic_css, 60 * 60 );
				}
			}
		}
		else {

			$dynamic_css = $this->dynamic_css();
		}

		return $dynamic_css;
	}

	/**
	 * [dynamic_css description]
	 * @method dynamic_css
	 * @return [type]      [description]
	 */
	public function dynamic_css() {

		/**
		 * Calculate the dynamic CSS
		 */
		$dynamic_css = $this->dynamic_css_parser( liquid_dynamic_css_array() );

		/**
		 * Append the user-entered dynamic CSS
		 */
		$dynamic_css .= wp_strip_all_tags( liquid_helper()->get_theme_option( 'custom_css' ) );

		return $dynamic_css;
	}

	/**
	 * Get the array of dynamically-generated CSS and convert it to a string.
	 * Parses the array and adds prefixes for browser-support.
	 * @method dynamic_css_parser
	 *
	 * @param  [type]             $css [description]
	 * @return [type]                  [description]
	 */
	public function dynamic_css_parser( $css ) {

		/**
		 * Prefixes
		 */
		foreach ( $css as $media_query => $elements ) {
			foreach ( $elements as $element => $style_array ) {
				foreach ( $style_array as $property => $value ) {

					// transform
					if ( 'transform' == $property ) {
						$css[$media_query][$element]['-webkit-transform'] = $value;
					}
					// transition
					elseif ( 'transition' == $property ) {
						$css[$media_query][$element]['-webkit-transition'] = $value;
					}
					// transition-property
					elseif ( 'transition-property' == $property ) {
						$css[$media_query][$element]['-webkit-transition-property'] = $value;
					}
					// linear-gradient
					elseif ( is_array( $value ) ) {
						foreach ( $value as $subvalue ) {
							if ( false !== strpos( $subvalue, 'linear-gradient' ) ) {
								$css[$media_query][$element][$property][] = '-webkit-' . $subvalue;
							}
							// calc
							elseif ( 0 === stripos( $subvalue, 'calc' ) ) {
								$css[$media_query][$element][$property][] = '-webkit-' . $subvalue;
							}
						}
					}
				}
			}
		}

		/**
		 * Process the array of CSS properties and produce the final CSS
		 */
		$final_css = '';
		foreach ( $css as $media_query => $styles ) {

			$final_css .= ( 'global' != $media_query ) ? $media_query . '{' : '';

			foreach ( $styles as $style => $style_array ) {
				$final_css .= $style . '{';
					foreach ( $style_array as $property => $value ) {

						if( empty( $value ) ) {
							continue;
						}

						if ( is_array( $value ) ) {
							foreach ( $value as $sub_property => $sub_value ) {
								$final_css .= ( is_string($sub_property) ? $sub_property : $property ) . ':' . $sub_value . ';';
							}
						} else {
							$final_css .= $property . ':' . $value . ';';
						}
					}
				$final_css .= '}';
			}

			$final_css .= ( 'global' != $media_query ) ? '}' : '';

		}

		return apply_filters( 'liquid_dynamic_css', $final_css );
	}

	// Add the CSS -----------------------------------------------

	/**
	 * Enqueue the dynamic CSS.
	 */
	public function enqueue_dynamic_css() {

		if ( 'file' == self::$mode ) {
			// Yay! we're using a file for our CSS, so enqueue it.
			wp_enqueue_style( 'liquid-dynamic-css', $this->file( 'uri' ) );
		}
	}

	/**
	 * Add Inline CSS
	 *
	 * @return  void
	 */
	public function add_inline_css() {

		global $wp_customize;
		if ( ('inline' == self::$mode || $wp_customize) && $dynamic_css = $this->dynamic_css_cached() ) {
			echo "<style id='liquid-stylesheet-inline-css' type='text/css'>" . $dynamic_css . '</style>';
		}

	}

	// Reset to regenerate -----------------------------------------------

	/**
	 * Reset the dynamic CSS transient for a post.
	 */
	public function reset_post_transient( $post_id ) {
		delete_transient( 'liquid_dynamic_css_' . $post_id );
	}

	/**
	 * Update the liquid_dynamic_css_posts option when a post is saved.
	 */
	public function post_update_option( $post_id ) {
		$option = get_option( 'liquid_dynamic_css_posts', array() );
		$option[$post_id] = false;
		update_option( 'liquid_dynamic_css_posts', $option );
	}

	// Helpers -----------------------------------------------

	/**
	 * Create settings.
	 */
	public function add_options() {
		/**
		 * The 'liquid_dynamic_css_posts' option will hold an array of posts that have had their css generated.
		 * We can use that to keep track of which pages need their CSS to be recreated and which don't.
		 */
		add_option( 'liquid_dynamic_css_time', array(), '', 'yes' );
		/**
		 * The 'liquid_dynamic_css_time' option holds the time the file writer was last used.
		 */
		add_option( 'liquid_dynamic_css_time', time(), '', 'yes' );
	}

	/**
	 * This is just a facilitator that will allow us to reset everything.
	 * Its only job is calling the other methods from this class and reset parts of our caches
	 */
	public function reset_all_caches() {
		$this->reset_all_transients();
		$this->global_reset_option();
		$this->clear_cache();
	}

	/**
	 * Reset ALL CSS transient caches.
	 */
	public function reset_all_transients() {
		global $wpdb;
		// Build the query to delete all  transients and execute the required SQL
		$sql = "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_liquid_dynamic_css_%'";
		$wpdb->query( $sql );
	}

	/**
	 * Clear cache from:
	 *  - W3TC,
	 *  - WordPress Total Cache
	 *  - WPEngine
	 *  - Varnish
	 */
	public function clear_cache() {

		// if W3 Total Cache is being used, clear the cache
		if ( function_exists( 'w3tc_pgcache_flush' ) ) {
			w3tc_pgcache_flush();
		}

		// if WP Super Cache is being used, clear the cache
		else if ( function_exists( 'wp_cache_clean_cache' ) ) {
			global $file_prefix;
			wp_cache_clean_cache( $file_prefix );
		}

		//  Clear caches on WPEngine-hosted sites
		else if ( class_exists( 'WpeCommon' ) ) {
			WpeCommon::purge_memcached();
			WpeCommon::clear_maxcdn_cache();
			WpeCommon::purge_varnish_cache();
		}

		// Clear Varnish caches
		if ( liquid_helper()->get_theme_option( 'dynamic_css_compiler' ) && liquid_helper()->get_theme_option( 'cache_server_ip' ) ) {
			$this->clear_varnish_cache( $this->file( 'url' ) );
		}
	}

	/**
	 * Clear varnish cache for the dynamic CSS file
	 *
	 * @param  $url     the URL of the file whose cache we want to reset
	 * @return  void
	 */
	public function clear_varnish_cache( $url ) {

		// Parse the URL for proxy proxies
		$p = parse_url( $url );

		$varnish_x_purgemethod = ( isset( $p['query'] ) && ( 'vhp=regex' == $p['query'] ) ) ? 'regex' : 'default';

		// Build a varniship
		$varniship = get_option( 'vhp_varnish_ip' );
		if ( liquid_helper()->get_theme_option( 'cache_server_ip' ) ) {
			$varniship = liquid_helper()->get_theme_option( 'cache_server_ip' );
		} else if ( defined( 'VHP_VARNISH_IP' ) && VHP_VARNISH_IP != false ) {
			$varniship = VHP_VARNISH_IP;
		}
		// If we made varniship, let it sail.
		$purgeme = ( isset( $varniship ) && $varniship != null ) ? $varniship : $p['host'];

		wp_remote_request( 'http://' . $purgeme,
			array(
				'method'  => 'PURGE',
				'headers' => array(
					'host'           => $p['host'],
					'X-Purge-Method' => $varnish_x_purgemethod
				)
			)
		);
	}

	/**
	 * Update the liquid_dynamic_css_posts option when the theme options are saved.
	 * This basically empties the array of page IDS from the 'liquid_dynamic_css_posts' option
	 */
	public function global_reset_option() {
		update_option( 'liquid_dynamic_css_posts', array() );
	}

	/**
	 * Update the 'dynamic_css_time' option.
	 */
	public function update_saved_time() {
		update_option( 'liquid_dynamic_css_time', time() );
	}
}
