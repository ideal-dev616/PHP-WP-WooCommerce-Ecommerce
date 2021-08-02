<?php

$current_theme = wp_get_theme();

if( $current_theme->parent_theme ) {
	$template_dir  = basename( get_template_directory() );
	$current_theme = wp_get_theme($template_dir);
}

$installed_plugins = get_plugins();
$plugins = TGM_Plugin_Activation::$instance->plugins;

?>
<main>

	<div class="lqd-dsd-wrap">

		<?php include_once( get_template_directory() . '/liquid/admin/views/liquid-tabs.php' ); ?>
	
		<header class="lqd-dsd-header">
			<div class="lqd-dsd-header-inner">
				<h2><?php esc_html_e( 'Install Plugins', 'ave' ); ?></h2>
				<p><?php esc_html_e( 'Choose a pre-built website for starting a quick design process.', 'ave' ); ?></p>
			</div><!-- /.lqd-dsd-header-inner -->
			<div class="lqd-msg lqd-dsd-notice">
				<p><span><?php esc_html_e( 'Important:', 'ave' ); ?></span> <?php esc_html_e( 'Make sure to activate required plugins prior to import a demo.', 'ave' ); ?></p>
			</div><!-- /.lqd-dsd-notice -->
		</header>

		<div class="lqd-solid-wrap">
			<div class="lqd-row">
	        
	        <?php
		        
		    if ( 'valid' != get_option( 'ave_purchase_code_status', false ) ) {
		
		        echo '<div class="error"><p>' .
		             sprintf( wp_kses_post( __( 'The %s theme needs to be registered. %sRegister Now%s', 'ave' ) ), 'Ave', '<a href="' . admin_url( 'admin.php?page=liquid') . '">' , '</a>' ) . '</p></div>';
		    }
		    else {

				foreach( $plugins as $plugin ) :
					$class = $status = $display_status = '';
					$file_path = $plugin['file_path'];
	
					// Install
					if( !isset( $installed_plugins[ $file_path ] ) ) {
						$status = 'not-installed';
					}
					// No Active
					elseif ( is_plugin_inactive( $file_path ) ) {
						$status = 'installed';
					}
					// Deactive
					elseif( !is_plugin_inactive( $file_path ) ) {
						$status = 'active';
						$class = ' lqd-dsd-plugin-active';
						$display_status = esc_html__( 'Active:', 'ave' );
					}
			?>

				<div class="lqd-col lqd-col-3">
					<div class="lqd-dsd-plugin<?php echo esc_attr( $class ); ?>">
					<span class="lqd-dsd-plugin-icon">
						<img src="<?php echo esc_url( $plugin['liquid_logo'] ); ?>" alt="<?php echo esc_attr( $plugin['name'] ) ?>">
					</span>
					<h3><?php printf( '<span>%s</span>', $display_status ); ?> <?php echo esc_html( $plugin['name'] ) ?></h3>
					<p><?php echo esc_html( $plugin['liquid_description'] ) ?></p>
					
					<?php liquid_helper()->tgmpa_plugin_action( $plugin, $status ); ?>
				</div><!-- /.lqd-dsd-plugin -->
				</div><!-- /.lqd-col -->

			<?php endforeach; } ?>

			</div><!-- /.lqd-row -->
		</div><!-- /.lqd-solid-wrap -->
	</div><!-- /.lqd-dsd-wrap -->

</main>