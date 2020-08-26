<?php

class EMA4WP_Admin_Ajax {


	/**
	 * @var EMA4WP_Admin_Tools
	 */
	protected $tools;

	/**
	 * EMA4WP_Admin_Ajax constructor.
	 *
	 * @param EMA4WP_Admin_Tools $tools
	 */
	public function __construct( EMA4WP_Admin_Tools $tools ) {
		$this->tools = $tools;
	}

	/**
	 * Hook AJAX actions
	 */
	public function add_hooks() {
		add_action( 'wp_ajax_ema4wp_renew_zozoema_lists', array( $this, 'refresh_zozoema_lists' ) );
		add_action( 'wp_ajax_ema4wp_get_list_details', array( $this, 'get_list_details' ) );
	}

	/**
	 * Empty lists cache & fetch lists again.
	 */
	public function refresh_zozoema_lists() {
		if ( ! $this->tools->is_user_authorized() ) {
			wp_send_json( false );
		}

		$zozoema = new EMA4WP_ZozoEMA();
		$success   = $zozoema->refresh_lists();
		wp_send_json( $success );
	}

	/**
	 * Retrieve details (merge fields and interest categories) for one or multiple lists in ZozoEMA
	 * @throws EMA4WP_API_Exception
	 */
	public function get_list_details() {
		$list_ids  = (array) explode( ',', $_GET['ids'] );
		$data      = array();
		$zozoema = new EMA4WP_ZozoEMA();
		foreach ( $list_ids as $list_id ) {
			$merge_fields        = $zozoema->get_list_merge_fields( $list_id );
			$interest_categories = $zozoema->get_list_interest_categories( $list_id );
			$data[]              = (object) array(
				'id'                  => $list_id,
				'merge_fields'        => $merge_fields,
				'interest_categories' => $interest_categories,
			);
		}
		wp_send_json( $data );
	}
}
