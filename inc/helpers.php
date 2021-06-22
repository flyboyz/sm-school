<?php

/**
 * Wrapper for wp_redirect
 *
 * @param $url
 */
function _redirect( $url ) {
	wp_redirect( $url );
	exit;
}


function get_section( $args ) {
	ob_start();
	get_template_part( 'template-parts/section/' . $args['name'], '' );

	return ob_get_clean();
}

add_shortcode( 'section', 'get_section' );


function get_the_first_category( $emptyLabel = '' ) {
	return ! empty( get_the_category() ) ? get_the_category()[0]->cat_name : $emptyLabel;
}


function page_content_only( $template ) {
	if ( ! isset( $_GET['content_only'] ) ) {
		return $template;
	}

	wp_head();
	echo '<div class="content">';
	the_title( '<h1>', '</h1>' );
	the_content();

	return true;
}

add_filter( 'template_include', 'page_content_only', 99 );


function get_cost( $value ): string {
	if ( ! $value ) {
		return 'бесплатно';
	}

	return number_format( $value, 0, ',', ' ' ) . ' &#8381;';
}


function wrap_surname( $name ) {
	return substr_replace( $name, ' <span>', strpos( $name, ' ' ),
			1 ) . '</span>';
}

add_filter( 'wrap_surname', 'wrap_surname', 10, 1 );


function utm_inputs() {
	$utm_tags = [
		'utm_source',
		'utm_medium',
		'utm_campaign',
		'utm_content',
		'utm_term',
	];

	$html = '';
	foreach ( $utm_tags as $utm_tag ) {
		if ( isset( $_GET[ $utm_tag ] ) ) {
			$html .= "<input type='hidden' name='$utm_tag' value='$_GET[$utm_tag]'>\n";
		}
	}

	return $html;
}

add_shortcode( 'utm_inputs', 'utm_inputs' );


function get_social_link( $social_name ) {
	$post_link  = urlencode( get_the_permalink() );
	$post_title = get_the_title();

	$share_links = [
		'vk'       => "https://vk.com/share.php?url=$post_link",
		'facebook' => "https://www.facebook.com/sharer/sharer.php?u=$post_link",
		'twitter'  => "https://twitter.com/intent/tweet?url=$post_link&text=$post_title",
		'ok'       => "https://connect.ok.ru/offer?url=$post_link&title=$post_title&imageUrl=" . get_the_post_thumbnail_url( 'large' ),
		'linkedin' => "https://www.linkedin.com/shareArticle?mini=true&url=$post_link&title=$post_title&source=LinkedIn",
	];

	return $share_links[ $social_name ];
}