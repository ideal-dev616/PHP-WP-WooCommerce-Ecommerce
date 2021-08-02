<?php
/** The Media
 * Contains all the Media functions
 *
 * Table of Content
 *
 */

/**
 * [liquid_get_the_small_image]
 * @function liquid_get_the_small_image
 * @param  string $src [description]
 * @param  string $width [description]
 * @param  string $height [description]
 * @return string $small_image [description]
 */
function liquid_get_the_small_image( $src ) {
	
	if( empty( $src )  ){
		return;
	}
	
	@list( $width, $height ) = getimagesize( $src );
	
	if( ! $width ) {
		return $src;
	}
	elseif( $width > $height ) {
		$image_ratio = $height / $width;
		$width = 30;
		$height = 30 * $image_ratio;
	}
	elseif( $width < $height ) {
		$image_ratio = $width / $height;
		$height = 30;
		$width = 30 * $image_ratio;
	}
	elseif( $width == $height ) {
		$width  = 30;
		$height = 30;
	}

	$small_image = aq_resize( $src, $width, $height, false );

	return $small_image;	

}

function liquid_get_retina_image( $image, $size = null ) {

	if( empty( $image ) ) {
		return;
	}

	if( $size ) {
		//Get image sizes
		$aq_size = liquid_image_sizes( $size );
		$width  = $aq_size['width'];
		$height = $aq_size['height'];	
	}
	else {
		@list( $width, $height ) = getimagesize( $image );

	}
	
	//Double the size for the retina display
	$retina_width   = $width * 2;
	$retina_height  = $height * 2;

	$retina_src = aq_resize( $image, (int) $retina_width, (int) $retina_height, true, true, true );
	
	return $retina_src;
	
}

function liquid_the_post_thumbnail( $size = 'thumbnail', $attr = '', $retina = true ) {
	return the_post_thumbnail( $size, $attr );
}

function liquid_get_resized_image_src( $original_src, $size = 'liquid-thumbnail' ) {
	
	if( empty( $original_src) ) {
		return;
	}

	@list( $src, $width, $height ) = $original_src;
	//Get image sizes
	$aq_size = liquid_image_sizes( $size );

	if( ! empty( $aq_size ) ) {

		$resize_width  = $aq_size['width'];
		$resize_height = $aq_size['height'];
		$resize_crop   = $aq_size['crop'];
		
		if( $resize_width >= $width ) {
			$resize_width = $width;
		}
		if( $resize_height >= $height && ! empty( $resize_height ) ) {
			$resize_height = $height;
		}

		//Get resized images
		$resized_src = aq_resize( $src, $resize_width, $resize_height, $resize_crop );
	}
	else {
		return $src;
	}
	return $resized_src;
	
}

/**
 * [liquid_image_sizes description]
 * @method liquid_image_sizes
 * @param  array $image_sizes [description]
 * @return array $image_sizes [description]
 */
