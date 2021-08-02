<?php

/**
* Shortcode Portfolio Listing
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_PortfolioListing extends LD_Shortcode {
	
	/**
	 * [$post_type description]
	 * @var string
	 */
	private $post_type = 'liquid-portfolio';

	/**
	 * [$taxonomies description]
	 * @var array
	 */
	private $taxonomies = array( 'liquid-portfolio-category' );
	
	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_portfolio_listing';
		$this->title       = esc_html__( 'Portfolio', 'ave-core' );
		$this->description = esc_html__( 'Add portfolio items', 'ave-core' );
		$this->icon        = 'fa fa-folder';
		$this->scripts     = array( 'packery-mode', 'flickity', 'jquery-fresco' );
		$this->styles      = array( 'flickity', 'fresco' );

		require_once vc_path_dir( 'CONFIG_DIR', 'grids/vc-grids-functions.php' );
		if ( 'vc_get_autocomplete_suggestion' === vc_request_param( 'action' ) || 'vc_edit_form' === vc_post_param( 'action' ) ) {
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_callback', array( $this, 'include_field_search' ) ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_render', 'vc_include_field_render' ); // Render exact product. Must return an array (label,value)

			// Narrow data taxonomies
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_callback', array( $this,'autocomplete_taxonomies_field_search' ) );
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_render', array( $this, 'render_autocomplete_field' ) );

			// Filter Cats
			add_filter( 'vc_autocomplete_'. $this->slug . '_filter_cats_callback', array( $this,'autocomplete_taxonomies_field_search' ) );
			add_filter( 'vc_autocomplete_'. $this->slug . '_filter_cats_render', array( $this, 'render_autocomplete_field' ) );

			// Narrow data taxonomies for exclude_filter
			add_filter( 'vc_autocomplete_'. $this->slug . '_exclude_callback', array( $this, 'exclude_field_search' ) ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_exclude_render', 'vc_exclude_field_render' ); // Render exact product. Must return an array (label,value)
		}

		parent::__construct();
	}
	
	protected function get_post_type_list() {

		$postTypesList[] = array(
			$this->post_type,
			esc_html__( 'Posts', 'ave-core' ),
		);
		$postTypesList[] = array(
			'custom',
			esc_html__( 'Custom query', 'ave-core' ),
		);
		$postTypesList[] = array(
			'ids',
			esc_html__( 'List of IDs', 'ave-core' ),
		);

		return $postTypesList;
	}

	public function get_params() { 

		$url = liquid_addons()->plugin_uri() . '/assets/img/sc-preview/portfolio/';
		
		$button = vc_map_integrate_shortcode( 'ld_button', 'ib_', esc_html__( 'Button', 'ave-core' ),
			array(
				'exclude' => array(
					'el_id',
					'el_class',
					'sh_shadowbox',
					'enable_row_shadowbox',
					'button_box_shadow',
					'hover_button_box_shadow',
					'enable_icon_shadowbox',
					'icon_box_shadow'
				),
			),
			array(
				'element' => 'show_button',
				'value' => 'yes',
			)
		);
		
		$general = array(
	
			array(
				'type'       => 'select_preview',
				'param_name' => 'style',
				'heading'    => esc_html__( 'Style', 'ave-core' ),
				'value'      => array(
					array(
						'value' => 'metro',
						'label' => esc_html__( 'Metro', 'ave-core' ),
						'image' => $url . 'metro.jpg'
					),
					array(
						'label' => esc_html__( 'Masonry Classic', 'ave-core' ),
						'value' => 'masonry-classic',
						'image' => $url . 'masonry-classic.jpg'
					),
					array(
						'label' => esc_html__( 'Masonry Creative', 'ave-core' ),
						'value' => 'masonry-creative',
						'image' => $url . 'masonry-creative.jpg'
					),
					array(
						'label' => esc_html__( 'Carousel', 'ave-core' ),
						'value' => 'carousel',
						'image' => $url . 'carousel.jpg'
					),
					array(
						'label' => esc_html__( 'Grid', 'ave-core' ),
						'value' => 'grid',
						'image' => $url . 'grid.jpg'
					),
					array(
						'label' => esc_html__( 'Grid Alt', 'ave-core' ),
						'value' => 'grid-alt',
						'image' => $url . 'grid-alt.jpg'
					),
					array(
						'label' => esc_html__( 'Grid Caption', 'ave-core' ),
						'value' => 'grid-caption',
						'image' => $url . 'grid-caption.jpg'
					),
					array(
						'label' => esc_html__( 'Grid Hover Alt', 'ave-core' ),
						'value' => 'grid-hover-alt',
						'image' => $url . 'grid-hover-alt.jpg'
					),
					array(
						'label' => esc_html__( 'Grid Hover 3D', 'ave-core' ),
						'value' => 'grid-hover-3d',
						'image' => $url . 'grid-hover-3d.jpg'
					),
					array(
						'label' => esc_html__( 'Grid Hover Overlay', 'ave-core' ),
						'value' => 'grid-hover-overlay',
						'image' => $url . 'grid-hover-overlay.jpg'
					),
					array(
						'label' => esc_html__( 'Packery', 'ave-core' ),
						'value' => 'packery',
						'image' => $url . 'packery.jpg'
					),
					array(
						'label' => esc_html__( 'Packery 2', 'ave-core' ),
						'value' => 'packery-2',
						'image' => $url . 'packery-2.jpg'
					),
					array(
						'label' => esc_html__( 'Packery 3', 'ave-core' ),
						'value' => 'packery-3',
						'image' => $url . 'packery-3.jpg'
					),
					array(
						'label' => esc_html__( 'Vertical Overlay', 'ave-core' ),
						'value' => 'vertical-overlay',
						'image' => $url . 'vertical-overlay.jpg'
					),
				),
				'description' => esc_html__( 'Select content type for your grid.', 'ave-core' ),
				'admin_label' => true,
				'save_always' => true,
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'horizontal_alignment',
				'heading'     => esc_html__( 'Horizontal Alignment', 'ave-core' ),
				'description' => esc_html__( 'Content horizontal alignment', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Left', 'ave-core' )    => 'pf-details-h-str',
					esc_html__( 'Center', 'ave-core' )  => 'pf-details-h-mid',
					esc_html__( 'Right', 'ave-core' )   => 'pf-details-h-end',
				),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 'grid-alt' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'vertical_alignment',
				'heading'     => esc_html__( 'Vertical Alignment', 'ave-core' ),
				'description' => esc_html__( 'Content vertical alignment', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Top', 'ave-core' )     => 'pf-details-v-str',
					esc_html__( 'Middle', 'ave-core' )  => 'pf-details-v-mid',
					esc_html__( 'Bottom', 'ave-core' )  => 'pf-details-v-end',
				),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 'grid-alt' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'grid_columns',
				'heading'    => esc_html__( 'Columns', 'ave-core' ),
				'value'      => array(
					'1 Column' => '1',
					'2 Columns' => '2',
					'3 Columns' => '3',
					'4 Columns' => '4',
					'6 Columns' => '6',
				),
				'std' => '3',
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 
						'grid', 
						'grid-alt',
						'grid-caption', 
						'grid-hover-3d', 
						'grid-hover-alt',
						'grid-hover-overlay', 
						'masonry-creative', 
						'masonry-classic' 
					),
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'columns_gap',
				'heading'     => esc_html__( 'Columns gap', 'ave-core' ),
				'description' => esc_html__( 'Select gap between columns in row.', 'ave-core' ),
				'min'         => 0,
				'max'         => 35,
				'step'        => 1,
				'std'         => 15,
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 'carousel', 'vertical-overlay' ),
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'bottom_gap',
				'heading'     => esc_html__( 'Bottom Gap', 'ave-core' ),
				'description' => esc_html__( 'Bottom gap for portfolio items', 'ave-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 30,
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 'carousel', 'vertical-overlay' ),
				),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'post_type',
				'heading'     => esc_html__( 'Data source', 'ave-core' ),
				'description' => esc_html__( 'Select content type for your grid.', 'ave-core' ),
				'value'       => $this->get_post_type_list(),
				'save_always' => true,
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'posts_per_page',
				'heading'     => esc_html__( 'Total items', 'ave-core' ),
				'description' => esc_html__( 'Set max limit or enter -1 to display all (limited to 1000).', 'ave-core' ),
				'value'       => 10,
				// default value
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
				'param_holder_class' => 'vc_not-for-custom',
				'edit_field_class'   => 'vc_col-sm-6'
			),
			array(
				'type'        => 'autocomplete',
				'param_name'  => 'include',
				'heading'     => esc_html__( 'Include only', 'ave-core' ),
				'description' => esc_html__( 'Add posts, etc. by title.', 'ave-core' ),
				'settings'    => array(
					'multiple' => true,
					'sortable' => true,
					'groups'   => true,
					'no_hide'  => true, // In UI after select doesn't hide an select list
				),
				'dependency' => array(
					'element' => 'post_type',
					'value'   => array( 'ids' )
				)
			),
			// Custom query tab
			array(
				'type'        => 'textarea_safe',
				'param_name'  => 'custom_query',
				'heading'     => esc_html__( 'Custom query', 'ave-core' ),
				'description' => __( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts">WordPress Codex</a>.', 'ave-core' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value'   => array( 'custom' )
				)
			),
			array(
				'type'        => 'autocomplete',
				'param_name'  => 'taxonomies',
				'heading'     => esc_html__( 'Narrow data source', 'ave-core' ),
				'description' => esc_html__( 'Enter categories, tags or custom taxonomies.', 'ave-core' ),
				'settings'    => array(
					'multiple'       => true,
					'min_length'     => 1,
					'groups'         => true,
					'no_hide'        => true, // In UI after select doesn't hide an select list
					'unique_values'  => true,
					'display_inline' => true,
					'delay'          => 500,
					'auto_focus'     => true,
				),
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom'
					)
				),
				'param_holder_class' => 'vc_not-for-custom',
			),
			array(
				'type'             => 'checkbox',
				'param_name'       => 'enable_item_animation',
				'value'            => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'heading'          => esc_html__( 'Animate Portfolio Items?', 'ave-core' ),
				'description'      => esc_html__( 'Will enable animation for items, it will be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'ave-core' ),
			),

			//Title Typo options
			array(
				'type'        => 'subheading',
				'param_name'  => 'show_title_typo',
				'heading'     => esc_html__( 'Title Typography', 'ave-core' ),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'title_size',
				'heading'     => esc_html__( 'Title Size', 'ave-core' ),
				'description' => esc_html__( 'Add size in pixels/em e.g 15px', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'title_weight',
				'heading'     => esc_html__( 'Title Weight', 'ave-core' ),
				'description' => esc_html__( 'Add title weight', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),

			array(
				'type'        => 'colorpicker',
				'param_name'  => 'title_color',
				'heading'     => esc_html__( 'Title Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),

			//Buttons options
			array(
				'type'        => 'checkbox',
				'param_name'  => 'enable_btn',
				'heading'     => esc_html__( 'Show Button?', 'ave-core' ),
				'value'       => array( esc_html__( 'Yes', 'ave-core' ) => 'yes' ),
				'dependency'  => array(
					'element' => 'style',
					'value'   => 'masonry-classic',
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'btn_text',
				'heading'     => esc_html__( 'Button Label', 'ave-core' ),
				'description' => esc_html__( 'Add button text', 'ave-core' ),
				'dependency'  => array(
					'element' => 'enable_btn',
					'value'   => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'colorpicker',
				'param_name'  => 'btn_color',
				'heading'     => esc_html__( 'Label Color', 'ave-core' ),
				'dependency' => array(
					'element' => 'enable_btn',
					'value'   => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),			
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_postformat',
				'heading'     => esc_html__( 'Disable Post Formats?', 'ave-core' ),
				'description' => esc_html__( 'If yes will show only featured images of the post, will ignore post formats', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => 'yes',
					esc_html__( 'No', 'ave-core' )  => '',
				),
				'dependency' => array(
					'element' => 'item_style',
					'value' => array(
						'list',
						'shadow',
						'outline',
						'caption-fixed'
					)
				),
				'std'        => 'yes',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'enable_ext',
				'heading'     => esc_html__( 'Enable External links', 'ave-core' ),
				'description' => esc_html__( 'External link will be apllied to the portfolio item "Detail Button"', 'ave-core' ),
				'value'       => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'show_filter',
				'heading'     => esc_html__( 'Enable filter?', 'ave-core' ),
				'description' => esc_html__( 'Will enable portfolio categories filter', 'ave-core' ),
				'value'       => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'enable_gallery',
				'heading'     => esc_html__( 'Enable Gallery?', 'ave-core' ),
				'description' => esc_html__( 'Lightbox gallery of the featured images', 'ave-core' ),
				'value'       => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'listing-lightbox-gallery',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'dropdown',
				'param_name'  => 'enable_parallax',
				'heading'     => esc_html__( 'Enable parallax?', 'ave-core' ),
				'description' => esc_html__( 'Parallax for images', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Yes', 'ave-core' ) => '',
					esc_html__( 'No', 'ave-core' )  => 'no'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'pagination',
				'heading' => esc_html__( 'Pagination', 'ave-core' ),
				'description' => esc_html__( 'Select yes to show pagination.', 'ave-core' ),
				'value' => array(
					esc_html__( 'None', 'ave-core' )        => 'none',
					esc_html__( 'Ajax', 'ave-core' )        => 'ajax',
					esc_html__( 'Pagination', 'ave-core' )  => 'pagination',
				),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 'carousel' ),
				),
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'ajax_trigger',
				'heading' => esc_html__( 'Ajax Trigger', 'ave-core' ),
				'description' => esc_html__( 'Select a trigger for ajax load', 'ave-core' ),
				'value' => array(
					esc_html__( 'Inview', 'ave-core' )  => 'inview',
					esc_html__( 'Click', 'ave-core' )   => 'click',
				),
				'dependency' => array(
					'element' => 'pagination',
					'value'   => 'ajax',	
				),
			),
			array(
				'type' => 'el_id',
				'param_name' => 'filter_id',
				'settings' => array(
					'auto_generate' => true,
				),
				'heading'     => esc_html__( 'Filter ID', 'ave-core' ),
				'description' =>  wp_kses_post( __( 'Enter Filter ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'ave-core' ) ),
			),
			array(
				'type' => 'el_id',
				'settings' => array(
					'auto_generate' => true,
				),
				'heading'     => esc_html__( 'Unique ID', 'ave-core' ),
				'param_name'  => 'unique_id',
				'description' => esc_html__( 'Unique ID need for ajax load more posts functionality', 'ave-core' ),
				'group'       => esc_html__( 'Extras', 'ave-core' ),
			),
			// ID
			array(
				'type'        => 'textfield',
				'param_name'  => 'el_id',
				'heading'     => esc_html__( 'Element ID', 'ave-core' ),
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add unique id and then refer to it in your css file.', 'ave-core' ),
			),
			// CSS
			array(
				'type'        => 'textfield',
				'param_name'  => 'el_class',
				'heading'     => esc_html__( 'Extra class name', 'ave-core' ),
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ave-core' ),
			)

		);
		
		$filter = array(
			
			array(
				'type'        => 'autocomplete',
				'param_name'  => 'filter_cats',
				'heading'     => esc_html__( 'Categories', 'ave-core' ),
				'description' => esc_html__( 'Enter categories to display in filter bar.', 'ave-core' ),
				'settings'    => array(
					'multiple'      => true,
					'min_length'    => 1,
					'groups'        => true,
					'sortable'      => true,
					'no_hide'       => true, // In UI after select doesn't hide an select list
					'unique_values' => true,
					'delay'         => 500,
					'auto_focus'    => true,
				),
				'param_holder_class' => 'vc_not-for-custom',

			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'filter_normal_color',
				'heading'     => esc_html__( 'Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the filter items', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4'				
			),
			array(
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true,
				'param_name'  => 'filter_hover_color',
				'heading'     => esc_html__( 'Hover/Active color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the filter hover/active item', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4'				
			),
			array(
				'type'        => 'liquid_colorpicker',
				'param_name'  => 'filter_dec_color',
				'heading'     => esc_html__( 'Decoration color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the filter decoration/lines/borders item', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4'				
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'filter_lbl_all',
				'heading'     => esc_html__( 'Label "All"', 'ave-core' ),
				'value'       => esc_html__( 'All', 'ave-core' ),
				'save_always' => true,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_color',
				'heading'     => esc_html__( 'Color Scheme', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' )  => '',
					esc_html__( 'Light', 'ave-core' )    => 'filter-list-scheme-light'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_size',
				'heading'     => esc_html__( 'Font size', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' ) => '',
					esc_html__( 'Small', 'ave-core' )   => 'size-sm',
					esc_html__( 'Medium', 'ave-core' )  => 'size-md',
					esc_html__( 'Large', 'ave-core' )   => 'size-lg',
					esc_html__( 'Custom', 'ave-core' ) => 'size-custom',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'custom_filter_size',
				'heading'     => esc_html__( 'Custom Font size', 'ave-core' ),
				'description' => esc_html__( 'Add custom font size with px. ex 24px', 'ave-core' ),
				'dependency' => array(
					'element' => 'filter_size',
					'value'   => 'size-custom',	
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_decoration',
				'heading'     => esc_html__( 'Font Decoration', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' )     => '',
					esc_html__( 'Underline', 'ave-core' )   => 'filters-underline',
					esc_html__( 'Linethrough', 'ave-core' ) => 'filters-line-through',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'filter_underline_height',
				'heading'     => esc_html__( 'Height for underline element', 'ave-core' ),
				'description' => esc_html__( 'Add height with px. ex 24px', 'ave-core' ),
				'dependency' => array(
					'element' => 'filter_decoration',
					'value'   => 'filters-underline',	
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_transformation',
				'heading'     => esc_html__( 'Font Transformation', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' )    => '',
					esc_html__( 'Uppercase', 'ave-core' )  => 'text-uppercase ltr-sp-1',
					esc_html__( 'Capitalize', 'ave-core' ) => 'text-capitalize',
					esc_html__( 'Lowercase', 'ave-core' )  => 'text-lowercase',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_align',
				'heading'     => esc_html__( 'Filter Alignment', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Center', 'ave-core' ) => 'justify-content-center',
					esc_html__( 'Left', 'ave-core' )  => 'justify-content-start',
					esc_html__( 'Right', 'ave-core' )  => 'justify-content-end',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'filter_mb',
				'heading'     => esc_html__( 'Filter Margin Bottom', 'ave-core' ),
				'description' => esc_html__( 'Add bottom margin to the filter', 'ave-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 50
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_weight',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' )   => '',
					esc_html__( 'Light', 'ave-core' )     => 'font-weight-light',
					esc_html__( 'Normal', 'ave-core' )    => 'font-weight-normal',
					esc_html__( 'Medium', 'ave-core' )    => 'font-weight-medium',
					esc_html__( 'Semi Bold', 'ave-core' ) => 'font-weight-semibold',
					esc_html__( 'Bold', 'ave-core' )      => 'font-weight-bold',
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			//Filter Title options
			array(
				'type'       => 'subheading',
				'param_name' => 'ft_options',
				'heading'    => esc_html__( 'Filter Title', 'ave-core' ),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'filter_title',
				'heading'    => esc_html__( 'Filter title', 'ave-core' ),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'tag_to_inherite',
				'heading'     => esc_html__( 'Style to inherite', 'ave-core' ),
				'description' => esc_html__( 'Select tag you want to inherite style defined in theme options', 'ave-core' ),
				'value'       => array(
					esc_html__( 'None', 'ave-core' ) => '',
					esc_html__( 'h1', 'ave-core' )   => 'h1 mt-0',
					esc_html__( 'h2', 'ave-core' )   => 'h2 mt-0',
					esc_html__( 'h3', 'ave-core' )   => 'h3 mt-0',
					esc_html__( 'h4', 'ave-core' )   => 'h4 mt-0',
					esc_html__( 'h5', 'ave-core' )   => 'h5 mt-0',
					esc_html__( 'h6', 'ave-core' )   => 'h6 mt-0',
				),
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_title_size',
				'heading'     => esc_html__( 'Font size', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' )                  => '',
					esc_html__( 'Medium - 18px', 'ave-core' )            => 'size-md',
					esc_html__( 'Large - 24px', 'ave-core' )             => 'size-lg',
					esc_html__( 'Extra Large - 55px', 'ave-core' )       => 'size-xl',
					esc_html__( 'Extra Extra Large - 72px', 'ave-core' ) => 'size-xxl',
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_title_weight',
				'heading'     => esc_html__( 'Font Weight', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' )   => '',
					esc_html__( 'Light', 'ave-core' )     => 'font-weight-light',
					esc_html__( 'Normal', 'ave-core' )    => 'font-weight-normal',
					esc_html__( 'Medium', 'ave-core' )    => 'font-weight-medium',
					esc_html__( 'Semi Bold', 'ave-core' ) => 'font-weight-semibold',
					esc_html__( 'Bold', 'ave-core' )      => 'font-weight-bold',
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'filter_title_transformation',
				'heading'     => esc_html__( 'Font Transformation', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Default', 'ave-core' )    => '',
					esc_html__( 'Uppercase', 'ave-core' )  => 'text-uppercase',
					esc_html__( 'Capitalize', 'ave-core' ) => 'text-capitalize',
					esc_html__( 'Lowercase', 'ave-core' )  => 'text-lowercase',
				),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_button',
				'heading'    => esc_html__( 'Show Button', 'ave-core' ),
				'value'      => array(
					esc_html__( 'No', 'ave-core' )  => '',
					esc_html__( 'Yes', 'ave-core' ) => 'yes'
				),
			),
			

		);

		foreach( $filter as &$param ) {
			$param['group'] = esc_html__( 'Filter', 'ave-core' );
			if( !isset( $param['dependency'] ) ) {
				$param['dependency'] = array(
					'element' => 'show_filter',
					'value' => array( 'yes' )
				);
			}
		}
		
		$data = array(
			array(
				'type'        => 'dropdown',
				'param_name'  => 'orderby',
				'heading'     => esc_html__( 'Order by', 'ave-core' ),
				'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Date', 'ave-core' )                  => 'date',
					esc_html__( 'Order by post ID', 'ave-core' )      => 'ID',
					esc_html__( 'Author', 'ave-core' )                => 'author',
					esc_html__( 'Title', 'ave-core' )                 => 'title',
					esc_html__( 'Last modified date', 'ave-core' )    => 'modified',
					esc_html__( 'Post/page parent ID', 'ave-core' )   => 'parent',
					esc_html__( 'Number of comments', 'ave-core' )    => 'comment_count',
					esc_html__( 'Menu order/Page Order', 'ave-core' ) => 'menu_order',
					esc_html__( 'Meta value', 'ave-core' )            => 'meta_value',
					esc_html__( 'Meta value number', 'ave-core' )     => 'meta_value_num',
					esc_html__( 'Random order', 'ave-core' )          => 'rand',
				),
				'group'       => esc_html__( 'Data Settings', 'ave-core' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom'
					)
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'order',
				'heading'     => esc_html__( 'Sort order', 'ave-core' ),
				'description' => esc_html__( 'Select sorting order.', 'ave-core' ),
				'group'       => esc_html__( 'Data Settings', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Descending', 'ave-core' ) => 'DESC',
					esc_html__( 'Ascending', 'ave-core' )  => 'ASC',
				),
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					)
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'meta_key',
				'heading'     => esc_html__( 'Meta key', 'ave-core' ),
				'description' => esc_html__( 'Input meta key for grid ordering.', 'ave-core' ),
				'group'       => esc_html__( 'Data Settings', 'ave-core' ),
				'dependency'  => array(
					'element' => 'orderby',
					'value'   => array(
						'meta_value',
						'meta_value_num',
					)
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
			),
			array(
				'type'        => 'autocomplete',
				'param_name'  => 'exclude',
				'heading'     => esc_html__( 'Exclude', 'ave-core' ),
				'description' => esc_html__( 'Exclude posts, etc. by title.', 'ave-core' ),
				'group'       => esc_html__( 'Data Settings', 'ave-core' ),
				'settings'    => array(
					'multiple' => true,
					'no_hide'  => true, // In UI after select doesn't hide an select list
				),
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
					'callback' => 'vc_grid_exclude_dependency_callback'
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
			)

		);

		$design = array(

			array(
				'type'       => 'liquid_colorpicker',
				'param_name' => 'color_primary',
				'heading'    => esc_html__( 'Background Color', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array(
						'slider'
					),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'color_type',
				'heading'    => esc_html__( 'Text Color', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Default', 'ave-core' )   => '',
					esc_html__( 'Light', 'ave-core' )     => 'ld-pf-light',
					esc_html__( 'Light Alt', 'ave-core' ) => 'ld-pf-light ld-pf-light-alt',
					esc_html__( 'Dark', 'ave-core' )      => 'ld-pf-dark',
					esc_html__( 'Dark Alt', 'ave-core' )  => 'ld-pf-dark ld-pf-dark-alt',
				),
				'edit_field_class' => 'vc_col-sm-6 clearfix'
			),

		);

		foreach( $design as &$param ) {
			$param['group'] = esc_html__( 'Design Options', 'ave-core' );
		}
		
		$pf_animation = array(

			//Custom Animation Options
			array(
				'type'        => 'textfield',
				'param_name'  => 'pf_duration',
				'heading'     => esc_html__( 'Duration', 'ave-core' ),
				'description' => esc_html__( 'Add duration of the animation in milliseconds', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
			),
			array(
				'type' => 'textfield',
				'param_name' => 'pf_start_delay',
				'heading' => esc_html__( 'Start Delay', 'ave-core' ),
				'description' => esc_html__( 'Add start delay of the animation in milliseconds', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'param_name' => 'pf_delay',
				'heading' => esc_html__( 'Delay', 'ave-core' ),
				'description' => esc_html__( 'Add delay of the animation between of the animated elements in milliseconds', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'pf_easing',
				'heading' => esc_html__( 'Easing', 'ave-core' ),
				'description' => esc_html__( 'Select an easing type', 'ave-core' ),
				'value' => array(
					'linear',
					'easeInQuad',
					'easeInCubic',
					'easeInQuart',
					'easeInQuint',
					'easeInSine',
					'easeInExpo',
					'easeInCirc',
					'easeInBack',
					'easeOutQuad',
					'easeOutCubic',
					'easeOutQuart',
					'easeOutQuint',
					'easeOutSine',
					'easeOutExpo',
					'easeOutCirc',
					'easeOutBack',
					'easeInOutQuad',
					'easeInOutCubic',
					'easeInOutQuart',
					'easeInOutQuint',
					'easeInOutSine',
					'easeInOutExpo',
					'easeInOutCirc',
					'easeInOutBack',
				),
				'std' => 'easeOutQuint',
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'subheading',
				'param_name'  => 'pf_init_values',
				'heading'     => esc_html__( 'Animate From', 'ave-core' ),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_translate_x',
				'heading'     => esc_html__( 'Translate X', 'ave-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_translate_y',
				'heading'     => esc_html__( 'Translate Y', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_translate_z',
				'heading'     => esc_html__( 'Translate Z', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_scale_x',
				'heading'     => esc_html__( 'Scale X', 'ave-core' ),
				'description' => esc_html__( 'Select Scale X', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_scale_y',
				'heading'     => esc_html__( 'Scale Y', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Y', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_scale_z',
				'heading'     => esc_html__( 'Scale Z', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Z', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_rotate_x',
				'heading'     => esc_html__( 'Rotate X', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_rotate_y',
				'heading'     => esc_html__( 'Rotate Y', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_rotate_z',
				'heading'     => esc_html__( 'Rotate Z', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_init_opacity',
				'heading'     => esc_html__( 'Opacity', 'ave-core' ),
				'description' => esc_html__( 'Set opacity', 'ave-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
			),
			//Animation Values
			array(
				'type'        => 'subheading',
				'param_name'  => 'pf_animations_values',
				'heading'     => esc_html__( 'Animate To', 'ave-core' ),
			),			
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_translate_x',
				'heading'     => esc_html__( 'Translate X', 'ave-core' ),
				'description' => esc_html__( 'Select translate on X axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_translate_y',
				'heading'     => esc_html__( 'Translate Y', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Y axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_translate_z',
				'heading'     => esc_html__( 'Translate Z', 'ave-core' ),
				'description' => esc_html__( 'Select translate on Z axe', 'ave-core' ),
				'min'         => -500,
				'max'         => 500,
				'step'        => 1,
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_scale_x',
				'heading'     => esc_html__( 'Scale X', 'ave-core' ),
				'description' => esc_html__( 'Select Scale X', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
	
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_scale_y',
				'heading'     => esc_html__( 'Scale Y', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Y', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_scale_z',
				'heading'     => esc_html__( 'Scale Z', 'ave-core' ),
				'description' => esc_html__( 'Select Scale Z', 'ave-core' ),
				'min'         => 0,
				'max'         => 10,
				'step'        => 0.25,
				'std'         => 1,
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_rotate_x',
				'heading'     => esc_html__( 'Rotate X', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on X axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_rotate_y',
				'heading'     => esc_html__( 'Rotate Y', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Y axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'ca_an_rotate_z',
				'heading'     => esc_html__( 'Rotate Z', 'ave-core' ),
				'description' => esc_html__( 'Select rotate degree on Z axe', 'ave-core' ),
				'min'         => -360,
				'max'         => 360,
				'step'        => 1,
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'pf_an_opacity',
				'heading'     => esc_html__( 'Opacity', 'ave-core' ),
				'description' => esc_html__( 'Set opacity', 'ave-core' ),
				'min'         => 0,
				'max'         => 1,
				'step'        => 0.1,
				'std'         => 1,
			),
		);
		
		foreach( $pf_animation as &$param ) {
			$param['group'] = esc_html__( 'Item Animation', 'ave-core' );
			$param['dependency']  = array(
						'element' => 'enable_item_animation',
						'value'   => 'yes',
					);
		}
		
		$this->params = array_merge( $general, $filter, $button, $data, $design, $pf_animation );

	}
	
	/**
	 * [before_output description]
	 * @method before_output
	 * @param  [type]        $atts    [description]
	 * @param  [type]        $content [description]
	 * @return [type]                 [description]
	 */
	public function before_output( $atts, &$content ) {


		if( 'carousel' === $atts['style'] ) {
			$atts['template'] = 'carousel';
		}
		elseif( 'vertical-overlay' === $atts['style'] ) {
			$atts['template'] = 'vertical-overlay';
		}

		return $atts;
	}
	
	// Entry Helper ------------------------------------------------

	protected function entry_title() {

		if( !$this->atts['show_title'] ) {
			return;
		}

		$sub_style = $this->atts['item_style'];

		// Default
		the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
	}
	
	protected function entry_subtitle( $before = '<p>', $after = '</p>' ) {
		
		$subtitle = get_post_meta( get_the_ID(), 'portfolio-subtitle', true );
		if( empty( $subtitle ) ) {
			return;
		}
		
		printf( '%1$s %2$s %3$s', $before, esc_html( $subtitle ), $after  );
	}
	
	protected function entry_read_more() {

		if( !$this->atts['show_link'] ) {
			return;
		}

		$link = '<a href="' . esc_url( get_permalink() ) . '" class="read-more">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 	viewBox="0 0 268.832 268.832" style="enable-background:new 0 0 268.832 268.832;"
						 xml:space="preserve">
						<g>
							<path d="M265.171,125.577l-80-80c-4.881-4.881-12.797-4.881-17.678,0c-4.882,4.882-4.882,12.796,0,17.678l58.661,58.661H12.5
								c-6.903,0-12.5,5.597-12.5,12.5c0,6.902,5.597,12.5,12.5,12.5h213.654l-58.659,58.661c-4.882,4.882-4.882,12.796,0,17.678
								c2.44,2.439,5.64,3.661,8.839,3.661s6.398-1.222,8.839-3.661l79.998-80C270.053,138.373,270.053,130.459,265.171,125.577z"/>
						</g>
					</svg>
				</a>';

		echo $link;
	}

	protected function entry_content() {

	?>
	    <div class="portfolio-summary">
	        <p><?php liquid_portfolio_the_excerpt(); ?></p>
	    </div>
	<?php
	}

	public function add_excerpt_hooks() {
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
	}

	public function remove_excerpt_hooks() {
		remove_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
		remove_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
	}

	public function excerpt_more() {
		return '';
	}

	public function excerpt_length() {
		return 10;
	}

	protected function entry_cats() {
		
		$style = $this->atts['style'];
		
		$terms = get_the_terms( get_the_ID(), $this->taxonomies[0] );
		$term = $terms[0];

		if( !isset( $term->name ) ) {
			return;
		}
		
		$out = '';
		
		if( 'carousel' === $style ) {
			$out = sprintf( '<span class="ld-pf-category-item font-style-italic" data-split-text="true" data-split-options=\'{ "type": "chars, words" }\' data-custom-animations="true" data-ca-options=\'{ "triggerHandler": "mouseenter", "triggerTarget": ".ld-pf-item", "triggerRelation": "closest", "offTriggerHandler": "mouseleave", "animationTarget": "all-childs", "duration": 170, "delay": 20, "offDuration": 100, "easing": "easeOutCirc", "initValues": { "translateY": 0, "opacity": 1 }, "animations": { "translateY": -10, "opacity": 0 } }\'>%s</span>', $term->name );
		
		}
		elseif( 'grid' === $style ){
			$out = sprintf( '<div class="ld-pf-category size-sm"><a href="%s" class="text-uppercase ltr-sp-1" data-split-text="true" data-split-options=\'{ "type": "lines" }\'>%s</a></div>', get_term_link( $term->slug, $this->taxonomies[0] ), $term->name );

		}
		elseif( 'packery' === $style ) {
			$out = sprintf( '<div class="ld-pf-category size-lg"><p data-split-text="true" data-split-options=\'{ "type": "words" }\'>%s</p></div>', $term->name  );
		} 
		elseif( 'grid-hover-3d' === $style ) {
			$out = sprintf( '<div class="ld-pf-category text-uppercase ltr-sp-1 size-sm"><a href="%s">%s</a></div>', get_term_link( $term->slug, $this->taxonomies[0] ), $term->name );
		}
		elseif( 'grid-hover-classic' === $style ) {
			$out = sprintf( '<div class="ld-pf-category size-sm text-uppercase ltr-sp-135" data-split-text="true" data-split-options=\'{ "type": "lines" }\'><a href="%s">%s</a></div>', get_term_link( $term->slug, $this->taxonomies[0] ), $term->name );
		}
		elseif( 'packery-2' === $style ) {
			$out = sprintf( '<div class="ld-pf-category size-md" data-split-text="true" data-split-options=\'{ "type": "lines" }\'><a href="%s">%s</a></div>', get_term_link( $term->slug, $this->taxonomies[0] ), $term->name );
		}
		else {
			$out = sprintf( '<div class="ld-pf-category size-md"><a href="%s">%s</a></div>', get_term_link( $term->slug, $this->taxonomies[0] ), $term->name );
		}

		echo $out;
			
/*
		if( !$this->atts['show_one_category'] ) {

			$cat = get_the_term_list( get_the_ID(), $this->taxonomies[0], '<ul class="category"><li>', '</li> <li>', '</li></ul>' );
			if( $cat ) { echo $cat; }

		} else {

			$terms = get_the_terms( get_the_ID(), $this->taxonomies[0] );
			$term = $terms[0];

			if( isset( $term ) ) {
				echo '<ul class="category"><li><a href="' . get_term_link( $term->slug, $this->taxonomies[0] ) . '">' . $term->name . '</a></li></ul>';
			}
		}
*/

	}
	
	protected function get_options() {

		extract( $this->atts );
		
		if( !$enable_item_animation ) {
			return;
		}
		
		$animation_opts = $this->get_animation_opts();

		$opts = $split_opts = array();
		$opts[] = 'data-custom-animations="true"';
		$opts[] = 'data-ca-options=\'' . stripslashes( wp_json_encode( $animation_opts ) ) . '\'';
	
		return join( ' ', $opts );

	}
	
	protected function get_animation_opts() {

		extract( $this->atts );
		
		$opts = $init_values = $animations_values = $arr = array();
		$opts['triggerHandler'] = 'inview';
		$opts['animationTarget'] = '.ld-pf-item';
		$opts['animateTargetsWhenVisible'] = 'true';
		$opts['duration'] = !empty( $pf_duration ) ? $pf_duration : 700;
		if( !empty( $pf_start_delay ) ) {
			$opts['startDelay'] = $pf_start_delay;
		}
		$opts['delay'] = !empty( $pf_delay ) ? $pf_delay : 100;
		$opts['easing'] = $pf_easing;
		
		//Init values
		if ( !empty( $pf_init_translate_x ) ) { $init_values['translateX'] = ( int ) $pf_init_translate_x; }
		if ( !empty( $pf_init_translate_y ) ) { $init_values['translateY'] = ( int ) $pf_init_translate_y; }
		if ( !empty( $pf_init_translate_z ) ) { $init_values['translateZ'] = ( int ) $pf_init_translate_z; }
	
		if ( '1' !== $pf_init_scale_x ) { $init_values['scaleX'] = ( float ) $pf_init_scale_x; }
		if ( '1' !== $pf_init_scale_y ) { $init_values['scaleY'] = ( float ) $pf_init_scale_y; }
		if ( '1' !== $pf_init_scale_z ) { $init_values['scaleZ'] = ( float ) $pf_init_scale_z; }
	
		if ( !empty( $pf_init_rotate_x ) ) { $init_values['rotateX'] = ( int ) $pf_init_rotate_x; }
		if ( !empty( $pf_init_rotate_y ) ) { $init_values['rotateY'] = ( int ) $pf_init_rotate_y; }
		if ( !empty( $pf_init_rotate_z ) ) { $init_values['rotateZ'] = ( int ) $pf_init_rotate_z; }
		
		if ( isset( $pf_init_opacity ) && '1' !== $pf_init_opacity ) { $init_values['opacity'] = ( float ) $pf_init_opacity; }
	
		//Animation values
		if ( !empty( $pf_init_translate_x ) ) { $animations_values['translateX'] = ( int ) $pf_an_translate_x; }
		if ( !empty( $pf_init_translate_y ) ) { $animations_values['translateY'] = ( int ) $pf_an_translate_y; }
		if ( !empty( $pf_init_translate_z ) ) { $animations_values['translateZ'] = ( int ) $pf_an_translate_z; }
	
		if ( isset( $pf_an_scale_x ) && '1' !== $pf_init_scale_x ) { $animations_values['scaleX'] = ( float ) $pf_an_scale_x; }
		if ( isset( $pf_an_scale_y ) && '1' !== $pf_init_scale_y ) { $animations_values['scaleY'] = ( float ) $pf_an_scale_y; }
		if ( isset( $pf_an_scale_z ) && '1' !== $pf_init_scale_z ) { $animations_values['scaleZ'] = ( float ) $pf_an_scale_z; }
	
		if ( !empty( $pf_init_rotate_x ) ) { $animations_values['rotateX'] = ( int ) $pf_an_rotate_x; }
		if ( !empty( $pf_init_rotate_y ) ) { $animations_values['rotateY'] = ( int ) $pf_an_rotate_y; }
		if ( !empty( $pf_init_rotate_z ) ) { $animations_values['rotateZ'] = ( int ) $pf_an_rotate_z; }
	
		if ( isset( $pf_an_opacity ) && '1' !== $pf_init_opacity ) { $animations_values['opacity'] = ( float ) $pf_an_opacity; }	

		$opts['initValues'] = !empty( $init_values ) ? $init_values : array( 'scale' => 1 );
		$opts['animations'] = !empty( $animations_values ) ? $animations_values : array( 'scale' => 1 );
		
		return $opts;
		
	}
	
	protected function get_button() {

		if ( empty( $this->atts['show_button'] ) ) {
			return;
		}

		$data = vc_map_integrate_parse_atts( $this->slug, 'ld_button', $this->atts, 'ib_' );
		if ( $data ) {

			$btn = visual_composer()->getShortCode( 'ld_button' )->shortcodeClass();

			if ( is_object( $btn ) ) {
				echo $btn->render( array_filter( $data ) );
			}
		}
	}
	
	protected function entry_button() {
		
		if ( empty( $this->atts['enable_btn'] ) ) {
			return;
		}
		
		$target = '';
		$ext_url   = get_post_meta( get_the_ID(), 'portfolio-website', true );
		$local_url = get_the_permalink();
		
		$enable_ext = $this->atts['enable_ext'];
		if( $enable_ext ) {
			$url = !empty( $ext_url ) ? esc_url( $ext_url ) : $local_url;
			$target = ' target="_blank"';
		}
		else {
			$url = esc_url( $local_url );	
		}
		
		$btn_text = !empty( $this->atts['btn_text'] ) ? esc_html( $this->atts['btn_text'] ) : esc_html__( 'Discover more', 'ave-core' );
		
		echo '<a href="' . $url . '" ' . $target . ' class="btn btn-xsm btn-naked text-uppercase font-weight-bold">
					<span>
						<span class="btn-txt">' . $btn_text . '</span>
					</span>
				</a>';		
	}
	
	// https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
	// check it
	protected function build_query() {

		extract( $this->atts );
		$settings = array();

		if( 'custom' === $post_type && ! empty( $custom_query ) ) {
			$query = html_entity_decode( vc_value_from_safe( $custom_query ), ENT_QUOTES, 'utf-8' );
			$settings = wp_parse_args( $query );
		}
		elseif( 'ids' === $post_type ) {

			if ( empty( $include ) ) {
				$include = - 1;
			}

			$incposts = wp_parse_id_list( $include );
			$settings = array(
				'post__in'       => $incposts,
				'posts_per_page' => count( $incposts ),
				'post_type'      => 'any',
				'orderby'        => 'post__in',
			);
		}
		else {

			$orderby = !empty( $_GET['orderby'] ) ? $_GET['orderby'] : $orderby;
			$order   = !empty( $_GET['order'] ) ? $_GET['order'] : $order;

			$settings = array(
				'posts_per_page' => isset( $posts_per_page ) ? (int) $posts_per_page : 100,
				'orderby'        => $orderby,
				'order'          => $order,
				'meta_key'       => in_array( $orderby, array(
					'meta_value',
					'meta_value_num',
				) ) ? $meta_key : '',
				'post_type'           => $post_type,
				'ignore_sticky_posts' => true,
			);

			if( $exclude ) {
				$settings['post__not_in'] = wp_parse_id_list( $exclude );
			}

			if( 'none' === $pagination ) {
				$settings['no_found_rows'] = true;
			}
			else {
				$settings['paged'] = ld_helper()->get_paged();
			}

			if ( $settings['posts_per_page'] < 1 ) {
				$settings['posts_per_page'] = 1000;
			}

			if ( ! empty( $taxonomies ) ) {
				$taxonomies = ld_helper()->terms_are_ids_or_slugs( $taxonomies, $this->taxonomies[0] );

				$terms = get_terms( $this->taxonomies, array(
					'hide_empty' => false,
					'include' => $taxonomies,
				) );
				$settings['tax_query'] = array();
				$tax_queries = array(); // List of taxnonimes
				foreach ( $terms as $t ) {
					if ( ! isset( $tax_queries[ $t->taxonomy ] ) ) {
						$tax_queries[ $t->taxonomy ] = array(
							'taxonomy' => $t->taxonomy,
							'field'    => 'id',
							'terms'    => array( $t->term_id ),
							'relation' => 'IN',
						);
					} else {
						$tax_queries[ $t->taxonomy ]['terms'][] = $t->term_id;
					}
				}
				$settings['tax_query'] = array_values( $tax_queries );
				$settings['tax_query']['relation'] = 'OR';
			}
		}

		return $settings;
	}
	
	protected function get_item_classes() {
		
		$style = $this->atts['style'];
		$item_classes = array();
		
		if( 'metro' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-light';			
			$item_classes[] = 'pf-details-inside';
			$item_classes[] = 'pf-details-full';
			$item_classes[] = !empty( $this->atts['horizontal_alignment'] ) ? $this->atts['horizontal_alignment'] : 'pf-details-h-mid';
			$item_classes[] = !empty( $this->atts['vertical_alignment'] ) ? $this->atts['vertical_alignment'] : 'pf-details-v-mid';
			$item_classes[] = 'pf-hover-masktext';
			//$item_classes[] = 'pf-hover-blurimage';
		}
		elseif( 'masonry-creative' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-light';
			$item_classes[] = 'pf-details-inside';
			$item_classes[] = 'pf-details-full';
			$item_classes[] = !empty( $this->atts['horizontal_alignment'] ) ? $this->atts['horizontal_alignment'] : 'pf-details-h-mid';
			$item_classes[] = !empty( $this->atts['vertical_alignment'] ) ? $this->atts['vertical_alignment'] : 'pf-details-v-mid';
			$item_classes[] = 'title-size-42';
			$item_classes[] = 'ld-pf-semiround';
		}
		elseif( 'masonry-classic' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-dark';
			$item_classes[] = 'pf-bg-hidden';
			$item_classes[] = 'pf-details-visible';
			$item_classes[] = 'title-size-30';
			$item_classes[] = 'pf-hover-shadow';
			$item_classes[] = 'pf-hover-shadow-alt';
		}
		elseif( 'carousel' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-light ld-pf-light-alt';
			$item_classes[] = 'pf-details-inside';
			$item_classes[] = 'pf-details-visible';
			$item_classes[] = 'pf-details-full';
			$item_classes[] = !empty( $this->atts['horizontal_alignment'] ) ? $this->atts['horizontal_alignment'] : 'pf-details-h-str';
			$item_classes[] = !empty( $this->atts['vertical_alignment'] ) ? $this->atts['vertical_alignment'] : 'pf-details-v-end';
			$item_classes[] = 'title-size-48';
			$item_classes[] = 'pf-hover-shadow';
		}
		elseif( 'grid' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-light';
			$item_classes[] = 'pf-details-inside';
			$item_classes[] = 'pf-details-full';
			$item_classes[] = !empty( $this->atts['horizontal_alignment'] ) ? $this->atts['horizontal_alignment'] : 'pf-details-h-mid';
			$item_classes[] = !empty( $this->atts['vertical_alignment'] ) ? $this->atts['vertical_alignment'] : 'pf-details-v-mid';
			$item_classes[] = 'pf-hover-masktext';
			//$item_classes[] = 'pf-hover-blurimage';
		}
		elseif( 'grid-alt' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-dark';
			$item_classes[] = 'title-size-18';
			$item_classes[] = 'pf-details-visible';
			$item_classes[] = 'text-center';
			$item_classes[] = 'pf-hover-rise';
			//$item_classes[] = 'pf-hover-blurimage';
		}
		elseif( 'grid-hover-overlay' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-dark';
			$item_classes[] = 'pf-bg-shadow';
			$item_classes[] = 'pf-details-visible';
			$item_classes[] = 'pf-details-boxed';
			$item_classes[] = 'pf-details-pull-right';
			$item_classes[] = 'pf-details-pull-up-half';
			$item_classes[] = 'title-size-24';
			$item_classes[] = !empty( $this->atts['horizontal_alignment'] ) ? $this->atts['horizontal_alignment'] : 'pf-details-h-str';
			$item_classes[] = !empty( $this->atts['vertical_alignment'] ) ? $this->atts['vertical_alignment'] : 'pf-details-v-end';
		}
		elseif( 'grid-hover-alt' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-dark';
			$item_classes[] = 'title-size-18';
			$item_classes[] = 'pf-details-inside';
			$item_classes[] = 'overflow-visible';
			$item_classes[] = 'pf-details-full';			
			$item_classes[] = !empty( $this->atts['horizontal_alignment'] ) ? $this->atts['horizontal_alignment'] : 'pf-details-h-mid';
			$item_classes[] = !empty( $this->atts['vertical_alignment'] ) ? $this->atts['vertical_alignment'] : 'pf-details-v-end';
			$item_classes[] = 'pf-btns-mid';
			$item_classes[] = 'pf-hover-animate-btn';
			$item_classes[] = 'pf-hover-shadow';
			$item_classes[] = 'pf-hover-shadow-alt-2';
			$item_classes[] = 'text-center';
		}
		elseif( 'grid-hover-classic' === $style ) {
			$item_classes[] = 'title-size-26';
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-light';
			$item_classes[] = 'pf-details-inside';
			$item_classes[] = 'pf-details-full';
			$item_classes[] = !empty( $this->atts['horizontal_alignment'] ) ? $this->atts['horizontal_alignment'] : 'pf-details-h-mid';
			$item_classes[] = !empty( $this->atts['vertical_alignment'] ) ? $this->atts['vertical_alignment'] : 'pf-details-v-mid';
			$item_classes[] = 'pf-btns-mid';
			$item_classes[] = 'pf-hover-animate-btn';
			$item_classes[] = 'pf-hover-masktext';

		}
		elseif( 'grid-hover-3d' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-light';
			$item_classes[] = 'pf-details-inside';
			$item_classes[] = 'pf-details-full';
			$item_classes[] = 'pf-details-inner-full';
			$item_classes[] = 'title-size-48';
			$item_classes[] = 'hover-3d';
			$item_classes[] = !empty( $this->atts['horizontal_alignment'] ) ? $this->atts['horizontal_alignment'] : 'pf-details-h-mid';
			$item_classes[] = !empty( $this->atts['vertical_alignment'] ) ? $this->atts['vertical_alignment'] : 'pf-details-v-mid';
		}
		elseif( 'grid-caption' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-dark';
			$item_classes[] = 'pf-details-visible';
			$item_classes[] = 'title-size-24';
			$item_classes[] = 'pf-hover-img-border';
		}
		elseif( 'vertical-overlay' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-dark';
			$item_classes[] = 'pf-details-visible';
			$item_classes[] = 'pf-details-boxed';
			$item_classes[] = !empty( $this->atts['horizontal_alignment'] ) ? $this->atts['horizontal_alignment'] : 'pf-details-h-str';
			$item_classes[] = !empty( $this->atts['vertical_alignment'] ) ? $this->atts['vertical_alignment'] : 'pf-details-v-end';
			$item_classes[] = 'pf-details-pull-up';
			$item_classes[] = 'title-size-30';
		}
		elseif( 'packery' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-dark';
			$item_classes[] = 'title-size-30';
			$item_classes[] = 'pf-details-inside';
			$item_classes[] = 'pf-details-full';
			$item_classes[] = !empty( $this->atts['horizontal_alignment'] ) ? $this->atts['horizontal_alignment'] : 'pf-details-h-mid';
			$item_classes[] = !empty( $this->atts['vertical_alignment'] ) ? $this->atts['vertical_alignment'] : 'pf-details-v-mid';
			$item_classes[] = 'pf-hover-masktext';
		}
		elseif( 'packery-2' === $style ) {
			       
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-dark';
			$item_classes[] = 'title-size-18';			
			$item_classes[] = 'pf-details-inside';
			$item_classes[] = 'pf-details-boxed';
			$item_classes[] = 'pf-details-circle';
			$item_classes[] = 'pf-details-pull-down';
			$item_classes[] = 'pf-details-pull-left';
			$item_classes[] = 'pf-contents-mid';
			$item_classes[] = !empty( $this->atts['horizontal_alignment'] ) ? $this->atts['horizontal_alignment'] : 'pf-details-h-str';
			$item_classes[] = !empty( $this->atts['vertical_alignment'] ) ? $this->atts['vertical_alignment'] : 'pf-details-v-end';
			$item_classes[] = 'pf-hover-masktext';
		}
		elseif( 'packery-3' === $style ) {
			$item_classes[] = !empty( $this->atts['color_type'] ) ? $this->atts['color_type'] : 'ld-pf-dark';
			$item_classes[] = 'title-size-26';
			$item_classes[] = 'pf-details-boxed';
			$item_classes[] = 'pf-details-inside';
			$item_classes[] = 'pf-details-w-auto';
			$item_classes[] = !empty( $this->atts['horizontal_alignment'] ) ? $this->atts['horizontal_alignment'] : 'pf-details-h-mid';
			$item_classes[] = !empty( $this->atts['vertical_alignment'] ) ? $this->atts['vertical_alignment'] : 'pf-details-v-mid';
			$item_classes[] = 'pf-hover-masktext';
		}
		
		return join( ' ', $item_classes );
		
	}
	
	protected function get_thumb_size() {

		$size = get_post_meta( get_the_ID(), '_portfolio_image_size', true );

		if( ! empty( $size ) ) {
			return $size;
		}

	}
	
	protected function get_grid_class() {

		$column = $this->atts['grid_columns'];
		$hash = array(
			'1' => '12',
			'2' => '6',
			'3' => '4',
			'4' => '3',
			'6' => '2'
		);

		printf( 'col-md-%s col-sm-6 col-xs-12', $hash[$column] );
	}

	protected function get_column_class() {

		$width = get_post_meta( get_the_ID(), 'portfolio-width', true );

		if ( !empty( $width ) && 'auto' !=  $width ) {
			echo $width;
			return;
		}

		$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumbnail' );
		$width = $img[1];

		if( $width > 260 && $width < 370 ) {
			echo '3';
			return;
		}

		if( $width > 360 && $width < 470 ) {
			echo '4';
			return;
		}

		if( $width > 471 && $width < 600 ) {
			echo '5';
			return;
		}

		if( $width > 600 ) {
			echo '6';
			return;
		}
	}
	
	protected function get_parallax() {

		if( 'no' === $this->atts['enable_parallax'] ) {
			return;
		}

		return 'data-responsive-bg="true" data-parallax="true" data-parallax-options=\'{ "parallaxBG": true }\'';
	}
	
	protected function get_overlay_button() {
		
		$format = get_post_format();
		$ext_url   = get_post_meta( get_the_ID(), 'portfolio-website', true );

		$local_url = get_the_permalink();
		$enable_gallery = $this->atts['enable_gallery'];
		
		$target = '';
		$enable_ext = $this->atts['enable_ext'];

		$link_atts = array( 
			'class' => 'liquid-overlay-link' 
		);
		if( $enable_ext ) {
			$url = !empty( $ext_url ) ? esc_url( $ext_url ) : $local_url;
			$link_atts['target'] = '_blank';
		}
		else {
			$url = esc_url( $local_url );	
		}

		if( 'video' === $format ) {
			$autoplay = get_post_meta( get_the_ID(), 'post-video-autoplay', true );
			$lightbox = get_post_meta( get_the_ID(), 'post-video-lightbox', true );
			if( 'autoplay' !== $autoplay ) {
				$link_atts['data-video-trigger'] = 'true';
				$link_atts['data-trigger-options'] = wp_json_encode( array( 'videoPlacement' => 'parent' ) );
			}
			if( 'on' === $lightbox ) {
				$link_atts['class'] = 'liquid-overlay-link fresco';
				$url = !empty( $ext_url ) ? esc_url( $ext_url ) : $local_url;
			}
		}
		
		if( 'listing-lightbox-gallery' === $enable_gallery ) {
			$url = wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' );
			if( 'video' === $format ) {
				$url = !empty( $ext_url ) ? esc_url( $ext_url ) : $local_url;
			}

			$link_atts['class'] = 'liquid-overlay-link fresco';
			$link_atts['data-fresco-group'] = esc_attr( $this->get_id() );
		}

		$link_atts['href'] = $url;
		printf( '<a%s></a>', ld_helper()->html_attributes( $link_atts ) );	

		
	}
	
	protected function entry_thumbnail( $size = 'full', $bg = false ) {
	
		if ( post_password_required() || is_attachment() ) {
			return;
		}
		
		$format = get_post_format();
		
		if ( 'video' === $format ) {
			
			$video_src = get_post_meta( get_the_ID(), 'post-video-url', true );
			$autoplay = get_post_meta( get_the_ID(), 'post-video-autoplay', true );
			if( 'autoplay' !== $autoplay ) {
				$autoplay = '';
			}

			if( !empty( $video_src ) ) {
				if( 'on' === liquid_helper()->get_option( 'enable-lazy-load' ) && !is_admin() ) {
					echo '<video class="ld-lazyload" data-src="' . esc_url( $video_src ) . '" width="100%" height="100%" ' . $autoplay . ' muted loop><source data-src="' . esc_url( $video_src ) . '" type="video/mp4"></video>';
				}
				else {
					echo '<video width="100%" height="100%" ' . $autoplay . ' muted loop><source src="' . esc_url( $video_src ) . '" type="video/mp4"></video>';
				}
				return;
			}
			
		}


		$style  = $this->atts['style'];
		
		$figure_classname = in_array( $style, array( 'metro', 'masonry-creative', 'carousel', 'grid', 'grid-hover-3d', 'grid-hover-alt', 'grid-hover-classic', 'packery', 'packery-2', 'packery-3' ) ) ? 'data-responsive-bg="true"' : '';

		if  ( 'yes' === $this->atts['disable_postformat'] ) {
			$format = 'image';
		}
		
		$thumb_size = $this->get_thumb_size();
		if( ! empty( $thumb_size ) ) {
			$size = $thumb_size;
		}
		
		$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		$resized_image = liquid_get_resized_image_src( $image_src, $size );
		
		if( 'grid-hover-3d' === $style ) {
			printf( '<figure %s class="transition-none" data-custom-animations="true" data-ca-options=\'{ "triggerHandler": "mouseenter", "triggerRelation": "closest", "triggerTarget": ".ld-pf-item", "offTriggerHandler": "mouseleave", "easing": "easeOutQuint", "duration": 850, "offDuration": 850, "initValues": { "scale": 1.1 }, "animations": { "scale": 1 } }\'>', $figure_classname );
			liquid_the_post_thumbnail( $size );			
		}
		elseif( 'grid-caption' === $style ) {
				printf( '<figure data-stacking-factor="1" %s %s>', $figure_classname, $this->get_parallax() );
				liquid_the_post_thumbnail( $size );			
		}
		else {
			if( $bg ) {
				printf( '<figure %s %s>', $figure_classname, $this->get_parallax() );
				liquid_the_post_thumbnail( $size );
			}
			else {
				echo '<figure ' . $figure_classname . '>';
				liquid_the_post_thumbnail( $size );
			}			
		}
		echo '</figure>';
	
	}
	
	protected function generate_css() {

		extract( $this->atts );

		$elements = array();
		$id = '.' .$this->get_id();
		
		
		if( ! empty( $color_primary ) ) {
			$elements[ liquid_implode( '%1$s .ld-pf-item .ld-pf-bg' ) ]['background'] = $color_primary;
		}
		if( !empty( $btn_color ) ) {
			$elements[ liquid_implode( '%1$s .ld-pf-bg .btn' ) ]['color'] = $btn_color;
		}
		
		if ( ! empty($title_size) ) {
			$elements[ liquid_implode( '%1$s .ld-pf-details h3.ld-pf-title' ) ]['font-size'] = $title_size;
		}
		if ( ! empty($title_weight) ) {
			$elements[ liquid_implode( '%1$s .ld-pf-details h3.ld-pf-title' ) ]['font-weight'] = $title_weight . '!important';
		}
		if ( ! empty($title_color) ) {
			$elements[ liquid_implode( '%1$s .ld-pf-details h3.ld-pf-title' ) ]['color'] = $title_color;
		}
		
		if( !empty( $custom_filter_size ) ) {
			$elements[ liquid_implode( '%1$s .filter-list' ) ]['font-size'] = $custom_filter_size;
		}
		if( !empty( $filter_underline_height ) ) {
			$elements[ liquid_implode( '%1$s .filters-underline li span:after' ) ]['height'] = $filter_underline_height;
			$elements[ liquid_implode( '%1$s .filters-underline li span:after' ) ]['min-height'] = $filter_underline_height;
		}
		if( !empty( $filter_normal_color ) ) {
			$elements[ liquid_implode( '%1$s .filter-list li' ) ]['color'] = $filter_normal_color;
		}
		if( !empty( $filter_hover_color ) ) {
			$elements[ liquid_implode( '%1$s .filter-list li.active, %1$s .filter-list li.hover' ) ]['color'] = $filter_hover_color;
		}
		if( !empty( $filter_dec_color ) ) {
			$elements[ liquid_implode( '%1$s .filters-underline li span:after, %1$s .filters-line-through li span:after' ) ]['background'] = $filter_dec_color;
		}
		if( !empty( $filter_mb ) ) {
			$elements[ liquid_implode( '%1$s .liquid-filter-items' ) ]['margin-bottom'] = $filter_mb .'px';
		}
		
		$grid_id = '%1$s .' . $this->grid_id;
		$gap = (int)$columns_gap . 'px';

		$elements[ liquid_implode( $grid_id ) ] = array(
			'margin-left' => '-' . $gap,
			'margin-right' => '-' . $gap
		);

		$elements[ liquid_implode( $grid_id . ' .masonry-item' ) ] = array(
			'padding-left' => $gap,
			'padding-right' => $gap
		);
		if( '30' !== $bottom_gap ) { 
			$elements[ liquid_implode( $grid_id . ' .ld-pf-item' ) ]['margin-bottom'] = $bottom_gap .'px';
		}

		$this->dynamic_css_parser( $id, $elements );
	}
	
	/**
	 * [entry_term_classes description]
	 * @method entry_term_classes
	 * @return [type]             [description]
	 */
	protected function entry_term_classes() {

		$terms = get_the_terms( get_the_ID(), $this->taxonomies[0] );
		if( !$terms ) {
			return;
		}
		$terms = wp_list_pluck( $terms, 'slug' );
		echo join( ' ', $terms );

	}

	// AJAX Helpers ------------------------------------------------

	/**
	 * @param $search_string
	 *
	 * @return array
	 */
	public function include_field_search( $search_string ) {
		$query = $search_string;
		$data = array();
		$args = array(
			's' => $query,
			'post_type' => $this->post_type,
		);
		$args['vc_search_by_title_only'] = true;
		$args['numberposts'] = - 1;
		if ( 0 === strlen( $args['s'] ) ) {
			unset( $args['s'] );
		}
		add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
		$posts = get_posts( $args );
		if ( is_array( $posts ) && ! empty( $posts ) ) {
			foreach ( $posts as $post ) {
				$data[] = array(
					'value' => $post->ID,
					'label' => $post->post_title
				);
			}
		}

		return $data;
	}

	/**
	 * @param $data_arr
	 *
	 * @return array
	 */
	function exclude_field_search( $data_arr ) {

		$term = isset( $data_arr['term'] ) ? $data_arr['term'] : '';
		$data = array();
		$args = array(
			's' => $term,
			'post_type' => $this->post_type,
		);
		$args['vc_search_by_title_only'] = true;
		$args['numberposts'] = - 1;
		if ( 0 === strlen( $args['s'] ) ) {
			unset( $args['s'] );
		}
		add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
		$posts = get_posts( $args );
		if ( is_array( $posts ) && ! empty( $posts ) ) {
			foreach ( $posts as $post ) {
				$data[] = array(
					'value' => $post->ID,
					'label' => $post->post_title
				);
			}
		}

		return $data;
	}

	/**
	 * @since 4.5.2
	 *
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	function autocomplete_taxonomies_field_search( $search_string ) {
		$data = array();
		$vc_taxonomies = get_terms( $this->taxonomies, array(
			'hide_empty' => false,
			'search'     => $search_string,
		) );
		if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
			foreach ( $vc_taxonomies as $t ) {
				if ( is_object( $t ) ) {
					$data[] = ld_helper()->get_term_object( $t );
				}
			}
		}

		return $data;
	}

	function render_autocomplete_field( $term ) {
		return ld_helper()->vc_autocomplete_taxonomies_field_render($term, 'liquid-portfolio-category');
	}
}
new LD_PortfolioListing;