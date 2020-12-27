<header class="header">
    <div class="container container_fixed header__container">
        <a href="/" class="header__logo-link">
            <img src="<?= get_template_directory_uri() ?>/images/logo.png" class="header__logo" alt="logo">
            <span class="header__site-name m-less_hide">SM School</span>
        </a>
        <span class="header__site-name header__site-name_centered m-less_show">SM School</span>
        <?php
        wp_nav_menu([
            'theme_location' => 'header',
            'container' => '',
        ]);

        $types = ['post', 'course'];

        if (in_array(get_post_type(), $types) && !is_single()) {
            echo '<div class="filter-btn">Фильтр</div>';
        }
        ?>
        <div class="hamburger">
            <div class="bar bar_1"></div>
            <div class="bar bar_2"></div>
            <div class="bar bar_3"></div>
        </div>
    </div>
</header>