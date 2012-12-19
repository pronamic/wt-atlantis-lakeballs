<?php

if ( ! function_exists( 'atlantis_lakeballs_setup' ) ) :

function atlantis_lakeballs_setup() {

	load_theme_textdomain( 'atlantis-lakeballs', get_template_directory() . '/languages' );

	// Load up our theme options page and related code.
	// require( get_template_directory() . '/inc/theme-options.php' );

	// Grab Twenty Eleven's Ephemera widget.
	// require(get_template_directory() . '/inc/widgets.php');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'atlantis-lakeballs' ) ,
		'utility' => __( 'Utility Menu', 'atlantis-lakeballs' )
	) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// Add custom image sizes
	// add_image_size('small-feature', 500, 300);
}

endif;

add_action( 'after_setup_theme', 'atlantis_lakeballs_setup' );

////////////////////////////////////////////////////////////////////////////////////////////////////

remove_filter('the_content_more_link', 'wpautop'); 

////////////////////////////////////////////////////////////////////////////////////////////////////

// Sets the post excerpt length to 40 words.
function atlantis_lakeballs_excerpt_length( $length ) {
	return 40;
}

add_filter( 'excerpt_length', 'atlantis_lakeballs_excerpt_length' );

//////////

// Returns a "Continue Reading" link for excerpts
function atlantis_lakeballs_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'atlantis-lakeballs' ) . '</a>';
}

//////////

// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and atlantis_lakeballs_continue_reading_link().
function atlantis_lakeballs_auto_excerpt_more( $more ) {
	return ' &hellip;' . atlantis_lakeballs_continue_reading_link();
}

add_filter( 'excerpt_more', 'atlantis_lakeballs_auto_excerpt_more' );

//////////

// Adds a pretty "Continue Reading" link to custom post excerpts.
function atlantis_lakeballs_custom_excerpt_more( $output ) {
	if( has_excerpt() && ! is_attachment() ) {
		$output .= atlantis_lakeballs_continue_reading_link();
	}
	return $output;
}

add_filter( 'get_the_excerpt', 'atlantis_lakeballs_custom_excerpt_more' );

////////////////////////////////////////////////////////////////////////////////////////////////////

// Register our sidebars and widgetized areas. Also register the default Epherma widget.
function atlantis_lakeballs_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Primary sidebar', 'atlantis-lakeballs' ),
		'id' => 'primary',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "<div class='clear'></div></li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Blog sidebar', 'atlantis-lakeballs' ),
		'id' => 'blog-sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer widget area', 'atlantis-lakeballs' ),
		'id' => 'footer-widget-area',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => __( '[Shop] Product filter widget area', 'atlantis-lakeballs' ),
		'id' => 'products-filter-widget-area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => __( '[Shop] After category widget area', 'atlantis-lakeballs' ),
		'id' => 'after-category-widget-area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "<div class='clear'></div></div>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}

add_action( 'widgets_init', 'atlantis_lakeballs_widgets_init' );

////////////////////////////////////////////////////////////////////////////////////////////////////

function atlantis_lakeballs_enqueue_scripts() {
	// Foundation stylesheet
	wp_enqueue_style(
		'foundation' , 
		get_bloginfo('stylesheet_directory') . '/stylesheets/foundation.css'
	);

	// Load modernizr foundation
	wp_enqueue_script(
		'modernizr-foundation' , 
		get_bloginfo('stylesheet_directory') . '/javascripts/modernizr.foundation.js'
	);

	// Load foundation min
	wp_enqueue_script(
		'foundation-min' , 
		get_bloginfo('stylesheet_directory') . '/javascripts/foundation.min.js' ,
		array( 'jquery' ) ,
		false ,
		true
	);

	// Load foundation app
	wp_enqueue_script(
		'foundation-app' , 
		get_bloginfo('stylesheet_directory') . '/javascripts/app.js' ,
		array( 'jquery' ) ,
		false ,
		true
	);

	// Delete default WordPress image width adnd height elements
	wp_enqueue_script(
		'atlantis-fix-images' , 
		get_template_directory_uri() . '/pronamic/fix-images.js' , 
		array('jquery')
	);
}

add_action( 'wp_enqueue_scripts', 'atlantis_lakeballs_enqueue_scripts' );

////////////////////////////////////////////////////////////////////////////////////////////////////

