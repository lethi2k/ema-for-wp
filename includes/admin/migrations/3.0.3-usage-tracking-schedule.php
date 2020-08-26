<?php
defined( 'ABSPATH' ) or exit;

$options = (array) get_option( 'ema4wp', array() );
if ( empty( $options['allow_usage_tracking'] ) ) {
	return;
}

// usage tracking is enabled, reschedule it so it uses new cron schedule.

// make sure 'monthly' cron schedule is registered
/**
 * @ignore
 */
function _ema4wp_303_add_monthly_cron_schedule( $schedules ) {
	$schedules['monthly'] = array(
		'interval' => 30 * DAY_IN_SECONDS,
		'display'  => 'Once a month',
	);

	return $schedules;
}

add_filter( 'cron_schedules', '_ema4wp_303_add_monthly_cron_schedule', 1 );

// reschedule usage tracking event
wp_clear_scheduled_hook( 'ema4wp_usage_tracking' );
wp_schedule_event( time(), 'monthly', 'ema4wp_usage_tracking' );
