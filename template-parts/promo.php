<div class='promo'>
	<div class="container container_fixed">
		<span><?= file_get_contents( get_template_directory() . '/images/icons/clock.svg' ) ?>
			<?php do_action( 'promo_time_left' ); ?></span>
		<span>Предложение действительно до <b><?php do_action( 'promo_start_date' ); ?></b></span>
	</div>
</div>