function liquid_image_sizes( $size ) {
	
	$sizes = array(
		'liquid-default-blog'      => array( 'width'  => '740',  'height' => '460', 'crop' => true ),
		'liquid-standard-blog'     => array( 'width'  => '740',  'height' => '800', 'crop' => true ),
		'liquid-featured-blog'     => array( 'width'  => '1140',  'height' => '600', 'crop' => true ),
		'liquid-rounded-blog'      => array( 'width'  => '740',  'height' => '500', 'crop' => true ),
		'liquid-classic-meta-blog' => array( 'width'  => '740',  'height' => '600', 'crop' => true ),
		'liquid-classic-2-blog'    => array( 'width'  => '550',  'height' => '350', 'crop' => true ),
		'liquid-grid'              => array( 'width'  => '660',  'height' => '500', 'crop' => true ),
		'liquid-split-blog'        => array( 'width'  => '570',  'height' => '350', 'crop' => true ),
		'liquid-classic-full-blog' => array( 'width'  => '770',  'height' => '400', 'crop' => true ),
		'liquid-metro-blog'        => array( 'width'  => '570',  'height' => '700', 'crop' => true ),
		'liquid-timeline-blog'     => array( 'width'  => '490',  'height' => '300', 'crop' => true ),
		'liquid-carousel-blog'     => array( 'width'  => '670',  'height' => '400', 'crop' => true ),
		'liquid-square-blog'       => array( 'width'  => '560',  'height' => '555', 'crop' => true ),
		'liquid-candy-blog'        => array( 'width'  => '470',  'height' => '470', 'crop' => true ),
		'liquid-category-blog'     => array( 'width'  => '720',  'height' => '440', 'crop' => true ),
		
		//Single Post Featured Image
		'liquid-cover-post'    => array( 'width'  => '1920',  'height' => '960', 'crop' => true ),
		'liquid-default-post'  => array( 'width'  => '1200',  'height' => '1200', 'crop' => true ),
		'liquid-cover-spaced'  => array( 'width'  => '1920',  'height' => '800', 'crop' => true ),
		
		//Masonry blog images sizes		
		'liquid-masonry-shortest' => array( 'width' => '450', 'height' => '300', 'crop'  => true ),
		'liquid-masonry-short'    => array( 'width' => '450', 'height' => '400', 'crop'  => true ),
		'liquid-masonry-tall'     => array( 'width' => '450', 'height' => '500', 'crop'  => true ),
		'liquid-masonry-taller'   => array( 'width' => '450', 'height' => '600', 'crop'  => true ),
		
		'liquid-medium'               => array( 'width'  => '600', 'height' => '600',  'crop' => true ),
		'liquid-large'                => array( 'width'  => '1024', 'height' => '',    'crop' => false ),
		'liquid-thumbnail'            => array( 'width'  => '150',  'height' => '150', 'crop' => true ),
		'liquid-masonry-header-small' => array( 'width'  => '295',  'height' => '220', 'crop' => true ),
		'liquid-masonry-header-big'   => array( 'width'  => '295',  'height' => '440', 'crop' => true ),
		'liquid-thumbnail-post'       => array( 'width'  => '765', 'height' => '400', 'crop' => true ),
		'liquid-small-blog'  	     => array( 'width'  => '388', 'height' => '240', 'crop' => true ),
		'liquid-related-post'         => array( 'width'  => '270',  'height' => '170', 'crop' => true ),

		//Portfolio sizes
		'liquid-portfolio'          => array( 'width'  => '740', 'height' => '600', 'crop' => true ),
		'liquid-portfolio-sq'       => array( 'width'  => '700', 'height' => '590', 'crop' => true ),
		'liquid-portfolio-big-sq'   => array( 'width'  => '600', 'height' => '600', 'crop' => true ),
		'liquid-portfolio-portrait' => array( 'width'  => '350', 'height' => '500', 'crop' => true ),
		'liquid-portfolio-wide'     => array( 'width'  => '600', 'height' => '295', 'crop' => true ),
		
		'liquid-packery-wide'     => array( 'width' => '570', 'height' => '370', 'crop' => true ),
		'liquid-packery-portrait' => array( 'width' => '270', 'height' => '370', 'crop' => true ),
		
		'liquid-grid-hover-overlay' => array( 'width' => '570', 'height' => '350', 'crop' => true ),
		'liquid-grid-hover-classic' => array( 'width' => '500', 'height' => '350', 'crop' => true ),
		'liquid-grid-hover-3d'      => array( 'width' => '370', 'height' => '450', 'crop' => true ),
		'liquid-grid-caption'       => array( 'width' => '270', 'height' => '400', 'crop' => true ),
		
		'liquid-large-slider'       => array( 'width' => '1170', 'height' => '650', 'crop' => true ),
		
		'liquid-widget' => array( 'width' => '160', 'height' => '160', 'crop' => true  ),
		
		'liquid-portfolio-vertical-overlay' => array( 'width' => '400', 'height' => '550', 'crop' => true ),
		
	);
	
	$sizes = apply_filters( 'liquid_media_image_sizes', $sizes );
	
	$image_sizes = ! empty( $sizes[ $size ] ) ? $sizes[ $size ] : '';

	return $image_sizes;
}

