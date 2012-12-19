<?php get_header(); ?>

<div class="row">
	<?php get_sidebar(); ?>

	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php printf( __( 'Search Results for: %s', 'atlantis-lakeballs' ), '<span>' . get_search_query() . '</span>' ); ?>
					</h1>
				</header>

				<div id="content">

					<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

					<?php endwhile; ?>

					<?php else : ?>

					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title">
								<?php _e( 'Nothing Found', 'atlantis-lakeballs' ); ?>
							</h1>
						</header>

						<div class="entry-content">
							<p>
								<?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'atlantis-lakeballs' ); ?>
							</p>

							<?php get_search_form(); ?>
						</div>
					</article>

					<?php endif; ?>

					<div class="clear"></div>
				</div>

				<?php atlantis_lakeballs_content_nav( 'nav-below' ); ?>

				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<?php get_footer();