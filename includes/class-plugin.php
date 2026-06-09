<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RPB_Plugin {

	/**
	 * Initialize and load dependencies.
	 */
	public function __construct() {
		$this->load_dependencies();
	}

	/**
	 * Include internal class structures.
	 */
	private function load_dependencies() {
		require_once RPB_PLUGIN_DIR . 'includes/class-settings.php';
		require_once RPB_PLUGIN_DIR . 'includes/class-progress-bar.php';
		require_once RPB_PLUGIN_DIR . 'includes/class-shortcode.php';
		require_once RPB_PLUGIN_DIR . 'includes/class-gutenberg-block.php';
	}

	/**
	 * Fire all necessary WordPress Hooks.
	 */
	public function run() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		// Instantiate modules
		new RPB_Settings();
		new RPB_Progress_Bar();
		new RPB_Shortcode();
		new RPB_Gutenberg_Block();
	}

	/**
	 * Enable multi-language translations.
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'reading-progress-bar',
			false,
			dirname( plugin_basename( RPB_PLUGIN_BASELINE ) ) . '/languages'
		);
	}
}