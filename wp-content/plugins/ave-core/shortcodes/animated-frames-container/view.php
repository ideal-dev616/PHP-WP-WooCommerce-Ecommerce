<?php

extract( $atts );

$classes = array(
	'lqd-af',
	$el_class, 
	$this->get_id() 
);

$this->generate_css();
	
?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" data-liquid-animatedframes="true" <?php $this->get_opts(); ?>>
	<div class="lqd-af-slides">
		<?php echo ld_helper()->do_the_content( $content ); ?>
	</div><!-- /.slides -->
	
	<nav class="lqd-af-slidenav">
		<button class="lqd-af-slidenav__item lqd-af-slidenav__item--prev">
			<svg width="36px" height="36px" class="lqd-af-button-circ" viewBox="0 0 36 36" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#000">
				<path d="M17.89548,35.29096 C27.5027383,35.29096 35.29096,27.5027383 35.29096,17.89548 C35.29096,8.28822168 27.5027383,0.5 17.89548,0.5 C8.28822168,0.5 0.5,8.28822168 0.5,17.89548 C0.5,27.5027383 8.28822168,35.29096 17.89548,35.29096 Z"></path>
			</svg>
			<svg xmlns="http://www.w3.org/2000/svg" class="lqd-af-button-arrow" width="12.5px" height="13.5px" viewbox="0 0 12.5 13.5" fill="none" stroke="#000">
				<path d="M11.489,6.498 L0.514,12.501 L0.514,0.495 L11.489,6.498 Z"/>
			</svg>
		</button>
		<button class="lqd-af-slidenav__item lqd-af-slidenav__item--next">
			<svg width="36px" height="36px" class="lqd-af-button-circ" viewBox="0 0 36 36" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#000">
				<path d="M17.89548,35.29096 C27.5027383,35.29096 35.29096,27.5027383 35.29096,17.89548 C35.29096,8.28822168 27.5027383,0.5 17.89548,0.5 C8.28822168,0.5 0.5,8.28822168 0.5,17.89548 C0.5,27.5027383 8.28822168,35.29096 17.89548,35.29096 Z"></path>
			</svg>
			<svg xmlns="http://www.w3.org/2000/svg" class="lqd-af-button-arrow" width="12.5px" height="13.5px" viewbox="0 0 12.5 13.5" fill="none" stroke="#000">
				<path d="M11.489,6.498 L0.514,12.501 L0.514,0.495 L11.489,6.498 Z"/>
			</svg>
		</button>
	</nav>

</div>