<?php
/**
* Liquid Themes Theme Framework
* The Liquid_Menu_Item_Custom_Image initiate the theme option machine.
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Menu_Item_Custom_Image {
	
	/**
	 * Plugin constructor, add all filters and actions.
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'menu_image_init' ) );
		add_filter( 'manage_nav-menus_columns', array( $this, 'menu_image_nav_menu_manage_columns' ), 11 );
		add_action( 'save_post_nav_menu_item', array( $this, 'menu_image_save_post_action' ), 10, 3 );
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'menu_image_wp_setup_nav_menu_item' ) );
		add_action( 'admin_action_delete-menu-item-image', array( $this, 'menu_image_delete_menu_item_image_action' ) );
		add_action( 'wp_ajax_set-menu-item-thumbnail', array( $this, 'wp_ajax_set_menu_item_thumbnail' ) );
		add_action( 'wp_update_nav_menu_item', array( $this, 'wp_update_nav_menu_item_action' ), 10, 2 );
		add_action( 'admin_init', array( $this, 'admin_init' ), 99 );
		
	}
	
	/**
	 * Admin init action with lowest execution priority
	 */
	public function admin_init() {
		// Add custom field for menu edit walker
		if ( !has_action( 'wp_nav_menu_item_custom_fields' ) ) {
			add_filter( 'wp_edit_nav_menu_walker', array( $this, 'menu_image_edit_nav_menu_walker_filter' ) );
		}
		add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'menu_item_custom_fields' ), 10, 4 );
	}
	
	
	/**
	 * Save item settings while WPML sync menus.
	 *
	 * @param $item_menu_id
	 * @param $menu_item_db_id
	 */
	public function wp_update_nav_menu_item_action( $item_menu_id, $menu_item_db_id ) {
		global $sitepress, $icl_menus_sync;
		if ( class_exists( 'SitePress' ) && $sitepress instanceof SitePress && class_exists( 'ICLMenusSync' ) && $icl_menus_sync instanceof ICLMenusSync ) {
			static $run_times = array();
			$menu_image_settings = array(
				'menu_item_image_size',
				'menu_item_image_title_position',
				'thumbnail_id',
				'thumbnail_hover_id',
			);

			// iterate synchronized menus
			foreach ( $icl_menus_sync->menus as $menu_id => $menu_data ) {
				if ( !isset( $_POST[ 'sync' ][ 'add' ][ $menu_id ] ) ) {
					continue;
				}

				// remove cache and get language current item menu
				$cache_key   = md5( serialize( array( $item_menu_id, 'tax_nav_menu' ) ) );
				$cache_group = 'get_language_for_element';
				wp_cache_delete( $cache_key, $cache_group );
				$lang = $sitepress->get_language_for_element( $item_menu_id, 'tax_nav_menu' );

				if ( !isset( $run_times[ $menu_id ][ $lang ] ) ) {
					$run_times[ $menu_id ][ $lang ] = 0;
				}

				// Count static var for each menu id and saved item language
				// and get original item id from counted position of synchronized
				// items from POST data. That's all magic.
				$post_item_ids = array();
				foreach ( $_POST[ 'sync' ][ 'add' ][ $menu_id ] as $id => $lang_array ) {
					if ( array_key_exists( $lang, $lang_array ) ) {
						$post_item_ids[ ] = $id;
					}
				}
				if ( !array_key_exists( $run_times[ $menu_id ][ $lang ], $post_item_ids ) ) {
					continue;
				}
				$orig_item_id = $post_item_ids[ $run_times[ $menu_id ][ $lang ] ];

				// iterate all item settings and save it for new item
				$orig_item_meta = get_metadata( 'post', $orig_item_id );
				foreach ( $menu_image_settings as $meta ) {
					if ( isset( $orig_item_meta[ "_$meta" ] ) && isset( $orig_item_meta[ "_$meta" ][ 0 ] ) ) {
						update_post_meta( $menu_item_db_id, "_$meta", $orig_item_meta[ "_$meta" ][ 0 ] );
					}
				}
				$run_times[ $menu_id ][ $lang ] ++;
				break;
			}
		}
	}
	
	/**
	 * Replacement edit menu walker class.
	 *
	 * @return string
	 */
	public function menu_image_edit_nav_menu_walker_filter() {
		return 'Liquid_Mega_Menu_Edit_Walker';
	}
	
	/**
	 * Load menu image meta for each menu item.
	 *
	 * @since 2.0
	 */
	public function menu_image_wp_setup_nav_menu_item( $item ) {
		if ( !isset( $item->thumbnail_id ) ) {
			$item->thumbnail_id = get_post_thumbnail_id( $item->ID );
		}
		if ( !isset( $item->thumbnail_hover_id ) ) {
			$item->thumbnail_hover_id = get_post_meta( $item->ID, '_thumbnail_hover_id', true );
		}
		if ( !isset( $item->image_size ) ) {
			$item->image_size = get_post_meta( $item->ID, '_menu_item_image_size', true );
		}
		if ( !isset( $item->title_position ) ) {
			$item->title_position = get_post_meta( $item->ID, '_menu_item_image_title_position', true );
		}

		return $item;
	}
	
	/**
	 * Adding images as screen options.
	 *
	 * If not checked screen option 'image', uploading form not showed.
	 *
	 * @param array $columns
	 *
	 * @return array
	 */
	public function menu_image_nav_menu_manage_columns( $columns ) {
		return $columns + array( 'image' => esc_html__( 'Image', 'ave' ) );
	}

	/**
	 * Saving post action.
	 *
	 * Saving uploaded images and attach/detach to image post type.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 */
	public function menu_image_save_post_action( $post_id, $post ) {
		$menu_image_settings = array(
			'menu_item_image_size',
			'menu_item_image_title_position'
		);
		foreach ( $menu_image_settings as $setting_name ) {
			if ( isset( $_POST[ $setting_name ][ $post_id ] ) && !empty( $_POST[ $setting_name ][ $post_id ] ) ) {
				if ( $post->{"_$setting_name"} != $_POST[ $setting_name ][ $post_id ] ) {
					update_post_meta( $post_id, "_$setting_name", esc_sql( $_POST[ $setting_name ][ $post_id ] ) );
				}
			}
		}
	}
	
	/**
	 * Add custom fields to menu item.
	 *
	 * @param int    $item_id
	 * @param object $item
	 * @param int    $depth
	 * @param array  $args
	 *
	 * @see http://web.archive.org/web/20141021012233/http://shazdeh.me/2014/06/25/custom-fields-nav-menu-items
	 * @see https://core.trac.wordpress.org/ticket/18584
	 */
	public function menu_item_custom_fields( $item_id, $item, $depth, $args ) {
		if (!$item_id && isset($item->ID)) {
			$item_id = $item->ID;
		}
		?>
		<div class="field-image hide-if-no-js wp-media-buttons">
			<?php $this->wp_post_thumbnail_html( $item_id ) ?>
		</div>
	<?php
	}


	/**
	 * Initialization action.
	 *
	 * Adding image sizes for most popular menu icon sizes. Adding thumbnail
	 *  support to menu post type.
	 */
	public function menu_image_init() {
		add_post_type_support( 'nav_menu_item', array( 'thumbnail' ) );
	}

	/**
	 * When menu item removed remove menu image metadata.
	 */
	public function menu_image_delete_menu_item_image_action() {

		$menu_item_id = (int) $_REQUEST[ 'menu-item' ];

		check_admin_referer( 'delete-menu_item_image_' . $menu_item_id );

		if ( is_nav_menu_item( $menu_item_id ) && has_post_thumbnail( $menu_item_id ) ) {
			delete_post_thumbnail( $menu_item_id );
			delete_post_meta( $menu_item_id, '_thumbnail_hover_id' );
			delete_post_meta( $menu_item_id, '_menu_item_image_size' );
			delete_post_meta( $menu_item_id, '_menu_item_image_title_position' );
		}
	}
	
	/**
	 * Update item thumbnail via ajax action.
	 *
	 */
	public function wp_ajax_set_menu_item_thumbnail() {
		$json = !empty( $_REQUEST[ 'json' ] );

		$post_ID = intval( $_POST[ 'post_id' ] );
		if ( !current_user_can( 'edit_post', $post_ID ) ) {
			wp_die( - 1 );
		}

		$thumbnail_id = intval( $_POST[ 'thumbnail_id' ] );
		$is_hovered   = (bool) $_POST[ 'is_hover' ];

		check_ajax_referer( "update-menu-item" );

		if ( $thumbnail_id == '-1' ) {
			if ( $is_hovered ) {
				$success = delete_post_meta( $post_ID, '_thumbnail_hover_id' );
			} else {
				$success = delete_post_thumbnail( $post_ID );
			}
		} else {
			if ( $is_hovered ) {
				$success = update_post_meta( $post_ID, '_thumbnail_hover_id', $thumbnail_id );
			} else {
				$success = set_post_thumbnail( $post_ID, $thumbnail_id );
			}
		}

		if ( $success ) {
			$return = $this->wp_post_thumbnail_only_html( $post_ID );
			$json ? wp_send_json_success( $return ) : wp_die( $return );
		}

		wp_die( 0 );
	}
	
	/**
	 * Output HTML for the menu item images.
	 *
	 *
	 * @param int $item_id The post ID or object associated with the thumbnail, defaults to global $post.
	 *
	 * @return string html
	 */
	public function wp_post_thumbnail_only_html( $item_id ) {
		$default_size = apply_filters( 'menu_image_default_size', 'full' );
		$markup       = '<p class="description" ><label>%s<br /><small>%s</small><br /><a title="%s" href="#" class="set-post-thumbnail button%s" data-item-id="%s" style="height: auto;">%s</a>%s</label></p>';

		$thumbnail_id = get_post_thumbnail_id( $item_id );
		$content      = sprintf(
			$markup,
			esc_html__( 'Custom Image/svg Icon', 'ave' ),
            esc_html__( 'Update homepage to see the icon changes.', 'ave' ),
			$thumbnail_id ? esc_attr__( 'Change menu item image/svg icon', 'ave' ) : esc_attr__( 'Set menu item image/svg icon', 'ave' ),
			'',
			$item_id,
			$thumbnail_id ? wp_get_attachment_image( $thumbnail_id, $default_size ) : esc_html__( 'Set image/svg icon', 'ave' ),
			$thumbnail_id ? '<a href="#" class="remove-post-thumbnail">' . esc_html__( 'Remove', 'ave' ) . '</a>' : ''
		);

		/*
		$hover_id = get_post_meta( $item_id, 'liquid_thumbnail_hover_id', true );
		$content .= sprintf(
			$markup,
			esc_html__( 'Image on hover', 'ave' ),
			$hover_id ? esc_attr__( 'Change menu item image on hover', 'ave' ) : esc_attr__( 'Set menu item image on hover', 'ave' ),
			' hover-image',
			$item_id,
			$hover_id ? wp_get_attachment_image( $hover_id, $default_size ) : esc_html__( 'Set image on hover', 'ave' ),
			$hover_id ? '<a href="#" class="remove-post-thumbnail hover-image">' . esc_html__( 'Remove', 'ave' ) . '</a>' : ''
		);
		*/

		return $content;
	}
	
	/**
	 * Output HTML for the menu item images section.
	 *
	 *
	 * @param int $item_id The post ID or object associated with the thumbnail, defaults to global $post.
	 *
	 * @return string html
	 */
	public function wp_post_thumbnail_html( $item_id ) {
		$default_size = apply_filters( 'menu_image_default_size', 'menu-36x36' );
		$content      = $this->wp_post_thumbnail_only_html( $item_id );

		$image_size = get_post_meta( $item_id, '_menu_item_image_size', true );
		if ( !$image_size ) {
			$image_size = $default_size;
		}
		$title_position = get_post_meta( $item_id, '_menu_item_image_title_position', true );
		if ( !$title_position ) {
			$title_position = apply_filters( 'menu_image_default_title_position', 'after' );
		}

		$content = "<div class='menu-item-images' style='min-height:70px'>$content</div>";

		/**
		 * Filter the admin menu item thumbnail HTML markup to return.
		 *
		 *
		 * @param string $content Admin menu item images HTML markup.
		 * @param int    $item_id Post ID.
		 */
		echo apply_filters( 'admin_menu_item_thumbnail_html', $content, $item_id );
	}


}
new Liquid_Menu_Item_Custom_Image;