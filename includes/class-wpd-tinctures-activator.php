<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.wpdispensary.com
 * @since      1.0.0
 *
 * @package    WPD_Tinctures
 * @subpackage WPD_Tinctures/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    WPD_Tinctures
 * @subpackage WPD_Tinctures/includes
 * @author     WP Dispensary <deviodigital@gmail.com>
 */
class WPD_Tinctures_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		wp_dispensary_tinctures();
		wp_dispensary_tinctures_category();

		/**
		 * Flush Rewrite Rules
		 */
		global $wp_rewrite;
		$wp_rewrite->init();
		$wp_rewrite->flush_rules();

	}

}
