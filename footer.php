</main>
<?php get_sidebar(); ?>
<footer class="footer">
    <div class="container container_fixed footer__container">
        <div class="footer-col">
            <div class="d-flex align-items-center">
                <img src="<?= get_template_directory_uri() ?>/images/logo.png" class="footer__logo" alt="logo">
                <p>SM School
                    <br>Все права защищены © <?= date('Y') ?>
                </p>
            </div>
        </div>
        <div class="footer-col">
            <p>ИНН: 616305900458
                <br>ОГРНИП: 319619600023612
                <a href="/policy/" class="m-less_show">Политика конфиденциальности</a>
            </p>
        </div>
        <div class="footer-col m-less_hide">
            <a href="/policy/">Политика конфиденциальности</a>
        </div>
    </div>
</footer>
<?php
wp_footer();
