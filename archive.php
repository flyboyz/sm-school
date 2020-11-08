<?php

get_header();
if (have_posts()):
    $title = get_post_type_labels(get_post_type_object(get_post_type()))->archives;
    ?>
    <div class="container container_fixed container_full-width_m-less">
        <h1><?= $title ?></h1>
    </div>
    <div class="container container_fixed">
        <div class="content-columns">
            <?php
            while (have_posts()):
                the_post();
                get_template_part('template_parts/content', get_post_type());
            endwhile; ?>
        </div>
    </div>
<?php
endif;
get_footer();
