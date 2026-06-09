<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RPB_Progress_Bar {

	private $options;

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_action( 'wp_footer', array( $this, 'render_progress_bar' ) );
	}

	public function enqueue_assets() {
		if ( ! $this->should_display() ) {
			return;
		}

		wp_enqueue_style(
			'rpb-style',
			RPB_PLUGIN_URL . 'assets/css/style.css',
			array(),
			RPB_VERSION
		);

		wp_enqueue_script(
			'rpb-script',
			RPB_PLUGIN_URL . 'assets/js/progress-bar.js',
			array(),
			RPB_VERSION,
			true
		);
	}

	public function render_progress_bar() {
		if ( ! $this->should_display() ) {
			return;
		}

		$this->options = get_option( 'rpb_settings' );
		
		$position = isset( $this->options['position'] ) ? $this->options['position'] : 'top';
		$height   = isset( $this->options['height'] ) ? $this->options['height'] : '5';
		$color    = isset( $this->options['color'] ) ? $this->options['color'] : '#0073aa';
		$bg_color = isset( $this->options['bg_color'] ) ? $this->options['bg_color'] : '#f1f1f1';

		include RPB_PLUGIN_DIR . 'templates/progress-bar.php';
	}

	public function should_display() {
		$options = get_option( 'rpb_settings' );
		
		if ( ! isset( $options['enable'] ) || '1' !== $options['enable'] ) {
			return false;
		}

		if ( is_front_page() || is_home() ) {
			return false;
		}

		if ( is_singular( 'post' ) && isset( $options['enable_posts'] ) && '1' === $options['enable_posts'] ) {
			return true;
		}

		if ( is_singular( 'page' ) && isset( $options['enable_pages'] ) && '1' === $options['enable_pages'] ) {
			return true;
		}

		if ( is_singular() && ! is_singular( array( 'post', 'page' ) ) && isset( $options['enable_cpt'] ) && '1' === $options['enable_cpt'] ) {
			return true;
		}

		return false;
	}
}