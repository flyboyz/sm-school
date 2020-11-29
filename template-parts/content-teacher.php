<a href="<?= get_post_permalink() ?>" class="card card_no-padding">
    <div class="card__panel card__panel_teacher ratio ratio_4x3">
        <div class="ratio__content">
            <?php
            the_post_thumbnail('large') ?>
            <div class="card__category"><?= get_the_first_teacher_category() ?></div>
        </div>
    </div>
    <div class="card__title"><?= the_title() ?>
        <img src="<?= get_template_directory_uri() ?>/images/icons/arrow.png" alt="arrow">
    </div>
    <div class="card__subtitle"><?= get_field('teacher_fields')['position'] ?></div>
</a>
