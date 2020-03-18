<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/9kmmr
 * @since      1.0.0
 *
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/includes
 * @author     yourmindhasgone <yourmindhasgone@gmail.com>
 */
class Wp_Gallery_Tube_Activator {

	/**	
	 * Function executed when active plugin
	 * 	 
	 * @since    1.0.0
	 */
	public static function activate() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-gallery-tube-database.php';
		$Wp_Gallery_Tube_Database = new Wp_Gallery_Tube_Database();
		$Wp_Gallery_Tube_Database->gallery_tube_db_install();
		
		// flush rewrite rules only one time when active plugin
		update_option('plugin_permalinks_flushed', 0);
		if (!get_option("is_pages_created")){
			Wp_Gallery_Tube_Activator::createPages();
			update_option("is_pages_created", 1);
		}
		flush_rewrite_rules();
	}
	
	public function createSetings(){

		update_option('blur',1);
		update_option('czechvr',1);
		update_option('naughtyamerica',1);
		update_option('badoink',1);
		update_option('vrbcash',1);

		
		
	}
	/**
	 * createPages
	 *
	 * @return void
	 */
	public static function createPages(){
		$gallery_page = array(			
			'page_template' => 'wp-gallery-tube-main-page-template.php', //Sets the template for the page.
			'comment_status' => [ 'closed' ], // 'closed' means no comments.
			'post_name' => 'library', // The name (slug) for your post
			'post_status' => 'publish' , //Set the status of the new post.
			'post_title' => 'Gallery Tube Page', //The title of your post.
			'post_type' =>  'page' //Sometimes you want to post a page.					
		);
		$studios_page = array(			
			'page_template' => 'wp-gallery-tube-studios-page-template.php', //Sets the template for the page.
			'comment_status' => [ 'closed' ], // 'closed' means no comments.
			'post_name' => 'studios', // The name (slug) for your post
			'post_status' => 'publish' , //Set the status of the new post.
			'post_title' => 'Gallery Tube Studios Page', //The title of your post.
			'post_type' =>  'page' //Sometimes you want to post a page.					
		);
		$tags_page = array(			
			'page_template' => 'wp-gallery-tube-tags-page-template.php', //Sets the template for the page.
			'comment_status' => [ 'closed' ], // 'closed' means no comments.
			'post_name' => 'tags', // The name (slug) for your post
			'post_status' => 'publish' , //Set the status of the new post.
			'post_title' => 'Gallery Tube tags Page', //The title of your post.
			'post_type' =>  'page' //Sometimes you want to post a page.					
		);
		$pornstars_page = array(			
			'page_template' => 'wp-gallery-tube-pornstars-page-template.php', //Sets the template for the page.
			'comment_status' => [ 'closed' ], // 'closed' means no comments.
			'post_name' => 'pornstars', // The name (slug) for your post
			'post_status' => 'publish' , //Set the status of the new post.
			'post_title' => 'Gallery Tube Pornstars Page', //The title of your post.
			'post_type' =>  'page' //Sometimes you want to post a page.					
		);
		$single_scene_page = array(			
			'page_template' => 'wp-gallery-tube-single-page-template.php', //Sets the template for the page.
			'comment_status' => [ 'closed' ], // 'closed' means no comments.
			'post_name' => 'scene', // The name (slug) for your post
			'post_status' => 'publish' , //Set the status of the new post.
			'post_title' => 'Gallery Tube Single Scene Page', //The title of your post.
			'post_type' =>  'page' //Sometimes you want to post a page.					
		);	
		  
		// Insert the post into the database
		$gallery_page = wp_insert_post( $gallery_page );	
		$studio_page = wp_insert_post( $studios_page );	
		$tag_page = wp_insert_post( $tags_page );	
		$pornstar_page = wp_insert_post( $pornstars_page );	
		$scene_page = wp_insert_post( $single_scene_page );	

		if ($gallery_page) {
			update_option('wp_gallery_tube_gallery_page', $gallery_page);
		}
		if ($studio_page) {
			update_option('wp_gallery_tube_studio_page', $studio_page);
		}
		if ($tag_page) {
			update_option('wp_gallery_tube_tag_page', $tag_page);
		}
		if ($pornstar_page) {
			update_option('wp_gallery_tube_pornstar_page', $pornstar_page);
		}
		if ($scene_page) {
			update_option('wp_gallery_tube_scene_page', $scene_page);
		}
		
	}


}
