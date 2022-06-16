<?php

$teacher = $args['teacher'];
$teacher->fields = get_fields('user_' . $teacher->ID);

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
                    if (count_user_posts($teacher->ID, 'course')): ?>
                        <a href="/course?author=<?= $teacher->user_nicename ?>" target="_blank"
                           class="card__link">Курсы</a>
                    <?php
                    endif;
                    if (count_user_posts($teacher->ID)): ?>
                        <a href="/publications?author=<?= $teacher->user_nicename ?>" target="_blank"
                           class="card__link">Публикации</a>
                    <?php
                    endif; ?>
                </div>
            </div>
        </div>
        <div class="details-content">
            <div>
                <?= \nl2br($teacher->description) ?>
            </div>
        </div>
    </div>
</div>