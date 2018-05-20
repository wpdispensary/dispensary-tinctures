<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://www.wpdispensary.com
 * @since             1.0.0
 * @package           WPD_Tinctures
 *
 * @wordpress-plugin
 * Plugin Name:       WP Dispensary's Tinctures
 * Plugin URI:        https://www.wpdispensary.com/dispensary-tinctures-add-on
 * Description:       This plugin adds a Tinctures menu type to the WP Dispensary menu plugin. Brought to you by <a href="http://www.deviodigital.com/">Devio Digital</a> &amp; <a href="https://www.wpdispensary.com">WP Dispensary</a>.
 * Version:           1.1.1
 * Author:            WP Dispensary
 * Author URI:        http://www.wpdispensary.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpd-tinctures
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'WPD_TINCTURES_VERSION', '1.1.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpd-tinctures-activator.php
 */
function activate_wpd_tinctures() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpd-tinctures-activator.php';
	WPD_Tinctures_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpd-tinctures-deactivator.php
 */
function deactivate_wpd_tinctures() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpd-tinctures-deactivator.php';
	WPD_Tinctures_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpd_tinctures' );
register_deactivation_hook( __FILE__, 'deactivate_wpd_tinctures' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpd-tinctures.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpd_tinctures() {

	$plugin = new WPD_Tinctures();
	$plugin->run();

}
run_wpd_tinctures();
