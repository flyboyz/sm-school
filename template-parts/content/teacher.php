<?php

$teacher = $args['teacher'];
$teacher->fields = get_fields('user_' . $teacher->ID);

$have_courses = count(get_posts([
    'post_type'      => 'course',
    'author'         => $teacher->ID,
    'posts_per_page' => 1,
]));
?>
<a data-fancybox data-options='{"touch" : false}' data-src="#teacher-<?= $teacher->ID ?>" href="javascript:;"
   class="card card_teacher card_no-padding">
    <div class="card__panel card__panel_teacher ratio ratio_4x3">
        <div class="ratio__content">
            <?= wp_get_attachment_image($teacher->fields['photo'], 'square') ?>
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
                <div class="card__actions">
                    <?php
                    if ($have_courses): ?>
                        <a href="/courses?author=<?= $teacher->user_nicename ?>" target="_blank"
                           class="card__link icon icon-arrow">Курсы</a>
                    <?php
                    endif; ?>
                    <a href="/publications?author=<?= $teacher->user_nicename ?>" target="_blank"
                       class="card__link icon icon-arrow">Публикации</a>
                </div>
            </div>
        </div>
        <div class="details-content">
            <?= \nl2br($teacher->description) ?>
        </div>
    </div>
</div>