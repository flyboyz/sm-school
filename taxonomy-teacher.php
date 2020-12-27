<?php

$post_type = get_post_type();
get_header();
if (have_posts()):
    $title = get_post_type_labels(get_post_type_object($post_type))->archives;
    ?>
    <div class="container container_fixed container_full-width_m-less">
        <div class="page-headline">
            <h1 class="page-title"><?= $title ?></h1>
            <div class="page-filters">
                <?= do_shortcode('[searchandfilter post_types="' . $post_type . '" fields="teacher,category" submit_label="Применить"]'); ?>
            </div>
        </div>
    </div>
    <div class="container container_fixed">
        <div class="content-list">
            <div class="content-columns">
                <?php
                while (have_posts()):
                    the_post();
                    get_template_part('template-parts/content', $post_type);
                endwhile; ?>
            </div>
            <div id="load-more" data-type="<?= $post_type ?>">
                <img src="/wp-content/themes/sm-school/images/icons/loader.svg" alt="loading">
            </div>
        </div>
    </div>
<?php
endif;
get_footer();
