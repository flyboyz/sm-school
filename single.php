<?php

$fields = get_field('fields');
get_header();
if (have_posts()):
    ?>
    <div class="container container_fixed container_no-paddnig content-box">
        <a href="/projects/" class="link-back icon icon_block icon-arrow icon-arrow_back">Вернуться к списку
            разработок</a>
        <div class="details-card">
            <div class="card">
                <img class="card__image" src="<?php
                the_post_thumbnail_url('large'); ?>" alt="photo">
                <div class="card__title"><?= the_title() ?></div>
                <div class="card__subtitle"><?= $fields['short_description'] ?></div>
                <div class="card__actions">
                    <a href="<?= $fields['link'] ?>" target="_blank" class="card__link icon icon-arrow">Перейти</a>
                </div>
            </div>
            <div class="details-content">
                <?php
                the_content() ?>
            </div>
        </div>
    </div>
<?php
endif;
get_footer();


