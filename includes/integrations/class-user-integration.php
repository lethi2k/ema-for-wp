<?php

defined('ABSPATH') or exit;

/**
 * Class EMA4WP_User_Integration
 *
 * @access public
 * @since 2.0
 */
abstract class EMA4WP_User_Integration extends EMA4WP_Integration
{


	/**
	 * @param WP_User $user
	 *
	 * @return array
	 */
	protected function user_merge_vars(WP_User $user)
	{

		// start with user_login as name, since that's always known
		$data = array(
			'EMAIL' => $user->user_email,
			'NAME'  => $user->user_login,
		);

		if ('' !== $user->first_name) {
			$data['NAME']  = $user->first_name;
			$data['FIRST_NAME'] = $user->first_name;
		}

		if ('' !== $user->last_name) {
			$data['LAST_NAME'] = $user->last_name;
		}

		if ('' !== $user->first_name && '' !== $user->last_name) {
			$data['NAME'] = sprintf('%s %s', $user->first_name, $user->last_name);
		}

		/**
		 * @since 3.0
		 * @deprecated 4.0
		 * @ignore
		 */
		$data = (array) apply_filters('ema4wp_user_merge_vars', $data, $user);

		return $data;
	}
}
