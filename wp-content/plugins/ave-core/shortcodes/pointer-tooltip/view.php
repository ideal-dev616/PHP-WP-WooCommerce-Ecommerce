<?php

extract( $atts );

$classes = array( $position, $el_class, $this->get_id() );

$this->generate_css();

// Enqueue Conditional Script
$this->scripts();

?>

<div id="<?php echo $this->get_id(); ?>" class="info-box <?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
	<div class="info-box-contents">
	  	
	  <?php $this->get_title() ?>
	  <?php $this->get_content() ?>

	</div>
</div><!-- /.info-box -->