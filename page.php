<?php get_header(); ?>

<div class="row">
	<?php get_sidebar(); ?>

	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<?php while ( have_posts() ) : the_post(); ?>

				<header class="page-header">
					<h1 class="entry-title">
						<?php the_title(); ?>
					</h1>

					<?php 

					$is_more = strpos( $post->post_content, '<!--more-->'); 

					if ( $is_more ) {
						global $more; 
						$more = false; 
						
						the_content( '' );
					}

					?>

				</header>

				<div id="content">

					<?php get_template_part( 'content', 'page' ); ?>

					<div class="clear"></div>
				</div>

				<?php endwhile; ?>

			</div>
		</div>
	</div>
</div>

<?php get_footer();