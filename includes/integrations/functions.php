<?php

/**
 * Gets an array of all registered integrations
 *
 * @since 3.0
 * @access public
 *
 * @return EMA4WP_Integration[]
 */
function ema4wp_get_integrations() {
	return ema4wp( 'integrations' )->get_all();
}

/**
 * Get an instance of a registered integration class
 *
 * @since 3.0
 * @access public
 *
 * @param string $slug
 *
 * @return EMA4WP_Integration
 */
function ema4wp_get_integration( $slug ) {
	return ema4wp( 'integrations' )->get( $slug );
}

/**
 * Register a new integration with ZozoEMA for WordPress
 *
 * @since 3.0
 * @access public
 *
 * @param string $slug
 * @param string $class
 *
 * @param bool $always_enabled
 */
function ema4wp_register_integration( $slug, $class, $always_enabled = false ) {
	return ema4wp( 'integrations' )->register_integration( $slug, $class, $always_enabled );
}

/**
 * Deregister a previously registered integration with ZozoEMA for WordPress
 *
 * @since 3.0
 * @access public
 * @param string $slug
 */
function ema4wp_deregister_integration( $slug ) {
	ema4wp( 'integrations' )->deregister_integration( $slug );
}
