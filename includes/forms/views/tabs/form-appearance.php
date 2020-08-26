<?php

$theme       = wp_get_theme();
$css_options = array(
	'0'                                     => sprintf( esc_html__( 'Inherit from %s theme', 'zozoema-for-wp' ), $theme->Name ),
	'basic'                                 => esc_html__( 'Basic', 'zozoema-for-wp' ),
	esc_html__( 'Form Themes', 'zozoema-for-wp' ) => array(
		'theme-light' => esc_html__( 'Light Theme', 'zozoema-for-wp' ),
		'theme-dark'  => esc_html__( 'Dark Theme', 'zozoema-for-wp' ),
		'theme-red'   => esc_html__( 'Red Theme', 'zozoema-for-wp' ),
		'theme-green' => esc_html__( 'Green Theme', 'zozoema-for-wp' ),
		'theme-blue'  => esc_html__( 'Blue Theme', 'zozoema-for-wp' ),
	),
);

/**
 * Filters the <option>'s in the "CSS Stylesheet" <select> box.
 *
 * @ignore
 */
$css_options = apply_filters( 'ema4wp_admin_form_css_options', $css_options );

?>

<h2><?php echo esc_html__( 'Form Appearance', 'zozoema-for-wp' ); ?></h2>

<table class="form-table">
	<tr valign="top">
		<th scope="row"><label for="ema4wp_load_stylesheet_select"><?php echo esc_html__( 'Form Style', 'zozoema-for-wp' ); ?></label></th>
		<td class="nowrap valigntop">
			<select name="ema4wp_form[settings][css]" id="ema4wp_load_stylesheet_select">

				<?php
				foreach ( $css_options as $key => $option ) {
					if ( is_array( $option ) ) {
						$label   = $key;
						$options = $option;
						printf( '<optgroup label="%s">', $label );
						foreach ( $options as $key => $option ) {
							printf( '<option value="%s" %s>%s</option>', $key, selected( $opts['css'], $key, false ), $option );
						}
						print( '</optgroup>' );
					} else {
						printf( '<option value="%s" %s>%s</option>', $key, selected( $opts['css'], $key, false ), $option );
					}
				}
				?>
			</select>
			<p class="help">
				<?php echo esc_html__( 'If you want to load some default CSS styles, select "basic formatting styles" or choose one of the color themes', 'zozoema-for-wp' ); ?>
			</p>
		</td>
	</tr>

	<?php
	/** @ignore */
	do_action( 'ema4wp_admin_form_after_appearance_settings_rows', $opts, $form );
	?>

</table>

<?php submit_button(); ?>
