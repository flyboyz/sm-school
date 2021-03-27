<?php

/**
 * Testimonial Block Template.
 *
 * @param array $block The block settings and attributes.
 */

$className = '';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$contents = get_field('contents');
?>
<div class="wp-block-group section section_course-contents <?php
echo esc_attr($className); ?>">
    <div class="wp-block-group__inner-container">
        <div class="wp-block-group container container_fixed container_full-width_m-less">
            <div class="wp-block-group__inner-container">
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
    </div>
</div>