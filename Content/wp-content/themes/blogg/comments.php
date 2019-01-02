<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogg
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

	if ( comments_open() || '0' != get_comments_number() ) {

	if ( post_password_required() ) {
		return;
	}

	if ( comments_open() ) {
		$comment_class = 'comments-open';
	} else {
		$comment_class = 'comments-closed';
	}
?>

<div id="comments" class="comments-area <?php echo esc_attr( $comment_class ); ?>">
	<div class="comments-wrap">

		<?php if ( have_comments() ) : ?>
			<h5 class="comment-reply-title comments-title">
				<span>
				<?php
					$comments_number = get_comments_number();
					if ( '1' === $comments_number ) {
						/* translators: %s: post title */
						printf( 
						esc_html_x( 'One Comment', 'comments title', 'blogg' ) );
					} else {
						printf(
							/* translators: %1$s for number of comments */
							_nx(
								'%1$s Comment',
								'%1$s Comments',
								$comments_number,
								'comments title',
								'blogg'
							),
							esc_html(number_format_i18n( $comments_number ) ) // WPCS: XSS OK							
						);
					}				
				?>
				</span>
			</h5>

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 65,
						'callback'    => 'blogg_comment'
					) );
				?>
			</ol><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above" class="comment-navigation">
				<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'blogg' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'blogg' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'blogg' ) ); ?></div>
			</nav><!-- #comment-nav-above -->
			<?php endif; ?>

		<?php endif; ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><span><?php esc_html_e( 'Comments are closed.', 'blogg' ); ?></span></p>
		<?php endif; ?>
		
	<?php 
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		// For opt-in relating to GDPR
		$consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		
		$comments_args = array(
			'label_submit' => esc_html__( 'Submit Comment', 'blogg' ),
			'title_reply'  => esc_html__( 'Write a Comment', 'blogg'  ),
			'comment_notes_after' => '',
			'comment_field' =>  
				'<p class="comment-form-comment">' .
				'<textarea id="comment" name="comment" placeholder="' . esc_attr__( '* Message', 'blogg' ) . '" rows="8" aria-required="true">' .
				'</textarea></p>',
			'fields' => apply_filters( 'comment_form_default_fields', array (
				'author' =>
					'<div class="comment-form-column-wrapper"><p class="comment-form-author comment-form-column">' .
					'<input id="author" name="author" placeholder="' . esc_attr__( '* Name)', 'blogg' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'"' . $aria_req . ' /></p>',
				'email' =>
					'<p class="comment-form-email comment-form-column">' .
					'<input id="email" name="email" placeholder="' . esc_attr__( '* Email', 'blogg' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'"' . $aria_req . ' /></p>',
				'url' =>
					'<p class="comment-form-url comment-form-column">' .
					'<input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'blogg' ). '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" /></p></div>',
				'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
  '<label for="wp-comment-cookies-consent" class="cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.','blogg' ) . '</label></p>'					
			) ),
		);
		comment_form( $comments_args );
	?>
		
		
	</div><!-- .comments-wrap -->
</div><!-- #comments -->

<?php 
}  
?>