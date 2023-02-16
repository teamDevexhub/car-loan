<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://https://socialcars.co.za
 * @since      1.0.0
 *
 * @package    Dh_Social_Car_Plugin
 * @subpackage Dh_Social_Car_Plugin/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Dh_Social_Car_Plugin
 * @subpackage Dh_Social_Car_Plugin/includes
 * @author     Team Socialcar <shwetagupta@devexhub.in>
 */
class Dh_Social_Car_Plugin_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
        $page_id = get_option('dh-social-plugin');
        wp_delete_post( $page_id, true); // Set to False if you want to send them to Trash.
	}

}
