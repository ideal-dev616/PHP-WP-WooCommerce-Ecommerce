<?php
/**
 * The Template Tags
 */

/**
 * [liquid_get_header_layout description]
 * @method liquid_get_header_layout
 * @return [type]                  [description]
 */
function liquid_get_header_layout() {

	global $post;

	//Keep old id
	if( is_404() || 
		is_search() 
	) {
		$ID = 0;
	}
	else {
		$ID = $post->ID;
	}

	// which one
	$id = liquid_get_custom_header_id();
	$header = get_post( $id );
	$post = $header;

	$header_overlay = get_post_meta( $id, 'header-overlay', true );
	$header_sticky  = get_post_meta( $id, 'header-sticky', true );
	$header_sticky_pos  = get_post_meta( $id, 'header-sticky-pos', true );
	$header_sticky_bg  = get_post_meta( $id, 'header-sticky-bg', true );
	
	$header_megamenu_react  = get_post_meta( $id, 'header-megamenu-react', true );
	

	// Hash
	$header_styles = array(
		'default'	 => 'main-header ' . $header_overlay,
		'fullscreen' => 'main-header header-fullscreen header-fullscreen-style-1 ' . $header_overlay,
		'side'       => 'main-header header-side header-side-style-1',
		'side-2'     => 'main-header header-side header-side-style-2',
		'side-3'     => 'main-header header-side header-side-style-3'
	);

	// layout
	$layout = liquid_helper()->get_post_meta( 'header-layout', $id );
	$layout = $layout ? $layout : 'default';

	// Classes
	$class = $header_styles[$layout];

	// Attributes
	$attributes = array(
		'class' => $class
	);
	
	
	if( 'yes' === $header_megamenu_react ) {
		$attributes['data-react-to-megamenu'] = 'true';
	}	
	if( 'yes' === $header_sticky ) {
		$attributes['data-sticky-header'] = 'true';
	}
	if( 'after-section' === $header_sticky_pos ) {
		$attributes['data-sticky-options'] = '{ "stickyTrigger": "first-section" }';
		
	}

	$out = array(
		'id' => $id,
		'attributes' => $attributes,
		'layout' => $layout,

		// Styles
		'color' => liquid_helper()->get_post_meta( 'nav_color' , $id ),
		'sticky_bg' => liquid_helper()->get_post_meta( 'nav_color' , $id ),
		'secondary_color' => $header_sticky_bg,
		'active_color' => liquid_helper()->get_post_meta( 'nav_active_color', $id ),
		'padding' => liquid_helper()->get_post_meta( 'nav_padding', $id ),
		'logo_padding' => get_post_meta( $id, 'nav_logo_padding', true ),
	);

	// reset
	wp_reset_postdata();
	return $out;
}

function liquid_logo_url( $retina = false ) {

	$logo        = $mobile_logo = get_template_directory_uri() . '/assets/img/logo/logo-1.svg';
	$retina_logo = $retina_mobile_logo = get_template_directory_uri() . '/assets/img/logo/logo-1@2x.png';
	
	$logo_arr = liquid_helper()->get_option( 'header-logo' );
	if( is_array( $logo_arr ) && ! empty( $logo_arr['url'] ) ) {
		$logo = $logo_arr['url'];
	}

	$retina_logo_arr = liquid_helper()->get_option( 'header-logo-retina' );
	if( is_array( $retina_logo_arr ) && ! empty( $retina_logo_arr['url'] ) ) {
		$retina_logo = $retina_logo_arr['url'];
	}
	
	if( $retina ) {
		echo  esc_url( $retina_logo ) . ' 2x';
	}
	else {
		echo esc_url( $logo );		
	}

}	

/**
 * [liquid_get_footer_layout description]
 * @method liquid_get_footer_layout
 * @return [type]                  [description]
 */
