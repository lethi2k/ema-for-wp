<?php

ema4wp_register_integration( 'wpforms', 'EMA4WP_WPForms_Integration', true );

function _ema4wp_wpforms_register_field() {
	if ( ! class_exists( 'WPForms_Field' ) ) {
		return;
	}

	new EMA4WP_WPForms_Field();
}

add_action( 'init', '_ema4wp_wpforms_register_field' );
