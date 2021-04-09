<?php

$post_type = 'teacher';

$teachers = get_users();
get_header();
if (have_posts()):
    ?>
    <div class="container container_fixed container_full-width_m-less">
        <div class="page-headline">
            <h1 class="page-title"><?php
                the_title() ?></h1>
        </div>
    </div>
    <div class="content-columns content-columns__wide">
        <?php
        foreach ($teachers as $teacher):
            get_template_part("template-parts/content/$post_type", '', ['teacher' => $teacher]);
        endforeach; ?>
    </div>
    <div id="load-more" data-type="<?= $post_type ?>">
        <img src="/wp-content/themes/sm-school/images/icons/loader.svg" alt="loading">
    </div>
<?php
endif;
get_footer();
