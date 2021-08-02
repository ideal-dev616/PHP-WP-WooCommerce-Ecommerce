<?php
/**
 * LiquidThemes Theme Framework
 */

if( !defined( 'ABSPATH' ) )
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

add_filter( 'liquid_attr_post', 'liquid_attributes_post' );
add_filter( 'liquid_attr_entry', 'liquid_attributes_post' );
/**
 * [liquid_attributes_post description]
 * @method liquid_attributes_post
 * @param  [type]             $attributes [description]
 * @return [type]                         [description]
 */
function liquid_attributes_post( $attributes ) {

	$post = get_post();
	$post_type = get_post_type();
	
	

	// Make sure we have a real post first.
	if ( ! empty( $post ) ) {

		$attributes['id']        = 'post-' . get_the_ID();
		if( !class_exists( 'ReduxFramework' ) || !class_exists( 'Liquid_Addons' ) ) {
			$attributes['class'] = join( ' ', get_post_class( array( $attributes['class'], 'liquid-lp mb-5 liquid-blog-item liquid-blog-item-grid liquid-blog-scheme-dark' ) ) );
		}
		else {
			$attributes['class'] = join( ' ', get_post_class( $attributes['class'] ) );
		}
		
		$attributes['itemscope'] = 'itemscope';

		if ( 'post' === $post_type ) {

			$attributes['itemtype']  = 'http://schema.org/BlogPosting';

			/* Add itemprop if within the main query. */
			if ( is_main_query() && ! is_search() ) {
			}
		}
		elseif( 'attachment' === $post_type ) {

			if ( wp_attachment_is_image() ) {
				$attributes['itemtype'] = 'http://schema.org/ImageObject';
			}
			elseif ( liquid_helper()->is_attachment_audio() ) {
				$attributes['itemtype'] = 'http://schema.org/AudioObject';
			}
			elseif ( liquid_helper()->is_attachment_video() ) {
				$attributes['itemtype'] = 'http://schema.org/VideoObject';
			}
		}
		else {
			$attributes['itemtype']  = 'http://schema.org/CreativeWork';
		}

	}
	else {

		$attributes['id']    = 'post-0';
		$attributes['class'] = join( ' ', get_post_class() );
	}

	return $attributes;
}

add_filter( 'liquid_attr_entry-title', 'liquid_attributes_entry_title', 5 );
/**
 * [liquid_attributes_entry_title description]
 * @method liquid_attributes_entry_title
 * @param  [type]                    $attributes [description]
 * @return [type]                                [description]
 */
function liquid_attributes_entry_title( $attributes ) {

	if( !class_exists( 'ReduxFramework' ) || !class_exists( 'Liquid_Addons' ) ) {
		$attributes['class']    = isset( $attributes['class'] ) ? $attributes['class'] . ' liquid-lp-title font-weight-medium h3 size-sm ltr-sp-0' : '';
	}
	else {
		$attributes['class']    = isset( $attributes['class'] ) ? $attributes['class'] : '';
	}	

	return $attributes;
}

add_filter( 'liquid_attr_entry-content', 'liquid_attributes_entry_content', 5 );
/**
 * [liquid_attributes_entry_content description]
 * @method liquid_attributes_entry_content
 * @param  [type]                      $attributes [description]
 * @return [type]                                  [description]
 */
function liquid_attributes_entry_content( $attributes ) {

	$attributes['class'] = 'entry-content';


	return $attributes;
}

add_filter( 'liquid_attr_entry-author', 'liquid_attributes_entry_author', 5 );
/**
 * [liquid_attributes_entry_author description]
 * @method liquid_attributes_entry_author
 * @param  [type]                     $attributes [description]
 * @return [type]                                 [description]
 */
function liquid_attributes_entry_author( $attributes ) {

	$attributes['class']     = 'entry-author';
	$attributes['itemscope'] = 'itemscope';
	$attributes['itemtype']  = 'http://schema.org/Person';

	return $attributes;
}

add_filter( 'liquid_attr_entry-published', 'liquid_attributes_entry_published', 5 );
/**
 * [liquid_attributes_entry_published description]
 * @method liquid_attributes_entry_published
 * @param  [type]                        $attributes [description]
 * @return [type]                                    [description]
 */
function liquid_attributes_entry_published( $attributes ) {

	$attributes['class']    = 'entry-published updated';
	$attributes['datetime'] = get_the_time( 'Y-m-d\TH:i:sP' );

	// Translators: Post date/time "title" attribute.
	$attributes['title']    = get_the_time( esc_html_x( 'l, F j, Y, g:i a', 'post time format', 'ave' ) );

	return $attributes;
}


add_filter( 'liquid_attr_entry-summary', 'liquid_attributes_entry_summary', 5 );
/**
 * [liquid_attributes_entry_summary description]
 * @method liquid_attributes_entry_summary
 * @param  [type]                      $attributes [description]
 * @return [type]                                  [description]
 */
function liquid_attributes_entry_summary( $attributes ) {

	if( !class_exists( 'ReduxFramework' ) || !class_exists( 'Liquid_Addons' ) ) {
		$attributes['class'] = 'entry-summary liquid-lp-excerpt';
	}
	else {
		$attributes['class'] = 'entry-summary';
	}

	

	return $attributes;
}

