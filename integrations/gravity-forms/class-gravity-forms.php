<?php

defined( 'ABSPATH' ) or exit;

/**
 * Class EMA4WP_Ninja_Forms_Integration
 *
 * @ignore
 */
class EMA4WP_Gravity_Forms_Integration extends EMA4WP_Integration {


	/**
	 * @var string
	 */
	public $name = 'Gravity Forms';

	/**
	 * @var string
	 */
	public $description = 'Subscribe visitors from your Gravity Forms forms.';


	/**
	 * Add hooks
	 */
	public function add_hooks() {
		add_action( 'gform_field_standard_settings', array( $this, 'settings_fields' ), 10, 2 );
		add_action( 'gform_editor_js', array( $this, 'editor_js' ) );
		add_action( 'gform_after_submission', array( $this, 'after_submission' ), 10, 2 );
	}

	public function after_submission( $submission, $form ) {
		$subscribe         = false;
		$email_address     = '';
		$zozoema_list_id = '';
		$double_optin      = $this->options['double_optin'];

		// find email field & checkbox value
		foreach ( $form['fields'] as $field ) {
			if ( $field->type === 'email' && empty( $email_address ) && ! empty( $submission[ $field->id ] ) ) {
				$email_address = $submission[ $field->id ];
			}

			if ( $field->type === 'zozoema' && ! empty( $submission[ $field->id ] ) ) {
				$subscribe         = true;
				$zozoema_list_id = $field->zozoema_list;

				if ( isset( $field->zozoema_double_optin ) ) {
					$double_optin = $field->zozoema_double_optin;
				}
			}
		}

		if ( ! $subscribe || empty( $email_address ) ) {
			return;
		}

		// override integration settings with field options
		$orig_options                  = $this->options;
		$this->options['lists']        = array( $zozoema_list_id );
		$this->options['double_optin'] = $double_optin;

		// perform the sign-up
		$this->subscribe( array( 'EMAIL' => $email_address ), $submission['form_id'] );

		// revert back to original options in case request lives on
		$this->options = $orig_options;
	}

	public function editor_js() {
		?>
		<script type="text/javascript">
			jQuery(document).on('gform_load_field_settings', function(evt, field) {
				jQuery('#field_zozoema_list').val(field.zozoema_list || '');
				jQuery('#field_zozoema_double_optin').val(field.zozoema_double_optin || "1");
				jQuery('#field_zozoema_precheck').val(field.zozoema_precheck || "0");
			});
		</script>
		<?php
	}

	public function settings_fields( $pos, $form_id ) {
		if ( $pos !== 0 ) {
			return;
		}

		$zozoema = new EMA4WP_ZozoEMA();
		$lists     = $zozoema->get_lists();
		?>
		<li class="zozoema_list_setting field_setting">
			<label for="field_zozoema_list" class="section_label">
				<?php esc_html_e( 'ZozoEMA list', 'zozoema-for-wp' ); ?>
			</label>
			<select id="field_zozoema_list" onchange="SetFieldProperty('zozoema_list', this.value)">
				<option value="" disabled><?php _e( 'Select a ZozoEMA list', 'zozoema-for-wp' ); ?></option>
				<?php
				foreach ( $lists as $list ) {
					echo sprintf( '<option value="%s">%s</option>', $list->uid, $list->name );
				}
				?>
			</select>
			<p class="help">
				<?php echo __( 'Select the list(s) to which people who check the checkbox should be subscribed.', 'zozoema-for-wp' ); ?>
			</p>
		</li>
		<li class="zozoema_double_optin field_setting">
			<label for="field_zozoema_double_optin" class="section_label">
				<?php esc_html_e( 'Double opt-in?', 'zozoema-for-wp' ); ?>
			</label>
			<select id="field_zozoema_double_optin" onchange="SetFieldProperty('zozoema_double_optin', this.value)">
				<option value="1"><?php echo __( 'Yes', 'zozoema-for-wp' ); ?></option>
				<option value="0"><?php echo __( 'No', 'zozoema-for-wp' ); ?></option>
			</select>
			<p class="help">
				<?php _e( 'Select "yes" if you want people to confirm their email address before being subscribed (recommended)', 'zozoema-for-wp' ); ?>
			</p>
		</li>
		<li class="zozoema_precheck field_setting">
			<label for="field_zozoema_precheck" class="section_label">
				<?php esc_html_e( 'Pre-check the checkbox?', 'zozoema-for-wp' ); ?>
			</label>
			<select id="field_zozoema_precheck" onchange="SetFieldProperty('zozoema_precheck', this.value)">
				<option value="1"><?php echo __( 'Yes', 'zozoema-for-wp' ); ?></option>
				<option value="0"><?php echo __( 'No', 'zozoema-for-wp' ); ?></option>
			</select>
			<p class="help">
				<?php
				_e( 'Select "yes" if the checkbox should be pre-checked.', 'zozoema-for-wp' );
				echo '<br />';
				printf( __( '<strong>Warning: </strong> enabling this may affect your <a href="%s">GDPR compliance</a>.', 'zozoema-for-wp' ), 'https://www.ema4wp.com/kb/gdpr-compliance/#utm_source=wp-plugin&utm_medium=zozoema-for-wp&utm_campaign=integrations-page' );
				?>
			</p>
		</li>
		<?php
	}

	/**
	 * @return bool
	 */
	public function is_installed() {
		return class_exists( 'GF_Field' ) && class_exists( 'GF_Fields' );
	}

	/**
	 * @since 3.0
	 * @return array
	 */
	public function get_ui_elements() {
		return array();
	}

	/**
	 * @param int $form_id
	 * @return string
	 */
	public function get_object_link( $form_id ) {
		return '<a href="' . admin_url( sprintf( 'admin.php?page=gf_edit_forms&id=%d', $form_id ) ) . '">Gravity Forms</a>';
	}
}
