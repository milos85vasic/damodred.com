<?php
/**
 * The template for displaying comments
 *
 * @package kale
 */

if ( post_password_required() ) { return; }

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

$fields =  array(
    'author'    =>  '<div class="row"><div class="col-sm-6"><div class="form-group form-group-author"><label class="form-label form-label-author">'. esc_html__( 'Name', 'kale' ) . ($req ? '<span class="asterik">*</span>' : '') . '</label><input type="text" class="form-control" id="author" name="author" placeholder="" value="' . esc_attr( $commenter['comment_author'] ) . '" /></div>',

    'email'     =>  '<div class="form-group form-group-email"><label class="form-label form-label-email">'. esc_html__( 'Email Address', 'kale' ) .($req ? '<span class="asterik">*</span>' : '') . '</label><input type="email" class="form-control" name="email" id="email" placeholder="" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" /></div>',

    'url'       => '<div class="form-group form-group-url"><label class="form-label form-label-url">' . esc_html__( 'Website', 'kale' ) . '</label><input type="text" class="form-control" name="url" id="url" placeholder="" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div></div>',

	'cookies' => '<div class="form-group form-group-cookie"><input id="comment-cookies-consent" name="comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'kale' ) . '</label></div>'
);

$comment_field = '<div class="form-group form-group-comment"><label class="form-label form-label-comment">'. esc_html__( 'Comment', 'kale' ) .'</label><textarea rows="5" cols="" class="form-control" id="comment" name="comment" placeholder=""></textarea></div>';

$class_submit = 'btn btn-default';
$comment_form_args = array(
	'fields'        =>  apply_filters( 'comment_form_default_fields', $fields ),
	'comment_field' =>  $comment_field,
	'class_submit'  =>  $class_submit
); ?>

<div id="comments" class="comments">

    <?php if ( have_comments() ) { ?>
		<h3 class="comment-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'kale' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'kale'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h3>

		<?php the_comments_navigation(); ?>

        <ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 0,
				) );
			?>
		</ul>

		<?php the_comments_navigation(); ?>

	<?php } ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'kale' ); ?></p>
	<?php } ?>

	<?php if ( comments_open() ) {
        if ( get_option('comment_registration') && !is_user_logged_in() ) { ?>
            <p class="login-to-comment"><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'kale'), wp_login_url( get_permalink() )); ?></p>
        <?php } else {
            comment_form($comment_form_args);
        }
    } ?>


</div>