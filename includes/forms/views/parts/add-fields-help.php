<?php defined( 'ABSPATH' ) or exit; ?>

<div class="ema4wp-admin">
	<h2><?php echo esc_html__( 'Add more fields', 'zozoema-for-wp' ); ?></h2>

	<div class="help-text">

		<p>
			<?php echo esc_html__( 'To add more fields to your form, you will need to create those fields in ZozoEMA first.', 'zozoema-for-wp' ); ?>
		</p>

		<p><strong><?php echo esc_html__( "Here's how:", 'zozoema-for-wp' ); ?></strong></p>

		<ol>
			<li>
				<p>
					<?php echo esc_html__( 'Log in to your ZozoEMA account.', 'zozoema-for-wp' ); ?>
				</p>
			</li>
			<li>
				<p>
					<?php echo esc_html__( 'Add list fields to any of your selected lists.', 'zozoema-for-wp' ); ?>
					<?php echo esc_html__( 'Clicking the following links will take you to the right screen.', 'zozoema-for-wp' ); ?>
				</p>
				<ul class="children lists--only-selected">
					<?php
					foreach ( $lists as $list ) {
						?>
					<li data-list-id="<?php echo $list->uid; ?>" style="display: <?php echo in_array( $list->uid, $opts['lists'] ) ? '' : 'none'; ?>">
						<a href="https://admin.zozoema.com/lists/settings/merge-tags?id=<?php echo $list->web_id; ?>">
							<span class="screen-reader-text"><?php echo esc_html__( 'Edit list fields for', 'zozoema-for-wp' ); ?> </span>
							<?php echo $list->name; ?>
						</a>
					</li>
						<?php
					}
					?>
				</ul>
			</li>
			<li>
				<p>
					<?php echo esc_html__( 'Click the following button to have ZozoEMA for WordPress pick up on your changes.', 'zozoema-for-wp' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_attr( add_query_arg( array( '_ema4wp_action' => 'empty_lists_cache' ) ) ); ?>">
						<?php echo esc_html__( 'Renew ZozoEMA lists', 'zozoema-for-wp' ); ?>
					</a>
				</p>
			</li>
		</ol>


	</div>
</div>
