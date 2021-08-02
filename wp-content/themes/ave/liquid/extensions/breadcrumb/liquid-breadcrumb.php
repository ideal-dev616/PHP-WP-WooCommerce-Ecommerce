<?php
/**
 * Breadcrumb Trail - A breadcrumb menu script for WordPress.
 */

/**
 * [liquid_breadcrumb description]
 * @method liquid_breadcrumb
 * @param  array            $args [description]
 * @return [type]                 [description]
 */
function liquid_breadcrumb( $args = array() ) {

	$breadcrumb = new Liquid_Breadcrumb( $args );

	return $breadcrumb->trail();
}

/**
 * Creates a breadcrumbs menu for the site based on the current page that's being viewed by the user.
 *
 * @since  0.6.0
 * @access public
 */
class Liquid_Breadcrumb {

	/**
	 * [$items description]
	 * @var array
	 */
	public $items = array();

	/**
	 * [$args description]
	 * @var array
	 */
	public $args = array();

	/**
	 * [$labels description]
	 * @var array
	 */
	public $labels = array();

	/**
	 * [$post_taxonomy description]
	 * @var array
	 */
	public $post_taxonomy = array();

	/**
	 * [__toString description]
	 * @method __toString
	 * @return string     [description]
	 */
	public function __toString() {
		return $this->trail();
	}

	/**
	 * [__construct description]
	 * @method __construct
	 * @param  array       $args [description]
	 */
	public function __construct( $args = array() ) {

		$defaults = array(
			'container'       => 'nav',
			'before'          => '',
			'after'           => '',
			'classes'         => '',
			'show_on_front'   => true,
			'network'         => false,
			'show_title'      => true,
			'show_browse'     => false,
			'labels'          => array(),
			'post_taxonomy'   => array(),
			'echo'            => true
		);

		$this->args = wp_parse_args( $args, $defaults );

		$this->set_labels();
		$this->set_post_taxonomy();
		$this->add_items();
	}

	/* ====== Public Methods ====== */

	/**
	 * [trail description]
	 * @method trail
	 * @return [type] [description]
	 */
	public function trail() {

		$breadcrumb    = '';
		$item_count    = count( $this->items );
		$item_position = 0;

		if ( 0 < $item_count ) {

			if ( true === $this->args['show_browse'] )
				$breadcrumb .= sprintf( '<h2 class="trail-browse">%s</h2>', $this->labels['browse'] );

			$breadcrumb .= '<ol class="breadcrumb '.$this->args['classes'].'" itemscope itemtype="http://schema.org/BreadcrumbList">';

			$breadcrumb .= sprintf( '<meta name="numberOfItems" content="%d" />', absint( $item_count ) );
			$breadcrumb .= '<meta name="itemListOrder" content="Ascending" />';

			foreach ( $this->items as $item ) {

				++$item_position;

				preg_match( '/(<a.*?>)(.*?)(<\/a>)/i', $item, $matches );

				$item = !empty( $matches ) ? sprintf( '%s<span itemprop="name">%s</span>%s', $matches[1], $matches[2], $matches[3] ) : sprintf( '<span itemprop="name">%s</span>', $item );

				$item_class = 'breadcrumb-item';

				if ( $item_count === $item_position )
					$item_class .= ' active';

				$attributes = 'itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="' . $item_class . '"';

				$meta = sprintf( '<meta itemprop="position" content="%s" />', absint( $item_position ) );

				$breadcrumb .= sprintf( '<li %s>%s%s</li>', $attributes, $item, $meta );
			}

			$breadcrumb .= '</ol>';

			$breadcrumb = sprintf(
				'<%1$s role="navigation" aria-label="%2$s" class="breadcrumbs" itemprop="breadcrumb">%3$s%4$s%5$s</%1$s>',
				tag_escape( $this->args['container'] ),
				esc_attr( $this->labels['aria_label'] ),
				$this->args['before'],
				$breadcrumb,
				$this->args['after']
			);
		}

		if ( false === $this->args['echo'] )
			return $breadcrumb;

		echo wp_kses_post( $breadcrumb );
	}

	/* ====== Protected Methods ====== */

