<?php

$packages = get_field('packages');
if (!empty($packages)):
    ?>
    <div class="section section_course-packages">
        <?php
        foreach ($packages as $package):
            if ($package['is_active']):
                $package_type = $package['type'];
                $cost = get_cost($package['cost']);

                $hash = wp_generate_password(4, false);
                $hash_for_details = "$hash-details";

                $package['hash'] = $hash;
                ?>
                <div>
                    <img src="<?= $package['icon']['sizes']['thumbnail'] ?>" alt="icon" class="package-icon">
                    <h3 class="name">Пакет <br>"<?= $package['name'] ?>"</h3>
                    <div class="description">
                        <?= $package['short_description'] ?>
                        <div class="more">
                            <a data-fancybox data-src="#package-<?= $hash_for_details ?>" data-options='{"touch" : false}'
                               href="javascript:;">узнать подробнее...</a>
                        </div>
                    </div>
                    <div class="cost"><?= $cost ?></div>
                    <a data-fancybox data-src="#Modal<?= $hash ?>" data-options='{"touch" : false}'
                       href="javascript:;"
                       class="button button_lighting"><?= $package_type === 'sign' ? 'Записаться' : 'Купить' ?></a>
                    <?php
                    if ($package_type !== 'sign'):
                        ?>
                        <img src="<?= get_template_directory_uri() ?>/images/icons/cards.png" alt="card" class="cards">
                    <?php
                    endif;
                    ?>
                </div>
                <div class="container container_l modal modal_light modal_package"
                     id="package-<?= $hash_for_details ?>"
                     style="display: none;">
                    <div class="name">Пакет "<?= $package['name'] ?>"</div>
                    <div class="description">
                        <?= $package['description'] ?>
                    </div>
                </div>
                <?php
                get_template_part('template-parts/form/' . $package_type, '', $package);
            endif;
        endforeach;
        ?>
    </div>
<?php
endif;
