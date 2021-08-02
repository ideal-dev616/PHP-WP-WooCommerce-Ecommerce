<?php 

extract( $atts );

$this->generate_css();

$classes = array(
	'main-nav',
	$this->get_id()
);

$args = '';

if( !empty( $hover_style ) ) {
	$classes[] = "main-nav-hover-$hover_style";
}
$classes[] = "nav align-items-lg-stretch justify-content-lg-$align_items";

$classes = apply_filters( 'liquid_header_nav_classes', $classes );

$default_args = array(
	'toggleType' => 'fade',
	'handler' => 'mouse-in-out',	
);
$args = wp_parse_args( $args, $default_args );
$args = apply_filters( 'liquid_header_nav_args', $args );

?>
<?php

	if( is_nav_menu( $menu_slug ) ) :

		wp_nav_menu( array(
			'theme_location' => 'primary',
			'menu'           => $menu_slug,
			'container'      => 'ul',
			'before'         => false,
			'after'          => false,
			'link_before'    => '<span class="link-icon"></span><span class="link-txt"><span class="link-ext"></span><span class="txt">',
			'link_after'     => '<span class="submenu-expander"> <i class="fa fa-angle-down"></i> </span></span></span>',
			'menu_id'        => 'primary-nav',
			'menu_class'     => esc_attr( implode( ' ', $classes ) ),
			//'items_wrap'     => '<ul id="%1$s" class="%2$s" data-submenu-options=\'{ "toggleType": "fade", "handler": "mouse-in-out" }\' ' . $this->add_local_scroll() . '>%3$s</ul>',
			'items_wrap'     => '<ul id="%1$s" class="%2$s" data-submenu-options=\'' . wp_json_encode( $args ) . '\' ' . $this->add_local_scroll() . '>%3$s</ul>',
			'walker'         => class_exists( 'Liquid_Mega_Menu_Walker' ) ? new Liquid_Mega_Menu_Walker : '',
		 ) );

	 else:

		wp_nav_menu( array(
			'container'   => 'ul',
			'before'      => false,
			'after'       => false,
			'link_before' => '<span class="link-icon"></span><span class="link-txt"><span class="link-ext"></span><span class="txt">',
			'link_after'  => '<span class="submenu-expander"> <i class="fa fa-angle-down"></i> </span></span></span>',
			'menu_class'     => esc_attr( implode( ' ', $classes ) ),
			//'items_wrap'     => '<ul id="%1$s" class="%2$s" data-submenu-options=\'{ "toggleType": "fade", "handler": "mouse-in-out" }\' >%3$s</ul>',
			'items_wrap'     => '<ul id="%1$s" class="%2$s" data-submenu-options=\'' . wp_json_encode( $args ) . '\' >%3$s</ul>',
			'walker'         => class_exists( 'Liquid_Mega_Menu_Walker' ) ? new Liquid_Mega_Menu_Walker : '',
		));

	endif;
?>