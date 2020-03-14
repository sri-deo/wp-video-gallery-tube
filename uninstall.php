<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://github.com/9kmmr
 * @since      1.0.0
 *
 * @package    Wp_Gallery_Tube
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/* DELETE DB WHEN UNINSTALL */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'wp-gallery-tube/includes/class-wp-gallery-tube-database.php';
$Wp_Gallery_Tube_Database = new Wp_Gallery_Tube_Database();
$Wp_Gallery_Tube_Database->gallery_tube_db_uninstall();


/** delete options */
delete_option('first_insert');
delete_option('plugin_permalinks_flushed');
delete_option("is_pages_created");


delete_option('wp_gallery_tube_gallery_page');
delete_option('wp_gallery_tube_studio_page');
delete_option('wp_gallery_tube_tag_page');
delete_option('wp_gallery_tube_pornstar_page');
delete_option('wp_gallery_tube_scene_page');


wp_delete_post(get_option('wp_gallery_tube_gallery_page'));
wp_delete_post(get_option('wp_gallery_tube_studio_page'));
wp_delete_post(get_option('wp_gallery_tube_tag_page'));
wp_delete_post(get_option('wp_gallery_tube_pornstar_page'));
wp_delete_post(get_option('wp_gallery_tube_scene_page'));


// flush rewrite rules after added 4 custom routes
flush_rewrite_rules();
