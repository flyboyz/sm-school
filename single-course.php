<?php

get_header();
the_content();

$teacher = get_the_teacher();
$coauthors = get_field('co-authors');

if (!empty($coauthors)):
    ?>
    <div class="section section_course-co-authors">
        <div class="container container_fixed container_full-width_s-less">
            <h2>Соавторы курса</h2>
            <div class="co-authors">
                <?php
                foreach ($coauthors as $author):
                    apply_filters('fill_author', $author);
                    ?>
                    <div class="co-authors__item">
                        <img src="<?= $author->avatar['thumbnail'] ?>" alt="author">
                        <div class="name"><?= apply_filters('wrap_surname', $author->name) ?></div>
                        <div class="position"><?= $author->position ?></div>
                        <!--<?= $author->description ?>-->
                    </div>
                <?php
                endforeach; ?>
            </div>
        </div>
    </div>
<?php
endif;
?>
    <div class="section section_course-feedback">
        <div class="container container_fixed container_full-width_s-less">
            <h2>Отзывы</h2>
            <div class="feedback">
                <?php
                for ($i = 0; $i < 3; $i++): ?>
                    <div class="dialog feedback__item">
                        <div class="dialog__author">
                            <img src="<?= get_template_directory_uri() ?>/images/icons/fb-photo.png" alt="icon">
                            <span>Артем</span>
                        </div>
                        <div class="dialog__text">
                            Мне всегда нравилось творчество. И истории творцов (писателей, актёров, режиссеров)
                            завораживали меня. На мастер-классе я приобрёл драгоценный опыт по созданию рассказа,
                            выстраиванию сюжета и героев. Это было супер. Занятие было наполнено теплотой и светом. Я
                            продолжаю писать - спасибо Евгения!
                        </div>
                    </div>
                <?php
                endfor; ?>
            </div>
        </div>
    </div>
    <div class="section section_course-faq section_shadow">
        <div class="container container_fixed container_full-width_m-less">
            <h2>Ответы на вопросы</h2>
            <div class="faq">
                <?php
                for ($i = 0; $i < 2; $i++): ?>
                    <div class="faq__item">
                        <div class="dialog faq__question">
                            <div class="dialog__top">
                                <div class="dialog__author">
                                    <img src="<?= get_template_directory_uri() ?>/images/icons/fb-photo.png" alt="icon">
                                    Артем
                                </div>
                                <span class="faq__type">Вопрос</span>
                            </div>
                            <div class="dialog__text">
                                Что-то мне кажется, что эту книгу могут начать ругать, ведь отчасти то, что говорит
                                автор совершенно не выгодно рынку.
                            </div>
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
                            <div class="dialog__text">
                                Что-то мне кажется, что эту книгу могут начать ругать, ведь отчасти то, что говорит
                                автор совершенно не выгодно рынку.
                            </div>
                        </div>
                    </div>
                <?php
                endfor; ?>
            </div>
        </div>
    </div>
<?php
get_footer();