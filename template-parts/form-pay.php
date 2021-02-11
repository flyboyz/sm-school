<div id="EmdesellModal" class="modal modal_fixed-width modal_lighting" style="display: none;">
    <div class="wpforms-container updated-form">
        <form class="wpforms-form" action="<?= $args['link'] ?>" method="POST">
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
            <a href="offer.html" target="_blank">договора-оферты</a>
            и даете согласие на обработку своих персональных данных в соответствии с
            <a href="https://sm.emdesell.ru/get-privacy-policy" target="_blank">политикой конфиденциальности</a>.
        </div>
    </div>
</div>