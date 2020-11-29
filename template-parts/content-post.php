<?php

$style = '';
$start_pos = $args['page'] ?? 0;

switch ($args['post_num']) {
    case 1:
        $style = "grid-column: 1/3; grid-row: " . ($start_pos * 4 + 1) . "/" . ($start_pos * 4 + 3);
        break;
    case 6:
        $style = "grid-column: 2/-1; grid-row: " . (($start_pos + 1) * 4 - 1) . "/" . (($start_pos + 1) * 4 + 1);
        break;
    default:
        $style = '';
}
?>
<a href="<?= get_post_permalink() ?>" class="card card_border" style="<?= $style ?>">
    <div class="card__panel ratio ratio_4x3">
        <div class="ratio__content">
            <?php
            the_post_thumbnail('large') ?>
            <div class="card__category"><?= get_the_first_category('Без категории') ?></div>
        </div>
    </div>
    <div class="card__title"><?= the_title() ?></div>
</a>
