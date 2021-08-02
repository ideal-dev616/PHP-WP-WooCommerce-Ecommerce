<?php
/**
 * The Helper
 * Contains all the helping functions
 *
 *
 * Table of Content
 *
 * 1. WordPress Helpers
 * 2. Markup Helpers
 * 3. Theme Options/Meta Helpers
 * 4. Array opperations
 */

/**
 * Main helper functions.
 *
 * @class LD_Helper
*/
class LD_Helper {

	/**
	 * Hold an instance of LD_Helper class.
	 * @var LD_Helper
	 */
	protected static $instance = null;

	/**
	 * Main LD_Helper instance.
	 *
	 * @return LD_Helper - Main instance.
	 */
	public static function instance() {

		if(null == self::$instance) {
			self::$instance = new LD_Helper();
		}

		return self::$instance;
	}




	// 1. WordPress Helpers -----------------------------------------------

	/**
	 * [ajax_url description]
	 * @method ajax_url
	 * @return [type]   [description]
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}

	public function get_param( $id, $old ) {

		$id = sanitize_key( $id );

		if( ! isset( liquid_addons()->params[$id] ) ) {
			_doing_it_wrong( 'get_param', wp_kses( sprintf( __( 'ID: <strong>%s</strong>, didn\'t exists in the system', 'ave-core' ), $id ), array( 'strong' => array() ) ), null );
		}

		$new = array_merge( liquid_addons()->params[$id], $old );
		unset( $new['id'] );

		return $new;
	}

	/**
	 * [add_params description]
	 * @method add_params
	 * @param  [type]     $params [description]
	 */
	public function add_params( $params = array() ) {

		foreach( $params as $id => $param ) {
			$this->add_param( $id, $param );
		}
	}

	/**
	 * [add_param description]
	 * @method add_param
	 * @param  [type]    $id    [description]
	 * @param  [type]    $param [description]
	 */
	public function add_param( $id, $param ) {

		$id = sanitize_key( $id );

		if( isset( liquid_addons()->params[$id] ) ) {
			_doing_it_wrong( 'add_param', wp_kses( sprintf( __( 'ID: <strong>%s</strong>, already exists in the system', 'ave-core' ), $id ), array( 'strong' => array() ) ), null );
		}

		liquid_addons()->params[$id] = $param;
	}

	/**
	 * [remove_param description]
	 * @method remove_param
	 * @param  [type]       $id [description]
	 * @return [type]           [description]
	 */
	public function remove_param( $id ) {

		$id = sanitize_key( $id );

		if( ! isset( liquid_addons()->params[$id] ) ) {
			_doing_it_wrong( 'remove_param', wp_kses( sprintf( __( 'ID: <strong>%s</strong>, didn\'t exists in the system', 'ave-core' ), $id ), array( 'strong' => array() ) ), null );
		}

		unset( liquid_addons()->params[$id] );
	}




	// 2. Markup Helpers -----------------------------------------------

	/**
	 * [html_attributes description]
	 *
	 * @method html_attributes
	 * @param  array           $attributes [description]
	 *
	 * @return [type]                [description]
	 */
	public function html_attributes( $attributes = array(), $prefix = '' ) {

		// If empty return false
		if ( empty( $attributes ) ) {
			return false;
		}

		$options = false;
		if( isset( $attributes['data-plugin-options'] ) ) {
			$options = $attributes['data-plugin-options'];
			unset( $attributes['data-plugin-options'] );
		}

		$out = '';
		foreach ( $attributes as $key => $value ) {

			if( ! $value ) {
				continue;
			}

			$key = $prefix . $key;

			if( true === $value ) {
				$value = 'true';
			}

			$out .= sprintf( ' %s="%s"', esc_html( $key ), esc_attr( $value ) );
		}

		if( $options ) {
			$out .= sprintf( ' data-plugin-options=\'%s\'', $options );
		}

		return $out;
	}

	public function attr( $context, $attributes = array() ) {
		echo $this->get_attr( $context, $attributes );
	}

