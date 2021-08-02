<?php
/**
 * The Menu Walker
 * Menu Walker class extends from Nav Menu Walker
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Mega_Menu_Walker extends Walker_Nav_Menu {

	/**
     * Starts the list before the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::start_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of wp_nav_menu() arguments.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"nav-item-children\">\n";
    }

	/**
     * @see Walker::start_el()
     */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$item_html = $is_fullwidth = '';

		if( '[divider]' === $item->title ) {
			$output .= '<li class="menu-item-divider"></li>';
			return;
		}

		if( !empty( $item->liquid_megaprofile ) ) {
			$is_fullwidth = get_post_meta( $item->liquid_megaprofile, 'megamenu-fullwidth', true );
			if( 'yes' === $is_fullwidth ) {
				$item->classes[] = 'megamenu menu-item-has-children megamenu-fullwidth';
			}
			else {
				$item->classes[] = 'megamenu menu-item-has-children';
			}
		}
		
		if( ! empty( $args->local_scroll ) && $depth === 0 ) {
			$item->classes[] = 'local-scroll' ;
		}

		if( 'submenu-dark' === $item->liquid_submenu_color ) {
			$item->classes[] = 'submenu-dark';
		}
		elseif( 'nav-item-children-style2' === $item->liquid_submenu_color ) {
			$item->classes[] = 'nav-item-children-style2';
		}
		
		if( $item->thumbnail_id ) {
			$item->liquid_icon = '';
			
			$icon_src = wp_get_attachment_url( $item->thumbnail_id );
			$filetype = wp_check_filetype( $icon_src );
			if( 'svg' === $filetype['ext'] ) {
				add_filter( 'https_ssl_verify', '__return_false' );
				$request  = wp_remote_get( $icon_src );
				$response = wp_remote_retrieve_body( $request );
				$custom_icon = $response;
			} else {
				$custom_icon = wp_get_attachment_image( $item->thumbnail_id, 'full', false, array( 'class' => 'liquid-custom-image-icon' ) );
			}
			
			if( 'left' === $item->liquid_icon_position ) {
				$args->old_link_before = $args->link_before;
				$args->link_before = '<span class="link-icon left-icon">' . $custom_icon . '</span>' . $args->link_before;
			} 
			elseif( 'center' === $item->liquid_icon_position ) {
				$item->classes[] = 'center-icon';
				$args->old_link_before = $args->link_before;
				$args->link_before = '<span class="link-icon center-icon">' . $custom_icon . '</span>' . $args->link_before;
			}
			else {
				$args->old_link_after = $args->link_after;
				$args->link_after = $args->link_after . '<span class="link-icon right-icon">' . $custom_icon . '</span>';			
			}
		}
		
		if( ! empty( $item->liquid_icon ) ) {
			if( 'left' === $item->liquid_icon_position ) {
				$args->old_link_before = $args->link_before;
				$args->link_before = '<span class="link-icon left-icon"><i class="'. esc_attr( $item->liquid_icon ) .'"></i></span>' . $args->link_before;
			} 
			elseif( 'center' === $item->liquid_icon_position ) {
				$item->classes[] = 'center-icon';
				$args->old_link_before = $args->link_before;
				$args->link_before = '<span class="link-icon center-icon"><i class="'. esc_attr( $item->liquid_icon ) .'"></i></span>' . $args->link_before;
			}
			else {
				$args->old_link_after = $args->link_after;
				$args->link_after = $args->link_after . '<span class="link-icon right-icon"><i class="'. esc_attr( $item->liquid_icon ) .'"></i></span>';				
			}
		}

		if( !empty( $args->caret_visibility ) && ( $item->hasChildren || !empty( $item->liquid_megaprofile ) ) ) {
			$args->old_link_after = $args->link_after;
			$args->link_after = $args->link_after . '<i class="fa fa-caret-down"></i>';
		}

		if( !empty( $item->liquid_badge ) ) {
			$args->old_link_after = $args->link_after;
			$args->link_after = $args->link_after . '<span class="lqd-menu-badge">'. esc_html( $item->liquid_badge ) . '</span>';
		}

		if( isset( $args->nav_style ) && 'onepage' === $args->nav_style ) {
			$item->classes[] = 'local-scroll';
		}
		
        parent::start_el( $item_html, $item, $depth, $args, $id );
        
		if( 'yes' === $item->liquid_heading_item ) {
			$item_html = str_replace( '</a>', '</h5>', $item_html );
			$item_html = preg_replace( '/<a(.*?)href="(.*?)"(.*?)>/', '<h5>', $item_html );
		}

		if( !empty( $args->old_link_before ) ) {
			$args->link_before = $args->old_link_before;
			$args->old_link_before = '';
		}

		if( !empty( $args->old_link_after ) ) {
			$args->link_after = $args->old_link_after;
			$args->old_link_after = '';
		}

		if( !empty( $item->liquid_megaprofile ) ) {
			$item_html .= $this->get_megamenu( $item->liquid_megaprofile );
		}

		$output .= $item_html;
	}

	function get_megamenu( $id ) {
		$post = get_post( $id );
		
		$content = $post->post_content;

		if( has_shortcode( $content, 'ld_carousel' ) ) {
			wp_enqueue_style( 'flickity' );
		}

		$content = str_replace( '[vc_row ', '[vc_row el_class="megamenu-inner-row" ', $content );
		$content = str_replace( '[vc_column ', '[vc_column el_class="megamenu-column" ', $content );

		$content = str_replace( '[vc_row]', '[vc_row el_class="megamenu-inner-row"]', $content );
		$content = str_replace( '[vc_column]', '[vc_column el_class="megamenu-column"]', $content );

		$content = do_shortcode( $content );

		$css = liquid_helper()->get_vc_custom_css( $id );
		
		

        return $css . '<ul class="nav-item-children"><li><div class="container megamenu-container">' . $content . '</div></li></ul>';
	}

	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

		// check whether this item has children, and set $item->hasChildren accordingly
		$element->hasChildren = isset( $children_elements[$element->ID] ) && !empty( $children_elements[$element->ID] );

		return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}
