<div class="liquid-lp-details">
	<time class="liquid-lp-date" datetime="<?php echo get_the_date( 'c' ); ?>"><?php printf( _x( '%s ago', '%s = human-readable time difference', 'ave' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
	<?php esc_html_e( 'in', 'ave' ); ?>
	<?php liquid_post_terms( array( 'taxonomy' => 'category', 'text' => esc_html__( '%s', 'ave' ) ) ); ?>
	<?php liquid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => esc_html__( 'Tagged: %s', 'ave' ), 'before' => ' | ' ) ); ?>
</div><!-- /.liquid-lp-details -->