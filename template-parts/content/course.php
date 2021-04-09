<?php

$author_meta = get_user_meta(get_post()->post_author);

?>
<div class="card">
    <div class="card__panel card__panel_course">
        <div class="card__category"><?= get_the_first_category('Без категории') ?></div>
        <div class="card__inner-title"><?= the_title() ?></div>
        <div class="card__author">
            <?= wp_get_attachment_image($author_meta['avatar'][0], 'thumbnail', false,
                ['class' => 'card__author-avatar']) ?>
            <span><?= $author_meta['first_name'][0] . ' ' . $author_meta['last_name'][0] ?></span>
        </div>
    </div>
    <!--
    <span class="card__cost">
        <?= get_course_cost() ?>
    </span>
    -->
    <a href="<?= get_the_permalink() ?>" class="card__title icon icon-arrow">Смотреть курс</a>
</div>