<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RPB_Gutenberg_Block {

	public function __construct() {
		add_action( 'init', array( $this, 'register_block' ) );
	}

	public function register_block() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		wp_register_script(
			'rpb-block-editor',
			RPB_PLUGIN_URL . 'assets/js/progress-bar.js', 
			array( 'wp-blocks', 'wp-element' ),
			RPB_VERSION
		);

		register_block_type( 'reading-progress-bar/block', array(
			'editor_script'   => 'rpb-block-editor',
			'render_callback' => array( $this, 'render_block_fallback' )
		));
	}

	public function render_block_fallback( $attributes, $content ) {
		$options = get_option( 'rpb_settings' );
		
		$height   = isset( $options['height'] ) ? $options['height'] : '5';
		$color    = isset( $options['color'] ) ? $options['color'] : '#0073aa';
		$bg_color = isset( $options['bg_color'] ) ? $options['bg_color'] : '#f1f1f1';

		wp_enqueue_style( 'rpb-style', RPB_PLUGIN_URL . 'assets/css/style.css', array(), RPB_VERSION );
		wp_enqueue_script( 'rpb-script', RPB_PLUGIN_URL . 'assets/js/progress-bar.js', array(), RPB_VERSION, true );

		return '<div class="rpb-container rpb-inline" style="background-color: ' . esc_attr( $bg_color ) . '; height: ' . esc_attr( $height ) . 'px; position: relative;"><div class="rpb-bar" style="background-color: ' . esc_attr( $color ) . '; width: 0%; height: 100%;"></div></div>';
	}
}