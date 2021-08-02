<?php
/**
* Liquid Shortcode Class
*/

if( !defined( 'ABSPATH' ) ) 
	exit; // Exit if accessed directly

if( ! class_exists( 'LD_Shortcode' ) ) :

/**
* LD_Shortcode
*/
class LD_Shortcode extends WPBakeryShortCode {

	/**
	 * Shortcode tag.
	 * @var string
	 */
	public $slug = '';

	/**
	 * Title for human reading.
	 * @var string
	 */
	public $title = '';

	/**
	 * List of shortcode attributes. Array which holds your shortcode params, these params will be editable in shortcode settings page.
	 * @var array
	 */
	public $params = array();

	/**
	 * Category which best suites to describe functionality of this shortcode.
	 * @var string
	 */
	public $category = null;

	/**
	 * Constructor
	 */
	public function __construct() {
		// validate
		if( ! isset( $this->slug ) && empty( $this->slug ) ) {
			wp_die( esc_html__( 'Please define slug', 'ave-core' ), esc_html__( 'Variable Missing', 'ave-core' ) );
		}

		// Add shortcode
		if ( ! shortcode_exists( $this->slug ) ) {
			add_shortcode( $this->slug, array(
				&$this,
				'render',
			) );
		}

		// Prepare shortcode data
		$this->prepare_params();

		// Prepare VC data
		$this->set_config();

		// Map shortcode to VC
		vc_map( $this->settings );
		
		add_action( 'liquid_shortcodes_styles', array( $this, 'styles' ) );

	}

	/**
	 * [set_config description]
	 * @method set_config
	 */
	protected function set_config() {

		$keys = array(
			'description', 'icon', 'is_container', 'js_view', 'php_class_name', 'show_settings_on_create', 'custom_markup', 'deprecated',
			'default_content', 'js_view', 'allowed_container_element', 'admin_enqueue_js', 'as_parent', 'as_child'
		);

		// Required
		$shortcode = array(
			'base' => $this->slug,
			'name' => $this->title,
			'params' => $this->params,
			'category' => ! empty( $this->category ) ? $this->category : esc_html__( 'LiquidThemes', 'ave-core' )
		);

		foreach( $keys as $key ) {

			switch( $key ) {
				case 'is_container':

					if( ! empty( $this->is_container ) ) {
						$shortcode['is_container'] = $this->is_container;
						$shortcode['js_view'] = 'VcColumnView';
					}
					else {
						$shortcode['php_class_name'] = get_class( $this );
					}

					break;

				default:
					if( ! empty( $this->{$key} ) ) {
						$shortcode[ $key ] = $this->{$key};
					}
					break;
			}
		}

		$this->settings = $shortcode;
		$this->shortcode = $this->settings['base'];
	}

	/**
	 * [get_params description]
	 * @method get_params
	 * @return [type]     [description]
	 */
	public function get_params() {

	}
	
	
	/**
	 * [enqueque_styles description]
	 * @method enqueque_styles
	 * @return [type]           [description]
	 */
	public function styles( ) {

		if( empty( $this->styles ) ) {
			return;
		}
		
		global $post;

		$enabled_header = liquid_helper()->get_option( 'header-enable-switch', 'raw', '' );
		// Check if header is enabled
		if( 'off' !== $enabled_header ) {
			$header_id = liquid_get_custom_header_id();
			$header = get_post( $header_id );
			if( has_shortcode( $header->post_content, $this->slug ) ) {
				foreach( (array)$this->styles as $handle ) {
					wp_enqueue_style( $handle );
				}
			}
		}
		
		//Check content for any sc
		if( '' !== get_post()->post_content ) {
			if( !is_404() && !is_search() && !is_archive() && has_shortcode( $post->post_content, $this->slug ) ) {
				foreach( (array)$this->styles as $handle ) {
					wp_enqueue_style( $handle );
				}
			}		
		}

		
		$enabled_footer = liquid_helper()->get_option( 'footer-enable-switch', 'raw', '' );
		// Check if footer is enabled
		if( 'off' !== $enabled_footer ) {
			$footer_id = liquid_get_custom_footer_id();
			$footer = get_post( $footer_id );
			if( has_shortcode( $footer->post_content, $this->slug ) ) {
				foreach( (array)$this->styles as $handle ) {
					wp_enqueue_style( $handle );
				}
			}
		}
	}
	
	
	/**
	 * [enqueque_scripts description]
	 * @method enqueque_scripts
	 * @return [type]           [description]
	 */
	protected function scripts( $args = array() ) {

		if( empty( $this->scripts ) ) {
			return;
		}

        $handles = [];

		if( ! empty( $args ) ) {			
			foreach( (array)$this->scripts as $handle ) {
				if( in_array( $handle, $args ) ) {
					wp_enqueue_script( $handle );
                    $handles[] = $handle;
				}
			}
		} else {
			foreach( (array)$this->scripts as $handle ) {
				wp_enqueue_script( $handle );
                $handles[] = $handle;
			}
		}

        if ( $post_ID = get_the_ID() ) {
            $post_scripts = get_post_meta( $post_ID, '_post_scripts', true );
            $post_scripts = is_array($post_scripts) ? $post_scripts : [];

            update_post_meta( $post_ID, '_post_scripts', array_unique( array_merge( $handles, $post_scripts ) ) );
        }
		
		wp_dequeue_script( 'liquid-theme' );
		wp_enqueue_script( 'liquid-theme' );
	}