function liquid_add_image_sizes() {
	
	$sizes = array(
		'liquid-default-blog'      => array( 'width'  => '740',  'height' => '460', 'crop' => true ),
		'liquid-standard-blog'     => array( 'width'  => '740',  'height' => '800', 'crop' => true ),
		'liquid-featured-blog'     => array( 'width'  => '1140',  'height' => '600', 'crop' => true ),
		'liquid-rounded-blog'      => array( 'width'  => '740',  'height' => '500', 'crop' => true ),
		'liquid-classic-meta-blog' => array( 'width'  => '740',  'height' => '600', 'crop' => true ),
		'liquid-classic-2-blog'    => array( 'width'  => '550',  'height' => '350', 'crop' => true ),
		'liquid-grid'              => array( 'width'  => '660',  'height' => '500', 'crop' => true ),
		'liquid-split-blog'        => array( 'width'  => '570',  'height' => '350', 'crop' => true ),
		'liquid-classic-full-blog' => array( 'width'  => '770',  'height' => '400', 'crop' => true ),
		'liquid-metro-blog'        => array( 'width'  => '570',  'height' => '700', 'crop' => true ),
		'liquid-timeline-blog'     => array( 'width'  => '490',  'height' => '300', 'crop' => true ),
		'liquid-carousel-blog'     => array( 'width'  => '670',  'height' => '400', 'crop' => true ),
		'liquid-square-blog'       => array( 'width'  => '560',  'height' => '555', 'crop' => true ),
		'liquid-candy-blog'        => array( 'width'  => '470',  'height' => '470', 'crop' => true ),
		'liquid-category-blog'     => array( 'width'  => '720',  'height' => '440', 'crop' => true ),
		
		//Single Post Featured Image
		'liquid-cover-post'    => array( 'width'  => '1920',  'height' => '960', 'crop' => true ),
		'liquid-default-post'  => array( 'width'  => '1200',  'height' => '1200', 'crop' => true ),
		'liquid-cover-spaced'  => array( 'width'  => '1920',  'height' => '800', 'crop' => true ),
		
		//Masonry blog images sizes		
		'liquid-masonry-shortest' => array( 'width' => '450', 'height' => '300', 'crop'  => true ),
		'liquid-masonry-short'    => array( 'width' => '450', 'height' => '400', 'crop'  => true ),
		'liquid-masonry-tall'     => array( 'width' => '450', 'height' => '500', 'crop'  => true ),
		'liquid-masonry-taller'   => array( 'width' => '450', 'height' => '600', 'crop'  => true ),
		
		'liquid-medium'               => array( 'width'  => '600', 'height' => '600',  'crop' => true ),
		'liquid-large'                => array( 'width'  => '1024', 'height' => '',    'crop' => false ),
		'liquid-thumbnail'            => array( 'width'  => '150',  'height' => '150', 'crop' => true ),
		'liquid-masonry-header-small' => array( 'width'  => '295',  'height' => '220', 'crop' => true ),
		'liquid-masonry-header-big'   => array( 'width'  => '295',  'height' => '440', 'crop' => true ),
		'liquid-thumbnail-post'       => array( 'width'  => '765', 'height' => '400', 'crop' => true ),
		'liquid-small-blog'  	     => array( 'width'  => '388', 'height' => '240', 'crop' => true ),
		'liquid-related-post'         => array( 'width'  => '270',  'height' => '170', 'crop' => true ),

		//Portfolio sizes
		'liquid-portfolio'          => array( 'width'  => '740', 'height' => '600', 'crop' => true ),
		'liquid-portfolio-sq'       => array( 'width'  => '700', 'height' => '590', 'crop' => true ),
		'liquid-portfolio-big-sq'   => array( 'width'  => '600', 'height' => '600', 'crop' => true ),
		'liquid-portfolio-portrait' => array( 'width'  => '350', 'height' => '500', 'crop' => true ),
		'liquid-portfolio-wide'     => array( 'width'  => '600', 'height' => '295', 'crop' => true ),
		
		'liquid-packery-wide'     => array( 'width' => '570', 'height' => '370', 'crop' => true ),
		'liquid-packery-portrait' => array( 'width' => '270', 'height' => '370', 'crop' => true ),
		
		'liquid-grid-hover-overlay' => array( 'width' => '570', 'height' => '350', 'crop' => true ),
		'liquid-grid-hover-classic' => array( 'width' => '500', 'height' => '350', 'crop' => true ),
		'liquid-grid-hover-3d'      => array( 'width' => '370', 'height' => '450', 'crop' => true ),
		'liquid-grid-caption'       => array( 'width' => '270', 'height' => '400', 'crop' => true ),
		
		'liquid-large-slider'       => array( 'width' => '1170', 'height' => '650', 'crop' => true ),
		
		'liquid-widget' => array( 'width' => '160', 'height' => '160', 'crop' => true  ),
		
		'liquid-portfolio-vertical-overlay' => array( 'width' => '400', 'height' => '550', 'crop' => true ),
		
	);
	
	$sizes = apply_filters( 'liquid_media_image_sizes', $sizes );
	
	if( is_array( $sizes ) ) {

		foreach( $sizes as $key => $size ) {
			add_image_size( $key, $size['width'], $size['height'], $size['crop'] );
		};
	}
}


/**
 * Prevents from creating different image sizes than default thumbnail, medium, large
 * Images are created on demand
 * @global array $_wp_additional_image_sizes
 * @param type $out
 * @param int $id
 * @param string $size
 * @return boolean|array
 */
add_filter('image_downsize', 'liquid_media_downsize', 10, 3);
function liquid_media_downsize($out, $id, $size) {
	// If image size exists let WP serve it like normally
	$imagedata = wp_get_attachment_metadata($id);
	
	if (!is_string($size)) {
		return false;
	}
	
	if (is_array($imagedata) && isset($imagedata['sizes'][$size])) {
		return false;
	}

	// Check that the requested size exists, or abort
	global $_wp_additional_image_sizes;
	if (!isset($_wp_additional_image_sizes[$size])) {
		return false;
	}

	// Make the new thumb
	if (!$resized = image_make_intermediate_size(
		get_attached_file($id),
		$_wp_additional_image_sizes[$size]['width'],
		$_wp_additional_image_sizes[$size]['height'],
		$_wp_additional_image_sizes[$size]['crop']
	))
		return false;

	// Save image meta, or WP can't see that the thumb exists now
	$imagedata['sizes'][$size] = $resized;
	wp_update_attachment_metadata($id, $imagedata);

	// Return the array for displaying the resized image
	$att_url = wp_get_attachment_url($id);
	return array(dirname($att_url) . '/' . $resized['file'], $resized['width'], $resized['height'], true);
}

/**
 * Prevent resize on upload
 * @param array $sizes
 * @return array
 */
function liquid_media_prevent_resize_on_upload($sizes) {
	// Removing these defaults might cause problems, so we don't
	return array(
		'thumbnail' => $sizes['thumbnail'],
		'medium' => $sizes['medium'],
		'large' => $sizes['large']
	);
}
add_filter('intermediate_image_sizes_advanced', 'liquid_media_prevent_resize_on_upload');