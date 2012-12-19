<?php get_header(); ?>

<div class="row">
	<?php get_sidebar(); ?>

	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php printf( __( 'Tag Archives: %s', 'atlantis-lakeballs' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
					</h1>

					<?php

					$tag_description = tag_description();

					if ( ! empty( $tag_description ) ) {
						echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
					}

					?>
				</header>

				<div id="content" role="main">

					<?php if ( have_posts() ) : ?>

						<?php while( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', get_post_format() ); ?>

						<?php endwhile; ?>

						<?php atlantis_lakeballs_content_nav( 'nav-below' ); ?>

					<?php else : ?>

						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title">
									<?php _e( 'Nothing Found', 'atlantis-lakeballs' ); ?>
								</h1>
							</header>

							<div class="entry-content">
								<p>
									<?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'atlantis-lakeballs' ); ?>
								</p>
								<?php get_search_form(); ?>
							</div>
						</article>

					<?php endif; ?>

					<div class="clear"></div>
				</div>

				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<?php get_footer();