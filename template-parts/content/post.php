<a href="<?= get_post_permalink() ?>" class="card card_post card_border">
    <div class="card__panel ratio ratio_16x9">
        <div class="ratio__content">
            <?php
            the_post_thumbnail('large') ?>
            <div class="card__category"><?= get_the_first_category('Без категории') ?></div>
        </div>
    </div>
    <div class="card__title"><?= the_title() ?></div>
</a>