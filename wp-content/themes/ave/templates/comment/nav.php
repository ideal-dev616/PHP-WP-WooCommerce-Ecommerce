<?php if ( get_option( 'page_comments' ) && 1 < get_comment_pages_count() ) : // Check for paged comments. ?>

	<nav class="navigation comment-navigation" role="navigation" aria-labelledby="comments-nav-title">

		<h3 id="comments-nav-title" class="screen-reader-text"><?php esc_html_e( 'Comments Navigation', 'ave' ); ?></h3>

		<?php
			if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'ave' ) ) ) :
				printf( '<div class="nav-previous">%s</div>', $prev_link );
			endif;

			if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'ave' ) ) ) :
				printf( '<div class="nav-next">%s</div>', $next_link );
			endif;
		?>

	</nav><!-- .comments-nav -->

<?php endif; // End check for paged comments. ?>
