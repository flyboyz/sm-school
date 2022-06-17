<?php

namespace sm;

use DateTime;
use WP_REST_Response;

class Promo {

	var int $id;
	var int $post_id;
	var string $promo_code;
	var string $promo_email;
	var DateTime $end_date;

	public static function init() {
		global $promo;

		$promo = new Promo();
	}

	public function __construct() {
		self::init_hooks();
		self::add_option_page();
	}

	function self_init() {
        if (isset($_REQUEST['promo'])) {
            $promo = $this->get_active_promo( get_the_ID(), $_REQUEST['promo'],
                $_REQUEST['promo_email'] );

            if ( $promo ) {
                $this->post_id     = (int) $promo['post_id'];
                $this->promo_code  = $promo['promo_code'];
                $this->promo_email = $promo['promo_email'];
                $this->end_date    = new DateTime( $promo['end_date'] );
            }
        }
	}

	/**
	 * Initialize shortcodes, actions and filters
	 */
	private function init_hooks() {
		add_action( 'header_banner', [ $this, 'self_init' ], 5 );
		add_action( 'header_banner', [ $this, 'generate_promo_banner' ], 10 );

		add_action( 'promo_end_date', [ $this, 'get_promo_end_date' ], 10 );
		add_action( 'promo_time_left', [ $this, 'get_promo_time_left' ], 10 );

		add_action( 'create_table', [ $this, 'create_table' ] );
		add_action( 'rest_api_init', function () {
			register_rest_route( 'sm/v1', '/promo', [
				'methods'  => 'POST',
				'callback' => [ $this, 'api_add_promo' ],
			] );
		} );

		add_filter( 'promo_cost', [ $this, 'promo_cost' ] );
		add_shortcode( 'promo_inputs', [ $this, 'gen_inputs' ] );
	}

	/**
	 * Add ACF option page
	 */
	private function add_option_page() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( [
				'page_title'  => __( 'Промокоды' ),
				'menu_title'  => __( 'Управление промокодами' ),
				'menu_slug'   => 'promo',
				'parent_slug' => 'tools.php',
				'icon_url'    => 'dashicons-tickets',
			] );
		}
	}

	public function api_add_promo(): WP_REST_Response {
		$data        = json_decode( file_get_contents( 'php://input' ), true );
		$title       = explode( '_', $data['title'] );
		$promo_email = $data['email'];

		$post_id    = (int) $title[0];
		$promo_code = $title[1];
		$days       = $title[2] ?? 3;

		$end_date = new DateTime( current_time( 'Y-m-d H:i:s' ) );

		$end_date->modify( "+$days day" );
		$end_date = $end_date->format( 'Y-m-d H:i:s' );

		if ( $promo = $this->get_promo( $post_id, $promo_code,
			$promo_email ) ) {
			$this->update_promo( $promo['id'], $end_date );
		} else {
			$this->add_promo( $post_id, $promo_code, $promo_email,
				$end_date );
		}

		return new WP_REST_Response( [
			'code' => SENDPULSE_RESPONSE_CODE,
		], 200 );
	}

	/**
	 * Update Promo
	 */
	function update_promo( $id, $end_date ): bool {
		return update_row( 'active_promocodes', $id,
			[ 'end_date' => $end_date ], 'option' );
	}

	/**
	 * Add Promo
	 */
	function add_promo( $post_id, $promo_code, $promo_email, $end_date ) {
		return add_row( 'active_promocodes',
			[
				'post_id'     => $post_id,
				'promo_code'  => $promo_code,
				'promo_email' => mb_strtolower( $promo_email ),
				'end_date'    => $end_date,
			], 'option' );
	}

	/**
	 * Shortcode for generate big leaderboard table
	 */
	public function generate_promo_banner() {
		if ( isset($_REQUEST['promo']) && $this->get_active_promo( get_the_ID(), $_REQUEST['promo'],
			$_REQUEST['promo_email'] ) ) {
			return get_template_part( 'template-parts/section/promo' );
		}

		return false;
	}

	public function get_promo( $post_id, $promo_code, $promo_email ) {
		$db_promocodes = get_field( 'active_promocodes', 'option' );

		foreach ( $db_promocodes as $id => $db_promo_code ) {
			if ( $db_promo_code['post_id'] === $post_id
			     && $db_promo_code['promo_code'] === $promo_code ) {
				if ( isset( $promo_email ) && mb_strtolower( $db_promo_code['promo_email'] ) === mb_strtolower( $promo_email ) ) {
					return array_merge( $db_promo_code, [ 'id' => $id + 1 ] );
				} elseif ( ! $db_promo_code['promo_email'] ) {
					return array_merge( $db_promo_code, [ 'id' => $id + 1 ] );
				}
			}
		}

		return false;
	}

	public function get_active_promo( $post_id, $promo_code, $promo_email ) {
		$promo = $this->get_promo( $post_id, $promo_code, $promo_email );

		$now      = new DateTime( current_time( 'Y-m-d H:i:s' ) );
		$end_date = new DateTime( $promo['end_date'] );

		if ( ! $now->diff( $end_date )->invert ) {
			return $promo;
		}

		return false;
	}

	function get_promo_end_date() {
		echo $this->end_date->format( 'd.m.Y H:i' );
	}

	function get_promo_time_left() {
		$now = new DateTime( current_time( 'Y-m-d H:i:s' ) );

		// -2 - поправка на отрисовку и запуск таймера
		$left = $this->end_date->getTimestamp() - $now->getTimestamp() - 2;

		if ( $left > 0 ) {
			echo '<div id="PromoTimer" data-timer="' . $left . '"></div>';
		}
	}

	function promo_cost( $package ) {
		$cost = apply_filters( 'get_cost', $package['cost'] );

		if ( isset($_REQUEST['promo']) && $this->get_active_promo( get_the_ID(),
				$_REQUEST['promo'],
				$_REQUEST['promo_email'] ) && $package['cost_promo'] ) {
			return "<div class='price-old'>" . $cost . "</div>" . apply_filters( 'get_cost',
					$package['cost_promo'] );
		}

		return $cost;
	}

	function gen_inputs() {
		if ( $this->is_active() && isset( $_REQUEST['promo'] ) ) {
			return "<input type='hidden' name='promo_code' value='{$_REQUEST['promo']}'>\n";
		}

		return false;
	}

	function is_active(): bool {
		return ! ! (array) $this;
	}

}

add_action( 'init', [ 'sm\Promo', 'init' ] );
