<?php
/*
 * Blog
 */

$this->sections[] = array(
	'title'  => esc_html__( 'Blog', 'ave' ),
	'icon'   => 'el el-pencil'
);

$this->sections[] = array(
	'title'      => esc_html__( 'General Blog', 'ave' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'blog-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Blog Page Title Bar', 'ave' ),
			'subtitle' => esc_html__( 'Display the page title bar for the assigned blog page in settings > reading or the blog archive pages. Note: This option will not control the blog element.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'blog-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Blog Page Title', 'ave' ),
			'subtitle' => esc_html__( 'Manages the title text that displays in the page title bar only if your front page displays your latest post in "settings > reading".', 'ave' ),
			'default'  => 'Blog'
		),
		array(
			'id'       => 'blog-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Blog Page Subtitle', 'ave' ),
			'subtitle' => esc_html__( 'Manage the subtitle text that displays in the page title bar only if your front page displays your latest post in "settings > reading".', 'ave' )
		),
		array(
			'id'      => 'blog-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Post Style', 'ave' ),
			'options' => array(
				'classic'            => esc_html__( 'Classic', 'ave' ),
				'classic-bold'       => esc_html__( 'Classic Bold', 'ave' ),
				'candy'              => esc_html__( 'Candy', 'ave' ),
				'featured'           => esc_html__( 'Featured', 'ave' ),
				'featured-2'         => esc_html__( 'Featured 2', 'ave' ),
				'featured-minimal'   => esc_html__( 'Featured Minimal', 'ave' ),
				'rounded'            => esc_html__( 'Rounded', 'ave' ),
				'classic-meta'       => esc_html__( 'Classic Meta', 'ave' ),
				'classic-2'          => esc_html__( 'Classic 2', 'ave' ),
				'text-date'          => esc_html__( 'Text date', 'ave' ),
				'metro'              => esc_html__( 'Metro', 'ave' ),
				'minimal'            => esc_html__( 'Minimal Grey', 'ave' ),
				'metro-alt'          => esc_html__( 'Metro Alt', 'ave' ),
				'grid'               => esc_html__( 'Grid', 'ave' ),
				'masonry'            => esc_html__( 'Masonry', 'ave' ),
				'category'           => esc_html__( 'Split', 'ave' ),
				'category-bordered'  => esc_html__( 'Category Bordered', 'ave' ),
				'category-compact'   => esc_html__( 'Category Compact', 'ave' ),				
				'split'              => esc_html__( 'Split', 'ave' ),
				'square'             => esc_html__( 'Square', 'ave' ),
				'square-2'           => esc_html__( 'Square 2', 'ave' ),
				'featured-fullwidth' => esc_html__( 'Featured Fullwidth', 'ave' ),
				'timeline'           => esc_html__( 'Timeline', 'ave' ),
				'classic-full'       => esc_html__( 'Classic Full', 'ave' ),
			),
			'subtitle' => esc_html__( 'Choose a post style for your blog page.', 'ave' ),
			'default'  => 'classic'
		),
		array(
			'id'      => 'blog-columns',
			'type'    => 'select',
			'title'   => esc_html__( 'Columns', 'ave' ),
			'options' => array(
				'1'       => esc_html__( '1 Column', 'ave' ),
				'2'       => esc_html__( '2 Columns', 'ave' ),
				'3'       => esc_html__( '3 Columns', 'ave' ),
				'4'       => esc_html__( '4 Columns', 'ave' ),
			),
			'subtitle' => esc_html__( 'How many columns to show for your blog page.', 'ave' ),
			'default'  => '2'
		),
		array(
			'id'    => 'blog-show-meta',
			'type'	   => 'button_set',
			'title' => esc_html__( 'Meta', 'ave' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'ave' ),
				'no' => esc_html__( 'No', 'ave' ),
			),
			'subtitle' => esc_html__( 'Manage the meta for posts', 'ave' ),
			'default'  => 'yes'
		),
		array(
			'id'    => 'blog-meta-type',
			'type'  => 'select',
			'title' => esc_html__( 'Meta Type', 'ave' ),
			'options' => array(
				'tags' => esc_html__( 'Tags', 'ave' ),
				'cats' => esc_html__( 'Categories', 'ave' ),
			),
			'subtitle' => esc_html__( 'Manage the meta type for posts', 'ave' ),
			'default'  => 'tags',
			'required' => array(
				'blog-show-meta',
				'equals',
				'yes'
			)
		),
		array(
			'id'    => 'blog-one-category',
			'type'  => 'select',
			'title' => esc_html__( 'Single Category', 'ave' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'ave' ),
				'no' => esc_html__( 'No', 'ave' ),
			),
			'subtitle' => esc_html__( 'Manage the single category for posts', 'ave' ),
			'default'  => 'yes',
			'required' => array(
				'blog-meta-type',
				'equals',
				'cats'
			)	
		),
		array(
			'id'       => 'blog-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Default Blog Excerpt Length', 'ave' ),
			'validate' => 'numeric',
			'default'  => '50',
		),
		array(
			'id'    => 'blog-enable-parallax',
			'type'	=> 'button_set',
			'title' => esc_html__( 'Parallax', 'ave' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'ave' ),
				'no' => esc_html__( 'No', 'ave' ),
			),
			'subtitle' => esc_html__( 'Manage parallax for post thumbnail', 'ave' ),
			'default'  => 'yes'
		),

	)
);

