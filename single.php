<?php

$teacher = get_the_teacher();
$post_link = urlencode(get_the_permalink());
$post_title = get_the_title();

$share_links = [
    'vk' => "https://vk.com/share.php?url=$post_link",
    'facebook' => "https://www.facebook.com/sharer/sharer.php?u=$post_link",
    'twitter' => "https://twitter.com/intent/tweet?url=$post_link&text=$post_title",
    'ok' => "https://connect.ok.ru/offer?url=$post_link&title=$post_title&imageUrl=" . get_the_post_thumbnail_url('large'),
    'linkedin' => "https://www.linkedin.com/shareArticle?mini=true&url=$post_link&title=$post_title&source=LinkedIn",
];

get_header();
if (have_posts()):
    ?>
    <div class="container container_fixed container_no-paddnig content-box" id="hidden-content">
        <a href="/publications/" class="link-back icon icon_block icon-arrow icon-arrow_back">Вернуться к списку
            публикаций</a>
        <div class="publication">
            <img src="<?php
            the_post_thumbnail_url('large'); ?>" alt="" class="publication__image">
            <div class="author-line">
                <img src="<?= get_template_directory_uri() ?>/images/icons/quote.png" alt="quote">
                <div class="line"></div>
                <div class="date"><?= get_the_date() ?></div>
                <?php
                if ($teacher): ?>
                    <img class="author-line__avatar"
                         src="<?= get_field('fields',
                             'teacher_' . $teacher->term_id)['avatar']['sizes']['thumbnail'] ?>"
                         alt="photo">
                    <span><?= $teacher->name ?></span>
                <?php
                endif; ?>
            </div>
            <h1 class="publication__title"><?php
                the_title() ?></h1>
            <div class="publication__cols">
                <div class="publication__share">
                    <span>Поделись</span>
                    <div class="line"></div>
                    <a href="<?= $share_links['vk'] ?>" target="_blank">
                        <?= file_get_contents(get_template_directory() . '/images/icons/vk.svg') ?></a>
                    <a href="<?= $share_links['facebook'] ?>" target="_blank">
                        <?= file_get_contents(get_template_directory() . '/images/icons/facebook.svg') ?></a>
                    <a href="<?= $share_links['twitter'] ?>" target="_blank">
                        <?= file_get_contents(get_template_directory() . '/images/icons/twitter.svg') ?></a>
                    <a href="<?= $share_links['ok'] ?>" target="_blank">
                        <?= file_get_contents(get_template_directory() . '/images/icons/odnoklassniki.svg') ?></a>
                    <a href="<?= $share_links['linkedin'] ?>" target="_blank">
                        <?= file_get_contents(get_template_directory() . '/images/icons/linkedin.svg') ?></a>
                </div>
                <div class="publication__content"><?php
                    the_content() ?></div>
            </div>
        </div>
    </div>
<?php
endif;
get_footer();


