<?php

$packages = get_field('packages');
if (!empty($packages)):
    ?>
    <div class="section section_course-packages">
        <?php
        foreach ($packages as $package):
            if ($package['is_active']):
                $emdesell_link = $package['emdesell_link'];
                $cost = get_cost($package['cost']);
                ?>
                <div>
                    <img src="<?= $package['icon']['sizes']['thumbnail'] ?>" alt="icon">
                    <h3 class="name">Пакет <br>"<?= $package['name'] ?>"</h3>
                    <div class="description"><?= $package['description'] ?></div>
                    <div class="cost"><?= $cost ?></div>
                    <?php
                    if ($emdesell_link):
                        get_template_part('template-parts/form', 'pay', [
                            'link' => 'https://sm.emdesell.ru/buy/' . $emdesell_link,
                            'cost' => $cost,
                        ]);
                        ?>
                        <a data-fancybox data-src="#EmdesellModal" data-options='{"touch" : false}'
                           href="javascript:;" class="button button_lighting">Купить</a>
                    <?php
                    else:
                        get_template_part('template-parts/form', 'sign-up');
                        ?>
                        <a data-fancybox data-src="#SignUpModal" data-options='{"touch" : false}'
                           href="javascript:;" class="button button_lighting">Записаться</a>
                    <?php
                    endif; ?>
                </div>
            <?php
            endif;
        endforeach;
        ?>
    </div>
<?php
endif;