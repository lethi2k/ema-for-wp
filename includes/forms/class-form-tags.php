<?php

/**
 * Class EMA4WP_Form_Tags
 *
 * @access private
 * @ignore
 */
class EMA4WP_Form_Tags extends EMA4WP_Dynamic_Content_Tags {

	/**
	 * @var EMA4WP_Form
	 */
	protected $form;

	/**
	 * @var EMA4WP_Form_Element
	 */
	protected $form_element;

	public function add_hooks() {
		add_filter( 'ema4wp_form_response_html', array( $this, 'replace_in_form_response' ), 10, 2 );
		add_filter( 'ema4wp_form_content', array( $this, 'replace_in_form_content' ), 10, 3 );
		add_filter( 'ema4wp_form_redirect_url', array( $this, 'replace_in_form_redirect_url' ), 10, 2 );
	}

	/**
	 * Register template tags
	 */
	public function register() {
		parent::register();

		$this->tags['response'] = array(
			'description' => __( 'Replaced with the form response (error or success messages).', 'zozoema-for-wp' ),
			'callback'    => array( $this, 'get_form_response' ),
		);

		$this->tags['data'] = array(
			'description' => sprintf( __( 'Data from the URL or a submitted form.', 'zozoema-for-wp' ) ),
			'callback'    => array( $this, 'get_data' ),
			'example'     => "data key='UTM_SOURCE' default='Default Source'",
		);

		$this->tags['subscriber_count'] = array(
			'description' => __( 'Replaced with the number of subscribers on the selected list(s)', 'zozoema-for-wp' ),
			'callback'    => array( $this, 'get_subscriber_count' ),
		);
	}


	public function replace_in_form_content( $string, EMA4WP_Form $form, EMA4WP_Form_Element $element = null ) {
		$this->form         = $form;
		$this->form_element = $element;

		$string = $this->replace( $string );
		return $string;
	}

	public function replace_in_form_response( $string, EMA4WP_Form $form ) {
		$this->form = $form;

		$string = $this->replace( $string );
		return $string;
	}

	public function replace_in_form_redirect_url( $string, EMA4WP_Form $form ) {
		$this->form = $form;
		$string     = $this->replace_in_url( $string );
		return $string;
	}

	/**
	 * Returns the number of subscribers on the selected lists (for the form context)
	 *
	 * @return int
	 */
	public function get_subscriber_count() {
		$zozoema = new EMA4WP_ZozoEMA();
		$count     = $zozoema->get_subscriber_count( $this->form->get_lists() );
		return number_format( $count );
	}

	/**
	 * Returns the form response
	 *
	 * @return string
	 */
	public function get_form_response() {
		if ( $this->form_element instanceof EMA4WP_Form_Element ) {
			return $this->form_element->get_response_html();
		}

		return '';
	}

	/**
	 * Gets data value from GET or POST variables.
	 *
	 * @param array $args
	 * @return string
	 */
	public function get_data( array $args = array() ) {
		if ( empty( $args['key'] ) ) {
			return '';
		}

		$default = isset( $args['default'] ) ? $args['default'] : '';
		$key     = $args['key'];

		$data  = array_merge( $_GET, $_POST );
		$value = isset( $data[ $key ] ) ? $data[ $key ] : $default;

		// turn array into readable value
		if ( is_array( $value ) ) {
			$value = array_filter( $value );
			$value = join( ', ', $value );
		}

		return esc_html( $value );
	}


}
