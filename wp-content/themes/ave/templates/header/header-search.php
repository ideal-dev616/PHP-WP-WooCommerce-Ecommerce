<?php 
	$search_id = uniqid( 'search-' ); 
	$icon_text = isset( $atts['icon_text'] ) ? $atts['icon_text'] : '';
?>
<div class="ld-module-search">
	
	<span class="ld-module-trigger" role="button" data-ld-toggle="true" data-toggle="collapse" data-target="<?php echo '#' . esc_attr( $search_id ); ?>" aria-controls="<?php echo esc_attr( $search_id ) ?>" aria-expanded="false">
		<?php if( !empty( $icon_text ) ) { ?>
			<span class="ld-module-trigger-txt">
				<?php echo wp_kses_post( $icon_text ); ?>
			</span><!-- /.ld-module-trigger-txt -->
		<?php } ?>
		<span class="ld-module-trigger-icon">
			<i class="icon-ld-search"></i>
		</span><!-- /.ld-module-trigger-icon --> 
	</span><!-- /.ld-module-trigger -->
	
	<div role="search" class="ld-module-dropdown collapse" id="<?php echo esc_attr( $search_id ) ?>" aria-expanded="false">
		<div class="ld-search-form-container">
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>" class="ld-search-form">
				<input type="search" placeholder="<?php echo esc_attr_x( 'Start searching', 'placeholder', 'ave' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
				<span role="search" class="input-icon" data-ld-toggle="true" data-toggle="collapse" data-target="<?php echo '#' . esc_attr( $search_id ); ?>" aria-controls="<?php echo esc_attr( $search_id ) ?>" aria-expanded="false"><i class="icon-ld-search"></i></span>
			</form>
		</div><!-- /.ld-search-form-container -->
	</div><!-- /.ld-module-dropdown -->
	
</div><!-- /.module-search -->