// Initialize
function atlantis_lakeballs_init() {

	// Register post type
	register_post_type('brand', array(
		'label' => __('Brands', 'atlantis-lakeballs') , 
		'labels' => array(
			'name' => _x('Brands', 'post type general name', 'atlantis-lakeballs') , 
			'singular_name' => _x('Brand', 'post type singular name', 'atlantis-lakeballs') , 
			'add_new' => _x('Add New', 'brand', 'atlantis-lakeballs') , 
			'add_new_item' => __('Add New Brand', 'atlantis-lakeballs') , 
			'edit_item' => __('Edit Brand', 'atlantis-lakeballs') , 
			'new_item' => __('New Brand', 'atlantis-lakeballs') , 
			'view_item' => __('View Brand', 'atlantis-lakeballs') , 
			'search_items' => __('Search Brands', 'atlantis-lakeballs') , 
			'not_found' =>  __('No Brands found', 'atlantis-lakeballs') , 
			'not_found_in_trash' => __('No Brands found in Trash', 'atlantis-lakeballs') ,  
			'parent_item_colon' => __('Parent Brand:', 'atlantis-lakeballs') , 
			'menu_name' => __('Brands',  'atlantis-lakeballs')
		) , 
		'public' => true , 
		'publicly_queryable' => true , 
		'show_ui' => true ,  
		'show_in_menu' => true ,  
		'query_var' => true , 
		'rewrite' => array('slug' => 'merk') , 
		'capability_type' => 'post' , 
		'has_archive' => true ,  
		'hierarchical' => true ,
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'entry-views') 
	));

	// Register post type
	register_post_type('banner', array(
		'label' => __('Banners', 'atlantis-lakeballs') , 
		'labels' => array(
			'name' => _x('Banners', 'post type general name', 'atlantis-lakeballs') , 
			'singular_name' => _x('Banner', 'post type singular name', 'atlantis-lakeballs') , 
			'add_new' => _x('Add New', 'banner', 'atlantis-lakeballs') , 
			'add_new_item' => __('Add New Banner', 'atlantis-lakeballs') , 
			'edit_item' => __('Edit Banner', 'atlantis-lakeballs') , 
			'new_item' => __('New Banner', 'atlantis-lakeballs') , 
			'view_item' => __('View Banner', 'atlantis-lakeballs') , 
			'search_items' => __('Search Banners', 'atlantis-lakeballs') , 
			'not_found' =>  __('No Banners found', 'atlantis-lakeballs') , 
			'not_found_in_trash' => __('No Banners found in Trash', 'atlantis-lakeballs') ,  
			'parent_item_colon' => __('Parent Banner:', 'atlantis-lakeballs') , 
			'menu_name' => __('Banners',  'atlantis-lakeballs')
		) , 
		'public' => false , 
		'publicly_queryable' => true , 
		'show_ui' => true ,  
		'show_in_nav_menus' => false ,
		'show_in_menu' => true ,  
		'query_var' => true , 
		'rewrite' => array('slug' => 'banner') , 
		'capability_type' => 'post' , 
		'has_archive' => false ,  
		'hierarchical' => true ,
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'entry-views') 
	));
}

add_action( 'init', 'atlantis_lakeballs_init' );


////////////////////////////////////////////////////////////////////////////////////////////////////

if ( ! function_exists( 'atlantis_lakeballs_content_nav' ) ) :

// Display navigation to next/previous pages when applicable
function atlantis_lakeballs_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<div class="nav-previous">
				<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'atlantis-lakeballs' ) ); ?>
			</div>
			<div class="nav-next">
				<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'atlantis-lakeballs' ) ); ?>
			</div>
		</nav>
	<?php endif;
}

endif;

////////////////////////////////////////////////////////////////////////////////////////////////////

if ( ! function_exists( 'atlantis_lakeballs_comment' ) ) :

// Template for comments and pingbacks.
function atlantis_lakeballs_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>

	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'atlantis-lakeballs' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'atlantis-lakeballs' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
		break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'atlantis-lakeballs' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'atlantis-lakeballs' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'atlantis-lakeballs' ), '<span class="edit-link">', '</span>' ); ?>

					<div class="clear"></div>
				</div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'atlantis-lakeballs' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'atlantis-lakeballs' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</article>

	<?php
	break;
	endswitch;
}

endif;

////////////////////////////////////////////////////////////////////////////////////////////////////

if ( ! function_exists( 'atlantis_lakeballs_posted_on' ) ) :

// Prints HTML with meta information for the current post-date/time and author.
function atlantis_lakeballs_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'atlantis-lakeballs' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}

endif;

////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * meta init
 */
