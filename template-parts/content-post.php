<a href="<?= get_post_permalink() ?>" class="card card_border">
    <div class="card__panel ratio ratio_4x3">
        <div class="ratio__content">
            <?php
            the_post_thumbnail('large') ?>
            <div class="card__category"><?= get_the_first_category('Без категории') ?></div>
        </div>
    </div>
    <div class="card__title"><?= the_title() ?></div>
</a>
