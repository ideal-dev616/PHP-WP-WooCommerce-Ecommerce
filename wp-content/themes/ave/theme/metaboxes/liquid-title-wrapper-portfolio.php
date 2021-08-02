<?php
/*
 * Portfolio Title Wrapper Section
 *
 * Available options on $section array:
 * separate_box (boolean) - separate metabox is created if true
 * box_title - title for separate metabox
 * title - section title
 * desc - section description
 * icon - section icon
 * fields - fields, @see https://docs.reduxframework.com/ for details
*/

$sections[] = array(
	'post_types' => array(),
	'title'      => esc_html__( 'Title Wrapper', 'ave' ),
	'icon'       => 'el-icon-cog',
	'fields'     => array(

		array(
			'id'       => 'title-bar-enable',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Title Wrapper', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				''     => esc_html__( 'Default', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default'  => '',
		),

		array(
			'id'    => 'title-bar-heading',
			'type'  => 'text',
			'title' => esc_html__( 'Custom Title', 'ave' ),
			'desc'  => esc_html__( 'If empty, will display default page/post title', 'ave' ),
		),
		
		array(
			'id'    => 'title-bar-heading-empty',
			'type'  => 'button_set',
			'title' => esc_html__( 'No heading', 'ave' ),
			'desc'  => esc_html__( 'Hide the default/custom page/post title in titlebar', 'ave' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),				
			),
			'default'  => 'off',
		),

		'title-bar-typography' => array(
			'id'          => 'title-bar-typography',
			'title'       => esc_html__( 'Title Bar Heading Typography', 'ave' ),
			'subtitle' => esc_html__( 'These settings control the typography for the titlebar heading', 'ave' ),
			'type'        => 'typography',
			'text-transform' => true,
			'letter-spacing' => true,
			'text-align'     => true,
			'compiler'       => true,
			'units'          => '%',
		),

		array(
			'id'       => 'title-bar-weight',
			'type'     => 'select',
			'title'    => esc_html__( 'Heading font Weight', 'ave' ),
			'options'  => array(
				''                => esc_html__( 'Default', 'ave' ),
				'weight-light'    => esc_html__( 'Light', 'ave' ),
				'weight-normal'   => esc_html__( 'Normal', 'ave' ),
				'weight-medium'   => esc_html__( 'Medium', 'ave' ),
				'weight-semibold' => esc_html__( 'Semibold', 'ave' ),
				'weight-bold'     => esc_html__( 'Bold', 'ave' ),
			),
		),

		array(
			'id'    => 'title-bar-subheading',
			'type'  => 'text',
			'title' => esc_html__( 'Sub-Heading', 'ave' )
		),

		'title-bar-subheading-typography' => array(
			'id'          => 'title-bar-subheading-typography',
			'title'       => esc_html__( 'Title Bar Subheading Typography', 'ave' ),
			'subtitle' => esc_html__( 'These settings control the typography for the titlebar subheading', 'ave' ),
			'type'        => 'typography',
			'text-transform' => true,
			'letter-spacing' => true,
			'text-align'     => true,
			'compiler'       => true,
			'units'          => '%',
		),

		array(
			'id'      => 'title-bar-content',
			'type'    => 'editor',
			'title'   => esc_html__( 'Content', 'ave' ),
			'default' => ''
		),
		
		array(
			'id'      => 'title-bar-content-style',
			'type'	  => 'select',
			'title'   => esc_html__( 'Content style', 'ave' ),
			'options' => array(
				''           => 'Default',
				'split'      => 'Split',
				'overlay'    => 'Overlay',
				'bottom'     => 'Bottom',
				'bottom-bar' => 'Bottom Bar'
			),
		),
		array(
			'id'       => 'title-bar-position',
			'type'     => 'select',
			'title'    => esc_html__( 'Title Bar content Vertical align', 'ave' ),
			'options'  => array(
				''                => esc_html__( 'Default', 'ave' ),
				'titlebar--content-top'     => esc_html__( 'Top', 'ave' ),
				'titlebar--content-bottom'     => esc_html__( 'Bottom', 'ave' ),
			),
			'required' => array(
				array( 'title-bar-content-style', '!=', 'overlay' ),
				array( 'title-bar-content-style', '!=', 'bottom-bar' ),
			),
		),

		array(
			'id'      => 'title-bar-nav',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Enable Portfolio Navigation', 'ave' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				''    => esc_html__( 'Default', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' ),
			),
			'default' => ''			
		),

		array(
			'id'      => 'title-bar-breadcrumb',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Enable Breadcrumbs', 'ave' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				''    => esc_html__( 'Default', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' ),
			),
			'default' => ''	
		),

		array(
			'id'     => 'title-bar-breadcrumb-style',
			'type'	 => 'select',
			'title'  => esc_html__( 'Breadcrumb style', 'ave' ),
			'options' => array(
				''              => 'Default',
				'parallelogram' => 'Parallelogram',
			),
			'required' => array(
				'title-bar-breadcrumb',
				'!=',
				'off'
			),
			'default' => 'off'
		),

		array(
			'id'       => 'title-bar-size',
			'type'     => 'select',
			'title'    => esc_html__( 'Title size', 'ave' ),
			'options'  => array(
				''      => 'Default',
				'xxxsm' => 'xxxSmall',
				'xxsm'  => 'xxSmall',
				'xsm'   => 'xSmall',
				'sm'    => 'Small',
				'md'    => 'Medium',
				'lg'    => 'Large',
				'xlg'   => 'xLarge'
			),
			'default'   => 'xlg'
		),

		array(
			'id'       => 'title-bar-height',
			'type'     => 'select',
			'title'    => esc_html__( 'Title bar height', 'ave' ),
			'options'  => array(
				''      => 'Default',
				'np'    => 'No Paddings',
				'full'  => 'Full Height',
				'xxxsm' => 'xxxSmall',
				'xxsm'  => 'xxSmall',
				'xsm'   => 'xSmall',
				'sm'    => 'Small',
				'md'    => 'Medium',
				'md2'   => 'Medium2',
				'lg'    => 'Large',
				'lg2'   => 'Large2',
				'xlg'   => 'xLarge',
				'xxlg'  => 'xxLarge',
				'xxxlg' => 'xxxLarge'
			)
		),

		array(
			'id'       => 'title-bar-scheme',
			'type'     => 'select',
			'title'    => esc_html__( 'Color scheme', 'ave' ),
			'options'  => array(
				'text-dark'  => 'Dark',
				'text-white' => 'Light'
			),
			'default'  => 'xlg'
		),

		array(
			'id'       => 'title-bar-align',
			'type'     => 'select',
			'title'    => esc_html__( 'Alignment', 'ave' ),
			'options'  => array(
				'text-left'   => 'Left',
				'text-center' => 'Center',
				'text-right'  => 'Right'
			),
			'default'  => 'xlg'
		),

		array(
			'id'       => 'title-background-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Background Type', 'ave' ),
			'options'  => array(
				'solid'    => 'Solid',
				'gradient' => 'Gradient',
				'image'    => 'Image'
			)
		),

		array(
			'id'       => 'title-bar-bg',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Background', 'ave' ),
			'required' => array(
				'title-background-type',
				'equals',
				'image'
			),
		),
		
		array(
			'id'       => 'title-bar-bg-attachment',
			'type'     => 'select',
			'title'    => esc_html__( 'Background Attachment', 'ave' ),
			'options'  => array(
				'scroll'  => esc_html__( 'Default', 'ave' ),
				'fixed'   => esc_html__( 'Fixed', 'ave' ),
				'inherit' => esc_html__( 'Inherit', 'ave' ),
			),
			'required' => array(
				'title-background-type',
				'equals',
				'image'
			),
		),
		
		array(
			'id'       => 'title-bar-parallax',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Parallax?', 'ave' ),
			'required' => array(
				'title-background-type',
				'equals',
				'image'
			),
			'options' => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'off',
		),

		array(
			'id'       => 'title-bar-solid',
			'type'     => 'color',
			'url'      => true,
			'title'    => esc_html__( 'Background', 'ave' ),
			'required' => array(
				'title-background-type',
				'equals',
				'solid'
			),
		),

		array(
			'id'       => 'title-bar-gradient',
			'type'     => 'gradient',
			'url'      => true,
			'title'    => esc_html__( 'Background', 'ave' ),
			'required' => array(
				'title-background-type',
				'equals',
				'gradient'
			),
		),
		
		array(
			'id'      => 'title-bar-overlay',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Enable Overlay', 'ave' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'ave' ),
				''     => esc_html__( 'Default', 'ave'  ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => '',
		),
		
		array(
			'id'       => 'title-bar-overlay-background-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Overlay Type', 'ave' ),
			'options' => array(
				'color'    => 'Color',
				'gradient' => 'Gradient',
			),
			'required' => array(
				'title-bar-overlay',
				'!=',
				'off'
			),
		),

		array(
			'id'    => 'title-bar-overlay-solid',
			'type'  => 'color_rgba',
			'title' => esc_html__( 'Overlay Color', 'ave' ),
			'required' => array(
				'title-bar-overlay-background-type',
				'equals',
				'color'
			)
		),

		array(
			'id'       => 'title-bar-overlay-gradient',
			'type'     => 'gradient',
			'title'    => esc_html__( 'Overlay Gradient', 'ave' ),
			'required' => array(
				'title-bar-overlay-background-type',
				'equals',
				'gradient'
			)
		),

		array(
			'id'    =>'title-bar-classes',
			'type'  => 'text',
			'title' => esc_html__( 'Extra classes', 'ave' )
		),

		array(
			'id'      => 'title-bar-scroll',
			'type'	  => 'button_set',
			'title'   => esc_html__( 'Enable Scroll Button', 'ave' ),
			'options' => array(
				'on'   => esc_html__( 'On', 'ave' ),
				''     => esc_html__( 'Default', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => '',
		),

		array(
			'id'       => 'title-bar-scroll-color',
			'type'     => 'color',
			'title'    => esc_html__( 'Scroll Button Color', 'ave' ),
			'subtitle' => esc_html__( 'Pick a color for scroll button', 'ave' ),
			'required' => array(
				'title-bar-scroll',
				'!=',
				'off'
			),
		),

		array(
			'id'       => 'title-bar-scroll-id',
			'type'     => 'text',
			'title'    => esc_html__( 'Anchor ID', 'ave' ),
			'subtitle' => esc_html__( 'Input anchor ID of the section for scroll button', 'ave' ),
			'required' => array(
				'title-bar-scroll',
				'!=',
				'off'
			),
		),

	), // #fields
);