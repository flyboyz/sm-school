<?php

$coauthors = get_field( 'co-authors' );

$author_meta = get_user_meta( get_post()->post_author );

?>
<div class="card">
    <div class="card__panel card__panel_course">
        <div class="card__category"><?= get_the_first_category( 'Без категории' ) ?></div>
        <div class="card__inner-title"><?= the_title() ?></div>
        <div class="card__author">
			<?= wp_get_attachment_image( $author_meta['avatar'][0], 'thumbnail',
				FALSE,
				[ 'class' => 'card__author-avatar' ] ) ?>
            <div>
                <span><?= $author_meta['first_name'][0] . ' ' . $author_meta['last_name'][0] ?></span>
				<?php
				if ( $coauthors ): ?>
                    <div class="card__coauthors">
						<?php
						foreach ( $coauthors as $coauthor ) {
							$coauthor['fields'] = get_fields( 'user_' . $coauthor['ID'] );
							echo wp_get_attachment_image( $coauthor['fields']['avatar'] );
						} ?>
                    </div>
				<?php
				endif; ?>
            </div>
        </div>
    </div>
    <a href="<?= get_the_permalink() ?>" class="card__title icon icon-arrow">Смотреть
        курс</a>
</div>