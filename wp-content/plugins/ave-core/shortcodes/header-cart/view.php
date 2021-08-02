<?php

	extract( $atts );

	$this->generate_css();

?>

<div class="header-module <?php echo $atts['show_on_mobile']; ?> <?php echo $atts['offcanvas_placement']; ?> <?php echo $atts['show_on_addtocart']; ?> <?php echo $atts['label_weight']; ?>">
<?php

if( $enable_offcanvas ) {
	$located = locate_template( 'templates/header/header-cart-offcanvas.php' );
}
else {
	$located = locate_template( 'templates/header/header-cart.php' );
}
include $located;


?>
</div>