<?php

get_header();
?>
    <div class="container container_fixed container_full-width_m-less">
        <div class="page-headline">
            <h1 class="page-title">Публикации</h1>
            <div class="page-filters">
                <?= do_shortcode('[filter post_type=' . get_post_type() . ']'); ?>
            </div>
        </div>
    </div>
    <div class="container container_fixed">
    <div class="content-list content-list_posts">
<?php
if (have_posts()):
    $i = 0;
    while (have_posts()) {
        if ($i === 0 || $i % 6 === 0) {
            echo '<div class="content-columns">';
        }

        $i++;
        the_post();
        get_template_part('template-parts/content/post', '', ['post_num' => $i]);

        if ($i === 6 || $i % 6 === 0) {
            echo '</div>';
        }
    }
    ?>
    </div>
    <div id="load-more" data-type="post">
        <img src="/wp-content/themes/sm-school/images/icons/loader.svg" alt="loading">
    </div>
    </div>
<?php
else:
    get_template_part("template-parts/content/none");
endif;
get_footer();
