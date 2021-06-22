<?php
/**
 * Theme functions and definitions
 */

if ( file_exists( get_parent_theme_file_path( 'vendor/autoload.php' ) ) ) {
	include_once get_parent_theme_file_path( 'vendor/autoload.php' );
} else {
	wp_die( 'Please install <b>composer</b> dependency.' );
}


/**
 * Initialize styles/scripts
 */
function add_theme_scripts() {
	global $wp_query;
	$templateUri = get_template_directory_uri();

	wp_enqueue_style( 'main', "$templateUri/css/main.min.css", [],
		filemtime( get_stylesheet_directory() . '/css/main.min.css' ) );
	wp_enqueue_script( 'main', "$templateUri/js/app.min.js", [ 'jquery' ],
		filemtime( get_stylesheet_directory() . '/js/app.min.js' ), true );

	if ( is_front_page() ) {
		wp_enqueue_script( 'animation', "$templateUri/js/animation.min.js" );

		wp_localize_script( 'animation', 'animation_data', [
			'is_mobile' => wp_is_mobile(),
		] );
	}

	wp_localize_script( 'main', 'backend_data', [
		'ajax_url'     => admin_url( 'admin-ajax.php' ),
		'posts'        => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
		'max_page'     => $wp_query->max_num_pages,
		'info'         => $wp_query,
		'static_page'  => isset( $_GET['static_page'] )
	] );
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );


/**
 * Add features and image sizes
 */
add_action( 'after_setup_theme', function () {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );   // Gutenberg responsive embeds

	add_image_size( 'square', 540, 540, true );
} );


/**
 * Menus init
 */
function register_menus() {
	register_nav_menus( [
		'header'        => 'Header Menu',
		'sidebar'       => 'Sidebar Menu',
		'footer_second' => 'Second footer Menu',
		'footer_third'  => 'Third footer Menu',
	] );
}

add_action( 'init', 'register_menus' );


/**
 * Add theme body classes
 *
 * @param $classes
 *
 * @return array
 */
function theme_classes( $classes ): array {
	global $wp_query;
	$filters_name = [ 'author', 'category' ];

	foreach ( $wp_query->query as $name => $value ) {
		if ( in_array( $name, $filters_name ) ) {
			$classes[] = 'page-filters-active';
		}
	}

	if ( is_front_page() ) {
		$device = wp_is_mobile() ? 'mobile' : 'desktop';

		return array_merge( $classes, [ 'animation-page', $device ] );
	}

	if ( isset( $_GET['static_page'] ) ) {
		$classes[] = 'static-page';
	}

	return $classes;
}

add_filter( 'body_class', 'theme_classes' );


/**
 * Loader for posts
 */
function posts_loader() {
	$post_type = $_POST['post_type'];

	$args                = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged']       = $_POST['page'] + 1;
	$args['post_type']   = $post_type;
	$args['post_status'] = 'publish';

	$posts               = new WP_Query( $args );
	$GLOBALS['wp_query'] = $posts;

	$i = 0;
	while ( $posts->have_posts() ) {
		if ( $i === 0 || $i % 6 === 0 ) {
			echo '<div class="content-columns">';
		}

		$i ++;
		$posts->the_post();
		get_template_part( "template-parts/content/$post_type", '',
			[ 'post_num' => $i ] );

		if ( $i === 6 || $i % 6 === 0 ) {
			echo '</div>';
		}
	}

	die();
}

add_action( 'wp_ajax_load_more', 'posts_loader' );
add_action( 'wp_ajax_nopriv_load_more', 'posts_loader' );


/**
 * Include other logics
 */
$files = [
	'helpers',
	'system-bans',
	'blocks',
	'type-course',
	'type-webinar',
	'type-project',
	'type-vacancy',
	'type-product',
	'sendpulse',
	'filter',
];

foreach ( $files as $file ) {
	include get_template_directory() . "/inc/$file.php";
}