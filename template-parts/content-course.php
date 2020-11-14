<?php

$category = get_the_category();
$link = get_field('other_fields')['link'];
$cost = number_format(get_field('other_fields')['cost'] ?? 0, 0, ',', ' ') . ' &#8381;';
?>
<div class="card">
    <div class="card__panel card__panel_course">
        <div class="card__category"><?= $category[0]->cat_name ?? 'Без категории' ?></div>
        <div class="card__title"><?= the_title() ?></div>
        <div class="card__author">
            <?= get_avatar(get_the_author_meta('ID'), 80) ?>
            <span><?= get_the_author(); ?></span>
        </div>
    </div>
    <span class="card__cost"><?= $cost ?></span>
    <a href="<?= $link ?>" class="card__link" target="_blank">Смотреть курс <img
                src="<?= get_template_directory_uri() ?>/images/icons/arrow.png" alt="arrow"></a>
</div>
