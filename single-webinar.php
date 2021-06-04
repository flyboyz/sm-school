<?php

get_header();
?>
    <div class="container container_fixed event-date-box">
        <div class="event-date"><?= wp_maybe_decline_date(get_field('event_date', 'post_' . $post->ID)) ?></div>
    </div>

<?php
the_content();

get_template_part('template-parts/section/co-authors');
get_template_part('template-parts/section/feedback');
get_template_part('template-parts/section/faq');

get_footer();
get_template_part( 'template-parts/section/chatra' );
