<a href="<?= get_the_permalink() ?>" class="card">
    <div class="card__panel ratio ratio_16x9">
        <div class="ratio__content">
            <?php
            the_post_thumbnail('large') ?>
            <div class="card__category"><?= get_the_first_category('Без категории') ?></div>
        </div>
    </div>
    <div class="card__title icon icon-arrow"><?= the_title() ?></div>
    <div class="card__subtitle"><?= get_field('fields')['short_description'] ?></div>
</a>
