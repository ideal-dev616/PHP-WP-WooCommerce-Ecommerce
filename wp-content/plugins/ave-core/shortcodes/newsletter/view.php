<?php

extract( $atts );

$classes = array( 
	'ld-sf',
	$this->get_class( $style ), 
	$this->get_btn_class( $btn_style ), 
	$inputs_size, 
	$inputs_radius, 
	$inputs_border, 
	$inputs_shadow, 
	$btn_state, 
	$btn_position,
	$btn_shrink,
	$el_class, 
	$this->get_id() 

);
// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

?>
<div id="<?php echo $this->get_id(); ?>" class="<?php echo ld_helper()->sanitize_html_classes( $classes ); ?>" >

	<form id="ld_subscribe_form" class="ld_sf_form" method="post" action="<?php echo the_permalink() ?>">
		<p class="ld_sf_paragraph">
			<input type="email" class="email" class="ld_sf_text" id="email" name="email" placeholder="<?php echo esc_attr( $placeholder_text ) ?>" value="" />
		</p>
		<?php $this->get_submit_button(); ?>
		<input type="hidden" id="list_id" class="list_id" name="list_id" value="<?php echo $list_id ?>">
		<?php wp_nonce_field( 'ld-mailchimp-form' ); ?>
	</form>
	<div class="ld_sf_response"></div>
</div>