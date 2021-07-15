<?php

$packages = get_field( 'packages' );
if ( ! empty( $packages ) ):
	?>
	<div class="section section_course-packages">
		<div class="container container_fixed container_full-width_s-less">
			<div class="course-packages">
				<div class="swiper-wrapper">
					<?php
					foreach ( $packages as $package_key => $package ):
						if ( $package['is_active'] ):
							$package_type = $package['type_group']['type'];

							if ( has_filter( 'promo_cost' ) ) {
								$package_cost = apply_filters( 'promo_cost', $package );
							} else {
								$package_cost = apply_filters( 'get_cost', $package['cost'] );
							}

							$package_full_description = $package['description']['full'];

							$details_key = "$package_key-details";
							?>
							<div class="course-package swiper-slide">
								<?php
								if ( $package['icon'] ): ?>
									<img src="<?= $package['icon']['sizes']['thumbnail'] ?>" alt="icon"
									     class="package-icon">
								<?php
								endif; ?>
								<h3 class="name">Тариф <br><b>"<?= $package['name'] ?>"</b></h3>
								<div class="description">
									<?= $package['description']['short'] ?>
									<?php
									if ( $package_full_description ): ?>
										<div class="more">
											<a data-fancybox data-src="#package-<?= $details_key ?>"
											   data-options='{"touch" : false}'
											   href="javascript:;">узнать подробнее...</a>
										</div>
									<?php
									endif; ?>
								</div>
								<div class="cost"><?= $package_cost ?></div>
								<a data-fancybox data-src="#Modal_<?= $package_key ?>" data-options='{"touch" : false}'
								   href="javascript:;"
								   class="button button_lighting"><?= $package_type === 'sendpulse' ? 'Записаться' : 'Купить' ?></a>
								<?php
								if ( $package_type !== 'sendpulse' ):
									?>
									<img src="<?= get_template_directory_uri() ?>/images/icons/cards.png" alt="card"
									     class="cards">
								<?php
								endif;
								?>
							</div>
							<?php
							if ( $package_full_description ): ?>
								<div class="container container_l modal modal_light modal_package"
								     id="package-<?= $details_key ?>"
								     style="display: none;">
									<div class="name">Тариф "<?= $package['name'] ?>"</div>
									<div class="description">
										<?= $package['description']['full'] ?>
									</div>
								</div>
							<?php
							endif;
							get_template_part( "template-parts/form/$package_type", '', [
								'cost'               => $package_cost,
								'has_promo'          => ! ! $package['cost_promo'],
								'key'                => $package_key,
								'list_address_books' => $package['type_group']['list_address_books'],
								'reach_goal'         => $package['type_group']['reach_goal'],
								'emdesell_link'      => $package['type_group']['emdesell_link'],
							] );
						endif;
					endforeach;
					?>
				</div>
				<div class="swiper-button-prev">
					<img src="<?php echo get_template_directory_uri() ?>/images/icons/slider-arrow.svg"
					     alt="arrow-prev">
				</div>
				<div class="swiper-button-next">
					<img src="<?php echo get_template_directory_uri() ?>/images/icons/slider-arrow.svg"
					     alt="arrow-next">
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</div>
<?php
endif;
