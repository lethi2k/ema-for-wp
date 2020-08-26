<h2><?php echo esc_html__( 'Form Settings', 'zozoema-for-wp' ); ?></h2>

<div class="medium-margin"></div>

<h3><?php echo esc_html__( 'ZozoEMA specific settings', 'zozoema-for-wp' ); ?></h3>

<table class="form-table" style="table-layout: fixed;">

	<?php
	/** @ignore */
	do_action( 'ema4wp_admin_form_after_zozoema_settings_rows', $opts, $form );
	?>

	<tr valign="top">
		<th scope="row" style="width: 250px;"><?php echo esc_html__( 'Lists this form subscribes to', 'zozoema-for-wp' ); ?></th>
		<?php
		// loop through lists
		if ( empty( $lists ) ) {
			?>
			<td colspan="2"><?php echo sprintf( wp_kses( __( 'No lists found, <a href="%s">are you connected to ZozoEMA</a>?', 'zozoema-for-wp' ), array( 'a' => array( 'href' => array() ) ) ), admin_url( 'admin.php?page=zozoema-for-wp' ) ); ?></td>
			<?php
		} else {
			?>
			<td >

				<ul id="ema4wp-lists" style="margin-bottom: 20px; max-height: 300px; overflow-y: auto;">
					<?php
					foreach ( $lists as $list ) {
						?>
						<li>
							<label>
								<input class="ema4wp-list-input" type="checkbox" name="ema4wp_form[settings][lists][]" value="<?php echo esc_attr( $list->id ); ?>" <?php checked( in_array( $list->id, $opts['lists'] ), true ); ?>> <?php echo esc_html( $list->name ); ?>
							</label>
						</li>
						<?php
					}
					?>
				</ul>
				<p class="help"><?php echo esc_html__( 'Select the list(s) to which people who submit this form should be subscribed.', 'zozoema-for-wp' ); ?></p>
			</td>
			<?php
		}
		?>

	</tr>
	<tr valign="top">
		<th scope="row"><?php echo esc_html__( 'Use double opt-in?', 'zozoema-for-wp' ); ?></th>
		<td class="nowrap">
			<label>
				<input type="radio"  name="ema4wp_form[settings][double_optin]" value="1" <?php checked( $opts['double_optin'], 1 ); ?> />&rlm;
				<?php echo esc_html__( 'Yes', 'zozoema-for-wp' ); ?>
			</label> &nbsp;
			<label>
				<input type="radio" name="ema4wp_form[settings][double_optin]" value="0" <?php checked( $opts['double_optin'], 0 ); ?> onclick="return confirm('<?php echo esc_attr__( 'Are you sure you want to disable double opt-in?', 'zozoema-for-wp' ); ?>');" />&rlm;
				<?php echo esc_html__( 'No', 'zozoema-for-wp' ); ?>
			</label>
			<p class="help"><?php echo esc_html__( 'We strongly suggest keeping double opt-in enabled. Disabling double opt-in may affect your GDPR compliance.', 'zozoema-for-wp' ); ?></p>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row"><?php echo esc_html__( 'Update existing subscribers?', 'zozoema-for-wp' ); ?></th>
		<td class="nowrap">
			<label>
				<input type="radio" name="ema4wp_form[settings][update_existing]" value="1" <?php checked( $opts['update_existing'], 1 ); ?> />&rlm;
				<?php echo esc_html__( 'Yes', 'zozoema-for-wp' ); ?>
			</label> &nbsp;
			<label>
				<input type="radio" name="ema4wp_form[settings][update_existing]" value="0" <?php checked( $opts['update_existing'], 0 ); ?> />&rlm;
				<?php echo esc_html__( 'No', 'zozoema-for-wp' ); ?>
			</label>
			<p class="help"><?php echo esc_html__( 'Select "yes" if you want to update existing subscribers with the data that is sent.', 'zozoema-for-wp' ); ?></p>
		</td>
	</tr>

	<?php
	$config = array(
		'element' => 'ema4wp_form[settings][update_existing]',
		'value'   => 1,
	);
	?>
	<tr valign="top" data-showif="<?php echo esc_attr( json_encode( $config ) ); ?>">
		<th scope="row"><?php echo esc_html__( 'Replace interest groups?', 'zozoema-for-wp' ); ?></th>
		<td class="nowrap">
			<label>
				<input type="radio" name="ema4wp_form[settings][replace_interests]" value="1" <?php checked( $opts['replace_interests'], 1 ); ?> />&rlm;
				<?php echo esc_html__( 'Yes', 'zozoema-for-wp' ); ?>
			</label> &nbsp;
			<label>
				<input type="radio" name="ema4wp_form[settings][replace_interests]" value="0" <?php checked( $opts['replace_interests'], 0 ); ?> />&rlm;
				<?php echo esc_html__( 'No', 'zozoema-for-wp' ); ?>
			</label>
			<p class="help">
				<?php echo esc_html__( 'Select "no" if you want to add the selected interests to any previously selected interests when updating a subscriber.', 'zozoema-for-wp' ); ?>
				<?php echo sprintf( ' <a href="%s" target="_blank">' . esc_html__( 'What does this do?', 'zozoema-for-wp' ) . '</a>', 'https://www.ema4wp.com/kb/what-does-replace-groupings-mean/#utm_source=wp-plugin&utm_medium=zozoema-for-wp&utm_campaign=settings-page' ); ?>
			</p>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row"><label for="ema4wp_form_subscriber_tags"><?php echo esc_html__( 'Subscriber tags', 'zozoema-for-wp' ); ?></label></th>
		<td>
			<input type="text" class="widefat" name="ema4wp_form[settings][subscriber_tags]" id="ema4wp_form_subscriber_tags" placeholder="<?php echo esc_attr__( 'Example: My tag, another tag', 'zozoema-for-wp' ); ?>" value="<?php echo esc_attr( $opts['subscriber_tags'] ); ?>" />
			<p class="help">
				<?php echo esc_html__( 'The listed tags will be applied to all subscribers added or updated by this form.', 'zozoema-for-wp' ); ?>
				<?php echo esc_html__( 'Separate multiple values with a comma.', 'zozoema-for-wp' ); ?>
			</p>

		</td>
	</tr>

	<?php
	/** @ignore */
	do_action( 'ema4wp_admin_form_after_zozoema_settings_rows', $opts, $form );
	?>

