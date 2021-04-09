<?php

/**
 * Course Contents Block Template.
 *
 * @param array $block The block settings and attributes.
 */

$className = '';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$contents = get_field('contents');
?>
<div class="section course-contents <?php
echo esc_attr($className); ?>">
    <div class="container container_fixed container_full-width_m-less">
        <h2 class="has-text-align-center">Содержание</h2>
        <div class="swiper-container contents-list">
            <div class="swiper-wrapper">
                <?php
                if (!is_admin()):
                    foreach ($contents as $content): ?>
                        <div class="contents-list__item swiper-slide">
                            <span><?= $content['title'] ?></span>
                            <?= apply_filters('the_content', $content['text']) ?>
                        </div>
                    <?php
                    endforeach;
                else: ?>
                    Кол-во уроков - <?= count($contents) ?>
                <?php
                endif; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>