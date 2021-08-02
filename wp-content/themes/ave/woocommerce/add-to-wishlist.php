<?php
/**
 * Add to wishlist template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly

global $product;

$hide = ( $exists && ! $available_multi_wishlist ) ? 'hide': 'show';
$show = ( $exists && ! $available_multi_wishlist ) ? 'show' : 'hide';
$none = ( $exists && ! $available_multi_wishlist ) ? 'none': 'block';
$block = ( $exists && ! $available_multi_wishlist ) ? 'block' : 'none';
?>

<div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr( $product_id ) ?>">
	<?php if( ! ( $disable_wishlist && ! is_user_logged_in() ) ): ?>
	    <div class="yith-wcwl-add-button <?php echo esc_attr( $hide ); ?>" style="display:<?php echo esc_attr( $none ); ?>">

	        <?php yith_wcwl_get_template( 'add-to-wishlist-' . $template_part . '.php', $atts ); ?>

	    </div>
	    <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
	        <span class="feedback"><?php echo esc_html( $product_added_text ) ?></span>
	        <a href="<?php echo esc_url( $wishlist_url )?>" rel="nofollow">
		        <i class="fa fa-heart-o"></i>
	            <?php echo apply_filters( 'yith-wcwl-browse-wishlist-label', $browse_wishlist_text )?>
	        </a>
	    </div>
	    <div class="yith-wcwl-wishlistexistsbrowse <?php echo esc_attr( $show ); ?>" style="display:<?php echo esc_attr( $block ); ?>">
	        <span class="feedback"><?php echo esc_html( $already_in_wishslist_text ) ?></span>
	        <a href="<?php echo esc_url( $wishlist_url ) ?>" rel="nofollow">
		        <i class="fa fa-heart-o"></i>
	            <?php echo apply_filters( 'yith-wcwl-browse-wishlist-label', $browse_wishlist_text )?>
	        </a>
	    </div>
	    <div class="yith-wcwl-wishlistaddresponse"></div>
	<?php else: ?>
		<a href="<?php echo esc_url( add_query_arg( array( 'wishlist_notice' => 'true', 'add_to_wishlist' => $product_id ), get_permalink( wc_get_page_id( 'myaccount' ) ) ) )?>" rel="nofollow" class="<?php echo str_replace( 'add_to_wishlist', '', $link_classes ) ?>" >
			<i class="fa fa-heart-o"></i>
			<?php echo wp_kses_post( $icon ) ?>
			<?php echo wp_kses_post( $label ) ?>
		</a>
	<?php endif; ?>

</div>