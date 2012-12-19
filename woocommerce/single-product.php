<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

get_header('shop'); ?>

	<?php do_action('woocommerce_sidebar'); ?>

	<?php do_action('woocommerce_before_main_content'); ?>

	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; ?>

	<?php do_action('woocommerce_after_main_content'); ?>

<?php get_footer('shop'); ?>