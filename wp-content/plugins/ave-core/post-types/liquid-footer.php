<?php
/**
 * Post Type: Footer
 * Register Custom Post Type
 */
$labels = array(
	'name'                  => esc_html_x( 'Footers', 'Post Type General Name', 'ave-core' ),
	'singular_name'         => esc_html_x( 'Footer', 'Post Type Singular Name', 'ave-core' ),
	'menu_name'             => esc_html__( 'Footers', 'ave-core' ),
	'name_admin_bar'        => esc_html__( 'Footers', 'ave-core' ),
	'archives'              => esc_html__( 'Item Archives', 'ave-core' ),
	'parent_item_colon'     => esc_html__( 'Parent Item:', 'ave-core' ),
	'all_items'             => esc_html__( 'All Items', 'ave-core' ),
	'add_new_item'          => esc_html__( 'Add New Footer', 'ave-core' ),
	'add_new'               => esc_html__( 'Add New', 'ave-core' ),
	'new_item'              => esc_html__( 'New Footer', 'ave-core' ),
	'edit_item'             => esc_html__( 'Edit Footer', 'ave-core' ),
	'update_item'           => esc_html__( 'Update Footer', 'ave-core' ),
	'view_item'             => esc_html__( 'View Footer', 'ave-core' ),
	'search_items'          => esc_html__( 'Search Footer', 'ave-core' ),
	'not_found'             => esc_html__( 'Not found', 'ave-core' ),
	'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'ave-core' ),
	'featured_image'        => esc_html__( 'Featured Image', 'ave-core' ),
	'set_featured_image'    => esc_html__( 'Set featured image', 'ave-core' ),
	'remove_featured_image' => esc_html__( 'Remove featured image', 'ave-core' ),
	'use_featured_image'    => esc_html__( 'Use as featured image', 'ave-core' ),
	'insert_into_item'      => esc_html__( 'Insert into item', 'ave-core' ),
	'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'ave-core' ),
	'items_list'            => esc_html__( 'Items list', 'ave-core' ),
	'items_list_navigation' => esc_html__( 'Items list navigation', 'ave-core' ),
	'filter_items_list'     => esc_html__( 'Filter items list', 'ave-core' ),
);
$args = array(
	'label'                 => esc_html__( 'Footer', 'ave-core' ),
	'labels'        => $labels,
	'supports'              => array( 'title', 'editor', 'revisions', ),
	'hierarchical'          => false,
	'public'                => true,
	'show_ui'       => true,
	'show_in_menu'          => true,
	'menu_position'         => 25,
	'menu_icon'     => 'dashicons-align-center',	
	'show_in_admin_bar'     => true,
	'show_in_nav_menus'     => false,
	'can_export'            => true,
	'has_archive'   => false,
	'exclude_from_search'   => true,
	'publicly_queryable'    => false,
	'rewrite'               => false,
	'capability_type'       => 'page',
);
register_post_type( 'liquid-footer', $args );
