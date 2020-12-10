</main>
<?php
get_sidebar(); ?>
<footer class="footer">
    <div class="container container_fixed footer__container">
        <div class="footer-col">
            <div class="d-flex align-items-center">
                <img src="<?= get_template_directory_uri() ?>/images/logo.png" class="footer__logo" alt="logo">
                <p><?= get_bloginfo('name') ?>
                    <br>Все права защищены © <?= date('Y') ?>
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
wp_footer();
