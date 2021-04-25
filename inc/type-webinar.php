<?php

function register_webinar_post_type()
{
    register_post_type('webinar', [
        'label' => null,
        'labels' => [
            'name' => 'Тренинг',
            'singular_name' => 'Тренинг',
            'add_new' => 'Добавить тренинг',
            'add_new_item' => 'Добавление тренинга',
            'edit_item' => 'Редактирование тренинга',
            'new_item' => 'Новый тренинг',
            'view_item' => 'Смотреть тренинг',
            'search_items' => 'Искать тренинг',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Тренинги',
            'archives' => 'Тренинги'
        ],
        'description' => '',
        'public' => true,
        'show_in_menu' => null,
        'show_in_rest' => true,
        'rest_base' => null,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-media-video',
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail', 'author'],
        'taxonomies' => ['category'],
        'has_archive' => 'webinars',
        'rewrite' => true,
        'query_var' => true,
        'capability_type' => 'webinar',
        'map_meta_cap' => true,
    ]);
}

add_action('init', 'register_webinar_post_type');