<?php
/**
 * Core plugin class.
 *
 * @package PWMP_Plugin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class Pwmp
 */
class Pwmp {

	/**
	 * The loader that's used to register hooks.
	 *
	 * @var Pwmp_Loader
	 */
	protected $loader;

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	protected $version;

	/**
	 * Initialize and run the plugin.
	 */
	public function __construct() {
		$this->version = PWMP_VERSION;
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load required dependencies.
	 */
	private function load_dependencies() {
		require_once PWMP_PLUGIN_DIR . 'includes/class-pwmp-loader.php';
		require_once PWMP_PLUGIN_DIR . 'admin/class-pwmp-admin.php';
		require_once PWMP_PLUGIN_DIR . 'public/class-pwmp-public.php';

		$this->loader = new Pwmp_Loader();
	}

	/**
	 * Register admin hooks.
	 */
	private function define_admin_hooks() {
		$admin = new Pwmp_Admin( $this->get_version() );

		$this->loader->add_action( 'admin_menu', $admin, 'add_menu_page' );
		$this->loader->add_action( 'admin_init', $admin, 'register_settings' );
		$this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_scripts' );
	}

	/**
	 * Register public-facing hooks.
	 */
	private function define_public_hooks() {
		$public = new Pwmp_Public( $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $public, 'enqueue_scripts' );
	}

	/**
	 * Run the loader.
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * Get plugin version.
	 *
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}
}
