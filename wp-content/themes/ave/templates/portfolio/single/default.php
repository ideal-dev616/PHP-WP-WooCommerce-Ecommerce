<?php
	
$enable_header = liquid_helper()->get_option( 'portfolio-enable-header' );	
if( 'off' !== $enable_header ) :

?>
<header class="pf-single-header py-5">

	<div class="container">

		<div class="row d-lg-flex align-items-end pt-3 pb-5">
			<div class="col-lg-7 col-md-12 mb-lg-0 mb-5">
				
				<?php the_terms( get_the_ID(), 'liquid-portfolio-category', '<ul class="pf-single-cat my-0 text-uppercase ltr-sp-1 reset-ul comma-sep-li"><li>', '</li> <li>', '</li></ul>' ); ?>	
				<?php the_title( '<h2 class="pf-single-title size-xl my-3 font-weight-bold" data-fittext="true" data-fittext-options=\'{ "maxFontSize": "currentFontSize", "compressor": 0.7 }\'>', '</h2>' ) ?>
				<?php liquid_portfolio_subtitle( '<h4 class="my-0">', '</h4>' ); ?>
	
			</div><!-- /.col-lg-7 -->
			
			<div class="col-lg-5 col-md-12">
				<div class="row d-flex align-items-end justify-content-between">
	
					<div class="col-md-6">
						<div class="pf-info d-lg-flex justify-content-between">
							<hr>
							<?php liquid_portfolio_date() ?>
							<?php liquid_portfolio_atts() ?>
						</div><!-- /.pf-info -->
					</div><!-- /.col-md-6 -->
	
					<div class="col-md-6 text-md-right">					
						<?php if( function_exists( 'liquid_portfolio_share' ) ) : ?>
							<?php liquid_portfolio_share( get_post_type() ); ?>
						<?php endif; ?>
					</div><!-- /.col-md-6 -->
	
				</div><!-- /.row -->
	
			</div><!-- /.col-lg-5 -->
		</div><!-- /.row -->
		
	</div><!-- /.container -->

</header><!-- /.pf-single-header -->
<?php endif; ?>

<div class="pf-single-contents">
	<?php the_content() ?>
</div><!-- /.pf-single-contents -->
<?php liquid_render_related_posts( get_post_type() ) ?>