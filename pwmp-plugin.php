<?php
/**
 * Plugin Name:       PWMP Plugin
 * Plugin URI:        https://example.com/pwmp-plugin
 * Description:       Pressure Washing Marketing Pros Plugin — marketing and business tools for pressure washing professionals.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Author:            Your Name
 * Author URI:        https://example.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pwmp-plugin
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) || exit;

define( 'PWMP_VERSION', '1.0.0' );
define( 'PWMP_PLUGIN_FILE', __FILE__ );
define( 'PWMP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PWMP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PWMP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Activation hook.
 */
function pwmp_activate() {
	require_once PWMP_PLUGIN_DIR . 'includes/class-pwmp-activator.php';
	Pwmp_Activator::activate();
}

/**
 * Deactivation hook.
 */
function pwmp_deactivate() {
	require_once PWMP_PLUGIN_DIR . 'includes/class-pwmp-deactivator.php';
	Pwmp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'pwmp_activate' );
register_deactivation_hook( __FILE__, 'pwmp_deactivate' );

/**
 * Bootstrap the plugin.
 */
require_once PWMP_PLUGIN_DIR . 'includes/class-pwmp.php';

function pwmp_run() {
	$plugin = new Pwmp();
	$plugin->run();
}

pwmp_run();
