<?php

function register_course_post_type()
{
    register_post_type('course', [
        'label' => null,
        'labels' => [
            'name' => 'Курс',
            'singular_name' => 'Курс',
            'add_new' => 'Добавить курс',
            'add_new_item' => 'Добавление курса',
            'edit_item' => 'Редактирование курса',
            'new_item' => 'Новый курс',
            'view_item' => 'Смотреть курс',
            'search_items' => 'Искать курс',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Курсы',
            'archives' => 'Курсы'
        ],
        'description' => '',
        'public' => true,
        'show_in_menu' => null,
        'show_in_rest' => true,
        'rest_base' => null,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-media-interactive',
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'author'],
        'taxonomies' => ['category'],
        'has_archive' => 'courses',
        'rewrite' => true,
        'query_var' => true,
        'capability_type' => 'course',
        'map_meta_cap' => true,
    ]);
}

add_action('init', 'register_course_post_type');


function get_course_cost()
{
    return number_format(get_field('fields')['cost'] ?? 0, 0, ',', ' ') . ' &#8381;';
}