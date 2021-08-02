<?php
/**
* LiquidThemes Theme Framework
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

// SVG Support Class -----------------------------------------------------

/**
 * Liquid SVG Support
 */
class Liquid_SVG_Support extends Liquid_Base  {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {
	
		$this->add_filter( 'upload_mimes', 'svgs_upload_mimes' );
		$this->add_action( 'admin_init', 'svgs_display_thumbs' );
		$this->add_filter( 'wp_prepare_attachment_for_js', 'svgs_response_for_svg', 10, 3 );
	
	}	

	public function svgs_upload_mimes( $mimes = array() ) {
		
		// allow SVG file upload
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';

		return $mimes;

	}
	
	public function svgs_display_thumbs() {
		
		ob_start( array( $this, 'svgs_thumbs_filter' ) );
		$this->add_filter( 'final_output', 'svgs_final_output' );

	}
	
	public function svgs_thumbs_filter( $content ) {

		return apply_filters( 'final_output', $content );

	}

	public function svgs_final_output( $content ) {

		$content = str_replace(
			'<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',
			'<# } else if ( \'svg+xml\' === data.subtype ) { #>
				<img class="details-image" src="{{ data.url }}" draggable="false" />
				<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',

				$content
				);

		$content = str_replace(
			'<# } else if ( \'image\' === data.type && data.sizes ) { #>',
			'<# } else if ( \'svg+xml\' === data.subtype ) { #>
				<div class="centered">
					<img src="{{ data.url }}" class="thumbnail" draggable="false" />
				</div>
				<# } else if ( \'image\' === data.type && data.sizes ) { #>',

				$content
				);

		return $content;

	}
	
	public function svgs_response_for_svg( $response, $attachment, $meta ) {
	
		if ( $response['mime'] == 'image/svg+xml' && empty( $response['sizes'] ) ) {
	
			$svg_path = get_attached_file( $attachment->ID );
	
			if ( ! file_exists( $svg_path ) ) {
				// If SVG is external, use the URL instead of the path
				$svg_path = $response[ 'url' ];
			}
	
			$dimensions = $this->svgs_get_dimensions( $svg_path );
	
			$response[ 'sizes' ] = array(
				'full' => array(
					'url' => $response[ 'url' ],
					'width' => $dimensions->width,
					'height' => $dimensions->height,
					'orientation' => $dimensions->width > $dimensions->height ? 'landscape' : 'portrait'
					)
				);
	
		}
	
		return $response;
	
	}
	
	public function svgs_get_dimensions( $svg ) {

		$svg = simplexml_load_file( $svg );
	
		if ( $svg === FALSE ) {
	
			$width = '0';
			$height = '0';
	
		} else {
	
			$attributes = $svg->attributes();
			$width = (string) $attributes->width;
			$height = (string) $attributes->height;
		}
	
		return (object) array( 'width' => $width, 'height' => $height );
	
	}


}
new Liquid_SVG_Support();