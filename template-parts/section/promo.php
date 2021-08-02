<?php

$text = 'lesson' === get_post_type() ? 'Урок доступен до ' : 'Спеццена доступна до ';
?>
<div class='promo'>
    <div class="container container_fixed">
		<span><?= file_get_contents( get_template_directory() . '/images/icons/clock.svg' ) ?>
			Осталось <?php
			do_action( 'promo_time_left' ); ?></span>
        <span>
            <?php
            echo $text; ?>
            <b><?php
	            do_action( 'promo_end_date' ); ?></b>
        </span>
    </div>
</div>