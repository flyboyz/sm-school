<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" type="image/png" href="/icons/favicon.png">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="header">
    <div class="container header__container">
        <a href="/" class="header__logo-link">
            <img src="<?= get_template_directory_uri() ?>/images/logo.png" class="header__logo" alt="logo">
            <span class="header__site-name m-less_hide">SM School</span>
        </a>
        <span class="header__site-name m-less_show">SM School</span>
        <?php
        wp_nav_menu([
            'theme_location' => 'header_menu',
            'container' => '',
        ]);
        ?>
        <div class="hamburger">
            <div class="bar bar_1"></div>
            <div class="bar bar_2"></div>
            <div class="bar bar_3"></div>
        </div>
    </div>
</header>
<main>