<?php

$teacher = $args['teacher'];

$teacher->fields = get_fields('user_' . $teacher->ID);
$category = !empty($teacher->fields['categories']) ? $teacher->fields['categories'][0]->name : '';
?>
<a data-fancybox data-options='{"touch" : false}' data-src="#teacher-<?= $teacher->ID ?>" href="javascript:;"
   class="card card_no-padding">
    <div class="card__panel card__panel_teacher ratio ratio_4x3">
        <div class="ratio__content">
            <?= wp_get_attachment_image($teacher->fields['photo'], 'square') ?>
            <div class="card__category"><?= $category ?></div>
        </div>
    </div>
    <div class="card__title icon icon-arrow"><?= $teacher->data->display_name ?></div>
    <div class="card__subtitle"><?= $teacher->fields['position'] ?></div>
</a>

<div class="container container_fixed container_no-paddnig content-box" id="teacher-<?= $teacher->ID ?>"
     style="display: none;">
    <div class="details-card details-card_teacher">
        <div class="card">
            <?= wp_get_attachment_image(get_field('photo', 'user_' . $teacher->ID), 'square', false,
                ['class' => 'card__image card__image_bordered']) ?>
            <div class="card__title"><?= $teacher->data->display_name ?></div>
            <div class="card__mobile-row">
                <div class="card__subtitle"><?= $teacher->fields['position'] ?></div>
                <!--
                <div class="card__actions">
                    <a href="/<?= $teacher->taxonomy . '/' . $teacher->slug ?>/?post_type=course"
                       class="card__link icon icon-arrow">Курсы</a>
                    <a href="/<?= $teacher->taxonomy . '/' . $teacher->slug ?>/?post_type=post"
                       class="card__link icon icon-arrow">Публикации</a>
                </div>
                -->
            </div>
        </div>
        <div class="details-content">
            <?= \nl2br($teacher->description) ?>
        </div>
    </div>
</div>