function liquid_get_footer_layout() {
	global $post;

	// which one
	$id = liquid_get_custom_footer_id();
	$footer = get_post( $id );
	$post = $footer;


	// Styles
	$styles = $out = array();

	if( $bg = liquid_helper()->get_post_meta( 'footer-bg', $id ) ) {

		if( isset( $bg['background-color'] ) ) {
			$out['background-color'] = $bg['background-color'];
		}
		if( isset( $bg['background-size'] ) ) {
			$out['background-size'] = $bg['background-size'];
		}
		if( isset( $bg['background-image'] ) ) {
			$out['background-image'] = 'url(' . $bg['background-image'] . ')' ;
		}
		if( isset( $bg['background-repeat'] ) ) {
			$out['background-repeat'] = $bg['background-repeat'];
		}
		if( isset( $bg['background-position'] ) ) {
			$out['background-position'] = $bg['background-position'];
		}
		if( isset( $bg['background-attachment'] ) ) {
			$out['background-attachment'] = $bg['background-attachment'];
		}
	}
	
	if( $bg_color =liquid_helper()->get_post_meta( 'footer-gradient', $id ) ) {
		$out['background'] = $bg_color;
	}

	if( $color = liquid_helper()->get_post_meta( 'footer-text-color', $id ) ) {
		if( $color['alpha'] < 1  ) {
			$out['color'] = isset( $color['rgba'] ) ? $color['rgba'] : '';
		} else {
			$out['color'] = isset( $color['color'] ) ? $color['color'] : '';
		}
	}
	if( $padding = liquid_helper()->get_post_meta( 'footer-padding', $id ) ) {
		$out['padding'] = $padding;
	}
	if( $link = liquid_helper()->get_post_meta( 'footer-link-color', $id ) ) {
		$out['link'] = $link;
	}

	$out = array_filter( $out );

	$out['id'] = $id;

	// reset
	wp_reset_postdata();

	return $out;
}

/**
 * [liquid_header_mobile_trigger_button description]
 * @method liquid_header_mobile_trigger_button
 * @return [type]                [description]
 */
function liquid_header_mobile_trigger_button(  $args = array() ) {

	$defaults = array(
		'class' => 'navbar-toggle collapsed',
		'data-toggle' => 'collapse',
		'data-target' => '#main-header-collapse',
		'aria-expanded' => 'false',
		'data-changeclassnames' => '{ "html": "mobile-nav-activated overflow-hidden" }'
	);
	
	$args = wp_parse_args( $args, $defaults );	
	
	$args = array_map( 'esc_attr', $args );
	
	?>
	<button type="button" <?php foreach ( $args as $name => $value ) { echo " $name=" . '"' . $value . '"'; } ?>>
		<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'ave' ) ?></span>
		<span class="bars">
			<span class="bar"></span>
			<span class="bar"></span>
			<span class="bar"></span>
		</span>
	</button>
<?php }

/**
 * [liquid_header_trigger_button description]
 * @method liquid_header_trigger_button
 * @return [type]                [description]
 */
function liquid_header_trigger_button(  $args = array() ) {

	$defaults = array(
		'class' => 'nav-trigger style-1 fill-none collapsed',
		'data-toggle' => 'collapse',
		'data-target' => '#module-1',
		'aria-expanded' => 'false',
		'aria-controls' => 'module-1',
	);
	
	$args = wp_parse_args( $args, $defaults );	
	
	$args = array_map( 'esc_attr', $args );
	
	?>
	<div class="header-module">	
		<button type="button" role="button" <?php foreach ( $args as $name => $value ) { echo " $name=" . '"' . $value . '"'; } ?>>
			<span class="bars">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</span>
		</button>
	</div><!-- /.header-module -->
<?php }

/**
 * [liquid_portfolio_media description]
 * @method liquid_portfolio_media
 * @return [type]                [description]
 */
