<?php get_header(); ?>

<div class="row">
	<?php get_sidebar(); ?>

	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<?php if( have_posts() ): ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php 

						if ( is_day() ) {
							printf( __( 'Daily Archives: %s', 'atlantis-lakeballs' ), '<span>' . get_the_date() . '</span>' );
						} elseif ( is_month() ) {
							printf( __( 'Monthly Archives: %s', 'atlantis-lakeballs' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'atlantis-lakeballs' ) ) . '</span>' );
						} elseif( is_year() ) {
							printf( __('Yearly Archives: %s', 'atlantis-lakeballs' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'atlantis-lakeballs' ) ) . '</span>' );
						} elseif( is_tax() ) {
							printf( single_term_title() );
						} elseif( is_post_type_archive( 'pronamic_faq' ) ) {
							printf( __( 'Frequently Asked Questions', 'atlantis-lakeballs' ) );
						} else {
							_e( 'Blog Archives', 'atlantis-lakeballs' );
						}

						?>
					</h1>

					<?php

					// Place archive description into this action.
					if ( is_post_type_archive() ) {
						$post_type = get_query_var( 'post_type' );

						$name = 'pronamic_framework_post_type_description_' . $post_type;

						$description = get_option( $name );
					}

					if ( ! empty( $description ) ) {
						echo wpautop( $description );
					}

					?>

				</header>

				<div id="content">

					<?php if( have_posts() ): ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', get_post_format() ); ?>

					<?php endwhile; ?>

					<?php else : ?>

					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Nothing Found', 'atlantis-lakeballs' ); ?></h1>
						</header>

						<div class="entry-content">
							<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'atlantis-lakeballs' ); ?></p>
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