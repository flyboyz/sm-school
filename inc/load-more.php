<?php
/**
 * Initialize scripts for AJAX load posts
 */
function init_load_more_script()
{
    if (!is_front_page() && is_home() || is_search() || is_category() || is_tag() || is_author() || is_archive()) {
        global $wp_query;
        $templateUri = get_template_directory_uri();

        wp_register_script('load-more', "$templateUri/assets/js/load-more.js", array('jquery'), '1.0', true);
        wp_enqueue_script('load-more');

        wp_localize_script('load-more', 'load_more_params', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'posts' => json_encode($wp_query->query_vars),
            'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
            'max_page' => $wp_query->max_num_pages,
            'info' => $wp_query
        ));
    }
}

add_action('wp_enqueue_scripts', 'init_load_more_script');

/**
 * AJAX loader function - return next posts list
 */
function true_load_posts()
{
    $args = json_decode(stripslashes($_POST['query']), true);
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    $posts = new WP_Query($args);
    $GLOBALS['wp_query'] = $posts;

    while ($posts->have_posts()) {
        $posts->the_post();
        get_template_part('template-parts/news-content');
    }

    die();
}

add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');