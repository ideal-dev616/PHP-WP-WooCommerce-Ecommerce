<div class="ld-pf-single ld-pf-single-2">
	
	<div class="container ld-container">
		<div class="row">
			<div class="col-md-12">

				<div class="pf-single-contents">
				
					<?php liquid_portfolio_media() ?>
				
					<div class="row d-md-flex align-items-center">
				
						<div class="col-md-6">
				
							<div class="pf-single-header pull-up bg-solid">
								<h2 class="pf-single-title mt-0 mb-4 font-weight-bold"
									data-fittext="true"
									data-fittext-options='{ "maxFontSize": "currentFontSize", "compressor": 0.6 }'>
									<?php the_title() ?>
								</h2>
				
								<?php liquid_portfolio_the_content() ?>
				
								<div class="clearfix mb-3"></div>
				
								<div class="pf-info d-lg-flex justify-content-between">
									<?php liquid_portfolio_date() ?>
									<?php liquid_portfolio_atts() ?>
								</div><!-- /.pf-info -->
				
							</div><!-- /.pf-single-header -->
				
						</div><!-- /.col-md-6 -->
				
						<div class="col-md-6 text-md-right mb-5 mb-md-0">
							<div class="d-md-flex align-items-center justify-content-end mb-4">
							<?php if( function_exists( 'liquid_portfolio_share' ) ) : ?>
								<small class="text-uppercase ltr-sp-1 mr-3"><?php esc_html_e( 'Share on', 'ave' ); ?></small>
								<?php liquid_portfolio_share( get_post_type() ); ?>
							<?php endif; ?>
							</div>
				
							<?php liquid_render_post_nav( get_post_type() ) ?>
				
						</div><!-- /.col-md-6 text-md-right -->
				
					</div><!-- /.row -->
				
				</div> <!-- /.pf-single-contents -->

			</div>
		</div>
	</div>

</div>