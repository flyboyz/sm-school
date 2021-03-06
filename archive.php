<?php

$post_type = get_post_type();
get_header();
?>
    <div class="container container_fixed container_full-width_m-less">
        <div class="page-headline">
            <h1 class="page-title"><?= get_the_archive_title() ?></h1>
            <div class="page-filters">
                <?= do_shortcode('[filter post_type=' . $post_type . ']'); ?>
            </div>
        </div>
    </div>
    <div class="container container_fixed">
        <?php
        if (have_posts()):
            ?>
            <div class="content-list">
                <div class="content-columns">
                    <?php
                    while (have_posts()):
                        the_post();
                        get_template_part("template-parts/content/$post_type");
                    endwhile; ?>
                </div>
                <div id="load-more" data-type="<?= $post_type ?>">
                    <img src="/wp-content/themes/sm-school/images/icons/loader.svg" alt="loading">
                </div>
            </div>
        <?php
        else:
            get_template_part("template-parts/content/none");
        endif; ?>
    </div>
<?php
get_footer();
