<?php

/**
 * About Author Block Template.
 *
 * @param array $block The block settings and attributes.
 */

$className = 'testimonial';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
$author_meta = get_user_meta(get_post()->post_author);
?>
<div class="section block-about-author section_no-padding <?= esc_attr($className) ?>">
    <div class="wp-block-columns container">
        <div class="wp-block-column">
            <div class="wp-block-image">
                <figure><?= wp_get_attachment_image(get_field('photo'), 'square') ?></figure>
            </div>
            <span class="name"><?= $author_meta['first_name'][0] ?> <span><?= $author_meta['last_name'][0] ?></span></span>
        </div>
        <div class="wp-block-column is-vertically-aligned-center">
            <h3>Об Авторе</h3>
            <?= get_field('text') ?? 'Описание' ?>
        </div>
    </div>
</div>