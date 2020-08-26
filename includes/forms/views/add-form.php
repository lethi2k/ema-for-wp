<?php defined( 'ABSPATH' ) or exit; ?>
<div id="ema4wp-admin" class="wrap ema4wp-settings">

	<div class="row">

		<!-- Main Content -->
		<div class="main-content col col-4">

			<h1 class="page-title">
				<?php echo esc_html__( 'Add new form', 'zozoema-for-wp' ); ?>
			</h1>

			<h2 style="display: none;"></h2><?php // fake h2 for admin notices ?>

			<div style="max-width: 480px;">

				<!-- Wrap entire page in <form> -->
				<form method="post">

					<input type="hidden" name="_ema4wp_action" value="add_form" />
					<?php wp_nonce_field( 'add_form', '_ema4wp_nonce' ); ?>


					<div class="small-margin">
						<h3>
							<label>
								<?php echo esc_html__( 'What is the name of this form?', 'zozoema-for-wp' ); ?>
							</label>
						</h3>
						<input type="text" name="ema4wp_form[name]" class="widefat" value="" spellcheck="true" autocomplete="off" placeholder="<?php echo esc_attr__( 'Enter your form title..', 'zozoema-for-wp' ); ?>">
					</div>

					<div class="small-margin">

						<h3>
							<label>
								<?php echo esc_html__( 'To which ZozoEMA lists should this form subscribe?', 'zozoema-for-wp' ); ?>
							</label>
						</h3>

						<?php
						if ( ! empty( $lists ) ) {
							?>
						<ul id="ema4wp-lists">
							<?php
							foreach ( $lists as $list ) {
								?>
								<li>
									<label>
										<input type="checkbox" name="ema4wp_form[settings][lists][<?php echo esc_attr( $list->uid ); ?>]" value="<?php echo esc_attr( $list->uid ); ?>" <?php checked( $number_of_lists, 1 ); ?> >
										<?php echo esc_html( $list->name ); ?>
									</label>
								</li>
								<?php
							}
							?>
						</ul>
							<?php
						} else {
							?>
						<p class="ema4wp-notice">
							<?php echo sprintf( wp_kses( __( 'No lists found. Did you <a href="%s">connect with ZozoEMA</a>?', 'zozoema-for-wp' ), array( 'a' => array( 'href' => array() ) ) ), admin_url( 'admin.php?page=zozoema-for-wp' ) ); ?>
						</p>
							<?php
						}
						?>

					</div>

					<?php submit_button( esc_html__( 'Add new form', 'zozoema-for-wp' ) ); ?>


				</form><!-- Entire page form wrap -->

			</div>


			<?php include EMA4WP_PLUGIN_DIR . 'includes/views/parts/admin-footer.php'; ?>

		</div><!-- / Main content -->

		<!-- Sidebar -->
		<div class="sidebar col col-2">
			<?php include EMA4WP_PLUGIN_DIR . 'includes/views/parts/admin-sidebar.php'; ?>
		</div>


	</div>

</div>
