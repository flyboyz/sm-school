<?php
/* Template name: Страница продаж */

$post_type = 'product';

$teacher = get_field('teacher');
$products = get_field('products');

get_header();
if (have_posts()):
    ?>
    <div class="container container_fixed">
        <div class="author-line">
            <img src="<?= get_template_directory_uri() ?>/images/icons/quote.png" alt="quote">
            <div class="line"></div>
            <img class="author-line__avatar"
                 src="<?= get_field('fields', 'teacher_' . $teacher->term_id)['avatar']['sizes']['thumbnail'] ?>"
                 alt="photo">
            <span><?= $teacher->name ?></span>
        </div>
    </div>
    <div class="container container_fixed">
        <div class="content-columns">
            <?php
            foreach ($products as $product) {
                get_template_part('template-parts/content', $post_type, ['product' => $product]);
            }
            ?>
        </div>
        <div id="load-more" data-type="<?= $post_type ?>">
            <img src="<?= get_template_directory_uri() ?>/images/icons/loader.svg" alt="loading">
        </div>
    </div>
<?php
endif;
get_footer();
