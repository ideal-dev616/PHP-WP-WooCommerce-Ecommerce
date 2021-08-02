<?php
/**
* Shortcode Liquid Carousel
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Carousel_3d extends LD_Shortcode {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug         = 'ld_carousel_3d';
		$this->title        = esc_html__( 'Carousel 3D', 'ave-core' );
		$this->icon         = 'fa fa-arrows';
		$this->description  = esc_html__( 'Create a carousel 3D.', 'ave-core' );
		$this->is_container = true;

		parent::__construct();
	}

	public function get_params() {
		
		$this->params = array();
		$this->add_extras();

	}

	protected function columnize_content( &$content ) {

		global $shortcode_tags;

		// Find all registered tag names in $content.
		preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
		$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );
		$pattern = get_shortcode_regex();

		foreach( $tagnames as $tag ) {
			$start = "[$tag";
			$end = "[/$tag]";

			if( ld_helper()->str_contains( $end, $content ) ) {
				$content = str_replace( $start, '<div class="carousel-item">' . $start, $content );
				$content = str_replace( $end, $end . '</div>', $content );
			}
			else {
				preg_match_all( '/' . $pattern . '/s', $content, $matches );

				foreach( array_unique( $matches[0] ) as $replace ) {
					$content = str_replace( $replace, '<div class="carousel-item">' . $replace . '</div>', $content );
				}
			}

		}
	}

	protected function generate_css() {

		extract( $this->atts );
		$elements = array();

		$id = '.' . $this->get_id();

		$this->dynamic_css_parser( $id, $elements );
	}

}
new LD_Carousel_3d;
class WPBakeryShortCode_LD_Carousel_3d extends WPBakeryShortCodesContainer {}