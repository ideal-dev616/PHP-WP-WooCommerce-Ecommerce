<?php 

extract( $atts );
$classes = array(
	'ld-dropdown-menu',
	$hover_style,

	$this->get_id()
);

$dropdown_id = uniqid( 'dropdown-' );

// qTRanslate-x
$active_name = $content = '';

if( function_exists( 'qtranxf_generateLanguageSelectCode' ) ) {

	global $q_config;

	$url = is_404() ? get_option('home') : '';

	foreach(qtranxf_getSortedLanguages() as $language) {
		$alt = $q_config['language_name'][$language] . '(' . $language . ')';
		$classes = array( 'lang-' . $language );

		if( $language == $q_config['language'] ) {
			$classes[]   = 'active';
			$active_name = $q_config['language_name'][$language];
		}

		$content .= sprintf(
			'<li class="%1$s"><a href="%2$s" class="qtranxs_text qtranxs_text_%3$s" hreflang="%3$s" title="%4$s">%5$s</a></li>',
			implode( ' ', $classes ),
			qtranxf_convertURL( $url, $language, false, true ),
			$language,
			$alt,
			$q_config['language_name'][$language]
		);
	}
}
// Polylang
elseif( function_exists( 'pll_the_languages' ) && PLL() instanceof PLL_Frontend ) {

	$switcher = new PLL_Switcher;
	$content = $switcher->the_languages( PLL()->links, array(
		'echo' => false
	) );

	$active_name = PLL()->links->curlang->name;
}
// WPML
elseif( function_exists( 'icl_get_languages' ) ) {
	$active_name = ICL_LANGUAGE_NAME;

	$languages = icl_get_languages( 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str' );

	if( !empty( $languages ) ) {
		foreach( $languages as $language ) {
			if( ! $language['active'] ) {
				$content .= '<li><a href="' . esc_url( $language['url'] ) . '">' . $language['native_name'] . '</a></li>';
			}
		}
	}
}

$this->generate_css();

?>
<div class="header-module <?php echo $show_on_mobile; ?>">
	<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">

		<span class="ld-module-trigger" role="button" data-ld-toggle="true" data-toggle="collapse" data-target="<?php echo '#' . $dropdown_id; ?>" aria-controls="<?php echo $dropdown_id ?>" aria-expanded="false">
			<span class="ld-module-trigger-txt"><?php echo $active_name ?> <i class="fa fa-angle-down"></i></span>
		</span><!-- /.ld-module-trigger -->		

		<div class="ld-module-dropdown left collapse" id="<?php echo $dropdown_id ?>" aria-expanded="false">
			<div class="ld-dropdown-menu-content">
				<ul>
				<?php echo $content ?>
				</ul>
			</div><!-- /.ld-dropdown-menu-content -->
		</div><!-- /.ld-module-dropdown -->
		
	</div><!-- /.ld-dropdown-menu -->
</div>