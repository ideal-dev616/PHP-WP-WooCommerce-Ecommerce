<?php
/**
 * Liquid Themes Theme Framework
 */

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
 * Table of content
 *
 * 1. Hooks
 * 2. Functions
 * 3. Template Tags
 */

// 1. Hooks ------------------------------------------------------
//


/**
 * [liquid_attributes_comment description]
 * @method liquid_attributes_comment
 * @param  [type]                   $attributes [description]
 * @return [type]                               [description]
 */
add_filter( 'liquid_attr_comment', 'liquid_attributes_comment', 5 );
function liquid_attributes_comment( $attributes ) {

	$attributes['id']    = 'comment-' . get_comment_ID();
	$attributes['class'] = join( ' ', get_comment_class() );

	if ( in_array( get_comment_type(), array( '', 'comment' ) ) ) {

		$attributes['itemscope'] = 'itemscope';
		$attributes['itemtype']  = 'http://schema.org/Comment';
	}

	return $attributes;
}

/**
 * [liquid_attributes_comment_author description]
 * @method liquid_attributes_comment_author
 * @param  [type]                          $attributes [description]
 * @return [type]                                      [description]
 */
add_filter( 'liquid_attr_comment-author', 'liquid_attributes_comment_author', 5 );
function liquid_attributes_comment_author( $attributes ) {

	$attributes['class']     = 'comment-author';
	$attributes['itemscope'] = 'itemscope';
	$attributes['itemtype']  = 'http://schema.org/Person';

	return $attributes;
}

/**
 * [liquid_attributes_comment_published description]
 * @method liquid_attributes_comment_published
 * @param  [type]                             $attributes [description]
 * @return [type]                                         [description]
 */
add_filter( 'liquid_attr_comment-published', 'liquid_attributes_comment_published', 5 );
function liquid_attributes_comment_published( $attributes ) {

	$attributes['class']    = 'comment-published';
	$attributes['datetime'] = get_comment_time( 'Y-m-d\TH:i:sP' );

	// Translators: Comment date/time "title" attribute.
	$attributes['title']    = get_comment_time( _x( 'l, F j, Y, g:i a', 'comment time format', 'ave' ) );

	return $attributes;
}

/**
 * [liquid_attributes_comment_permalink description]
 * @method liquid_attributes_comment_permalink
 * @param  [type]                             $attributes [description]
 * @return [type]                                         [description]
 */
add_filter( 'liquid_attr_comment-permalink', 'liquid_attributes_comment_permalink', 5 );
function liquid_attributes_comment_permalink( $attributes ) {

	$attributes['class']    = 'comment-permalink';
	$attributes['href']     = get_comment_link();

	return $attributes;
}

/**
 * [liquid_attributes_comment_content description]
 * @method liquid_attributes_comment_content
 * @param  [type]                           $attributes [description]
 * @return [type]                                       [description]
 */
add_filter( 'liquid_attr_comment-content', 'liquid_attributes_comment_content', 5 );
function liquid_attributes_comment_content( $attributes ) {

	$attributes['class']    = 'comment-content';

	return $attributes;
}

// 2. Functions ------------------------------------------------------
//

/**
 * [liquid_comments_callback description]
 * @method liquid_comments_callback
 * @param  [type]                  $comment [description]
 * @return [type]                           [description]
 */
function liquid_comments_callback( $comment ) {

	// Get the comment type of the current comment.
	$comment_type = get_comment_type( $comment->comment_ID );

	// Create an empty array if the comment template array is not set.
	if ( ! isset( liquid()->comment_template ) || ! is_array( liquid()->comment_template ) ) {
		liquid()->comment_template = array();
	}

	// Check if a template has been provided for the specific comment type.  If not, get the template.
	if ( ! isset( liquid()->comment_template[ $comment_type ] ) ) {

		// Create an array of template files to look for.
		$templates = array( "templates/comment/{$comment_type}.php" );

		// If the comment type is a 'pingback' or 'trackback', allow the use of 'comment-ping.php'.
		if ( 'pingback' == $comment_type || 'trackback' == $comment_type ) {
			$templates[] = 'templates/comment/ping.php';
		}

		// Add the fallback 'comment.php' template.
		$templates[] = 'templates/comment/comment.php';

		// Allow devs to filter the template hierarchy.
		$templates = apply_filters( 'liquid_comment_template_hierarchy', $templates, $comment_type );

		// Locate the comment template.
		$template = locate_template( $templates );

		// Set the template in the comment template array.
		liquid()->comment_template[ $comment_type ] = $template;
	}

	// If a template was found, load the template.
	if ( ! empty( liquid()->comment_template[ $comment_type ] ) ) {
		require( liquid()->comment_template[ $comment_type ] );
	}
}

// 3. Template Tags --------------------------------------------------
//

/**
 * [liquid_comment_reply_link description]
 * @method liquid_comment_reply_link
 * @param  array                    $args [description]
 * @return [type]                         [description]
 */
function liquid_comment_reply_link( $args = array() ) {
	echo liquid_get_comment_reply_link( $args );
}

/**
 * [liquid_get_comment_reply_link description]
 * @method liquid_get_comment_reply_link
 * @param  array                        $args [description]
 * @return [type]                             [description]
 */
function liquid_get_comment_reply_link( $args = array() ) {

	if ( ! get_option( 'thread_comments' ) || in_array( get_comment_type(), array( 'pingback', 'trackback' ) ) ) {
		return '';
	}

	$args = wp_parse_args(
		$args,
		array(
			'depth'     => intval( $GLOBALS['comment_depth'] ),
			'max_depth' => get_option( 'thread_comments_depth' ),
		)
	);

	return get_comment_reply_link( $args );
}
