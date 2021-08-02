<?php
/**
 * Liquid Themes Theme Framework
 */

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

/**
 * Liquid_Theme_Layout
 */
class Liquid_Theme_Layout extends Liquid_Base {

	public function __construct() {

		$this->add_action( 'wp', 'init' );
		$this->add_filter( 'body_class', 'body_classes' );

		$this->add_action( 'liquid_before_content', 'start_container' );

		$this->add_action( 'liquid_before_content', 'start_row_wrapper' );
		$this->add_action( 'liquid_after_content', 'end_row_wrapper' );

		$this->add_action( 'liquid_after_content', 'end_container' );

		$this->add_action( 'liquid_single_post_sidebar', 'add_single_post_sidebar' );
		$this->add_action( 'liquid_start_single_post_container', 'start_single_post_container' );
		$this->add_action( 'liquid_end_single_post_container', 'end_single_post_container' );

	}

	public function init() {

		// Get the sidebars and assign to public variable.
		$this->sidebars = $this->setup_sidebar( $this->setup_options() );
	}

	public function body_classes( $classes ) {

		if( $this->has_sidebar() ) {
			$classes[] = 'has-sidebar';

			if( 'left' === $this->sidebars['position'] ) {
				$classes[] = 'has-left-sidebar';
			}
		}

		return $classes;
	}
	
	public function start_container() {

		if( is_404() ) {
			return;
		}

		global $post;
		$content = '';

		if( $post ) {
			$content = $post->post_content;	
		}
		
		if( !is_singular( 'post' ) && !has_shortcode( $content, 'vc_row' ) 
			|| is_search() 
			|| is_home()
			|| is_category()
			|| is_tag()
			|| is_author()
			|| is_post_type_archive( 'liquid-portfolio' ) 
			|| is_tax( 'liquid-portfolio-category' )
			|| class_exists( 'WooCommerce' ) && is_product_taxonomy() 
			|| class_exists( 'WooCommerce' ) && is_product_category() 
			|| class_exists( 'WooCommerce' ) && is_singular( 'product' )
			|| class_exists( 'WooCommerce' ) && is_shop()
			|| $this->has_sidebar() && !is_singular( 'post' )
		) :
			echo '<div class="container">';
		endif;
	}
	
	public function end_container() {
		
		if( is_404() ) {
			return;
		}

		global $post;
		$content = '';

		if( $post ) {
			$content = $post->post_content;	
		}

		if( !is_singular( 'post' ) && !has_shortcode( $content, 'vc_row' ) 
			|| is_search() 
			|| is_home()
			|| is_category()
			|| is_tag()
			|| is_author()
			|| is_post_type_archive( 'liquid-portfolio' ) 
			|| is_tax( 'liquid-portfolio-category' ) 
			|| class_exists( 'WooCommerce' ) && is_product_taxonomy() 
			|| class_exists( 'WooCommerce' ) && is_product_category() 
			|| class_exists( 'WooCommerce' ) && is_singular( 'product' )
			|| class_exists( 'WooCommerce' ) && is_shop()
			|| $this->has_sidebar() && !is_singular( 'post' )
		) :
			echo '</div>';
		endif;
	}

	public function start_row_wrapper() {
		
		if( is_singular( 'post' ) || is_404() ) {
			return;
		}
		
		if( $this->has_sidebar() ) {
			echo '<div class="row">';

			$content_class = '';

			if( 'right' === $this->sidebars['position'] ) {
				$content_class = 'col-md-8 contents-container';
			}
			elseif( 'left' === $this->sidebars['position'] ) {
				$content_class = 'col-md-8 contents-container col-md-offset-1';
				get_template_part( 'templates/sidebar-left' );
			}
			
			$content_class = apply_filters( 'liquid_single_post_class', $content_class );

			echo '<div class="'. $content_class .'">';
		}
	}

	public function end_row_wrapper() {
		
		if( is_singular( 'post' ) || is_404() ) {
			return;
		}

		if( $this->has_sidebar() ) {

			echo '</div><!-- /content -->';

			if( 'right' === $this->sidebars['position'] ) {
				get_template_part( 'templates/sidebar' );
			}

			echo '</div>';
		}
	}
	
	public function start_single_post_container() {
		
		$style = liquid_helper()->get_option( 'post-style' );
		
		if( 'custom' === $style ) {
			$content_class = 'blog-single-custom-contents';
		}
		else {
			$content_class = 'col-md-8 col-md-offset-2 contents-container';
		}

		if( $this->has_sidebar() ) {
			$content_class = 'col-md-8 contents-container';
		}

		$content_class = apply_filters( 'liquid_single_post_container', $content_class );

		echo '<div class="'. $content_class .'">';
	}
	
	public function end_single_post_container() {

		echo '</div><!-- /.col-md-8 -->';

	}

	public function add_single_post_sidebar() {
		if( $this->has_sidebar() ) {
			get_template_part( 'templates/sidebar' );
		}
	}

