<?php 

extract( $atts );

$items = vc_param_group_parse_atts( $items );

$classes = array(
	'ld-dropdown-menu',
	$hover_style,

	$this->get_id()
);

$dropdown_id = uniqid( 'dropdown-' );

$this->generate_css();

?>
<div class="header-module <?php echo $el_class ?>">
	<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">

		<span class="ld-module-trigger" role="button" data-ld-toggle="true" data-toggle="collapse" data-target="<?php echo '#' . $dropdown_id; ?>" aria-controls="<?php echo $dropdown_id ?>" aria-expanded="false">
			<span class="ld-module-trigger-txt"><?php if( !empty( $trigger_label ) ) { ?><?php echo esc_html( $trigger_label ); ?><?php }; ?> <i class="fa fa-angle-down"></i></span>
		</span><!-- /.ld-module-trigger -->		

		<div class="ld-module-dropdown left collapse" id="<?php echo $dropdown_id ?>" aria-expanded="false">
			<div class="ld-dropdown-menu-content">
			<?php if( 'wp_menus' === $source ) : ?>
			<?php
			
				if( is_nav_menu( $menu_slug ) ) {
					wp_nav_menu( array(
						'menu'           => $menu_slug,
						'container'      => 'ul',
						'menu_id'        => false,
						'before'         => false,
						'after'          => false,
						'link_before'    => '',
						'link_after'     => '',
						'menu_class'     => false,
						'depth' => 1,
					 ) );
				 }
				 else {
					wp_nav_menu( array(
						'container'   => 'ul',
						'container_id'   => false,
						'before'      => false,
						'after'       => false,
						'link_before' => '',
						'link_after'  => '',
						'menu_class'  => false,
						'depth' => 1,
					));
			
				};
			?>
			<?php else: ?>
				<ul>
				<?php
					foreach ( $items as $item ) {
						if ( empty( $item['url'] ) ) {
							continue;
						}
						$attr = array( 'href' => esc_url( $item['url'] ), 'target' => '_self' );	
						printf( '<li><a%s>%s</a></li>', ld_helper()->html_attributes( $attr ), esc_html( $item['label'] ) );
					}
				?>
				</ul>
			<?php endif; ?>
			</div><!-- /.ld-dropdown-menu-content -->
		</div><!-- /.ld-module-dropdown -->
		
	</div><!-- /.ld-dropdown-menu -->
</div>