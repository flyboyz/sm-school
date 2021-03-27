<?php

$teacher = $args['teacher'];

$fields = get_field('fields', 'teacher_' . $teacher->term_id);
$category = !empty($fields['categories']) ? $fields['categories'][0]->name : '';
?>
<a data-fancybox data-options='{"touch" : false}' data-src="#teacher-<?= $teacher->term_id ?>" href="javascript:;"
   class="card card_no-padding">
    <div class="card__panel card__panel_teacher ratio ratio_4x3">
        <div class="ratio__content">
            <img src="<?= $fields['big_photo']['sizes']['square'] ?>" alt="photo">
            <div class="card__category"><?= $category ?></div>
        </div>
    </div>
    <div class="card__title icon icon-arrow"><?= $teacher->name ?></div>
    <div class="card__subtitle"><?= $fields['position'] ?></div>
</a>

<div class="container container_fixed container_no-paddnig content-box" id="teacher-<?= $teacher->term_id ?>"
     style="display: none;">
    <div class="details-card details-card_teacher">
        <div class="card">
            <img class="card__image card__image_bordered" src="<?= $fields['big_photo']['sizes']['square'] ?>"
                 alt="photo">
            <div class="card__title"><?= $teacher->name ?></div>
            <div class="card__mobile-row">
                <div class="card__subtitle"><?= $fields['position'] ?></div>
                <div class="card__actions">
                    <a href="/<?= $teacher->taxonomy . '/' . $teacher->slug ?>/?post_type=course"
                       class="card__link icon icon-arrow">Курсы</a>
                    <a href="/<?= $teacher->taxonomy . '/' . $teacher->slug ?>/?post_type=post"
                       class="card__link icon icon-arrow">Публикации</a>
                </div>
            </div>
        </div>
        <div class="details-content">
            <?= \nl2br($teacher->description) ?>
        </div>
    </div>
</div>