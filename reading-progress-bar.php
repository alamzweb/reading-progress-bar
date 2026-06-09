<?php
/**
 * Plugin Name:       Reading Progress Bar
 * Plugin URI:        https://sitecroftdev.vercel.app/plugins/reading-progress-bar
 * Description:       Display a customizable reading progress bar that tracks how far visitors have read through your content.
 * Version:           1.0.0
 * Author:            Saad
 * Author URI:        https://sitecroftdev.vercel.app/
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       reading-progress-bar
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants.
define( 'RPB_VERSION', '1.0.0' );
define( 'RPB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'RPB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'RPB_PLUGIN_BASELINE', __FILE__ );

// Include core plugin runner.
require_once RPB_PLUGIN_DIR . 'includes/class-plugin.php';

/**
 * Run the plugin activation lifecycle.
 */
function activate_reading_progress_bar() {
	$defaults = array(
		'enable'       => '1',
		'position'     => 'top',
		'height'       => '5',
		'color'        => '#0073aa',
		'bg_color'     => '#f1f1f1',
		'enable_posts' => '1',
		'enable_pages' => '0',
		'enable_cpt'   => '0',
	);

	if ( false === get_option( 'rpb_settings' ) ) {
		update_option( 'rpb_settings', $defaults );
	}
}
register_activation_hook( __FILE__, 'activate_reading_progress_bar' );

/**
 * Run the plugin deactivation lifecycle.
 */
function deactivate_reading_progress_bar() {
	// Intentionally left blank for potential future flush operations.
}
register_deactivation_hook( __FILE__, 'deactivate_reading_progress_bar' );

// Initialize the plugin orchestration engine.
function init_reading_progress_bar() {
	$plugin = new RPB_Plugin();
	$plugin->run();
}
init_reading_progress_bar();