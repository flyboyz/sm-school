<?php

function register_vacancy_post_type() {
	register_post_type( 'vacancy', [
		'label'           => null,
		'labels'          => [
			'name'               => 'Вакансия',
			'singular_name'      => 'Вакансия',
			'add_new'            => 'Добавить вакансию',
			'add_new_item'       => 'Добавление вакансии',
			'edit_item'          => 'Редактирование вакансии',
			'new_item'           => 'Новая вакансия',
			'view_item'          => 'Смотреть вакансию',
			'search_items'       => 'Искать вакансию',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Вакансии',
			'archives'           => 'Вакансии',
			'back_link'          => 'вакансий',
		],
		'description'     => '',
		'public'          => true,
		'show_in_menu'    => null,
		'show_in_rest'    => true,
		'rest_base'       => null,
		'menu_position'   => 10,
		'menu_icon'       => 'dashicons-id-alt',
		'hierarchical'    => false,
		'supports'        => [ 'title', 'thumbnail', 'editor' ],
		'has_archive'     => true,
		'rewrite'         => true,
		'query_var'       => true,
		'capability_type' => array( 'vacancy', 'vacancies' ),
		'map_meta_cap'    => true,
	] );
}

add_action( 'init', 'register_vacancy_post_type' );
