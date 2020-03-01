<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/9kmmr
 * @since             1.0.0
 * @package           Wp_Gallery_Tube
 *
 * @wordpress-plugin
 * Plugin Name:       WP Video Gallery Tube
 * Plugin URI:        https://wordpress.org
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            yourmindhasgone
 * Author URI:        https://github.com/9kmmr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-gallery-tube
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_GALLERY_TUBE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-gallery-tube-activator.php
 */
function activate_wp_gallery_tube() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-gallery-tube-activator.php';
	Wp_Gallery_Tube_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-gallery-tube-deactivator.php
 */
function deactivate_wp_gallery_tube() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-gallery-tube-deactivator.php';
	Wp_Gallery_Tube_Deactivator::deactivate();
}
function uninstall_wp_gallery_tube(){

}

register_activation_hook( __FILE__, 'activate_wp_gallery_tube' );
register_deactivation_hook( __FILE__, 'deactivate_wp_gallery_tube' );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-gallery-tube.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_gallery_tube() {

	$plugin = new Wp_Gallery_Tube();
	$plugin->run();

}
run_wp_gallery_tube();
