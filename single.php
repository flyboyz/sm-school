<?php

$post_type = get_post_type();
$fields = get_field('fields') ?? get_fields();
get_header();
if (have_posts()):
    ?>
    <div class="container container_fixed container_no-paddnig content-box">
        <a href="<?= get_post_type_archive_link($post_type) ?>"
           class="link-back icon icon_block icon-arrow icon-arrow_back">Вернуться к
            списку <?= get_post_type_labels(get_post_type_object($post_type))->back_link ?></a>
        <div class="details-card">
            <div class="card">
                <img class="card__image" src="<?php
                the_post_thumbnail_url('large'); ?>" alt="photo">
                <div class="card__title"><?= the_title() ?></div>
                <div class="card__mobile-row">
                    <div class="card__subtitle"><?= $fields['short_description'] ?? $fields['type'] ?></div>
                    <div class="card__actions">
                        <?php
                        if ($fields['link']): ?>
                            <a href="<?= $fields['link'] ?>" target="_blank"
                               class="card__link icon icon-arrow">Перейти</a>
                        <?php
                        endif;
                        if ('vacancy' === $post_type):
                            ?>
                            <a data-fancybox data-src="#VacancyModal" href="javascript:;" class="button">Отправить
                                резюме</a>
                            <div id="VacancyModal" class="modal modal_black" style="display: none;">
                                <div class="modal__title">Заполните форму чтобы отправить резюме</div>
                                <?= do_shortcode('[wpforms id="291"]') ?>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
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