	/**
	 * [get_attr description]
	 * @method get_attr
	 * @param  [type] $context    [description]
	 * @param  array  $attributes [description]
	 * @return [type]             [description]
	 */
	public function get_attr( $context, $attributes = array() ) {

		$defaults = array(
			'class' => sanitize_html_class( $context )
		);

		$attributes = wp_parse_args( $attributes, $defaults );
		$attributes = apply_filters( "liquid_attr_{$context}", $attributes, $context );

		$output = $this->html_attributes( $attributes );
	    $output = apply_filters( "liquid_attr_{$context}_output", $output, $attributes, $context );

	    return trim( $output );
	}

	/**
	 * Get attribute value from $atts array
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	public function get_att( $atts, $key ) {

		if ( isset( $atts[$key] ) ) {
			if ( strstr( $atts[$key],'``') ) {
				return str_replace( '``', '"', $atts[$key] );
			}

			return $atts[$key];
		}

		return '';
	}

	/**
	 * Get custom term values array
	 * @param type $type
	 * @return type
	 */
	public function get_custom_term_values($type) {

		$items = array();
		$terms = get_terms($type, array('orderby' => 'name'));
		if (is_array($terms) && !is_wp_error($terms)) {
			foreach ($terms as $term) {
				$items[$term -> name] = $term -> slug;
			}
		}
		return $items;
	}

	/**
	 * Get custom term values array
	 * @param type $type
	 * @return type
	 */
	public function get_custom_term_id_values( $type ) {

		$items = array();
		$terms = get_terms( $type, array('orderby' => 'name' ) );
		if ( is_array( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$items[$term -> name] = $term -> term_id;
			}
		}
		return $items;
	}

	/**
	 * [sanitize_html_classes description]
	 * @method sanitize_html_classes
	 * @return (mixed: string / $fallback ) [description]
	 */
	public function sanitize_html_classes( $class, $fallback = null ) {

		// Make it a string
		if( is_array( $class ) ) {
			$class = join( ' ', $class );
		}

		// Explode it, if it's a string
		if ( is_string( $class ) ) {
			$class = explode( ' ', $class );
		}

		$class = array_filter( $class );

		if ( is_array( $class ) && !empty( $class ) ) {
			$class = array_map( 'sanitize_html_class', $class );
			return implode( ' ', $class );
		}
		else {
			return sanitize_html_class( $class, $fallback );
		}
	}

	/**
	 *
	 * Set WPAUTOP for shortcode output
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 */
	public function do_the_content( $content, $autop = true ) {

		if ( $autop ) {
			$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
		}

		return do_shortcode( shortcode_unautop( $content ) );
	}

	/**
	 *
	 * Get paged function
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 */
	public function get_paged() {

		if( get_query_var( 'paged' ) ) {
			return get_query_var( 'paged' );
		}

		if( get_query_var( 'page' ) ) {
			return get_query_var( 'page' );
		}

		return 1;
	}

	/**
	 * Check if the string contains the given value.
	 *
	 * @param  string	$needle   The sub-string to search for
	 * @param  string	$haystack The string to search
	 *
	 * @return bool
	 */
    public function str_contains( $needle, $haystack ) {
        return strpos( $haystack, $needle ) !== false;
    }

    /**
    * Get the term data from database using Slug
    *
    * @param $term
    *
    * @return array
    */
    public function get_term_object( $term ) {
    	$vc_taxonomies_types = vc_taxonomies_types();
    	return array(
    		'label' => $term->name,
    		'value' => $term->slug,
    		'group_id' => $term->taxonomy,
    		'group' => isset( $vc_taxonomies_types[ $term->taxonomy ], $vc_taxonomies_types[ $term->taxonomy ]->labels, $vc_taxonomies_types[ $term->taxonomy ]->labels->name ) ? $vc_taxonomies_types[ $term->taxonomy ]->labels->name : __( 'Taxonomies', 'ave-core' ),
    		);
    }

