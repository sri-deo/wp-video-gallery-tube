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

    protected $tubes_table;
    protected $studios_table;
    protected $tags_table;
    protected $pornstars_table;

    protected $scene_tag_table;
    protected $scene_star_table;

    public function __construct(){

        global $wpdb;
        $this->tubes_table = $wpdb->prefix . 'gallery_tube';
        $this->studios_table = $wpdb->prefix . 'gallery_tube_studios';
        $this->tags_table = $wpdb->prefix . 'gallery_tube_tags';
        $this->pornstars_table = $wpdb->prefix . 'gallery_tube_pornstars';

        $this->scene_tag_table = $wpdb->prefix . 'gallery_tube_scene_tag';
        $this->scene_star_table = $wpdb->prefix . 'gallery_tube_scene_star';
        
    }

    /**
     * install db
     */
    public function gallery_tube_db_install() {
        
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $studio_sql = "CREATE TABLE IF NOT EXISTS $this->studios_table (
            `id`          int NOT NULL AUTO_INCREMENT ,
            `studio_nicename` varchar(500)  NULL ,
            `studio_name` varchar(500) NOT NULL ,
            `description` text NULL ,
            `url`         text NOT NULL ,
            `logo`        text NULL ,
            `datecreated` timestamp NOT NULL ,

            PRIMARY KEY (`id`)
            ) $charset_collate;   ";

        $tag_sql = "CREATE TABLE IF NOT EXISTS $this->tags_table (

            `id`          int NOT NULL AUTO_INCREMENT ,
            `name`        text NOT NULL ,
            `description` text NULL ,

            PRIMARY KEY (`id`)

        ) $charset_collate;";

        $pornstar_sql = " CREATE TABLE IF NOT EXISTS $this->pornstars_table (

            `id`           int NOT NULL AUTO_INCREMENT ,
            `name`         text NOT NULL ,
            `slug`         varchar(500) NOT NULL,
            `photo`          text NULL ,
            `country`      varchar(100) NULL ,
            `birth`        date NULL ,
            `bio`          text NULL ,
            `height`       varchar(45) NULL ,
            `weight`       varchar(45) NULL ,
            `aliases`      text NULL ,
            `date_created` timestamp NOT NULL ,

            PRIMARY KEY (`id`)
        ) $charset_collate; ";


        $tube_sql = "CREATE TABLE IF NOT EXISTS $this->tubes_table (
            `id`              int NOT NULL AUTO_INCREMENT ,
            `title`           text NOT NULL ,
            `video_length`    varchar(45) NULL ,
            `description`     text NULL ,
            `releaseDate`     varchar(45) NULL ,
            `video_url`       text NOT NULL ,
            `fps`             int NULL ,
            `degrees`         int NULL ,
            `src_image`       text NOT NULL ,
            `site_src`        text NOT NULL ,
            `scene_identity` varchar(50) NOT NULL ,
            `date_created`    timestamp NOT NULL ,
            `studio`          int NOT NULL ,

            PRIMARY KEY (`id`),
            KEY `fk_studio` (`studio`),
            CONSTRAINT `FK_studio` FOREIGN KEY `fk_studio` (`studio`) REFERENCES `wp_gallery_tube_studios` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE

            ) $charset_collate;  ";        

        $tube_tag_sql = "CREATE TABLE IF NOT EXISTS $this->scene_tag_table (
            `tube_id` int NOT NULL ,
            `tag_id`  int NOT NULL ,

            PRIMARY KEY (`tube_id`, `tag_id`),
            KEY `fkIdx_218` (`tube_id`),
            CONSTRAINT `FK_tube_tag` FOREIGN KEY `fkIdx_218` (`tube_id`) REFERENCES `wp_gallery_tube` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            KEY `fkIdx_235` (`tag_id`),
            CONSTRAINT `FK_tag` FOREIGN KEY `fkIdx_235` (`tag_id`) REFERENCES `wp_gallery_tube_tags` (`id`)
        ) $charset_collate; ";

        $tube_star_sql = "CREATE TABLE IF NOT EXISTS $this->scene_star_table (
            `tube_id`     int NOT NULL ,
            `pornstar_id` int NOT NULL ,

            PRIMARY KEY (`tube_id`, `pornstar_id`),
            KEY `fkIdx_242` (`pornstar_id`),
            CONSTRAINT `FK_star` FOREIGN KEY `fkIdx_242` (`pornstar_id`) REFERENCES `wp_gallery_tube_pornstars` (`id`),
            KEY `fkIdx_247` (`tube_id`),
            CONSTRAINT `FK_tube_star` FOREIGN KEY `fkIdx_247` (`tube_id`) REFERENCES `wp_gallery_tube` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) $charset_collate; ";



        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $studio_sql );
        dbDelta( $tag_sql );
        dbDelta( $pornstar_sql );

        dbDelta( $tube_sql ); 

        dbDelta( $tube_tag_sql );  
        dbDelta( $tube_star_sql ); 
        add_option( 'wp_gallery_tube_db_version', $this->db_version );
    }

    /**
     * uninstall
     */

    public function gallery_tube_db_uninstall() {
		
        global $wpdb;      

        $sql_tube = "DROP TABLE IF EXISTS ".$this->tubes_table ." ; " ;

        $sql_studio = "DROP TABLE IF EXISTS ".$this->studios_table ." ; " ; 
        $sql_tags_table = "DROP TABLE IF EXISTS ".$this->tags_table ." ; " ;   
        $sql_pornstars_table = "DROP TABLE IF EXISTS ".$this->pornstars_table ." ; " ;   
        $sql_scene_tag_table = "DROP TABLE IF EXISTS ".$this->scene_tag_table ." ; " ;   
        $sql_scene_star_table = "DROP TABLE IF EXISTS ".$this->scene_star_table ." ; " ;   
        

      
        $wpdb->query( $sql_tube );

        $wpdb->query( $sql_studio );
        $wpdb->query( $sql_tags_table ); 
        $wpdb->query( $sql_pornstars_table ); 
        $wpdb->query( $sql_scene_tag_table ); 
        $wpdb->query( $sql_scene_star_table ); 

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
            'site_src' => '',
            'studio' => '',
            'scene_identity' => ''      
        );
    }
    public function get_columnstudios(){
        return array(
            'id' => '',
            'studio_nicename' => '',
            'studio_name' => '',
            'description' => '',
            'url' => '',
            'logo' => ''
        );
    }
    public function get_columnpornstars(){
        return array(
            'id' => '',
            'slug' => '',
            'name' => '',
            'country' => '',
            'birth' => '',
            'bio' => '',
            'height' => '',
            'weight' => '',
            'aliases' => ''            
        );
    }
    public function get_columntags(){
        return array(
            'id' => '',
            'name' => '',
            'description' => ''
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
        $datas = array_intersect_key($datas, $this->get_columntubes());
        if ($existed_tube = $this->gallery_tube_get_tube_by_identity($datas['scene_identity'])) {
            return null;
        }
        $res = $wpdb->insert($this->tubes_table, $datas);
        if ($res) {
            return $wpdb->insert_id;
        }
    }
    public function gallery_tube_insert_studios($datas = array()) {
        global $wpdb;
        $datas = array_intersect_key($datas, $this->get_columnstudios());
        if ($existed_studio = $this->gallery_tube_get_studios_by_name($datas['studio_name'])) {
            return $existed_studio->id;
        }
        $res =  $wpdb->insert($this->studios_table, $datas);
        if ($res) {
            return $wpdb->insert_id;
        }
    }
    public function gallery_tube_insert_tags($datas = array()) {
        global $wpdb;
        $datas = array_intersect_key($datas, $this->get_columntags());
        if ($existed_tag = $this->gallery_tube_get_tag_by_name($datas['name'])) {
            return $existed_tag->id;
        }
        $res =  $wpdb->insert($this->tags_table, $datas);
        if ($res) {
            return $wpdb->insert_id;
        }
    }
    public function gallery_tube_insert_pornstars($datas = array()){
        global $wpdb;
        $datas = array_intersect_key($datas, $this->get_columnpornstars());
        if ($existed_pornstar = $this->gallery_tube_get_pornstar_by_name($datas['slug'])) {
            return $existed_pornstar->id;
        }
        $res =  $wpdb->insert($this->pornstars_table, $datas);
        if ($res) {
            return $wpdb->insert_id;
        }
    }
    
    public function gallery_tube_insert_scene_tag($datas = array()){
        global $wpdb;               
        $res =  $wpdb->insert($this->scene_tag_table, $datas);
        if ($res) {
            return $wpdb->insert_id;
        }
    }
    public function gallery_tube_insert_scene_pornstar($datas = array()){
        global $wpdb;               
        $res =  $wpdb->insert($this->scene_star_table, $datas);
        if ($res) {
            return $wpdb->insert_id;
        }
    }

    /**** */
    public function gallery_tube_get_single_tube(){

    }

    /****/
    public function gallery_tube_get_tube_by_identity($identity){
        global $wpdb;
        return $wpdb->get_row($wpdb->prepare( 'SELECT * FROM '.$this->tubes_table.' WHERE UPPER(scene_identity) = %s ;', strtoupper ($identity) )  );
    }
    public function gallery_tube_get_studios_by_name($name){
        global $wpdb;
        return $wpdb->get_row($wpdb->prepare( 'SELECT * FROM '.$this->studios_table.' WHERE UPPER(studio_name) LIKE %s ;',  '%' . $wpdb->esc_like(strtoupper ($name)) . '%')  );
    }
    public function gallery_tube_get_pornstar_by_name($name){
        global $wpdb;
        return $wpdb->get_row($wpdb->prepare( 'SELECT * FROM '.$this->pornstars_table.' WHERE slug= %s ;',  $name)  );
    }
    public function gallery_tube_get_tag_by_name($name){
        global $wpdb;
        return $wpdb->get_row($wpdb->prepare( 'SELECT * FROM '.$this->tags_table.' WHERE UPPER(name) LIKE %s ;',  '%' . $wpdb->esc_like(strtoupper ($name)) . '%')  );
    }


    
}

