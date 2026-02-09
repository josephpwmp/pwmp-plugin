<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package PWMP_Plugin
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

// Delete plugin options (optional - remove if you want to keep data).
delete_option( 'pwmp_settings' );

// For multisite: delete from all sites.
if ( is_multisite() ) {
	global $wpdb;
	$blog_ids = $wpdb->get_col( "SELECT blog_id FROM {$wpdb->blogs}" );
	foreach ( $blog_ids as $blog_id ) {
		switch_to_blog( $blog_id );
		delete_option( 'pwmp_settings' );
		restore_current_blog();
	}
}
