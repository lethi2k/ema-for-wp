<?php defined( 'ABSPATH' ) or exit;
/** @var EMA4WP_Integration_Fixture[] $enabled_integrations */
/** @var EMA4WP_Integration_Fixture[] $available_integrations */
/** @var EMA4WP_Integration_Fixture $integration */
function _ema4wp_integrations_table_row( $integration ) {
	?>
	<tr style="
	<?php
	if ( ! $integration->is_installed() ) {
		echo 'opacity: 0.4;';
	}
	?>
	">

		<!-- Integration Name -->
		<td>

			<?php
			if ( $integration->is_installed() ) {
				echo sprintf( '<strong><a href="%s" title="%s">%s</a></strong>', esc_attr( add_query_arg( array( 'integration' => $integration->slug ) ) ), esc_html__( 'Configure this integration', 'zozoema-for-wp' ), $integration->name );
			} else {
				echo $integration->name;
			}
			?>


		</td>
		<td class="desc">
			<?php
			echo esc_html( $integration->description );
			?>
		</td>
		<td>
			<?php
			if ( $integration->enabled && $integration->is_installed() ) {
				echo '<span class="green">', esc_html__( 'Active', 'zozoema-for-wp' ), '</span>';
			} elseif ( $integration->is_installed() ) {
				echo '<span class="neutral">', esc_html__( 'Inactive', 'zozoema-for-wp' ), '</span>';
			} else {
				echo '<span class="red">', esc_html__( 'Not installed', 'zozoema-for-wp' ), '</span>';
			}
			?>
		</td>
	</tr>
	<?php
}

/**
 * Render a table with integrations
 *
 * @param $integrations
 * @ignore
 */
function _ema4wp_integrations_table( $integrations ) {
	?>
	<table class="ema4wp-table widefat striped">

		<thead>
		<tr>
			<th><?php echo esc_html__( 'Name', 'zozoema-for-wp' ); ?></th>
			<th><?php echo esc_html__( 'Description', 'zozoema-for-wp' ); ?></th>
			<th><?php echo esc_html__( 'Status', 'zozoema-for-wp' ); ?></th>
		</tr>
		</thead>

		<tbody>

		<?php
		// active & enabled integrations first
		foreach ( $integrations as $integration ) {
			if ( $integration->is_installed() && $integration->enabled ) {
				_ema4wp_integrations_table_row( $integration );
			}
		}

		// active & disabled integrations next
		foreach ( $integrations as $integration ) {
			if ( $integration->is_installed() && ! $integration->enabled ) {
				_ema4wp_integrations_table_row( $integration );
			}
		}

		// rest
		foreach ( $integrations as $integration ) {
			if ( ! $integration->is_installed() ) {
				_ema4wp_integrations_table_row( $integration );
			}
		}
		?>

		</tbody>
	</table>
	<?php
}
?>
<div id="ema4wp-admin" class="wrap ema4wp-settings">

	<p class="breadcrumbs">
		<span class="prefix"><?php echo esc_html__( 'You are here: ', 'zozoema-for-wp' ); ?></span>
		<a href="<?php echo admin_url( 'admin.php?page=zozoema-for-wp' ); ?>">ZozoEMA for WordPress</a> &rsaquo;
		<span class="current-crumb"><strong><?php echo esc_html__( 'Integrations', 'zozoema-for-wp' ); ?></strong></span>
	</p>

	<div class="main-content row">

		<!-- Main Content -->
		<div class="col col-4">

			<h1 class="page-title">Zozo EMA for WordPress: <?php echo esc_html__( 'Integrations', 'zozoema-for-wp' ); ?></h1>

			<h2 style="display: none;"></h2>
			<?php settings_errors(); ?>

			<p>
				<?php echo esc_html__( 'The table below shows all available integrations.', 'zozoema-for-wp' ); ?>
				<?php echo esc_html__( 'Click on the name of an integration to edit all settings specific to that integration.', 'zozoema-for-wp' ); ?>
			</p>

			<form action="<?php echo admin_url( 'options.php' ); ?>" method="post">

				<?php settings_fields( 'ema4wp_integrations_settings' ); ?>

				<h3><?php echo esc_html__( 'Integrations', 'zozoema-for-wp' ); ?></h3>
				<?php _ema4wp_integrations_table( $integrations ); ?>

				<p><?php echo esc_html__( 'Greyed out integrations will become available after installing & activating the corresponding plugin.', 'zozoema-for-wp' ); ?></p>


			</form>

		</div>

		<!-- Sidebar -->
		<div class="sidebar col col-2">
			<?php include EMA4WP_PLUGIN_DIR . '/includes/views/parts/admin-sidebar.php'; ?>
		</div>

	</div>

</div>