function liquid_portfolio_media( $args = array() ) {

	if ( post_password_required() || is_attachment() ) {
		return;
	}

	$defaults = array(
		'before' => '',
		'after' => '',
		'image_class' => 'portfolio-image'
	);
	extract( wp_parse_args( $args, $defaults ) );

	$format = get_post_format();
	$style = get_post_meta( get_the_ID(), 'portfolio-style', true );
	$style = $style ? $style : 'gallery-stacked';
	$lightbox = liquid_helper()->get_option( 'post-gallery-lightbox' );

	// Audio
	if( 'audio' === $format && $audio = liquid_helper()->get_option( 'post-audio' ) ) {

		printf( '<div class="post-audio">%s</div>', do_shortcode( '[audio src="' . $audio . '"]' ) );
	}

	// Gallery
	elseif( 'gallery' === $format && $gallery = liquid_helper()->get_option( 'post-gallery' ) ) {
		
		if( 'gallery-slider' === $style ) {

			echo '<div class="carousel-container carousel-nav-floated carousel-nav-center carousel-nav-middle carousel-nav-xl carousel-nav-solid carousel-nav-rectangle">';

				echo '<div class="carousel-items row mx-0" data-lqd-flickity=\'{ "prevNextButtons": true, "navArrow": "1", "pageDots": false, "navOffsets":{"prev":"28px","next":"28px"}, "parallax": true }\'>';

					foreach ( $gallery as $item ) {
						if ( isset ( $item['attachment_id'] ) ) {

							$src_image     = wp_get_attachment_image_src( $item['attachment_id'], 'full' );
							$resized_image = liquid_get_resized_image_src( $src_image, 'liquid-large-slider' );
							$retina_image  = liquid_get_retina_image( $resized_image );

							printf( '<div class="carousel-item col-xs-12 px-0"><figure><img src="%s" alt="%s"></figure></div>',$resized_image , esc_attr( $item['title'] ) );

						}
					}

				echo '</div>';

			echo '</div>';
		}
		
	}

	// Video
	elseif( 'video' === $format ) {
		$video = '';
		if( $url = liquid_helper()->get_option( 'post-video-url', 'url' ) ) {
			global $wp_embed;
			echo wp_kses_post( $wp_embed->run_shortcode( '[embed]' . $url . '[/embed]' ) );
		}
		elseif( $file = liquid_helper()->get_option( 'post-video-file' ) ) {
			if( liquid_helper()->str_contains( '[embed', $file ) ) {
				global $wp_embed;
				echo wp_kses_post( $wp_embed->run_shortcode( $file ) );
			} else {
				echo do_shortcode( $file );
			}
		}
		else {
			$video = liquid_helper()->get_option( 'post-video-html' );
		}

		if( '' != $video ) {
			$my_allowed = wp_kses_allowed_html( 'post' );

			// iframe
			$my_allowed['iframe'] = array(
				'align' => true,
				'width' => true,
				'height' => true,
				'frameborder' => true,
				'name' => true,
				'src' => true,
				'id' => true,
				'class' => true,
				'style' => true,
				'scrolling' => true,
				'marginwidth' => true,
				'marginheight' => true,
			);

			echo wp_kses( $video, $my_allowed );
		}

	}

	else {

		$attachment = get_post( get_post_thumbnail_id() );
		
		
		printf( '%s <figure class="%s" data-element-inview="true">', $before, $image_class );
			echo '<div class="overlay"></div>';
			liquid_the_post_thumbnail( 'liquid-large', array(
			));
			if( is_object( $attachment ) && ! empty( $attachment->post_excerpt ) ) {
				printf( '<figcaption><span>%s</span></figcaption>', $attachment->post_excerpt );
			}
		echo '</figure>' . $after;
	}
}

/**
 * [liquid_portfolio_subtitle description]
 * @method liquid_portfolio_subtitle
 * @param  [type]               $key   [description]
 * @param  [type]               $label [description]
 * @return [type]                      [description]
 */
function liquid_portfolio_subtitle( $before, $after ) {

	$value = get_post_meta( get_the_ID(), 'portfolio-subtitle', true );
	if( empty( $value ) ) {
		return;
	}
	
	printf( '%1$s %2$s %3$s', $before, esc_html( $value ), $after  );

}

/**
 * [liquid_portfolio_meta description]
 * @method liquid_portfolio_meta
 * @param  [type]               $key   [description]
 * @param  [type]               $label [description]
 * @return [type]                      [description]
 */
