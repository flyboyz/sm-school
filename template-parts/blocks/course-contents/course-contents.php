<?php

/**
 * Course Contents Block Template.
 *
 * @param array $block The block settings and attributes.
 */

global $post;
$post_author_ID = (int) $post->post_author;

$className = '';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}

$contents = get_field( 'contents' );
?>
<div class="section course-contents <?php
echo esc_attr( $className ); ?>">
	<div class="container container_fixed container_full-width_m-less">
		<h2 class="has-text-align-center">Содержание</h2>
		<?php
		if ( ! is_admin() ): ?>
			<div class="swiper-container contents-list">
				<div class="swiper-wrapper">
					<?php foreach ( $contents as $content ):
						$authors = $content['info']['authors'];

						if ( empty( $authors ) ) {
							$authors[] = $post_author_ID;
						}
						?>
						<div class="contents-list__item swiper-slide">
							<span><?= $content['title'] ?></span>
							<?= apply_filters( 'the_content', $content['text'] ) ?>
							<div class="info">
								<div class="time">
									<?= file_get_contents( get_template_directory() . '/images/icons/clock.svg' ) ?>
									<?= $content['info']['time'] ?>
								</div>
								<div class="authors">
									<?php
									foreach ( $authors as $author_ID ) {
										echo wp_get_attachment_image( get_fields( "user_$author_ID" )['avatar'] );
                                    } ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <?php
            $sendpulse = get_field('sendpulse');

            if ($sendpulse && $sendpulse['list_address_books'] != 0):
                $form_key = wp_generate_password(6, false);
                ?>
                <div class="text-center" style="margin-top: 30px">
                    <a data-fancybox data-src="#Modal_<?= $form_key ?>"
                       data-options='{"touch" : false}'
                       href="javascript:;"
                       class="button button_lighting">Записаться</a>
                </div>
                <?php
                get_template_part('template-parts/form/sendpulse', '', [
                    'key'                => $form_key,
					'list_address_books' => $sendpulse['list_address_books'],
					'reach_goal'         => $sendpulse['reach_goal'],
				] );
			endif;
		else: ?>
			Кол-во уроков - <?= count( $contents ) ?>
		<?php
		endif; ?>
	</div>
</div>