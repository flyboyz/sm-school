<?php

use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\SessionStorage;

/**
 * @throws Exception
 */
function acf_load_list_address_books( $field ) {
	$SPApiClient = new ApiClient( API_USER_ID, API_SECRET, new SessionStorage() );
	$list        = $SPApiClient->listAddressBooks();

	$field['choices'] = [
		'0' => '-- Не отображать кнопку --',
	];

	if ( is_array( $list ) ) {
		foreach ( $list as $book ) {
			if ( $book->status === 0 ) {
				$field['choices'][ $book->id ] = $book->name;
			}
		}
	}

	return $field;
}

add_filter( 'acf/prepare_field/name=list_address_books', 'acf_load_list_address_books' );


/**
 * @throws Exception
 */
function add_to_address_book() {
	$book_id = (int) $_POST['book_id'];
	$email   = (string) $_POST['email'];

	$acceptedVariablesKeys = [
		'name',         // Имя пользователя
		'web',          // Время мероприятия | 20:00 -> 20
		'pay',          // Оплата, по умолчанию - 0
		'date_mk',      // Дата мероприятия | 15 ноября в 15:00
		'event_type',   // Тип мероприятия
		'event_name',   // Название мероприятия
		'promo_code',   // Промокод
		'utm_source',
		'utm_campaign',
		'utm_medium',
		'utm_content',
		'utm_term',
	];

	if ( is_null( $email ) || is_null( $book_id ) ) {
		header( 'HTTP/1.0 403 Forbidden' );
		echo 'You are forbidden!';
		exit();
	}

	$dateTime    = new DateTime( null, new DateTimeZone( '+0300' ) );
	$SPApiClient = new ApiClient( API_USER_ID, API_SECRET, new SessionStorage() );

	$variables = array(
		'date' => $dateTime->format( 'Y-m-d' ),
		'time' => (int) $dateTime->format( 'Hi' ),
	);

	// Добавление разрешенных переменных
	foreach ( $_POST as $key => $value ) {
		if ( in_array( $key, $acceptedVariablesKeys ) ) {
			// Заполнение стандартного поля SendPulse
			if ( $key === 'name' ) {
				$key = 'имя';
			}

			$variables[ $key ] = $value;
		}
	}

	$result = $SPApiClient->addEmails( $book_id, [
		[
			'email'     => $email,
			'variables' => $variables
		]
	], array() );

	echo json_encode( $result );
	wp_die();
}

add_action( 'wp_ajax_add_to_address_book', 'add_to_address_book' );
add_action( 'wp_ajax_nopriv_add_to_address_book', 'add_to_address_book' );