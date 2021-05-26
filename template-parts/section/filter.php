<?php

global $wp;
global $wp_query;

$roles = array('author');
$post_type = get_post_type();

if ($post_type !== 'post') {
    array_push($roles, "{$post_type}_author", 'coauthor');
}

$authors = get_users([
    'role__in' => $roles,
]);

$filtered_author = '';
$filters_name = ['author'];

foreach ($wp_query->query as $name => $value) {
    if (in_array($name, $filters_name)) {
        $filtered_author = $value;
    }
}
?>
<form action="" method="get" id="filterForm">
    <select name="author" id="authorSelect">
        <option value="">Все авторы</option>
        <?php
        foreach ($authors as $author):
            if ($post_type !== 'post' || count_user_posts($author->ID, get_post_type(), true)): ?>
                <option value="<?php
                echo $author->user_nicename; ?>"
                    <?php
                    echo $author->user_nicename === $filtered_author ? 'selected' : ''; ?>><?php
                    echo $author->data->display_name; ?></option>
            <?php
            endif;
        endforeach; ?>
    </select>
    <a class="button" href="<?php
    echo home_url($wp->request); ?>">Сбросить</a>
</form>