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

    wp_enqueue_style('main', "$templateUri/style.css", array(),
        date("Y-m-d_H:i", filemtime(get_template_directory() . "/style.css")));
    wp_enqueue_script('main', "$templateUri/js/app.min.js", array('jquery'),
        date("Y-m-d_H:i", filemtime(get_template_directory() . "/js/app.min.js")), true);

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
        'footer_second' => 'Second footer Menu',
        'footer_third' => 'Third footer Menu',
    ]);
}

add_action('init', 'register_menus');


function true_load_posts()
{
    $post_type = $_POST['post_type'];

    $args = json_decode(stripslashes($_POST['query']), true);
    $args['paged'] = $_POST['page'] + 1;
    $args['post_type'] = $post_type;
    $args['post_status'] = 'publish';

    $posts = new WP_Query($args);
    $GLOBALS['wp_query'] = $posts;

    $i = 0;
    while ($posts->have_posts()) {
        if ($i === 0 || $i % 6 === 0) {
            echo '<div class="content-columns">';
        }

        $i++;
        $posts->the_post();
        get_template_part('template-parts/content', $post_type, ['post_num' => $i]);

        if ($i === 6 || $i % 6 === 0) {
            echo '</div>';
        }
    }

    die();
}

add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');


function get_the_first_category($emptyLabel = '')
{
    return !empty(get_the_category()) ? get_the_category()[0]->cat_name : $emptyLabel;
}


function get_social_link($social_name)
{
    $post_link = urlencode(get_the_permalink());
    $post_title = get_the_title();

    $share_links = [
        'vk' => "https://vk.com/share.php?url=$post_link",
        'facebook' => "https://www.facebook.com/sharer/sharer.php?u=$post_link",
        'twitter' => "https://twitter.com/intent/tweet?url=$post_link&text=$post_title",
        'ok' => "https://connect.ok.ru/offer?url=$post_link&title=$post_title&imageUrl=" . get_the_post_thumbnail_url('large'),
        'linkedin' => "https://www.linkedin.com/shareArticle?mini=true&url=$post_link&title=$post_title&source=LinkedIn",
    ];

    return $share_links[$social_name];
}


function my_class_names($classes)
{
    global $wp_query;
    $filters_name = ['category_name', 'teacher'];

    foreach ($wp_query->query as $name => $value) {
        if (in_array($name, $filters_name)) {
            $classes[] = 'page-filters-active';

            return $classes;
        }
    }

    return $classes;
}

add_filter('body_class', 'my_class_names');


/**
 * System reconfiguration
 */
require get_parent_theme_file_path('/inc/system-bans.php');


require get_parent_theme_file_path('/inc/type-course.php');
require get_parent_theme_file_path('/inc/type-webinar.php');
require get_parent_theme_file_path('/inc/type-project.php');
require get_parent_theme_file_path('/inc/type-vacancy.php');
require get_parent_theme_file_path('/inc/type-teacher.php');
require get_parent_theme_file_path('/inc/type-product.php');
