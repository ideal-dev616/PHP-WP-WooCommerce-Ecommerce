<li <?php liquid_helper()->attr( 'comment' ); ?>>
	<article id="div-comment-3" class="comment-body">
		<footer class="comment-meta">
			<div class="comment-author vcard">
				<h2 class="screen-reader-text"><?php echo esc_html__( 'Post comment', 'ave' ) ?></h2>
				<?php echo get_avatar( $comment, 70 ); ?>
				<b <?php liquid_helper()->attr( 'comment-author' ); ?>><?php comment_author_link(); ?></b>
				<span class="says"><?php esc_html_e( 'says', 'ave' ) ?>:</span>
			</div> <!-- .comment-author -->
			
			<div class="comment-metadata">
				<a <?php liquid_helper()->attr( 'comment-permalink' ); ?>><time <?php liquid_helper()->attr( 'comment-published' ); ?>><?php printf( esc_html__( '%s ago', 'ave' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time></a>
			</div> <!-- .comment-metadata -->
		</footer> <!-- .comment-meta -->
		
		<div class="comment-content">
			<?php comment_text(); ?>
		</div> <!-- .comment-content -->
		
		<div class="comment-extras">
			<div class="reply">
				<?php liquid_comment_reply_link(); ?>
			</div><!-- /.reply -->
			<?php if ( $comment->comment_approved == '0' ) { ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'ave' ) ?></p>
			<?php } ?>
		</div>
	</article> <!-- .comment-body -->
