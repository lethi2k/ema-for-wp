<?php defined( 'ABSPATH' ) or exit;

/**
 * @ignore
 */
function _ema4wp_admin_translation_notice() {
	// show for every language other than the default
	if ( stripos( get_locale(), 'en_us' ) === 0 ) {
		return;
	}

	/* translators: %s links to the WordPress.org translation project */
	echo '<p class="help">' . sprintf( wp_kses( __( 'ZozoEMA for WordPress is in need of translations. Is the plugin not translated in your language or do you spot errors with the current translations? Helping out is easy! Please <a href="%s">help translate the plugin using your WordPress.org account</a>.', 'zozoema-for-wp' ), array( 'a' => array( 'href' => array() ) ) ), 'https://translate.wordpress.org/projects/wp-plugins/zozoema-for-wp/stable/' ) . '</p>';
}

/**
 * @ignore
 */
function _ema4wp_admin_github_notice() {
	if ( strpos( $_SERVER['HTTP_HOST'], 'localhost' ) === false && ! WP_DEBUG ) {
		return;
	}

	echo '<p class="help">Developer? Follow <a href="https://github.com/ibericode/zozoema-for-wordpress">ZozoEMA for WordPress on GitHub</a> or have a look at our repository of <a href="https://github.com/ibericode/ema4wp-snippets">sample code snippets</a>.</p>';
}

/**
 * @ignore
 */
function _ema4wp_admin_disclaimer_notice() {
	echo '<p class="help">', esc_html__( 'This plugin is not developed by or affiliated with ZozoEMA in any way.', 'zozoema-for-wp' ), '</p>';
}

add_action( 'ema4wp_admin_footer', '_ema4wp_admin_translation_notice', 20 );
add_action( 'ema4wp_admin_footer', '_ema4wp_admin_github_notice', 50 );
add_action( 'ema4wp_admin_footer', '_ema4wp_admin_disclaimer_notice', 80 );
?>

<div class="big-margin">

	<?php

	/**
	 * Runs while printing the footer of every ZozoEMA for WordPress settings page.
	 *
	 * @since 3.0
	 */
	do_action( 'ema4wp_admin_footer' );
	?>

</div>
