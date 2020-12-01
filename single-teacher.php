<?php
$fields = get_field('teacher_fields');

get_header();
if (have_posts()):
    the_post();

    $users = get_users([
        'role' => 'teacher',
        'fields' => 'all_with_meta'
    ]);
    ?>
    <div class="container container_fixed container_full-width_m-less content-box">
        <a href="/teachers/" class="link-back icon icon_block icon-arrow icon-arrow_back">Вернуться к списку
            преподавателей</a>
        <div class="details-card">
            <div class="card">
                <?php
                the_post_thumbnail('medium');
                ?>
                <div class="card__title"><?= get_the_title(); ?></div>
                <div class="card__subtitle"><?= $fields['position'] ?></div>
                <div class="card__actions">
                    <a href="/" class="card__link icon icon-arrow">Курсы</a>
                    <a href="/" class="card__link icon icon-arrow">Статьи</a>
                </div>
            </div>
            <div class="details-content">
                <?php
                the_content(); ?>
            </div>
        </div>
    </div>
<?php
endif;
get_footer();
