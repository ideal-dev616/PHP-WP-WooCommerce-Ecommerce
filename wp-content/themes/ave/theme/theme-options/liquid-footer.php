<?php
/*
 * Footer Section
*/

$this->sections[] = array(
	'title'  => esc_html__( 'Footer', 'ave' ),
	'icon'   => 'el-icon-photo',
	'fields' => array(
		array(
 			'id'=>'footer-template',
 			'type' => 'select',
 			'title' => esc_html__('Footer', 'ave'),
 			'subtitle'=> esc_html__('Select a footer template for your website.', 'ave'),
 			'data' => 'post',
			'args' => array( 'post_type' => 'liquid-footer', 'posts_per_page' => -1 )
 		)
	)
);
