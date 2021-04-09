<?php

$product = $args['product']; ?>
<div class="card">
    <a class="card__panel ratio ratio_16x9" data-fancybox data-options='{"touch" : false}'
       data-src="#product-<?= $product->ID ?>" href="javascript:;">
        <div class="ratio__content">
            <?= get_the_post_thumbnail($product->ID, 'large') ?>
        </div>
    </a>
    <a class="card__title" data-fancybox data-options='{"touch" : false}' data-src="#product-<?= $product->ID ?>"
       href="javascript:;"><?= $product->post_title ?></a>
    <div class="card__subtitle"><?= get_product_cost($product->ID) ?></div>
    <a href="<?= get_field('fields', $product->ID)['pay_link'] ?>" class="card__button" target="_blank">Купить</a>
</div>

<div class="container container_fixed container_no-paddnig content-box" id="product-<?= $product->ID ?>"
     style="display: none;">
    <div class="details-card">
        <div class="card">
            <img class="card__image card__image_bordered" src="<?= get_the_post_thumbnail_url($product->ID, 'large') ?>"
                 alt="photo">
            <div class="card__title"><?= $product->post_title ?></div>
            <div class="card__subtitle"><?= get_product_cost($product->ID) ?></div>
            <a href="<?= get_field('fields', $product->ID)['pay_link'] ?>" class="card__button"
               target="_blank">Купить</a>
        </div>
        <div class="details-content">
            <?= $product->post_content ?>
        </div>
    </div>
</div>