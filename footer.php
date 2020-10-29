</main>
<?php get_sidebar(); ?>
<footer class="footer">
    <div class="container footer__container">
        <div class="footer-col">
            <div class="d-flex">
                <img src="<?= get_template_directory_uri() ?>/images/logo.png" class="footer__logo" alt="logo">
                <p>SM School
                    <br>Все права защищены © 2019
                </p>
            </div>
        </div>
        <div class="footer-col">
            <p>ИНН: 616305900458
                <br>ОГРНИП: 319619600023612</p>
        </div>
        <div class="footer-col">
            <a href="/policy/">Политика конфиденциальности</a>
        </div>
    </div>
</footer>
<?php
wp_footer();
