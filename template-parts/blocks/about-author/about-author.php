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
            <?php
            if (get_field('socials_on')):
                $socials = get_field('socials');
                ?>
                <h4><?= get_field('socials_title') ?></h4>
                <div class="social-line">
                    <?php
                    if ($socials['list_address_books']):
                        $form_key = wp_generate_password(6, false); ?>
                        <div class="mini-btn mail" data-fancybox data-src="#Modal_<?= $form_key ?>"
                             data-options='{"touch" : false}'>
                            <div class="button-svg">
                                <?= file_get_contents(get_template_directory() . '/images/icons/mail.svg') ?>
                            </div>
                            <span>Почта</span>
                        </div>
                        <?php
                        get_template_part('template-parts/form/sendpulse', '',
                            ['key' => $form_key, 'book_id' => $socials['list_address_books']]);
                    endif;
                    if ($socials['vk']): ?>
                        <a class="mini-btn vk" href="<?= $socials['vk'] ?>" target="_blank">
                            <div class="button-svg">
                                <?= file_get_contents(get_template_directory() . '/images/icons/social-vk.svg') ?>
                            </div>
                            <span>Вконтакте</span>
                        </a>
                    <?php
                    endif;
                    if ($socials['telegram']): ?>
                        <a class="mini-btn tg mobile-only" href="<?= $socials['telegram'] ?>" target="_blank">
                            <div class="button-svg">
                                <?= file_get_contents(get_template_directory() . '/images/icons/social-telegram.svg') ?>
                            </div>
                            <span>Telegram</span>
                        </a>
                    <?php
                    endif;
                    if ($socials['viber']): ?>
                        <a class="mini-btn viber mobile-only" href="<?= $socials['viber'] ?>" target="_blank">
                            <div class="button-svg">
                                <?= file_get_contents(get_template_directory() . '/images/icons/social-viber.svg') ?>
                            </div>
                            <span>Viber</span>
                        </a>
                    <?php
                    endif; ?>
                </div>
            <?php
            endif; ?>
        </div>
    </div>
</div>