	/**
	 * [set_labels description]
	 * @method set_labels
	 */
	protected function set_labels() {

		$defaults = array(
			'browse'              => esc_html__( 'Browse:',                               'ave' ),
			'aria_label'          => esc_attr_x( 'Breadcrumbs', 'breadcrumbs aria label', 'ave' ),
			'home'                => esc_html__( 'Home',                                  'ave' ),
			'error_404'           => esc_html__( '404 Not Found',                         'ave' ),
			'archives'            => esc_html__( 'Archives',                              'ave' ),
			'search'              => esc_html__( 'Search results for &#8220;%s&#8221;',   'ave' ),
			'paged'               => esc_html__( 'Page %s',                               'ave' ),
			'archive_minute'      => esc_html__( 'Minute %s',                             'ave' ),
			'archive_week'        => esc_html__( 'Week %s',                               'ave' ),

			'archive_minute_hour' => '%s',
			'archive_hour'        => '%s',
			'archive_day'         => '%s',
			'archive_month'       => '%s',
			'archive_year'        => '%s',
		);

		$this->labels = wp_parse_args( $this->args['labels'], $defaults );
	}

	/**
	 * [set_post_taxonomy description]
	 * @method set_post_taxonomy
	 */
	protected function set_post_taxonomy() {

		$defaults = array();

		if ( '%postname%' === trim( get_option( 'permalink_structure' ), '/' ) )
			$defaults['post'] = 'category';

		$this->post_taxonomy = wp_parse_args( $this->args['post_taxonomy'], $defaults );
	}

	/**
	 * [add_items description]
	 * @method add_items
	 */
	protected function add_items() {

		if ( is_front_page() ) {
			$this->add_front_page_items();
		}

		else {

			$this->add_network_home_link();
			$this->add_site_home_link();

			if ( is_home() ) {
				$this->add_posts_page_items();
			}

			elseif ( is_singular() ) {
				$this->add_singular_items();
			}

			elseif ( is_archive() ) {

				if ( is_post_type_archive() )
					$this->add_post_type_archive_items();

				elseif ( is_category() || is_tag() || is_tax() )
					$this->add_term_archive_items();

				elseif ( is_author() )
					$this->add_user_archive_items();

				elseif ( get_query_var( 'minute' ) && get_query_var( 'hour' ) )
					$this->add_minute_hour_archive_items();

				elseif ( get_query_var( 'minute' ) )
					$this->add_minute_archive_items();

				elseif ( get_query_var( 'hour' ) )
					$this->add_hour_archive_items();

				elseif ( is_day() )
					$this->add_day_archive_items();

				elseif ( get_query_var( 'w' ) )
					$this->add_week_archive_items();

				elseif ( is_month() )
					$this->add_month_archive_items();

				elseif ( is_year() )
					$this->add_year_archive_items();

				else
					$this->add_default_archive_items();
			}

			elseif ( is_search() ) {
				$this->add_search_items();
			}

			elseif ( is_404() ) {
				$this->add_404_items();
			}
		}

		$this->add_paged_items();
	}

	/**
	 * [add_rewrite_front_items description]
	 * @method add_rewrite_front_items
	 */
	protected function add_rewrite_front_items() {
		global $wp_rewrite;

		if ( $wp_rewrite->front )
			$this->add_path_parents( $wp_rewrite->front );
	}

	/**
	 * [add_paged_items description]
	 * @method add_paged_items
	 */
	protected function add_paged_items() {

		if ( is_singular() && 1 < get_query_var( 'page' ) && true === $this->args['show_title'] )
			$this->items[] = sprintf( $this->labels['paged'], number_format_i18n( absint( get_query_var( 'page' ) ) ) );

		elseif ( is_paged() && true === $this->args['show_title'] )
			$this->items[] = sprintf( $this->labels['paged'], number_format_i18n( absint( get_query_var( 'paged' ) ) ) );
	}

	/**
	 * [add_network_home_link description]
	 * @method add_network_home_link
	 */
	protected function add_network_home_link() {

		if ( is_multisite() && !is_main_site() && true === $this->args['network'] )
			$this->items[] = sprintf( '<a href="%s" rel="home">%s</a>', esc_url( network_home_url() ), $this->labels['home'] );
	}

	/**
	 * [add_site_home_link description]
	 * @method add_site_home_link
	 */
	protected function add_site_home_link() {

		$network = is_multisite() && !is_main_site() && true === $this->args['network'];
		$label   = $network ? get_bloginfo( 'name' ) : $this->labels['home'];
		$rel     = $network ? '' : ' rel="home"';

		$this->items[] = sprintf( '<a href="%s"%s>%s</a>', esc_url( home_url() ), $rel, $label );
	}