function atlantis_lakeballs_meta_init(){
	//wp_enqueue_style('custom_meta_css', get_stylesheet_directory_uri() . '/meta.css');
	add_meta_box( 'atlantis_lakeballs_banner_meta', 'Banner details', 'atlantis_lakeballs_meta_setup', 'banner', 'normal', 'high' );

	add_action('save_post','atlantis_lakeballs_save_meta');
}

add_action('admin_init','atlantis_lakeballs_meta_init');

//////////

function atlantis_lakeballs_meta_setup() { 

	global $post;

	?>

	<h2><?php _e('Banner funcionality details', 'atlantis-lakeballs'); ?></h2>

	<table class="form-table">
		<tr>
			<th scope="row">
				<label for="featured_product_field"><?php _e( 'Featured product', 'atlantis-lakeballs' ); ?>:</label>
			</th>
			<td>
				<input id="featured_product_field" type="checkbox" name="_atlantis_lakeballs_featured_product" <?php if( get_post_meta($post->ID, '_atlantis_lakeballs_featured_product', true) ) { ?>checked="checked"<?php } ?> />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="destination_field"><?php _e('Banner destination (URL)', 'atlantis-lakeballs'); ?>:</label>
			</th>
			<td>
				<input id="destination_field" type="text" name="_atlantis_lakeballs_banner_destination" value="<?php echo esc_attr(get_post_meta($post->ID, '_atlantis_lakeballs_banner_destination', true)); ?>" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="base_price_field"><?php _e('Base price', 'atlantis-lakeballs'); ?>: &euro;</label>
			</th>
			<td>
				<input id="base_price_field" type="text" name="_atlantis_lakeballs_base_price" value="<?php echo esc_attr(get_post_meta($post->ID, '_atlantis_lakeballs_base_price', true)); ?>" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="sale_price_field"><?php _e('Sale price', 'atlantis-lakeballs'); ?>: &euro;</label>
			</th>
			<td>
				<input id="sale_price_field" type="text" name="_atlantis_lakeballs_sale_price" value="<?php echo esc_attr(get_post_meta($post->ID, '_atlantis_lakeballs_sale_price', true)); ?>" />
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="discount_field"><?php _e('Discount percentage', 'atlantis-lakeballs'); ?>:</label>
			</th>
			<td>
				<input id="discount_field" type="text" name="_atlantis_lakeballs_discount_percentage" value="<?php echo esc_attr(get_post_meta($post->ID, '_atlantis_lakeballs_discount_percentage', true)); ?>" />
			</td>
		</tr>
	</table>

	<?php 
 
	// Create a custom nonce for submit verification later
	echo '<input type="hidden" name="atlantis_lakeballs_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}

//////////

function atlantis_lakeballs_save_meta($post_id){
	// Authentication checks
	// Make sure data came from our meta box
	$nonce = filter_input(INPUT_POST, 'atlantis_lakeballs_meta_noncename', FILTER_SANITIZE_STRING);
	if(!wp_verify_nonce($nonce,__FILE__)) {
		return $post_id;
	}

	// Check user permissions
	if ($_POST['post_type'] == 'page') {
		if(!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
	}

	// Authentication passed, save data
	$args = array(
		// Validate specific string
		'_atlantis_lakeballs_featured_product' => FILTER_VALIDATE_BOOLEAN ,
		'_atlantis_lakeballs_banner_destination' => FILTER_SANITIZE_URL ,
		'_atlantis_lakeballs_base_price' => FILTER_SANITIZE_STRING ,
		'_atlantis_lakeballs_sale_price' => FILTER_SANITIZE_STRING ,
		'_atlantis_lakeballs_discount_percentage' => FILTER_SANITIZE_STRING
	);

	$data = filter_input_array(INPUT_POST, $args);

	foreach($data as $name => $value) {
		if(empty($value)) {
			delete_post_meta($post_id, $name);
		} else {
			update_post_meta($post_id, $name, $value);
		}
	}

	return $post_id;
}

////////////////////////////////////////////////////////////////////////////////////////////////////

// Define Posts 2 posts connection type
if ( function_exists( 'p2p_register_connection_type' ) ) {
	function atlantis_lakeballs_connection_types() {
		p2p_register_connection_type( array( 
			'name' => 'connected_banners' ,
			'from' => 'banner',
			'to' => 'page' ,
			'sortable' => 'any'
		));
	}

	add_action( 'p2p_init', 'atlantis_lakeballs_connection_types' );
}

////////////////////////////////////////////////////////////////////////////////////////////////////

function atlantis_lakeballs_add_styleselect($buttons) {
	array_unshift($buttons, 'styleselect');

	return $buttons;
}

add_filter('mce_buttons_2', 'atlantis_lakeballs_add_styleselect');

//////////

function atlantis_lakeballs_set_formats($settings) {
	// $settings['theme_advanced_blockformats'] = 'p, h1, h2, h3, h4';
	$settings['theme_advanced_styles'] = 'Lead=lead';

	$style_formats = array(
		array( 
			'title' => __('Lead paragraph', 'atlantis-lakeballs' ) , 
			'block' => 'p', 
			'classes' => 'lead'
		), array(
			'title' => __('Emphasized unordered list', 'atlantis-lakeballs' ) , 
			'selector' => 'ul', 
			'classes' => 'emp'
		)
	);

	$settings['style_formats'] = json_encode($style_formats);

	return $settings;
}

add_filter('tiny_mce_before_init', 'atlantis_lakeballs_set_formats');



////////////////////////////////////////////////////////////////////////////////////////////////////
////////// WOOCOMMERCE HANDLERS
//////////////////////////////////////////////////

// Remove build-in breadcrumbs
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Remove product ordering form bottom of page
remove_action('woocommerce_pagination', 'woocommerce_catalog_ordering', 20);

// Remove review options
remove_action( 'woocommerce_product_tabs', 'woocommerce_product_reviews_tab', 30);
remove_action( 'woocommerce_product_tab_panels', 'woocommerce_product_reviews_panel', 30);

// Remove first price field on single product page
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

// Change product columns from four to three
function atlantis_lakeballs_story_shop_columns( $columns ) {
    return 3;
}

add_filter( 'loop_shop_columns', 'atlantis_lakeballs_story_shop_columns' );

//////////////////////////////////////////////////

// Replace placeholder image
function atlantis_lakeballs_woocommerce_placeholder_img_src($src){
	$src = get_stylesheet_directory_uri() . '/woocommerce/placeholder.png';
	return $src;
}

add_filter('woocommerce_placeholder_img_src', 'atlantis_lakeballs_woocommerce_placeholder_img_src');

//////////////////////////////////////////////////

/* Add widgetarea for product filter */
function atlantis_lakeballs_products_intro() {
	?>

	<?php if ( ! is_singular() ) : ?>

	<div id="products-filter-container">
		
		<?php if ( is_active_sidebar( 'products-filter-widget-area' ) ) : ?>
			<div class="products-filter">
				<?php dynamic_sidebar( 'products-filter-widget-area' ); ?>
			<div class="clear"></div>
		</div>
		<?php endif; ?>

		<div class="products-order">
			<?php woocommerce_catalog_ordering(); ?>

			<?php if ( function_exists( 'wp_pagenavi' ) ) { wp_pagenavi(); } ?>

			<div class="clear"></div>
		</div>

		<div class="clear"></div>
	</div>

	<?php endif;
}

add_action( 'woocommerce_before_shop_loop', 'atlantis_lakeballs_products_intro', 10 );

//////////////////////////////////////////////////

/* Enhanced display of term description */
function woocommerce_taxonomy_archive_description() {
	if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) : ?>
		<div class="term-description">
			<?php 

			global $wp_query;

			$cat = $wp_query->get_queried_object();
			$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 

			if ( ! empty( $thumbnail_id ) ) {
				echo wp_get_attachment_image( $thumbnail_id, 'thumbnail', false, array( 'class' => 'category-featured alignright' )); 
			}
			
			?>

			<?php echo wpautop( wptexturize( term_description() ) ); ?>
		</div>
	<?php endif;
}

//////////////////////////////////////////////////

/* Add additional divider class surrounder */
function woocommerce_template_loop_product_thumbnail() {
	?>

	<div class="loop-product-image">
		<?php echo woocommerce_get_product_thumbnail(); ?>
	</div>

	<?php
}

//////////////////////////////////////////////////

function woocommerce_output_related_products() {
	woocommerce_related_products( 3, 3  );
}

//////////////////////////////////////////////////

/* Add social share to product */ 
function atlantis_lakeballs_social_integration() {
	?>

	<div class="addthis_toolbox addthis_default_style ">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count" fb:like:width="115"></a>
		<a class="addthis_button_tweet" tw:width="60"></a>
		<a class="addthis_button_google_plusone" g:plusone:annotation="none"></a> <!-- bubble -->
	</div>

	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50d190cb40632625"></script>

	<?php
}

add_action( 'woocommerce_product_thumbnails', 'atlantis_lakeballs_social_integration', 30 );

