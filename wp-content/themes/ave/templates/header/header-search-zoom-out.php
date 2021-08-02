<?php 	
	$description = $atts['description'];

	$suggestions_title = $atts['suggestions_title'];
	$suggestions_title2 = $atts['suggestions_title2'];
	
	$suggestions = $atts['suggestions'];
	$suggestions2 = $atts['suggestions2'];

	$icon_text = $atts['icon_text'];

?>
<div class="ld-module-search lqd-module-search-zoom-out" data-module-style='lqd-search-style-zoom-out'>

<?php 
	$search_id = uniqid( 'search-' ); 
?>
	
	<span class="ld-module-trigger" data-ld-toggle="true" data-toggle="collapse" data-target="<?php echo '#' . esc_attr( $search_id ); ?>" aria-controls="<?php echo esc_attr( $search_id ) ?>" aria-expanded="false">
		<?php if( !empty( $icon_text ) ) { ?>
			<span class="ld-module-trigger-txt">
				<?php echo wp_kses_post( $icon_text ); ?>
			</span><!-- /.ld-module-trigger-txt -->
		<?php } ?>
		<span class="ld-module-trigger-icon">
			<i class="icon-ld-search"></i>
		</span><!-- /.ld-module-trigger-icon --> 
	</span><!-- /.ld-module-trigger -->
	
	<div class="ld-module-dropdown collapse" id="<?php echo esc_attr( $search_id ) ?>" aria-expanded="false">
		
		<div class="ld-search-form-container">

			<span class="lqd-module-search-close input-icon" aria-label="Close search form" data-ld-toggle="true" data-toggle="collapse" data-target="<?php echo '#' . esc_attr( $search_id ); ?>" aria-controls="<?php echo esc_attr( $search_id ) ?>" aria-expanded="false"><i class="icon-ion-ios-close"></i></span>
			<form class="ld-search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
				<input value="<?php echo get_search_query() ?>" name="s" type="search" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
				<?php if( !empty( $description ) ) { ?>
				<span class="lqd-module-search-info"><?php echo esc_html( $description ); ?></span>
				<?php } ?>
			</form>
			<div class="lqd-module-search-related">
				<?php if( !empty( $suggestions_title ) && !empty( $suggestions ) ) { ?>
				<div class="lqd-module-search-suggestion">
					<h3><?php echo esc_html( $suggestions_title ); ?></h3>
					<p><?php echo wp_kses_post( $suggestions ); ?></p>
				</div>
				<?php } ?>
				
				<?php if( !empty( $suggestions_title2 ) && !empty( $suggestions2 ) ) { ?>
				<div class="lqd-module-search-suggestion">
					<h3><?php echo esc_html( $suggestions_title2 ); ?></h3>
					<p><?php echo wp_kses_post( $suggestions2 ); ?></p>
				</div>
				<?php } ?>
			</div>
			
		</div><!-- /.ld-search-form-container -->
		
	</div><!-- /.ld-module-dropdown -->
	
</div><!-- /.module-search -->