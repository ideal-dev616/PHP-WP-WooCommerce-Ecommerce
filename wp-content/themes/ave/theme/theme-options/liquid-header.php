<?php
/*
 * Header Section
*/

$this->sections[] = array(
	'title'  => esc_html__('Header', 'ave'),
	'icon'   => 'el el-home'
);

include_once( get_template_directory() . '/theme/theme-options/liquid-header-layout.php' );
include_once( get_template_directory() . '/theme/theme-options/liquid-header-mobile-nav.php' );
include_once( get_template_directory() . '/theme/theme-options/liquid-header-title-wrapper.php' );
