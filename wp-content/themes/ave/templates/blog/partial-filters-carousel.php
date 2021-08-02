<?php

extract( $atts );

if( function_exists( 'ld_helper' ) ) {
	$filter_cats = ld_helper()->terms_are_ids_or_slugs( $filter_cats, 'category' );
}

$terms = get_terms( array(
	'taxonomy'   => 'category',
	'hide_empty' => false,
	'include'    => $filter_cats
) );

if( empty( $terms ) ) {
	return;
}

$filter_wrapper = array(
	'liquid-filter-items'

);

$filter_classnames = array(
	'filter-list',
	'filter-list-style-1',
	'ltr-sp-1',
	$filter_color,
	$filter_size,
	$filter_decoration,
	$filter_transformation,
	$filter_weight,
);

$filter_title_classnames = array(
	'liquid-filter-items-label',
	$filter_title_size,
	$filter_title_weight,
	$filter_title_transformation
);
?>
<div class="col-md-5">
					
	<?php if( !empty( $filter_title ) ) { ?>
	<header class="fancy-title">
		<?php if( !empty( $filter_subtitle ) ) { ?>
			<h6 class="text-uppercase"><?php echo wp_kses_post( $filter_subtitle ); ?></h6>
		<?php } ?>
		<h2><?php echo wp_kses_post( do_shortcode( $filter_title ) ); ?></h2>
	</header>
	<?php } ?>

	<div class="liquid-filter-items">
		<ul class="<?php echo join( ' ', $filter_classnames ); ?>" id="<?php echo esc_attr( $filter_id ); ?>">
			<li class="active" data-filter="*"><span><?php echo esc_html( $filter_lbl_all ) ?></span></li>
			<?php foreach( $terms as $term ) {
				printf( '<li data-filter=".%s"><span>%s</span></li>', $term->slug, $term->name );
			} ?>
		</ul>
	</div>
		
	<?php $this->get_button()  ?>

</div><!-- /.col-md-12 -->