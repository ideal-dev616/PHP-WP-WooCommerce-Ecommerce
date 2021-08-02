<?php 

extract( $atts );

$items = vc_param_group_parse_atts( $items );

$this->generate_css();

$classes = array(
	!$sticky ? 'lqd-custom-menu' : '',
	'reset-ul',
	$inline,
	$bg_color || $bg_hcolor ? 'menu-items-have-fill' : '',
	!$sticky ? $this->get_id() : '',
);

?>
<?php 
	
	if( $sticky ) { 
	
	$duration = !empty( $sticky_duration ) ? '"duration": "docHeight"' : '"duration": "last-link"';
	
?><div id="<?php echo $this->get_id() ?>" class="lqd-custom-menu lqd-sticky-menu <?php echo $menu_alignment; ?> <?php echo $this->get_id(); ?>" data-pin="true" data-pin-options='{ "offset": "[data-sticky-header] .mainbar-wrap.is-stuck, #wpadminbar", <?php echo $duration; ?>  }' data-move-element='{ "target": ".vc_row" }'><?php } ?>

<?php if( 'wp_menus' === $source ) : ?>
<?php

	if( is_nav_menu( $menu_slug ) ) {
		wp_nav_menu( array(
			'menu'           => $menu_slug,
			'container'      => 'ul',
			'menu_id'        => !$sticky ? $this->get_id() : '',
			'before'         => false,
			'after'          => false,
			'link_before'    => '',
			'link_after'     => '',
			'menu_class'     => esc_attr( implode( ' ', $classes ) ),
			'depth' => 1,
		 ) );
	 }
	 else {
		wp_nav_menu( array(
			'container'   => 'ul',
			'container_id'   => !$sticky ? $this->get_id() : '',
			'before'      => false,
			'after'       => false,
			'link_before' => '',
			'link_after'  => '',
			'menu_class'     => esc_attr( implode( ' ', $classes ) ),
			'depth' => 1,
		));

	};
?>
<?php else: ?>
	<ul class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>">
	<?php
		foreach ( $items as $item ) {
			if ( empty( $item['url'] ) ) {
				continue;
			}
			$attr = array( 
				'href' => esc_url( $item['url'] ), 
				'target' => isset( $item['target'] ) ? $item['target'] : '_self', 
			);
			if( 'yes' === $localscroll ) {
				$attr['data-localscroll'] = 'true';
				$attr['data-localscroll-options'] = '{ "offsetElements": "[data-sticky-header] .mainbar-wrap, #wpadminbar, parent" }';
			}
			printf( '<li><a%s>%s</a></li>', ld_helper()->html_attributes( $attr ), do_shortcode( $item['label'] ) );
		}
	?>
	</ul>
<?php endif; ?>
<?php if( $sticky ) { ?></div><?php } ?>