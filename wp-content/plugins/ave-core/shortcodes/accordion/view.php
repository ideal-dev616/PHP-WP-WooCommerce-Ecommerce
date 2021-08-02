<?php
extract( $atts );

// Enqueue Conditional Script
$this->scripts();

if( empty( $items ) ) {
	return '';
}

// classes
$classes = array( 
	'accordion', 
	$this->get_size(), 
	$this->get_active_style(), 
	$borders, 
	$border_round, 
	$expander_position,
	$expander_size,

	$el_class, 
	$this->get_id() 
);

// icons
$icon = liquid_get_icon( $atts, true );
$icon_active = liquid_get_icon( $atts, true, 'active_' );

$icon        = ! empty( $icon ) ? $icon['icon'] : 'fa fa-plus';
$icon_active = ! empty( $icon_active ) ? $icon_active['icon'] : 'fa fa-minus';

$active_tab = ! empty( $active_tab ) ? intval( $active_tab ) - 1 : 0;
$this->generate_css();
?>
<div class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id="<?php echo $this->get_id() ?>" role="tablist" aria-multiselectable="true">

<?php

foreach( $items as $i => $item ):
	$in = $i == $active_tab ? ' in' : '';
	$active = $i == $active_tab ? ' active' : '';
	$expanded = $i == $active_tab ? 'true' : 'false';
	$collapsed = $i == $active_tab ? '' : 'collapsed';
?>
	<div class="accordion-item panel <?php echo $active ?> <?php echo $item['extra']; ?>">

		<div class="accordion-heading" role="tab" id="heading_<?php echo $this->get_id( $item ) ?>">
			<h4 class="accordion-title">
				<a class="<?php echo $collapsed ?>" data-toggle="collapse" data-parent="#<?php echo $this->get_id() ?>" href="#<?php echo $this->get_id( $item ) ?>" aria-expanded="<?php echo $expanded ?>" aria-controls="<?php echo $this->get_id( $item ) ?>">
					
					<?php if( $item['icon']['type'] ) {
						printf( '<span class="accordion-title-icon mr-2"><i class="%s"></i></span>', $item['icon']['icon'] );
					} ?>

					<?php echo wp_kses_data( $item['title'] ) ?>

					<?php if( 'yes' === $show_icon ) { ?>
					<span class="accordion-expander">
						<i class="<?php echo $icon ?>"></i>
						<i class="<?php echo $icon_active ?>"></i>
					</span>
					<?php } ?>

				</a>
				
			</h4>
		</div>

		<div id="<?php echo $this->get_id( $item ) ?>" class="accordion-collapse collapse<?php echo $in ?>" role="tabpanel" aria-labelledby="heading_<?php echo $this->get_id( $item ) ?>">
			<div class="accordion-content">
			<?php echo $item['content']; ?>
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>