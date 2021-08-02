<?php

$author_meta_enable = liquid_helper()->get_option( 'post-author-meta-enable' );

?>
<div class="post-meta">

	<?php if( 'off' !== $author_meta_enable ) { ?>
	<span class="byline">
		<span class="block text-uppercase ltr-sp-1"><?php esc_html_e( 'Author:', 'ave' ); ?></span>
		<?php liquid_author_link() ?>
	</span>	
	<?php } ?>

	<span class="posted-on">
		<span class="block text-uppercase ltr-sp-1"><?php esc_html_e( 'Published on:', 'ave' ); ?></span>

		<a href="<?php the_permalink(); ?>" rel="bookmark">
		<?php
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			printf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				get_the_date()
			);
		?>
		</a>

	</span>

	<span class="cat-links">
		<span class="block text-uppercase ltr-sp-1"><?php esc_html_e( 'Published in:', 'ave' ); ?></span>
		<?php liquid_get_category(); ?>
	</span>

</div><!-- /.post-meta -->