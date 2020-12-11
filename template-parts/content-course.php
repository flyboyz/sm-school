<?php

$teacher = get_the_teacher();
?>
<div class="card">
    <div class="card__panel card__panel_course">
        <div class="card__category"><?= get_the_first_category('Без категории') ?></div>
        <div class="card__inner-title"><?= the_title() ?></div>
        <div class="card__author">
            <img class="card__author-avatar" src="<?= $teacher->avatar['thumbnail'] ?>" alt="">
            <span><?= $teacher->name ?></span>
        </div>
    </div>
    <span class="card__cost"><?= get_course_cost() ?></span>
    <a href="<?= get_field('fields')['link'] ?>" class="card__title icon icon-arrow" target="_blank">Смотреть
        курс</a>
</div>
