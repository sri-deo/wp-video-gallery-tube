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
    private $db_version = '1.0.0';

    protected $tube_table;
    protected $studio_table;
    protected $category_table;

    public function __construct(){
        global $wpdb;
        $this->tube_table = $wpdb->prefix . 'wp_gallery_tube';
        $this->studio_table = $wpdb->prefix . 'wp_gallery_tube_studios';
        $this->category_table = $wpdb->prefix . 'wp_gallery_tube_categories';
    }

    /**
     * install db
     */
    public function gallery_tube_db_install() {
        global $wpdb;       

        $table_name = $wpdb->prefix . 'wp_gallery_tube';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id  INT NOT NULL AUTO_INCREMENT,
            title  TEXT NOT NULL ,
            video_length TEXT  NULL,
            desc TEXT NULL,
            releaseDate DATETIME NULL,
            url TEXT NOT NULL,
            fps INT NULL,
            degrees INT NULL,
            src_image TEXT NOT NULL,
            tags TEXT ,
            pornstars TEXT ,
            site_src TEXT,
            studio INT ,
            
            datecreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            
        
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



    /**
     * gallery_tube_insert
     *
     * @param  array $datas
     *
     * @return void
     */
    public function gallery_tube_insert_tubes($datas = array()){
        global $wpdb;
        return $wpdb->insert($this->tube_table, $datas);
    }
    /**
     * gallery_tube_insert_studios
     *
     * @param  array $datas
     *
     * @return void
     */
    public function gallery_tube_insert_studios($datas = array()) {
        global $wpdb;
        return $wpdb->insert($this->studio_table, $datas);
    }
    /**
     * gallery_tube_insert_categories
     *
     * @param  array $datas
     *
     * @return void
     */
    public function gallery_tube_insert_categories($datas = array()) {
        global $wpdb;
        return $wpdb->insert($this->category_table, $datas);
    }
}