//Category Archive Options
$this->sections[] = array(
	'title'      => esc_html__( 'Blog Category Page', 'ave' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'category-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Blog Category Page Title', 'ave' ),
			'subtitle' => esc_html__( 'Display the blog category page title.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'category-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Blog Category Page Title', 'ave' ),
			'desc'     => esc_html__( '[ld_category_title] shortcode displays the corresponding the category title, any text can be added before or after the shortcode.', 'ave' ),
			'subtitle' => esc_html__( 'Manage the title of blog category pages.', 'ave' ),
			'default'  => '[ld_category_title]',
		),

		array(
			'id'       => 'category-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Blog Category Page Subtitle', 'ave' ),
			'subtitle' => esc_html__( 'Manages the subtitle of blog category pages.', 'ave' )
		),

		array(
			'id'      => 'category-blog-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Style', 'ave' ),
			'options' => array(
				'classic'            => esc_html__( 'Classic', 'ave' ),
				'classic-bold'       => esc_html__( 'Classic Bold', 'ave' ),
				'candy'              => esc_html__( 'Candy', 'ave' ),
				'featured'           => esc_html__( 'Featured', 'ave' ),
				'featured-2'         => esc_html__( 'Featured 2', 'ave' ),
				'featured-minimal'   => esc_html__( 'Featured Minimal', 'ave' ),
				'rounded'            => esc_html__( 'Rounded', 'ave' ),
				'classic-meta'       => esc_html__( 'Classic Meta', 'ave' ),
				'classic-2'          => esc_html__( 'Classic 2', 'ave' ),
				'text-date'          => esc_html__( 'Text date', 'ave' ),
				'metro'              => esc_html__( 'Metro', 'ave' ),
				'minimal'            => esc_html__( 'Minimal Grey', 'ave' ),
				'metro-alt'          => esc_html__( 'Metro Alt', 'ave' ),
				'grid'               => esc_html__( 'Grid', 'ave' ),
				'masonry'            => esc_html__( 'Masonry', 'ave' ),
				'category'           => esc_html__( 'Split', 'ave' ),
				'category-bordered'  => esc_html__( 'Category Bordered', 'ave' ),
				'category-compact'   => esc_html__( 'Category Compact', 'ave' ),				
				'split'              => esc_html__( 'Split', 'ave' ),
				'square'             => esc_html__( 'Square', 'ave' ),
				'square-2'           => esc_html__( 'Square 2', 'ave' ),
				'featured-fullwidth' => esc_html__( 'Featured Fullwidth', 'ave' ),
				'timeline'           => esc_html__( 'Timeline', 'ave' ),
				'classic-full'       => esc_html__( 'Classic Full', 'ave' ),
			),
			'subtitle' => esc_html__( 'Select content type for your grid.', 'ave' ),
			'default'  => 'classic'
		),
		array(
			'id'    => 'category-blog-show-meta',
			'type'  => 'select',
			'title' => esc_html__( 'Meta', 'ave' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'ave' ),
				'no' => esc_html__( 'No', 'ave' ),
			),
			'subtitle' => esc_html__( 'Manage the meta for posts', 'ave' ),
			'default'  => 'yes'
		),
		array(
			'id'    => 'category-blog-meta-type',
			'type'  => 'select',
			'title' => esc_html__( 'Meta Type', 'ave' ),
			'options' => array(
				'tags' => esc_html__( 'Tags', 'ave' ),
				'cats' => esc_html__( 'Categories', 'ave' ),
			),
			'subtitle' => esc_html__( 'Manage the meta type for posts', 'ave' ),
			'default'  => 'tags',
			'required' => array(
				'blog-show-meta',
				'equals',
				'yes'
			)
		),
		array(
			'id'    => 'category-blog-one-category',
			'type'	=> 'button_set',
			'title' => esc_html__( 'Single Category', 'ave' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'ave' ),
				'no' => esc_html__( 'No', 'ave' ),
			),
			'subtitle' => esc_html__( '', 'ave' ),
			'default'  => 'yes',
			'required' => array(
				'blog-meta-type',
				'equals',
				'cats'
			)	
		),
		array(
			'id'       => 'category-blog-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Default Blog Excerpt Length', 'ave' ),
			'validate' => 'numeric',
			'default'  => '45',
		),
		array(
			'id'    => 'category-blog-enable-parallax',
			'type'	=> 'button_set',
			'title' => esc_html__( 'Parallax', 'ave' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'ave' ),
				'no' => esc_html__( 'No', 'ave' ),
			),
			'subtitle' => esc_html__( 'Manage parallax for post thumbnail.', 'ave' ),
			'default'  => 'yes'
		),

	)
);

