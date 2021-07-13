<!doctype html>
<html <?php
language_attributes(); ?>>
<head>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript"> (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
          (m[i].a = m[i].a || []).push(arguments)
        }
        m[i].l = 1 * new Date()
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
      })(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js', 'ym')
      ym(80102551, 'init', {
        clickmap: true,
        trackLinks: true,
        accurateTrackBounce: true,
        webvisor: true
      }) </script>
    <!-- /Yandex.Metrika counter -->
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
<!-- Yandex.Metrika counter -->
<noscript>
	<div><img src="https://mc.yandex.ru/watch/80102551"
	          style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->
<?php
wp_body_open();
if ( get_page_template_slug() === 'template-parts/products-list.php' || isset( $_GET['static_page'] ) ) {
	get_template_part( 'template-parts/header', 'static' );
} else {
	get_template_part( 'template-parts/header', 'standard' );
}
do_action( 'header_banner' );
?>
<main>