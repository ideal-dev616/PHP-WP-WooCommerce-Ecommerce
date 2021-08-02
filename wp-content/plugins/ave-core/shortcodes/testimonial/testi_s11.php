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
	
	<div class="testimonial-quote-mark mb-3 mt-3">
	<svg xmlns="http://www.w3.org/2000/svg" width="58" height="42" viewBox="0 0 58 42">
		<path d="M72.7773438,74.171875 C76.4231953,76.5807412 78.2460938,80.0637793 78.2460938,84.6210938 C78.2460938,88.3320498 77.0742305,91.391915 74.7304688,93.8007812 C72.386707,96.2096475 69.4244971,97.4140625 65.84375,97.4140625 C62.5234209,97.4140625 59.6588662,96.2421992 57.25,93.8984375 C54.8411338,91.5546758 53.6367188,88.4622588 53.6367188,84.6210938 C53.6367188,81.1705557 54.8411338,77.6875176 57.25,74.171875 L68.578125,56.7890625 L80.3945312,56.7890625 L72.7773438,74.171875 Z M102.5625,74.171875 C106.208352,76.5807412 108.03125,80.0637793 108.03125,84.6210938 C108.03125,88.3320498 106.859387,91.391915 104.515625,93.8007812 C102.171863,96.2096475 99.2096533,97.4140625 95.6289062,97.4140625 C92.3085771,97.4140625 89.4440225,96.2421992 87.0351562,93.8984375 C84.62629,91.5546758 83.421875,88.4622588 83.421875,84.6210938 C83.421875,81.1705557 84.62629,77.6875176 87.0351562,74.171875 L98.3632812,56.7890625 L110.179688,56.7890625 L102.5625,74.171875 Z" transform="translate(-53 -56)"/>
	</svg>
	</div><!-- /.testimonial-quote-mark -->
	
	<div class="testimonial-quote mt-2">
		<?php $this->get_quote(); ?>
	</div><!-- /.testimonial-qoute -->
	
	<div class="testimonial-details mt-4 mb-3">
		<div class="testimonial-info">
			<?php $this->get_name(); ?>
			<?php $this->get_position(); ?>
		</div><!-- /.testimonial-info -->
	</div><!-- /.testimonial-details -->
	
</div><!-- /.testimonial -->