<?php
/*
 * Page Maintenance
*/

// Hours
$hours = array();
for ($i = 0; $i <= 24; $i++){

	$hour = $i;
	if ($i < 10) {
		$hour = '0'.$i;
	}
	$hours[(string)$hour] = (string)$hour;
}

// Minutes
$minutes = array();
for ($i = 0; $i < 60; $i++){

	$min = $i;
	if ($i < 10) {
		$min = '0'.$i;
	}
	$minutes[(string)$min] = (string)$min;
}

$this->sections[] = array (
	'title'  => esc_html__( 'Maintenance Page', 'ave' ),
	'subsection' => true,
	'fields' => array(

		array(
			'id' => 'page-maintenance-enable',
			'type'	 => 'button_set',
			'title' => esc_html__('Enable Maintenance Mode', 'ave'),
			'subtitle' => esc_html__('If on, the frontend shows maintenance mode page only.', 'ave'),
			'desc' => esc_html__('Only administrator will be able to visit site. If you want to check if maintenance mode is enabled you have to logout.', 'ave'),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default' => 'on'
		),

		array(
			'id' => 'page-maintenance-mode-till',
			'type'	 => 'button_set',
			'title' => esc_html__('Enable Till', 'ave'),
			'subtitle' => esc_html__('If on, the frontend shows maintenance mode page only.', 'ave'),
			'desc' => esc_html__('Only administrator will be able to visit site. If you want to check if maintenance mode is enabled you have to logout.', 'ave'),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default' => 'on'
		),

		array(
			'id'        => 'page-maintenance-mode-till-date',
			'type'      => 'date',
			'title'     => esc_html__('Date (mm/dd/yyyy)', 'ave'),
			'default'   => date('m/d/Y'),
			'required' => array(
				'page-maintenance-mode-till',
				'equals',
				'on'
			)
		),

		array(
			'id'        => 'page-maintenance-mode-till-hour',
			'type'      => 'select',
			'title'     => esc_html__('Hour', 'ave'),
			'options' => $hours,
			'default'   => '00',
			'required' => array(
				'page-maintenance-mode-till',
				'equals',
				'on'
			)
		),

		array(
			'id'        => 'page-maintenance-mode-till-minutes',
			'type'      => 'select',
			'title'     => esc_html__('Minutes', 'ave'),
			'options' => $minutes,
			'default'   => '00',
			'required' => array(
				'page-maintenance-mode-till',
				'equals',
				'on'
			)
		),

		array(
			'id'       => 'page-maintenance-title',
			'type'     => 'text',
			'title'    => esc_html__( 'Page Title', 'ave' ),
			'subtitle' => '',
			'default' => wp_kses_post( __( 'We&#39;ll Be Right Back.', 'ave') ),
		),

		array(
			'id'       => 'page-maintenance-content',
			'type'     => 'editor',
			'title'    => esc_html__( 'Page Content', 'ave' ),
			'subtitle' => '',
			'default' => wp_kses_post( __( '<p>Our team is working hard to be able to back in a couple hours. <br> Thanks for your patience.</p>', 'ave' ) ),
		),

		array(
			'id'       => 'page-maintenance-background-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Background Type', 'ave' ),
			'options' => array(
				'solid'    => esc_html__( 'Solid', 'ave' ),
				'gradient' => esc_html__( 'Gradient', 'ave' ),
				'image'    => esc_html__( 'Image', 'ave' ),
			),
			'default' => 'image'
		),

		array(
			'id'=>'page-maintenance-bar-bg',
			'type' => 'media',
			'url' => true,
			'title' => esc_html__('Background', 'ave'),
			'required' => array(
				'page-maintenance-background-type',
				'equals',
				'image'
			),
		),

		array(
			'id'=>'page-maintenance-bar-solid',
			'type' => 'color',
			'url' => true,
			'title' => esc_html__('Background', 'ave'),
			'required' => array(
				'page-maintenance-background-type',
				'equals',
				'solid'
			),
		),

		array(
			'id'=>'page-maintenance-bar-gradient',
			'type' => 'gradient',
			'url' => true,
			'title' => esc_html__('Background', 'ave'),
			'required' => array(
				'page-maintenance-background-type',
				'equals',
				'gradient'
			),
		),

		array(
			'id' => 'page-maintenance-identities',
			'type' => 'repeater',
			'group_values' => true,
			'title' => esc_html__('Social identities', 'ave'),
			'fields' => array(

				array(
					'id'       => 'title',
					'type'     => 'text',
					'title'    => esc_html__( 'Title', 'ave' )
				),

				array(
					'id'       => 'url',
					'type'     => 'text',
					'title'    => esc_html__( 'Url', 'ave' )
				),
			)
		)
	)
);
