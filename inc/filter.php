<?php

function filter( $post_type ): string {
	ob_start();
	get_template_part( 'template-parts/section/filter', '',
		[ 'post_type' => $post_type ] );

	return ob_get_clean();
}

add_shortcode( 'filter', 'filter' );


function get_categories_by_author( $author_id ) {
	global $wpdb;

	$query = "SELECT DISTINCT(terms.slug), terms.name
FROM {$wpdb->base_prefix}posts as posts
         LEFT JOIN {$wpdb->base_prefix}term_relationships as relationships ON posts.ID = relationships.object_ID
         LEFT JOIN {$wpdb->base_prefix}term_taxonomy as tax ON relationships.term_taxonomy_id = tax.term_taxonomy_id
         LEFT JOIN {$wpdb->base_prefix}terms as terms ON tax.term_id = terms.term_id
         LEFT JOIN {$wpdb->base_prefix}postmeta as postsmeta ON posts.ID = postsmeta.post_id
         LEFT JOIN {$wpdb->base_prefix}postmeta as postsmeta2 ON posts.ID = postsmeta2.post_id
         LEFT JOIN {$wpdb->base_prefix}users as users ON posts.post_author = users.ID
WHERE posts.post_status = 'publish'
  AND postsmeta2.meta_key = 'visibility'
  AND postsmeta2.meta_value = 1
  AND tax.taxonomy = 'category'
#         AND terms.term_id = 9
  AND (
        users.ID = {$author_id}
        OR (
                postsmeta.meta_key = 'co-authors' AND
                postsmeta.meta_value LIKE CONCAT('%\"{$author_id}\"%')
           )
    )";

	return $wpdb->get_results( $wpdb->prepare( $query ) );
}

function get_categories_with_posts( $post_type ) {
	global $wpdb;

	$query = "SELECT DISTINCT(terms.slug), terms.name
FROM {$wpdb->base_prefix}posts as posts
         LEFT JOIN {$wpdb->base_prefix}term_relationships as relationships ON posts.ID = relationships.object_ID
         LEFT JOIN {$wpdb->base_prefix}term_taxonomy as tax ON relationships.term_taxonomy_id = tax.term_taxonomy_id
         LEFT JOIN {$wpdb->base_prefix}terms as terms ON tax.term_id = terms.term_id
         LEFT JOIN {$wpdb->base_prefix}postmeta as postsmeta ON posts.ID = postsmeta.post_id
WHERE posts.post_status = 'publish'
  AND posts.post_type = '{$post_type}'
  AND tax.taxonomy = 'category'
  AND IF(postsmeta.meta_key = 'visibility', postsmeta.meta_value = 1, 1)";

	return $wpdb->get_results( $wpdb->prepare( $query ) );
}


function get_authors_by_category( $category_id ) {
	global $wpdb;

	$query = "SELECT DISTINCT(posts.post_author) as id, postmeta2.meta_value as coauthors
FROM {$wpdb->base_prefix}terms as terms
         LEFT JOIN {$wpdb->base_prefix}term_relationships as relationships ON terms.term_id = relationships.term_taxonomy_id
         LEFT JOIN {$wpdb->base_prefix}posts as posts ON relationships.object_id = posts.ID
         LEFT JOIN {$wpdb->base_prefix}postmeta as postmeta ON posts.ID = postmeta.post_id
         LEFT JOIN {$wpdb->base_prefix}postmeta as postmeta2 ON posts.ID = postmeta2.post_id
WHERE terms.term_id = {$category_id}
  AND posts.post_status = 'publish'
  AND postmeta.meta_key = 'visibility'
  AND postmeta.meta_value != 0
  AND postmeta2.meta_key = 'co-authors'
  AND postmeta.meta_value != ''";

	return $wpdb->get_results( $wpdb->prepare( $query ) );
}