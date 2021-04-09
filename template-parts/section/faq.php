<?php

$faq = get_field('faq');
$wpformsID = $_SERVER['SERVER_NAME'] === 'sm.wp' ? 504 : 439;

if (!empty($faq)):
    ?>
    <div class="section section_course-faq section_shadow">
        <div class="container container_fixed container_full-width_m-less">
            <h2>Ответы на вопросы</h2>
            <div class="faq">
                <?php
                foreach ($faq as $item): ?>
                    <div class="faq__item">
                        <div class="dialog faq__question">
                            <div class="dialog__top">
                                <div class="dialog__author">
                                    <img src="<?= get_template_directory_uri() ?>/images/icons/fb-photo.png" alt="icon">
                                    <?= $item['name'] ?>
                                </div>
                                <span class="faq__type">Вопрос</span>
                            </div>
                            <div class="dialog__text"><?= $item['question'] ?></div>
                        </div>
                        <div class="faq__dots">...</div>
                        <div class="dialog faq__answer">
                            <div class="dialog__top">
                                <div class="dialog__author">
                                    <img src="<?= get_template_directory_uri() ?>/images/icons/fb-photo.png" alt="icon">
                                    Автор
                                </div>
                                <span class="faq__type">Ответ</span>
                            </div>
                            <div class="dialog__text"><?= $item['answer'] ?></div>
                        </div>
                    </div>
                <?php
                endforeach ?>
                <div class="dialog__form">
                    <p class="title">ЗАДАТЬ ВОПРОС:</p>
                    <?php
                    echo do_shortcode("[wpforms id=$wpformsID]") ?>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