//Tag Archive Options
$this->sections[] = array(
	'title'      => esc_html__( 'Blog Tag Page', 'ave' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'tag-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Blog Tag Page Title Bar', 'ave' ),
			'subtitle' => esc_html__( 'Display the title on blog tag pages.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'tag-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Blog Tag Page Title', 'ave' ),
			'desc'     => esc_html__( '[ld_tag_title] shortcode displays the corresponding the category title, any text can be added before or after the shortcode.', 'ave' ),
			'subtitle' => esc_html__( 'Manage the title of blog tag pages.', 'ave' ),
			'default'  => 'Tag: [ld_tag_title]'
		),
		array(
			'id'       => 'tag-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Blog Tag Page Subtitle', 'ave' ),
			'subtitle' => esc_html__( 'Manage the subtitle of blog category pages.', 'ave' )
		),
		array(
			'id'      => 'tag-blog-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Style', 'ave' ),
			'options' => array(
				'classic'            => esc_html__( 'Classic', 'ave' ),
				'classic-bold'       => esc_html__( 'Classic Bold', 'ave' ),
				'candy'              => esc_html__( 'Candy', 'ave' ),
				'featured'           => esc_html__( 'Featured', 'ave' ),
				'featured-2'         => esc_html__( 'Featured 2', 'ave' ),
				'featured-minimal'   => esc_html__( 'Featured Minimal', 'ave' ),
				'rounded'            => esc_html__( 'Rounded', 'ave' ),
				'classic-meta'       => esc_html__( 'Classic Meta', 'ave' ),
				'classic-2'          => esc_html__( 'Classic 2', 'ave' ),
				'text-date'          => esc_html__( 'Text date', 'ave' ),
				'metro'              => esc_html__( 'Metro', 'ave' ),
				'minimal'            => esc_html__( 'Minimal Grey', 'ave' ),
				'metro-alt'          => esc_html__( 'Metro Alt', 'ave' ),
				'grid'               => esc_html__( 'Grid', 'ave' ),
				'masonry'            => esc_html__( 'Masonry', 'ave' ),
				'category'           => esc_html__( 'Split', 'ave' ),
				'category-bordered'  => esc_html__( 'Category Bordered', 'ave' ),
				'category-compact'   => esc_html__( 'Category Compact', 'ave' ),				
				'split'              => esc_html__( 'Split', 'ave' ),
				'square'             => esc_html__( 'Square', 'ave' ),
				'square-2'           => esc_html__( 'Square 2', 'ave' ),
				'featured-fullwidth' => esc_html__( 'Featured Fullwidth', 'ave' ),
				'timeline'           => esc_html__( 'Timeline', 'ave' ),
				'classic-full'       => esc_html__( 'Classic Full', 'ave' ),
			),
			'subtitle' => esc_html__( 'Choose a post style for your blog category pages.', 'ave' ),
			'default'  => 'classic'
		),
		array(
			'id'    => 'tag-blog-show-meta',
			'type'	=> 'button_set',
			'title' => esc_html__( 'Meta', 'ave' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'ave' ),
				'no' => esc_html__( 'No', 'ave' ),
			),
			'subtitle' => esc_html__( '', 'ave' ),
			'default'  => 'yes'
		),
		array(
			'id'    => 'tag-blog-meta-type',
			'type'  => 'select',
			'title' => esc_html__( 'Meta Type', 'ave' ),
			'options' => array(
				'tags' => esc_html__( 'Tags', 'ave' ),
				'cats' => esc_html__( 'Categories', 'ave' ),
			),
			'subtitle' => esc_html__( 'Manage the meta type for posts', 'ave' ),
			'default'  => 'tags',
			'required' => array(
				'blog-show-meta',
				'equals',
				'yes'
			)
		),
		array(
			'id'    => 'tag-blog-one-category',
			'type'  => 'select',
			'title' => esc_html__( 'Single Category', 'ave' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'ave' ),
				'no' => esc_html__( 'No', 'ave' ),
			),
			'subtitle' => esc_html__( '', 'ave' ),
			'default'  => 'yes',
			'required' => array(
				'blog-meta-type',
				'equals',
				'cats'
			)	
		),
		array(
			'id'       => 'tag-blog-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Default Blog Excerpt Length', 'ave' ),
			'validate' => 'numeric',
			'default'  => '50',
		),
		array(
			'id'    => 'tag-blog-enable-parallax',
			'type'	=> 'button_set',
			'title' => esc_html__( 'Parallax', 'ave' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'ave' ),
				'no' => esc_html__( 'No', 'ave' ),
			),
			'subtitle' => esc_html__( 'Parallax for images', 'ave' ),
			'default'  => 'yes'
		),

	)
);

