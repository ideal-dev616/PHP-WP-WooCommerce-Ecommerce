<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
* Request a download package from the api server and insert it to the created temp folder if the given token are correct
*
*/
class LiquidDownload
{
	/**
	 * temp folder name
	 *
	 * @access private
	 * @var string
	 */
	private $temp_folder_name = 'liquid_temp';

	/**
	 * LiquidThemes Api url
	 *
	 * @access private
	 * @var string
	 */
	private $api_url;

	/**
	 * Compressed data format
	 *
	 * @access private
	 * @var string
	 */
	private $data_format = 'zip';


	public function __construct($core)
	{
		$this->core = $core;
		$this->api_url = $core['LiquidEnvato']->api_new_url;
	}

	public function run() {
		add_action( 'wp_ajax_liquid_prepare_demo_package', array($this, 'ajax_prepare_demo'), 10, 1 );
	}

	public static function init_filesystem() {

		if ( ! defined( 'FS_METHOD' ) ) {
			define( 'FS_METHOD', 'direct' );
		}

		// The Wordpress filesystem.
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		return $wp_filesystem;
	}

	public function temp_folder($url = false) {
		$this->init_filesystem();

		$upload_dir = wp_upload_dir();
		$temp_folder = $this->temp_folder_name;
		$theme_temp_folder = $upload_dir['basedir'].'/'.$temp_folder;
		if(!file_exists($theme_temp_folder)) {
			wp_mkdir_p( $theme_temp_folder );
		}
		if($url) {
			return $upload_dir['baseurl'].'/'.$temp_folder;
		} else {
			return $theme_temp_folder;
		}
	}

	public function download($demo){
		$token = $this->core['LiquidCheck']->get_token();
		$url = add_query_arg( array(
			'download' => 1,
			'product'  => 'Ave',
			'demo'     => esc_attr($demo),
			'token'    => esc_attr($token)
		), $this->api_url ); //XSS::Fine

		$download_to = $this->temp_folder().'/'.$demo.'.'.$this->data_format;
		// Include the WP_Http class if it doesn't already exist.
		if ( ! class_exists( 'WP_Http' ) ) {
			include_once( wp_normalize_path( ABSPATH . WPINC . '/class-http.php' ) );
		}
		// Inlude the wp_remote_get function if it doesn't already exist.
		if ( ! function_exists( 'wp_remote_get' ) ) {
			include_once( wp_normalize_path( ABSPATH . WPINC . '/http.php' ) );
		}

		$args = array(
			'timeout'    => 30,
			'user-agent' => 'liquidthemes-user-agent',
		);
		$response = wp_remote_get( esc_url_raw( $url ), $args );
		$body     = wp_remote_retrieve_body( $response );

		// Try file_get_contents if body is empty.
		if ( empty( $body ) ) {
			if ( function_exists( 'ini_get' ) && ini_get( 'allow_url_fopen' ) ) {
				$body = @file_get_contents( $url );
			}
		}

		$wp_filesystem = $this->init_filesystem();

		if ( ! defined( 'FS_CHMOD_DIR' ) ) {
			define( 'FS_CHMOD_DIR', ( 0755 & ~ umask() ) );
		}
		if ( ! defined( 'FS_CHMOD_FILE' ) ) {
			define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );
		}

		// Attempt to write the file.
		if ( ! $wp_filesystem->put_contents($download_to , $body, FS_CHMOD_FILE) ) {
		// If the attempt to write to the file failed, then fallback to fwrite.
			@unlink( $download_to );
			$fp = fopen( $download_to, 'w' );
			$written = fwrite( $fp, $body );
			fclose( $fp );
			if ( false === $written ) {
				return false;
			}
		}

		if ( !is_wp_error($response) && !empty( $response['headers'] ) ) {
			$response['headers']['response'] = $response['response']['code'];
			return $response['headers'];
		}

		return false;
	}

	public function extract($demo) {
		$this->init_filesystem();
		$temp = $this->temp_folder();
		$file = $temp.DIRECTORY_SEPARATOR.$demo.'.'.$this->data_format;

		if(file_exists($file)) {
			unzip_file( $file, $temp );
			unlink($file);
		} else {
			return 'No file to extract or the provided file is not in '.$this->data_format;
		}
	}

	public function ajax_prepare_demo() {
		$demo = esc_attr($_GET['demo']);
		$is_valid = $this->core['LiquidCheck']->is_vaild();
		$ret = '';

		if ( ! defined('ENVATO_HOSTED_SITE') ) {
			if( !$is_valid ) {
				$ret = '{"stat":0, "message":"Please activate your One License"}';
				echo $ret;
				wp_die();
			}
		}

		if( $demo == '' || !isset($demo) ) {
			$ret = '{"stat":0, "message":"Error: No id provided for the requested demo"}';
		}

		$download = $this->download($demo);
		// The server wasn't able to download the file
		if( !$download ) {
			$ret = '{"stat":0, "message":"Your server was unable to connect to Liquid Themes API server. Please check with your hosting company if the connection to https://api.liquid-themes.com is blocked in the firewall or network setup."}';
			echo $ret;
			wp_die();
		}

		//is the downloaded file larger than 1kb ?
		if( isset($download['content-length']) && $download['content-length'] >= 1 ) {
			$this->extract($demo);
			$ret = '{"stat":1}';
		} else {
			$ret = '{"stat":0, "message":"Failed to download the demo package or the downloaded file is corrupted, Contact Liquid Themes support !"}';
		}
		echo $ret;
		wp_die();
	}

}
?>
