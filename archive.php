<?php
$post_type = get_post_type();
get_header();
?>
    <div class="container container_fixed container_full-width_m-less">
        <div class="page-headline">
            <h1 class="page-title"><?= get_the_archive_title() ?></h1>
            <!--
            <div class="page-filters">
                <?= do_shortcode('[searchandfilter post_types="' . $post_type . '" fields="teacher,category" submit_label="Применить"]'); ?>
            </div>
            -->
        </div>
    </div>
<?php
if (have_posts()):
    ?>
    <div class="container container_fixed">
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
    </div>
<?php
else: ?>
    <div class="container container_fixed container_full-width_m-less">
        <div class="error-box error-box_white">
            <p>Извините! По вашему запросу ничего не найдено.</p>
            <img src="/wp-content/themes/sm-school/images/icons/face.svg" class="error-img" alt="sorry">
            <p>Но мы обязательно это исправим!
                <br><a onclick="javascript:history.back(); return false;">Вернуться назад</a></p>
        </div>
    </div>
<?php
endif; ?>
<?php
get_footer();
