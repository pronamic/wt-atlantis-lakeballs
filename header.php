<!DOCTYPE html>
	<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
	<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
	<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
	<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />

		<title><?php wp_title( '' ); ?></title>

		<!-- Links -->

		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<!-- Shortcut Icons -->

		<link href="<?php echo get_stylesheet_directory_uri(); ?>/icons/icon.png" rel="shortcut icon" type="image/x-icon" />
		<link href="<?php echo get_stylesheet_directory_uri(); ?>/icons/ipod-icon.png" rel="apple-touch-icon" />

		<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">

		<!--[if lte IE 9]>
			<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/favicon.ico" />
			<link rel="SHORTCUT ICON" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/favicon.ico" />

			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- StyleSheets -->

		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

		<!--[if lte IE 7]>
			<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_directory' ); ?>/index-lte-ie-7.css" />
		<![endif]-->

		<!--[if lte IE 6]>
			<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_directory' ); ?>/index-lte-ie-6.css" />
			<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/ie6/warning.js"></script>
			<script>window.onload=function(){e("<?php bloginfo( 'stylesheet_directory' );?>/js/ie6/")}</script>
		<![endif]-->


		<?php 

		if ( is_singular() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_head();

		?>

	</head>

	<body <?php body_class(); ?>>

		<div class="site-assistent">

			<div class="row">
				<div class="twelve columns">

					<p class="contact">
						<?php _e('Need help? <strong><span>Call us 050 - 750 37 56</span></strong>', 'atlantis-lakeballs' ); ?>
					</p>

					<nav id="utility-nav">

						<?php 

						wp_nav_menu ( array(
							'theme_location' => 'utility' ,
							'container' => false ,
							'fallback_cb' => false ,
							'link_before' => '<span class="sep">|</span>'
						));

						?>
					</nav>

					<div class="clear"></div>
				</div>
			</div>

			<div class="clear"></div>
		</div>

		<div class="row">
			<div class="twelve columns">

				<div class="row">
					<div class="four columns">
						<h1 id="site-title">
							<span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
						</h1>
					</div>

					<div class="eight columns">
						<div class="utility">
							<?php get_search_form(); ?>

							<div id="shopping-cart">
								<?php global $woocommerce; ?>

								<h4>
									<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>">
										<?php _e( 'Shopping cart', 'atlantis-lakeballs' ); ?>
									</a>
								</h4>
								
								<?php if ( $woocommerce->cart->cart_contents_count > 0 ) : ?>
								
									<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'atlantis-lakeballs' ); ?>">
										<?php echo sprintf( _n( '%d product', '%d products', $woocommerce->cart->cart_contents_count, 'atlantis-lakeballs' ), $woocommerce->cart->cart_contents_count ); ?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
									</a>
								
								<?php else : ?>

								<p>
									<?php _e( 'No products', 'atlantis-lakeballs' ); ?>
								</p>
								
								<?php endif; ?>

								<div class="shop-hook"></div>
							</div>

							<div class="clear"></div>
						</div>

					</div>
				</div>

			</div>
		</div>

		<!-- Full width navigation [ex 990px] -->
		<div class="row">
			<div class="twelve columns">
				<nav id="primary-nav">

					<?php 

					wp_nav_menu( array( 
						'theme_location' => 'primary' ,
						'container' => false
					) ); 
					
					?>

					<div class="clear"></div>
				</nav>
			</div>
		</div>

		<div id="main">

			<?php if ( function_exists('yoast_breadcrumb') ) : ?>

			<div class="row">
				<div class="twelve columns">
					<div id="breadcrumbs">
						<?php yoast_breadcrumb('<p>','</p>'); ?>
					</div>
				</div>
			</div>

			<?php endif; ?>

			<div class="container">