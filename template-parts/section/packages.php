<?php

$packages = get_field('packages');
if (!empty($packages)):
    ?>
    <div class="section section_course-packages">
        <?php
        foreach ($packages as $package_key => $package):
            if ($package['is_active']):
                $package_type = $package['type'];
                $package_cost = get_cost($package['cost'] ?: 0);

                $details_key = "$package_key-details";

                $package['key'] = $package_key;

                ?>
                <div>
                    <?php if ($package['icon']): ?>
                        <img src="<?= $package['icon']['sizes']['thumbnail'] ?>" alt="icon" class="package-icon">
                    <?php
                    endif; ?>
                    <h3 class="name">Пакет <br>"<?= $package['name'] ?>"</h3>
                    <div class="description">
                        <?= $package['short_description'] ?>
                        <div class="more">
                            <a data-fancybox data-src="#package-<?= $details_key ?>" data-options='{"touch" : false}'
                               href="javascript:;">узнать подробнее...</a>
                        </div>
                    </div>
                    <div class="cost"><?= $package_cost ?></div>
                    <a data-fancybox data-src="#Modal<?= $package_key ?>" data-options='{"touch" : false}'
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
                     id="package-<?= $details_key ?>"
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
