<?php get_header(); ?>

<div class="row">
	<?php get_sidebar(); ?>

	<div class="nine columns">
		<div class="row">
			<div class="twelve columns">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php $is_more = strpos( $post->post_content, '<!--more-->'); ?>

				<?php if ( $is_more ) : ?>

				<?php

				global $more; 
				$more = false; 

				?>

				<div class="introduction">

					<h2><?php the_title(); ?></h2>
					<?php the_content( '' ); ?>

					<div class="clear"></div>
				</div>

				<?php endif; ?>

				<div id="content">
					<div class="visual-hook"></div>

					<?php 

					$connected = new WP_Query( array(
						'connected_type' => 'connected_banners',
						'connected_items' => get_queried_object(),
						'nopaging' => true,
					) );

					if ( $connected->have_posts() ): 

					?>

					<div class="front-page-banner-area">

						<ul class="block-grid two-up mobile">
							<?php 

							while ( $connected->have_posts() ) : $connected->the_post();

							$featured_product = get_post_meta( $post->ID, '_atlantis_lakeballs_featured_product', true );
							$banner_destination = get_post_meta( $post->ID, '_atlantis_lakeballs_banner_destination', true );
							$banner_base_price = get_post_meta( $post->ID, '_atlantis_lakeballs_base_price', true );
							$banner_sale_price = get_post_meta( $post->ID, '_atlantis_lakeballs_sale_price', true );
							$banner_discount_percentage = get_post_meta( $post->ID, '_atlantis_lakeballs_discount_percentage', true );

							?>

							<li>
								<div class="single-banner <?php if ( !empty( $featured_product ) ) { echo 'featured-product'; } ?>">

									<?php if ( !empty( $banner_destination ) ) : ?>

									<a href="<?php echo $banner_destination; ?>" title="<?php the_title(); ?>">

									<?php endif; ?>

										<h3><?php the_title(); ?></h3>
										<?php the_content(); ?>

										<?php if ( !empty( $banner_sale_price ) ) : ?>

											<div class="banner-price">
												<?php if ( !empty( $banner_base_price ) ) : ?>

												<del>
													<span class="base-price-sticker"><?php echo '&euro;' . $banner_base_price; ?></span>
												</del>

												<?php endif; ?>
												
												<?php if ( !empty( $banner_sale_price ) ) : ?>

												<span class="sale-price-sticker"><?php echo '&euro;' . $banner_sale_price; ?></span>

												<?php endif; ?>
											</div>

										<?php else: ?>
											<div class="banner-price">
												<?php if ( !empty( $banner_base_price ) ) : ?>
													<span class="base-price-sticker"><?php echo '&euro;' . $banner_base_price; ?></span>
												<?php endif; ?>

												<?php if ( !empty( $banner_discount_percentage ) ) : ?>
													<span class="discount-percentage-sticker"><?php echo $banner_discount_percentage; ?></span>
												<?php endif; ?>
											</div>

										<?php endif; ?>

										<?php if ( !empty( $banner_discount_percentage ) ) : ?>
											<span class="discount-percentage-sticker"><?php echo $banner_discount_percentage; ?></span>
										<?php endif; ?>

										<?php if ( !empty( $banner_destination ) ) : ?>

									</a>

									<?php endif; ?>

									<div class="clear"></div>
								</div>
							</li>
							<?php endwhile; ?>
						</ul>
					</div>

					<?php wp_reset_postdata(); ?>
					<?php endif; ?>

					<?php $more = true; ?>
					<?php the_content( '', true ); ?>

					<div class="clear"></div>
				</div>

				<?php endwhile; ?>

			</div>
		</div>
	</div>
</div>

<?php get_footer();