<?php

$category = get_the_category();
$link = get_field('other_fields')['link'];
$cost = number_format(get_field('other_fields')['cost'] ?? 0, 0, ',', ' ') . ' &#8381;';
?>
<a href="<?= $link ?>" class="card" target="_blank">
    <div class="card__panel ratio ratio_16x9">
        <div class="ratio__content">
            <?php
            the_post_thumbnail('large') ?>
            <div class="card__category"><?= $category[0]->cat_name ?? 'Без категории' ?></div>
            <img src="/wp-content/themes/sm-school/images/icons/play.png" class="video-btn" alt="play">
        </div>
    </div>
    <div class="card__link"><?= the_title() ?></div>
</a>
