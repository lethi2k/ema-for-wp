<?php

/**
 * Class EMA4WP_Integration_Admin
 *
 * @ignore
 * @access private
 */
class EMA4WP_Integration_Admin {


	/**
	 * @var EMA4WP_Integration_Manager
	 */
	protected $integrations;

	/**
	 * @var EMA4WP_Admin_Messages
	 */
	protected $messages;

	/**
	 * @param EMA4WP_Integration_Manager $integrations
	 * @param EMA4WP_Admin_Messages $messages
	 */
	public function __construct( EMA4WP_Integration_Manager $integrations, EMA4WP_Admin_Messages $messages ) {
		$this->integrations = $integrations;
		$this->messages     = $messages;
	}

	/**
	 * Add hooks
	 */
	public function add_hooks() {
		add_action( 'admin_init', array( $this, 'register_setting' ) );
		add_action( 'ema4wp_admin_enqueue_assets', array( $this, 'enqueue_assets' ), 10, 2 );
		add_filter( 'ema4wp_admin_menu_items', array( $this, 'add_menu_item' ) );
	}

	/**
	 * Register settings
	 */
	public function register_setting() {
		register_setting( 'ema4wp_integrations_settings', 'ema4wp_integrations', array( $this, 'save_integration_settings' ) );
	}

	/**
	 * Enqueue assets
	 *
	 * @param string $suffix
	 * @param string $page
	 *
	 * @return void
	 */
	public function enqueue_assets( $suffix, $page = '' ) {

		// only load on integrations pages
		if ( $page !== 'integrations' ) {
			return;
		}

		wp_register_script( 'ema4wp-integrations-admin', EMA4WP_PLUGIN_URL . 'assets/js/integrations-admin' . $suffix . '.js', array( 'ema4wp-admin' ), EMA4WP_VERSION, true );
		wp_enqueue_script( 'ema4wp-integrations-admin' );
	}

	/**
	 * @param array $items
	 *
	 * @return array
	 */
	public function add_menu_item( $items ) {
		$items[] = array(
			'title'    => esc_html__( 'Integrations', 'zozoema-for-wp' ),
			'text'     => esc_html__( 'Integrations', 'zozoema-for-wp' ),
			'slug'     => 'integrations',
			'callback' => array( $this, 'show_integrations_page' ),
			'position' => 20,
		);

		return $items;
	}

	/**
	 * @param array $new_settings
	 * @return array
	 */
	public function save_integration_settings( array $new_settings ) {
		$integrations     = $this->integrations->get_all();
		$current_settings = (array) get_option( 'ema4wp_integrations', array() );
		$settings         = array();

		foreach ( $integrations as $slug => $integration ) {
			$settings[ $slug ] = $this->parse_integration_settings( $slug, $current_settings, $new_settings );
		}

		return $settings;
	}

	/**
	 * @since 3.0
	 * @param string $slug
	 * @param array $current
	 * @param array $new
	 *
	 * @return array
	 */
	protected function parse_integration_settings( $slug, $current, $new ) {
		$settings = array();

		// start with current settings
		if ( ! empty( $current[ $slug ] ) ) {
			$settings = $current[ $slug ];
		}

		// if no new settings were given, return current settings.
		if ( empty( $new[ $slug ] ) ) {
			return $settings;
		}

		// merge new settings with currents (to allow passing partial setting arrays)
		$settings = array_merge( $settings, $new[ $slug ] );

		// sanitize settings
		$settings = $this->sanitize_integration_settings( $settings );

		return $settings;
	}

	/**
	 * @param array $settings
	 * @return array
	 */
	protected function sanitize_integration_settings( $settings ) {

		// filter null values from lists setting
		if ( ! empty( $settings['lists'] ) ) {
			$settings['lists'] = array_filter( $settings['lists'] );
		} else {
			$settings['lists'] = array();
		}

		return $settings;
	}

	/**
	 * Show the Integration Settings page
	 *
	 * @internal
	 */
	public function show_integrations_page() {
		if ( ! empty( $_GET['integration'] ) ) {
			$this->show_integration_settings_page( $_GET['integration'] );
			return;
		}

		// get all installed & enabled integrations
		$enabled_integrations = $this->integrations->get_enabled_integrations();

		// get all integrations but remove enabled integrations from the resulting array
		$integrations = $this->integrations->get_all();

		require __DIR__ . '/views/integrations.php';
	}

	/**
	 * @param string $slug
	 *
	 * @internal
	 */
	public function show_integration_settings_page( $slug ) {
		try {
			$integration = $this->integrations->get( $slug );
		} catch ( Exception $e ) {
			echo sprintf( '<h3>Integration not found.</h3><p>No integration with slug <strong>%s</strong> was found.</p>', esc_html( $slug ) );
			return;
		}

		$opts      = $integration->options;
		$zozoema = new EMA4WP_ZozoEMA();
		$lists     = $zozoema->get_lists();

		require __DIR__ . '/views/integration-settings.php';
	}
}
