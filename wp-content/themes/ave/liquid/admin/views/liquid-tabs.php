<?php 
	
	$theme = liquid_helper()->get_current_theme();
	
?>
<nav class="lqd-dsd-menubard">

	<span class="lqd-dsd-logo">
		<img src="<?php echo get_template_directory_uri() . '/liquid/assets/img/dashboard/logo.png'; ?>" alt="<?php echo esc_attr( $theme->name ); ?>">
		<?php printf( '<span class="lqd-v">%s</span>', $theme->version ); ?>
	</span>

	<ul class="lqd-dsd-menu">
		<li class="<?php echo liquid_helper()->active_tab( 'liquid' ); ?>">
			<a href="<?php echo liquid_helper()->dashboard_page_url(); ?>">
				<span><?php esc_html_e( 'Dashboard', 'ave' ); ?></span>
			</a>
		</li>
		<li class="<?php echo liquid_helper()->active_tab( 'liquid-plugins' ); ?>">
			<a href="<?php echo liquid_helper()->plugin_page_url(); ?>">
				<span><?php esc_html_e( 'Install Plugins', 'ave' ); ?></span>
			</a>
		</li>
		<li class="<?php echo liquid_helper()->active_tab( 'liquid-import-demos' ); ?>">
			<a href="<?php echo liquid_helper()->import_demos_page_url(); ?>">
				<span><?php esc_html_e( 'Import Demo', 'ave' ); ?></span>
			</a>
		</li>
		<li class="<?php echo liquid_helper()->active_tab( 'liquid-support' ); ?>">
			<a href="<?php echo liquid_helper()->support_page_url(); ?>">
				<span><?php esc_html_e( 'Support', 'ave' ); ?></span>
			</a>
		</li>
		<li>
			<a href="https://docs.liquid-themes.com/" target="_blank">
				<i class="icon-md-help-circle"></i>
				<span><?php esc_html_e( 'Documentations', 'ave' ); ?></span>
			</a>
		</li>
	</ul>

</nav><!-- /.lqd-dsd-menubard -->
