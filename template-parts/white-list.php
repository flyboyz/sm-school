<?php
/* Template name: Чистый лист */

get_header();
if (have_posts()):
    ?>
    <div class="container container_fixed container_full-width_m-less content-box">
        <h1 class="page-title"><?php
            the_title() ?> </h1>
        <div class="content content_background_white content_border-bottom">
            <?php
            the_content(); ?>
        </div>
    </div>
<?php
endif;
get_footer();
