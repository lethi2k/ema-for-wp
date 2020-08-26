<?php defined( 'ABSPATH' ) or exit;

/** @var EMA4WP_Form $form */
?>

<h2><?php echo esc_html__( 'Form Messages', 'zozoema-for-wp' ); ?></h2>

<table class="form-table ema4wp-form-messages">

	<?php
	/** @ignore */
	do_action( 'ema4wp_admin_form_before_messages_settings_rows', $opts, $form );
	?>

	<tr valign="top">
		<th scope="row"><label for="ema4wp_form_subscribed"><?php echo esc_html__( 'Successfully subscribed', 'zozoema-for-wp' ); ?></label></th>
		<td>
			<input type="text" class="widefat" id="ema4wp_form_subscribed" name="ema4wp_form[messages][subscribed]" value="<?php echo esc_attr( $form->messages['subscribed'] ); ?>" />
			<p class="help"><?php echo esc_html__( 'The text that shows when an email address is successfully subscribed to the selected list(s).', 'zozoema-for-wp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="ema4wp_form_invalid_email"><?php echo esc_html__( 'Invalid email address', 'zozoema-for-wp' ); ?></label></th>
		<td>
			<input type="text" class="widefat" id="ema4wp_form_invalid_email" name="ema4wp_form[messages][invalid_email]" value="<?php echo esc_attr( $form->messages['invalid_email'] ); ?>" required />
			<p class="help"><?php echo esc_html__( 'The text that shows when an invalid email address is given.', 'zozoema-for-wp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="ema4wp_form_required_field_missing"><?php echo esc_html__( 'Required field missing', 'zozoema-for-wp' ); ?></label></th>
		<td>
			<input type="text" class="widefat" id="ema4wp_form_required_field_missing" name="ema4wp_form[messages][required_field_missing]" value="<?php echo esc_attr( $form->messages['required_field_missing'] ); ?>" required />
			<p class="help"><?php echo esc_html__( 'The text that shows when a required field for the selected list(s) is missing.', 'zozoema-for-wp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="ema4wp_form_already_subscribed"><?php echo esc_html__( 'Already subscribed', 'zozoema-for-wp' ); ?></label></th>
		<td>
			<input type="text" class="widefat" id="ema4wp_form_already_subscribed" name="ema4wp_form[messages][already_subscribed]" value="<?php echo esc_attr( $form->messages['already_subscribed'] ); ?>" required />
			<p class="help"><?php echo esc_html__( 'The text that shows when the given email is already subscribed to the selected list(s).', 'zozoema-for-wp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="ema4wp_form_error"><?php echo esc_html__( 'General error', 'zozoema-for-wp' ); ?></label></th>
		<td>
			<input type="text" class="widefat" id="ema4wp_form_error" name="ema4wp_form[messages][error]" value="<?php echo esc_attr( $form->messages['error'] ); ?>" required />
			<p class="help"><?php echo esc_html__( 'The text that shows when a general error occured.', 'zozoema-for-wp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="ema4wp_form_unsubscribed"><?php echo esc_html__( 'Unsubscribed', 'zozoema-for-wp' ); ?></label></th>
		<td>
			<input type="text" class="widefat" id="ema4wp_form_unsubscribed" name="ema4wp_form[messages][unsubscribed]" value="<?php echo esc_attr( $form->messages['unsubscribed'] ); ?>" required />
			<p class="help"><?php echo esc_html__( 'When using the unsubscribe method, this is the text that shows when the given email address is successfully unsubscribed from the selected list(s).', 'zozoema-for-wp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="ema4wp_form_not_subscribed"><?php echo esc_html__( 'Not subscribed', 'zozoema-for-wp' ); ?></label></th>
		<td>
			<input type="text" class="widefat" id="ema4wp_form_not_subscribed" name="ema4wp_form[messages][not_subscribed]" value="<?php echo esc_attr( $form->messages['not_subscribed'] ); ?>" required />
			<p class="help"><?php echo esc_html__( 'When using the unsubscribe method, this is the text that shows when the given email address is not on the selected list(s).', 'zozoema-for-wp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label for="ema4wp_form_no_lists_selected"><?php echo esc_html__( 'No list selected', 'zozoema-for-wp' ); ?></label></th>
		<td>
			<input type="text" class="widefat" id="ema4wp_form_no_lists_selected" name="ema4wp_form[messages][no_lists_selected]" value="<?php echo esc_attr( $form->messages['no_lists_selected'] ); ?>" required />
			<p class="help"><?php echo esc_html__( 'When offering a list choice, this is the text that shows when no lists were selected.', 'zozoema-for-wp' ); ?></p>
		</td>
	</tr>

	<?php
	$config = array(
		'element' => 'ema4wp_form[settings][update_existing]',
		'value'   => 1,
	);
	?>
	<tr valign="top" data-showif="<?php echo esc_attr( json_encode( $config ) ); ?>">
		<th scope="row"><label for="ema4wp_form_updated"><?php echo esc_html__( 'Updated', 'zozoema-for-wp' ); ?></label></th>
		<td>
			<input type="text" class="widefat" id="ema4wp_form_updated" name="ema4wp_form[messages][updated]" value="<?php echo esc_attr( $form->messages['updated'] ); ?>" />
			<p class="help"><?php echo esc_html__( 'The text that shows when an existing subscriber is updated.', 'zozoema-for-wp' ); ?></p>
		</td>
	</tr>

	<?php
	/** @ignore */
	do_action( 'ema4wp_admin_form_after_messages_settings_rows', array(), $form );
	?>

	<tr valign="top">
		<th></th>
		<td>
			<p class="help"><?php echo sprintf( esc_html__( 'HTML tags like %s are allowed in the message fields.', 'zozoema-for-wp' ), '<code>' . esc_html( '<strong><em><a>' ) . '</code>' ); ?></p>
		</td>
	</tr>

</table>

<?php submit_button(); ?>
