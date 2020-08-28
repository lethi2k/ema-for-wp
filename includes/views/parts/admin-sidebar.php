<?php

defined( 'ABSPATH' ) or exit;

/**
 * @ignore
 */
function _ema4wp_admin_sidebar_support_notice() {
	?>
	<div class="ema4wp-box">
		<h4 class="ema4wp-title"><?php echo esc_html__( 'Looking for help?', 'zozoema-for-wp' ); ?></h4>
		<p><?php echo esc_html__( 'We have some resources available to help you in the right direction.', 'zozoema-for-wp' ); ?></p>
		<ul class="ul-square">
			<li><a href="https://appv4.zozo.vn/frontend/docs/api/v1"><?php echo esc_html__( 'Knowledge Base', 'zozoema-for-wp' ); ?></a></li>
			<li><a href="https://wordpress.org/plugins/zozoema-for-wp/faq/"><?php echo esc_html__( 'Frequently Asked Questions', 'zozoema-for-wp' ); ?></a></li>
		</ul>
		<p><?php echo sprintf( wp_kses( __( 'If your answer can not be found in the resources listed above, please use the <a href="%s">support forums on WordPress.org</a>.', 'zozoema-for-wp' ), array( 'a' => array( 'href' => array() ) ) ), 'https://wordpress.org/support/plugin/zozoema-for-wp' ); ?></p>
		<p><?php echo sprintf( wp_kses( __( 'Found a bug? Please <a href="%s">open an issue on GitHub</a>.', 'zozoema-for-wp' ), array( 'a' => array( 'href' => array() ) ) ), 'https://github.com/ibericode/zozoema-for-wordpress/issues' ); ?></p>
	</div>
	<?php
}

/**
 * @ignore
 */
function _ema4wp_admin_sidebar_other_plugins() {
	echo '';
	// echo '<div class="ema4wp-box">';
	// echo '<h4 class="ema4wp-title">', esc_html__( 'Other plugins by ibericode', 'zozoema-for-wp' ), '</h4>';
	// echo '<ul style="margin-bottom: 0;">';

	// // Koko Analytics
	// echo '<li style="margin: 12px 0;">';
	// echo sprintf( '<strong><a href="%s">Koko Analytics</a></strong><br />', 'https://wordpress.org/plugins/koko-analytics/#utm_source=wp-plugin&utm_medium=zozoema-for-wp&utm_campaign=sidebar' );
	// echo esc_html__( 'Privacy-friendly analytics plugin that does not use any external services.', 'zozoema-for-wp' );
	// echo '</li>';

	// // Boxzilla
	// echo '<li style="margin: 12px 0;">';
	// echo sprintf( '<strong><a href="%s">Boxzilla Pop-ups</a></strong><br />', 'https://wordpress.org/plugins/boxzilla/#utm_source=wp-plugin&utm_medium=zozoema-for-wp&utm_campaign=sidebar' );
	// echo esc_html__( 'Pop-ups or boxes that slide-in with a newsletter sign-up form. A sure-fire way to grow your email lists.', 'zozoema-for-wp' );
	// echo '</li>';

	// // HTML Forms
	// echo '<li style="margin: 12px 0;">';
	// echo sprintf( '<strong><a href="%s">HTML Forms</a></strong><br />', 'https://wordpress.org/plugins/html-forms/#utm_source=wp-plugin&utm_medium=zozoema-for-wp&utm_campaign=sidebar' );
	// echo esc_html__( 'Super flexible forms using native HTML. Just like ZozoEMA for WordPress forms but for other purposes, like a contact form.', 'zozoema-for-wp' );
	// echo '</li>';

	// echo '</ul>';
	// echo '</div>';
}

add_action( 'ema4wp_admin_sidebar', '_ema4wp_admin_sidebar_other_plugins', 40 );
add_action( 'ema4wp_admin_sidebar', '_ema4wp_admin_sidebar_support_notice', 50 );

/**
 * Runs when the sidebar is outputted on ZozoEMA for WordPress settings pages.
 *
 * Please note that not all pages have a sidebar.
 *
 * @since 3.0
 */
do_action( 'ema4wp_admin_sidebar' );
