<?php
/**
 * Theme functions and definitions
 */

/**
 * Initialize styles/scripts
 */
function add_theme_scripts()
{
    global $wp_query;
    $templateUri = get_template_directory_uri();

    wp_enqueue_style('main', "$templateUri/style.css", array(), null);
    wp_enqueue_script('main', "$templateUri/js/app.min.js", array(), null, true);

    wp_localize_script('main', 'backend_data', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'posts' => json_encode($wp_query->query_vars),
        'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages,
        'info' => $wp_query
    ));
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');


/**
 * Add features and image sizes
 */
add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');   // Gutenberg responsive embeds

    add_image_size('related-game', 560, 220, true);
});


/**
 * Menus init
 */
function register_menus()
{
    register_nav_menus([
        'header' => 'Header Menu',
        'sidebar' => 'Sidebar Menu',
    ]);
}

add_action('init', 'register_menus');


function true_load_posts()
{
    $args = json_decode(stripslashes($_POST['query']), true);
    $args['paged'] = $_POST['page'] + 1;
    $args['post_type'] = $_POST['post_type'];
    $args['post_status'] = 'publish';

    $posts = new WP_Query($args);
    $GLOBALS['wp_query'] = $posts;

    while ($posts->have_posts()) {
        $posts->the_post();
        get_template_part('template-parts/content', $_POST['post_type']);
    }

    die();
}

add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');


/**
 * System reconfiguration
 */
require get_parent_theme_file_path('/inc/system-bans.php');


//require_once get_parent_theme_file_path('/inc/MSGame.php');


/**
 * Implement AJAX load functionality
 */
require get_parent_theme_file_path('/inc/type-course.php');
