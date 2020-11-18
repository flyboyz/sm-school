<?php

$link = get_field('other_fields')['link'];
$cost = number_format(get_field('other_fields')['cost'] ?? 0, 0, ',', ' ') . ' &#8381;';

$categories = get_field('teacher_fields')['categories'];
$category = !empty($categories) ? $categories[0]->name : '';
?>
<a href="<?= $link ?>" class="card" target="_blank">
    <div class="card__panel ratio ratio_16x9">
        <div class="ratio__content">
            <?php
            the_post_thumbnail('large') ?>
            <div class="card__category"><?= $category ?></div>
            <img src="/wp-content/themes/sm-school/images/icons/play.png" class="video-btn" alt="play">
        </div>
    </div>
    <div class="card__link"><?= the_title() ?></div>
    <span><?= get_field('teacher_fields')['position'] ?></span>
</a>