	/**
	 * [prepare_params description]
	 * @method prepare_params
	 * @return [type]         [description]
	 */
	public function prepare_params() {

		// Get params to process
		$this->get_params();

		// Process now!
		foreach( $this->params as $id => &$param ) {

			if( ! isset( $param['type'] ) && isset( $param['id'] ) && ! empty( $param['id'] ) ) {
				$this->params[$id] = ld_helper()->get_param( $param['id'], $param );
			}
			elseif( 'param_group' === $param['type'] ) {

				foreach( $param['params'] as $iid => &$iparam ) {

					if( ! isset( $iparam['type'] ) && isset( $iparam['id'] ) && ! empty( $iparam['id'] ) ) {
						$param['params'][$iid] = ld_helper()->get_param( $iparam['id'], $iparam );
					}
				}
			}

			// setData
			if( ! empty( $param['data'] ) && empty( $param['value'] ) ) {
				if ( empty( $param['args'] ) ) {
                    $param['args'] = array();
                }

				$param['value'] = $this->get_wordpress_data( $param['data'], $param['args'] );
			}

			// Set description
			if( empty( $param['description'] ) && isset( $param['heading'] ) && 'subheading' != $param['type'] ) {
				$prefix = esc_html__( 'Select ', 'ave-core' );

				if( in_array( $param['type'], array( 'textarea', 'textfield', 'textarea_html' ) ) ) {
					$prefix = esc_html__( 'Enter  ', 'ave-core' );
				}

				$param['description'] = $prefix . strtolower( $param['heading'] ) . '.';
			}
		}
	}

	/**
	 * [output description]
	 * @method output
	 * @return [type] [description]
	 */
	public function render( $atts, $content = '' ) {


		$atts = $this->prepareAtts( $atts );
		$atts = vc_map_get_attributes( $this->slug, $atts );
		$atts = $this->before_output( $atts, $content );
		$atts['_id'] = uniqid( $this->slug .'_' );

		// Locate template file
		$located = $this->locate_template( $atts );

		// If no file throw error
		if ( !$located ) {
			trigger_error( sprintf( esc_html__( 'Template file is missing for `%s` shortcode. Make sure you have `%s` file in your theme folder or default folder.', 'ave-core' ), $this->title, 'view.php' ) );
			return;
		}

		$this->atts = $atts;
		$this->atts['content'] = $content;

		// Generate Output
		ob_start();

		include $located;

		return ob_get_clean();
	}

	/**
	 * [before_output description]
	 * @method before_output
	 * @param  [type]        $atts    [description]
	 * @param  [type]        $content [description]
	 * @return [type]                 [description]
	 */
	public function before_output( $atts, &$content ) {
		return $atts;
	}

