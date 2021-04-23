<div id="sendpulse-<?= $args['id'] ?>" class="modal modal_fixed-width modal_lighting" style="display: none;">
    <div class="wpforms-container updated-form">
        <form action="" method="post" class="wpforms-form sendpulse-form" data-double-opt-in="0">
            <input type="hidden" name="action" value="add_to_address_book">
            <input type="hidden" name="book_id" value="<?= $args['book_id'] ?>">
            <input type="hidden" name="event_type" value="Регистрация на тренинг">
            <input type="hidden" name="event_name" value="<?= $post->post_title ?>">
            <input type="hidden" name="pay" value="0">
            <input type="hidden" name="date_mk"
                   value="<?= wp_maybe_decline_date(get_field('event_date',
                       'post_' . $post->ID)); ?>">
            <?= do_shortcode('[utm_inputs]') ?>
            <div class="wpforms-field">
                <input type="email" name="email" class="wpforms-field-medium" placeholder="Email" required>
            </div>
            <button type="submit" class="button button_lighting">Записаться</button>
        </form>
        <div class="modal__sub">
            Отправляя заявку, вы принимаете условия
            <a href="/offer/" target="_blank">договора-оферты</a>
            и даете согласие на обработку своих персональных данных в соответствии с
            <a href="https://sm.emdesell.ru/get-privacy-policy" target="_blank">политикой конфиденциальности</a>.
        </div>
    </div>
</div>