add_filter( 'liquid_attr_entry-terms', 'liquid_attributes_entry_terms', 5 );
/**
 * [liquid_attributes_entry_terms description]
 * @method liquid_attributes_entry_terms
 * @param  [type]                    $attributes [description]
 * @param  [type]                    $context    [description]
 * @return [type]                                [description]
 */
function liquid_attributes_entry_terms( $attributes ) {

	$context = $attributes['taxonomy'];
	unset( $attributes['taxonomy'] );

	if ( !empty( $context ) ) {

		$attributes['class'] = 'entry-terms ' . sanitize_html_class( $context );

		if ( 'category' === $context ) {
		}

		else if ( 'post_tag' === $context ) {
		}
	}

	return $attributes;
}

// 2. Functions ------------------------------------------------------
//


// 3. Template Tags --------------------------------------------------
//

/**
 * [liquid_post_thumbnail description]
 * @method liquid_post_thumbnail
 * @return [type]            [description]
 */
function liquid_post_thumbnail() {

	if( post_password_required() || is_attachment() || ! has_post_thumbnail() || is_singular() ) {
		return;
	}

	echo '<div class="post-thumbnail">';
		the_post_thumbnail();
	echo '</div><!-- .post-thumbnail -->';
}

/**
 * [liquid_post_terms description]
 * @method liquid_post_terms
 * @param  array         $args [description]
 * @return [type]              [description]
 */
function liquid_post_terms( $args = array() ) {
	echo liquid_get_post_terms( $args );
}

/**
 * [liquid_get_post_terms description]
 * @method liquid_get_post_terms
 * @param  [type]            $args [description]
 * @return [type]                  [description]
 */
function liquid_get_post_terms( $args ) {

	$out = '';

	$defaults = array(
		'post_id'    => get_the_ID(),
		'taxonomy'   => 'category',
		'text'       => '%s',
		'before'     => '',
		'after'      => '',
		'wrap'       => '<span %s>%s</span>',
		// Translators: Separates tags, categories, etc. when displaying a post.
		'sep'        => esc_html_x( ', ', 'taxonomy terms separator', 'ave' )
	);
	$args = wp_parse_args( $args, $defaults );

	$terms = get_the_term_list( $args['post_id'], $args['taxonomy'], '<ul class="liquid-lp-category font-weight-medium text-transform-none ltr-sp-025"><li>', '</li><li>', '</li></ul>' );

	if ( $terms ) {
		$out .= $args['before'];
		$out .= sprintf( $args['wrap'], liquid_helper()->get_attr( 'entry-terms', array( 'taxonomy' => $args['taxonomy'] ) ), sprintf( $args['text'], $terms ) );
		$out .= $args['after'];
	}

	return $out;
}

/**
 * [liquid_post_title_description description]
 * @method liquid_post_title_description
 * @return [type]        [description]
 */
function liquid_post_title_description() {

	$title = $desc = '';

	if ( is_home() && ! is_front_page() ) {
		$title = get_post_field( 'post_title', get_queried_object_id() );
		$desc = get_post_field( 'post_content', get_queried_object_id(), 'raw' );
	}

	elseif ( is_category() ) {
		$title = single_cat_title( '', false );
		$desc = get_term_field( 'description', get_queried_object_id(), 'category', 'raw' );
	}

	elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
		$desc = get_term_field( 'description', get_queried_object_id(), 'post_tag', 'raw' );
	}

	elseif ( is_tax() ) {
		$title = single_term_title( '', false );
		$desc = get_term_field( 'description', get_queried_object_id(), get_query_var( 'taxonomy' ), 'raw' );
	}

	elseif ( is_author() ) {
		$title = get_the_author_meta( 'display_name', absint( get_query_var( 'author' ) ) );
		$desc = get_the_author_meta( 'description', get_query_var( 'author' ) );
	}

	elseif ( is_search() )
		$title = sprintf( esc_html__( 'Search results for &#8220;%s&#8221;', 'ave' ), get_search_query() );

	elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
		$desc = get_post_type_object( get_query_var( 'post_type' ) )->description;
	}

	elseif ( get_query_var( 'minute' ) && get_query_var( 'hour' ) )
		$title = get_the_time( esc_html_x( 'g:i a', 'minute and hour archives time format', 'ave' ) );

	elseif ( get_query_var( 'minute' ) )
		$title = sprintf( esc_html__( 'Minute %s', 'ave' ), get_the_time( esc_html_x( 'i', 'minute archives time format', 'ave' ) ) );

	elseif ( get_query_var( 'hour' ) )
		$title = get_the_time( esc_html_x( 'g a', 'hour archives time format', 'ave' ) );

	elseif ( is_day() )
		$title = get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'ave' ) );

	elseif ( get_query_var( 'w' ) )
		$title = sprintf( esc_html__( 'Week %1$s of %2$s', 'ave' ), get_the_time( esc_html_x( 'W', 'weekly archives date format', 'ave' ) ), get_the_time( esc_html_x( 'Y', 'yearly archives date format', 'ave' ) ) );

	elseif ( is_month() )
		$title = single_month_title( ' ', false );

	elseif ( is_year() )
		$title = get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'ave' ) );

	elseif ( is_archive() )
		$title = hesc_html__( 'Archives', 'ave' );

	return array(
		$title,
		$desc
	);
}