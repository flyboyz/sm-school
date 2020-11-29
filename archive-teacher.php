<?php

$post_type = get_post_type();
get_header();
if (have_posts()):
    $title = get_post_type_labels(get_post_type_object($post_type))->archives;
    ?>
    <div class="container container_fixed container_full-width_m-less">
        <h1><?= $title ?></h1>
    </div>
    <div class="container">
        <div class="content-columns">
            <?php
            while (have_posts()) {
                the_post();
                get_template_part('template-parts/content', $post_type);
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
