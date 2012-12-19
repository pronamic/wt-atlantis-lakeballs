<?php get_header(); ?>

<div class="row">
	<?php get_sidebar(); ?>

	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<?php if ( is_singular() ) : ?>

				<header class="page-header">

					<h1 class="entry-title">
						<?php the_title(); ?>
					</h1>

					<?php if ( 'post' == get_post_type() ) : ?>

					<div class="entry-meta">
						<?php atlantis_lakeballs_posted_on(); ?>
					</div>

					<?php endif; ?>

					<?php 

					$is_more = strpos( $post->post_content, '<!--more-->'); 

					if ( $is_more ) {
						global $more; 
						$more = false; 

						if ( has_post_thumbnail() ) { the_post_thumbnail( 'thumbnail', array( 'class' => 'category-featured alignright' ) ); }

						the_content( '' );
					}

					?>

					<div class="clear"></div>
				</header>

				<?php endif; ?>

				<div id="content">

					<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'single' ); ?>

					<?php endwhile; ?>

					<div class="clear"></div>
				</div>

				<div id="nav-single">
					<span class="nav-previous">
						<?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> %title', 'atlantis-lakeballs' ) ); ?>
					</span>
					<span class="nav-next">
						<?php next_post_link( '%link', __( '%title <span class="meta-nav">&rarr;</span>', 'atlantis-lakeballs' ) ); ?>
					</span>

					<div class="clear"></div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>