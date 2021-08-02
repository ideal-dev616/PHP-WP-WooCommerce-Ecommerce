<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<h2 class="woocommerce-Reviews-title">
			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'ave' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
			} else {
				esc_html_e( 'Reviews', 'ave' );
			}
			?>
		</h2>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'ave' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', 'ave' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'ave' ), get_the_title() ),
						'title_reply_to'       => __( 'Leave a Reply to %s', 'ave' ),
						'title_reply_before'   => '<span id="reply-title" class="comment-reply-title">',
						'title_reply_after'    => '</span>',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<p class="comment-form-author">' .
								'<span class="input-placeholder"
									data-split-text="true" data-split-options=\'{ "type": "chars" }\'
									data-custom-animations="true"
									data-ca-options=\'{ "triggerHandler": "focus", "triggerTarget": "input", "triggerRelation": "siblings", "offTriggerHandler": "blur", "animationTarget": "all-childs", "delay": 50, "animations": { "translateY": "-20%", "rotateX": -45, "opacity": 0 } }\'
								>' . esc_html__( 'Name', 'ave' ) . '&nbsp;<span class="required">*</span></span>' .
								'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></p>',
							'email'  => '<p class="comment-form-email">' .
								'<span class="input-placeholder"
									data-split-text="true" data-split-options=\'{ "type": "chars" }\'
									data-custom-animations="true"
									data-ca-options=\'{ "triggerHandler": "focus", "triggerTarget": "input", "triggerRelation": "siblings", "offTriggerHandler": "blur", "animationTarget": "all-childs", "delay": 50, "animations": { "translateY": "-20%", "rotateX": -45, "opacity": 0 } }\'
								>' . esc_html__( 'Email', 'ave' ) . '&nbsp;<span class="required">*</span></span>' .
								'<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required /></p>',
						),
						'label_submit'  => __( 'Submit', 'ave' ),
						'logged_in_as'  => '',
						'comment_field' => '',
					);

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<div class="comment-form-rating"><select class="woo-rating" name="rating" id="rating" aria-required="true" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'ave' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'ave' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'ave' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'ave' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'ave' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'ave' ) . '</option>
						</select></div>';
					}

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'ave' ), esc_url( $account_page_url ) ) . '</p>';
					}

					$comment_form['comment_field'] .= '<p class="comment-form-comment">'.
					'<span class="input-placeholder"
						data-split-text="true" data-split-options=\'{ "type": "chars" }\'
						data-custom-animations="true"
						data-ca-options=\'{ "triggerHandler": "focus", "triggerTarget": "textarea", "triggerRelation": "siblings", "offTriggerHandler": "blur", "animationTarget": "all-childs", "delay": 50, "animations": { "translateY": "-20%", "rotateX": -45, "opacity": 0 } }\'
					>' . esc_html__( 'Review', 'ave' ) . '&nbsp;<span class="required">*</span></span>' .	
					'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'ave' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
