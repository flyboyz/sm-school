<?php

function register_teacher_taxonomy()
{
    register_taxonomy('teacher', ['post', 'course', 'webinar', 'product'], [
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
        'show_in_rest' => true,
        'rest_base' => null,
        'has_archive' => 'teachers',
    ]);
}

add_action('init', 'register_teacher_taxonomy');


function get_the_teacher($ID = null)
{
    $teachers = get_the_terms($ID ?? get_the_ID(), 'teacher');

    if (!$teachers || is_wp_error($teachers)) {
        return false;
    }

    $teacher = $teachers[0];

    $teacher->avatar = get_field('fields',
        'teacher_' . $teacher->term_id)['avatar']['sizes'];

    return $teacher;
}
