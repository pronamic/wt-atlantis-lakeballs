<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>
			</div>

			<?php if ( ! is_singular() && is_active_sidebar( 'after-category-widget-area' ) ) : ?>

			<div class="row">
				<div class="twelve columns">
					<div class="content-widget-area">
						<?php dynamic_sidebar( 'after-category-widget-area' ); ?>

						<div class="clear"></div>
					</div>
				</div>
			</div>

			<?php endif; ?>

		</div>
	</div>
</div>