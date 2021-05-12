<?php

global $wp;
global $wp_query;

$teachers = get_users([
    'role' => 'author',
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
        foreach ($teachers as $teacher):
            if (count_user_posts($teacher->ID, get_post_type())): ?>
                <option value="<?php
                echo $teacher->user_nicename; ?>"
                    <?php
                    echo $teacher->user_nicename === $filtered_author ? 'selected' : ''; ?>><?php
                    echo $teacher->data->display_name; ?></option>
            <?php
            endif;
        endforeach; ?>
    </select>
    <a class="button" href="<?php
    echo home_url($wp->request); ?>">Сбросить</a>
</form>