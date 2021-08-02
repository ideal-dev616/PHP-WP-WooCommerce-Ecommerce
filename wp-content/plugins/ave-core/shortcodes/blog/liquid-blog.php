<?php

/**
* Shortcode Blog
*/

if( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
* LD_Shortcode
*/
class LD_Blog extends LD_Shortcode {

	/**
	 * [$post_type description]
	 * @var string
	 */
	private $post_type = 'post';

	/**
	 * [$taxonomies description]
	 * @var array
	 */
	private $taxonomies = array( 'category', 'post_tag' );

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		// Properties
		$this->slug        = 'ld_blog';
		$this->title       = esc_html__( 'Blog', 'ave-core' );
		$this->scripts     = array( 'packery-mode', 'flickity' );
		$this->styles      = array( 'flickity' );
		$this->icon        = 'fa fa-pencil';
		$this->description = esc_html__( 'Latest Posts listing', 'ave-core' );

		require_once vc_path_dir( 'CONFIG_DIR', 'grids/vc-grids-functions.php' );

		if ( 'vc_get_autocomplete_suggestion' === vc_request_param( 'action' ) || 'vc_edit_form' === vc_post_param( 'action' ) ) {
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_callback', array( $this, 'include_field_search' ) ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_include_render', 'vc_include_field_render' ); // Render exact product. Must return an array (label,value)

			// Narrow data taxonomies
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_callback', array( $this,'autocomplete_taxonomies_field_search' ) );
			add_filter( 'vc_autocomplete_'. $this->slug . '_taxonomies_render', 'vc_autocomplete_taxonomies_field_render' );

			// Narrow data taxonomies for exclude_filter
			add_filter( 'vc_autocomplete_'. $this->slug . '_exclude_callback', array( $this, 'exclude_field_search' ) ); // Get suggestion(find). Must return an array
			add_filter( 'vc_autocomplete_'. $this->slug . '_exclude_render', 'vc_exclude_field_render' ); // Render exact product. Must return an array (label,value)
			
			// Filter Cats
			add_filter( 'vc_autocomplete_'. $this->slug . '_filter_cats_callback', array( $this,'autocomplete_taxonomies_field_search' ) );
			add_filter( 'vc_autocomplete_'. $this->slug . '_filter_cats_render', 'vc_autocomplete_taxonomies_field_render' );
		}
		
		add_action( 'pre_get_posts', array( $this, 'query_offset' ), 1 );
		add_filter( 'found_posts', array( $this, 'adjust_offset_pagination' ), 1, 2 );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

		parent::__construct();
	}

	public function enqueue() {
		if( is_category() || is_tag() || is_author() || is_search() ) {
			return;
		}
	    wp_enqueue_script( $this->slug . '_script', plugin_dir_url(__FILE__) . 'script.min.js', array( 'jquery' ) );
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

		$url = liquid_addons()->plugin_uri() . 'assets/img/sc-preview/blog/';
		
		$button = vc_map_integrate_shortcode( 'ld_button', 'ib_', esc_html__( 'Button', 'ave-core' ),
			array(
				'exclude' => array(
					'el_id',
					'el_class',
					'sh_shadowbox',
					'enable_row_shadowbox',
					'button_box_shadow',
					'hover_button_box_shadow'
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
				'heading'    => esc_html__( 'Style', 'ave-core' ),
				'param_name' => 'style',
				'value'      => array(

					array(
						'value' => 'classic',
						'label' => esc_html__( 'Classic', 'ave-core' ),
						'image' => $url . 'classic.jpg'
					),
					array(
						'label' => esc_html__( 'Classic Bold', 'ave-core' ),
						'value' => 'classic-bold',
						'image' => $url . 'classic-bold.jpg'
					),
					array(
						'value' => 'candy',
						'label' => esc_html__( 'Candy', 'ave-core' ),
						'image' => $url . 'candy.jpg'
					),
					array(
						'label' => esc_html__( 'Featured', 'ave-core' ),
						'value' => 'featured',
						'image' => $url . 'featured.jpg'
					),
					array(
						'label' => esc_html__( 'Featured 2', 'ave-core' ),
						'value' => 'featured-2',
						'image' => $url . 'featured-2.jpg'
					),
					array(
						'label' => esc_html__( 'Featured Minimal', 'ave-core' ),
						'value' => 'featured-minimal',
						'image' => $url . 'featured-minimal.jpg'
					),
					array(
						'label' => esc_html__( 'Rounded', 'ave-core' ),
						'value' => 'rounded',
						'image' => $url . 'rounded.jpg'
					),
					array(
						'label' => esc_html__( 'Classic Meta', 'ave-core' ),
						'value' => 'classic-meta',
						'image' => $url . 'classic-meta.jpg'
					),
					array(
						'label' => esc_html__( 'Classic 2', 'ave-core' ),
						'value' => 'classic-2',
						'image' => $url . 'classic-2.jpg'
					),
					array(
						'label' => esc_html__( 'Text date', 'ave-core' ),
						'value' => 'text-date',
						'image' => $url . 'text-date.jpg'
					),
					array(
						'label' => esc_html__( 'Metro', 'ave-core' ),
						'value' => 'metro',
						'image' => $url . 'metro.jpg'
					),
					array(
						'label' => esc_html__( 'Minimal Grey', 'ave-core' ),
						'value' => 'minimal',
						'image' => $url . 'minimal.jpg'
					),
					array(
						'label' => esc_html__( 'Metro Alt', 'ave-core' ),
						'value' => 'metro-alt',
						'image' => $url . 'metro.jpg'
					),
					array(
						'label' => esc_html__( 'Carousel - Filterable', 'ave-core' ),
						'value' => 'carousel-filterable',
						'image' => $url . 'carousel-filterable.jpg'
					),
					array(
						'label' => esc_html__( 'Grid', 'ave-core' ),
						'value' => 'grid',
						'image' => $url . 'grid.jpg'
					),
					array(
						'label' => esc_html__( 'Masonry', 'ave-core' ),
						'value' => 'masonry',
						'image' => $url . 'masonry.jpg'
					),
					array(
						'label' => esc_html__( 'Carousel', 'ave-core' ),
						'value' => 'carousel',
						'image' => $url . 'carousel.jpg'
					),
					array(
						'label' => esc_html__( 'Category', 'ave-core' ),
						'value' => 'category',
						'image' => $url . 'category.jpg'
					),
					array(
						'label' => esc_html__( 'Category Bordered', 'ave-core' ),
						'value' => 'category-bordered',
						'image' => $url . 'category-bordered.jpg'
					),
					array(
						'label' => esc_html__( 'Category Compact', 'ave-core' ),
						'value' => 'category-compact',
						'image' => $url . 'category-compact.jpg'
					),
					array(
						'label' => esc_html__( 'Split', 'ave-core' ),
						'value' => 'split',
						'image' => $url . 'split.jpg'
					),
					array(
						'label' => esc_html__( 'Small', 'ave-core' ),
						'value' => 'small',
						'image' => $url . 'small.jpg'
					),
					array(
						'label' => esc_html__( 'Square', 'ave-core' ),
						'value' => 'square',
						'image' => $url . 'square.jpg'
					),
					array(
						'label' => esc_html__( 'Square 2', 'ave-core' ),
						'value' => 'square-2',
						'image' => $url . 'square-2.jpg'
					),
					array(
						'label' => esc_html__( 'Featured Fullwidth', 'ave-core' ),
						'value' => 'featured-fullwidth',
						'image' => $url . 'featured-fullwidth.jpg'
					),
					array(
						'label' => esc_html__( 'Masonry Alt', 'ave-core' ),
						'value' => 'timeline',
						'image' => $url . 'timeline.jpg'
					),
					array(
						'label' => esc_html__( 'Classic Full', 'ave-core' ),
						'value' => 'classic-full',
						'image' => $url . 'classic-full.jpg'
					),
					
				),
				'description' => esc_html__( 'Select the desired blog layout', 'ave-core' ),
				'admin_label' => true,
				'save_always' => true,
			),
			array(
				'type' => 'textfield',
				'param_name' => 'carousel_heading',
				'heading'     => esc_html__( 'Carousel heading', 'ave-core' ),
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'carousel' ),
				),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'enable_filter',
				'heading'    => esc_html__( 'Post Filters', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Disable', 'ave-core' ) => 'no',
					esc_html__( 'Enable', 'ave-core' ) => 'yes',
				),
				'dependency' => array(
					'element' => 'style',
					'value' => array( 'split', 'carousel-filterable' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'grid_columns',
				'heading'    => esc_html__( 'Columns', 'ave-core' ),
				'value'      => array(
					'1 Column'  => '1',
					'2 Columns' => '2',
					'3 Columns' => '3',
					'4 Columns' => '4',
				),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array(
						'carousel',
						'candy',
						'carousel-filterable',
						'metro',
						'minimal',
						'square',
						'square-2',
					),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'show_meta',
				'heading'     => esc_html__( 'Post Meta', 'ave-core' ),
				'description' => esc_html__( 'Show/Hide post meta ( tags, categories )', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Show', 'ave-core' ) => 'yes',
					esc_html__( 'Hide', 'ave-core' ) => 'no'
				),
				'default' => 'yes',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'meta_type',
				'heading'     => esc_html__( 'Meta Type', 'ave-core' ),
				'description' => esc_html__( 'Type Of Post Meta To Show', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Tags', 'ave-core' ) => 'tags',
					esc_html__( 'Categories', 'ave-core' ) => 'cats'
				),
				'dependency'         => array(
					'element' => 'show_meta',
					'value'   => 'yes'
				),
				'default' => 'tags',
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'one_category',
				'heading'     => esc_html__( 'Show Only One Post Meta', 'ave-core' ),
				'description' => esc_html__( 'Enable to show one category/tag', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Enable', 'ave-core' ) => 'yes',
					esc_html__( 'Disable', 'ave-core' ) => 'no'
				),
				'default'     => 'yes',
				'edit_field_class' => 'vc_col-sm-6',
				'dependency'         => array(
					'element' => 'show_meta',
					'value'   => 'yes'
				),
			),

			array(
				'type'        => 'textfield',
				'param_name'  => 'post_excerpt_length',
				'heading'     => esc_html__( 'Excerpt Length', 'ave-core' ),
				'description' => esc_html__( 'Set the excerpt length. Leave blank to set default ( 55 words )', 'ave-core' ),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array(
						'masonry-creative',
						'puzzle',
						'only-title'
					),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'enable_parallax',
				'heading'     => esc_html__( 'Parallax post images', 'ave-core' ),
				'description' => esc_html__( 'Enable/Disable post image parallax', 'ave-core' ),
				'value'       => array(
					esc_html__( 'Enable', 'ave-core' )  => '',
					esc_html__( 'Disable', 'ave-core' ) => 'no'
				),
				'dependency'  => array(
					'element' => 'style',
					'value_not_equal_to' => array(
						'minimal'
					),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'dropdown',
				'heading'    => esc_html__( 'Pagination', 'ave-core' ),
				'param_name' => 'pagination',
				'value' => array(
					esc_html__( 'None', 'ave-core' ) => 'none',
					esc_html__( 'Ajax', 'ave-core' )        => 'ajax',
					esc_html__( 'Classic Pagination', 'ave-core' ) => 'pagination',
				),
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 'carousel', 'carousel-filterable' ),
				),
				'description' => esc_html__( 'Select posts pagination style.', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
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
				'edit_field_class' => 'vc_col-sm-6',
			),

			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Data Source', 'ave-core' ),
				'param_name'  => 'post_type',
				'value'       => $this->get_post_type_list(),
				'save_always' => true,
				'description' => esc_html__( 'Select content type for your grid.', 'ave-core' ),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Total Items', 'ave-core' ),
				'param_name' => 'posts_per_page',
				'value'      => 10,
				// default value
				'param_holder_class' => 'vc_not-for-custom',
				'description'        => esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'ave-core' ),
				'dependency'         => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),

			// Custom query tab
			array(
				'type'        => 'textarea_safe',
				'heading'     => esc_html__( 'Custom query', 'ave-core' ),
				'param_name'  => 'custom_query',
				'description' => __( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts">WordPress Codex</a>.', 'ave-core' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value' => array( 'custom' ),
				),
			),
			array(
				'type'       => 'autocomplete',
				'heading'    => esc_html__( 'Narrow data source', 'ave-core' ),
				'param_name' => 'taxonomies',
				'settings'   => array(
					'multiple'   => true,
					'min_length' => 3,
					'groups'     => true,
					'no_hide'    => true, // In UI after select doesn't hide an select list
					'unique_values'  => true,
					'display_inline' => true,
					'delay'      => 500,
					'auto_focus' => true,
				),
				'param_holder_class' => 'vc_not-for-custom',
				'description' => esc_html__( 'Enter categories, tags or custom taxonomies.', 'ave-core' ),
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
				),
			),
			array(
				'type'        => 'autocomplete',
				'heading'     => esc_html__( 'Include only', 'ave-core' ),
				'param_name'  => 'include',
				'description' => esc_html__( 'Add posts, etc. by title.', 'ave-core' ),
				'settings'    => array(
					'multiple' => true,
					'sortable' => true,
					'groups'   => true,
					'no_hide'  => true, // In UI after select doesn't hide an select list
				),
				'dependency'   => array(
					'element' => 'post_type',
					'value' => array( 'ids' ),
				),
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'columns_gap',
				'heading'     => esc_html__( 'Columns Gap', 'ave-core' ),
				'description' => esc_html__( 'Select gap between columns in row.', 'ave-core' ),
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'std'         => 15,
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 'carousel',  'carousel-filterable', 'candy' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'bottom_gap',
				'heading'     => esc_html__( 'Bottom Gap', 'ave-core' ),
				'description' => esc_html__( 'Bottom gap for blog items', 'ave-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
				'std'         => 30,
				'dependency' => array(
					'element' => 'style',
					'value_not_equal_to'   => array( 'carousel', 'carousel-filterable' ),
				),
				'edit_field_class' => 'vc_col-sm-6',
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
				'type'        => 'liquid_colorpicker',
				'only_solid'  => true, 
				'param_name'  => 'title_color',
				'heading'     => esc_html__( 'Title Color', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4'
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'title_mt',
				'heading'     => esc_html__( 'Title Top Margin', 'ave-core' ),
				'description' => esc_html__( 'Add top margin to the title', 'ave-core' ),
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'type'        => 'liquid_slider',
				'param_name'  => 'title_mb',
				'heading'     => esc_html__( 'Title Bottom Margin', 'ave-core' ),
				'description' => esc_html__( 'Add bottom margin to the title', 'ave-core' ),
				'min'         => 0,
				'max'         => 50,
				'step'        => 1,
				'edit_field_class' => 'vc_col-sm-6'
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
				'type'        => 'colorpicker',
				'param_name'  => 'filter_normal_color',
				'heading'     => esc_html__( 'Color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the filter items', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4'				
			),
			array(
				'type'        => 'colorpicker',
				'param_name'  => 'filter_hover_color',
				'heading'     => esc_html__( 'Hover/Active color', 'ave-core' ),
				'description' => esc_html__( 'Pick a color for the filter hover/active item', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-4'				
			),
			array(
				'type'        => 'colorpicker',
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
					esc_html__( 'Large', 'ave-core' )   => 'size-lg h2',
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
				'type'        => 'liquid_slider',
				'param_name'  => 'filter_mb',
				'heading'     => esc_html__( 'Filter Margin Bottom', 'ave-core' ),
				'description' => esc_html__( 'Add bottom margin to the filter', 'ave-core' ),
				'min'         => 0,
				'max'         => 100,
				'step'        => 1,
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
				'type'       => 'textfield',
				'param_name' => 'filter_subtitle',
				'heading'    => esc_html__( 'Filter subtitle', 'ave-core' ),
				'dependency' => array(
					'element' => 'style',
					'value' => 'carousel-filterable'
				),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'link_label',
				'heading'     => esc_html__( 'Button Label', 'ave-core' ),
				'dependency' => array(
					'element' => 'style',
					'value' => 'carousel-filterable'
				),
				'edit_field_class' => 'vc_col-sm-6'
			),
			array(
				'id'               => 'link',
				'description'      => esc_html__( 'Please, set the link to show the button', 'ave-core' ),
				'edit_field_class' => 'vc_col-sm-6',
				'dependency' => array(
					'element' => 'style',
					'value' => 'carousel-filterable'
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

		);

		foreach( $filter as &$param ) {
			$param['group'] = esc_html__( 'Filter', 'ave-core' );
			$param['dependency'] = array(
				'element' => 'enable_filter',
				'value' => array( 'yes' )
			);
		}

		$data = array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Order By', 'ave-core' ),
				'param_name' => 'orderby',
				'value' => array(
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

				'description'        => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'ave-core' ),
				'group'              => esc_html__( 'Data Settings', 'ave-core' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency'         => array(
					'element'            => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom'
					)
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Sort Order', 'ave-core' ),
				'param_name' => 'order',
				'group'      => esc_html__( 'Data Settings', 'ave-core' ),
				'value'      => array(
					esc_html__( 'Descending', 'ave-core' ) => 'DESC',
					esc_html__( 'Ascending', 'ave-core' ) => 'ASC',
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'description'        => esc_html__( 'Select sorting order.', 'ave-core' ),
				'dependency'         => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					)
				)
			),

			array(
				'type'               => 'textfield',
				'heading'            => esc_html__( 'Meta key', 'ave-core' ),
				'param_name'         => 'meta_key',
				'description'        => esc_html__( 'Input meta key for grid ordering.', 'ave-core' ),
				'group'              => esc_html__( 'Data Settings', 'ave-core' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency' => array(
					'element' => 'orderby',
					'value'   => array(
						'meta_value',
						'meta_value_num',
					)
				)
			),

			array(
				'type'           => 'textfield',
				'heading'        => esc_html__( 'Offset', 'ave-core' ),
				'param_name'     => 'offset',
				'description'    => esc_html__( 'Number of grid elements to displace or pass over.', 'ave-core' ),
				'group'          => esc_html__( 'Data Settings', 'ave-core' ),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency' => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					)
				)
			),

			array(
				'type'        => 'autocomplete',
				'heading'     => esc_html__( 'Exclude', 'ave-core' ),
				'param_name'  => 'exclude',
				'description' => esc_html__( 'Exclude posts, etc. by title.', 'ave-core' ),
				'group'       => esc_html__( 'Data Settings', 'ave-core' ),
				'settings' => array(
					'multiple' => true,
					'no_hide'  => true, // In UI after select doesn't hide an select list
				),
				'param_holder_class' => 'vc_grid-data-type-not-ids',
				'dependency'  => array(
					'element' => 'post_type',
					'value_not_equal_to' => array(
						'ids',
						'custom',
					),
					'callback' => 'vc_grid_exclude_dependency_callback'
				)
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
			
		);

		$this->params = array_merge( $general, $filter, $button, $data );

		$this->add_extras();
	}
	
	/**
	 * [before_output description]
	 * @method before_output
	 * @param  [type]        $atts    [description]
	 * @param  [type]        $content [description]
	 * @return [type]                 [description]
	 */
	public function before_output( $atts, &$content ) {

		if( 'carousel-filterable' === $atts['style'] ) {
			$atts['template'] = 'carousel-filterable';
		}

		return $atts;
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
				'post__in' => $incposts,
				'posts_per_page' => count( $incposts ),
				'post_type' => 'any',
				'orderby' => 'post__in',
			);
		}
		else {
			$settings = array(
				'posts_per_page' => isset( $posts_per_page ) ? (int) $posts_per_page : 100,
				'offset'         => $offset,
				'orderby' => $orderby,
				'order' => $order,
				'meta_key' => in_array( $orderby, array(
					'meta_value',
					'meta_value_num',
				) ) ? $meta_key : '',
				'post_type' => $post_type,
				'ignore_sticky_posts' => true,
			);

			if( $exclude ) {
				$settings['post__not_in'] = wp_parse_id_list( $exclude );
			}

			/*if( intval( $offset ) ) {
				$settings['no_found_rows'] = intval( $offset );
			}*/

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
							'field' => 'id',
							'terms' => array( $t->term_id ),
							'relation' => 'IN',
						);
					} else {
						$tax_queries[ $t->taxonomy ]['terms'][] = $t->term_id;
					}
				}
				$settings['tax_query'] = array_values( $tax_queries );
				$settings['tax_query']['relation'] = 'OR';
			}

            if ( isset($_GET['category']) && isset($_GET['filter-id']) && $_GET['filter-id'] === $filter_id ) {
                $parent_category = get_category($_GET['category']);
                $categories = get_term_children($parent_category->term_id, 'category');
                $categories = array_merge($categories, [$parent_category->term_id]);

                $settings['tax_query'] = [
                    [
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $categories,
                        'operator' => 'IN'
                    ]
                ];
            }

		}

		return $settings;
	}

	// Entry Helper ------------------------------------------------
	
	public function query_offset( &$query ) {
		
		//Before anything else, make sure this is the right query...
/*
		if ( ! $query->is_home() || empty( $this->atts['offset'] ) ) {
		    return;
		}
*/
		if ( empty( $this->atts['offset'] ) ) {
		    return;
		}

		$offset = $this->atts['offset'];
		$ppp = isset( $this->atts['posts_per_page'] ) ? (int) $this->atts['posts_per_page'] : 100;

		if ( $query->is_paged ) {
		    $page_offset = $offset + ( ( $query->query_vars['paged'] - 1 ) * $ppp );
			$query->set( 'offset', $page_offset );
		}
		else {		
			$query->set( 'offset', $offset );
		}
	}

	public function adjust_offset_pagination( $found_posts, $query ) {

		if ( empty( $this->atts['offset'] ) ) {
		    return $found_posts;
		}
		
		$offset = $this->atts['offset'];

		if ( $query->is_home() ) {
		    return $found_posts - $offset;
		}

		return $found_posts;
	}

	protected function entry_title( $classes = '' ) {
		
		$style = $this->atts['style'];
		
		$format = get_post_format();
		if ( 'link' !== $format && is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
			return;
		}

		$url = 'link' == $format ? liquid_helper()->get_option( 'post-link-url' ) : get_permalink();
		$target = 'link' == $format ? 'target="_blank"' : '';
		
		if( 'masonry' === $style || 'grid' === $style ) {
			the_title( sprintf( '<h2 class="entry-title liquid-lp-title %s" data-fittext="true" data-fittext-options=\'{ "maxFontSize": "currentFontSize" }\'><a ' . $target . '  href="%s" rel="bookmark" data-split-text="true" data-split-options=\'{ "type": "lines" }\'>', $classes, esc_url( $url ) ), '</a></h2>' );
		}
		else {
			the_title( sprintf( '<h2 class="entry-title liquid-lp-title %s"><a ' . $target . ' href="%s" rel="bookmark">', $classes, esc_url( $url ) ), '</a></h2>' );
		}
		
	}
	
	protected function overlay_link() {
		
		$format = get_post_format();
		$url = 'link' == $format ? liquid_helper()->get_option( 'post-link-url' ) : get_permalink();
		$target = 'link' == $format ? 'target="_blank"' : '';
		
		echo '<a ' . $target . ' href="' . esc_url( $url ) . '" class="liquid-overlay-link">' . get_the_title() . '</a>';

	}

	public function excerpt_lengh( $length ) {

		if( empty( $this->atts['post_excerpt_length'] ) ) {
			return $length;
		}
		return $this->atts['post_excerpt_length'];
	}

	public function excerpt_more( $more ) {

		if( empty( $this->atts['post_excerpt_length'] ) ) {
			return $more;
		}
		return '';

	}
	
	public function clean_excerpt() {
		return false;
	}

	protected function entry_content() {
		
		$style = $this->atts['style'];
		$class = '';
		if( 'classic' === $style ) {
			$class = 'mt-1';
		}

		if( !is_single() ) :

	?>
			<div class="liquid-lp-excerpt entry-summary <?php echo $class; ?>">
				<?php
					add_filter( 'excerpt_length', array( $this, 'excerpt_lengh' ), 999 );
					add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
					add_filter( 'liquid_dinamic_css_output', array( $this, 'clean_excerpt' ) );
					the_excerpt();
					remove_filter( 'liquid_dinamic_css_output', array( $this, 'clean_excerpt' ) ); ?>
			</div><!-- /.latest-post-excerpt -->
		<?php else: ?>
			<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Continue reading %s', 'ave-core' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ave-core' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'ave-core' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
			?>
	    </div>
	<?php endif;

	}

	protected function entry_cats() {

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'ave-core' ) );

		if ( $categories_list ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', 'ave-core' ),
				$categories_list
			);
		}
	}

	protected function entry_tags( $classes = '' ) {
		
		$show_meta = $this->atts['show_meta'];
		if( 'no' === $show_meta ) {
			return;
		}
		
		global $post;
		
		$out = '';
		
		$meta_type    = $this->atts['meta_type'];
		$one_category = $this->atts['one_category'];
		$style = $this->atts['style'];
		
		$tags_list = wp_get_post_tags( $post->ID );
		
		$rel = 'rel="tag"';
		
		if( 'cats' === $meta_type ) {
			$tags_list = get_the_category( $post->ID );	
			$rel = 'rel="category"';
		}		
		
		$before       = '<ul class="liquid-lp-category ' . esc_attr( $classes ) . '">';
		$after        = '</ul>';
		$before_link  = '<li>';
		$after_link   = '</li>';
		$before_label = '';
		$after_label  = '';
		
		$svg_icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" width="14" stroke="#a7a9b8">
						<polygon fill="none" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" points="23,23 1,23 1,1 9,1 12,5 23,5 " transform="translate(0, 0)" stroke-linejoin="miter"></polygon>
					</svg>';
					
		$svg_border = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" class="liquid-lp-gradient-border" width="100%" height="100%">
							<rect x="0" y="0" rx="0" ry="0" width="100%" height="100%" stroke="url(#btn-grad-1)"/>
					   </svg>';
		
		if( 'text-date' === $style ) {
			$before = $svg_icon . $before;
		}
		elseif( 'metro' === $style ) {
			$before_label = $svg_border . '<span>';
			$after_label  = '</span>';
		}
		elseif( 'metro-alt' === $style ) {
			$before_label = '<span>';
			$after_label  = '</span>';
		}

		if ( $tags_list ) {			
			$out .= $before;
			if( 'yes' === $one_category ) {
				$out .= '<li><a href="' . get_category_link( $tags_list['0']->term_id ) . '" ' . $rel . '>' . $before_label . esc_html( $tags_list['0']->name ) . $after_label . '</a></li>';
			}
			else {
				foreach( $tags_list as $tag ) {
					$out .= '<li><a href="' . get_category_link( $tag->term_id ) . '" ' . $rel . '>' . $before_label . esc_html( $tag->name ) . $after_label . '</a></li>';
				}				
			}
			$out .= $after;
		}
		
		if( $out ) {
			printf( '<span><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Tags', 'Used before tag names.', 'ave-core' ),
				$out
			);
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

		return ! empty( $hash[ $column ] ) ? sprintf( 'col-md-%s', $hash[ $column ] ) : 'col-md-6';
	}

	protected function entry_author( $avatar_size = false ) {

		$format = get_post_format();
		if ( 'link' === $format && ! is_single() ) {
			return;
		}

		$svg_icon = '';
		$style = $this->atts['style'];

		if( 'text-date' === $style ) {
			$svg_icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" width="12" stroke="#a7a9b8">
							<path fill="none" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M12,12L12,12 c-2.761,0-5-2.239-5-5V6c0-2.761,2.239-5,5-5h0c2.761,0,5,2.239,5,5v1C17,9.761,14.761,12,12,12z" stroke-linejoin="miter"></path>
							<path data-color="color-2" fill="none" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M22,20.908 c0-1.8-1.197-3.383-2.934-3.856C17.172,16.535,14.586,16,12,16s-5.172,0.535-7.066,1.052C3.197,17.525,2,19.108,2,20.908V23h20 V20.908z" stroke-linejoin="miter"></path>
						</svg>';
		}

		printf( '<span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%4$s%3$s</a> </span>',
			_x( 'Author', 'Used before post author name.', '_' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author(),
			$svg_icon
		);
	}

	protected function entry_time_to_read() {

		$time_to_read = liquid_helper()->get_option( 'post-time-read' );
		if( empty( $time_to_read ) ) {
			return;
		}

		printf( '<span class="post-time-read"><i class="fa fa-book"></i> %s</span>',
				esc_html( $time_to_read )
		);

	}
	
	/**
	 * [entry_term_classes description]
	 * @method entry_term_classes
	 * @return [type]             [description]
	 */
	protected function entry_term_classes() {

		$postcats = get_the_category();
		$cat_slugs = array();
		if ( count( $postcats ) > 0 ) :
			foreach ( $postcats as $postcat ):
				$cat_slugs[] = 	$postcat->slug;
			endforeach;
		endif; 
		return implode( ' ', $cat_slugs );

	}

	protected function entry_comments() {

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments">';
			comments_popup_link( __( '<i class="fa fa-comment"></i>No Opinions', 'ave-core' ), __( '<i class="fa fa-comment"></i>1 Opinion', 'ave-core' ), __( '<i class="fa fa-comment"></i>% Opinions', 'ave-core' ) );
			echo '</span>';
		}
	}

	protected function enable_parallax() {

		$parallax = isset( $this->atts['enable_parallax'] ) ? $this->atts['enable_parallax'] : '';

		if( 'no' === $parallax ) {
			return;
		}

		return 'data-responsive-bg="true" data-parallax="true" data-parallax-options=\'{ "parallaxBG": true }\'';
	}
	
	protected function entry_thumbnail( $size = 'liquid-thumbnail', $attr = '', $background = false ) {
		
		//Check
		if ( post_password_required() || is_attachment() ) {
			return;
		}
		$figure_background = $figure_classnames = '';
		
		if( 'rounded' === $this->atts['style'] ) {
			$figure_classnames = 'rounded';
		}
		elseif( 'square' === $this->atts['style'] ) {
			$figure_classnames = 'round';
		}		
		
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );
		$src = liquid_get_resized_image_src( $src, $size );		
		
		if( $background ) {
			$figure_background = 'data-responsive-bg="true"';
		}
		if( 'carousel-filterable' === $this->atts['style'] && isset( $this->atts['enable_parallax'] ) ) {
			$figure_background = 'data-responsive-bg="true"';
		}
		
		$format = get_post_format();
		$style = $this->atts['style'];
		$parallax = isset( $this->atts['enable_parallax'] ) ? $this->atts['enable_parallax'] : '';
		$url = 'link' == $format ? liquid_helper()->get_option( 'post-link-url' ) : get_permalink();
		$target = 'link' == $format ? 'target="_blank"' : '';
		
		if( has_post_thumbnail() ) {
			printf( '<figure class="liquid-lp-media %s" %s %s>', $figure_classnames, $figure_background, $this->enable_parallax() );
				echo '<a ' . $target . ' href="' . esc_url( $url ) . '">';
					liquid_the_post_thumbnail( $size, $attr, true );
				echo '</a>';
			echo '</figure>';
		}
	
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
	
	protected function get_button() {

		if ( empty( $this->atts['link_label'] ) ) {
			return;
		}

		$classes = array(
			'btn', 
			'btn-solid', 
			'btn-gradient', 
			'circle', 
			'text-uppercase', 
			'wide',
			'ld-lp-carousel-filterable-btn'
		);
		$attributes = liquid_get_link_attributes( $this->atts['link'], '#' );
		$attributes['class'] = ld_helper()->sanitize_html_classes( $classes );
		
		echo '<a' . ld_helper()->html_attributes( $attributes ) . '>
				<span>
					<span class="btn-gradient-bg"></span>
					<span class="btn-txt">' . esc_html( $this->atts['link_label'] ) . '</span>
					<span class="btn-gradient-bg btn-gradient-bg-hover"></span>
				</span>
			</a>';

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
			'search' => $search_string,
		) );
		if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
			foreach ( $vc_taxonomies as $t ) {
				if ( is_object( $t ) ) {
					$data[] = vc_get_term_object( $t );
				}
			}
		}

		return $data;
	}

	public function generate_css() {
		
		extract( $this->atts );
		
		$elements     = array();
		$id = '.' .$this->get_id();
		
		if( isset( $columns_gap ) ) {
			$gap = $columns_gap . 'px';
	
			$elements[ liquid_implode( '%1$s .liquid-blog-grid' ) ] = array(
				'margin-left' => '-' . $gap,
				'margin-right' => '-' . $gap
			);
			
			$elements[ liquid_implode( '%1$s .liquid-blog-grid > div' ) ] = array(
				'padding-left' => $gap,
				'padding-right' => $gap
			);
		}
		if( isset( $bottom_gap ) ) { 
			
			if( 'candy' !== $style ) {
				$elements[ liquid_implode( '%1$s .liquid-blog-grid .liquid-lp' ) ]['margin-bottom']  = $bottom_gap .'px';
			}
			else {
				$elements[ liquid_implode( '%1$s  .liquid-blog-style-candy > .masonry-item:nth-child(2n + 1)' ) ]['padding-top']  = $bottom_gap .'px';
			}
			
		}
		if( isset( $filter_mb ) ) { 
			$elements[ liquid_implode( '%1$s .filter-list' ) ]['margin-bottom']  = $filter_mb .'px';
		} 
		
		if ( !empty( $title_size ) ) {
			$elements[ liquid_implode( '%1$s .liquid-blog-item .liquid-lp-title,%1$s .liquid-lp .liquid-lp-title' ) ]['font-size'] = $title_size;
		}
		if ( !empty( $title_weight ) ) {
			$elements[ liquid_implode( '%1$s .liquid-blog-item .liquid-lp-title,%1$s .liquid-lp .liquid-lp-title' ) ]['font-weight'] = $title_weight . '!important';
		}
		if ( !empty( $title_color ) ) {
			$elements[ liquid_implode( '%1$s .liquid-blog-item .liquid-lp-title,%1$s .liquid-lp .liquid-lp-title' ) ]['color'] = $title_color;
		}
		if ( isset( $title_mt ) && '0' !== $title_mt ) {
			$elements[ liquid_implode( '%1$s .liquid-blog-item .liquid-lp-title,%1$s .liquid-lp .liquid-lp-title' ) ]['margin-top'] = $title_mt . 'px';
		}
		if ( isset( $title_mb ) && '0' !== $title_mb ) {
			$elements[ liquid_implode( '%1$s .liquid-blog-item .liquid-lp-title,%1$s .liquid-lp .liquid-lp-title' ) ]['margin-bottom'] = $title_mb . 'px';
		}
		

		$this->dynamic_css_parser( $id, $elements );

	}

	public function generate_post_css() {
		
		$elements     = array();
		$id           = '.post-' . get_the_ID();
		
		$instapost_color_overlay = get_post_meta( get_the_ID(), 'instagram-post-overlay', true );
		
		//Font options fot the label
		if( $instapost_color_overlay ) {
			$elements[liquid_implode( '%1$s.liquid-lp-sp-block.liquid-lp-sp-instagram:before' )]['background'] = $instapost_color_overlay;
		}

		$this->dynamic_css_parser( $id, $elements );

	}
}
new LD_Blog;