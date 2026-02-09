<?php
/**
 * Fired during plugin activation.
 *
 * @package PWMP_Plugin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class Pwmp_Activator
 */
class Pwmp_Activator {

	/**
	 * Run on plugin activation.
	 * Create options, flush rewrite rules, etc.
	 */
	public static function activate() {
		// Set default options if needed.
		$defaults = array(
			'version'       => PWMP_VERSION,
			'sample_option' => '',
		);

		if ( false === get_option( 'pwmp_settings', false ) ) {
			add_option( 'pwmp_settings', $defaults );
		}

		flush_rewrite_rules();
	}
}
