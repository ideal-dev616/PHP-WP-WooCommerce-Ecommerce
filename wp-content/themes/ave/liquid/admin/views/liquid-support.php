<main>

	<div class="lqd-dsd-wrap">

		<?php include_once( get_template_directory() . '/liquid/admin/views/liquid-tabs.php' ); ?>
	
		<header class="lqd-dsd-header">
			<div class="lqd-dsd-header-inner">
				<h2><?php esc_html_e( 'Liquid Help Center', 'ave' ); ?></h2>
				<p><?php esc_html_e( 'Browse articles, submit a ticket, view the changelog.', 'ave' ); ?> <br> <?php esc_html_e( 'Get all the help you need.', 'ave' ); ?> </p>
			</div><!-- /.lqd-dsd-header-inner -->
		</header>

		<div class="lqd-solid-wrap">
			<div class="lqd-row">

			<div class="lqd-col lqd-col-4">

				<?php include_once( get_template_directory() . '/liquid/admin/views/support/knowledge.php' ); ?>
				
			</div><!-- /.lqd-col -->
			
			<div class="lqd-col lqd-col-4">
				
				<?php include_once( get_template_directory() . '/liquid/admin/views/support/ticket.php' ); ?>
				
			</div><!-- /.lqd-col -->
			
			<div class="lqd-col lqd-col-4">
				
				<?php include_once( get_template_directory() . '/liquid/admin/views/support/changelog.php' ); ?>
					
			</div><!-- /.lqd-col -->




			</div><!-- /.lqd-row -->
		</div><!-- /.lqd-solid-wrap -->
	</div><!-- /.lqd-dsd-wrap -->

</main>