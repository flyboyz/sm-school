<!doctype html>
<html <?php
language_attributes(); ?>>
<head>
    <meta charset="<?php
	bloginfo( 'charset' ); ?>"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
	<?php
	wp_head(); ?>
</head>
<body <?php
body_class(); ?>>
<?php
wp_body_open();
if ( get_page_template_slug() === 'template-parts/products-list.php' ) {
	get_template_part( 'template-parts/header', 'landing' );
} else {
	get_template_part( 'template-parts/header', 'standard' );
} ?>
<main>