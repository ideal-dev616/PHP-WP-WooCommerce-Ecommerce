<?php
/**
* LiquidThemes Framework
*/

if( ! defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly
	
// Template Tags -------------------------------------------------------
function liquid_views_button( $post_id = 0 ) {

	// if post support post likes
	if( ! post_type_supports( get_post_type( $post_id ), 'liquid-post-views' ) ) {
		esc_html_e( 'Post type not support views.', 'ave-core' );
		return;
	}

	echo Liquid_Post_View::instance()->liquid_get_post_views( $post_id );
}	

// Post View Class -----------------------------------------------------

/**
 * Liquid_Post_View
 */
class Liquid_Post_View extends Liquid_Base {
	
	/**
     * Hold an instance of Liquid_Post_View class.
     * @var Liquid_Post_View
     */
    protected static $instance = null;

	/**
	 * [$meta description]
	 * @var string
	 */
	protected $metakey = '_liquid_views_count';

	/**
	 * Main Liquid_Post_View instance.
	 *
	 * @return Liquid_Post_View - Main instance.
	 */
    public static function instance() {

		if( null == self::$instance ) {
			self::$instance = new Liquid_Post_View();
        }

        return self::$instance;
    }
    
	/**
	 * [__construct description]
	 * @method __construct
	 */
	private function __construct() {

		$this->add_action( 'wp_head', 'liquid_track_post_views');
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	}

	public function liquid_set_post_views( $postID ) {

		$count_key = $this->metakey;
	    $count = get_post_meta( $postID, $count_key, true );

		if( $count == '' ){
	        $count = 0;
	        delete_post_meta( $postID, $count_key );
	        add_post_meta( $postID, $count_key, '0' );
		}
		else {
	        $count++;
			update_post_meta( $postID, $count_key, $count );
	    }
	}
	
	public function liquid_track_post_views( $post_id ) {

		if ( ! is_single() ) 
			return;
		    
	    if ( empty ( $post_id) ) {
	        global $post;
	        $post_id = $post->ID;
	    }
		$this->liquid_set_post_views( $post_id );

	}
	
	public function liquid_get_post_views( $postID ){

	    $count_key = $this->metakey;
		$count     = get_post_meta( $postID, $count_key, true );

		if( $count == '' ){

	        delete_post_meta( $postID, $count_key );
	        add_post_meta( $postID, $count_key, '0' );
	        return esc_html__( 'O Views', 'ave-core' );

	    }

	    return $count . esc_html__( ' Views', 'ave-core' );

	}

}
Liquid_Post_View::instance();