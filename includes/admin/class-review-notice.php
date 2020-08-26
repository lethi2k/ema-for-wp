<?php

/**
 * Class EMA4WP_Admin_Review_Notice
 *
 * @ignore
 */
class EMA4WP_Admin_Review_Notice {


	/**
	 * @var EMA4WP_Admin_Tools
	 */
	protected $tools;

	/**
	 * @var string
	 */
	protected $meta_key_dismissed = '_ema4wp_review_notice_dismissed';

	/**
	 * EMA4WP_Admin_Review_Notice constructor.
	 *
	 * @param EMA4WP_Admin_Tools $tools
	 */
	public function __construct( EMA4WP_Admin_Tools $tools ) {
		$this->tools = $tools;
	}

	/**
	 * Add action & filter hooks.
	 */
	public function add_hooks() {
		add_action( 'admin_notices', array( $this, 'show' ) );
		add_action( 'ema4wp_admin_dismiss_review_notice', array( $this, 'dismiss' ) );
	}

	/**
	 * Set flag in user meta so notice won't be shown.
	 */
	public function dismiss() {
		$user = wp_get_current_user();
		update_user_meta( $user->ID, $this->meta_key_dismissed, 1 );
	}

	/**
	 * @return bool
	 */
	public function show() {
		// only show on ZozoEMA for WordPress' pages.
		if ( ! $this->tools->on_plugin_page() ) {
			return false;
		}

		// only show if 2 weeks have passed since first use.
		$two_weeks_in_seconds = ( 60 * 60 * 24 * 14 );
		if ( $this->time_since_first_use() <= $two_weeks_in_seconds ) {
			return false;
		}

		// only show if user did not dismiss before
		$user = wp_get_current_user();
		if ( get_user_meta( $user->ID, $this->meta_key_dismissed, true ) ) {
			return false;
		}

		echo '<div class="notice notice-info ema4wp-is-dismissible" id="ema4wp-review-notice">';
		echo '<p>';
		echo esc_html__( 'You\'ve been using ZozoEMA for WordPress for some time now; we hope you love it!', 'zozoema-for-wp' ), ' <br />';
		echo sprintf( wp_kses( __( 'If you do, please <a href="%s">leave us a 5★ rating on WordPress.org</a>. It would be of great help to us.', 'zozoema-for-wp' ), array( 'a' => array( 'href' => array() ) ) ), 'https://wordpress.org/support/view/plugin-reviews/zozoema-for-wp?rate=5#new-post' );
		echo '</p>';
		echo '<form method="POST" id="ema4wp-dismiss-review-form"><button type="submit" class="notice-dismiss"><span class="screen-reader-text">', esc_html__( 'Dismiss this notice.', 'zozoema-for-wp' ), '</span></button><input type="hidden" name="_ema4wp_action" value="dismiss_review_notice"/></form>';
		echo '</div>';
		return true;
	}

	/**
	 * @return int
	 */
	private function time_since_first_use() {
		$options = get_option( 'ema4wp' );

		// option was never added before, do it now.
		if ( empty( $options['first_activated_on'] ) ) {
			$options['first_activated_on'] = time();
			update_option( 'ema4wp', $options );
		}

		return time() - $options['first_activated_on'];
	}
}
