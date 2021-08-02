<?php
/**
* Shortcode Liquid Carousel
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Laptop_Carousel extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_laptop_carousel';
		$this->title        = esc_html__( 'Laptop Carousel', 'ave-core' );
		$this->icon         = 'fa fa-laptop';
		$this->scripts      = array( 'flickity' );
		$this->styles       = array( 'flickity' );
		$this->description  = esc_html__( 'Create a laptop carousel.', 'ave-core' );

		parent::__construct();
	}
	
	public function get_params() {

		$this->params = array(

			array(
				'type'        => 'attach_images',
				'param_name'  => 'images',
				'heading'     => esc_html__( 'Laptop Carousel Images', 'ave-core' ),
				'description' => esc_html__( 'Add images to show in the laptop carousel', 'ave-core' )
			),

		);
	}

	protected function get_attachments() {

		$images = explode( ',', $this->atts['images'] );

		if( empty( $images ) ) {
			return;
		}

		$args = array(
			'posts_per_page' => -1,
			'include'        => $images,
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'orderby'        => 'post__in',

			// improve query performance
			'ignore_sticky_posts'    => true,
			'no_found_rows'          => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false
		);

		return get_posts( $args );
	}
	
}
new LD_Laptop_Carousel;