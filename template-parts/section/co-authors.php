<?php

$teacher = get_the_teacher();
$coauthors = get_field('co-authors');

if (!empty($coauthors)):
    ?>
    <div class="section section_course-co-authors">
        <div class="container container_fixed container_full-width_s-less">
            <h2>Соавторы курса</h2>
            <div class="co-authors">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($coauthors as $author):
                        apply_filters('fill_author', $author);
                        $author_name = apply_filters('wrap_surname', $author->name)
                        ?>
                        <div class="co-authors__item swiper-slide">
                            <img src="<?= $author->avatar['thumbnail'] ?>" alt="author">
                            <div class="name"><?= $author_name ?></div>
                            <div class="position"><?= $author->position ?></div>
                            <a data-fancybox data-options='{"touch" : false}' data-src="#author-<?= $author->term_id ?>"
                               href="javascript:;" class="more">подробнее...</a>
                            <div class="container container_small co-author-modal"
                                 id="author-<?= $author->term_id ?>"
                                 style="display: none;">
                                <div class="meta">
                                    <img src="<?= $author->avatar['thumbnail'] ?>" alt="author">
                                    <div>
                                        <div class="name"><?= $author_name ?></div>
                                        <div class="position"><?= $author->position ?></div>
                                    </div>
                                </div>
                                <div class="description">
                                    <?= $author->description ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php
endif;