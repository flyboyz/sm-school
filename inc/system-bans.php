<?php

define('ALLOWED_FRONTPAGE_SCRIPTS', array('main'));
define('ALLOWED_FRONTPAGE_STYLES', array('main', 'wp-block-library'));

define('CHANGED_PLUGINS', array('custom-twitter-feeds'));

/**
 * Disable update changed plugins
 */
function disable_plugins_update($update)
{
    if (!is_array(CHANGED_PLUGINS) || count(CHANGED_PLUGINS) == 0) {
        return $update;
    }

    if ($update) {
        foreach ($update->response as $name => $val) {
            foreach (CHANGED_PLUGINS as $plugin) {
                if (stripos($name, $plugin) !== false) {
                    unset($update->response[$name]);
                }
            }
        }
    }

    return $update;
}

add_filter('site_transient_update_plugins', 'disable_plugins_update');

/**
 * Disable styles/scripts on Front page
 */
function assets_inspect()
{
    global $wp_styles;
    global $wp_scripts;

    foreach ($wp_styles->queue as $handle) {
        if (is_front_page() && !is_user_logged_in() && !in_array($handle, ALLOWED_FRONTPAGE_STYLES)) {
            wp_deregister_style($handle);
        }
    }

    foreach ($wp_scripts->queue as $handle) {
        if (is_front_page() && !is_user_logged_in() && !in_array($handle, ALLOWED_FRONTPAGE_SCRIPTS)) {
            wp_deregister_script($handle);
        }
    }
}

add_action('wp_enqueue_scripts', 'assets_inspect', 999);


/**
 * Replace standard WP logo
 */
function change_login_logo()
{
    ?>
    <style type="text/css">
        body.login div#login h1 a {
            padding: 20px 0;
            width: 320px;
            background: linear-gradient(0deg, rgba(0, 0, 0, 1) 0%, rgb(66, 66, 66) 100%),
            url('<?= get_template_directory_uri() ?>/images/logo.png') no-repeat center;
            background-size: contain;
            background-blend-mode: screen;
            border-radius: 7px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .35);
        }

        #loginform .button-primary {
            background: #353535;
            border-color: black;
            box-shadow: 0 1px 0 grey;
            text-shadow: 0 -1px 1px black,
            1px 0 1px black,
            0 1px 1px black,
            -1px 0 1px black;
        }
    </style>
    <?php
}

add_action('login_enqueue_scripts', 'change_login_logo');

function wide_editor()
{
    echo '<style>
    .block-editor .wp-block {
      max-width: 1040px;
    }
  </style>';
}

add_action('admin_head', 'wide_editor');


// Переименовывваем Записи в Публикации
function cp_change_post_object()
{
    $labels = get_post_type_object('post')->labels;
    $labels->name = 'Публикации';
    $labels->singular_name = 'Публикация';
    $labels->add_new = 'Добавить публикацию';
    $labels->add_new_item = 'Добавить публикацию';
    $labels->edit_item = 'Редактировать публикацию';
    $labels->new_item = 'Публикация';
    $labels->view_item = 'Посмотреть публикацию';
    $labels->search_items = 'Поиск публикаций';
    $labels->not_found = 'Публикаций не найдено';
    $labels->not_found_in_trash = 'Нет публикаций в корзине';
    $labels->all_items = 'Все публикации';
    $labels->menu_name = 'Публикации';
    $labels->name_admin_bar = 'Публикацию';
    $labels->archives = 'Публикации';
}

add_action('init', 'cp_change_post_object');


function cp_change_category_object()
{
    global $wp_taxonomies;

    $labels = &$wp_taxonomies['category']->labels;
    $labels->name = 'Категории';
    $labels->singular_name = 'Категория';
    $labels->add_new = 'Добавить категорию';
    $labels->add_new_item = 'Добавить категорию';
    $labels->edit_item = 'Изменить категорию';
    $labels->new_item = 'Категория';
    $labels->view_item = 'Посмотреть категорию';
    $labels->search_items = 'Поиск категорий';
    $labels->not_found = 'Категорий не найдено';
    $labels->not_found_in_trash = 'Нет категорий в корзине';
    $labels->all_items = 'Все категории';
    $labels->menu_name = 'Категории';
    $labels->name_admin_bar = 'Категорию';
}

add_action('init', 'cp_change_category_object');


// Удаляем функционал меток
function unregister_taxonomy_post_tag()
{
    register_taxonomy('post_tag', array());
}

add_action('init', 'unregister_taxonomy_post_tag');


function youtube_disable_rel($content)
{
    $re = '/(src=".*?youtube\.com.*?\?feature=oembed)"/m';
    $subst = '$1&rel=0"';

    return preg_replace($re, $subst, $content);
}

add_filter('the_content', 'youtube_disable_rel');