	/**
	 * Locate the shortcode view file
	 * @method locate_template
	 * @param  array 	$atts
	 * @return string	return located file
	 *
	 * Shortcode file looking order
	 *
	 * Theme Directory
	 * {slug}-{atts[template]}.php
	 * {slug}-view.php
	 *
	 * Plugin Directory
	 * {atts[template]}.php
	 * view.php
	 */
	private function locate_template( $atts ) {

		$located = $template_name = false;

		// Check template in theme directory
		if( isset( $atts['template'] ) && ! empty( $atts['template'] ) ) {
			$template_name = "{$this->slug}-{$atts['template']}.php";
			$user_template = vc_shortcodes_theme_templates_dir( $template_name );

			if ( is_file( $user_template ) ) {
				$located = $user_template;
			}
		}

		if( ! $located ) {
			$template_name = "{$this->slug}-view.php";
			$user_template = vc_shortcodes_theme_templates_dir( $template_name );
			if ( is_file( $user_template ) ) {
				$located = $user_template;
			}
		}

		// Check in shortcode directory
		if( ! $located ) {

			$template_name = false;
			$path = $this->get_path();

			if( isset( $atts['template'] ) && ! empty( $atts['template'] ) ) {
				$template_name = "{$atts['template']}.php";
			}

			if( $template_name && file_exists( $path . $template_name ) ) {
				$located = $path . $template_name;
			}
			elseif( file_exists( $path . 'view.php' ) ) {
				$located = $path . 'view.php';
			}
		}

		return $located;
	}

	// Params Helpers -------------------------------------------------------
	//

	// Build the string of values in an Array
	protected function get_fonts_data( $fontsString ) {

		// Font data Extraction
		$googleFontsParam = new Vc_Google_Fonts();
		$fieldSettings = array();
		$fontsData = strlen( $fontsString ) > 0 ? $googleFontsParam->_vc_google_fonts_parse_attributes( $fieldSettings, $fontsString ) : '';
		return $fontsData;

	}

	// Build the inline style starting from the data
	protected function google_fonts_style( $fontsData ) {

        // Inline styles
		$fontFamily = explode( ':', $fontsData['values']['font_family'] );
		$styles['font-family'] = $fontFamily[0] . '!important';
		$fontStyles = explode( ':', $fontsData['values']['font_style'] );
		$styles['font-weight'] = $fontStyles[1] . '!important';
		$styles['font-style'] = $fontStyles[2] . '!important';

		/*
			$inline_style = '';
			foreach( $styles as $attribute ){
			    $inline_style .= $attribute.'; ';
			}
		*/

		return $styles;

    }

	// Enqueue right google font from Googleapis
	protected function enqueue_google_fonts( $fontsData ) {

		// Get extra subsets for settings (latin/cyrillic/etc)
		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
		    $subsets = '&subset=' . implode( ',', $settings );
		} else {
		    $subsets = '';
		}

