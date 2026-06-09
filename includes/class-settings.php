<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RPB_Settings {

	private $options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	public function add_plugin_page() {
		add_options_page(
			__( 'Reading Progress Bar Settings', 'reading-progress-bar' ),
			__( 'Reading Progress Bar', 'reading-progress-bar' ),
			'manage_options',
			'reading-progress-bar',
			array( $this, 'create_admin_page' )
		);
	}

	public function create_admin_page() {
		$this->options = get_option( 'rpb_settings' );
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'rpb_option_group' );
				do_settings_sections( 'reading-progress-bar-admin' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	public function page_init() {
		register_setting(
			'rpb_option_group',
			'rpb_settings',
			array( $this, 'sanitize' )
		);

		add_settings_section(
			'rpb_setting_section_id',
			__( 'Display & Configuration Settings', 'reading-progress-bar' ),
			null,
			'reading-progress-bar-admin'
		);

		add_settings_field(
			'enable',
			__( 'Enable Progress Bar globally', 'reading-progress-bar' ),
			array( $this, 'enable_callback' ),
			'reading-progress-bar-admin',
			'rpb_setting_section_id'
		);

		add_settings_field(
			'position',
			__( 'Bar Position', 'reading-progress-bar' ),
			array( $this, 'position_callback' ),
			'reading-progress-bar-admin',
			'rpb_setting_section_id'
		);

		add_settings_field(
			'height',
			__( 'Bar Height (px)', 'reading-progress-bar' ),
			array( $this, 'height_callback' ),
			'reading-progress-bar-admin',
			'rpb_setting_section_id'
		);

		add_settings_field(
			'color',
			__( 'Progress Bar Color', 'reading-progress-bar' ),
			array( $this, 'color_callback' ),
			'reading-progress-bar-admin',
			'rpb_setting_section_id'
		);

		add_settings_field(
			'bg_color',
			__( 'Background Track Color', 'reading-progress-bar' ),
			array( $this, 'bg_color_callback' ),
			'reading-progress-bar-admin',
			'rpb_setting_section_id'
		);

		add_settings_field(
			'post_types',
			__( 'Enable tracking for Post Types', 'reading-progress-bar' ),
			array( $this, 'post_types_callback' ),
			'reading-progress-bar-admin',
			'rpb_setting_section_id'
		);
	}

	public function sanitize( $input ) {
		$new_input = array();

		$new_input['enable']       = isset( $input['enable'] ) ? '1' : '0';
		$new_input['position']     = in_array( $input['position'], array( 'top', 'bottom' ), true ) ? $input['position'] : 'top';
		$new_input['height']       = absint( $input['height'] );
		$new_input['color']        = sanitize_hex_color( $input['color'] );
		$new_input['bg_color']     = sanitize_hex_color( $input['bg_color'] );
		$new_input['enable_posts'] = isset( $input['enable_posts'] ) ? '1' : '0';
		$new_input['enable_pages'] = isset( $input['enable_pages'] ) ? '1' : '0';
		$new_input['enable_cpt']   = isset( $input['enable_cpt'] ) ? '1' : '0';

		return $new_input;
	}

	public function enable_callback() {
		$value = isset( $this->options['enable'] ) ? $this->options['enable'] : '0';
		echo '<input type="checkbox" id="enable" name="rpb_settings[enable]" value="1" ' . checked( '1', $value, false ) . ' />';
	}

	public function position_callback() {
		$value = isset( $this->options['position'] ) ? $this->options['position'] : 'top';
		echo '<select id="position" name="rpb_settings[position]">';
		echo '<option value="top" ' . selected( $value, 'top', false ) . '>' . esc_html__( 'Top of screen', 'reading-progress-bar' ) . '</option>';
		echo '<option value="bottom" ' . selected( $value, 'bottom', false ) . '>' . esc_html__( 'Bottom of screen', 'reading-progress-bar' ) . '</option>';
		echo '</select>';
	}

	public function height_callback() {
		$value = isset( $this->options['height'] ) ? $this->options['height'] : '5';
		echo '<input type="number" id="height" name="rpb_settings[height]" value="' . esc_attr( $value ) . '" min="1" max="50" style="width: 80px;" /> px';
	}

	public function color_callback() {
		$value = isset( $this->options['color'] ) ? $this->options['color'] : '#0073aa';
		echo '<input type="color" id="color" name="rpb_settings[color]" value="' . esc_attr( $value ) . '" />';
	}

	public function bg_color_callback() {
		$value = isset( $this->options['bg_color'] ) ? $this->options['bg_color'] : '#f1f1f1';
		echo '<input type="color" id="bg_color" name="rpb_settings[bg_color]" value="' . esc_attr( $value ) . '" />';
	}

	public function post_types_callback() {
		$posts = isset( $this->options['enable_posts'] ) ? $this->options['enable_posts'] : '0';
		$pages = isset( $this->options['enable_pages'] ) ? $this->options['enable_pages'] : '0';
		$cpts  = isset( $this->options['enable_cpt'] ) ? $this->options['enable_cpt'] : '0';

		echo '<label><input type="checkbox" name="rpb_settings[enable_posts]" value="1" ' . checked( '1', $posts, false ) . ' /> ' . esc_html__( 'Posts', 'reading-progress-bar' ) . '</label><br/>';
		echo '<label><input type="checkbox" name="rpb_settings[enable_pages]" value="1" ' . checked( '1', $pages, false ) . ' /> ' . esc_html__( 'Pages', 'reading-progress-bar' ) . '</label><br/>';
		echo '<label><input type="checkbox" name="rpb_settings[enable_cpt]" value="1" ' . checked( '1', $cpts, false ) . ' /> ' . esc_html__( 'Custom Post Types', 'reading-progress-bar' ) . '</label>';
	}
}