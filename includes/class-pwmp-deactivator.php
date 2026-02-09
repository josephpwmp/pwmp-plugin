<?php
/**
 * Fired during plugin deactivation.
 *
 * @package PWMP_Plugin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class Pwmp_Deactivator
 */
class Pwmp_Deactivator {

	/**
	 * Run on plugin deactivation.
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}
}
