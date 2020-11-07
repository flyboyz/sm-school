<?php

$category = get_the_category();
$link = get_field('link');
?>
<div class="card">
    <?= $category[0]->cat_name ?? '' ?>
    <?= the_title() ?>
    <?= get_avatar(get_the_author_meta('ID'), 80) ?>
    <?= get_the_author(); ?>
    <a href="<?= $link ?>" target="_blank">Смотреть курс <img
                src="<?= get_template_directory_uri() ?>/images/icons/arrow.png" alt="arrow"></a>
</div>
