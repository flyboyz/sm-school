<?php

global $wp;
global $wp_query;

$roles = array('author');
$post_type = get_post_type();

$filtered     = array();
$filters_name = array( 'author', 'category' );

if ( ! is_home() ) {
	array_push( $roles, "{$post_type}_author", 'coauthor' );
}

$authors = get_users( array(
	'role__in' => $roles,
) );

//SELECT terms.name
//FROM wp_terms as terms
//         LEFT JOIN wp_term_relationships as relationships ON terms.term_id = relationships.term_taxonomy_id
//         LEFT JOIN wp_posts as posts ON relationships.object_id = posts.ID
//         LEFT JOIN wp_postmeta as postmeta ON posts.ID = postmeta.post_id
//WHERE terms.slug = 'finansy'
//      AND posts.post_status = 'publish'
//          AND postmeta.meta_key = 'visibility'
//              AND postmeta.meta_value = 1;

$categories = get_categories( array(
	'type' => 'course',
	'hide_empty' > true,
) );

foreach ( $filters_name as $name ) {
	$filtered[ $name ] = $_GET[ $name ];
}
?>
<form action="" method="get" id="filterForm">
    <div>
        <select name="author" id="authorSelect">
            <option value="">Все авторы</option>
            <?php
            foreach ($authors as $author):
                if (!is_home() || count_user_posts($author->ID, get_post_type(), true)): ?>
                    <option value="<?php
                    echo $author->user_nicename; ?>"
                        <?php
                        echo $author->user_nicename === $filtered['author'] ? 'selected' : ''; ?>><?php
                        echo $author->data->display_name; ?></option>
                <?php
                endif;
            endforeach; ?>
        </select>
        <select name="category" id="categorySelect">
            <option value="">Все категории</option>
            <?php
            foreach ($categories as $category):
                if ($post_type !== 'post' || count_user_posts($category->ID, get_post_type(), true)): ?>
                    <option value="<?php
                    echo $category->slug; ?>"
                        <?php
                        echo $category->slug === $filtered['category'] ? 'selected' : ''; ?>><?php
                        echo $category->name; ?></option>
                <?php
                endif;
            endforeach; ?>
        </select>
    </div>
    <div>
        <a class="button" href="<?php
        echo home_url($wp->request); ?>">Сбросить</a>
    </div>
</form>