	/**
	 * [add_front_page_items description]
	 * @method add_front_page_items
	 */
	protected function add_front_page_items() {

		if ( true === $this->args['show_on_front'] || is_paged() || ( is_singular() && 1 < get_query_var( 'page' ) ) ) {

			$this->add_network_home_link();

			if ( is_paged() )
				$this->add_site_home_link();

			elseif ( true === $this->args['show_title'] )
				$this->items[] = is_multisite() && true === $this->args['network'] ? get_bloginfo( 'name' ) : $this->labels['home'];
		}
	}

	/**
	 * [add_posts_page_items description]
	 * @method add_posts_page_items
	 */
	protected function add_posts_page_items() {

		$post_id = get_queried_object_id();
		$post    = get_post( $post_id );

		if ( 0 < $post->post_parent )
			$this->add_post_parents( $post->post_parent );

		$title = get_the_title( $post_id );

		if ( is_paged() )
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $post_id ) ), $title );

		elseif ( $title && true === $this->args['show_title'] )
			$this->items[] = $title;
	}

	/**
	 * [add_singular_items description]
	 * @method add_singular_items
	 */
	protected function add_singular_items() {

		$post    = get_queried_object();
		$post_id = get_queried_object_id();

		if ( 0 < $post->post_parent )
			$this->add_post_parents( $post->post_parent );

		else
			$this->add_post_hierarchy( $post_id );

		if ( !empty( $this->post_taxonomy[ $post->post_type ] ) )
			$this->add_post_terms( $post_id, $this->post_taxonomy[ $post->post_type ] );

		if ( $post_title = single_post_title( '', false ) ) {

			if ( 1 < get_query_var( 'page' ) || is_paged() )
				$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $post_id ) ), $post_title );

			elseif ( true === $this->args['show_title'] )
				$this->items[] = $post_title;
		}
	}

	/**
	 * [add_term_archive_items description]
	 * @method add_term_archive_items
	 */
	protected function add_term_archive_items() {
		global $wp_rewrite;

		$term           = get_queried_object();
		$taxonomy       = get_taxonomy( $term->taxonomy );
		$done_post_type = false;

		if ( false !== $taxonomy->rewrite ) {

			if ( $taxonomy->rewrite['with_front'] && $wp_rewrite->front )
				$this->add_rewrite_front_items();

			$this->add_path_parents( $taxonomy->rewrite['slug'] );

			if ( $taxonomy->rewrite['slug'] ) {

				$slug = trim( $taxonomy->rewrite['slug'], '/' );

				$matches = explode( '/', $slug );

				if ( isset( $matches ) ) {

					$matches = array_reverse( $matches );

					foreach ( $matches as $match ) {

						$slug = $match;

						$post_types = $this->get_post_types_by_slug( $match );

						if ( !empty( $post_types ) ) {

							$post_type_object = $post_types[0];

							$label = !empty( $post_type_object->labels->archive_title ) ? $post_type_object->labels->archive_title : $post_type_object->labels->name;

							$label = apply_filters( 'post_type_archive_title', $label, $post_type_object->name );

							$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $post_type_object->name ) ), $label );

							$done_post_type = true;

							break;
						}
					}
				}
			}
		}

		if ( false === $done_post_type && 1 === count( $taxonomy->object_type ) && post_type_exists( $taxonomy->object_type[0] ) ) {

			if ( 'post' === $taxonomy->object_type[0] ) {
				$post_id = get_option( 'page_for_posts' );

				if ( 'posts' !== get_option( 'show_on_front' ) && 0 < $post_id )
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $post_id ) ), get_the_title( $post_id ) );

			} else {
				$post_type_object = get_post_type_object( $taxonomy->object_type[0] );

				$label = !empty( $post_type_object->labels->archive_title ) ? $post_type_object->labels->archive_title : $post_type_object->labels->name;

				$label = apply_filters( 'post_type_archive_title', $label, $post_type_object->name );

				$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $post_type_object->name ) ), $label );
			}
		}

		if ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent )
			$this->add_term_parents( $term->parent, $term->taxonomy );

		if ( is_paged() )
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $term, $term->taxonomy ) ), single_term_title( '', false ) );

		elseif ( true === $this->args['show_title'] )
			$this->items[] = single_term_title( '', false );
	}

	/**
	 * [add_post_type_archive_items description]
	 * @method add_post_type_archive_items
	 */
	protected function add_post_type_archive_items() {

		$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

		if ( false !== $post_type_object->rewrite ) {

			if ( $post_type_object->rewrite['with_front'] )
				$this->add_rewrite_front_items();

			if ( !empty( $post_type_object->rewrite['slug'] ) )
				$this->add_path_parents( $post_type_object->rewrite['slug'] );
		}

		if ( is_paged() )
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $post_type_object->name ) ), post_type_archive_title( '', false ) );

		elseif ( true === $this->args['show_title'] )
			$this->items[] = post_type_archive_title( '', false );
	}

	/**
	 * [add_user_archive_items description]
	 * @method add_user_archive_items
	 */
	protected function add_user_archive_items() {
		global $wp_rewrite;

		$this->add_rewrite_front_items();

		$user_id = get_query_var( 'author' );

		if ( !empty( $wp_rewrite->author_base ) )
			$this->add_path_parents( $wp_rewrite->author_base );

		if ( is_paged() )
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_author_posts_url( $user_id ) ), get_the_author_meta( 'display_name', $user_id ) );

		elseif ( true === $this->args['show_title'] )
			$this->items[] = get_the_author_meta( 'display_name', $user_id );
	}

	/**
	 * [add_minute_hour_archive_items description]
	 * @method add_minute_hour_archive_items
	 */
	protected function add_minute_hour_archive_items() {

		$this->add_rewrite_front_items();

		if ( true === $this->args['show_title'] )
			$this->items[] = sprintf( $this->labels['archive_minute_hour'], get_the_time( esc_html_x( 'g:i a', 'minute and hour archives time format', 'ave' ) ) );
	}

	/**
	 * [add_minute_archive_items description]
	 * @method add_minute_archive_items
	 */
	protected function add_minute_archive_items() {

		$this->add_rewrite_front_items();

		if ( true === $this->args['show_title'] )
			$this->items[] = sprintf( $this->labels['archive_minute'], get_the_time( esc_html_x( 'i', 'minute archives time format', 'ave' ) ) );
	}

	/**
	 * [add_hour_archive_items description]
	 * @method add_hour_archive_items
	 */
	protected function add_hour_archive_items() {

		$this->add_rewrite_front_items();

		if ( true === $this->args['show_title'] )
			$this->items[] = sprintf( $this->labels['archive_hour'], get_the_time( esc_html_x( 'g a', 'hour archives time format', 'ave' ) ) );
	}

	/**
	 * [add_day_archive_items description]
	 * @method add_day_archive_items
	 */
	protected function add_day_archive_items() {

		$this->add_rewrite_front_items();

		$year  = sprintf( $this->labels['archive_year'],  get_the_time( esc_html_x( 'Y', 'yearly archives date format',  'ave' ) ) );
		$month = sprintf( $this->labels['archive_month'], get_the_time( esc_html_x( 'F', 'monthly archives date format', 'ave' ) ) );
		$day   = sprintf( $this->labels['archive_day'],   get_the_time( esc_html_x( 'j', 'daily archives date format',   'ave' ) ) );

		$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $year );
		$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), $month );

		// Add the day item.
		if ( is_paged() )
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_day_link( get_the_time( 'Y' ) ), get_the_time( 'm' ), get_the_time( 'd' ) ), $day );

		elseif ( true === $this->args['show_title'] )
			$this->items[] = $day;
	}

	/**
	 * [add_week_archive_items description]
	 * @method add_week_archive_items
	 */
	protected function add_week_archive_items() {

		$this->add_rewrite_front_items();

		$year = sprintf( $this->labels['archive_year'],  get_the_time( esc_html_x( 'Y', 'yearly archives date format', 'ave' ) ) );
		$week = sprintf( $this->labels['archive_week'],  get_the_time( esc_html_x( 'W', 'weekly archives date format', 'ave' ) ) );

		$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $year );

		if ( is_paged() )
			$this->items[] = esc_url( get_archives_link( add_query_arg( array( 'm' => get_the_time( 'Y' ), 'w' => get_the_time( 'W' ) ), home_url() ), $week, false ) );

		elseif ( true === $this->args['show_title'] )
			$this->items[] = $week;
	}

	/**
	 * [add_month_archive_items description]
	 * @method add_month_archive_items
	 */
	protected function add_month_archive_items() {

		$this->add_rewrite_front_items();

		$year  = sprintf( $this->labels['archive_year'],  get_the_time( esc_html_x( 'Y', 'yearly archives date format',  'ave' ) ) );
		$month = sprintf( $this->labels['archive_month'], get_the_time( esc_html_x( 'F', 'monthly archives date format', 'ave' ) ) );

		$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $year );

		if ( is_paged() )
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), $month );

		elseif ( true === $this->args['show_title'] )
			$this->items[] = $month;
	}

	/**
	 * [add_year_archive_items description]
	 * @method add_year_archive_items
	 */
	protected function add_year_archive_items() {

		$this->add_rewrite_front_items();

		$year  = sprintf( $this->labels['archive_year'],  get_the_time( esc_html_x( 'Y', 'yearly archives date format',  'ave' ) ) );

		if ( is_paged() )
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y' ) ) ), $year );

		elseif ( true === $this->args['show_title'] )
			$this->items[] = $year;
	}

	/**
	 * [add_default_archive_items description]
	 * @method add_default_archive_items
	 */
	protected function add_default_archive_items() {

		if ( is_date() || is_time() )
			$this->add_rewrite_front_items();

		if ( true === $this->args['show_title'] )
			$this->items[] = $this->labels['archives'];
	}

	/**
	 * [add_search_items description]
	 * @method add_search_items
	 */
	protected function add_search_items() {

		if ( is_paged() )
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_search_link() ), sprintf( $this->labels['search'], get_search_query() ) );

		elseif ( true === $this->args['show_title'] )
			$this->items[] = sprintf( $this->labels['search'], get_search_query() );
	}

	/**
	 * [add_404_items description]
	 * @method add_404_items
	 */
	protected function add_404_items() {

		if ( true === $this->args['show_title'] )
			$this->items[] = $this->labels['error_404'];
	}

	/**
	 * [add_post_parents description]
	 * @method add_post_parents
	 * @param  [type]           $post_id [description]
	 */
	protected function add_post_parents( $post_id ) {
		$parents = array();

		while ( $post_id ) {

			$post = get_post( $post_id );

			if ( 'page' == $post->post_type && 'page' == get_option( 'show_on_front' ) && $post_id == get_option( 'page_on_front' ) )
				break;

			$parents[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $post_id ) ), get_the_title( $post_id ) );

			if ( 0 >= $post->post_parent )
				break;

			$post_id = $post->post_parent;
		}

		$this->add_post_hierarchy( $post_id );

		if ( !empty( $this->post_taxonomy[ $post->post_type ] ) )
			$this->add_post_terms( $post_id, $this->post_taxonomy[ $post->post_type ] );

		$this->items = array_merge( $this->items, array_reverse( $parents ) );
	}

	/**
	 * [add_post_hierarchy description]
	 * @method add_post_hierarchy
	 * @param  [type]             $post_id [description]
	 */
	protected function add_post_hierarchy( $post_id ) {

		$post_type        = get_post_type( $post_id );
		$post_type_object = get_post_type_object( $post_type );

		if ( 'post' === $post_type ) {

			$this->add_rewrite_front_items();

			$this->map_rewrite_tags( $post_id, get_option( 'permalink_structure' ) );
		}

		elseif ( false !== $post_type_object->rewrite ) {

			if ( $post_type_object->rewrite['with_front'] )
				$this->add_rewrite_front_items();

			if ( !empty( $post_type_object->rewrite['slug'] ) )
				$this->add_path_parents( $post_type_object->rewrite['slug'] );
		}

		if ( $post_type_object->has_archive ) {

			$label = !empty( $post_type_object->labels->archive_title ) ? $post_type_object->labels->archive_title : $post_type_object->labels->name;

			$label = apply_filters( 'post_type_archive_title', $label, $post_type_object->name );

			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( $post_type ) ), $label );
		}
	}

	/**
	 * [get_post_types_by_slug description]
	 * @method get_post_types_by_slug
	 * @param  [type]                 $slug [description]
	 * @return [type]                       [description]
	 */
	protected function get_post_types_by_slug( $slug ) {

		$return = array();

		$post_types = get_post_types( array(), 'objects' );

		foreach ( $post_types as $type ) {

			if ( $slug === $type->has_archive || ( true === $type->has_archive && $slug === $type->rewrite['slug'] ) )
				$return[] = $type;
		}

		return $return;
	}

	/**
	 * [add_post_terms description]
	 * @method add_post_terms
	 * @param  [type]         $post_id  [description]
	 * @param  [type]         $taxonomy [description]
	 */
	protected function add_post_terms( $post_id, $taxonomy ) {

		$post_type = get_post_type( $post_id );

		$terms = get_the_terms( $post_id, $taxonomy );

		if ( $terms && ! is_wp_error( $terms ) ) {
			
			
			if( function_exists( 'wp_list_sort' ) ) {
			    $terms = wp_list_sort( $terms, 'term_id', 'ASC' );  // order by term_id ASC
			} else {
			    usort( $terms, '_usort_terms_by_ID' ); // order by term_id ASC
			}

			$term = get_term( $terms[0], $taxonomy );
			
			
			
			if ( 0 < $term->parent )
				$this->add_term_parents( $term->parent, $taxonomy );

			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $term, $taxonomy ) ), $term->name );
		}
	}

	/**
	 * [add_path_parents description]
	 * @method add_path_parents
	 * @param  [type]           $path [description]
	 */
	function add_path_parents( $path ) {

		$path = trim( $path, '/' );

		if ( empty( $path ) )
			return;

		$post = get_page_by_path( $path );

		if ( !empty( $post ) ) {
			$this->add_post_parents( $post->ID );
		}

		elseif ( is_null( $post ) ) {

			$path = trim( $path, '/' );
			preg_match_all( "/\/.*?\z/", $path, $matches );

			if ( isset( $matches ) ) {

				$matches = array_reverse( $matches );

				foreach ( $matches as $match ) {

					if ( isset( $match[0] ) ) {

						$path = str_replace( $match[0], '', $path );
						$post = get_page_by_path( trim( $path, '/' ) );

						if ( !empty( $post ) && 0 < $post->ID ) {
							$this->add_post_parents( $post->ID );
							break;
						}
					}
				}
			}
		}
	}

	/**
	 * [add_term_parents description]
	 * @method add_term_parents
	 * @param  [type]           $term_id  [description]
	 * @param  [type]           $taxonomy [description]
	 */
	function add_term_parents( $term_id, $taxonomy ) {

		$parents = array();

		while ( $term_id ) {

			$term = get_term( $term_id, $taxonomy );

			$parents[] = sprintf( '<a href="%s">%s</a>', esc_url( get_term_link( $term, $taxonomy ) ), $term->name );

			$term_id = $term->parent;
		}

		if ( !empty( $parents ) )
			$this->items = array_merge( $this->items, $parents );
	}

	/**
	 * [map_rewrite_tags description]
	 * @method map_rewrite_tags
	 * @param  [type]           $post_id [description]
	 * @param  [type]           $path    [description]
	 * @return [type]                    [description]
	 */
	protected function map_rewrite_tags( $post_id, $path ) {

		$post = get_post( $post_id );

		if ( 'post' !== $post->post_type )
			return;

		$path = trim( $path, '/' );

		$matches = explode( '/', $path );

		if ( is_array( $matches ) ) {

			foreach ( $matches as $match ) {

				$tag = trim( $match, '/' );

				if ( '%year%' == $tag )
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_year_link( get_the_time( 'Y', $post_id ) ) ), sprintf( $this->labels['archive_year'], get_the_time( esc_html_x( 'Y', 'yearly archives date format',  'ave' ) ) ) );

				elseif ( '%monthnum%' == $tag )
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_month_link( get_the_time( 'Y', $post_id ), get_the_time( 'm', $post_id ) ) ), sprintf( $this->labels['archive_month'], get_the_time( esc_html_x( 'F', 'monthly archives date format', 'ave' ) ) ) );

				elseif ( '%day%' == $tag )
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_day_link( get_the_time( 'Y', $post_id ), get_the_time( 'm', $post_id ), get_the_time( 'd', $post_id ) ) ), sprintf( $this->labels['archive_day'], get_the_time( esc_html_x( 'j', 'daily archives date format', 'ave' ) ) ) );

				elseif ( '%author%' == $tag )
					$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_author_posts_url( $post->post_author ) ), get_the_author_meta( 'display_name', $post->post_author ) );

				elseif ( '%category%' == $tag ) {

					$this->post_taxonomy[ $post->post_type ] = false;

					$this->add_post_terms( $post_id, 'category' );
				}
			}
		}
	}
}
