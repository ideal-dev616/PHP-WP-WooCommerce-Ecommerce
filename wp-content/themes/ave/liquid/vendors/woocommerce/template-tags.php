<?php
/**
 * Custom template tags used to integrate this theme with WooCommerce.
 *
 * @package liquid
 */
 
/**
 * Displays woocommerce headling including: result count, ordering dropdown, list view switcher
 */
function liquid_woocommere_headline() {

?>
	<div class="woocommerce-pagination-ordering">
		<div class="row">
			
			<div class="col-md-6">
				<ul class="list-inline">
				<?php
					$view_type = liquid_woocommerce_get_products_list_view_type();
					if ( is_page() ):
						$page_id = get_the_ID();
					else:
						$page_id = wc_get_page_id( 'shop' );
					endif;
					$shop_page_url = get_permalink( $page_id );
					$list_view = liquid_helper()->add_to_url_from_get( add_query_arg( 'view=list', '', $shop_page_url ), array( 'view' ) );
					$grid_view = liquid_helper()->add_to_url_from_get( add_query_arg( 'view=grid', '', $shop_page_url ), array( 'view' ) );
				?>
					<li><a href="<?php echo esc_url( $grid_view ); ?>" class="shop-layout grid"><?php echo esc_html_e( 'Grid view', 'ave' ); ?></a></li>
					<li><a href="<?php echo esc_url( $list_view ); ?>" class="shop-layout list"><?php echo esc_html_e( 'List view', 'ave' ); ?></a></li>
				</ul>
				<div class="line">
					<div></div>
				</div>
				<?php woocommerce_catalog_ordering(); ?>			
				<div class="line">
					<div></div>
				</div>
				<?php woocommerce_pagination(); ?>
			</div> <!-- .col-md-6 -->	
		</div>
	</div>
<?php
}
