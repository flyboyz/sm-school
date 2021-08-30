<?php

get_header();
if (isset($promo) && ! $promo->is_active()) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    get_template_part(404);
    exit();
}
?>
    <div class="container container_fixed video-full-width">
        <h1><?php
            the_title() ?> </h1>
        <?php
        the_content(); ?>
    </div>
<?php
get_footer();