<main>

	<div class="lqd-dsd-wrap">

		<?php include_once( get_template_directory() . '/liquid/admin/views/liquid-tabs.php' ); ?>
	
		<header class="lqd-dsd-header">
			<div class="lqd-dsd-header-inner">
				<h2><?php esc_html_e( 'Import a Demo', 'ave' ); ?></h2>
				<p><?php esc_html_e( 'Choose a pre-built website for starting a quick design process.', 'ave' ) ?></p>
			</div><!-- /.lqd-dsd-header-inner -->
			<div class="lqd-msg lqd-dsd-notice">
				<p><span><?php esc_html_e( 'Important:', 'ave' ); ?></span> <?php esc_html_e( 'Make sure to activate required plugins prior to import a demo.', 'ave' ) ?></p>
			</div><!-- /.lqd-dsd-notice -->
		</header>

		<?php

			include( locate_template( 'theme/liquid-demo-config.php' ) );
			$i = 0;
			wp_localize_script( 'liquid-admin', 'liquid_demos', $demos );

		?>
		<div class="lqd-solid-wrap">
			<div class="lqd-row">

			<?php 
				
		    if ( 'valid' != get_option( 'ave_purchase_code_status', false ) ) {
		
		        echo '<div class="error"><p>' .
		             sprintf( wp_kses_post( __( 'The %s theme needs to be registered. %sRegister Now%s', 'ave' ) ), 'Ave', '<a href="' . admin_url( 'admin.php?page=liquid') . '">' , '</a>' ) . '</p></div>';
		    }
		    else {
				
				foreach( $demos as $id => $demo ): ?>

				<div class="lqd-col lqd-col-4">
		
					<div class="lqd-dsd-demo-item">

						<figure>
							<img src="<?php echo esc_url( $demo['screenshot'] ); ?>" alt="<?php echo esc_attr( $demo['title'] ); ?>">
							<div class="lqd-dsd-overlay">
								<a href="#" id="import-id" data-import-id="<?php echo esc_attr( $i ); ?>" data-demo-id="<?php echo esc_attr( $id ); ?>" class="lqd-btn lqd-btn-gradient lqd-import-popup">
									<span><?php esc_html_e( 'Import Demo', 'ave' ); ?></span>
								</a>
								<a target="_blank" href="<?php echo esc_url( $demo['preview'] ); ?>" class="lqd-btn">
									<span><?php esc_html_e( 'Preview', 'ave' ); ?></span>
								</a>
							</div><!-- /.lqd-dsd-overlay -->
						</figure>
						<h3><?php echo esc_html( $demo['title'] ); ?></h3>
					</div><!-- /.lqd-dsd-demo-item -->		
				</div><!-- /.lqd-col -->		

	            <?php $i++; ?>
			<?php endforeach; } ?>

			</div><!-- /.lqd-row -->

		<script type="text/template" id="tmpl-demo-import-modules">
			<div id="lqd-progress-popup" class="lqd-imp-popup-wrap is-active">
				<div class="lqd-imp-progress">
					<h6><?php esc_html_e( 'Importing...', 'ave' ); ?></h6>
					<div id="liquid-progress" class="importing"><?php esc_html_e( 'Working', 'ave' )?> <span>.</span><span>.</span><span>.</span></div>
					<div class="lqd-progressbar">
						<div class="lqd-progressbar-inner" style="width: 0%">
							<span id="lqd-loader" class="lqd-progressbar-percentage"><?php esc_html_e( '0%', 'ave' ); ?></span><!-- /.lqd-progressbar-percentage -->
						</div><!-- /.lqd-progressbar-inner -->
					</div><!-- /.lqd-progressbar -->
				</div><!-- /.lqd-imp-progress -->
			</div>
		</script>

		<script type="text/template" id="tmpl-demo-popup">
			<div id="lqd-popup" class="lqd-imp-popup-wrap is-active">
				<div class="lqd-imp-popup-inner">
				
					<span class="lqd-imp-popup-close">
						<svg width="12px" height="12px" viewBox="0 0 12 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g id="Dashboard---Import-Panel---Final" transform="translate(-751.000000, -539.000000)" fill="#2B2B2B">
											<g id="Group-5-Copy" transform="translate(727.000000, 514.000000)">
													<polygon id="close---material" points="35.82 26.36 31.18 31 35.82 35.64 34.64 36.82 30 32.18 25.36 36.82 24.18 35.64 28.82 31 24.18 26.36 25.36 25.18 30 29.82 34.64 25.18"></polygon>
											</g>
									</g>
							</g>
						</svg>
					</span>
					
					<div class="lqd-imp-popup-head">
					
						<figure>
							<img src="<%= screenshot %>" alt="<%= title %>">
						</figure>
						
						<div class="lqd-imp-notes">
							<h6><%= title %></h6>
							<div class="lqd-msg lqd-dsd-notice">
								<p><span><?php esc_html_e( 'Important:', 'ave' ); ?></span> <?php esc_html_e( 'Make sure to activate required plugins prior to import a demo.', 'ave' ); ?></p>
							</div><!-- /.lqd-msg lqd-dsd-notice -->
						</div><!-- /.lqd-imp-notes -->
				
					</div><!-- /.lqd-imp-popup-head -->
					<div class="lqd-imp-popup-content lqd-row">
					
						<div class="lqd-col lqd-col-7">
							<p><?php esc_html_e( 'Make sure to activate required plugins prior to import a demo.', 'ave' ); ?></p>
						</div><!-- /.lqd-col lqd-col-7 -->
					
					
					<div id="lqd-import-opts" class="lqd-row">
					
					<div class="lqd-col lqd-col-6">
						<span class="lqd-imp-opt">
							<input id="lqd-imp-all" type="checkbox" value="set_demo_content" checked="">
							<label for="lqd-imp-all"></label>
							<span><?php esc_html_e( 'All Content', 'ave' ); ?></span>
						</span>
					</div><!-- /.lqd-col lqd-col-6 -->
					
					<div class="lqd-col lqd-col-6" style="display:none;">
						<span class="lqd-imp-opt">
							<input id="lqd-imp-revslider" type="checkbox" value="import_slider" checked="">
							<label for="lqd-imp-content"></label>
							<span><?php esc_html_e( 'Revslider', 'ave' ); ?></span>
						</span>
					</div><!-- /.lqd-col lqd-col-6 -->
					
					<div class="lqd-col lqd-col-6">
						<span class="lqd-imp-opt">
							<input id="lqd-imp-media" type="checkbox" value="import_media" checked="">
							<label for="lqd-imp-media"></label>
							<span><?php esc_html_e( 'Media Attachments', 'ave' ); ?></span>
						</span>
					</div><!-- /.lqd-col lqd-col-6 -->
					
					<div class="lqd-col lqd-col-6">
						<span class="lqd-imp-opt">
							<input id="lqd-imp-sidebar" type="checkbox" value="import_theme_widgets" checked="">
							<label for="lqd-imp-sidebar"></label>
							<span><?php esc_html_e( 'Sidebars', 'ave' ); ?></span>
						</span>
					</div><!-- /.lqd-col lqd-col-6 -->
					
					<div class="lqd-col lqd-col-6">
						<span class="lqd-imp-opt">
							<input id="lqd-imp-example" type="checkbox" value="import_theme_options" checked="">
							<label for="lqd-imp-example"></label>
							<span><?php esc_html_e( 'Theme Options', 'ave' ) ?></span>
						</span>
					</div><!-- /.lqd-col lqd-col-6 -->
					
					<div class="lqd-col lqd-col-6">
						<span class="lqd-imp-opt">
							<input id="lqd-imp-content" type="checkbox" value="set_home_page" checked="">
							<label for="lqd-imp-content"></label>
							<span><?php esc_html_e( 'Home Page', 'ave' ); ?></span>
						</span>
					</div><!-- /.lqd-col lqd-col-6 -->
					
					</div>
					
					<div class="lqd-col lqd-col-12">
		
						<div class="lqd-imp-terms">
							<span class="lqd-imp-opt">
								<input id="terms-agree" name="terms-agree" type="checkbox" value="no">
								<label for="terms-agree"></label>
								<span><?php esc_html_e( 'This process will overwrite your current settings, are you sure you want to proceed?', 'ave' ); ?></span>
							</span>
						</div><!-- /.lqd-imp-terms -->
		
					</div><!-- /.lqd-col lqd-col-12 -->
					
					<div class="lqd-col lqd-col-12">
						<button class="lqd-import-btn" data-revslider="true" data-id="0">
							<span><?php esc_html_e( 'Import Demo', 'ave' ); ?></span>
							<i></i>
						</button>
					</div><!-- /.lqd-col lqd-col-12 -->
					
					</div><!-- /.lqd-imp-popup-content -->
				
				</div><!-- /.lqd-imp-popup-inner -->
			</div>
		
		</script>
			
		</div><!-- /.lqd-solid-wrap -->
	</div><!-- /.lqd-dsd-wrap -->

</main>
