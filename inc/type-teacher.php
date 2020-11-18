<?php

function register_teacher_post_type()
{
    register_post_type('teacher', [
        'label' => null,
        'labels' => [
            'name' => 'Преподаватель',
            'singular_name' => 'Преподаватель',
            'add_new' => 'Добавить преподавателя',
            'add_new_item' => 'Добавление преподавателя',
            'edit_item' => 'Редактирование преподавателя',
            'new_item' => 'Новый преподаватель',
            'view_item' => 'Смотреть преподавателя',
            'search_items' => 'Искать преподавателя',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Преподаватели',
            'archives' => 'Преподаватели'
        ],
        'description' => '',
        'public' => true,
        'show_in_menu' => null,
        'show_in_rest' => null,
        'rest_base' => null,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-businessman',
        'hierarchical' => false,
        'supports' => ['title', 'thumbnail', 'editor'],
        'taxonomies' => ['category'],
        'has_archive' => 'teachers',
        'rewrite' => true,
        'query_var' => true,
    ]);
}

add_action('init', 'register_teacher_post_type');