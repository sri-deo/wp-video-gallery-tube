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
		flush_rewrite_rules();
		update_option('plugin_permalinks_flushed', 0);
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
			'post_name' => 'gallery', // The name (slug) for your post
			'post_status' => 'publish' , //Set the status of the new post.
			'post_title' => 'Gallery Tube Page', //The title of your post.
			'post_type' =>  'page' //Sometimes you want to post a page.					
		);
		$studio_page = array(			
			'page_template' => 'wp-gallery-tube-studios-page-template.php', //Sets the template for the page.
			'comment_status' => [ 'closed' ], // 'closed' means no comments.
			'post_name' => 'studios', // The name (slug) for your post
			'post_status' => 'publish' , //Set the status of the new post.
			'post_title' => 'Gallery Tube Studios Page', //The title of your post.
			'post_type' =>  'page' //Sometimes you want to post a page.					
		);
		$category_page = array(			
			'page_template' => 'wp-gallery-tube-categories-page-template.php', //Sets the template for the page.
			'comment_status' => [ 'closed' ], // 'closed' means no comments.
			'post_name' => 'cat', // The name (slug) for your post
			'post_status' => 'publish' , //Set the status of the new post.
			'post_title' => 'Gallery Tube Categories Page', //The title of your post.
			'post_type' =>  'page' //Sometimes you want to post a page.					
		);
		$single_studio_page = array(			
			'page_template' => 'wp-gallery-tube-single-studio-page-template.php', //Sets the template for the page.
			'comment_status' => [ 'closed' ], // 'closed' means no comments.
			'post_name' => 'single_studio', // The name (slug) for your post
			'post_status' => 'publish' , //Set the status of the new post.
			'post_title' => 'Gallery Tube Single Studio Page', //The title of your post.
			'post_type' =>  'page' //Sometimes you want to post a page.					
		);
		$single_category_page = array(			
			'page_template' => 'wp-gallery-tube-single-category-page-template.php', //Sets the template for the page.
			'comment_status' => [ 'closed' ], // 'closed' means no comments.
			'post_name' => 'single_cat', // The name (slug) for your post
			'post_status' => 'publish' , //Set the status of the new post.
			'post_title' => 'Gallery Tube Single Category Page', //The title of your post.
			'post_type' =>  'page' //Sometimes you want to post a page.					
		);	
		  
		// Insert the post into the database
		wp_insert_post( $gallery_page );	
		wp_insert_post( $studio_page );	
		wp_insert_post( $category_page );	
		wp_insert_post( $single_studio_page );	
		wp_insert_post( $single_category_page );	
		
	}


}
