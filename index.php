<?php
get_header();
if (have_posts()):
    the_post();

    $thumbnail_id = get_post_thumbnail_id();
    ?>
    <div class="container container_fixed container_full-width_m-less content-box">
        <?php if ($thumbnail_id): ?>
            <img src="<?php the_post_thumbnail_url('large'); ?>" alt="thumbnail" class="feature-image">
        <?php endif; ?>
        <?php the_title('<h1>', '</h1>') ?>
        <div class="content <?= $thumbnail_id ? 'content_have-feature-image' : '' ?>">
            <?php the_content(); ?>
        </div>
    </div>
<?php
endif;
get_footer();
