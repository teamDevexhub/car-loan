<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://socialcars.co.za
 * @since      1.0.0
 *
 * @package    Dh_Social_Car_Plugin
 * @subpackage Dh_Social_Car_Plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dh_Social_Car_Plugin
 * @subpackage Dh_Social_Car_Plugin/includes
 * @author     Team Socialcar <shwetagupta@devexhub.in>
 */
class Dh_Social_Car_Plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dh-social-car-plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
