<?php
/**
* Shortcode Tweet
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Tweet extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_tweet';
		$this->title       = esc_html__( 'Single Tweet', 'ave-core' );
		$this->description = esc_html__( 'Add single tweet (from Twitter URL)', 'ave-core' );
		$this->icon        = 'fa fa-twitter-square';

		parent::__construct();
	}

	public function get_params() {

		 $params = array(

			array(
				'type'        => 'textfield',
				'param_name'  => 'tweet',
				'heading'     => esc_html__( 'Tweet URL', 'ave-core' ),
				'description' => esc_html__( 'Input here the URL of the single tweet you want to display', 'ave-core' ),
			),
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_icon',
				'heading'     => esc_html__( 'Show twitter Icon?', 'ave-core' ),
				'description' => esc_html__( 'Enable to display twiiter icon', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
			),
		);

		$this->params = array_merge( $params );

		$this->add_extras();
	}

	protected function get_twitter_icon() {
		
		if( !$this->atts['enable_icon'] ) {
			return;
		}
		
		echo '<span class="liquid-twitter-feed-icon">
				<i class="fa fa-twitter"></i>
			 </span><!-- /.liquid-twitter-feed-icon -->';
		
	}

	protected function get_tweet_data() {
	
		if ( empty( $this->atts['tweet'] ) ) {
			return;
		}

		$url       = esc_url( $this->atts['tweet'] );
		$url_fetch = "https://publish.twitter.com/oembed?url=$url&hide_media=true&hide_thread=true&omit_script=true";
		
		// Get remote HTML file
		add_filter('https_ssl_verify', '__return_false');
		$response = wp_remote_get( $url_fetch );

		// Check for error
		if ( is_wp_error( $response ) ) {
			return;
		}

		$data = json_decode( wp_remote_retrieve_body( $response ), true );
		
		// Check for error
		if ( is_wp_error( $data ) ) {
			return;
		}

		extract( $data );

		echo $html;

	}

}
new LD_Tweet;