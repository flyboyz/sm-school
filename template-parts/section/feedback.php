<?php

$feedback = get_field('feedback');
$wpformsID = 387;

if (!empty($feedback)):
    ?>
    <div class="section section_course-feedback">
        <div class="container container_fixed container_full-width_s-less">
            <h2>Отзывы</h2>
            <div class="feedback">
                <?php
                foreach ( $feedback as $item ): ?>
                    <div class="dialog feedback__item">
                        <div class="dialog__author">
                            <img src="<?= get_template_directory_uri() ?>/images/icons/fb-photo.png" alt="icon">
                            <span><?= $item['name'] ?></span>
                        </div>
                        <div class="dialog__text"><?= $item['text'] ?></div>
                    </div>
                <?php
                endforeach ?>
                <div class="dialog feedback__item feedback__item_moderate">
                    <div class="dialog__author">
                        <img src="<?= get_template_directory_uri() ?>/images/icons/fb-photo.png" alt="icon">
                        <span></span>
                    </div>
                    <div class="dialog__text"></div>
                </div>
                <div class="dialog__form">
                    <p class="title">ОСТАВИТЬ ОТЗЫВ:</p>
		            <?php
		            echo do_shortcode( "[wpforms id=$wpformsID]" ) ?>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
