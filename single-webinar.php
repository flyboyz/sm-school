<?php

get_header();
$event_date = get_field( 'event_date', 'post_' . $post->ID );
?>
	<div class="container container_fixed event-date-box">
		<div
			class="event-date"><?= $event_date ? wp_maybe_decline_date( $event_date ) : get_field( 'event_date_label' ) ?></div>
	</div>
<?php
the_content();

get_template_part( 'template-parts/section/co-authors' );
get_template_part( 'template-parts/section/feedback' );
get_template_part( 'template-parts/section/faq' );

get_footer();
