<?php
/**
 * Admin-specific functionality.
 *
 * @package PWMP_Plugin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class Pwmp_Admin
 */
class Pwmp_Admin {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	private $version;

	/**
	 * Option group / option name for settings.
	 *
	 * @var string
	 */
	const OPTION_GROUP = 'pwmp_settings_group';
	const OPTION_NAME  = 'pwmp_settings';

	/**
	 * Constructor.
	 *
	 * @param string $version Plugin version.
	 */
	public function __construct( $version ) {
		$this->version = $version;
	}

	/**
	 * Add admin menu page.
	 */
	public function add_menu_page() {
		add_options_page(
			__( 'PWMP Plugin', 'pwmp-plugin' ),
			__( 'Pressure Washing Marketing Pros', 'pwmp-plugin' ),
			'manage_options',
			'pwmp-plugin',
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Register settings with the Settings API.
	 */
	public function register_settings() {
		register_setting(
			self::OPTION_GROUP,
			self::OPTION_NAME,
			array(
				'type'              => 'array',
				'sanitize_callback' => array( $this, 'sanitize_settings' ),
			)
		);

		add_settings_section(
			'pwmp_main_section',
			__( 'General Settings', 'pwmp-plugin' ),
			array( $this, 'render_section_callback' ),
			'pwmp-plugin'
		);

		add_settings_field(
			'pwmp_sample_field',
			__( 'Sample Option', 'pwmp-plugin' ),
			array( $this, 'render_sample_field' ),
			'pwmp-plugin',
			'pwmp_main_section',
			array( 'label_for' => 'pwmp_sample_option' )
		);
	}

	/**
	 * Sanitize settings before save.
	 *
	 * @param array $input Raw input.
	 * @return array
	 */
	public function sanitize_settings( $input ) {
		$sanitized = array();

		if ( ! empty( $input['sample_option'] ) ) {
			$sanitized['sample_option'] = sanitize_text_field( $input['sample_option'] );
		} else {
			$sanitized['sample_option'] = '';
		}

		return $sanitized;
	}

	/**
	 * Section description.
	 */
	public function render_section_callback() {
		echo '<p>' . esc_html__( 'Configure Pressure Washing Marketing Pros options below.', 'pwmp-plugin' ) . '</p>';
	}

	/**
	 * Render sample settings field.
	 */
	public function render_sample_field() {
		$options = get_option( self::OPTION_NAME, array() );
		$value   = isset( $options['sample_option'] ) ? $options['sample_option'] : '';
		?>
		<input type="text"
			id="pwmp_sample_option"
			name="<?php echo esc_attr( self::OPTION_NAME ); ?>[sample_option]"
			value="<?php echo esc_attr( $value ); ?>"
			class="regular-text"
		/>
		<?php
	}

	/**
	 * Render the settings page.
	 */
	public function render_settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error(
				'pwmp_messages',
				'pwmp_message',
				__( 'Settings saved.', 'pwmp-plugin' ),
				'success'
			);
		}

		settings_errors( 'pwmp_messages' );
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
				<?php
				settings_fields( self::OPTION_GROUP );
				do_settings_sections( 'pwmp-plugin' );
				submit_button( __( 'Save Settings', 'pwmp-plugin' ) );
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Enqueue admin styles.
	 *
	 * @param string $hook_suffix Current admin page hook.
	 */
	public function enqueue_styles( $hook_suffix ) {
		if ( 'settings_page_pwmp-plugin' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style(
			'pwmp-admin',
			PWMP_PLUGIN_URL . 'admin/css/admin.css',
			array(),
			$this->version
		);
	}

	/**
	 * Enqueue admin scripts.
	 *
	 * @param string $hook_suffix Current admin page hook.
	 */
	public function enqueue_scripts( $hook_suffix ) {
		if ( 'settings_page_pwmp-plugin' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_script(
			'pwmp-admin',
			PWMP_PLUGIN_URL . 'admin/js/admin.js',
			array( 'jquery' ),
			$this->version,
			true
		);

		wp_localize_script( 'pwmp-admin', 'pwmpAdmin', array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'pwmp_admin_nonce' ),
		) );
	}
}
