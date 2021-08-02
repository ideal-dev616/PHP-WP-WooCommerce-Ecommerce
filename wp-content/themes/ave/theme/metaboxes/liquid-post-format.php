<?php
/*
 * Post
*/

// Audio
$sections[] = array(
	'separate_box' => true,
	'box_title'    => esc_html__( 'Audio', 'ave' ),
	'post_types'   => array( 'post', 'liquid-portfolio' ),
	'post_format'  => array( 'audio' ),
	'icon'         => 'el-icon-screen',
	'fields' => array(

		array(
			'id' => 'post-audio',
			'type' => 'text',
			'title' => esc_html__( 'Audio URL', 'ave' ),
			'desc' => esc_html__( 'Audio file URL in format: mp3, ogg, wav.', 'ave' )
		)
	)
);

// Gallery
$sections[] = array(
	'separate_box' => true,
	'box_title'    => esc_html__( 'Gallery', 'ave' ),
	'post_types'   => array( 'post', 'liquid-portfolio' ),
	'post_format'  => array( 'gallery' ),
	'icon'         => 'el-icon-screen',
	'fields' => array(

		array(
			'id'        => 'post-gallery-lightbox',
			'type'      => 'button_set',
			'title'     => esc_html__( 'Lightbox?', 'ave' ),
			'subtitle'  => esc_html__( 'Enable lightbox for gallery images', 'ave' ),
			'options' => array(
				'on'  => esc_html__( 'On', 'ave' ),
				'off' => esc_html__( 'Off', 'ave' ),
			),
			'default' => 'off'
		),

		array(
			'id'        => 'post-gallery',
			'type'      => 'slides',
			'title'     => esc_html__( 'Gallery Slider', 'ave' ),
			'subtitle'  => esc_html__( 'Upload images or add from media library.', 'ave' ),
			'placeholder'   => array(
				'title'     => esc_html__( 'Title', 'ave' ),
			),
			'show' => array(
				'title' => true,
				'description' => false,
				'url' => false,
			)
		)
	)
);

// Link
$sections[] = array(
	'separate_box' => true,
	'box_title'    => esc_html__( 'Link', 'ave' ),
	'post_types' => array( 'post' ),
	'post_format' => array( 'link' ),
	'icon' => 'el-icon-screen',
	'fields' => array(

		array(
			'id'        => 'post-link-url',
			'type'      => 'text',
			'title'     => esc_html__( 'URL', 'ave' )
		)
	)
);

// Quote
$sections[] = array(
	'separate_box' => true,
	'box_title'    => esc_html__( 'Quote', 'ave' ),
	'post_types' => array( 'post' ),
	'post_format' => array( 'quote' ),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'post-quote-url',
			'type'      => 'text',
			'title'     => esc_html__( 'Cite', 'ave' )
		)
	)
);

// Video
$sections[] = array(
	'separate_box' => true,
	'box_title'    => esc_html__( 'Video', 'ave' ),
	'post_types' => array( 'post' ),
	'post_format' => array( 'video' ),
	'icon' => 'el-icon-screen',
	'fields' => array(

		array(
			'id'        => 'post-video-url',
			'type'      => 'text',
			'title'     => esc_html__( 'Video URL', 'ave' ),
			'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'ave' )
		),

		array(
			'id'        => 'post-video-file',
			'type'      => 'editor',
			'title'     => esc_html__( 'Video Upload', 'ave' ),
			'desc'  => esc_html__( 'Upload video file', 'ave' )
		),

		array(
			'id'        => 'post-video-html',
			'type'      => 'textarea',
			'title'     => esc_html__( 'Embadded video', 'ave' ),
			'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'ave' )
		)
	)
);

// Video
$sections[] = array(
	'separate_box' => true,
	'box_title'    => esc_html__( 'Video', 'ave' ),
	'post_types' => array( 'liquid-portfolio' ),
	'post_format' => array( 'video' ),
	'icon' => 'el-icon-screen',
	'fields' => array(

		array(
			'id'    => 'post-video-url',
			'type'  => 'text',
			'title' => esc_html__( 'Video URL', 'ave' ),
			'desc'  => esc_html__( 'Local video URL that will be shown on Portfolio Listing. You can add the Youtube/Vimeo video that you want to show in the lightbox, from Portfolio Meta > External URL.', 'ave' )
		),
		array(
			'id'        => 'post-video-autoplay',
			'type'      => 'button_set',
			'title'     => esc_html__( 'Autoplay or Play on Hover', 'ave' ),
			'subtitle'  => esc_html__( 'Enable autoplay or play on hover', 'ave' ),
			'options' => array(
				'autoplay'      => esc_html__( 'Autoplay', 'ave' ),
				'play_on_hover' => esc_html__( 'Play On Hover', 'ave' ),
			),
			'default' => 'play_on_hover'
		)
	)
);