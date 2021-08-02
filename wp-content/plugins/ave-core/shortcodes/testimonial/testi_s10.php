<?php
extract( $atts );

$classes = array( 
	$this->get_classes( $style ),
	$align,
	$details_size,
	$avatar_size,
	$el_class,
	$this->get_id()
);

$this->generate_css();

?>
<div id="<?php echo $this->get_id() ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>">
	
	<div class="testimonial-details">
		
		<?php $this->get_avatar( 'mb-4'); ?>
		
		<div class="testimonial-quote-mark mb-3 mt-1">
			<svg width="44" height="31" xmlns="http://www.w3.org/2000/svg">
				<defs>
					<linearGradient x1="-22.0182292%" y1="17.9746094%" x2="141.744792%" y2="50%" id="linearGradient-1">
						<stop stop-color="#8330F0" offset="0%"></stop>
						<stop stop-color="#60EAA0" offset="100%"></stop>
					</linearGradient>
				</defs>
				<path fill="url(#linearGradient-1)" d="m14.08301,13.12891c2.73439,1.80665 4.10156,4.41892 4.10156,7.83691c0,2.78322 -0.8789,5.07812 -2.63672,6.88477c-1.75782,1.80665 -3.97948,2.70996 -6.66504,2.70996c-2.49024,0 -4.63866,-0.8789 -6.44531,-2.63672c-1.80665,-1.75782 -2.70996,-4.07714 -2.70996,-6.95801c0,-2.5879 0.90331,-5.20018 2.70996,-7.83691l8.49609,-13.03711l8.86231,0l-5.71289,13.03711zm22.33887,0c2.73438,1.80665 4.10156,4.41892 4.10156,7.83691c0,2.78322 -0.8789,5.07812 -2.63672,6.88477c-1.75782,1.80665 -3.97948,2.70996 -6.66504,2.70996c-2.49025,0 -4.63866,-0.8789 -6.44531,-2.63672c-1.80665,-1.75782 -2.70996,-4.07714 -2.70996,-6.95801c0,-2.5879 0.90331,-5.20018 2.70996,-7.83691l8.49609,-13.03711l8.86231,0l-5.71289,13.03711z"/>
			</svg>
		</div><!-- /.testimonial-quote-mark -->
		
		<div class="testimonial-info">
			<?php $this->get_name( 'h5' ,'font-weight-medium mb-3' ); ?>
			<?php $this->get_position( 'h6', 'font-weight-medium text-uppercase ltr-sp-175 md mb-3' ); ?>
		</div><!-- /.testimonial-info -->
		
	</div><!-- /.testimonial-details -->
	
	<div class="testimonial-quote mb-0">
		<?php $this->get_quote(); ?>
	</div><!-- /.testimonial-qoute -->
	
</div><!-- /.testimonial -->
