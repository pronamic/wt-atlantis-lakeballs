<div class="three columns">
	<aside id="aside">
		<?php if ( is_home() || is_singular( 'post' ) && is_active_sidebar( 'blog-sidebar' ) ) : ?>

		<ul class="widget-area">
			<?php dynamic_sidebar( 'blog-sidebar' ); ?>
		</ul>

		<?php elseif ( is_active_sidebar( 'primary' ) ) : ?>

		<ul class="widget-area">
			<?php dynamic_sidebar( 'primary' ); ?>
		</ul>

		<?php endif; ?>
	</aside>
</div>