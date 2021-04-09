<?php

/**
 * Webinar Contents Block Template.
 *
 * @param array $block The block settings and attributes.
 */

$className = '';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$contents = get_field('contents');
?>
<div class="section webinar-contents back-white <?php
echo esc_attr($className); ?>">
    <div class="container container_l container_full-width_m-less">
        <h2 class="has-text-align-center">Содержание</h2>
        <div class="contents-list">
            <?php
            if (!is_admin()):
                foreach ($contents as $content): ?>
                    <div class="contents-list__item">
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
        <img class="back-image" src="<?= get_template_directory_uri() ?>/images/book-reader.png" alt="back-image">
    </div>
</div>