function liquid_portfolio_meta( $key, $label, $col = 6 ) {

	$value = get_post_meta( get_the_ID(), 'portfolio-' . $key, true );
	if( !$value ) {
		return;
	}
	?>
	<div class="col-md-<?php echo esc_attr( $col ) ?>">

		<p>
			<strong class="info-title"><?php echo esc_html( $label ) ?>:</strong> <?php echo esc_html( $value ); ?>
		</p>

	</div>
	<?php
}

/**
 * [liquid_portfolio_atts description]
 * @method liquid_portfolio_date
 * @return [type]               [description]
 */
function liquid_portfolio_atts( $col = 6 ) {

	$atts = get_post_meta( get_the_ID(), 'portfolio-attributes', true );
	if( !is_array( $atts ) ) {
		return;
	}
	foreach ( $atts as $attr ) {

		if( !empty( $attr ) ) {
			$attr = explode( "|", $attr );
			$label = isset( $attr[0] ) ? $attr[0] : '';
			$value = isset( $attr[1] ) ? $attr[1] : $label;
		?>
		<span>
			<?php if( $label ) { ?><small class="text-uppercase ltr-sp-1"><?php echo esc_html( $label ) ?>:</small><?php } ?>
			<h5 class="my-0"><?php echo esc_html( $value ); ?></h5>
		</span>
		<?php
		}
	}
}

/**
 * [liquid_portfolio_archive_link description]
 * @method liquid_portfolio_archive_link
 * @return [type]               [description]
 */
function liquid_portfolio_archive_link() {

	$pf_link         = liquid_helper()->get_option( 'portfolio-archive-link' );
	$pf_archive_link = get_post_type_archive_link( 'liquid-portfolio' );

	$link = ! empty( $pf_link ) ? $pf_link : $pf_archive_link;
	?>
	<a href="<?php echo esc_url( $link ) ?>" class="portfolio-view-all"><span></span></a>
	<?php
}

/**
 * [liquid_portfolio_date description]
 * @method liquid_portfolio_date
 * @return [type]               [description]
 */
function liquid_portfolio_date() {

	if( 'off' === liquid_helper()->get_option( 'portfolio-enable-date' ) ) {
		return;
	}

	$label = liquid_helper()->get_option( 'portfolio-date-label' ) ? liquid_helper()->get_option( 'portfolio-date-label' ) : esc_html__( 'Date', 'ave' );
	$date  = liquid_helper()->get_option( 'portfolio-date' ) ? liquid_helper()->get_option( 'portfolio-date' ) : get_the_date( get_option( 'date_time' ) );

	?>
	<span>
		<?php if( $label ) { ?>
			<small class="text-uppercase ltr-sp-1"><?php echo esc_html( $label ) ?>:</small>
		<?php } ?>
		<h5 class="my-0"><?php echo esc_html( $date ) ?></h5>
	</span>
	<?php
}

/**
 * [liquid_portfolio_likes description]
 * @method liquid_portfolio_likes
 * @return [type]                [description]
 */
function liquid_portfolio_likes( $class = 'portfolio-likes style-alt', $post_type = 'portfolio' ) {

	$option_name = str_replace( 'liquid-', '', $post_type ) . '-likes-';
	if( 'off' === liquid_helper()->get_option( $option_name . 'enable' ) || ! function_exists( 'liquid_likes_button' ) ) {
		return;
	}

	liquid_likes_button(array(
		'container' => 'div',
		'container_class' => $class,
		'format' => wp_kses_post( __( '<span><i class="fa fa-heart"></i> <span class="post-likes-count">%s</span></span>', 'ave' ) )
	));
}

/**
 * [liquid_get_lightbox_link]
 * @method liquid_get_lightbox_link
 * @return [type]                [description]
 */
function liquid_get_lightbox_link( $link_to_image ) {
	if( empty( $link_to_image ) ) {
		return;
	}

	return '<a class="lightbox-link" data-type="image" href="' . esc_url( $link_to_image ) . '"></a>';
}

