<main>

	<div class="lqd-dsd-wrap">

		<?php include_once( get_template_directory() . '/liquid/admin/views/liquid-tabs.php' ); ?>
	
		<header class="lqd-dsd-header">
			<div class="lqd-dsd-header-inner">
				<h2><?php esc_html_e( 'Welcome to Ave!', 'ave' ); ?></h2>
				<p><?php esc_html_e( 'Total design freedom for everyone.', 'ave' ) ?></p>
			</div><!-- /.lqd-dsd-header-inner -->
		</header>
		
		<div class="lqd-row">

			<div class="lqd-col lqd-col-6">
				<?php include_once( get_template_directory() . '/liquid/admin/views/liquid-registration.php' ); ?>
			</div><!-- /.lqd-col -->

			<div class="lqd-col lqd-col-6">

				<?php include_once( get_template_directory() . '/liquid/admin/views/liquid-features.php' ); ?>

			</div><!-- /.lqd-col -->

		</div><!-- /.lqd-row -->

	</div><!-- /.lqd-dsd-wrap -->

</main>
