<?php

extract( $atts );

if( function_exists( 'ld_helper' ) ) {
	$filter_cats = ld_helper()->terms_are_ids_or_slugs( $filter_cats, 'liquid-portfolio-category' );
}

$terms = get_terms( array(
	'taxonomy'   => 'liquid-portfolio-category',
	'hide_empty' => false,
	'include'    => $filter_cats
) );

if( empty( $terms ) ) {
	return;
}

$filter_classnames = array(
	'filter-list',
	'filter-list-inline',
	$filter_color,
	$filter_size,
	$filter_decoration,
	$filter_transformation,
	$filter_weight,
);

$filter_title_classnames = array(
	'liquid-filter-items-label',
	$tag_to_inherite,
	$filter_title_size,
	$filter_title_weight,
	$filter_title_transformation
);

?>
<div class="row">
	<div class="col-xs-12">					
		<div class="liquid-filter-items align-items-end align-items-end justify-content-between mb-7" id="<?php echo esc_attr( $filter_id ); ?>">	
			<div class="liquid-filter-items-inner" >
				
				<?php if( !empty( $filter_title ) ) { ?>
					<span class="<?php echo join( ' ', $filter_title_classnames ); ?>"><?php echo wp_kses_post( do_shortcode( $filter_title ) );  ?></span>
				<?php } ?>

				<ul class="<?php echo join( ' ', $filter_classnames ); ?>">
					<li class="active" data-filter="*"><span><?php echo esc_html( $filter_lbl_all ) ?></span></li>
					<?php foreach( $terms as $term ) {
						printf( '<li data-filter=".%s"><span>%s</span></li>', $term->slug, $term->name );
					} ?>
				</ul>
			</div><!-- /.liquid-filter-items-inner -->
		</div><!-- /.liquid-filter-items -->
	</div><!-- /.col-md-12 -->
</div><!-- /.row -->