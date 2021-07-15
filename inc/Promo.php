<?php

namespace sm;

use DateTime;
use WP_REST_Response;

class Promo {
	var int $id;
	var int $post_id;
	var string $promocode;
	var DateTime $end_date;

	public static function init() {
		$promo = __CLASS__;
		new $promo;
	}

	public function __construct() {
		self::init_hooks();
		self::add_option_page();
	}

	function self_init() {
		$promo = $this->get_active_promo( get_the_ID(), $_REQUEST['promo'] );

		if ( $promo ) {
			$this->post_id   = (int) $promo['post_id'];
			$this->promocode = $promo['promo_code'];
			$this->end_date  = new DateTime( $promo['end_date'] );
		}
	}

	/**
	 * Initialize shortcodes, actions and filters
	 */
	private function init_hooks() {
		add_action( 'header_banner', array( $this, 'self_init' ), 5 );
		add_action( 'header_banner', array( $this, 'generate_promo_banner' ), 10 );

		add_action( 'promo_end_date', array( $this, 'get_promo_end_date' ), 10 );
		add_action( 'promo_time_left', array( $this, 'get_promo_time_left' ), 10 );

		add_action( 'create_table', array( $this, 'create_table' ) );
		add_action( 'rest_api_init', function () {
			register_rest_route( 'sm/v1', '/promo', [
				'methods'  => 'POST',
				'callback' => array( $this, 'api_add_promo' ),
			] );
		} );

		add_filter( 'promo_cost', array( $this, 'promo_cost' ) );
		add_shortcode( 'promo_inputs', array( $this, 'gen_inputs' ) );
	}

	/**
	 * Add ACF option page
	 */
	private function add_option_page() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( array(
				'page_title'  => __( 'Промокоды' ),
				'menu_title'  => __( 'Управление промокодами' ),
				'menu_slug'   => 'promo',
				'parent_slug' => 'tools.php',
				'icon_url'    => 'dashicons-tickets',
			) );
		}
	}

	public function api_add_promo() {
		$post_id   = (int) $_REQUEST['post_id'];
		$promocode = $_REQUEST['promo'];
		$days      = $_REQUEST['days'] ?? 3;

		$end_date = new DateTime( current_time( 'Y-m-d H:i:s' ) );

		$end_date->modify( "+$days day" );
		$end_date = $end_date->format( 'Y-m-d H:i:s' );

		if ( $promo = $this->get_promo( $post_id, $promocode ) ) {
			$promo = $this->update_promo( $promo['id'], $end_date );
		} else {
			$promo = $this->add_promo( $post_id, $promocode, $end_date );
		}

		return new WP_REST_Response( array(
			'data'    => $promo,
			'success' => true,
		), 200 );
	}

	/**
	 * Update Promo
	 */
	function update_promo( $id, $end_date ): bool {
		return update_row( 'active_promocodes', $id, array( 'end_date' => $end_date ), 'option' );
	}

	/**
	 * Add Promo
	 */
	function add_promo( $post_id, $promocode, $end_date ) {
		return add_row( 'active_promocodes',
			array( 'post_id' => $post_id, 'promo_code' => $promocode, 'end_date' => $end_date ), 'option' );
	}

	/**
	 * Shortcode for generate big leaderboard table
	 *
	 * @param $args
	 *
	 * @return string
	 */
	public function generate_promo_banner( $args ) {
		if ( $this->get_active_promo( get_the_ID(), $_REQUEST['promo'] ) ) {
			return get_template_part( 'template-parts/section/promo' );
		}

		return false;
	}

	public function get_promo( $post_id, $promocode ) {
		$db_promocodes = get_field( 'active_promocodes', 'option' );

		foreach ( $db_promocodes as $id => $db_promocode ) {
			if ( $db_promocode['post_id'] === $post_id
			     && $db_promocode['promo_code'] === $promocode ) {

				return array_merge( $db_promocode, array( 'id' => $id + 1 ) );
			}
		}

		return false;
	}

	public function get_active_promo( $post_id, $promocode ) {
		$promo = $this->get_promo( $post_id, $promocode );

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
			echo '<div id="PromoTimer" data-timer="' . $left . '">Оставшееся время</div>';
		}
	}

	function promo_cost( $package ) {
		$cost = apply_filters( 'get_cost', $package['cost'] );

		if ( $this->get_active_promo( get_the_ID(), $_REQUEST['promo'] ) && $package['cost_promo'] ) {
			return "<div class='price-old'>" . $cost . "</div>" . apply_filters( 'get_cost', $package['cost_promo'] );
		}

		return $cost;
	}

	function gen_inputs() {
		if ( $this->is_active() && isset( $_REQUEST['promo'] ) ) {
			return "<input type='hidden' name='promo' value='{$_REQUEST['promo']}'>\n";
		}

		return false;
	}

	function is_active(): bool {
		return ! ! (array) $this;
	}
}

add_action( 'init', array( 'sm\Promo', 'init' ) );
