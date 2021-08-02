<?php
/**
* LiquidThemes WooCommerce init
*
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
 * Load WooCommerce compatibility files.
 */
require get_template_directory() . '/liquid/vendors/woocommerce/hooks.php';
require get_template_directory() . '/liquid/vendors/woocommerce/functions.php';
require get_template_directory() . '/liquid/vendors/woocommerce/template-tags.php';
require get_template_directory() . '/liquid/vendors/woocommerce/options.php';
require get_template_directory() . '/liquid/vendors/woocommerce/metaboxes.php';