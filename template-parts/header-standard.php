<?php

$with_filter = in_array(get_post_type(), ['post', 'course']) && !is_single();
?>
<header class="header">
    <div class="container container_fixed header__container">
        <a href="/" class="header__logo-link">
            <img src="<?= get_template_directory_uri() ?>/images/logo.png" class="header__logo" alt="logo">
            <span class="header__site-name <?= $with_filter ?: 'header__site-name_centered' ?>">SM School</span>
        </a>
        <?php
        wp_nav_menu([
            'theme_location' => 'header',
            'container' => '',
        ]); ?>
        <div class="right-block">
            <?= $with_filter ? '<div class="filter-btn">Фильтр</div>' : '' ?>
            <div class="hamburger" data-fancybox data-src="#sidebar"
                 data-options='{"touch" : false, "baseClass" : "fancybox-sidebar"}'>
                <div class="bar bar_1"></div>
                <div class="bar bar_2"></div>
                <div class="bar bar_3"></div>
            </div>
        </div>
    </div>
</header>