<?php
/*
 * Megamenu Fields
 *
*/

$sections[] = array(
	'post_types' => array( 'liquid-mega-menu' ),
	'title'      => esc_html__( 'MegaMenu Design Options', 'ave' ),
	'icon'       => 'el-icon-cog',
	'fields'     => array(
		array(
			'id'      => 'megamenu-fullwidth',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'MegaMenu Fullwidth?', 'ave' ),
			'description' => esc_html__( 'Stretch the background of megamenu. To make the content fullwidth please update row options from the contents.', 'ave' ),
			'options' => array(
				'no'  => esc_html__( 'No', 'ave' ),
				'yes' => esc_html__( 'Yes', 'ave' ),
			),
			'default' => 'no',
		),
	)
);