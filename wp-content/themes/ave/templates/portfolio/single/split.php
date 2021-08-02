<?php
	$split_bg_style = '';
	$split_bg = liquid_helper()->get_option( 'portfolio-split-bg' );
	if( !empty( $split_bg ) ) {
		$split_bg_style = 'style="background: ' . esc_attr( $split_bg ) . ';"';
	}
	
	$content = get_post_meta( get_the_ID(), 'portfolio-description', true );
	$items = liquid_helper()->get_option( 'portfolio-split-items' );
	
	$prev_post = get_adjacent_post( true, '', true, 'liquid-portfolio-category' );
	$next_post = get_adjacent_post( true, '', false, 'liquid-portfolio-category' );
	
	$terms = get_the_terms( get_the_ID(), 'liquid-portfolio-category' );
	
	$crunchifyURL       = urlencode( get_permalink() );
	$crunchifyTitle     = str_replace( ' ', '%20', get_the_title());
	$crunchifyThumbnail = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'full' );

	// Construct sharing URL without using any script
	$facebookURL  = 'https://www.facebook.com/sharer/sharer.php?u=' . $crunchifyURL . '&amp;t=' . $crunchifyTitle;
	$twitterURL   = 'https://twitter.com/intent/tweet?text=' . $crunchifyTitle . '&amp;url=' . $crunchifyURL;
	$pinterestURL = 'https://pinterest.com/pin/create/button/?url=' . $crunchifyURL . '&amp;media=' . $crunchifyThumbnail . '&amp;description=' . $crunchifyTitle;
 	
?>
<header class="pf-single-header py-5">
	<div class="container">
			<div class="row d-md-flex flex-wrap align-items-stretch">
			<div class="col-md-7 pr-md-5 pt-5" data-custom-animations="true" data-ca-options='{ "triggerHandler": "inview", "animationTarget": "all-childs", "duration": 1200, "delay": 120, "initValues": { "translateY": "60", "opacity": 0 }, "animations": { "translateY": 0, "opacity": 1 } }'>
				
				<?php the_title( '<h3 class="h5 text-uppercase font-weight-bold mb-4 mt-0">', '</h3>' ) ?>
				<?php echo wp_kses_post( wpautop( $content ) ); ?>
	
			</div><!-- /.col-md-7 -->
			<div class="col-md-5 d-flex flex-wrap">
	
				<div class="pf-info text-white px-5 py-5"  data-custom-animations="true" data-ca-options='{ "triggerHandler": "inview", "animationTarget": ".pf-info-item", "duration": 1200, "delay": 120, "initValues": { "translateY": "60", "opacity": 0 }, "animations": { "translateY": 0, "opacity": 1 } }'>
	
					<span class="pf-info-bg" data-stretch-element="true" data-stretch-options='{ "to": "right" }' <?php echo $split_bg_style; ?>></span><!-- /.pf-info-bg stretch-to-right -->
					
					<?php foreach( $items['pf_title_field'] as $key => $item ) : ?>
					<span class="pf-info-item mb-4 w-100">
						<span class="text-uppercase ltr-sp-05"><?php echo esc_html( $item ) ?>:</span>
						<?php echo esc_html( $items['pf_text_field'][$key] ); ?>
					</span>
					<?php endforeach; ?>
				</div><!-- /.pf-info -->
			</div><!-- /.col-md-5 -->
		</div><!-- /.row -->
	</div>
</header><!-- /.pf-single-header -->

<div class="pf-single-contents">
	<?php the_content() ?>
</div><!-- /.pf-single-contents -->

<?php liquid_render_related_posts( get_post_type() ) ?>

<div class="pf-footer mt-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="pf-footer-top">
					<div class="row d-md-flex flex-wrap align-items-center">

						<div class="col-md-4 col-xs-12">

							<ul class="ld-pf-foot-category">
								<?php foreach( $terms as $term ) { ?>
								<li>
									<a href="<?php echo get_term_link( $term->slug, 'liquid-portfolio-category' ); ?>"><?php echo esc_html( $term->name ); ?></a>
								</li>
								<?php }; ?>

							</ul>

						</div><!-- /.col-md-4 -->

						<div class="col-md-4 col-xs-12 text-md-center">
							<h5 class="my-0"><?php esc_html_e( 'Share', 'ave' ); ?></h5>
						</div><!-- /.col-md-4 -->

						<div class="col-md-4 col-xs-12 text-md-right">

							<ul class="social-icon social-icon-lg scheme-dark my-0">
								<li>
									<a target="_blank" href="<?php echo esc_url( $facebookURL ); ?>"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a target="_blank" href="<?php echo esc_url( $twitterURL ); ?>"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a target="_blank" href="<?php echo esc_url( $pinterestURL ); ?>"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>

						</div><!-- /.col-md-4 -->
					</div><!-- /.row -->
				</div><!-- /.pf-footer-top -->

				<hr>
				
				<?php if( $prev_post || $next_post ) : ?>
				
				<div class="pf-footer-bottom">
					<nav class="post-nav pf-nav">
						<div class="row">
							<?php if( $prev_post ) { ?>
							<div class="col-md-6">
								<a href="<?php echo get_permalink( $prev_post ) ?>" class="nav-previous px-0"><i class="fa fa-angle-left mr-2"></i> <?php esc_html_e( 'Previous', 'ave' ); ?></a>
							</div><!-- /.col-md-6 -->
							<?php } ?>

							<?php if( $next_post ) { ?>
							<div class="col-md-6 text-md-right">
								<a href="<?php echo get_permalink( $next_post ) ?>" class="nav-next px-0"><?php esc_html_e( 'Next', 'ave' ); ?> <i class="fa fa-angle-right ml-2"></i></a>
							</div><!-- /.col-md-6 -->
							<?php } ?>

						</div><!-- /.row -->
					</nav><!-- /.pf-nav -->
				</div><!-- /.pf-footer-bottom -->
				<?php endif; ?>
				
			</div><!-- /.col-md-12 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.pf-footer -->