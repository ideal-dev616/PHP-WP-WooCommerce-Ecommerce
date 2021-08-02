<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Ave theme
 */

get_header();

$enable_particles = liquid_helper()->get_option( 'error-404-enable-particles' );
if( empty( $enable_particles ) ) {
	$enable_particles = 'on';
}
$data_particles = ( 'on' === $enable_particles ? 'true' : 'false' );

?>
<article id="post-404" <?php post_class( 'page-404 error-404 not-found entry' ); ?>>
	
	<div class="container">
		<div class="row">	
			<div class="col-md-8 col-md-offset-2 text-center">
	
				<div class="text-404">
	
					<div class="ld-particles-container">
	
						<?php $particle_id_1 = uniqid( 'particle-' ); ?>
	
						<div
							class="re-particles-inner"
							id="<?php echo esc_attr( $particle_id_1 ); ?>"
							data-particles="<?php echo esc_attr( $data_particles );  ?>"
							data-particles-options='{ "particles": { "number": { "value": 15 }, "opacity": { "random": true, "anim": { "enable": true, "opacity_min": 0.7 } }, "size": { "value": 30, "anim": { "enable": true, "speed": 1, "size_min": 0.7 } }, "move": { "direction": "top-right", "speed": 2 } }, "interactivity": {} }'>
						</div><!-- /.re-particles-inner -->
	
					</div><!-- /.ld-particles-container -->
		
					<h1 data-fittext="true" data-fittext-options='{ "compressor": 0.25, "minFontSize": 150, "maxFontSize": 300 }' class="liquid-counter-element" data-enable-counter="true" data-counter-options='{ "targetNumber": "404", "blurEffect": true }'>
						<!--/.THIS IS NOT TRANSLATABLE OR DYNAMIC THING, IT NEEDS FOR THE EFFECTS -->
						<span>000</span>
						
					</h1><!-- /.liquid-counter-element -->
	
					<div class="ld-particles-container">
	
						<?php $particle_id_2 = uniqid( 'particle-' ); ?>
	
						<div
							class="re-particles-inner"
							id="<?php echo esc_attr( $particle_id_2 ); ?>"
							data-particles="<?php echo esc_attr( $data_particles );  ?>"
							data-particles-options='{ "particles": { "number": { "value": 15 }, "opacity": { "random": true, "anim": { "enable": true, "opacity_min": 0.7 } }, "size": { "value": 30, "anim": { "enable": true, "speed": 1, "size_min": 0.7 } }, "move": { "direction": "top-left", "speed": 2 } }, "interactivity": {} }'>
						</div><!-- /.re-particles-inner -->
	
					</div><!-- /.ld-particles-container -->
	
				</div><!-- /.text-404 -->
	
				<?php if( !class_exists( 'ReduxFramework' ) ) : ?>

					<h3 class="font-weight-bold mb-1"><?php esc_html_e( 'Looks like you are lost.', 'ave' ); ?></h3>
					<p><?php esc_html_e( 'We can’t seem to find the page you’re looking for.', 'ave' ) ?></p>					
					<a href="<?php echo esc_url( home_url('/') ) ?>" class="btn btn-md btn-solid btn-gradient circle btn-icon-left font-weight-bold text-uppercase ltr-sp-1 wide">
						<span>
							<span class="btn-gradient-bg"></span>
							<span class="btn-icon">
								<i class="icon-ion-ios-arrow-round-back"></i>
							</span>
							<span class="btn-txt"><?php esc_html_e( 'Go Home!', 'ave' ); ?></span>
							<span class="btn-gradient-bg btn-gradient-bg-hover"></span>
						</span>
					</a>

				<?php else : ?>

					<h3 class="font-weight-bold mb-1"><?php liquid_helper()->get_option_echo( 'error-404-subtitle', 'html', '', 'options' ) ?></h3>
					<?php echo apply_filters( 'the_content', liquid_helper()->get_option( 'error-404-content', 'post', '', 'options' ) ) ?>
					<?php if( 'on' === liquid_helper()->get_option( 'error-404-enable-btn', 'raw', '', 'options' ) ) { ?>
						<a href="<?php echo esc_url( home_url('/') ) ?>" class="btn btn-md btn-solid btn-gradient circle btn-icon-left font-weight-bold text-uppercase ltr-sp-1 wide">
						<span>
							<span class="btn-gradient-bg"></span>
							<span class="btn-icon">
								<i class="icon-ion-ios-arrow-round-back"></i>
							</span>
							<span class="btn-txt"><?php liquid_helper()->get_option_echo( 'error-404-btn-title', 'html', '', 'options' ) ?></span>
							<span class="btn-gradient-bg btn-gradient-bg-hover"></span>
						</span>
					</a>
					<?php } ?>
				<?php endif; ?>
				
				
	
			</div><!-- /.col-md-8 -->
	
		</div><!-- /.row -->
	
	</div>
	
</article>

<?php get_footer();