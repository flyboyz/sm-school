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

$teacher = get_the_teacher();
$text = get_field('text') ?: 'Описание';
?>
<div class="wp-block-group section section_course-about-author section_no-padding <?php
echo esc_attr($className); ?>">
    <div class="wp-block-group__inner-container">
        <div class="wp-block-columns container">
            <div class="wp-block-column">
                <?php
                if (!is_admin()): ?>
                    <div class="wp-block-image">
                        <figure>
                            <img loading="lazy" width="540" height="540" src="<?= $teacher->big_photo['square'] ?>">
                        </figure>
                    </div>
                    <span class="name"><?= apply_filters('wrap_surname', $teacher->name) ?></span>
                <?php
                else: ?>
                    <style>
                        .photo {
                            display: flex;
                            margin: 100px auto;
                            width: 200px;
                            height: 200px;
                            align-items: center;
                            justify-content: center;
                            background-color: lightgray;
                            border-radius: 200px;
                        }
                    </style>
                    <div class="photo">
                        Фото преподавателя
                    </div>
                <?php
                endif; ?>
            </div>
            <div class="wp-block-column is-vertically-aligned-center">
                <h3>Об Авторе</h3>
                <?= $text ?>
            </div>
        </div>
    </div>
</div>