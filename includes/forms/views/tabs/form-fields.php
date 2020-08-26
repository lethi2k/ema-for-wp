<?php add_thickbox(); ?>

<div class="alignright">
	<a href="#TB_inline?width=0&height=550&inlineId=ema4wp-form-variables" class="thickbox button-secondary">
		<span class="dashicons dashicons-info"></span>
		<?php echo esc_html__( 'Form variables', 'zozoema-for-wp' ); ?>
	</a>
	<a href="#TB_inline?width=600&height=400&inlineId=ema4wp-add-field-help" class="thickbox button-secondary">
		<span class="dashicons dashicons-editor-help"></span>
		<?php echo esc_html__( 'Add more fields', 'zozoema-for-wp' ); ?>
	</a>
</div>
<h2><?php echo esc_html__( 'Form Fields', 'zozoema-for-wp' ); ?></h2>

<!-- Placeholder for the field wizard -->
<div id="ema4wp-field-wizard"></div>

<div class="ema4wp-row">
	<div class="ema4wp-col ema4wp-col-3 ema4wp-form-editor-wrap">
		<h4 style="margin: 0"><label><?php echo esc_html__( 'Form code', 'zozoema-for-wp' ); ?></label></h4>
		<!-- Textarea for the actual form content HTML -->
		<textarea class="widefat" cols="160" rows="20" id="ema4wp-form-content" name="ema4wp_form[content]" placeholder="<?php echo esc_attr__( 'Enter the HTML code for your form fields..', 'zozoema-for-wp' ); ?>" autocomplete="false" autocorrect="false" autocapitalize="false" spellcheck="false"><?php echo htmlspecialchars( $form->content, ENT_QUOTES, get_option( 'blog_charset' ) ); ?></textarea>
	</div>
	<div class="ema4wp-col ema4wp-col-3 ema4wp-form-preview-wrap">
		<h4 style="margin: 0;">
			<label><?php echo esc_html__( 'Form preview', 'zozoema-for-wp' ); ?>
			<span class="ema4wp-tooltip dashicons dashicons-editor-help" title="<?php echo esc_attr__( 'The form may look slightly different than this when shown in a post, page or widget area.', 'zozoema-for-wp' ); ?>"></span>
			</label>
		</h4>
		<iframe id="ema4wp-form-preview" src="<?php echo esc_attr( $form_preview_url ); ?>"></iframe>
	</div>
</div>


<!-- This field is updated by JavaScript as the form content changes -->
<input type="hidden" id="required-fields" name="ema4wp_form[settings][required_fields]" value="<?php echo esc_attr( $form->settings['required_fields'] ); ?>" />

<?php submit_button(); ?>

<p class="ema4wp-form-usage"><?php printf( esc_html__( 'Use the shortcode %s to display this form inside a post, page or text widget.', 'zozoema-for-wp' ), '<input type="text" onfocus="this.select();" readonly="readonly" value="' . esc_attr( sprintf( '[ema4wp_form id="%d"]', $form->ID ) ) . '" size="' . ( strlen( $form->ID ) + 18 ) . '">' ); ?></p>


<?php // Content for Thickboxes ?>
<div id="ema4wp-form-variables" style="display: none;">
	<?php include __DIR__ . '/../parts/dynamic-content-tags.php'; ?>
</div>

<div id="ema4wp-add-field-help" style="display: none;">
	<?php include __DIR__ . '/../parts/add-fields-help.php'; ?>
</div>
