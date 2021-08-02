<?php

extract( $atts );

// classes
$classes = array( 
	'iconbox',
	'iconbox-side',
	$this->get_heading_size(),
	$this->get_size(),

	$el_class,
	$this->get_id(),

);

$this->generate_css();

?>
<div class="header-module">
	<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id(); ?>">
								
		<?php $this->get_the_icon(); ?>
		<?php if( !empty( $this->atts['content'] ) ) { ?>
			<div class="contents">
		<?php } ?>
		<?php $this->get_title(); ?>
		<?php $this->get_content(); ?>
		<?php if( !empty( $this->atts['content'] ) ) { ?>
			</div>
		<?php } ?>
		
	</div><!-- /.iconbox -->
</div>