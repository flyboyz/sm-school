</main>
<?php
get_sidebar();

if (is_single() && get_post_type() === 'post'):
    ?>
    <div class="share-box">
        <span>Поделись</span>
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
<?php
endif; ?>
<footer class="footer">
    <div class="container container_fixed footer__container">
        <div class="footer-col">
            <div class="d-flex align-items-center">
                <img src="<?= get_template_directory_uri() ?>/images/logo.png" class="footer__logo" alt="logo">
                <p><?= get_bloginfo('name') ?>
                    <br>Все права защищены ©&nbsp;<?= date('Y') ?>
                </p>
            </div>
        </div>
        <?php
        wp_nav_menu([
            'theme_location' => 'footer_second',
            'container' => '',
            'menu_class' => 'footer-col',
        ]);
        wp_nav_menu([
            'theme_location' => 'footer_third',
            'container' => '',
            'menu_class' => 'footer-col',
        ]); ?>
    </div>
</footer>
<?php
if (is_front_page()): ?>
    <div class="phoenix_box container container_fixed">
        <div class="phoenix"></div>
    </div>
    <!--
    <div class="frame_box container container_fixed">
        <div class="light"></div>
    </div>
    -->
<?php
endif;
wp_footer();
