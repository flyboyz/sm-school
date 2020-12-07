<?php

function register_teacher_taxonomy()
{
    register_taxonomy('teacher', ['course', 'webinar', 'product'], [
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
            'archives' => 'Преподаватели',
            'name_admin_bar' => 'Преподавателя',
        ],
        'description' => '',
        'public' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'meta_box_cb' => null,
        'show_admin_column' => true,
        'show_in_rest' => null,
        'rest_base' => null,

        'show_in_menu' => true,
        'menu_position' => 4,
//        'menu_icon' => 'dashicons-businessman',
//        'supports' => ['title', 'thumbnail', 'editor'],
//        'taxonomies' => ['category'],
//        'has_archive' => 'teachers',
//        'query_var' => true,
    ]);
}

add_action('init', 'register_teacher_taxonomy');


function get_the_first_teacher_category($nonLabel = '')
{
    $categories = get_field('fields', '')['categories'];

    return !empty($categories) ? $categories[0]->name : $nonLabel;
}