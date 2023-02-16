<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://socialcars.co.za
 * @since             1.0.0
 * @package           Dh_Social_Car_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       DH Social Car Plugin 
 * Plugin URI:        https://https://socialcars.co.za
 * Description:       Create social car plugin 
 * Version:           1.0.0
 * Author:            Team Socialcar
 * Author URI:        https://https://socialcars.co.za
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dh-social-car-plugin
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
define( 'DH_SOCIAL_CAR_PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dh-social-car-plugin-activator.php
 */
function activate_dh_social_car_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dh-social-car-plugin-activator.php';
	Dh_Social_Car_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dh-social-car-plugin-deactivator.php
 */
function deactivate_dh_social_car_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dh-social-car-plugin-deactivator.php';
	Dh_Social_Car_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dh_social_car_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_dh_social_car_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dh-social-car-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dh_social_car_plugin() {

	$plugin = new Dh_Social_Car_Plugin();
	$plugin->run();

}
run_dh_social_car_plugin();
