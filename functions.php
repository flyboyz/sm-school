<?php
/**
 * Theme functions and definitions
 */

if (file_exists(get_parent_theme_file_path('vendor/autoload.php'))) {
    include_once get_parent_theme_file_path('vendor/autoload.php');
} else {
    wp_die('Please install <b>composer</b> dependency.');
}


/**
 * Initialize styles/scripts
 */
function add_theme_scripts()
{
    global $wp_query;
    $templateUri = get_template_directory_uri();
    $version = wp_get_theme()->get('Version');

    wp_enqueue_style('main', "$templateUri/css/main.min.css", array(), $version);
    wp_enqueue_script('main', "$templateUri/js/app.min.js", array('jquery'), $version, true);

    if (is_front_page() && wp_is_mobile()) {
        wp_enqueue_script('animation', "$templateUri/js/animation.min.js", array(), $version);
    }

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

    add_image_size('square', 540, 540, true);
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
        get_template_part("template-parts/content/$post_type", '', ['post_num' => $i]);

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
//    global $wp_query;
//    $filters_name = ['category_name', 'teacher'];
//
//    foreach ($wp_query->query as $name => $value) {
//        if (in_array($name, $filters_name)) {
//            $classes[] = 'page-filters-active';
//
//            return $classes;
//        }
//    }

    if (is_front_page() && wp_is_mobile()) {
        return array_merge($classes, array('animation-page'));
    }

    return $classes;
}

add_filter('body_class', 'my_class_names');


function get_section($args)
{
    ob_start();
    get_template_part('template-parts/section/' . $args['name'], '');

    return ob_get_clean();
}

add_shortcode('section', 'get_section');


function get_cost($value)
{
    return number_format($value ?? 0, 0, ',', ' ') . ' &#8381;';
}


function wrap_surname($name)
{
    return substr_replace($name, ' <span>', strpos($name, ' '), 1) . '</span>';
}

add_filter('wrap_surname', 'wrap_surname', 10, 1);


function utm_inputs()
{
    $utm_tags = [
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
    ];

    $html = '';
    foreach ($utm_tags as $utm_tag) {
        if (isset($_GET[$utm_tag])) {
            $html .= "<input type='hidden' name='$utm_tag' value='$_GET[$utm_tag]'>\n";
        }
    }

    return $html;
}

add_shortcode('utm_inputs', 'utm_inputs');

require get_parent_theme_file_path('/inc/helpers.php');


function remove_some_courses($query): WP_Query
{
    /* @var $query WP_Query */
    if (!is_admin() && $query->is_main_query() && !is_single() && isset($query->query_vars['post_type']) && $query->query_vars['post_type'] === 'course') {
        $query->set('meta_key', 'access_type');
        $query->set('meta_value', 1);
    }

    return $query;
}

add_action('pre_get_posts', 'remove_some_courses');


function set_archive_title($title)
{
    global $wp_query;

    if (isset($wp_query->query_vars['post_type'])) {
        $title = get_post_type_labels(get_post_type_object($wp_query->query_vars['post_type']))->archives;
    }

    return $title;
}

add_action('get_the_archive_title', 'set_archive_title');


function wpseo_postdata_update($post_id)
{
    global $post;

    if ($post->post_type === 'course') {
        add_action('wpseo_saved_postdata', function () use ($post_id) {
            $value = get_field('visibility', $post_id) === false ? '1' : '0';
            update_post_meta($post_id, '_yoast_wpseo_meta-robots-noindex', $value);
        });
    }
}

add_filter('save_post', 'wpseo_postdata_update');


/**
 * System reconfiguration
 */
require get_parent_theme_file_path('/inc/system-bans.php');

require get_parent_theme_file_path('/inc/blocks.php');

require get_parent_theme_file_path('/inc/type-course.php');
require get_parent_theme_file_path('/inc/type-webinar.php');
require get_parent_theme_file_path('/inc/type-project.php');
require get_parent_theme_file_path('/inc/type-vacancy.php');
require get_parent_theme_file_path('/inc/type-product.php');
require get_parent_theme_file_path('/inc/sendpulse.php');


function add_reply_email($emails)
{
    $emails->__set('reply_to', 'flyslam@yandex.ru');

    return $emails;
}

add_filter('wpforms_entry_email_before_send', 'add_reply_email');
