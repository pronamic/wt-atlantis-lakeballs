<?php get_header(); ?>

<div class="row">
	<?php get_sidebar(); ?>

	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<div id="content">
					<article id="post-0" class="post error404 not-found">
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'atlantis-lakeballs' ); ?></h1>
						</header>

						<div class="entry-content">
							<p><?php _e ('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'atlantis-lakeballs' ); ?></p>

							<?php get_search_form(); ?>

						</div>
					</article>

					<div class="clear"></div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php get_footer();