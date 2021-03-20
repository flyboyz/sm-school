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
                ?>
                <div>
                    <img src="<?= $package['icon']['sizes']['thumbnail'] ?>" alt="icon">
                    <h3 class="name">Пакет <br>"<?= $package['name'] ?>"</h3>
                    <div class="description"><?= $package['description'] ?></div>
                    <div class="cost"><?= $cost ?></div>
                    <a data-fancybox data-src="#<?= $package_type ?>Modal" data-options='{"touch" : false}'
                       href="javascript:;"
                       class="button button_lighting"><?= $package_type === 'sign' ? 'Записаться' : 'Купить' ?></a>
                </div>
                <?php
                get_template_part('template-parts/form/' . $package_type, '', $package);
            endif;
        endforeach;
        ?>
    </div>
<?php
endif;
