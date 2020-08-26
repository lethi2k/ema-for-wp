<?php
/*
Plugin Name: EMA4WP: ZozoEMA for WordPress
Plugin URI: https://www.ema4wp.com/#utm_source=wp-plugin&utm_medium=zozoema-for-wp&utm_campaign=plugins-page
Description: ZozoEMA for WordPress by ibericode. Adds various highly effective sign-up methods to your site.
Version: 4.8
Author: ibericode
Author URI: https://ibericode.com/
Text Domain: zozoema-for-wp
Domain Path: /languages
License: GPL v3

ZozoEMA for WordPress
Copyright (C) 2012-2020, Danny van Kooten, hi@dannyvankooten.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Prevent direct file access
defined( 'ABSPATH' ) or exit;

/** @ignore */
function _ema4wp_load_plugin() {
	 global $ema4wp;

	// don't run if ZozoEMA for WP Pro 2.x is activated
	if ( defined( 'EMA4WP_VERSION' ) ) {
		return;
	}

	// don't run if PHP version is lower than 5.3
	if ( ! function_exists( 'array_replace' ) ) {
		return;
	}

	// bootstrap the core plugin
	define( 'EMA4WP_VERSION', '4.8' );
	define( 'EMA4WP_PLUGIN_DIR', __DIR__ . '/' );
	define( 'EMA4WP_PLUGIN_URL', plugins_url( '/', __FILE__ ) );
	define( 'EMA4WP_PLUGIN_FILE', __FILE__ );

	// load autoloader if function not yet exists (for compat with sitewide autoloader)
	if ( ! function_exists( 'ema4wp' ) ) {
		require_once EMA4WP_PLUGIN_DIR . 'vendor/autoload.php';
	}

	require EMA4WP_PLUGIN_DIR . '/includes/default-actions.php';
	require EMA4WP_PLUGIN_DIR . '/includes/default-filters.php';

	// require API class manually because Composer's classloader is case-sensitive
	// but we need it to pass class_exists condition
	require EMA4WP_PLUGIN_DIR . '/includes/api/class-api-v3.php';

	/**
	 * @global EMA4WP_Container $GLOBALS['ema4wp']
	 * @name $ema4wp
	 */
	$ema4wp = ema4wp();
	$ema4wp['api'] = 'ema4wp_get_api_v3';
	$ema4wp['log'] = 'ema4wp_get_debug_log';

	// forms
	$ema4wp['forms'] = new EMA4WP_Form_Manager();
	$ema4wp['forms']->add_hooks();

	// integration core
	$ema4wp['integrations'] = new EMA4WP_Integration_Manager();
	$ema4wp['integrations']->add_hooks();

	// Doing cron? Load Usage Tracking class.
	if ( isset( $_GET['doing_wp_cron'] ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
		EMA4WP_Usage_Tracking::instance()->add_hooks();
	}

	// Initialize admin section of plugin
	if ( is_admin() ) {
		$admin_tools = new EMA4WP_Admin_Tools();

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			$ajax = new EMA4WP_Admin_Ajax( $admin_tools );
			$ajax->add_hooks();
		} else {
			$messages = new EMA4WP_Admin_Messages();
			$ema4wp['admin.messages'] = $messages;

			$admin = new EMA4WP_Admin( $admin_tools, $messages );
			$admin->add_hooks();

			$forms_admin = new EMA4WP_Forms_Admin( $messages );
			$forms_admin->add_hooks();

			$integrations_admin = new EMA4WP_Integration_Admin( $ema4wp['integrations'], $messages );
			$integrations_admin->add_hooks();
		}
	}

	return;
}

// bootstrap custom integrations
function _ema4wp_bootstrap_integrations() {
	require_once EMA4WP_PLUGIN_DIR . 'integrations/bootstrap.php';
}

add_action( 'plugins_loaded', '_ema4wp_load_plugin', 8 );
add_action( 'plugins_loaded', '_ema4wp_bootstrap_integrations', 90 );
