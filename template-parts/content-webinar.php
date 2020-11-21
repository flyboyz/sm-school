<a href="<?= get_field('other_fields')['link'] ?>" class="card" target="_blank">
    <div class="card__panel ratio ratio_16x9">
        <div class="ratio__content">
            <?php
            the_post_thumbnail('large') ?>
            <div class="card__category"><?= get_the_first_category('Без категории') ?></div>
            <img src="/wp-content/themes/sm-school/images/icons/play.png" class="video-btn" alt="play">
        </div>
    </div>
    <div class="card__title"><?= the_title() ?></div>
</a>
