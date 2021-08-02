<?php
/**
* Liquid Themes Theme Framework
* The Liquid_Mega_Menu_Manager class
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

// Load front-end menu walker
require_once( get_template_directory() . '/liquid/extensions/mega-menu/liquid-mega-menu-walker.php' );
require_once( get_template_directory() . '/liquid/extensions/mega-menu/liquid-mega-menu-icons.php' );
require_once( get_template_directory() . '/liquid/extensions/mega-menu/liquid-mega-menu-custom-icon.php' );

class Liquid_Mega_Menu_Manager extends Liquid_Base {

	function __construct() {

		// Custom Fields - Add
		$this->add_filter( 'wp_setup_nav_menu_item',  'setup_nav_menu_item' );

		// Custom Fields - Save
		$this->add_action( 'wp_update_nav_menu_item', 'update_nav_menu_item', 100, 3 );

		// Custom Walker - Edit
		$this->add_filter( 'wp_edit_nav_menu_walker', 'edit_nav_menu_walker', 100, 2 );
	}

	// Custom Fields - Add
    function setup_nav_menu_item( $menu_item ) {

		$menu_item->liquid_megaprofile = get_post_meta( $menu_item->ID, '_menu_item_liquid_megaprofile', true );
		$menu_item->liquid_submenu_color = get_post_meta( $menu_item->ID, '_menu_item_liquid_submenu_color', true );
		$menu_item->liquid_icon = get_post_meta( $menu_item->ID, '_menu_item_liquid_icon', true );
		$menu_item->liquid_icon_position = get_post_meta( $menu_item->ID, '_menu_item_liquid_icon_position', true );
		$menu_item->liquid_badge = get_post_meta( $menu_item->ID, '_menu_item_liquid_badge', true );
		$menu_item->liquid_heading_item = get_post_meta( $menu_item->ID, '_menu_item_liquid_heading_item', true );

        return $menu_item;
    }

	// Custom Fields - Save
	function update_nav_menu_item( $menu_id, $menu_item_db_id, $menu_item_data ) {

		if ( isset( $_REQUEST['menu-item-liquid-megaprofile'][$menu_item_db_id]) ) {
			update_post_meta($menu_item_db_id, '_menu_item_liquid_megaprofile', $_REQUEST['menu-item-liquid-megaprofile'][$menu_item_db_id]);
		}

		if ( isset( $_REQUEST['menu-item-liquid-submenu-color'][$menu_item_db_id]) ) {
			update_post_meta($menu_item_db_id, '_menu_item_liquid_submenu_color', $_REQUEST['menu-item-liquid-submenu-color'][$menu_item_db_id]);
		}

		if ( isset( $_REQUEST['menu-item-liquid-icon'][$menu_item_db_id]) ) {
			update_post_meta($menu_item_db_id, '_menu_item_liquid_icon', $_REQUEST['menu-item-liquid-icon'][$menu_item_db_id]);
		}
		
		if ( isset( $_REQUEST['menu-item-liquid-icon-position'][$menu_item_db_id]) ) {
			update_post_meta($menu_item_db_id, '_menu_item_liquid_icon_position', $_REQUEST['menu-item-liquid-icon-position'][$menu_item_db_id]);
		}

		if ( isset( $_REQUEST['menu-item-liquid-badge'][$menu_item_db_id] ) ) {
			update_post_meta($menu_item_db_id, '_menu_item_liquid_badge', $_REQUEST['menu-item-liquid-badge'][$menu_item_db_id]);
		}
		
		if ( isset( $_REQUEST['menu-item-liquid-heading-item'][$menu_item_db_id]) ) {
			update_post_meta($menu_item_db_id, '_menu_item_liquid_heading_item', $_REQUEST['menu-item-liquid-heading-item'][$menu_item_db_id]);
		}
		
	}

	// Custom Backend Walker - Edit
	function edit_nav_menu_walker( $walker, $menu_id ) {

		if ( ! class_exists( 'Liquid_Mega_Menu_Edit_Walker' ) ) {
			require_once( get_template_directory() . '/liquid/extensions/mega-menu/liquid-mega-menu-edit.php' );
		}

		return 'Liquid_Mega_Menu_Edit_Walker';
	}
}
new Liquid_Mega_Menu_Manager;
