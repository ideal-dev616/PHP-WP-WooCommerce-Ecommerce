<?php

/*
 * Sidebars Section
*/

$this->sections[] = array(
	'title'  => esc_html__( 'Sidebars', 'ave' ),
	'icon'   => 'el el-braille'
);


$this->sections[] = array(
	'title'      => esc_html__( 'Add sidebars', 'ave' ),
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'custom-sidebars',
			'type'     => 'multi_text',
			'title'    => esc_html__( 'Add a Sidebar', 'ave' ),
			'subtitle' => esc_html__( '', 'ave' ),
			'desc'     => esc_html__( 'You can add as many custom sidebars as you need.', 'ave' )
		),
	)	
);

// Page Sidebar
$this->sections[] = array(
	'title'  => esc_html__( 'Page', 'ave' ),
	'subsection' => true,
	'fields' => array(

		array(
			'id'       => 'page-enable-global',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Default Sidebar of Pages', 'ave' ),
			'subtitle' => esc_html__( 'Switch on to use the same sidebars across all pages by overwriting the page options.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'off'
		),
		array(
			'id'       => 'page-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Default Sidebar of Pages', 'ave' ),
			'subtitle' => esc_html__( 'Choose the sidebar that will display across all pages.', 'ave' ),
			'data'     => 'sidebars'
		),
		array(
			'id'       => 'page-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Default Sidebar Position of Pages', 'ave' ),
			'subtitle' => esc_html__( 'Manages the position of the sidebar across all pages.', 'ave' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'ave' ),
				'right' => esc_html__( 'Right', 'ave' )
			),
			'default'   => 'right'
		)
	)
);

// Portfolio Sidebar
$this->sections[] = array(
	'title'      => esc_html__( 'Portfolio Posts', 'ave' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'portfolio-enable-global',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Default Sidebar of Portfolio Posts', 'ave' ),
			'subtitle' => esc_html__( 'Switch on to use the same sidebars across all portfolio posts by overwriting the page options.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'off'
		),
		array(
			'id'       => 'portfolio-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Default Sidebar of Portfolio Posts', 'ave' ),
			'subtitle' => esc_html__( 'Select sidebar that will display on all portfolio posts.', 'ave' ),
			'data'     => 'sidebars'
		),
		array(
			'id'       => 'portfolio-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Default Sidebar Position of Portfolio Posts', 'ave' ),
			'subtitle' => esc_html__( 'Manages the position of the sidebar for all portfolio posts.', 'ave' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'ave' ),
				'right' => esc_html__( 'Right', 'ave' )
			),
			'default' => 'right'
		)
	)
);

// Portfolio Archive Sidebar
$this->sections[] = array(
	'title'      => esc_html__( 'Portfolio Archive', 'ave' ),
	'subsection' => true,
	'fields' => array(

		array(
			'id'       => 'portfolio-archive-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Sidebar of Portfolio Archive', 'ave' ),
			'subtitle' => esc_html__( 'Select a sidebar that will display on the portfolio archive pages.', 'ave' ),
			'data'     => 'sidebars'
		),
		array(
			'id'       => 'portfolio-archive-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Default Sidebar Position of Portfolio Archive', 'ave' ),
			'subtitle' => esc_html__( 'Manages the position of the sidebar for portfolio archive pages.', 'ave' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'ave' ),
				'right' => esc_html__( 'Right', 'ave' )
			),
			'default' => 'right'
		)
	)
);

// Blog Posts Sidebar
$this->sections[] = array(
	'title'      => esc_html__( 'Blog Posts', 'ave' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'blog-enable-global',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Default Sidebar For Blog Posts', 'ave' ),
			'subtitle' => esc_html__( 'Turn on if you want to use the same sidebars on all blog posts. This option overrides the blog options.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'off'
		),		
		array(
			'id'       => 'blog-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Default Blog Posts Sidebar', 'ave' ),
			'subtitle' => esc_html__( 'Select sidebar 1 that will display on all blog posts.', 'ave' ),
			'data'     => 'sidebars'
		),
		array(
			'id'       => 'blog-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Default Blog Sidebar Position', 'ave' ),
			'subtitle' => esc_html__( 'Controls the position of sidebar for all blog posts. ', 'ave' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'ave' ),
				'right' => esc_html__( 'Right', 'ave' )
			),
			'default' => 'right'
		)
	)
);

// Blog Archive Sidebar
$this->sections[] = array(
	'title'      => esc_html__( 'Blog Archive', 'ave' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'blog-archive-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Blog Archive Sidebar', 'ave' ),
			'subtitle' => esc_html__( 'Select a sidebar that will display on the blog archive pages.', 'ave' ),
			'data' => 'sidebars'
		),
		array(
			'id'       => 'blog-archive-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Default Blog Archive Sidebar Position', 'ave' ),
			'subtitle' => esc_html__( 'Controls the position of the sidebar for blog archive pages.', 'ave' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'ave' ),
				'right' => esc_html__( 'Right', 'ave' )
			),
			'default' => 'right'
		)
	)
);

// Search page Sidebar
$this->sections[] = array(
	'title'      => esc_html__( 'Search Page', 'ave' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'search-sidebar-one',
			'type'     => 'select',
			'title'    => esc_html__( 'Sidebar of Search Page', 'ave' ),
			'subtitle' => esc_html__( 'Choose a sidebar that will display on the search results page.', 'ave' ),
			'data' => 'sidebars'
		),
		array(
			'id'       => 'search-sidebar-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sidebar Position of Search Page', 'ave' ),
			'subtitle' => esc_html__( 'Manages the position of the sidebar for the search results page.', 'ave' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'ave' ),
				'right' => esc_html__( 'Right', 'ave' )
			),
			'default' => 'right'
		)
	)
);

liquid_action( 'option_sidebars', $this );
