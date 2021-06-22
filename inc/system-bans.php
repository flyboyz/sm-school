<?php

define('ALLOWED_FRONTPAGE_SCRIPTS', array('main', 'animation'));
define('ALLOWED_FRONTPAGE_STYLES', array('main', 'wp-block-library'));

define( 'CHANGED_PLUGINS', array( 'advanced-custom-fields-pro' ) );

/**
 * Disable update changed plugins
 */
function disable_plugins_update($update)
{
    if (!is_array(CHANGED_PLUGINS) || count(CHANGED_PLUGINS) == 0) {
        return $update;
    }

    if ($update) {
        foreach ($update->response as $name => $val) {
            foreach (CHANGED_PLUGINS as $plugin) {
                if (stripos($name, $plugin) !== false) {
                    unset($update->response[$name]);
                }
            }
        }
    }

    return $update;
}

add_filter('site_transient_update_plugins', 'disable_plugins_update');

/**
 * Disable styles/scripts on Front page
 */
function assets_inspect()
{
    global $wp_styles;
    global $wp_scripts;

    foreach ($wp_styles->queue as $handle) {
        if (is_front_page() && !is_user_logged_in() && !in_array($handle, ALLOWED_FRONTPAGE_STYLES)) {
            wp_deregister_style($handle);
        }
    }

    foreach ($wp_scripts->queue as $handle) {
        if (is_front_page() && !is_user_logged_in() && !in_array($handle, ALLOWED_FRONTPAGE_SCRIPTS)) {
            wp_deregister_script($handle);
        }
    }
}

add_action('wp_enqueue_scripts', 'assets_inspect', 999);


/**
 * Replace standard WP logo
 */
function change_login_logo()
{
    $is_prod = $_SERVER['HTTP_HOST'] === 'sm-school.pro';
    ?>
    <style type="text/css">
        body.login div#login h1 a {
            padding: 20px 40px;
            background: black url('<?= get_template_directory_uri() ?>/images/logo.png') no-repeat center;
            background-size: 100px;
        <?= $is_prod ?: 'background-blend-mode: luminosity;' ?> border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .35);
        }

        #loginform .button-primary {
            background: #353535;
            border-color: black;
            box-shadow: 0 1px 0 grey;
            text-shadow: 0 -1px 1px black,
            1px 0 1px black,
            0 1px 1px black,
            -1px 0 1px black;
        }
    </style>
    <?php
}

add_action('login_enqueue_scripts', 'change_login_logo');

function wide_editor()
{
    echo '<style>
    .block-editor .wp-block {
      max-width: 1040px;
    }
  </style>';
}

add_action('admin_head', 'wide_editor');


// Переименовывваем Записи в Публикации
function cp_change_post_object()
{
    $labels = get_post_type_object('post')->labels;
    $labels->name = 'Публикации';
    $labels->singular_name = 'Публикация';
    $labels->add_new = 'Добавить публикацию';
    $labels->add_new_item = 'Добавить публикацию';
    $labels->edit_item = 'Редактировать публикацию';
    $labels->new_item = 'Публикация';
    $labels->view_item = 'Посмотреть публикацию';
    $labels->search_items = 'Поиск публикаций';
    $labels->not_found = 'Публикаций не найдено';
    $labels->not_found_in_trash = 'Нет публикаций в корзине';
    $labels->all_items = 'Все публикации';
    $labels->menu_name = 'Публикации';
    $labels->name_admin_bar = 'Публикацию';
    $labels->archives = 'Публикации';
}

add_action('init', 'cp_change_post_object');


function cp_change_category_object()
{
    global $wp_taxonomies;

    $labels = &$wp_taxonomies['category']->labels;
    $labels->name = 'Категории';
    $labels->singular_name = 'Категория';
    $labels->add_new = 'Добавить категорию';
    $labels->add_new_item = 'Добавить категорию';
    $labels->edit_item = 'Изменить категорию';
    $labels->new_item = 'Категория';
    $labels->view_item = 'Посмотреть категорию';
    $labels->search_items = 'Поиск категорий';
    $labels->not_found = 'Категорий не найдено';
    $labels->not_found_in_trash = 'Нет категорий в корзине';
    $labels->all_items = 'Все категории';
    $labels->menu_name = 'Категории';
    $labels->name_admin_bar = 'Категорию';
}

add_action('init', 'cp_change_category_object');


// Удаляем функционал меток
function unregister_taxonomy_post_tag()
{
    register_taxonomy('post_tag', array());
}

add_action('init', 'unregister_taxonomy_post_tag');


function youtube_disable_rel( $content ) {
	$re    = '/(src=".*?youtube\.com.*?\?feature=oembed)"/m';
	$subst = '$1&rel=0"';

	return preg_replace( $re, $subst, $content );
}

add_filter( 'the_content', 'youtube_disable_rel' );


function change_archive_title( $title ) {
	global $wp_query;

	if ( isset( $wp_query->query_vars['post_type'] ) ) {
		$title = get_post_type_labels( get_post_type_object( $wp_query->query_vars['post_type'] ) )->archives;
	}

	return $title;
}

add_action( 'get_the_archive_title', 'change_archive_title' );


/**
 * Filter main WP Query
 *
 * @param $query
 *
 * @return WP_Query
 */
function wp_query_update( $query ): WP_Query {
	/* @var $query WP_Query */

	// Remove hidden courses
	if ( ! is_admin() && $query->is_main_query() && ! is_single() && isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] === 'course' ) {
		$query->set( 'meta_key', 'visibility' );
		$query->set( 'meta_value', 1 );
	}

	// Apply filters
	if ( ! is_admin() && $query->is_main_query() && ! empty( $_GET ) ) {
		if ( isset( $_GET['author'] ) && $_GET['author'] !== '' ) {
			$author = get_user_by( 'slug', $_GET['author'] );

			if ( ! $author ) {
				global $wp_query;

				$wp_query->set_404();
				status_header( 404 );
			}

			$posts_by_author = get_posts( [
				'posts_per_page' => - 1,
				'post_type'      => $query->get( 'post_type' ),
				'author'         => $author->ID,
				'fields'         => 'ids',
			] );

			$posts_by_coauthor = get_posts( [
				'posts_per_page' => - 1,
				'post_type'      => $query->get( 'post_type' ),
				'meta_query'     => [
					[
						'key'     => 'co-authors',
						'value'   => $author->ID,
						'compare' => 'LIKE',
					],
				],
				'fields'         => 'ids',
			] );

			$query->set( 'post__in',
				array_merge( $posts_by_author, $posts_by_coauthor ) );
		}

		if ( isset( $_GET['category'] ) && $_GET['category'] !== '' ) {
			$query->set( 'category_name', $_GET['category'] );
		}
	}

	return $query;
}

add_action( 'pre_get_posts', 'wp_query_update' );


function wpseo_postdata_update( $post_id ) {
	global $post;

	if ( $post->post_type === 'course' ) {
		add_action( 'wpseo_saved_postdata', function () use ( $post_id ) {
			$value = get_field( 'visibility', $post_id ) === false ? '1' : '0';
			update_post_meta( $post_id, '_yoast_wpseo_meta-robots-noindex',
				$value );
		} );
	}
}

add_filter( 'save_post', 'wpseo_postdata_update' );