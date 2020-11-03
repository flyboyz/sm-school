<?php
/**
 * Theme functions and definitions
 */

/**
 * Initialize styles/scripts
 */
function add_theme_scripts()
{
    $templateUri = get_template_directory_uri();

    wp_enqueue_style('theme-style', "$templateUri/style.css", array(), null);
    wp_enqueue_script('theme-script', "$templateUri/js/app.min.js", array(), null, true);
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


/**
 * System reconfiguration
 */
require get_parent_theme_file_path('/inc/system-bans.php');


//require_once get_parent_theme_file_path('/inc/MSGame.php');


/**
 * Implement AJAX load functionality
 */
require get_parent_theme_file_path('/inc/load-more.php');
