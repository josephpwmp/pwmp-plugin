<?php
/**
 * Public-facing functionality.
 *
 * @package PWMP_Plugin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class Pwmp_Public
 */
class Pwmp_Public {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	private $version;

	/**
	 * Constructor.
	 *
	 * @param string $version Plugin version.
	 */
	public function __construct( $version ) {
		$this->version = $version;
	}

	/**
	 * Enqueue public styles.
	 */
	public function enqueue_styles() {
		wp_enqueue_style(
			'pwmp-public',
			PWMP_PLUGIN_URL . 'public/css/public.css',
			array(),
			$this->version
		);
	}

	/**
	 * Enqueue public scripts.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			'pwmp-public',
			PWMP_PLUGIN_URL . 'public/js/public.js',
			array( 'jquery' ),
			$this->version,
			true
		);
	}
}
