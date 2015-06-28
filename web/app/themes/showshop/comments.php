<?php
/**
 *	The template for displaying Comments.
 *
 *	@since showshop 1.0
 */

if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">


	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'showshop' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'comment_function', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'showshop' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'showshop' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'showshop' ) ); ?></div>
		</nav>
		<?php endif;  ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'showshop' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

</div><!-- #comments .comments-area -->