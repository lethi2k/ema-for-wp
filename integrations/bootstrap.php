<?php

/**
 * Try to include a file before each integration's settings page
 *
 * @param EMA4WP_Integration $integration
 * @param array $opts
 * @ignore
 */
function ema4wp_admin_before_integration_settings( EMA4WP_Integration $integration, $opts ) {
	$file = __DIR__ . sprintf( '/%s/admin-before.php', $integration->slug );

	if ( file_exists( $file ) ) {
		include $file;
	}
}

/**
 * Try to include a file before each integration's settings page
 *
 * @param EMA4WP_Integration $integration
 * @param array $opts
 * @ignore
 */
function ema4wp_admin_after_integration_settings( EMA4WP_Integration $integration, $opts ) {
	$file = __DIR__ . sprintf( '/%s/admin-after.php', $integration->slug );

	if ( file_exists( $file ) ) {
		include $file;
	}
}

add_action( 'ema4wp_admin_before_integration_settings', 'ema4wp_admin_before_integration_settings', 30, 2 );
add_action( 'ema4wp_admin_after_integration_settings', 'ema4wp_admin_after_integration_settings', 30, 2 );

// Register core integrations
ema4wp_register_integration( 'ninja-forms-2', 'EMA4WP_Ninja_Forms_V2_Integration', true );
ema4wp_register_integration( 'wp-comment-form', 'EMA4WP_Comment_Form_Integration' );
ema4wp_register_integration( 'wp-registration-form', 'EMA4WP_Registration_Form_Integration' );
ema4wp_register_integration( 'buddypress', 'EMA4WP_BuddyPress_Integration' );
ema4wp_register_integration( 'woocommerce', 'EMA4WP_WooCommerce_Integration' );
ema4wp_register_integration( 'easy-digital-downloads', 'EMA4WP_Easy_Digital_Downloads_Integration' );
ema4wp_register_integration( 'contact-form-7', 'EMA4WP_Contact_Form_7_Integration', true );
ema4wp_register_integration( 'events-manager', 'EMA4WP_Events_Manager_Integration' );
ema4wp_register_integration( 'memberpress', 'EMA4WP_MemberPress_Integration' );
ema4wp_register_integration( 'affiliatewp', 'EMA4WP_AffiliateWP_Integration' );
ema4wp_register_integration( 'give', 'EMA4WP_Give_Integration' );


ema4wp_register_integration( 'custom', 'EMA4WP_Custom_Integration', true );
$dir = __DIR__;
require $dir . '/ninja-forms/bootstrap.php';
require $dir . '/wpforms/bootstrap.php';
require $dir . '/gravity-forms/bootstrap.php';


