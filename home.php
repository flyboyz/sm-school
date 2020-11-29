<?php

get_header(); ?>
    <div class="container container_fixed container_full-width_m-less">
        <h1><?php
            single_post_title(); ?></h1>
    </div>
    <div class="container container_fixed">
    <div class="content-columns">
<?php
if (have_posts()):
    while (have_posts()) {
        the_post();
        get_template_part('template-parts/content', 'post');
    }
    ?>
    </div>
    <div id="load-more" data-type="<?= 'post' ?>">
        <img src="/wp-content/themes/sm-school/images/icons/loader.svg" alt="loading">
    </div>
    </div>
<?php
endif;
get_footer();
