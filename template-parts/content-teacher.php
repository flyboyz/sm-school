<?php

$teacher = $args['teacher'];

$fields = get_field('fields', 'teacher_' . $teacher->term_id);
$category = !empty($fields['categories']) ? $fields['categories'][0]->name : '';
?>
<a data-fancybox data-src="#hidden-content" href="javascript:;" class="card card_no-padding">
    <div class="card__panel card__panel_teacher ratio ratio_4x3">
        <div class="ratio__content">
            <img src="<?= $fields['avatar']['sizes']['large'] ?>" alt="photo">
            <div class="card__category"><?= $category ?></div>
        </div>
    </div>
    <div class="card__title"><?= $teacher->name ?>
        <img src="<?= get_template_directory_uri() ?>/images/icons/arrow.png" alt="arrow">
    </div>
    <div class="card__subtitle"><?= $fields['position'] ?></div>
</a>

<div class="container container_fixed container_no-paddnig content-box" id="hidden-content" style="display: none;">
    <div class="details-card">
        <div class="card">
            <img src="<?= $fields['avatar']['sizes']['large'] ?>" alt="photo">
            <div class="card__title"><?= $teacher->name ?></div>
            <div class="card__subtitle"><?= $fields['position'] ?></div>
            <div class="card__actions">
                <a href="/courses/" class="card__link icon icon-arrow">Курсы</a>
                <a href="/publications/" class="card__link icon icon-arrow">Публикации</a>
            </div>
        </div>
        <div class="details-content">
            <?= \nl2br($teacher->description) ?>
        </div>
    </div>
</div>