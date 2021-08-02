<?php
/*
 * Page 404
*/

$this->sections[] = array (
	'title'  => esc_html__( '404 Page', 'ave' ),
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'error-404-header-enable-switch',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Header', 'ave' ),
			'subtitle' => esc_html__( 'If on, this layout part will be displayed.', 'ave' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default' => 'off'
		),
		array(
			'id'     => 'error-404-enable-particles',
			'type'	 => 'button_set',
			'title' => esc_html__('Particles', 'ave'),
			'subtitle' => esc_html__('Switch on to display the particles.', 'ave'),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default' => 'on'
		),
		array(
			'id'       => 'error-404-title',
			'type'     => 'text',
			'title'    => esc_html__( 'Title', 'ave' ),
			'subtitle' => '',
			'default' => '404'
		),
		array(
			'id'       => 'error-404-subtitle',
			'type'     => 'text',
			'title'    => esc_html__( 'Heading', 'ave' ),
			'subtitle' => '',
			'default' => 'Looks like you are lost.'
		),
		array(
			'id'       => 'error-404-content',
			'type'     => 'editor',
			'title'    => esc_html__( 'Content', 'ave' ),
			'subtitle' => '',
			'default' => '<p>We can’t seem to find the page you’re looking for.</p>'
		),
		array(
			'id' => 'error-404-enable-btn',
			'type'	 => 'button_set',
			'title' => esc_html__('Button', 'ave'),
			'subtitle' => esc_html__('Switch on to display the "back to home" button.', 'ave'),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' )
			),
			'default' => 'on'
		),

		array(
			'id'       => 'error-404-btn-title',
			'type'     => 'text',
			'title'    => esc_html__( 'Button Title', 'ave' ),
			'subtitle' => '',
			'default' => 'Back to home',
			'required' => array(
				'error-404-enable-btn',
				'equals',
				'on'
			)
		),
	)
);