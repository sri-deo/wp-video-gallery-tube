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
        
    }

    /**
     * install db
     */
    public function gallery_tube_db_install() {
        

        $charset_collate = $wpdb->get_charset_collate();

        $studio_sql = "CREATE TABLE IF NOT EXISTS $this->studio_table (
            id  INT NOT NULL AUTO_INCREMENT,
            studio_name  TEXT NOT NULL ,            
            description TEXT NULL,           
            url TEXT NOT NULL,
            favorites FLOAT,    
            logo TEXT ,                   
            datecreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,           
            INDEX (studio_name),
            PRIMARY KEY  (id)
            ) $charset_collate;   ";

        
        $tube_sql = "CREATE TABLE IF NOT EXISTS $this->tube_table (
            id  INT NOT NULL AUTO_INCREMENT,
            title  TEXT NOT NULL ,
            video_length TEXT  NULL,
            description TEXT NULL,
            releaseDate DATETIME NULL,
            video_url TEXT NOT NULL,
            fps INT NULL,
            degrees INT NULL,
            src_image TEXT NOT NULL,
            tags TEXT ,
            pornstars TEXT ,
            site_src TEXT,
            studio INT ,
            scence_identity VARCHAR(50) NOT NULL,
            datecreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            INDEX (title),
            INDEX (pornstars),           
            INDEX (studio),
            INDEX (scence_identity),
            FOREIGN KEY(studio) REFERENCES         
            $this->studio_table (id)
            ON UPDATE CASCADE ON DELETE CASCADE, 
            PRIMARY KEY  (id)
            ) $charset_collate;  ";        


        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $studio_sql );
        dbDelta( $tube_sql );    
        add_option( 'wp_gallery_tube_db_version', $this->db_version );
    }

    /**
     * uninstall
     */

    public function gallery_tube_db_uninstall() {
		
        global $wpdb;      

        $sql_tube = "DROP TABLE IF EXISTS ".$this->tube_table ." ; " ;     
        $sql__studio = "DROP TABLE IF EXISTS ".$this->studio_table ." ; " ;     

        $wpdb->query( $sql_tube );     
        $wpdb->query( $sql__studio );     

        delete_option('wp_gallery_tube_db_version');
    }


    public function get_columntubes(){
        return array(
            'id' => '',
            'title' => '',
            'video_length' => '',
            'description' => '',
            'releaseDate' => '',
            'video_url' => '',
            'fps' => '',
            'degrees' => '',
            'src_image' => '',
            'tags' => '',
            'pornstars' => '',
            'site_src' => '',
            'studio' => '',
            'scence_identity' => '',
            'datecreated' => ''
            
        );
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
    
}

