<?php

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
                        $author['fields'] = get_fields('user_' . $author['ID']);
                        $author_name = $author['user_firstname'] . ' <span>' . $author['user_lastname'] . '</span>';
                        ?>
                        <div class="co-authors__item swiper-slide">
                            <?= wp_get_attachment_image($author['fields']['avatar']) ?>
                            <div class="name"><?= $author_name ?></div>
                            <div class="position"><?= $author['fields']['position'] ?></div>
                            <a data-fancybox data-options='{"touch" : false}' data-src="#author-<?= $author['ID'] ?>"
                               href="javascript:;" class="more">подробнее...</a>
                            <div class="container container_small modal modal_light modal_co-author"
                                 id="author-<?= $author['ID'] ?>"
                                 style="display: none;">
                                <div class="meta">
                                    <?= wp_get_attachment_image($author['fields']['avatar']) ?>
                                    <div>
                                        <div class="name"><?= $author_name ?></div>
                                        <div class="position"><?= $author['fields']['position'] ?></div>
                                    </div>
                                </div>
                                <div class="description">
                                    <?= \nl2br($author['user_description']) ?>
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