		// We also need to enqueue font from googleapis
		if ( isset( $fontsData['values']['font_family'] ) ) {
		    wp_enqueue_style(
		        'vc_google_fonts_' . vc_build_safe_css_class( $fontsData['values']['font_family'] ),
		        '//fonts.googleapis.com/css?family=' . $fontsData['values']['font_family'] . $subsets
		    );
		}

	}

	/**
	 * [add_extras description]
	 * @method add_extras
	 */
	public function add_extras() {

		$this->params = array_merge( $this->params, array(

			// ID
			array(
				'type'        => 'textfield',
				'param_name'  => 'el_id',
				'heading'     => esc_html__( 'Element ID', 'ave-core' ),
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add unique id and then refer to it in your css file.', 'ave-core' ),
				'group'       => esc_html__( 'Extras', 'ave-core' )
			),

			// CSS
			array(
				'type'        => 'textfield',
				'param_name'  => 'el_class',
				'heading'     => esc_html__( 'Extra class name', 'ave-core' ),
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ave-core' ),
				'group'       => esc_html__( 'Extras', 'ave-core' )
			)
		));
	}

	// Helpers ------------------------------------------------------------
	//

	/**
	 * [get_id description]
	 * @method get_id
	 * @param  array  $atts [description]
	 * @return [type]       [description]
	 */
	protected function get_id( $atts = array(), $custom = true ) {

		$atts = empty( $atts ) ? $this->atts : $atts;

		if( !empty( $atts['el_id'] ) ) {
			return $atts['el_id'];
		}

		if( $custom && !empty( $atts['_id'] ) ) {
			return $atts['_id'];
		}
	}

	/**
	 * [get_animation description]
	 * @method get_animation
	 * @return [type]        [description]
	 */
	protected function get_animation() {

		$output = '';
		$css_animation = isset( $this->atts['css_animation'] ) ? $this->atts['css_animation'] : '';
		if ( '' !== $css_animation && 'none' !== $css_animation ) {
			wp_enqueue_script( 'waypoints' );
			wp_enqueue_style( 'animate-css' );
			$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation . ' ' . $css_animation;
		}

		return $output;
	}

	/**
	 * [get_path description]
	 * @method get_path
	 * @return [type]   [description]
	 */
	protected function get_path() {
		$rc = new ReflectionClass( get_class( $this ) );
		return trailingslashit( dirname( $rc->getFilename() ) );
	}
	
	/**
	 * [get_shadow_css description]
	 * @method get_shadow_css
	 * @return [type]   [description]
	 */
	protected function get_shadow_css( $atts = array() ) {
		
		if( empty( $atts ) ){
			return;
		}
		
		$css_arr = array();
		$res_css = $shadow_css = '';
		
		
		foreach( $atts as $att ) {
			$css_arr[] = $this->create_box_shadow_property( $att );
		}
		$shadow_css = join( ', ', $css_arr );
	
		return $shadow_css;
	
	}
	
	/**
	 * [create_box_shadow_property description]
	 * @method create_box_shadow_property
	 * @return [type]   [description]
	 */
	
	protected function create_box_shadow_property( $param = array() ) {
		
		$param = array_filter( $param );
		if( empty( $param ) ) {
			return;
		}
		
		$res = '';
	
		$res .= ! empty( $param['inset'] ) ? $param['inset'] . ' ' : '';
		$res .= isset( $param['x_offset'] ) ? $param['x_offset'] . ' ' : '0px ';
		$res .= isset( $param['y_offset'] ) ? $param['y_offset'] . ' ' : '0px ';
		$res .= isset( $param['blur_radius'] ) ? $param['blur_radius'] . ' ' : '0px ';		
		$res .= isset( $param['spread_radius'] ) ? $param['spread_radius'] . ' ' : '0px ';
		$res .= ! empty( $param['shadow_color'] ) ? $param['shadow_color'] : '#000';
		
		return $res;
	}

	/**
	 * [dynamic_css_parser description]
	 * @method dynamic_css_parser
	 * @param  [type]             $id       [description]
	 * @param  [type]             $elements [description]
	 * @return [type]                       [description]
	 */
	public function dynamic_css_parser( $id, $elements ) {
		
		$final_css = $responsive_css = '';
		foreach ( $elements as $selector => $style_array ) {

				$css = '';
				foreach ( $style_array as $property => $value ) {

					if( empty( $value ) ) {
						continue;
					}
					
					if( 'media' === $selector && ! empty( $value ) ) {
						$responsive_css .= $value;
						continue;
					}

					if ( is_array( $value ) ) {
						foreach ( $value as $sub_property => $sub_value ) {

							if( empty( $sub_value ) ) {
								continue;
							}

							if ( false !== strpos( $sub_value, 'linear-gradient' ) ) {
								$css .= ( is_string($sub_property) ? $sub_property : $property ) . ':' . '-webkit-' . $sub_value . ';';
							}

							$css .= ( is_string($sub_property) ? $sub_property : $property ) . ':' . $sub_value . ';';
						}
					} else {

						if ( false !== strpos( $value, 'linear-gradient' ) ) {
							$css .= $property . ':' . '-webkit-' . $value . ';';
						}

						$css .= $property . ':' . $value . ';';
					}
				}

			$final_css .= $css ? sprintf( $selector, $id ) . '{' . $css . '}' : '';
			$final_css .= $responsive_css ? $responsive_css : '';
		}
		
		$check = apply_filters( 'liquid_dinamic_css_output', true );
		
		if( $final_css && $check ) {
			printf( '<style>%s</style>', $final_css );
		}
	
	}

	/**
	 * [get_wordpress_data description]
	 * @method get_wordpress_data
	 * @param  boolean            $type [description]
	 * @param  array              $args [description]
	 * @return [type]                   [description]
	 */
	public function get_wordpress_data( $type = false, $args = array() ) {

		$data = $argsKey = '';

		if( empty ( $type ) ) {
			return $data;
		}

		foreach ( $args as $key => $value ) {
			$argsKey .= ! is_array( $value ) ? $value . '-' : implode( '-', $value );
		}

		if ( empty ( $data ) && isset ( $this->wp_data[ $type . $argsKey ] ) ) {
			return $this->wp_data[ $type . $argsKey ];
		}

		$data = array(
			esc_html__( 'Select option', 'ave-core' ) => ''
		);
		if ( 'categories' == $type || 'category' == $type ) {
            $cats = get_categories( $args );
            if ( ! empty ( $cats ) ) {
                foreach ( $cats as $cat ) {
                    $data[ $cat->name ] = $cat->term_id;
                }
            }
        }
		else if ( 'menus' == $type || 'menu' == $type ) {
            $menus = wp_get_nav_menus( $args );
            if ( ! empty ( $menus ) ) {
                foreach ( $menus as $item ) {
                    $data[ $item->name ] = $item->term_id;
                }
            }
        }
		else if ( 'pages' == $type || 'page' == $type ) {
            if ( ! isset ( $args['posts_per_page'] ) ) {
                $args['posts_per_page'] = 20;
            }
            $pages = get_pages( $args );
            if ( ! empty ( $pages ) ) {
                foreach ( $pages as $page ) {
                    $data[ $page->post_title ] = $page->ID;
                }
            }
        }
		else if ( 'posts' == $type || 'post' == $type ) {
			if ( ! isset ( $args['posts_per_page'] ) ) {
                $args['posts_per_page'] = 20;
            }
            $posts = get_posts( $args );
            if ( ! empty ( $posts ) ) {
                foreach ( $posts as $post ) {
                    $data[ $post->post_title ] = $post->ID;
                }
            }
        }
		else if ( 'terms' == $type || 'term' == $type ) {
            $taxonomies = $args['taxonomies'];
            unset ( $args['taxonomies'] );
            $terms = get_terms( $taxonomies, $args ); // this will get nothing
            if ( ! empty ( $terms ) && ! is_a( $terms, 'WP_Error' ) ) {
                foreach ( $terms as $term ) {
                    $data[ $term->name ] = $term->term_id;
                }
            }
        }
		else if ( 'taxonomy' == $type || 'taxonomies' == $type ) {
            $taxonomies = get_taxonomies( $args );
            if ( ! empty ( $taxonomies ) ) {
                foreach ( $taxonomies as $key => $taxonomy ) {
                    $data[ $taxonomy ] = $key;
                }
            }
        }
		else if ( 'post_type' == $type || 'post_types' == $type ) {
            global $wp_post_types;
            $defaults   = array(
                'public'              => true,
                'exclude_from_search' => false,
            );
            $args       = wp_parse_args( $args, $defaults );
            $output     = 'names';
            $operator   = 'and';
            $post_types = get_post_types( $args, $output, $operator );
            ksort( $post_types );
            foreach ( $post_types as $name => $title ) {
                if ( isset ( $wp_post_types[ $name ]->labels->menu_name ) ) {
                    $data[ $wp_post_types[ $name ]->labels->menu_name ] = $name;
                } else {
                    $data[ ucfirst( $name ) ] = $name;
                }
            }
        }
		else if ( 'tags' == $type || 'tag' == $type ) {
            $tags = get_tags( $args );
            if ( ! empty ( $tags ) ) {
                foreach ( $tags as $tag ) {
                    $data[ $tag->name ] = $tag->term_id;
                }
            }

        }
		else if ( 'menu_location' == $type || 'menu_locations' == $type ) {
            global $_wp_registered_nav_menus;
            foreach ( $_wp_registered_nav_menus as $k => $v ) {
                $data[ $v ] = $k;
            }
        }
		else if ( 'sidebars' == $type || 'sidebar' == $type ) {
            /** @global array $wp_registered_sidebars */
            global $wp_registered_sidebars;
            foreach ( $wp_registered_sidebars as $key => $value ) {
                $data[ $value['name'] ] = $key;
            }
        }
		else if ( 'callback' == $type ) {
            if ( ! is_array( $args ) ) {
                $args = array( $args );
            }
            $data = call_user_func( $args[0] );
        }

		$this->wp_data[ $type . $argsKey ] = $data;

        return $data;
    }
}

