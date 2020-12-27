<?php

get_header();
if (have_posts()):
    the_post();

    $thumbnail_id = get_post_thumbnail_id();
    ?>
    <div class="container container_fixed container_full-width_m-less content-box">
        <div class="page-headline">
            <h1 class="page-title"><?php
                the_title() ?> </h1>
        </div>
        <?php
        if ($thumbnail_id): ?>
            <img src="<?php
            the_post_thumbnail_url('full'); ?>" alt="thumbnail" class="feature-image">
        <?php
        endif; ?>
        <div class="content content_no-padding <?= $thumbnail_id ? 'content_have-feature-image' : '' ?>">
            <?php
            the_content(); ?>
        </div>
    </div>
<?php
endif;
get_footer();
