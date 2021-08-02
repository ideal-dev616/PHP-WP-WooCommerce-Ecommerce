<?php
/**
 * LiquidThemes Theme Framework
 * Include the TGM_Plugin_Activation class and register the required plugins.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 */

liquid()->load_library( 'class-tgm-plugin-activation' );

/**
 * Register the required plugins for this theme.
 */
add_action( 'tgmpa_register', '_s_register_required_plugins' );

function _s_register_required_plugins() {

	$images = get_template_directory_uri() . '/theme/plugins/images';

	$plugins = array(

		array(
			'name' 		        => esc_html__( 'Ave Core', 'ave' ),
			'slug' 		        => 'ave-core',
			'required' 	        => true,
			'source'            => 'http://api.liquid-themes.com/download.php?type=plugins&file=ave-core.zip',
			'liquid_logo'        => $images . '/one-core-min.png',
			'version'               => '1.4.10',
			'liquid_author'      => esc_html__( 'Liquid Themes', 'ave' ),
			'liquid_description' => esc_html__( 'Intelligent and Powerful Elements Plugin, exclusively for Ave WordPress Theme.', 'ave' ),
		),
		array(
			'name' 		        => esc_html__( 'Ave Portfolio', 'ave' ),
			'slug' 		        => 'ave-portfolio',
			'required' 	        => true,
			'source'            => 'http://api.liquid-themes.com/download.php?type=plugins&file=ave-portfolio.zip',
			'liquid_logo'        => $images . '/one-pf-min.png',
			'version'               => '1.0',
			'liquid_author'      => esc_html__( 'Liquid Themes', 'ave' ),
			'liquid_description' => esc_html__( 'Modern and Diversified Portfolio Plugin, exclusively Ave WordPress Theme.', 'ave' ),
		),
		array(
			'name' 		         => esc_html__( 'WPBakery Page Builder', 'ave' ),
			'slug' 		         => 'js_composer',			
			'required' 	         => true,
            'source'             => 'http://api.liquid-themes.com/download.php?type=plugins&file=js_composer.zip',
			'liquid_logo'        => $images . '/bakery-1.jpg',
			'version'            => '6.4.2',
			'liquid_author'      => esc_html__( 'Wpbakery', 'ave' ),
			'liquid_description' => esc_html__( 'A premium plugin bundled with the Ave theme', 'ave' ),
		),
		array(
			'name'              => esc_html__( 'Revolution Slider', 'ave' ),
			'slug'              => 'revslider',
			'source'            => 'http://api.liquid-themes.com/download.php?type=plugins&file=revslider.zip',
			'liquid_logo'        => $images . '/rev-slider-min.png',
			'liquid_author'      => esc_html__( 'ThemePunch', 'ave' ),
			'liquid_description' => esc_html__( 'Slider Revolution - Premium responsive slider', 'ave' ),
		),
        array(
			'name'              => esc_html__( 'Contact Form 7', 'ave' ),
			'slug'              => 'contact-form-7',
			'required'          => false,
			'liquid_logo'        => $images . '/cf-7-min.png',
			'liquid_author'      => esc_html__( 'Takayuki Miyoshi', 'ave' ),
			'liquid_description' => esc_html__( 'Contact Form 7 can manage multiple contact forms, plus you can customize the form and the mail contents flexibly with simple markup.', 'ave' )
		),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
	);

	tgmpa( $plugins, $config );
}