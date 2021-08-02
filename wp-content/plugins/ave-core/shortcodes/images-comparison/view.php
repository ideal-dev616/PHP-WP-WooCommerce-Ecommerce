<?php

extract( $atts );

$classes = array( 'cd-image-container', $el_class, $this->get_id() );

?>
<figure id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">

	<?php $this->get_image() ?>
	<span class="cd-image-label" data-type="original"><?php esc_html_e( 'Before', 'ave-core' ); ?></span>

	<div class="cd-resize-img"> <!-- the resizable image on top -->

		<?php $this->get_second_image() ?>
		<span class="cd-image-label" data-type="modified"><?php esc_html_e( 'After', 'ave-core' ); ?></span>

	</div>
	<span class="cd-handle"></span>

</figure> <!-- cd-image-container -->