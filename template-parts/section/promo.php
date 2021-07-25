<div class='promo'>
    <div class="container container_fixed">
		<span><?= file_get_contents( get_template_directory() . '/images/icons/clock.svg' ) ?>
			Осталось <?php
			do_action( 'promo_time_left' ); ?></span>
        <span>Страница доступна до <b><?php
				do_action( 'promo_end_date' ); ?></b></span>
    </div>
</div>