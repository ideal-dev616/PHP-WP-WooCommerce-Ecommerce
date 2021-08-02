<?php
/*
 * Preheader Section
*/

$this->sections[] = array(
	'title' => esc_html__('Preheader', 'ave'),
	'desc' => esc_html__('Change the preheader section configuration.', 'ave'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id' => 'preheader-enable-switch',
			'type' => 'switch', 
			'title' => esc_html__('Enable preheader', 'ave'),
			'subtitle' => esc_html__('If on, this layout part will be displayed.', 'ave'),
			'default' => 1,
		),
		
	), // #fields
);
