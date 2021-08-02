<?php

/*
 * Header Layout Section
*/
$this->sections[] = array(
	'title'      => esc_html__( 'Select the header', 'ave' ),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'=>'header-template',
			'type' => 'select',
			'title' => esc_html__('Header', 'ave'),
			'subtitle'=> esc_html__('Select a header template for your website', 'ave'),
			'data' => 'post',
			'args' => array( 'post_type' => 'liquid-header', 'posts_per_page' => -1 )
		),
	)
);