    /**
    * The following function originally located inside vc-grid-functions.php file and we have modifed it to render the field using slug insted of ids 
    *
    * @param $term
    * @param $post_type
    *
    * @return array|bool
    */
    public function vc_autocomplete_taxonomies_field_render( $term, $post_type ) {
    	$vc_taxonomies_types = vc_taxonomies_types();
    	$_term = get_term_by( 'slug', $term['value'], $post_type );
    	$terms = get_terms( array_keys( $vc_taxonomies_types ), array(
    		'include' => array( $_term->term_id ),
    		'hide_empty' => false,
    	) );
    	$data = false;
    	if ( is_array( $terms ) && 1 === count( $terms ) ) {
    		$term = $terms[0];
    		$data = $this->get_term_object( $term );
    	}
    	return $data;
    }

    /**
    * Get terms data and save their names and slugs for future usage, The following functions will return vaild array inside vc edid form only
    *
    * @param $term_type examples nav_menu, post_tag, category
    * @param $hide_empty bool param to include any empty term with the returned array 
    *
    * @return array|null
    */
    public function get_terms_data_for_vc( $term_type = null, $hide_empty = false ) {

    	if(!isset($term_type)){
    		return; //Safty first
    	}

    	$custom_terms = array();
    	if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
    		$terms = get_terms( $term_type, array( 'hide_empty' => $hide_empty ) );
    		if ( is_array( $terms ) && ! empty( $terms ) ) {
    			foreach ( $terms as $single_term ) {
    				if ( is_object( $single_term ) && isset( $single_term->name, $single_term->slug ) ) {
    					$custom_terms[ $single_term->name ] = $single_term->slug;
    				}
    			}
    		}
    	}
    	return $custom_terms;
    }

    /**
    * Turn terms slugs into ids
    *
    * @param $terms
    * @param $type
    *
    * @return array
    */
    public function terms_slugs_to_ids($terms, $type) {
    	if(!is_array($terms)) {
    		$terms = explode(',', $terms);
    	}
    	$ids = array();

    	if(is_array($terms) && $terms[0] != '') {
    		foreach ($terms as $term) {
    			$_term = get_term_by( 'slug', $term, $type );
    			if(isset($_term->term_id)) {
    				$ids[] = $_term->term_id;
    			}
    		}
    	}
    	return $ids;
    }


    /**
    * Add support to for both ids or slugs to the any query
    *
    * @param $taxonomies
    * @param $post_type
    *
    * @return array|null
    */
    public function terms_are_ids_or_slugs( $taxonomies, $post_type ) {
    	if( $taxonomies == '' || !isset($taxonomies) ) {
    		return;
    	}

    	$old_tax = explode(',', $taxonomies);
    	$new_taxs = '';
		if( isset($old_tax[0]) && is_numeric($old_tax[0]) ) {
			$new_taxs = $old_tax;
		} else {
			$new_taxs = ld_helper()->terms_slugs_to_ids($taxonomies, $post_type );
		}

		return $new_taxs;

    }

    public function smart_category_filter( $type, $attr, $selected, $return = 'include' ) {
    	$query_cats = explode( ',', $attr );
    	$dont_add = array();
    	if( $query_cats[0] != '' ) {
			$cats = get_terms( $type );
			foreach ($cats as $cat) {
				if(!in_array($cat->slug, $query_cats)) {
					$dont_add[] = $cat->term_id;
				}
			}
		}

		if($dont_add[0] != '') {
			foreach ($dont_add as $term) {
				if(in_array($term->term_id, $selected)) {
					array_diff($selected, array($term->term_id));

				}
			}
		}
		if($return == 'include') {
			return $selected;
		} elseif( $return == 'exclude' ) {
			return $dont_add;
		}
		
    }

}

/**
 * Main instance of LD_Helper.
 *
 * Returns the main instance of LD_Helper to prevent the need to use globals.
 *
 * @return LD_Helper
 */
function ld_helper() {
	return LD_Helper::instance();
}
