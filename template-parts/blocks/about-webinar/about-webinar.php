<?php

/**
 * About Webinar Block Template.
 *
 * @param array $block The block settings and attributes.
 */

$className = '';
if (!empty($block['className'])) {
    $className = $block['className'];
}

$author_meta = get_user_meta(get_post()->post_author);
$text = get_field('text') ?: 'Описание';
?>
<div class="section about-webinar section_no-padding <?php
echo esc_attr($className); ?>">
    <div class="wp-block-columns container">
        <div class="wp-block-column">
            <figure><?= wp_get_attachment_image(get_field('photo'), 'large') ?></figure>
            <div class="info">
                <span class="name"><?= $author_meta['first_name'][0] ?> <?= $author_meta['last_name'][0] ?></span>
                <hr>
                <div class="position"><?= $author_meta['position'][0] ?></div>
            </div>
        </div>
        <div class="wp-block-column is-vertically-aligned-center">
            <div>
                <h3>О мастер классе</h3>
                <?= $text ?>
            </div>
            <img src="<?= get_template_directory_uri() ?>/images/icons/pero.png" alt="back-icon">
        </div>
    </div>
</div>