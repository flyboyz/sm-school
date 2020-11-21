<div class="card">
    <div class="card__panel card__panel_course">
        <div class="card__category"><?= get_the_first_category('Без категории') ?></div>
        <div class="card__inner-title"><?= the_title() ?></div>
        <div class="card__author">
            <?= get_avatar(get_the_author_meta('ID'), 80) ?>
            <span><?= get_the_author(); ?></span>
        </div>
    </div>
    <span class="card__cost"><?= get_course_cost() ?></span>
    <a href="<?= get_field('other_fields')['link'] ?>" class="card__title" target="_blank">Смотреть курс <img
                src="<?= get_template_directory_uri() ?>/images/icons/arrow.png" alt="arrow"></a>
</div>
