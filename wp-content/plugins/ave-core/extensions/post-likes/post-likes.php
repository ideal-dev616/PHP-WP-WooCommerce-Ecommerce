<?php
/**
* LiquidThemes Framework
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

// Template Tags -------------------------------------------------------
function liquid_likes_button( $args = array(), $post_id = 0 ) {

	// if post support post likes
	if( !post_type_supports( get_post_type( $post_id ), 'liquid-post-likes' ) ) {
		echo __( 'Post type not support likes.', 'ave-core' );
		return;
	}

	echo Liquid_Post_Like::instance()->get_likes_button( $args, $post_id );
}


// Post Like Class -----------------------------------------------------

/**
 * Liquid_Post_Like Theme
 */
class Liquid_Post_Like extends Liquid_Base {

	/**
     * Hold an instance of Liquid_Post_Like class.
     * @var Liquid_Post_Like
     */
    protected static $instance = null;

	/**
	 * [$meta description]
	 * @var string
	 */
	protected $metakey = '_liquid_likes_count';

	/**
	 * [$noncekey description]
	 * @var string
	 */
	protected $noncekey = 'liquid-likes-nonce';

	/**
	 * Main Liquid_Post_Like instance.
	 *
	 * @return Liquid_Post_Like - Main instance.
	 */
    public static function instance() {

		if( null == self::$instance ) {
            self::$instance = new Liquid_Post_Like();
        }

        return self::$instance;
    }

	/**
	 * [__construct description]
	 * @method __construct
	 */
	private function __construct() {

		$this->add_action( 'wp_ajax_nopriv_save_post_like', 'save_like' );
	    $this->add_action( 'wp_ajax_save_post_like', 'save_like' );
		$this->add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
	}

	public function enqueue_scripts() {

		wp_register_script( 'liquid-likes', LD_ADDONS_URL . '/extensions/post-likes/liquid-likes.js', array( 'jquery' ), '0.1', true );
	}

	/**
	 * Save like for a post ajax request
	 */
	public function save_like() {

		$nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( $_REQUEST['nonce'] ) : 0;
		if ( ! wp_verify_nonce( $nonce, $this->noncekey ) ) {
			wp_send_json_error( esc_html__( 'Not permitted', 'ave-core' ) );
		}

		// Get post_id
		$post_id = isset( $_REQUEST['post_id'] ) && is_numeric( $_REQUEST['post_id'] ) ? $_REQUEST['post_id'] : '';
		if( ! $post_id ) {
			wp_send_json_error( esc_html__( 'No Post ID', 'ave-core' ) );
		}

		// if post support post likes
		if( !post_type_supports( get_post_type( $post_id ), 'liquid-post-likes' ) ) {
			wp_send_json_error( esc_html__( 'Post type not support likes.', 'ave-core' ) );
		}

		// Base variables.
		$result = array( 'success' => true );
		$cookie_key = 'liquid_post_like_' . $post_id;

		// Get Count
		$like_count = intval( get_post_meta( $post_id, $this->metakey, true ) );
		$like_count = $like_count ? $like_count : 0;

		// Already liked unlike it.
		if( $this->has_post_liked( $post_id ) ) {
			$like_count = $like_count > 0 ? --$like_count : 0; // Prevent negative number.
			$result = array(
				'likes' => $this->format_count( $like_count ),
				'status' => 'unliked'
			);
			setcookie( $cookie_key, null, -1, '/' );
		}
		// Like the post.
		else {
			$like_count = ++$like_count;
			$result = array(
				'likes' => $this->format_count( $like_count ),
				'status' => 'liked'
			);
			setcookie( $cookie_key, 1, time()+60*60*24*30, '/' );
		}

		// Update post likes
		update_post_meta( $post_id, $this->metakey, $like_count );

		wp_send_json( $result );
	}

	/**
	 * [get_likes_button description]
	 * @method get_likes_button
	 * @param  integer          $post_id [description]
	 * @return [type]                    [description]
	 */
	public function get_likes_button( $args = array(), $post_id = 0 ) {

		$defaults = array(
			'container' => 'span',
			'container_class' => 'post-likes',
			'format' => wp_kses_post( __( '<span class="post-likes-count">%s</span> Likes', 'ave-core' ) ),
		);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		// func variables
		$out = '';
		$post = get_post( $post_id );
		$post_id = $post->ID;
		$nonce = wp_create_nonce( $this->noncekey ); // Security
		$count = $this->get_likes( $post );

		// Container classes
		$classes = array( $container_class );
		if( $this->has_post_liked( $post_id ) ) {
			$classes[] = 'liked';
		}
		$classes = join( ' ', $classes );

		$out .= sprintf( '<%s class="%s">', $container, $classes );
			$out .= sprintf( '<a href="#" class="liquid-post-like" data-id="%s" data-security="%s">', $post_id, $nonce );

				$out .= sprintf( $format, $count );

			$out .= '</a>';
		$out .= sprintf( '</%s>', $container );

		return $out;
	}

	/**
	 * [get_like description]
	 * @method get_like
	 * @param  integer  $post_id [description]
	 * @return [type]            [description]
	 */
	public function get_likes( $post_id = 0 ) {

		$post = get_post( $post_id );
		$post_id = $post->ID;

		return intval( get_post_meta( $post_id, $this->metakey, true ) );
	}

	/**
	 * [has_post_liked description]
	 * @method has_post_liked
	 * @param  integer               $post_id [description]
	 * @return [type]                         [description]
	 */
	public function has_post_liked( $post_id = 0 ) {

		//don't add new like if cookie exists
		$cookie_key = 'liquid_post_like_' . $post_id;
		if ( isset( $_COOKIE[ $cookie_key ] ) && 1 == $_COOKIE[ $cookie_key ] ) {
			return true;
		}

		return false;
	}

	/**
	 * [format_count description]
	 * @method format_count
	 * @param  [type]       $number [description]
	 * @return [type]               [description]
	 */
	public function format_count( $number ) {

		$precision = 2;
		if ( $number >= 1000 && $number < 1000000 ) {
			$formatted = number_format( $number/1000, $precision ).'K';
		}
		else if ( $number >= 1000000 && $number < 1000000000 ) {
			$formatted = number_format( $number/1000000, $precision ).'M';
		}
		else if ( $number >= 1000000000 ) {
			$formatted = number_format( $number/1000000000, $precision ).'B';
		}
		else {
			$formatted = $number; // Number is less than 1000
		}

		$formatted = str_replace( '.00', '', $formatted );

		return $formatted;
	}
}
Liquid_Post_Like::instance();
