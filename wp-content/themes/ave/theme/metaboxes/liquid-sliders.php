<?php
/*
 * Slider Section
*/

$sections[] = array(
	'post_types' => array( 'post', 'page' ),
	'title' => esc_html__('Sliders', 'ave'),
	'icon' => 'el-icon-adjust-alt',
	'fields' => array(

		array(
 			'id'=>'slider-type',
 			'type' => 'select',
 			'title' => esc_html__('Slider Type', 'ave'),
 			'subtitle'=> esc_html__('Select the type of slider that displays.', 'ave'),
			'options' => array(
				'no' => esc_html__( 'No Slider', 'ave' ),
				'liquid' => esc_html__( 'liquid Slider', 'ave' ),
				'rev' => esc_html__( 'Revolution Slider', 'ave' )
			),
			'default' => 'no'
		),

		array(
 			'id'=>'slider-liquid',
 			'type' => 'select',
 			'title' => esc_html__('Select liquid Slider', 'ave'),
 			'subtitle'=> esc_html__('Select the unique name of the slider.', 'ave'),
			'options' => array(
				'no' => esc_html__( 'Select a slider', 'ave' )
			),
			'required' => array(
				'slider-type',
				'equals',
				'liquid'
			),
			'default' => 'no'
		),

		array(
 			'id'=>'slider-rev',
 			'type' => 'select',
 			'title' => esc_html__('Select Revolution Slider', 'ave'),
 			'subtitle'=> esc_html__('Select the unique name of the slider.', 'ave'),
			'options' => array(
				'no' => esc_html__( 'Select a slider', 'ave' )
			),
			'required' => array(
				'slider-type',
				'equals',
				'rev'
			),
			'default' => 'no'
		),

		array(
 			'id'=>'slider-position',
 			'type' => 'button_set',
 			'title' => esc_html__('Slider Position', 'ave'),
 			'subtitle'=> esc_html__('Select if the slider shows below or above the header.', 'ave'),
			'options' => array(
				'default' => esc_html__( 'Default', 'ave' ),
				'below' => esc_html__( 'Below', 'ave' ),
				'above' => esc_html__( 'Above', 'ave' )
			),
			'required' => array(
				'slider-type',
				'not',
				'no'
			),
			'default' => 'default'
		)
	)
);
