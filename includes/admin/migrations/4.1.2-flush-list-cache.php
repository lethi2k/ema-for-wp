<?php

defined( 'ABSPATH' ) or exit;

if ( function_exists( 'ema4wp_refresh_zozoema_lists' ) ) {
	ema4wp_refresh_zozoema_lists();
}

delete_transient( 'ema4wp_zozoema_lists_v3' );
delete_option( 'ema4wp_zozoema_lists_v3_fallback' );

wp_schedule_event( strtotime( 'tomorrow 3 am' ), 'daily', 'ema4wp_refresh_zozoema_lists' );