</table>

<div class="medium-margin"></div>

<h3><?php echo esc_html__( 'Form behaviour', 'zozoema-for-wp' ); ?></h3>

<table class="form-table" style="table-layout: fixed;">

	<?php
	/** @ignore */
	do_action( 'ema4wp_admin_form_before_behaviour_settings_rows', $opts, $form );
	?>

	<tr valign="top">
		<th scope="row"><?php echo esc_html__( 'Hide form after a successful sign-up?', 'zozoema-for-wp' ); ?></th>
		<td class="nowrap">
			<label>
				<input type="radio" name="ema4wp_form[settings][hide_after_success]" value="1" <?php checked( $opts['hide_after_success'], 1 ); ?> />&rlm;
				<?php echo esc_html__( 'Yes', 'zozoema-for-wp' ); ?>
			</label> &nbsp;
			<label>
				<input type="radio" name="ema4wp_form[settings][hide_after_success]" value="0" <?php checked( $opts['hide_after_success'], 0 ); ?> />&rlm;
				<?php echo esc_html__( 'No', 'zozoema-for-wp' ); ?>
			</label>
			<p class="help">
				<?php echo esc_html__( 'Select "yes" to hide the form fields after a successful sign-up.', 'zozoema-for-wp' ); ?>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="ema4wp_form_redirect"><?php echo esc_html__( 'Redirect to URL after successful sign-ups', 'zozoema-for-wp' ); ?></label></th>
		<td>
			<input type="text" class="widefat" name="ema4wp_form[settings][redirect]" id="ema4wp_form_redirect" placeholder="<?php echo sprintf( esc_attr__( 'Example: %s', 'zozoema-for-wp' ), esc_attr( site_url( '/thank-you/' ) ) ); ?>" value="<?php echo esc_attr( $opts['redirect'] ); ?>" />
			<p class="help">
				<?php echo wp_kses( __( 'Leave empty or enter <code>0</code> for no redirect. Otherwise, use complete (absolute) URLs, including <code>http://</code>.', 'zozoema-for-wp' ), array( 'code' => array() ) ); ?>
			</p>
			<p class="help">
				<?php echo esc_html__( 'Your "subscribed" message will not show when redirecting to another page, so make sure to let your visitors know they were successfully subscribed.', 'zozoema-for-wp' ); ?>
			</p>

		</td>
	</tr>

	<?php
	/** @ignore */
	do_action( 'ema4wp_admin_form_after_behaviour_settings_rows', $opts, $form );
	?>

</table>

<?php submit_button(); ?>
