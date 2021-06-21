<?php

global $wp;

$roles     = [ 'author' ];
$post_type = get_post_type();

$filtered     = [];
$filters_name = [ 'author', 'category' ];

foreach ( $filters_name as $name ) {
	$filtered[ $name ] = $_GET[ $name ];
}

if ( ! is_home() ) {
	array_push( $roles, "{$post_type}_author", 'coauthor' );
}

if ( $filtered['author'] ) {
	$author = get_user_by( 'slug', $filtered['author'] );

	$categories = get_categories_by_author( $author->ID );
} else {
	$categories = get_categories( [
		'type' => 'course',
		'hide_empty' > true,
	] );
}


if ( $filtered['category'] ) {
	$category     = get_category_by_slug( $filtered['category'] );
	$authors_rows = get_authors_by_category( $category->term_id );

	$authors_ids = [];
	foreach ( $authors_rows as $authors_row ) {
		$authors_ids[] = (int) $authors_row->id;

		if ( $coauthors = unserialize( $authors_row->coauthors ) ) {
			foreach ( $coauthors as $coauthor ) {
				if ( ! in_array( $coauthor, $authors_ids ) ) {
					$authors_ids[] = (int) $coauthor;
				}
			}
		}
	}

	$authors = get_users( [
		'include' => $authors_ids,
	] );
} else {
	$authors = get_users( [
		'role__in' => $roles,
	] );
}
?>
<form action="" method="get" id="filterForm">
	<div class="filter-line">
		<?php
		if ( $filtered['author'] ):
			$author = get_user_by( 'slug', $filtered['author'] );
			?>
			<input type="hidden" name="author" value="<?php
			echo $filtered['author'] ?>">
			<div class="filtered">Автор: <span> <?php
					echo $author->data->display_name; ?></span></div>
		<?php
		else: ?>
			<select name="author" id="authorSelect">
				<option value="">Все авторы</option>
				<?php
				foreach ( $authors as $author ):
					if ( ! is_home() || count_user_posts( $author->ID,
							get_post_type(), true ) ): ?>
						<option value="<?php
						echo $author->user_nicename; ?>"><?php
							echo $author->data->display_name; ?></option>
					<?php
					endif;
				endforeach; ?>
			</select>
		<?php
		endif;
		if ( $filtered['category'] ):
			$category = get_category_by_slug( $filtered['category'] );
			?>
			<input type="hidden" name="category" value="<?php
			echo $filtered['category'] ?>">
			<div class="filtered">Категория: <span> <?php
					echo $category->name; ?></span></div>
		<?php
		else: ?>
		<select name="category" id="categorySelect">
			<option value="">Все категории</option>
			<?php
			foreach ( $categories as $category ):
				if ( $post_type !== 'post' || count_user_posts( $category->ID,
						get_post_type(), true ) ): ?>
					<option value="<?php
					echo $category->slug; ?>"
						<?php
						echo $category->slug === $filtered['category'] ? 'selected' : ''; ?>><?php
						echo $category->name; ?></option>
				<?php
				endif;
			endforeach;
			endif; ?>
		</select>
	</div>
	<div>
		<a class="button" href="<?php
		echo home_url( $wp->request ); ?>">Сбросить</a>
	</div>
</form>