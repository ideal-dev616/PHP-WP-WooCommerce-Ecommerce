<div class="ld-module-search ld-module-search-visible-form">

<?php 
	$search_id = uniqid( 'search-' ); 
?>
	
	<div class="ld-search-form-container">
		<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>" class="ld-search-form">
			<input type="search" placeholder="<?php echo esc_attr_x( 'Start searching', 'placeholder', 'ave' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
			<span class="input-icon" data-toggle="collapse" data-target="<?php echo '#' . esc_attr( $search_id ); ?>" aria-controls="<?php echo esc_attr( $search_id ) ?>" aria-expanded="false"><i class="icon-ld-search"></i></span>
		</form>
	</div><!-- /.ld-search-form-container -->
	
</div><!-- /.module-search -->