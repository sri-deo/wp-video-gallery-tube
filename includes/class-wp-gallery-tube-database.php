<?php

/**
 * Fired during plugin activation when need to create new Database
 *
 * @link       https://github.com/9kmmr
 * @since      1.0.0
 *
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/includes
 */

/**
 * Fired during plugin activation when need to create new Database.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/includes
 * @author     yourmindhasgone <yourmindhasgone@gmail.com>
 */
class Wp_Gallery_Tube_Database {
	protected $plugin_name;	
    protected $version;
    private $db_version = 1.0.0;
    /**
     * install db
     */
    public function gallery_tube_db_install() {
        global $wpdb;       

        $table_name = $wpdb->prefix . 'wp_gallery_tube';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id  INT NOT NULL AUTO_INCREMENT,
            fullname  TEXT NOT NULL ,
            domain TEXT  NOT NULL,
            email TEXT NOT NULL,
            phonenumber TEXT  NOT NULL,
            datecreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            approved INT DEFAULT '0' NOT NULL,
        
            PRIMARY KEY  (id)
            ) $charset_collate;       

        ";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );    
        add_option( 'wp_gallery_tube_db_version', $this->db_version );
    }

    /**
     * uninstall
     */

    public function gallery_tube_db_uninstall() {
		
        global $wpdb;      

        $table_name = $wpdb->prefix . 'wp_gallery_tube';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "DROP TABLE IF EXISTS ".$table_name ." ; " ;     

        $wpdb->query( $sql );     

        delete_option('wp_gallery_tube_db_version');
    }
}

