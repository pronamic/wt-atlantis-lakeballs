				<div class="row">
					<div class="twelve columns">

						<?php 

						$query = new WP_Query();
						$query->query(array(
							'post_type'      => 'brand',
							'posts_per_page' => 6,
							'orderby'        => 'rand'
						));

						if ( ! empty( $query ) ) :

						?>

						<div class="brands-container">

							<ul class="block-grid six-up mobile-two-up">

								<?php while($query->have_posts()) : $query->the_post(); ?>
								
									<?php if ( has_post_thumbnail() ) : ?>

									<li>
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'thumbnail' ); ?>
										</a>
									</li>

									<?php endif; ?>

								<?php endwhile; ?>

							</ul>

						</div>

						<?php endif; ?>

					</div>
				</div>
				
				
				<div class="wrapper"></div>
			</div>

			<div class="wrapper"></div>
		</div>

		<div id="footer-wrapper">
			<div class="row">
				<div class="twelve columns">
					<?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>

					<ul class="block-grid four-up mobile-two-up">
						<?php dynamic_sidebar( 'footer-widget-area' ); ?>
					</ul>

					<?php endif; ?>

					<?php

					$query = new WP_Query();
					$query->query(array(
						'post_type' => 'pronamic_block' , 
						'name' => 'footer-disclaimer' 
					));

					while($query->have_posts()) : $query->the_post();

					?>

					<div class="foot-disclaimer">

						<div class="row">
							<div class="twelve columns">
								<?php the_content(); ?>
							</div>
						</div>

						<div class="clear"></div>
					</div>

					<?php endwhile; ?>

				</div>
			</div>

			<div class="wrapper"></div>
		</div>

		<?php wp_footer(); ?>

	</body>
</html>