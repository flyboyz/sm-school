<?php

function register_webinar_post_type()
{
    register_post_type('webinar', [
        'label' => null,
        'labels' => [
            'name' => 'Вебинар',
            'singular_name' => 'Вебинар',
            'add_new' => 'Добавить вебинар',
            'add_new_item' => 'Добавление вебинара',
            'edit_item' => 'Редактирование вебинара',
            'new_item' => 'Новый вебинар',
            'view_item' => 'Смотреть вебинар',
            'search_items' => 'Искать вебинар',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Вебинары',
            'archives' => 'Вебинары'
        ],
        'description' => '',
        'public' => true,
        'show_in_menu' => null,
        'show_in_rest' => null,
        'rest_base' => null,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-media-video',
        'hierarchical' => false,
        'supports' => ['title', 'author', 'thumbnail'],
        'taxonomies' => ['category'],
        'has_archive' => 'webinars',
        'rewrite' => true,
        'query_var' => true,
    ]);
}

add_action('init', 'register_webinar_post_type');