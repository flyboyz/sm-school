<?php

function register_project_post_type()
{
    register_post_type('project', [
        'label' => null,
        'labels'          => [
            'name' => 'Разработка',
            'singular_name' => 'Разработка',
            'add_new' => 'Добавить разработку',
            'add_new_item' => 'Добавление разработки',
            'edit_item' => 'Редактирование разработки',
            'new_item' => 'Новая разработка',
            'view_item' => 'Смотреть разработку',
            'search_items' => 'Искать разработку',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Разработки',
            'archives' => 'Разработки',
            'back_link' => 'разрботок',
        ],
        'description'     => '',
        'public'          => true,
        'show_in_menu'    => null,
        'show_in_rest'    => null,
        'rest_base'       => null,
        'menu_position'   => 4,
        'menu_icon'       => 'dashicons-welcome-learn-more',
        'hierarchical'    => false,
        'supports'        => ['title', 'thumbnail', 'editor', 'author'],
        'taxonomies'      => ['category'],
        'has_archive'     => true,
        'rewrite'         => true,
        'query_var'       => true,
        'capability_type' => 'project',
        'map_meta_cap'    => true,
    ]);
}

add_action('init', 'register_project_post_type');