endif;

if( class_exists( 'WPBakeryShortCodesContainer' ) && ! class_exists( 'LD_ShortcodeContainer' ) ) :

/**
 * Shortcode COntainer class
 */
class LD_ShortcodeContainer extends WPBakeryShortCodesContainer {

	/**
	 * [$controls_css_settings description]
	 * @var string
	 */
	protected $controls_css_settings = 'out-tc vc_controls-content-widget';

	/**
	 * [$controls_list description]
	 * @var array
	 */
	protected $controls_list = array( 'add', 'edit', 'clone', 'delete' );

	/**
	 * @param $width
	 * @param $i
	 *
	 * @return string
	 */
	public function mainHtmlBlockParams( $width, $i ) {
		$sortable = ( vc_user_access_check_shortcode_all( $this->shortcode ) ? 'wpb_sortable' : $this->nonDraggableClass );

		return 'data-element_type="' . $this->settings['base'] . '" class="liquid-content-holder wpb_' . $this->settings['base'] . ' ' . $sortable . ' wpb_content_holder vc_shortcodes_container"' . $this->customAdminBlockParams();
	}

	/**
	 * [getColumnControls description]
	 * @method getColumnControls
	 * @param  string            $controls     [description]
	 * @param  string            $extended_css [description]
	 * @return [type]                          [description]
	 */
	public function getColumnControls( $controls = 'full', $extended_css = '' ) {

		$column_controls = $this->getColumnControlsModular();

		$column_controls = str_replace( 'vc_element-move"', 'vc_element-move" data-vc-control="move"', $column_controls );
		$column_controls = str_replace( 'vc_edit"', 'vc_edit" data-vc-control="add"', $column_controls );
		$column_controls = str_replace( 'vc_control-btn-edit"', 'vc_control-btn-edit" data-vc-control="edit"', $column_controls );
		$column_controls = str_replace( 'vc_control-btn-clone"', 'vc_control-btn-clone" data-vc-control="clone"', $column_controls );
		$column_controls = str_replace( 'vc_control-btn-delete"', 'vc_control-btn-delete" data-vc-control="delete"', $column_controls );

		return $column_controls;
	}

