<?php

$position_options = array(
	'after_email_field'               => __( 'After email field', 'zozoema-for-wp' ),
	'checkout_billing'                => __( 'After billing details', 'zozoema-for-wp' ),
	'checkout_shipping'               => __( 'After shipping details', 'zozoema-for-wp' ),
	'checkout_after_customer_details' => __( 'After customer details', 'zozoema-for-wp' ),
	'review_order_before_submit'      => __( 'Before submit button', 'zozoema-for-wp' ),
	'after_order_notes'               => __( 'After order notes', 'zozoema-for-wp' ),
);

if ( defined( 'CFW_NAME' ) ) {
	$position_options['cfw_checkout_before_payment_method_tab_nav'] = __( 'Checkout for WooCommerce: Before complete order button', 'zozoema-for-wp' );
	$position_options['cfw_checkout_after_login'] = __( 'Checkout for WooCommerce: After account info', 'zozoema-for-wp' );
	$position_options['cfw_checkout_after_customer_info_address'] = __( 'Checkout for WooCommerce: After customer info', 'zozoema-for-wp' );
}

/** @var EMA4WP_Integration $integration */

?>
<table class="form-table">
	<?php
	$config = array(
		'element' => 'ema4wp_integrations[' . $integration->slug . '][implicit]',
		'value'   => '0',
	);
	?>
	<tr valign="top" data-showif="<?php echo esc_attr( json_encode( $config ) ); ?>">
		<th scope="row">
			<?php _e( 'Position', 'zozoema-for-wp' ); ?>
		</th>
		<td>
			<select name="ema4wp_integrations[<?php echo $integration->slug; ?>][position]">
				<?php

				foreach ( $position_options as $value => $label ) {
					printf( '<option value="%s" %s>%s</option>', esc_attr( $value ), selected( $value, $opts['position'], false ), esc_html( $label ) );
				}
				?>

			</select>
		</td>
	</tr>
</table>
