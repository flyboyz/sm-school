<!doctype html>
<html <?php
language_attributes(); ?>>
<head>
    <meta charset="<?php
    bloginfo('charset'); ?>"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" type="image/png" href="/icons/favicon.png">
    <?php
    wp_head(); ?>
</head>
<body <?php
body_class(); ?>>
<?php
wp_body_open();
if (get_page_template_slug() === 'template-parts/products-list.php') {
    get_template_part('template-parts/header', 'landing');
} else {
    get_template_part('template-parts/header', 'standard');
} ?>
<main>