<?php
	
extract( $atts );

$classes = array(
	'reset-ul',
	$inline,

	$el_class,
	$this->get_id() 

);		

$this->generate_css();

?>
<div class="one-bullet-list">

	<ul id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>">
		<?php $this->get_items(); ?>
	</ul>

</div><!-- /.one-bullet-list -->