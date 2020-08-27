<h3><?php echo esc_html__( 'Your Zozo EMA Account', 'zozoema-for-wp' ); ?></h3>
<p><?php echo esc_html__( 'The table below shows your ZozoEMA lists and their details. If you just applied changes to your ZozoEMA lists, please use the following button to renew the cached lists configuration.', 'zozoema-for-wp' ); ?></p>


<div id="ema4wp-list-fetcher">
	<form method="post" action="">
		<input type="hidden" name="_ema4wp_action" value="empty_lists_cache" />

		<p>
			<input type="submit" value="<?php echo esc_html__( 'Renew ZozoEMA lists', 'zozoema-for-wp' ); ?>" class="button" />
		</p>
	</form>
</div>

<div class="ema4wp-lists-overview">
	<?php
	if ( empty( $lists ) ) {
		?>
		<p><?php echo esc_html__( 'No lists were found in your ZozoEMA account', 'zozoema-for-wp' ); ?>.</p>
		<?php
	} else {
		echo sprintf( '<p>' . esc_html__( 'A total of %d lists were found in your ZozoEMA account.', 'zozoema-for-wp' ) . '</p>', count( $lists ) );

		echo '<table class="widefat striped" id="ema4wp-zozoema-lists-overview">';

		$headings = array(
			esc_html__( 'List Name', 'zozoema-for-wp' ),
			esc_html__( 'ID', 'zozoema-for-wp' ),
			esc_html__( 'Email Subscribers', 'zozoema-for-wp' ),
		);

		echo '<thead>';
		echo '<tr>';
		foreach ( $headings as $heading ) {
			echo sprintf( '<th>%s</th>', $heading );
		}
		echo '</tr>';
		echo '</thead>';

		foreach ( $lists as $list ) {
			echo '<tr>';
            echo sprintf( '<td><a href="#" class="ema4wp-zozoema-list" data-list-id="%s">%s</a><span class="row-actions alignright"></span></td>', esc_attr( $list->uid ), esc_html( $list->name ) );
            echo sprintf( '<td><code>%s</code></td>', esc_html( $list->uid ) );
            echo sprintf( '<td>%s </td>', esc_html( $list->default_subject ) );
            echo '</tr>';

            echo sprintf( '<tr class="list-details list-%s-details" style="display: none;">', $list->uid );
            echo '<td colspan="3" style="padding: 0 20px 40px;">';

            echo sprintf( '<p class="alignright" style="margin: 20px 0;"><a href="https://admin.zozoema.com/lists/members/?id=%s" target="_blank"><span class="dashicons dashicons-edit"></span> ' . esc_html__( 'Edit this list in ZozoEMA', 'zozoema-for-wp' ) . '</a></p>', $list->uid );
            echo '<div><div>', esc_html__( 'Loading... Please wait.', 'zozoema-for-wp' ) , '</div></div>';
            echo '</td>';
			echo '</tr>';
			?>
			<?php
		} // end foreach $lists
		echo '</table>';
	} // end if empty
	?>
</div>
