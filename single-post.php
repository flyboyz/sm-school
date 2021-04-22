<?php

$author_meta = get_user_meta(get_post()->post_author);

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
                <img class="quote" src="<?= get_template_directory_uri() ?>/images/icons/quote.png" alt="quote">
                <div class="line"></div>
                <div class="date"><?= get_the_date() ?></div>
                <?php
                if ($author_meta): ?>
                    <?= wp_get_attachment_image($author_meta['avatar'][0], 'thumbnail', false,
                        ['class' => 'author-line__avatar']) ?>
                    <span><?= $author_meta['first_name'][0] . ' ' . $author_meta['last_name'][0] ?></span>
                <?php
                endif; ?>
            </div>
            <h1 class="publication__title"><?php
                the_title() ?></h1>
            <div class="publication__cols">
                <div class="publication__share">
                    <span>Поделись</span>
                    <div class="line"></div>
                    <a href="<?= get_social_link('vk') ?>" target="_blank">
                        <?= file_get_contents(get_template_directory() . '/images/icons/social-vk.svg') ?></a>
                    <a href="<?= get_social_link('facebook') ?>" target="_blank">
                        <?= file_get_contents(get_template_directory() . '/images/icons/social-facebook.svg') ?></a>
                    <a href="<?= get_social_link('twitter') ?>" target="_blank">
                        <?= file_get_contents(get_template_directory() . '/images/icons/social-twitter.svg') ?></a>
                    <a href="<?= get_social_link('ok') ?>" target="_blank">
                        <?= file_get_contents(get_template_directory() . '/images/icons/social-odnoklassniki.svg') ?></a>
                    <a href="<?= get_social_link('linkedin') ?>" target="_blank">
                        <?= file_get_contents(get_template_directory() . '/images/icons/social-linkedin.svg') ?></a>
                </div>
                <div class="publication__content"><?php
                    the_content() ?></div>
            </div>
        </div>
    </div>
<?php
endif;
get_footer();
