<?php

defined( 'ABSPATH' ) or exit;

add_filter( 'ema4wp_form_data', 'ema4wp_add_name_data', 60 );
add_filter( 'ema4wp_integration_data', 'ema4wp_add_name_data', 60 );

add_filter( 'mctb_data', '_ema4wp_update_groupings_data', PHP_INT_MAX - 1 );
add_filter( 'ema4wp_form_data', '_ema4wp_update_groupings_data', PHP_INT_MAX - 1 );
add_filter( 'ema4wp_integration_data', '_ema4wp_update_groupings_data', PHP_INT_MAX - 1 );
add_filter( 'zozoema_sync_user_data', '_ema4wp_update_groupings_data', PHP_INT_MAX - 1 );
add_filter( 'ema4wp_use_sslverify', '_ema4wp_use_sslverify', 1 );
