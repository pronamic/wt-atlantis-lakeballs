<?php if ( has_post_thumbnail() ) { $additional_class = 'has-featured'; } ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_class ); ?>>
	<?php if ( is_search() || is_post_type_archive( 'pronamic_faq' ) || is_tax() || 'post' == get_post_type() && ! is_singular( 'post' ) ) : ?>

	<?php if ( has_post_thumbnail() && !is_search() ) : ?>

	<div class="featured-image">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'thumbnail' ); ?>
		</a>
	</div>

	<?php endif; ?>

	<header class="entry-header">
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'atlantis-lakeballs' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>
	</header>

	<?php endif; ?>

	<?php if ( is_home() || is_search() || is_archive() || is_category() ) : ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<?php else : ?>

	<div class="entry-content">
		<?php 

		global $more; 
		$more = true;
		the_content( '', true); 

		?>
	</div>

	<?php endif; ?>

	<footer class="entry-meta">
		<?php $show_sep = false; ?>

		<?php 

		if ( 'post' == get_post_type() ) : 

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'atlantis-lakeballs' ) );
			if ( $categories_list ) :

			?>

			<span class="cat-links">
				<?php 

				printf( __( '<span class="%1$s">Posted in</span> %2$s', 'atlantis-lakeballs' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list ); 
				$show_sep = true; 

				?>
			</span>

			<?php endif; ?>

			<?php

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'atlantis-lakeballs' ) );

			if ( $tags_list ) :

				if ( $show_sep ) : ?><span class="sep"> | </span><?php endif; ?>
				<span class="tag-links">
					<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'atlantis-lakeballs' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
					$show_sep = true; ?>
				</span>

			<?php endif; ?>

		<?php endif; ?>

		<?php if ( 'pronamic_faq' == get_post_type() ) : ?>

		<span class="term-links">
			<?php echo get_the_term_list( $post->ID, 'pronamic_faq_category', __( 'Subject: ', 'atlantis-lakeballs' )); ?>
		</span>

		<?php endif; ?>

	</footer>
</article>