	/**
	 * Content admin layout
	 * @param  array $atts
	 * @param  string $content
	 * @return string shortcodes container html layout
	 */
	public function contentAdmin( $atts, $content = null ) {

		$width = $el_class = '';

		$atts = shortcode_atts( $this->predefined_atts, $atts );
		extract( $atts );
		$this->atts = $atts;
		$label_class = ( isset( $this->settings['label_class'] ) ) ? $this->settings['label_class'] : 'info';
		$output = '';

		for ( $i = 0; $i < count( $width ); $i ++ ) {

			$output .= '<div ' . $this->mainHtmlBlockParams( $width, $i ) . '>';

				if ( $this->backened_editor_prepend_controls ) {
					$output .= $this->getColumnControls( 'full', 'vc_controls-out-tc vc_controls-content-widget' );
				}

				$output .= '<div class="wpb_element_wrapper">';

					$output .= '<div ' . $this->containerHtmlBlockParams( $width, $i ) . '>';

						$output .= do_shortcode( shortcode_unautop( $content ) );

					$output .= '</div>';

					$output .= '<div class="liquid-param-holder">';

						$output .= $this->paramsHtmlHolders( $atts );

					$output .= '</div>';

				$output .= '</div>';

			$output .= '</div>';
		}

		return $output;
	}
}

endif;
