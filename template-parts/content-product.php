<?php

$product = $args['product']; ?>
<div class="card">
    <div class="card__panel ratio ratio_16x9">
        <div class="ratio__content">
            <?= get_the_post_thumbnail($product->ID, 'large') ?>
        </div>
    </div>
    <div class="card__title"><?= $product->post_title ?></div>
    <div class="card__cost"><?= get_product_cost($product->ID) ?></div>
    <a href="<?= get_field('fields', $product->ID)['pay_link'] ?>" class="card__button" target="_blank">Купить</a>
</div>