</main>
<?php
get_sidebar(); ?>
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
            'menu_class' => 'footer-col s-less_hide',
        ]);
        wp_nav_menu([
            'theme_location' => 'footer_third',
            'container' => '',
            'menu_class' => 'footer-col s-less_hide',
        ]); ?>
        <div class="s-less_show">
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
    </div>
</footer>
<?php
wp_footer();