//Author Archive Options
$this->sections[] = array(
	'title'      => esc_html__( 'Blog Author Page', 'ave' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'author-title-bar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Blog Author Page Title Bar', 'ave' ),
			'subtitle' => esc_html__( 'Display the title bar on blog author pages.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'author-title-bar-heading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Blog Author Page Title', 'ave' ),
			'desc'     => esc_html__( '[ld_author] shortcode displays the corresponding the author name, any text can be added before or after the shortcode.', 'ave' ),
			'subtitle' => esc_html__( 'Manage the title of blog author page title.', 'ave' ),
			'default'  => 'Author: [ld_author]'
		),
		array(
			'id'       => 'author-title-bar-subheading',
			'type'	   => 'text',
			'title'    => esc_html__( 'Blog Author Page Subtitle', 'ave' ),
			'subtitle' => esc_html__( 'Manages the subtitle of blog author pages.', 'ave' )
		),
		array(
			'id'      => 'author-blog-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Post Style', 'ave' ),
			'options' => array(
				'classic'            => esc_html__( 'Classic', 'ave' ),
				'classic-bold'       => esc_html__( 'Classic Bold', 'ave' ),
				'candy'              => esc_html__( 'Candy', 'ave' ),
				'featured'           => esc_html__( 'Featured', 'ave' ),
				'featured-2'         => esc_html__( 'Featured 2', 'ave' ),
				'featured-minimal'   => esc_html__( 'Featured Minimal', 'ave' ),
				'rounded'            => esc_html__( 'Rounded', 'ave' ),
				'classic-meta'       => esc_html__( 'Classic Meta', 'ave' ),
				'classic-2'          => esc_html__( 'Classic 2', 'ave' ),
				'text-date'          => esc_html__( 'Text date', 'ave' ),
				'metro'              => esc_html__( 'Metro', 'ave' ),
				'minimal'            => esc_html__( 'Minimal Grey', 'ave' ),
				'metro-alt'          => esc_html__( 'Metro Alt', 'ave' ),
				'grid'               => esc_html__( 'Grid', 'ave' ),
				'masonry'            => esc_html__( 'Masonry', 'ave' ),
				'category'           => esc_html__( 'Split', 'ave' ),
				'category-bordered'  => esc_html__( 'Category Bordered', 'ave' ),
				'category-compact'   => esc_html__( 'Category Compact', 'ave' ),				
				'split'              => esc_html__( 'Split', 'ave' ),
				'square'             => esc_html__( 'Square', 'ave' ),
				'square-2'           => esc_html__( 'Square 2', 'ave' ),
				'featured-fullwidth' => esc_html__( 'Featured Fullwidth', 'ave' ),
				'timeline'           => esc_html__( 'Timeline', 'ave' ),
				'classic-full'       => esc_html__( 'Classic Full', 'ave' ),
			),
			'subtitle' => esc_html__( 'Choose the post style for your blog author pages.', 'ave' ),
			'default'  => 'classic'
		),
		array(
			'id'    => 'author-blog-show-meta',
			'type'	=> 'button_set',
			'title' => esc_html__( 'Meta', 'ave' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'ave' ),
				'no' => esc_html__( 'No', 'ave' ),
			),
			'subtitle' => esc_html__( 'Manage the meta for posts', 'ave' ),
			'default'  => 'yes'
		),
		array(
			'id'    => 'author-blog-meta-type',
			'type'  => 'select',
			'title' => esc_html__( 'Meta Type', 'ave' ),
			'options' => array(
				'tags' => esc_html__( 'Tags', 'ave' ),
				'cats' => esc_html__( 'Categories', 'ave' ),
			),
			'subtitle' => esc_html__( '', 'ave' ),
			'default'  => 'tags',
			'required' => array(
				'blog-show-meta',
				'equals',
				'yes'
			)
		),
		array(
			'id'    => 'author-blog-one-category',
			'type'  => 'select',
			'title' => esc_html__( 'Single Category', 'ave' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'ave' ),
				'no' => esc_html__( 'No', 'ave' ),
			),
			'subtitle' => esc_html__( '', 'ave' ),
			'default'  => 'yes',
			'required' => array(
				'blog-meta-type',
				'equals',
				'cats'
			)	
		),
		array(
			'id'       => 'author-blog-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Default Blog Excerpt Length', 'ave' ),
			'validate' => 'numeric',
			'default'  => '45',
		),
		array(
			'id'    => 'author-blog-enable-parallax',
			'type'	=> 'button_set',
			'title' => esc_html__( 'Parallax for Posts', 'ave' ),
			'options' => array(
				'yes' => esc_html__( 'Yes', 'ave' ),
				'no' => esc_html__( 'No', 'ave' ),
			),
			'subtitle' => esc_html__( 'Manage parallax for post thumbnails', 'ave' ),
			'default'  => 'yes'
		),

	)
);

