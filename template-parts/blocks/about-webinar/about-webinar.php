<?php

/**
 * Testimonial Block Template.
 *
 * @param array $block The block settings and attributes.
 */

$className = 'testimonial';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$author_meta = get_user_meta(get_post()->post_author);
$text = get_field('text') ?: 'Описание';
?>
<div class="wp-block-group section section_course-about-webinar section_no-padding <?php
echo esc_attr($className); ?>">
    <div class="wp-block-group__inner-container">
        <div class="wp-block-columns container">
            <div class="wp-block-column">
                <?php
                if (!is_admin()): ?>
                    <div class="wp-block-image">
                        <figure><?= wp_get_attachment_image(get_field('photo'), 'square') ?></figure>
                    </div>
                    <span class="name"><?= $author_meta['first_name'][0] ?> <span><?= $author_meta['last_name'][0] ?></span></span>
                <?php
                else: ?>
                    <style>
                        .section_course-about-webinar .photo {
                            display: flex;
                            height: 200px;
                            align-items: center;
                            justify-content: center;
                            background-color: lightgray;
                        }
                    </style>
                    <div class="photo">
                        Фото преподавателя
                    </div>
                <?php
                endif; ?>
            </div>
            <div class="wp-block-column is-vertically-aligned-center">
                <h3>О мастер классе</h3>
                <?= $text ?>
            </div>
        </div>
    </div>
</div>