	public function setup_sidebar( $sidebar_options ) {

		if( !class_exists( 'ReduxFramework' ) && is_active_sidebar( 'main' ) || 
			!class_exists( 'Liquid_Addons' ) && is_active_sidebar( 'main' )  
		) { 
			$sidebar          = 'main';
			$sidebar_position = 'right';
		}
		else {
			// Post Options.
			$sidebar          = liquid_helper()->get_option( 'liquid-sidebar-one', 'raw', false );
			$sidebar_position = liquid_helper()->get_option( 'liquid-sidebar-position', 'raw', 'default' );
		}

		$opts_sidebar = isset( $sidebar_options['sidebar'] ) ? $sidebar_options['sidebar'] : '';
		// Setting Default
		$sidebar_position = $sidebar ? $sidebar_position : 'default';
		$sidebar = $sidebar ? $sidebar : $opts_sidebar;

		// Theme options.
		$sidebar_position_theme_option = array_key_exists( 'position', $sidebar_options ) ? strtolower( $sidebar_options['position'] ) : '';

		// Get sidebars and position from theme options if it's being forced globally.
		if ( array_key_exists( 'global', $sidebar_options ) && 'on' === $sidebar_options['global'] ) {
			$sidebar = ( '' != $sidebar_options['sidebar'] ) ? $sidebar_options['sidebar'] : '';
			$sidebar_position = $sidebar_position_theme_option;
		}

		// If sidebar position is default OR no entry in database exists.
		if ( 'default' === $sidebar_position ) {
			$sidebar_position = $sidebar_position_theme_option;
		}

		$return = array( 'position' => $sidebar_position );

		if ( $sidebar && 'none' !== $sidebar ) {
			$return['sidebar'] = $sidebar;
		}

		return $return;
	}

	public function has_sidebar( $which = '1' ) {

		if( is_array( $this->sidebars ) && isset( $this->sidebars['sidebar'] ) && ! empty( $this->sidebars['sidebar'] ) ) {
			return true;
		}

		return false;
	}

	public function has_double_sidebars() {

		if( $this->has_sidebar('1') && $this->has_sidebar('2') ) {
			return true;
		}

		return false;
	}

	public function setup_options() {

		if( is_home() ) {
			$sidebars = array(
				'global'    => true,
				'sidebar'   => liquid_helper()->get_theme_option( 'blog-archive-sidebar-one' ),
				'position'  => liquid_helper()->get_theme_option( 'blog-archive-sidebar-position' ),
			);
		}
		elseif ( class_exists( 'WooCommerce' ) && is_product() ) {
			$sidebars = array(
				'global'    => liquid_helper()->get_theme_option( 'wc-enable-global' ),
				'sidebar'   => liquid_helper()->get_theme_option( 'wc-sidebar' ),
				'position'  => liquid_helper()->get_theme_option( 'wc-sidebar-position' ),
			);
		}
		elseif ( class_exists( 'WooCommerce' ) && ( is_product_taxonomy() || is_product_category() ) ) {
			$sidebars = array(
				'global'    => true,
				'sidebar'   => liquid_helper()->get_theme_option( 'wc-archive-sidebar-one' ),
				'position'  => liquid_helper()->get_theme_option( 'wc-archive-sidebar-position' )
			);
		}
		elseif ( is_page() ) {
			$sidebars = array(
				'global'    => liquid_helper()->get_theme_option( 'page-enable-global' ),
				'sidebar'   => liquid_helper()->get_theme_option( 'page-sidebar-one' ),
				'position'  => liquid_helper()->get_theme_option( 'page-sidebar-position' ),
			);
		}
		elseif ( is_single() ) {

			$sidebars = array(
				'global'    => liquid_helper()->get_theme_option( 'blog-enable-global' ),
				'sidebar'   => liquid_helper()->get_theme_option( 'blog-sidebar-one' ),
				'position'  => liquid_helper()->get_theme_option( 'blog-sidebar-position' )
			);

			if ( is_singular( 'liquid-portfolio' ) ) {
				$sidebars = array(
					'global'    => liquid_helper()->get_theme_option( 'portfolio-enable-global' ),
					'sidebar'   => liquid_helper()->get_theme_option( 'portfolio-sidebar-one' ),
					'position'  => liquid_helper()->get_theme_option( 'portfolio-sidebar-position' ),
				);
			}
		}
		elseif ( is_archive() ) {
			$sidebars = array(
				'global'    => true,
				'sticky'    => liquid_helper()->get_theme_option( 'blog-archive-sidebar-enable-sticky' ),
				'sidebar'   => liquid_helper()->get_theme_option( 'blog-archive-sidebar-one' ),
				'position'  => liquid_helper()->get_theme_option( 'blog-archive-sidebar-position' ),

			);

			if ( is_post_type_archive( 'liquid-portfolio' ) || is_tax( 'liquid-portfolio-category' ) ) {
				$sidebars = array(
					'global'    => true,
					'sticky'    => liquid_helper()->get_theme_option( 'portfolio-archive-sidebar-enable-sticky' ),
					'sidebar'   => liquid_helper()->get_theme_option( 'portfolio-archive-sidebar-one' ),
					'position'  => liquid_helper()->get_theme_option( 'portfolio-archive-sidebar-position' ),
				);
			}
		}
		 elseif ( is_search() ) {
			$sidebars = array(
				'global'    => true,
				'sticky'    => liquid_helper()->get_theme_option( 'seach-sidebar-enable-sticky' ),
				'sidebar'   => liquid_helper()->get_theme_option( 'search-sidebar-one' ),
				'position'  => liquid_helper()->get_theme_option( 'search-sidebar-position' ),
			);
		}
		else {
			$sidebars = array(
				'global'    => liquid_helper()->get_theme_option( 'page-enable-global' ),
				'sticky'    => liquid_helper()->get_theme_option( 'page-sidebar-enable-sticky' ),
				'sidebar'   => liquid_helper()->get_theme_option( 'page-sidebar-one' ),
				'position'  => liquid_helper()->get_theme_option( 'page-sidebar-position' ),
			);
		}

		// Remove sidebars from the certain woocommerce pages.
		if ( class_exists( 'WooCommerce' ) ) {
			if ( is_cart() || is_checkout() || is_account_page() || ( get_option( 'woocommerce_thanks_page_id' ) && is_page( get_option( 'woocommerce_thanks_page_id' ) ) ) ) {
				$sidebars = array();
			}
		}

		return $sidebars;
	}

}
return new Liquid_Theme_Layout;