/**
 * [liquid_render_related_posts description]
 * @method liquid_render_related_posts
 * @param  string                     $post_type [description]
 * @return [type]                                [description]
 */
function liquid_render_related_posts( $post_type = 'post' ) {

	$folder = str_replace( 'liquid-', '', $post_type );
	$option_name = $folder . '-related-';
	if( 'off' === liquid_helper()->get_option( $option_name . 'enable' ) ) {
		return;
	}

	$heading = liquid_helper()->get_option( $option_name . 'title', 'html' );
	$style = liquid_helper()->get_option( 'portfolio-related-style' );

	//get value from options
	$post_style = liquid_helper()->get_option( 'post-style' );

	$number_of_posts = liquid_helper()->get_option( $option_name . 'number' );
	$number_of_posts = '0' == $number_of_posts ? '3' : $number_of_posts;
	
	$taxonomy = 'post' === $post_type ? 'category' : $post_type . '-category';

	$related_posts = liquid_get_post_type_related_posts( get_the_ID(), $number_of_posts, $post_type, $taxonomy );

	if( $related_posts && $related_posts->have_posts() ) {
		$located = locate_template( array(
			'templates/related-post-' . $post_style . '.php',
			'templates/related-'. $folder .'.php',
			'templates/related-posts.php'
		) );

		if( $located ) require $located;
	}
}

/**
 * [liquid_get_post_type_related_posts description]
 * @method liquid_get_post_type_related_posts
 * @param  [type]                            $post_id      [description]
 * @param  integer                           $number_posts [description]
 * @param  string                            $post_type    [description]
 * @param  string                            $taxonomy     [description]
 * @return [type]                                          [description]
 */
function liquid_get_post_type_related_posts( $post_id, $number_posts = 6, $post_type = 'post', $taxonomy = 'category' ) {

	if( 0 == $number_posts ) {
		return false;
	}

	$item_array = array();
	$item_cats = get_the_terms( $post_id, $taxonomy );
	if ( $item_cats ) {
		foreach( $item_cats as $item_cat ) {
			$item_array[] = $item_cat->term_id;
		}
	}

	if( empty( $item_array ) ) {
		return false;
	}

	$args = array(
		'post_type'				=> $post_type,
		'posts_per_page'		=> $number_posts,
		'post__not_in'			=> array( $post_id ),
		'ignore_sticky_posts'	=> 0,
		'tax_query'				=> array(
			array(
				'field'		=> 'id',
				'taxonomy'	=> $taxonomy,
				'terms'		=> $item_array
			)
		)
	);

	return new WP_Query( $args );
}

/**
 * [liquid_render_post_nav description]
 * @method liquid_render_post_nav
 * @param  string                $post_type [description]
 * @return [type]                           [description]
 */
function liquid_render_post_nav( $post_type = 'post' ) {

	$post_type = str_replace( 'liquid-', '', $post_type );
	if( 'off' === liquid_helper()->get_option( $post_type . '-navigation-enable' ) ) {
		return;
	}

	$post_type = 'post' === $post_type ? 'blog' : $post_type;
	get_template_part( 'templates/'. $post_type .'/single/navigation' );
}

/**
 * [liquid_portfolio_the_content description]
 * @method liquid_portfolio_the_content
 * @return [type]                      [description]
 */
function liquid_portfolio_the_content() {

	$content = get_post_meta( get_the_ID(), 'portfolio-description', true );
	if( $content ) {
		echo apply_filters( 'the_content', $content );
		return;
	}

	$content = get_the_content();
	if( liquid_helper()->str_contains( '[vc_row', $content ) ) {
		return;
	}

	the_content( sprintf(
		esc_html__( 'Continue reading %s', 'ave' ),
		the_title( '<span class="screen-reader-text">', '</span>', false )
	) );
}

/**
 * [liquid_portfolio_the_excerpt description]
 * @method liquid_portfolio_the_content
 * @return [type]                      [description]
 */
