<?php

function register_course_post_type()
{
    register_post_type('course', [
        'label' => null,
        'labels' => [
            'name' => 'Курс', // основное название для типа записи
            'singular_name' => 'Курс', // название для одной записи этого типа
            'add_new' => 'Добавить курс', // для добавления новой записи
            'add_new_item' => 'Добавление курса', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item' => 'Редактирование курса', // для редактирования типа записи
            'new_item' => 'Новый курс', // текст новой записи
            'view_item' => 'Смотреть курс', // для просмотра записи этого типа.
            'search_items' => 'Искать курс', // для поиска по этим типам записи
            'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon' => '', // для родителей (у древовидных типов)
            'menu_name' => 'Курсы', // название меню
            'archives' => 'Курсы'
        ],
        'description' => '',
        'public' => true,
        'show_in_menu' => null,
        'show_in_rest' => null,
        'rest_base' => null,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-media-video',
        'hierarchical' => false,
        'supports' => ['title', 'author'],
        'taxonomies' => ['category'],
        'has_archive' => 'courses',
        'rewrite' => true,
        'query_var' => true,
    ]);
}

add_action('init', 'register_course_post_type');