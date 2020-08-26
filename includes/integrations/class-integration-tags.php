<?php

/**
 * Class EMA4WP_Integration_Tags
 *
 * @ignore
 * @access private
 */
class EMA4WP_Integration_Tags extends EMA4WP_Dynamic_Content_Tags {

	/**
	 * @var EMA4WP_Integration
	 */
	protected $integration;

	/**
	 * Add hooks
	 */
	public function add_hooks() {
		add_filter( 'ema4wp_integration_checkbox_label', array( $this, 'replace_in_checkbox_label' ), 10, 2 );
	}

	/**
	 * Register template tags for integrations
	 */
	public function register() {
		parent::register();

		$this->tags['subscriber_count'] = array(
			'description' => __( 'Replaced with the number of subscribers on the selected list(s)', 'zozoema-for-wp' ),
			'callback'    => array( $this, 'get_subscriber_count' ),
		);
	}

	/**
	 * @hooked `ema4wp_integration_checkbox_label`
	 * @param string $string
	 * @param EMA4WP_Integration $integration
	 * @return string
	 */
	public function replace_in_checkbox_label( $string, EMA4WP_Integration $integration ) {
		$this->integration = $integration;
		$string            = $this->replace( $string, 'esc_html' );
		return $string;
	}

	/**
	 * Returns the number of subscribers on the selected lists (for the form context)
	 *
	 * @return int
	 */
	public function get_subscriber_count() {
		$zozoema = new EMA4WP_ZozoEMA();
		$list_ids  = $this->integration->get_lists();
		$count     = $zozoema->get_subscriber_count( $list_ids );
		return number_format( $count );
	}
}