function liquid_portfolio_the_excerpt() {

	$excerpt = get_post_meta( get_the_ID(), 'portfolio-description', true );
	if( $excerpt ) {
		$excerpt = apply_filters( 'get_the_excerpt', $excerpt );
		$excerpt = apply_filters( 'the_excerpt', $excerpt );
		echo wp_kses_post( $excerpt );
		return;
	}

	$excerpt = get_the_excerpt();
	if( liquid_helper()->str_contains( '[vc_row', $excerpt ) ) {
		return;
	}

	the_excerpt( sprintf(
		esc_html__( 'Continue reading %s', 'ave' ),
		the_title( '<span class="screen-reader-text">', '</span>', false )
	) );
}


/**
 * [liquid_portfolio_the_vc description]
 * @method liquid_portfolio_the_vc
 * @return [type]                 [description]
 */
function liquid_portfolio_the_vc() {

	$content = get_the_content();
	if( !liquid_helper()->str_contains( '[vc_row', $content ) ) {
		return;
	}

	the_content( sprintf(
		esc_html__( 'Continue reading %s', 'ave' ),
		the_title( '<span class="screen-reader-text">', '</span>', false )
	) );
}

/**
 * [liquid_author_link description]
 * @method liquid_author_link
 * @param  array             $args [description]
 * @return [type]                  [description]
 */
function liquid_author_link( $args = array() ) {

	global $authordata;
    if ( ! is_object( $authordata ) ) {
        return;
    }

	$defaults = array(
		'before' => '',
		'after' => ''
	);
	extract( wp_parse_args( $args, $defaults ) );

	$link = sprintf(
        '<a class="url fn" href="%1$s" title="%2$s" rel="author">%3$s</a>',
        esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
        esc_attr( sprintf( esc_html__( 'Posts by %s', 'ave' ), get_the_author() ) ),
        $before . get_the_author() . $after
    );
	?>
	<span <?php liquid_helper()->attr( 'entry-author', array( 'class' => 'vcard author' ) ); ?>>
		<span itemprop="name">
			<?php echo apply_filters( 'liquid_author_link', $link ); ?>
		</span>
	</span>
	<?php
}

/**
 * [liquid_get_category description]
 * @method liquid_get_category
 * @return [type]            [description]
 */
function liquid_get_category() {
	
	$category = get_the_category();

	if ( class_exists('WPSEO_Primary_Term') )
	{
		// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
		$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
		$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
		$term = get_term( $wpseo_primary_term );

		if ( is_wp_error( $term ) ) { 
			// Default to first category (not Yoast) if an error is returned
			$category_display = $category[0]->name;
			$category_link = get_category_link( $category[0]->term_id );
		} else { 
			// Yoast Primary category
			$category_display = $term->name;
			$category_link = get_category_link( $term->term_id );
		}

	} 
	else {
		// Default, display the first category in WP's list of assigned categories
		$category_display = $category[0]->name;
		$category_link = get_category_link( $category[0]->term_id );
	}

	$cat = isset( $category[0] ) ? $category[0] : '';
	if( empty( $cat ) ) {
		return;
	}

	echo '<a href="' . esc_url( $category_link ) . '" rel="category tag">' . esc_html( $category_display ) . '</a>';
	
}

/**
 * [liquid_author_role description]
 * @method liquid_author_role
 * @return [type]            [description]
 */
function liquid_author_role() {

	global $authordata;
    if ( ! is_object( $authordata ) ) {
        return;
    }

	$user = new WP_User( $authordata->ID );
    return array_shift( $user->roles );
}

if ( ! function_exists( 'liquid_post_time' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function liquid_post_time( $icon = false, $echo = true ) {

	$time_string = '<time %5$s >%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() ),
		liquid_helper()->get_attr( 'entry-published' )
	);

	$time_url = get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) );
	$icon_html = $icon ? '<i class="fa fa-clock-o"></i>' : '';

	$out = sprintf( '<a href="%1$s">%3$s %2$s</a>', get_the_permalink(), $time_string, $icon_html );

	if( $echo ) {
		echo apply_filters( 'liquid_post_time', $out );
	} else {
		return apply_filters( 'liquid_post_time', $out );
	}
}
endif;