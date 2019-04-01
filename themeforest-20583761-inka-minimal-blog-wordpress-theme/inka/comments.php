<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Inka
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="entry-comments mt-50">

	<?php if ( have_comments() ) : ?>
		<h6 class="heading bottom-line bottom-line-full mb-30">
			<?php
				comments_number( esc_html__( 'no responses', 'inka' ),
					esc_html__( '1 Comment', 'inka' ),
					esc_html__( '% Comments', 'inka' )
				);
			?>
		</h6>

		<?php deo_comments_pagination(); ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'             => 'ul',
					'short_ping'        => true,
					'avatar_size'       => 72,
					'per_page'          => '',
					'reverse_top_level' => true,
					'walker'            => new Deo_Walker_Comment()
				) );
			?>
		</ul><!-- .comment-list -->

		<?php deo_comments_pagination(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'inka' ); ?></p>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

		$fields = array(
			'author' =>
			'<div class="row"><div class="col-md-4"><label for="author">' . esc_html__( 'Name', 'inka' ) . '</label> <span class="required">*</span> <input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" required="required" /></div>',

			'email' =>
			'<div class="col-md-4"><label for="email">' . esc_html__( 'Email', 'inka' ) . '</label> <span class="required">*</span><input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" required="required" /></div>',

			'url' =>
			'<div class="col-md-4"><label for="url">' . esc_html__( 'Website', 'inka' ) . '</label><input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div>',

			'cookies' =>
			'<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
			'<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'inka' ) . '</label></p>'

		);

		$args = array(
			'class_submit'  => 'btn btn-lg btn-color btn-button mt-10',
			'title_reply_before' => '<h5 id="reply-title" class="heading text-center mb-40">',
			'title_reply_after' => '</h5>',
			'comment_notes_before' => '',
			'comment_field' => '<div class="form-group"><label for="comment">' . _x( 'Comment', 'noun', 'inka' ) . '</label> <span class="required">*</span><textarea id="comment" class="form-control" name="comment" rows="7" required="required"></textarea></div>',
			'fields' => apply_filters( 'comment_form_default_fields', $fields ),
			'submit_field' => '<p class="form-submit text-center">%1$s %2$s</p>',
		);

		comment_form( $args );

	?>

</div><!-- .entry-comments -->