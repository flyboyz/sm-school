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
	$version     = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'main', "$templateUri/css/main.min.css", [], $version );
	wp_enqueue_script( 'main', "$templateUri/js/app.min.js", [ 'jquery' ],
		$version, TRUE );

	if ( is_front_page() ) {
		wp_enqueue_script( 'animation', "$templateUri/js/animation.min.js", [],
			$version );

		wp_localize_script( 'animation', 'animation_data', [
			'is_mobile' => wp_is_mobile(),
		] );
	}

	wp_localize_script( 'main', 'backend_data', [
		'ajaxurl'      => admin_url( 'admin-ajax.php' ),
		'posts'        => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
		'max_page'     => $wp_query->max_num_pages,
		'info'         => $wp_query,
	] );
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );


/**
 * Add features and image sizes
 */
add_action( 'after_setup_theme', function () {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );   // Gutenberg responsive embeds

	add_image_size( 'square', 540, 540, TRUE );
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


function true_load_posts() {
	$post_type = $_POST['post_type'];

	$args                = json_decode( stripslashes( $_POST['query'] ), TRUE );
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

add_action( 'wp_ajax_loadmore', 'true_load_posts' );
add_action( 'wp_ajax_nopriv_loadmore', 'true_load_posts' );


function get_the_first_category( $emptyLabel = '' ) {
	return ! empty( get_the_category() ) ? get_the_category()[0]->cat_name : $emptyLabel;
}


function get_social_link( $social_name ) {
	$post_link  = urlencode( get_the_permalink() );
	$post_title = get_the_title();

	$share_links = [
		'vk'       => "https://vk.com/share.php?url=$post_link",
		'facebook' => "https://www.facebook.com/sharer/sharer.php?u=$post_link",
		'twitter'  => "https://twitter.com/intent/tweet?url=$post_link&text=$post_title",
		'ok'       => "https://connect.ok.ru/offer?url=$post_link&title=$post_title&imageUrl=" . get_the_post_thumbnail_url( 'large' ),
		'linkedin' => "https://www.linkedin.com/shareArticle?mini=true&url=$post_link&title=$post_title&source=LinkedIn",
	];

	return $share_links[ $social_name ];
}


function my_class_names( $classes ) {
	$filters_name = [ 'author', 'category' ];

	foreach ( $_GET as $name => $value ) {
		if ( in_array( $name, $filters_name ) ) {
			$classes[] = 'page-filters-active';

			return $classes;
		}
	}

	if ( is_front_page() ) {
		$device = wp_is_mobile() ? 'mobile' : 'desktop';

		return array_merge( $classes, [ 'animation-page', $device ] );
	}

	return $classes;
}

add_filter( 'body_class', 'my_class_names' );


function get_section( $args ) {
	ob_start();
	get_template_part( 'template-parts/section/' . $args['name'], '' );

	return ob_get_clean();
}

add_shortcode( 'section', 'get_section' );


function get_cost( $value ) {
	return number_format( $value ?? 0, 0, ',', ' ' ) . ' &#8381;';
}


function wrap_surname( $name ) {
	return substr_replace( $name, ' <span>', strpos( $name, ' ' ),
			1 ) . '</span>';
}

add_filter( 'wrap_surname', 'wrap_surname', 10, 1 );


function utm_inputs() {
	$utm_tags = [
		'utm_source',
		'utm_medium',
		'utm_campaign',
		'utm_content',
		'utm_term',
	];

	$html = '';
	foreach ( $utm_tags as $utm_tag ) {
		if ( isset( $_GET[ $utm_tag ] ) ) {
			$html .= "<input type='hidden' name='$utm_tag' value='$_GET[$utm_tag]'>\n";
		}
	}

	return $html;
}

add_shortcode( 'utm_inputs', 'utm_inputs' );

require get_parent_theme_file_path( '/inc/helpers.php' );


/**
 * Filter main WP Query
 *
 * @param $query
 *
 * @return WP_Query
 */
function wp_query_update( $query ): WP_Query {
	/* @var $query WP_Query */

	// Remove hidden courses
	if ( ! is_admin() && $query->is_main_query() && ! is_single() && isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] === 'course' ) {
		$query->set( 'meta_key', 'visibility' );
		$query->set( 'meta_value', 1 );
	}

	// Apply filters
	if ( ! is_admin() && $query->is_main_query() && ! empty( $_GET ) ) {
		if ( isset( $_GET['author'] ) && $_GET['author'] !== '' ) {
			$author = get_user_by( 'slug', $_GET['author'] );

			if ( ! $author ) {
				global $wp_query;

				$wp_query->set_404();
				status_header( 404 );
			}

			$posts_by_author = get_posts( [
				'posts_per_page' => - 1,
				'post_type'      => $query->get( 'post_type' ),
				'author'         => $author->ID,
				'fields'         => 'ids',
			] );

			$posts_by_coauthor = get_posts( [
				'posts_per_page' => - 1,
				'post_type'      => $query->get( 'post_type' ),
				'meta_query'     => [
					[
						'key'     => 'co-authors',
						'value'   => $author->ID,
						'compare' => 'LIKE',
					],
				],
				'fields'         => 'ids',
			] );

			$query->set( 'post__in',
				array_merge( $posts_by_author, $posts_by_coauthor ) );
		}

		if ( isset( $_GET['category'] ) && $_GET['category'] !== '' ) {
			$query->set( 'category_name', $_GET['category'] );
		}
	}

	return $query;
}

add_action( 'pre_get_posts', 'wp_query_update' );


function set_archive_title( $title ) {
	global $wp_query;

	if ( isset( $wp_query->query_vars['post_type'] ) ) {
		$title = get_post_type_labels( get_post_type_object( $wp_query->query_vars['post_type'] ) )->archives;
	}

	return $title;
}

add_action( 'get_the_archive_title', 'set_archive_title' );


function wpseo_postdata_update( $post_id ) {
	global $post;

	if ( $post->post_type === 'course' ) {
		add_action( 'wpseo_saved_postdata', function () use ( $post_id ) {
			$value = get_field( 'visibility', $post_id ) === FALSE ? '1' : '0';
			update_post_meta( $post_id, '_yoast_wpseo_meta-robots-noindex',
				$value );
		} );
	}
}

add_filter( 'save_post', 'wpseo_postdata_update' );


/**
 * System reconfiguration
 */
require get_parent_theme_file_path( '/inc/system-bans.php' );

require get_parent_theme_file_path( '/inc/blocks.php' );

require get_parent_theme_file_path( '/inc/type-course.php' );
require get_parent_theme_file_path( '/inc/type-webinar.php' );
require get_parent_theme_file_path( '/inc/type-project.php' );
require get_parent_theme_file_path( '/inc/type-vacancy.php' );
require get_parent_theme_file_path( '/inc/type-product.php' );
require get_parent_theme_file_path( '/inc/sendpulse.php' );


function add_reply_email( $emails ) {
	$emails->__set( 'reply_to', 'flyslam@yandex.ru' );

	return $emails;
}

add_filter( 'wpforms_entry_email_before_send', 'add_reply_email' );


function filter( $post_type ): string {
	ob_start();
	get_template_part( 'template-parts/section/filter', '',
		[ 'post_type' => $post_type ] );

	return ob_get_clean();
}

add_shortcode( 'filter', 'filter' );


function get_categories_by_author( $author_id ) {
	global $wpdb;

	$query = "SELECT DISTINCT(terms.slug), terms.name
FROM {$wpdb->base_prefix}posts as posts
         LEFT JOIN {$wpdb->base_prefix}term_relationships as relationships ON posts.ID = relationships.object_ID
         LEFT JOIN {$wpdb->base_prefix}term_taxonomy as tax ON relationships.term_taxonomy_id = tax.term_taxonomy_id
         LEFT JOIN {$wpdb->base_prefix}terms as terms ON tax.term_id = terms.term_id
         LEFT JOIN {$wpdb->base_prefix}postmeta as postsmeta ON posts.ID = postsmeta.post_id
         LEFT JOIN {$wpdb->base_prefix}postmeta as postsmeta2 ON posts.ID = postsmeta2.post_id
         LEFT JOIN {$wpdb->base_prefix}users as users ON posts.post_author = users.ID
WHERE posts.post_status = 'publish'
  AND postsmeta2.meta_key = 'visibility'
  AND postsmeta2.meta_value = 1
  AND tax.taxonomy = 'category'
#         AND terms.term_id = 9
  AND (
        users.ID = '$author_id'
        OR (
                postsmeta.meta_key = 'co-authors' AND
                postsmeta.meta_value LIKE CONCAT('%\"', $author_id ,'\"%')
           )
    )";

	return $wpdb->get_results( $wpdb->prepare( $query ) );
}