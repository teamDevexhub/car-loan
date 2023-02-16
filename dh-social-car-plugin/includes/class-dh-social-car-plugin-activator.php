<?php

/**
 * Fired during plugin activation
 *
 * @link       https://https://socialcars.co.za
 * @since      1.0.0
 *
 * @package    Dh_Social_Car_Plugin
 * @subpackage Dh_Social_Car_Plugin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Dh_Social_Car_Plugin
 * @subpackage Dh_Social_Car_Plugin/includes
 * @author     Team Socialcar <shwetagupta@devexhub.in>
 */
class Dh_Social_Car_Plugin_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate() {
        global $wpdb;
        $tbName = 'car_forms';
        $carTableName = $wpdb->prefix . "$tbName";
        if($wpdb->get_var( "show tables like '$carTableName'" ) != $carTableName) 
        { 
            $sql  = "CREATE TABLE `". $carTableName ."` ( ";
            $sql .= " `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, ";
            $sql .= " `fullname` int(50) NOT NULL, "; 
            $sql .= " `loan_amount` int(50) NOT NULL, "; 
            $sql .= " `term` varchar(100) NOT NULL,";
            $sql .= " `loan_type` varchar(100) NOT NULL,";
            $sql .= " `passport_no` varchar(100) NOT NULL,";
            $sql .= " `title` varchar(100) NOT NULL,";
            $sql .= " `fullnames` varchar(50) NOT NULL,";
            $sql .= " `email_address` varchar(100) NOT NULL,";
            $sql .= " `cellphone_number` int(20) NOT NULL,";
            $sql .= " `address` varchar(100) NOT NULL,"; 
            $sql .= "  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"; 
            $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=latin1;";
            require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
            dbDelta($sql);
        }

        $pages = apply_filters(
            'dh-social',
            array(
                /** Array For Creating Register Page **/
                'social-form'=> array(
                    'name'=> _x( 'social_form', 'Car Form', 'dh-social' ),
                    'title'=> _x( 'Car Form', 'Page title', 'dh-social' ),
                    'content' => '<!-- wp:shortcode -->[' . apply_filters( 'dh_social_page_shortcode_tag', 'Dh_Social_Car_Quickloans' ) . ']<!-- /wp:shortcode -->',
                ),
            )
        );
        /** Call Pages Function In Loop For Creating Pages **/
        foreach ( $pages as $key => $page ) {
            Dh_Social_Car_Plugin_Activator::DH_social_create_pages( sanitize_text_field( $page['name'] ), 'dh-gallery-plugin' , $page['title'], $page['content'], ! empty( $page['parent'] ) ? get_page_ID( $page['parent'] ) : '' );
        }
        /** Loop Close **/
    }

    public static function DH_social_create_pages( $slug, $option = '', $page_title = '', $page_content = '', $post_parent = 0 ){
        global $wpdb;
        $untrusted_input = '1 malicious string';
        $page    = 'page';
        $trash   = 'trash';
        $closed  = 'closed';
        $publish = 'publish';
        $pending = 'pending';
        $future  = 'future';
        $auto_draft = 'auto-draft';
        $option_value = get_option( $option );

        if( $option_value > 0 ) {
            $page_object = get_post( $option_value );

            if( $page_object && 'page' === $page_object->post_type && ! in_array( $page_object->post_status, array( 'pending', 'trash', 'future', 'auto-draft' ), true ) ) {
                // Valid page is already in place.
                return $page_object->ID;
            }
        }

        if( strlen( $page_content ) > 0 ) {
            // Search for an existing page with the specified page content (typically a shortcode).
            $shortcode = str_replace( array('<---- dh_social_shortcodes ---->', '<---- /dh_social_shortcodes ---->' ),'', $page_content );
            
            $valid_page_found = $wpdb->query( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type= $page AND post_status NOT IN ( $pending , $trash, $future, 'auto-draft' ) AND post_content LIKE %s LIMIT 1", "%{$shortcode}%" ) );
        }else{
            // Search for an existing page with the specified page slug.
            $valid_page_found = $wpdb->query( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type=$page AND post_status NOT IN ( $pending, $trash, $future, $auto_draft )AND post_name = %s LIMIT 1;", $slug ) );

        }

        $valid_page_found = apply_filters( 'dh_social_create_page_id', $valid_page_found, $slug, $page_content );

        if( $valid_page_found ) {
            if( $option ) {
                update_option( $option, $valid_page_found );
            }
            return $valid_page_found;
        }

        // Search for a matching valid trashed page.
        if( strlen( $page_content ) > 0 ) {
            // Search for an existing page with the specified page content (typically a shortcode).
            $trashed_page_found = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type=$page AND post_status = $trash AND post_content LIKE %s LIMIT 1;", "%{$page_content}%" ) );
        }else{
            // Search for an existing page with the specified page slug.
            $trashed_page_found = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type=$page AND post_status = $trash AND post_name = %s LIMIT 1;", $slug ) );
        }

        if( $trashed_page_found ) {
            $page_id = $trashed_page_found;
            $page_data = array(
                'ID'=> $page_id,
                'post_status' => 'publish',
            );
            wp_update_post( $page_data);
        }else{
            $page_data = array(
                'post_status'=> $publish,
                'post_type'=> $page,
                'post_author'=> 1,
                'post_name'=> $slug,
                'post_title' => $page_title,
                'post_content' => $page_content,
                'post_parent'=> $post_parent,
                'comment_status' => $closed,
            );
            $page_id = wp_insert_post( $page_data );
            /** Return Page Id After Create Page **/
        }

        if( $option ) {
            update_option( $option, $page_id );
        }

        update_option( 'dh-social-plugin', $page_id );

        $template = plugin_dir_path( __FILE__ ).'form_page_template.php';
        // update_post_meta($page_id, '_wp_page_template', $template);
        return $page_id;
    }
}