$this->sections[] = array(
	'title'      => esc_html__('Blog Single Post', 'ave'),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'      => 'post-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Single Post Style', 'ave' ),
			'options' => array(
				'default'      => esc_html__( 'Default', 'ave' ),
				'cover'        => esc_html__( 'Cover', 'ave' ),
				'cover-spaced' => esc_html__( 'Cover Spaced', 'ave' ),
				'slider'       => esc_html__( 'Cover Slider', 'ave' ),
				'modern'       => esc_html__( 'Modern', 'ave' ),
			),
			'default' => 'cover-spaced'
		),
		array(
			'id'       => 'post-titlebar-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Page Title Bar', 'ave' ),
			'subtitle' => esc_html__( 'Display title bar on single posts', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default' => 'off'
		),
		array(
			'id'              => 'single_typography',
			'title'           => esc_html__( 'Single Post Content Typography', 'ave' ),
			'subtitle'        => esc_html__( 'Manage the typography for the single post content', 'ave' ),
			'type'            => 'typography',
			'letter-spacing'  => true,
			'text-align'      => false,
			'compiler'        => true,
			'units'           => '%',
		),
		array(
			'id'       => 'post-social-box-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Social Sharing', 'ave' ),
			'subtitle' => esc_html__( 'Display the social sharing box on single post pages.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'post-author-meta-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Author Info Meta', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to display the author meta.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'post-author-box-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Author Meta', 'ave' ),
			'subtitle' => esc_html__( 'Switch on to display the author info box on single post pages.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'post-navigation-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Neighbour Posts', 'ave' ),
			'subtitle' => esc_html__( 'Switch on to display the previous post and next post on single post pages.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'id'       => 'post-related-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Related Posts', 'ave' ),
			'subtitle' => esc_html__( 'Display the related posts on single posts.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => 'on'
		),
		array(
			'type'     => 'text',
			'id'       => 'post-related-title',
			'title'    => esc_html__( 'Title of Related Posts', 'ave' ),
			'default'  => 'You may also like',
			'required' => array(
				'post-related-enable',
				'equals',
				'on'
			)
		),
		array(
			'type'     => 'slider',
			'id'       => 'post-related-number',
			'title'    => esc_html__( 'Related Posts Quantity', 'ave' ),
			'subtitle' => esc_html__( 'Quantity of projects those display on related posts section.', 'ave' ),
			'default'  => 2,
			'max'      => 100,
			'required' => array(
				'post-related-enable',
				'equals',
				'on'
			)
		)
	)
);
