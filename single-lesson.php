<?php

get_header();
if (isset($promo) && ! $promo->is_active()) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    get_template_part(404);
    exit();
}
?>
    <div class="container container_fixed video-full-width">
        <h1><?php
            the_title() ?> </h1>
        <?php
        the_content();

        $sendpulse = get_field('sendpulse');

        if ($sendpulse && $sendpulse['list_address_books'] != 0):
            $form_key = wp_generate_password(6, false);
            ?>
            <div class="text-center" style="margin-top: 30px">
                <a data-fancybox data-src="#Modal_<?= $form_key ?>"
                   data-options='{"touch" : false}'
                   href="javascript:;"
                   class="button button_lighting"><?= $sendpulse['settings']['button_text'] ?></a>
            </div>
            <?php
            get_template_part('template-parts/form/sendpulse', '', [
                'key'                => $form_key,
                'list_address_books' => $sendpulse['list_address_books'],
                'reach_goal'         => $sendpulse['reach_goal'],
                'submit_text'        => $sendpulse['settings']['submit_text'],
            ] );
        endif;
        ?>
    </div>
<?php
get_footer();