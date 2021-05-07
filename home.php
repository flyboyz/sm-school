<?php

get_header();
?>
    <div class="container container_fixed container_full-width_m-less">
        <div class="page-headline">
            <h1 class="page-title">Публикации</h1>
            <!--
            <div class="page-filters">
                <?= do_shortcode('[searchandfilter post_types="' . get_post_type() . '" fields="teacher,category" submit_label="Применить"]'); ?>
            </div>
            -->
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
    <div id="load-more" data-type="<?= 'post' ?>">
        <img src="/wp-content/themes/sm-school/images/icons/loader.svg" alt="loading">
    </div>
    </div>
<?php
else:
    get_template_part("template-parts/content/none");
endif;
get_footer();
