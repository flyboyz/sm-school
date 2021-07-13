<?php

namespace sm;

use DateTime;
use WP_REST_Response;

class Promo {
	var int $post_id;
	var string $promocode;
	var DateTime $start_date;
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
		$promo = $this->get_promo();

		if ( $promo ) {
			$this->post_id    = $promo->id;
			$this->promocode  = $promo->promocode;
			$this->start_date = new DateTime( $promo->start_date );
			$this->end_date   = new DateTime( $promo->end_date );
		}
	}

	/**
	 * Initialize shortcodes, actions and filters
	 */
	private function init_hooks() {
		add_action( 'header_banner', array( $this, 'self_init' ), 5 );
		add_action( 'header_banner', array( $this, 'generate_promo_banner' ), 10 );

		add_action( 'promo_start_date', array( $this, 'get_promo_start_date' ), 10 );
		add_action( 'promo_time_left', array( $this, 'get_promo_time_left' ), 10 );

		add_action( 'create_table', array( $this, 'create_table' ) );
		add_action( 'rest_api_init', function () {
			register_rest_route( 'sm/v1', '/promo', [
				'methods'  => 'POST',
				'callback' => array( $this, 'api_add_promo' ),
			] );
		} );

		add_filter( 'promo_cost', array( $this, 'promo_cost' ) );
	}

	/**
	 * Run this to create main table
	 */
	function create_table() {
		global $wpdb;

		$table_name      = "{$wpdb->prefix}sm_promo";
		$charset_collate = $wpdb->get_charset_collate();
		$sql             = "CREATE TABLE $table_name (
          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
          `post_id` INT NOT NULL,
          `promocode` VARCHAR(100) NOT NULL,
          `start_date` DATETIME NOT NULL,
          `end_date` DATETIME NOT NULL,
          PRIMARY KEY (`id`)
        ) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	/**
	 * Add ACF option page
	 */
	private function add_option_page() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_sub_page( array(
				'page_title'  => 'Leaderboards Settings',
				'menu_title'  => 'Leaderboards',
				'parent_slug' => 'theme-settings',
			) );
		}
	}

	public function api_add_promo() {
		$post_id   = $_GET['post_id'];
		$promocode = $_GET['promocode'];
		$days      = $_GET['days'] ?? 3;

		$start_date = new DateTime();
		$end_date   = new DateTime();

		$start_date = $start_date->format( 'Y-m-d H:i:s' );
		$end_date->modify( "+$days day" );
		$end_date = $end_date->format( 'Y-m-d H:i:s' );

		if ( $id = $this->check_promo( $post_id, $promocode ) ) {
			$promo = $this->update_promo( $id, $start_date, $end_date );
		} else {
			$promo = $this->add_promo( $post_id, $promocode, $start_date, $end_date );
		}

		return new WP_REST_Response( array(
			'data'    => $promo,
			'success' => true,
		), 200 );
	}

	/**
	 * Check Promo
	 */
	function check_promo( $post_id, $promocode ) {
		global $wpdb;

		return $wpdb->get_var( $wpdb->prepare(
				"SELECT id FROM {$wpdb->prefix}sm_promo WHERE post_id = %d AND promocode = %s",
				array( $post_id, $promocode )
			) ) ?? 0;
	}

	/**
	 * Update Promo
	 *
	 * @throws \Exception
	 */
	function update_promo( $id, $start_date, $end_date ) {
		global $wpdb;

		return $wpdb->update(
			"{$wpdb->prefix}sm_promo",
			array(
				'start_date' => $start_date,
				"end_date"   => $end_date,
			),
			array( 'id' => $id ),
			array( '%s', '%s' ),
			array( '%d' ),
		);
	}

	/**
	 * Add Promo
	 *
	 * @throws \Exception
	 */
	function add_promo( $post_id, $promocode, $start_date, $end_date ) {
		global $wpdb;

		return $wpdb->insert(
			"{$wpdb->prefix}sm_promo",
			array(
				'post_id'    => $post_id,
				'promocode'  => $promocode,
				'start_date' => $start_date,
				"end_date"   => $end_date,
			),
			array( '%d', '%s', '%s', '%s' )
		);
	}

	/**
	 * Shortcode for generate big leaderboard table
	 *
	 * @param $args
	 *
	 * @return string
	 */
	public function generate_promo_banner( $args ) {
		if ( $this->get_promo() ) {
			return get_template_part( 'template-parts/promo' );
		}

		return false;
	}

	public function get_promo() {
		global $post;

		if ( isset( $_GET['promo'] ) ) {
			return $this->get_actual_promo_from_db();
		}

		return false;
	}

	function get_actual_promo_from_db() {
		global $wpdb;
		global $post;

		return $wpdb->get_row( $wpdb->prepare(
			"SELECT * FROM {$wpdb->prefix}sm_promo WHERE post_id = %d AND promocode = %s AND end_date > NOW()",
			array( $post->ID, $_GET['promo'] )
		) );
	}

	function get_promo_start_date() {
		echo $this->end_date->format( 'd.m.Y H:i' );
	}

	function get_promo_time_left() {
		$now = new DateTime( current_time( 'Y-m-d H:i:s' ) );

		$left = $this->end_date->getTimestamp() - $now->getTimestamp();

		if ( $left > 0 ) {
			echo '<div id="PromoTimer" data-timer="' . $left . '"></div>';
		}
	}

	function promo_cost( $package ) {
		$cost = apply_filters( 'get_cost', $package['cost'] );

		if ( $this->get_promo() && $package['cost_promo'] ) {
			return "<div class='price-old'>" . $cost . "</div>" . apply_filters( 'get_cost', $package['cost_promo'] );
		}

		return $cost;
	}
}

add_action( 'init', array( 'sm\Promo', 'init' ) );
