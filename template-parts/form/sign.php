<div id="Modal<?= $args['hash'] ?>" class="modal modal_fixed-width modal_lighting" style="display: none;">
    <?= do_shortcode('[wpforms id="' . $args['form']->ID . '"]') ?>
    <div class="modal__sub">
        Отправляя заявку, вы принимаете условия
        <a href="offer.html" target="_blank">договора-оферты</a>
        и даете согласие на обработку своих персональных данных в соответствии с
        <a href="https://sm.emdesell.ru/get-privacy-policy" target="_blank">политикой конфиденциальности</a>.
    </div>
</div>