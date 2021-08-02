<?php
/**
 * Post
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
	'post_types' => array('post'),
	'title'      => esc_html__( 'Post Options', 'ave' ),
	'icon'       => 'el-icon-screen',
	'fields'     => array(

		array(
			'id'      => 'post-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Style', 'ave' ),
			'options' => array(
				'default'      => esc_html__( 'Default', 'ave' ),
				'cover'        => esc_html__( 'Cover', 'ave' ),
				'cover-spaced' => esc_html__( 'Cover Spaced', 'ave' ),
				'slider'       => esc_html__( 'Cover Slider', 'ave' ),
				'modern'       => esc_html__( 'Modern', 'ave' ),
				'custom'       => esc_html__( 'Custom', 'ave' ),
			),
			'default' => 'cover-spaced'
		),
		array(
			'id' => 'post-extra-text',
			'type' => 'textarea',
			'title' => esc_html__( 'Extra Text', 'ave' ),
			'subtitle' => esc_html__( 'Text will display near meta section', 'ave' ),
			'required' => array(
				'post-style',
				'equals',
				array( 'default', 'cover-spaced', 'modern' ),
			),
		),
		array(
			'id'      => 'liquid-post-slider',
			'type'    => 'gallery',
			'title'   => esc_html__( 'Add images for Cover slider', 'ave' ),
			'required' => array(
				'post-style',
				'equals',
				'slider'
			),
		),
		array(
			'id'      => 'liquid-post-cover-image',
			'type'    => 'background',
			'background-color' => false,
			'background-repeat' => false,
			'background-attachment' => false,
			'background-size' => false,
			'background-position' => false,
			'title'   => esc_html__( 'Cover Image', 'ave' ),
			'subtitle' => esc_html__( 'Will override the featured image in single post', 'ave' ),
			'required' => array(
				'post-style',
				'equals',
				array( 'cover', 'cover-spaced' ),
			),
		),
		array(
			'id'       => 'post-parallax-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Enable Parallax', 'ave' ),
			'subtitle' => esc_html__( 'Turn on parallax effect on post featured image', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				''     => esc_html__( 'Default', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => ''
		),
		array(
			'id'       => 'post-video-btn-enable',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Show Play Button', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to show Play Button on the post cover image', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'required' => array(
				'post-style',
				'equals',
				'cover'
			),
			'default'  => 'off'
		),
		array(
			'type'     => 'text',
			'id'       => 'post-video-btn-url',
			'title'    => esc_html__( 'Play Button Url', 'ave' ),
			'required' => array(
				'post-video-btn-enable',
				'!=',
				'off'
			)
		),
		array(
			'type'     => 'text',
			'id'       => 'post-video-btn-label',
			'title'    => esc_html__( 'Play Button Label', 'ave' ),
			'required' => array(
				'post-video-btn-enable',
				'!=',
				'off'
			)
		),
		array(
			'id'       => 'post-social-box-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Social Sharing Box', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to display the social sharing box on single posts.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				''     => esc_html__( 'Default', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => ''
		),
		array(
			'id'       => 'post-author-meta-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Author Info Meta', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to display the author meta.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				''     => esc_html__( 'Default', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => ''
		),
		array(
			'id'       => 'post-author-box-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Author Info Box', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to display the author info box below posts.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				''     => esc_html__( 'Default', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => ''
		),
		array(
			'id'       => 'post-navigation-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Previous/Next Pagination', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to display the previous/next post pagination for single posts.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				''     => esc_html__( 'Default', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => ''
		),
		array(
			'id'       => 'post-related-enable',
			'type'	   => 'button_set',
			'title'    => esc_html__( 'Related Projects', 'ave' ),
			'subtitle' => esc_html__( 'Turn on to display related posts/projects on single posts.', 'ave' ),
			'options'  => array(
				'on'   => esc_html__( 'On', 'ave' ),
				''     => esc_html__( 'Default', 'ave' ),
				'off'  => esc_html__( 'Off', 'ave' )
			),
			'default'  => ''
		),
		array(
			'id'       => 'post-related-style',
			'type'     => 'select',
			'title'    => esc_html__( 'Related posts section style', 'ave' ),
			'subtitle' => esc_html__( 'Select desired style for the related posts section to display on single post', 'ave' ),
			'options'  => array(
				'classic' => esc_html__( 'Classic', 'ave' ),
				'cover'   => esc_html__( 'Cover', 'ave' ),
			),
			'required' => array(
				'post-related-enable',
				'!=',
				'off'
			)
		),
		array(
			'type'     => 'text',
			'id'       => 'post-related-title',
			'title'    => esc_html__( 'Related posts section title', 'ave' ),
			'required' => array(
				'post-related-enable',
				'!=',
				'off'
			)
		),
		array(
			'type'     => 'slider',
			'id'       => 'post-related-number',
			'title'    => esc_html__( 'Number of Related Projects', 'ave' ),
			'subtitle' => esc_html__( 'Controls the number of posts that display under related posts section.', 'ave' ),
			'default'  => 2,
			'min'      => 2,
			'max'      => 4,
			'required' => array(
				'post-related-enable',
				'!=',
				'off'
			)
		),
		array(
			'id'       => 'post-carousel-width',
			'type'     => 'select',
			'title'    => esc_html( 'Width', 'ave' ),
			'subtitle' => esc_html__( 'Select desired width for the blog item on portfolio listing page, only for carousel and carousel filterable styles', 'ave' ),
			'options'  => array(
				''     => esc_html__( 'Default', 'ave' ),
				'2'    => esc_html__( '2 columns - 1/6', 'ave' ),
				'3'    => esc_html__( '3 columns - 1/4', 'ave' ),
				'4'    => esc_html__( '4 columns - 1/3', 'ave' ),
				'5'    => esc_html__( '5 columns - 5/12', 'ave' ),
				'6'    => esc_html__( '6 columns - 1/2', 'ave' ),
				'7'    => esc_html__( '7 columns - 7/12', 'ave' ),
				'8'    => esc_html__( '8 columns - 2/3', 'ave' ),
				'9'    => esc_html__( '9 columns - 3/4', 'ave' ),
				'10'   => esc_html__( '10 columns - 5/6', 'ave' ),
				'11'   => esc_html__( '11 columns - 11/12', 'ave' ),
				'12'   => esc_html__( '12 columns - 12/12', 'ave' ),
			)
		),
		array(
			'type'     => 'text',
			'id'       => 'liquid-featured-label',
			'title'    => esc_html__( 'Label Before Title.', 'ave' ),
			'subtitle' => esc_html__( 'Will apply only for Featured Fullwidth style in Blog Listing Shortcode', 'ave' ),
		),
		array(
			'type'     => 'select',
			'id'       => 'post-metro-featured',
			'title'    => esc_html__( 'Make this post featured or instagram?', 'ave' ),
			'subtitle' => esc_html__( 'Will apply only for Metro style in Blog Listing Shortcode', 'ave' ),
			'options' => array(
				'default'   => esc_html__( 'Default', 'ave' ),
				'featured'  => esc_html__( 'Featured', 'ave' ),
				'instagram' => esc_html__( 'Instagram', 'ave' ),
			),
		),
		array(
			'type' => 'liquid_colorpicker',
			'id' => 'instagram-post-overlay',
			'title'    => esc_html__( 'Overlay Color', 'ave' ),
			'subtitle' => esc_html__( 'Will apply only to instagram posts of the Metro style of the Blog listing', 'ave' ),
			'required' => array(
				'post-metro-featured',
				'=',
				'instagram'
			)
		)
		
	)
);
