<?php

function register_product_post_type() {
	register_post_type( 'product', [
		'label'           => null,
		'labels'          => [
			'name'               => 'Продукт',
			'singular_name'      => 'Продукт',
			'add_new'            => 'Добавить продукт',
			'add_new_item'       => 'Добавление продукта',
			'edit_item'          => 'Редактирование продукта',
			'new_item'           => 'Новый продукт',
			'view_item'          => 'Смотреть продукт',
			'search_items'       => 'Искать продукт',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Продукты',
			'archives'           => 'Продукты'
		],
		'description'     => '',
		'public'          => true,
		'show_in_menu'    => null,
		'show_in_rest'    => null,
		'rest_base'       => null,
		'menu_position'   => 9,
		'menu_icon'       => 'dashicons-cart',
		'hierarchical'    => false,
		'supports'        => [ 'title', 'thumbnail', 'editor', 'author' ],
		'has_archive'     => false,
		'rewrite'         => true,
		'query_var'       => true,
		'capability_type' => 'product',
		'map_meta_cap'    => true,
	] );
}

add_action( 'init', 'register_product_post_type' );
