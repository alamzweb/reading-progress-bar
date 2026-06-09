<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RPB_Shortcode {

	public function __construct() {
		add_shortcode( 'reading_progress_bar', array( $this, 'render_shortcode' ) );
	}

	public function render_shortcode( $atts ) {
		$options = get_option( 'rpb_settings' );
		
		$height   = isset( $options['height'] ) ? $options['height'] : '5';
		$color    = isset( $options['color'] ) ? $options['color'] : '#0073aa';
		$bg_color = isset( $options['bg_color'] ) ? $options['bg_color'] : '#f1f1f1';

		wp_enqueue_style( 'rpb-style', RPB_PLUGIN_URL . 'assets/css/style.css', array(), RPB_VERSION );
		wp_enqueue_script( 'rpb-script', RPB_PLUGIN_URL . 'assets/js/progress-bar.js', array(), RPB_VERSION, true );

		ob_start();
		?>
		<div class="rpb-container rpb-inline" style="background-color: <?php echo esc_attr( $bg_color ); ?>; height: <?php echo esc_attr( $height ); ?>px; position: relative;">
			<div class="rpb-bar" style="background-color: <?php echo esc_attr( $color ); ?>; width: 0%; height: 100%;"></div>
		</div>
		<?php
		return ob_get_clean();
	}
}