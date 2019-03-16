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
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
				/* translators: 1: reviews count 2: product name */
				echo '<p class="woocommerce-Reviews-title">';
                printf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'juliet' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
                echo '</p>';
			} else {
				//_e( 'Reviews', 'juliet' );
			}
		?>

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

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();
                    if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
                        $comment_field =
                            '<div class="row form-group comment-form-rating">
                                <div class="col-md-2 form-label">' . esc_html__( 'Your rating', 'juliet' ) . ' <span class="asterisk">*</span></div>
                                <div class="col-md-8"><select name="rating" id="rating" aria-required="true" required>
                                        <option value="">' . esc_html__( 'Rate&hellip;', 'juliet' ) . '</option>
                                        <option value="5">' . esc_html__( 'Perfect', 'juliet' ) . '</option>
                                        <option value="4">' . esc_html__( 'Good', 'juliet' ) . '</option>
                                        <option value="3">' . esc_html__( 'Average', 'juliet' ) . '</option>
                                        <option value="2">' . esc_html__( 'Not that bad', 'juliet' ) . '</option>
                                        <option value="1">' . esc_html__( 'Very poor', 'juliet' ) . '</option>
                                    </select></div>
                            </div>';
                    } else {
                        $comment_field = '';
                    }

                    $comment_textarea = '
                        <div class="row form-group comment-form-comment">
                            <div class="col-md-2 form-label">' . esc_html__( 'Your review', 'juliet' ) . ' <span class="asterisk">*</span></div>
                            <div class="col-md-8"><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true" required></textarea></div>
                        </div>';

                    $commend_field = $comment_field . $comment_textarea;
                        /*if( is_user_logged_in() ) {
                            $close_wrapper = '</div>';
                            $commend_field_logged_in = $comment_field . $comment_textarea;
                        } else {
                            $close_wrapper = '';
                            $commend_field_logged_in = '';
                        }*/

					$comment_form = array(
						'title_reply'          => __( 'Add a review', 'juliet' ),
						'title_reply_to'       => __( 'Leave a Reply to %s', 'juliet' ),
						'title_reply_before'   => '<h2 id="reply-title" class="comment-reply-title">',
						'title_reply_after'    => '</h2>',
                        'comment_field'        => $commend_field,
						'comment_notes_after'  => '',
						'fields'               => array(
                            'author' => '<div class="row form-group comment-form-author">
		                                    <div class="col-md-2 form-label">' . esc_html__( 'Name', 'juliet' ) . ' <span class="asterisk">*</span></div>' .
		                                    '<div class="col-md-8"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" class="form-control" aria-required="true" required /></div>
		                                </div>',
                            'email'  => '<div class="row form-group comment-form-author">
		                                    <div class="col-md-2 form-label">' . esc_html__( 'Email Address', 'juliet' ) . ' <span class="asterisk">*</span></div>' .
		                                    '<div class="col-md-8"><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" class="form-control" aria-required="true" required /></div>
		                                </div>',
						),
						'label_submit'  => __( 'Submit', 'juliet' ),
						'class_submit' => 'btn btn-dark btn-block',
						'logged_in_as'  => '',
					);

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'juliet' ), esc_url( $account_page_url ) ) . '</p>';
					}

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'juliet' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
