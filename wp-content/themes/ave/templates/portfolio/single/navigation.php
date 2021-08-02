<?php

$prev_post = get_adjacent_post( true, '', true, 'liquid-portfolio-category' );
$next_post = get_adjacent_post( true, '', false, 'liquid-portfolio-category' );

$prev_post_ID    = isset( $prev_post->ID ) ? $prev_post->ID : '';
$prev_post_link  = get_permalink( $prev_post_ID );
$prev_post_title = get_the_title( $prev_post_ID );

$next_post_ID    = isset( $next_post->ID ) ? $next_post->ID : '';
$next_post_link  = get_permalink( $next_post_ID );
$next_post_title = get_the_title( $next_post_ID );

$style = get_post_meta( get_the_ID(), 'portfolio-style', true );
$style = $style ? $style : 'gallery-stacked';

$nav_style = get_post_meta( get_the_ID(), 'portfolio-navigation-style', true );

$attributes = array(
	'class' => 'portfolio-nav ' . $nav_style,
);

if( in_array( $style, array( 'gallery-stacked-4' ) ) ) {
	$attributes['class'] = 'portfolio-nav bordered mb-50';
}
if( in_array( $style, array( 'gallery-slider', 'gallery-stacked-4', 'gallery-stacked-5', 'gallery-stacked-6', 'featured-image' ) ) ) {
	$attributes['style'] = 'background-color: #fff;';
}
?>
<?php if( $prev_post || $next_post ) { ?>
<nav class="post-nav pf-nav pf-nav-style-2 d-flex flex-row flex-wrap justify-content-between mt-5 mb-0 py-0">
	<?php if( $prev_post ): ?>
	<div class="nav-previous py-4">
		<a href="<?php echo get_permalink( $prev_post ) ?>" rel="prev" class="d-flex align-items-center flex-row-reverse text-right">
			<?php if( has_post_thumbnail( $prev_post ) ) : ?>
			<figure>
				<?php echo get_the_post_thumbnail( $prev_post, array( 500, 290 ) ) ?>
			</figure>
			<?php endif; ?>
			<div>
				<span class="screen-reader-text"><?php esc_html_e( 'Previous Work', 'ave' ) ?></span>
				<span aria-hidden="true" class="nav-subtitle text-uppercase"><?php esc_html_e( 'Previous', 'ave' ) ?></span>
				<span class="nav-title"><?php echo esc_html( $prev_post_title ); ?></span>
			</div>
		</a>
	</div>
	<?php endif; ?>

	<?php if( $next_post ): ?>
	<div class="nav-next py-4">
		<a href="<?php echo get_permalink( $next_post ) ?>" rel="next" class="d-flex align-items-center text-left">
			<?php if( has_post_thumbnail( $next_post ) ) : ?>
			<figure>
				<?php echo get_the_post_thumbnail( $next_post, array( 500, 290 ) ) ?>
			</figure>
			<?php endif; ?>
			<div>
				<span class="screen-reader-text"><?php esc_html_e( 'Next Work', 'ave' ); ?></span>
				<span aria-hidden="true" class="nav-subtitle text-uppercase"><?php esc_html_e( 'Next', 'ave' ); ?></span>
				<span class="nav-title"><?php echo esc_html( $next_post_title ); ?></span>
			</div>
		</a>
	</div>
	<?php endif; ?>
</nav><!-- /.post-nav -->
<?php } ?>