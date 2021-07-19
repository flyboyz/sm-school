<?php

get_header();
if ( isset( $promo ) && ! $promo->is_active() ) {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 );
	exit();
}
?>
	<div class="container container_fixed">
		<h1><?php
			the_title() ?> </h1>
		<div class="ratio ratio_16x9 video-hack">
			<div class="ratio__content">
				<iframe
					src="https://www.youtube.com/embed/<?php echo get_field( 'youtube_id' ) ?>?controls=0&rel=0&showinfo=0&vq=hd720"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;"
					frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
		<?php the_content(); ?>
	</div>
<?php
get_footer();