<?php

$post_type = 'teacher';
$teachers = get_terms($post_type);

get_header();
if (have_posts()):
    ?>
    <div class="container container_fixed container_full-width_m-less">
        <div class="page-headline">
            <h1 class="page-title"><?= the_title() ?></h1>
            <div class="page-filters">
                <?= do_shortcode('[searchandfilter post_types="' . $post_type . '" fields="teacher,category" submit_label="Применить"]'); ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content-columns content-columns__wide">
            <?php
            foreach ($teachers as $teacher) {
                get_template_part('template-parts/content', $post_type, ['teacher' => $teacher]);
            }

            get_template_part('template-parts/content', "$post_type-promo")
            ?>
        </div>
        <div id="load-more" data-type="<?= $post_type ?>">
            <img src="/wp-content/themes/sm-school/images/icons/loader.svg" alt="loading">
        </div>
    </div>
<?php
endif;
get_footer();
