<div id="Modal_<?= $args['key'] ?>" class="modal modal_fixed-width modal_lighting" style="display: none;">
	<div class="wpforms-container updated-form">
		<form action="" method="post" class="wpforms-form sendpulse-form" data-double-opt-in="0" data-form-submit
		      data-reach-goal="<?= $args['reach_goal'] ?>">
			<input type="hidden" name="action" value="add_to_address_book">
			<input type="hidden" name="book_id" value="<?= $args['list_address_books'] ?>">
			<input type="hidden" name="event_type" value="Регистрация">
			<input type="hidden" name="event_name" value="<?= $post->post_title ?>">
			<?php
			if ( get_post_type() === 'webinar' ): ?>
				<input type="hidden" name="date_mk"
				       value="<?= wp_maybe_decline_date( get_field( 'event_date',
					       'post_' . $post->ID ) ); ?>">
			<?php
			endif; ?>
			<?= do_shortcode( '[utm_inputs]' ) ?>
			<div class="wpforms-field">
				<input type="text" name="name" class="wpforms-field-large" placeholder="Имя" required>
			</div>
			<div class="wpforms-field">
				<input type="email" name="email" class="wpforms-field-large" placeholder="Email" required>
			</div>
			<button type="submit" class="button button_lighting">Записаться</button>
		</form>
		<div class="modal__sub">
			Отправляя заявку, вы даете согласие на обработку своих персональных данных в соответствии с
			<a href="/policy/" target="_blank">политикой конфиденциальности</a>.
		</div>
	</div>
</div>