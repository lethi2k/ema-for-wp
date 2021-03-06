<?php defined( 'ABSPATH' ) or exit;
/** @var EMA4WP_Integration $integration */
/** @var array $opts */
?>
<div id="ema4wp-admin" class="wrap ema4wp-settings">

	<p class="breadcrumbs">
		<span class="prefix"><?php echo esc_html__( 'You are here: ', 'zozoema-for-wp' ); ?></span>
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=zozoema-for-wp' ) ); ?>">ZozoEMA for WordPress</a> &rsaquo;
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=zozoema-for-wp-integrations' ) ); ?>"><?php echo esc_html__( 'Integrations', 'zozoema-for-wp' ); ?></a> &rsaquo;
		<span class="current-crumb"><strong><?php echo esc_html( $integration->name ); ?></strong></span>
	</p>

	<div class="main-content row">

		<!-- Main Content -->
		<div class="main-content col col-4 col-sm-6">

			<h1 class="page-title">
				<?php printf( esc_html__( '%s integration', 'zozoema-for-wp' ), esc_html( $integration->name ) ); ?>
			</h1>

			<h2 style="display: none;"></h2>
			<?php settings_errors(); ?>

			<div id="notice-additional-fields" class="notice notice-warning" style="display: none;">
				<p><?php echo esc_html__( 'The selected ZozoEMA lists require non-default fields, which may prevent this integration from working.', 'zozoema-for-wp' ); ?></p>
				<p><?php echo sprintf( wp_kses( __( 'Please ensure you <a href="%1$s">configure the plugin to send all required fields</a> or <a href="%2$s">log into your ZozoEMA account</a> and make sure only the email & name fields are marked as required fields for the selected list(s).', 'zozoema-for-wp' ), array( 'a' => array( 'href' => array() ) ) ), 'https://www.ema4wp.com/kb/send-additional-fields-from-integrations/#utm_source=wp-plugin&utm_medium=zozoema-for-wp&utm_campaign=integrations-page', 'https://admin.zozoema.com/lists/' ); ?></p>
			</div>

			<p>
				<?php echo esc_html( $integration->description ); ?>
			</p>

			<!-- Settings form -->
			<form method="post" action="<?php echo admin_url( 'options.php' ); ?>">
				<?php settings_fields( 'ema4wp_integrations_settings' ); ?>

				<?php

				/**
				 * Runs just before integration settings are outputted in admin.
				 *
				 * @since 3.0
				 *
				 * @param EMA4WP_Integration $integration
				 * @param array $opts
				 * @ignore
				 */
				do_action( 'ema4wp_admin_before_integration_settings', $integration, $opts );

				/**
				 * @ignore
				 */
				do_action( 'ema4wp_admin_before_' . $integration->slug . '_integration_settings', $integration, $opts );
				?>

				<table class="form-table">

					<?php
					if ( $integration->has_ui_element( 'enabled' ) ) {
						?>
					<tr valign="top">
						<th scope="row"><?php echo esc_html__( 'Enabled?', 'zozoema-for-wp' ); ?></th>
						<td class="nowrap integration-toggles-wrap">
							<label><input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][enabled]" value="1" <?php checked( $opts['enabled'], 1 ); ?> /> <?php echo esc_html__( 'Yes', 'zozoema-for-wp' ); ?></label> &nbsp;
							<label><input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][enabled]" value="0" <?php checked( $opts['enabled'], 0 ); ?> /> <?php echo esc_html__( 'No', 'zozoema-for-wp' ); ?></label>
							<p class="help"><?php echo sprintf( esc_html__( 'Enable the %s integration? This will add a sign-up checkbox to the form.', 'zozoema-for-wp' ), $integration->name ); ?></p>
						</td>
					</tr>
						<?php
					}
					?>

					<?php
					$config = array(
						'element' => 'ema4wp_integrations[' . $integration->slug . '][enabled]',
						'value'   => '1',
						'hide'    => false,
					);
					?>
					<tbody class="integration-toggled-settings" data-showif="<?php echo esc_attr( json_encode( $config ) ); ?>">

					<?php
					if ( $integration->has_ui_element( 'implicit' ) ) {
						?>
						<tr valign="top">
							<th scope="row"><?php echo esc_html__( 'Implicit?', 'zozoema-for-wp' ); ?></th>
							<td class="nowrap">
								<label><input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][implicit]" value="1" <?php checked( $opts['implicit'], 1 ); ?> /> <?php echo esc_html__( 'Yes', 'zozoema-for-wp' ); ?></label> &nbsp;
								<label><input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][implicit]" value="0" <?php checked( $opts['implicit'], 0 ); ?> /> <?php echo esc_html__( 'No', 'zozoema-for-wp' ); ?> <?php echo '<em>', esc_html__( '(recommended)', 'zozoema-for-wp' ), '</em>'; ?>
							</label>
								<p class="help">
									<?php
									echo esc_html__( 'Select "yes" if you want to subscribe people without asking them explicitly.', 'zozoema-for-wp' );
									echo '<br />';

									echo sprintf(
										wp_kses(
											__( '<strong>Warning: </strong> enabling this may affect your <a href="%s">GDPR compliance</a>.', 'zozoema-for-wp' ),
											array(
											'a' => array( 'href' => array() ),
											'strong' => array(),
											)
										),
										'https://www.ema4wp.com/kb/gdpr-compliance/#utm_source=wp-plugin&utm_medium=zozoema-for-wp&utm_campaign=integrations-page'
									);
									?>
									</p>
							</td>
						</tr>
						<?php
					}
					?>

					<?php
					if ( $integration->has_ui_element( 'lists' ) ) {
						?>
						<?php // hidden input to make sure a value is sent to the server when no checkboxes were selected ?>
						<input type="hidden" name="ema4wp_integrations[<?php echo $integration->slug; ?>][lists][]" value="" />
						<tr valign="top">
							<th scope="row"><?php echo esc_html__( 'ZozoEMA Lists', 'zozoema-for-wp' ); ?></th>
							<?php
							if ( ! empty( $lists ) ) {
								echo '<td>';
								echo '<ul style="margin-bottom: 20px; max-height: 300px; overflow-y: auto;">';
								foreach ( $lists as $list ) {
									echo '<li><label>';
									echo sprintf( '<input type="checkbox" name="ema4wp_integrations[%s][lists][]" value="%s" class="ema4wp-list-input" %s> ', $integration->slug, $list->uid, checked( in_array( $list->uid, $opts['lists'], true ), true, false ) );
									echo esc_html( $list->name );
									echo '</label></li>';
								}
								echo '</ul>';

								echo '<p class="help">';
								echo esc_html__( 'Select the list(s) to which people who check the checkbox should be subscribed.', 'zozoema-for-wp' );
								echo '</p>';
								echo '</td>';
							} else {
								echo '<td>', sprintf( wp_kses( __( 'No lists found, <a href="%s">are you connected to ZozoEMA</a>?', 'zozoema-for-wp' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'admin.php?page=zozoema-for-wp' ) ) ), '</td>';
							}
							?>
						</tr>
						<?php
					} // end if UI has lists
					?>

					<?php
					if ( $integration->has_ui_element( 'label' ) ) {
						$config = array(
							'element' => 'ema4wp_integrations[' . $integration->slug . '][implicit]',
							'value'   => 0,
						);
						?>
						<tr valign="top" data-showif="<?php echo esc_attr( json_encode( $config ) ); ?>">
							<th scope="row"><label for="ema4wp_checkbox_label"><?php echo esc_html__( 'Checkbox label text', 'zozoema-for-wp' ); ?></label></th>
							<td>
								<input type="text"  class="widefat" id="ema4wp_checkbox_label" name="ema4wp_integrations[<?php echo $integration->slug; ?>][label]" value="<?php echo esc_attr( $opts['label'] ); ?>" required />
								<p class="help"><?php printf( esc_html__( 'HTML tags like %s are allowed in the label text.', 'zozoema-for-wp' ), '<code>' . esc_html( '<strong><em><a>' ) . '</code>' ); ?></p>
							</td>
						</tr>
						<?php
					} // end if UI label
					?>


					<?php
					if ( $integration->has_ui_element( 'precheck' ) ) {
						$config = array(
							'element' => 'ema4wp_integrations[' . $integration->slug . '][implicit]',
							'value'   => 0,
						);
						?>
						<tr valign="top" data-showif="<?php echo esc_attr( json_encode( $config ) ); ?>">
							<th scope="row"><?php echo esc_html__( 'Pre-check the checkbox?', 'zozoema-for-wp' ); ?></th>
							<td class="nowrap">
								<label><input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][precheck]" value="1" <?php checked( $opts['precheck'], 1 ); ?> /> <?php echo esc_html__( 'Yes', 'zozoema-for-wp' ); ?></label> &nbsp;
								<label><input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][precheck]" value="0" <?php checked( $opts['precheck'], 0 ); ?> /> <?php echo esc_html__( 'No', 'zozoema-for-wp' ); ?> <?php echo '<em>' . __( '(recommended)', 'zozoema-for-wp' ) . '</em>'; ?></label>
								<p class="help">
									<?php
									echo esc_html__( 'Select "yes" if the checkbox should be pre-checked.', 'zozoema-for-wp' );
									echo '<br />';
									echo sprintf( wp_kses( __( '<strong>Warning: </strong> enabling this may affect your <a href="%s">GDPR compliance</a>.', 'zozoema-for-wp' ), array( 'a' => array( 'href' => array() ) ) ), 'https://www.ema4wp.com/kb/gdpr-compliance/#utm_source=wp-plugin&utm_medium=zozoema-for-wp&utm_campaign=integrations-page' );
									?>
								</p>
							</td>
						<?php
					} // end if UI precheck
					?>

					<?php
					if ( $integration->has_ui_element( 'css' ) ) {
						$config = array(
							'element' => 'ema4wp_integrations[' . $integration->slug . '][implicit]',
							'value'   => 0,
						);
						?>
						<tr valign="top" data-showif="<?php echo esc_attr( json_encode( $config ) ); ?>">
							<th scope="row"><?php echo esc_html__( 'Load some default CSS?', 'zozoema-for-wp' ); ?></th>
							<td class="nowrap">
								<label><input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][css]" value="1" <?php checked( $opts['css'], 1 ); ?> />&rlm; <?php echo esc_html__( 'Yes', 'zozoema-for-wp' ); ?></label> &nbsp;
								<label><input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][css]" value="0" <?php checked( $opts['css'], 0 ); ?> />&rlm; <?php echo esc_html__( 'No', 'zozoema-for-wp' ); ?></label>
								<p class="help"><?php echo esc_html__( 'Select "yes" if the checkbox appears in a weird place.', 'zozoema-for-wp' ); ?></p>
							</td>
						</tr>
						<?php
					} // end if UI css
					?>

					<?php
					if ( $integration->has_ui_element( 'double_optin' ) ) {
						?>
						<tr valign="top">
							<th scope="row"><?php echo esc_html__( 'Double opt-in?', 'zozoema-for-wp' ); ?></th>
							<td class="nowrap">
								<label>
									<input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][double_optin]" value="1" <?php checked( $opts['double_optin'], 1 ); ?> />&rlm;
									<?php echo esc_html__( 'Yes', 'zozoema-for-wp' ); ?>
								</label> &nbsp;
								<label>
									<input type="radio" id="ema4wp_checkbox_double_optin_0" name="ema4wp_integrations[<?php echo $integration->slug; ?>][double_optin]" value="0" <?php checked( $opts['double_optin'], 0 ); ?> />&rlm;
									<?php echo esc_html__( 'No', 'zozoema-for-wp' ); ?>
								</label>
								<p class="help">
									<?php echo esc_html__( 'Select "yes" if you want people to confirm their email address before being subscribed (recommended)', 'zozoema-for-wp' ); ?>
								</p>
							</td>
						</tr>
						<?php
					} // end if UI double_optin
					?>

					<?php
					if ( $integration->has_ui_element( 'update_existing' ) ) {
						?>
					<tr valign="top">
						<th scope="row"><?php echo esc_html__( 'Update existing subscribers?', 'zozoema-for-wp' ); ?></th>
						<td class="nowrap">
							<label>
								<input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][update_existing]" value="1" <?php checked( $opts['update_existing'], 1 ); ?> />&rlm;
								<?php echo esc_html__( 'Yes', 'zozoema-for-wp' ); ?>
							</label> &nbsp;
							<label>
								<input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][update_existing]" value="0" <?php checked( $opts['update_existing'], 0 ); ?> />&rlm;
								<?php echo esc_html__( 'No', 'zozoema-for-wp' ); ?>
							</label>
							<p class="help"><?php echo esc_html__( 'Select "yes" if you want to update existing subscribers with the data that is sent.', 'zozoema-for-wp' ); ?></p>
						</td>
					</tr>
						<?php
					} // end if UI update_existing
					?>

					<?php
					if ( $integration->has_ui_element( 'replace_interests' ) ) {
						$config = array(
							'element' => 'ema4wp_integrations[' . $integration->slug . '][update_existing]',
							'value'   => 1,
						);
						?>
						<tr valign="top" data-showif="<?php echo esc_attr( json_encode( $config ) ); ?>">
							<th scope="row"><?php echo esc_html__( 'Replace interest groups?', 'zozoema-for-wp' ); ?></th>
							<td class="nowrap">
								<label>
									<input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][replace_interests]" value="1" <?php checked( $opts['replace_interests'], 1 ); ?> />&rlm;
									<?php echo esc_html__( 'Yes', 'zozoema-for-wp' ); ?>
								</label> &nbsp;
								<label>
									<input type="radio" name="ema4wp_integrations[<?php echo $integration->slug; ?>][replace_interests]" value="0" <?php checked( $opts['replace_interests'], 0 ); ?> />&rlm;
									<?php echo esc_html__( 'No', 'zozoema-for-wp' ); ?>
								</label>
								<p class="help">
									<?php echo esc_html__( 'Select "no" if you want to add the selected interests to any previously selected interests when updating a subscriber.', 'zozoema-for-wp' ); ?>
									<?php echo sprintf( '<a href="%s" target="_blank">' . esc_html__( 'What does this do?', 'zozoema-for-wp' ) . '</a>', 'https://www.ema4wp.com/kb/what-does-replace-groupings-mean/#utm_source=wp-plugin&utm_medium=zozoema-for-wp&utm_campaign=integrations-page' ); ?>
								</p>
							</td>
						</tr>
						<?php
					} // end if UI replace_interests
					?>

					</tbody>
				</table>

				<?php

				/**
				 * Runs right after integration settings are outputted (before the submit button).
				 *
				 * @param EMA4WP_Integration $integration
				 * @param array $opts
				 * @ignore
				 */
				do_action( 'ema4wp_admin_after_integration_settings', $integration, $opts );

				/**
				 * @ignore
				 */
				do_action( 'ema4wp_admin_after_' . $integration->slug . '_integration_settings', $integration, $opts );
				?>

				<?php
				if ( count( $integration->get_ui_elements() ) > 0 ) {
					submit_button();
				}
				?>

			</form>


		</div>

		<!-- Sidebar -->
		<div class="sidebar col col-2">
			<?php include EMA4WP_PLUGIN_DIR . '/includes/views/parts/admin-sidebar.php'; ?>
		</div>

	</div>

</div>
