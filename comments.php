<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package Comunidade_WordPress_BR
 * @since 1.0.0
 */
?>
<div id="comments" class="content-wrap" itemscope itemtype="http://schema.org/Comment">
	<?php if ( post_password_required() ) : ?>
		<span class="nopassword"><?php _e( 'This post is password protected. Enter the password to view all comments.', 'comunidade-wordpress-br' ); ?></span>
</div><!-- #comments -->
		<?php
		return;
	endif;

	if ( have_comments() ) : ?>
		<h2 id="comments-title">
			<?php
			comments_number( __( '0 Comments', 'comunidade-wordpress-br' ), __( '1 Comment', 'comunidade-wordpress-br' ), __( '% Comments', 'comunidade-wordpress-br' ) );
			echo ' ' . __( 'to', 'comunidade-wordpress-br' ) . ' <span>&quot;' . get_the_title() . '&quot;</span>';
			?>
		</h2>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Old Comments', 'comunidade-wordpress-br' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'New Comments &rarr;', 'comunidade-wordpress-br' ) ); ?></div>
			</nav>
		<?php endif; ?>
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'cmm_wpbr_comment_loop' ) ); ?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Old Comments', 'comunidade-wordpress-br' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'New Comments &rarr;', 'comunidade-wordpress-br' ) ); ?></div>
			</nav>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<span class="nocomments"><?php _e( 'Comments closed.', 'comunidade-wordpress-br' ); ?></span>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		comment_form(
		array(
			'comment_notes_after' => '',
			'comment_field' => '<div class="comment-form-comment form-group"><label class="control-label" for="comment">' . __( 'Comment', 'comunidade-wordpress-br' ) . '</label><div class="controls"><textarea id="comment" name="comment" cols="45" rows="8" class="form-control" aria-required="true"></textarea></div></div>',
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<div class="comment-form-author form-group">' . '<label class="control-label" for="author">' . __( 'Name', 'comunidade-wordpress-br' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label><input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
				'email' => '<div class="comment-form-email form-group"><label class="control-label" for="email">' . __( 'E-mail', 'comunidade-wordpress-br' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label><input class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
				'url' => '<div class="comment-form-url form-group"><label class="control-label" for="url">' . __( 'Website', 'comunidade-wordpress-br' ) . '</label>' . '<input class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>' ) )
		)
	); ?>
</div><!-- #comments -->
