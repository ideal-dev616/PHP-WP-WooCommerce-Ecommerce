<?php

extract( $atts );

$identities = vc_param_group_parse_atts( $identities );

if( empty( $identities ) )
	return;

$classes = array( 
	'social-icon', 
	$style, 
	$shape, 
	$scheme, 
	$size, 
	$orientation,

	$el_class, 
	$this->get_id(), 

);

$this->generate_css();

?>
<ul class="<?php echo ld_helper()->sanitize_html_classes( $classes ) ?>" id=<?php echo $this->get_id() ?>>
<?php
	foreach ( $identities as $social ) {
		if ( empty( $social['url'] ) ) {
			continue;
		}
		
		$social_classname = $social['network'];
		if ( strpos( $social_classname, 'fa-' ) === false) {
			$social_classname = 'fa-' . $social_classname;
		}

		$attr = array( 'href' => esc_url( $social['url'] ), 'target' => '_blank', 'rel' => 'nofollow' );
		printf( '<li><a%s><i class="fa %s"></i></a></li>',
			ld_helper()->html_attributes( $attr ), $social_classname
		);
	}
?>
</ul>