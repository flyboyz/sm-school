<div id="Modal_<?= $args['key'] ?>" class="modal modal_fixed-width modal_lighting" style="display: none;">
    <div class="wpforms-container updated-form">
        <form action="https://sm.emdesell.ru/buy/<?= $args['type_group']['emdesell_link'] ?>"
              class="wpforms-form sendpulse-form"
              method="post" data-double-opt-in="0" data-form-submit>
            <input type="hidden" name="action" value="add_to_address_book">
            <input type="hidden" name="book_id" value="<?= $args['type_group']['list_address_books'] ?>">
            <input type="hidden" name="event_type" value="Покупка">
            <input type="hidden" name="event_name" value="<?= $post->post_title ?>">
            <input type="hidden" name="pay" value="1">
            <?php
            if (get_post_type() === 'webinar'): ?>
                <input type="hidden" name="date_mk"
                       value="<?= wp_maybe_decline_date(get_field('event_date',
                           'post_' . $post->ID)); ?>">
            <?php
            endif; ?>
            <?= do_shortcode('[utm_inputs]') ?>
            <div class="wpforms-field">
                <input class="wpforms-field-medium wpforms-field-required" type="text" name="name" placeholder="Имя"
                       required>
            </div>
            <div class="wpforms-field">
                <input class="wpforms-field-medium wpforms-field-required" type="email" name="email" placeholder="Email"
                       required>
            </div>
            <div class="modal__cost">
                <span>Стоимость:</span>
                <span><?= $args['cost'] ?></span>
            </div>
            <button type="submit" class="button button_lighting">Оплатить</button>
        </form>
        <div class="modal__sub">
            Отправляя заявку, вы принимаете условия
            <a href="/offer/" target="_blank">договора-оферты</a>
            и даете согласие на обработку своих персональных данных в соответствии с
            <a href="https://sm.emdesell.ru/get-privacy-policy" target="_blank">политикой конфиденциальности</a>.
        </div>
    </div>
</div>