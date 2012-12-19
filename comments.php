<div id="comments">

	<?php if ( post_password_required() ) : ?>
		<p class="nopassword">
			<?php _e( 'This post is password protected. Enter the password to view any comments.', 'atlantis-lakeballs' ); ?>
		</p>
	</div>

	<?php

	return;
	endif;

	?>

	<?php if ( have_comments() ) : ?>

	<h2 id="comments-title">
		<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'atlantis-lakeballs' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
	</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'atlantis_lakeballs_comment' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>

		<nav id="comment-nav-below">
			<h1 class="assistive-text">
				<?php _e( 'Comment navigation', 'atlantis-lakeballs' ); ?>
			</h1>
			<div class="nav-previous">
				<?php previous_comments_link( __( '&larr; Older Comments', 'atlantis-lakeballs' ) ); ?>
			</div>
			<div class="nav-next">
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'atlantis-lakeballs' ) ); ?>
			</div>
		</nav>

		<?php endif; ?>

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	<p class="nocomments">
		<?php _e( 'Comments are closed.', 'atlantis-lakeballs' ); ?>
	</p>

	<?php endif; ?>

	<?php comment_form(); ?>

</div>