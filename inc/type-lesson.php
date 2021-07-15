<?php

function register_lesson_post_type() {
	register_post_type( 'lesson', [
		'label'              => null,
		'labels'             => [
			'name'               => 'Урок',
			'singular_name'      => 'Урок',
			'add_new'            => 'Добавить урок',
			'add_new_item'       => 'Добавление урока',
			'edit_item'          => 'Редактирование урока',
			'new_item'           => 'Новый урок',
			'view_item'          => 'Смотреть урок',
			'search_items'       => 'Искать урок',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Уроки',
			'archives'           => 'Уроки'
		],
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'show_in_rest'       => false,
		'menu_position'      => 4,
		'menu_icon'          => 'dashicons-format-video',
		'hierarchical'       => false,
		'supports'           => [ 'title', 'editor' ],
		'has_archive'        => false,
		'rewrite'            => true,
		'query_var'          => true,
		'capability_type'    => 'lesson',
		'map_meta_cap'       => true,
	] );
}

add_action( 'init', 'register_lesson_post_type' );
