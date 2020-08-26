<?php
return array(
	'subscribed'             => array(
		'type' => 'success',
		'text' => esc_html__( 'Thank you, your sign-up request was successful! Please check your email inbox to confirm.', 'zozoema-for-wp' ),
	),
	'updated'                => array(
		'type' => 'success',
		'text' => esc_html__( 'Thank you, your records have been updated!', 'zozoema-for-wp' ),
	),
	'unsubscribed'           => array(
		'type' => 'success',
		'text' => esc_html__( 'You were successfully unsubscribed.', 'zozoema-for-wp' ),
	),
	'not_subscribed'         => array(
		'type' => 'notice',
		'text' => esc_html__( 'Given email address is not subscribed.', 'zozoema-for-wp' ),
	),
	'error'                  => array(
		'type' => 'error',
		'text' => esc_html__( 'Oops. Something went wrong. Please try again later.', 'zozoema-for-wp' ),
	),
	'invalid_email'          => array(
		'type' => 'error',
		'text' => esc_html__( 'Please provide a valid email address.', 'zozoema-for-wp' ),
	),
	'already_subscribed'     => array(
		'type' => 'notice',
		'text' => esc_html__( 'Given email address is already subscribed, thank you!', 'zozoema-for-wp' ),
	),
	'required_field_missing' => array(
		'type' => 'error',
		'text' => esc_html__( 'Please fill in the required fields.', 'zozoema-for-wp' ),
	),
	'no_lists_selected'      => array(
		'type' => 'error',
		'text' => esc_html__( 'Please select at least one list.', 'zozoema-for-wp' ),
	),
);
