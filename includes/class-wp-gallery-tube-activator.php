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

	}

	/**
	 * createPages
	 *
	 * @return void
	 */
	public static function createPages(){
		$post = array(
			'ID' => [ <post id> ] //Are you updating an existing post?
			'menu_order' => [ <order> ] //If new post is a page, sets the order should it appear in the tabs.
			'page_template' => [ <template file> ] //Sets the template for the page.
			'comment_status' => [ 'closed' | 'open' ] // 'closed' means no comments.
			'ping_status' => [ ? ] //Ping status?
			'pinged' => [ ? ] //?
			'post_author' => [ <user ID> ] //The user ID number of the author.
			'post_category' => [ array(<category id>, <...>) ] //Add some categories.
			'post_content' => [ <the text of the post> ] //The full text of the post.
			'post_date' => [ Y-m-d H:i:s ] //The time post was made.
			'post_date_gmt' => [ Y-m-d H:i:s ] //The time post was made, in GMT.
			'post_excerpt' => [ <an excerpt> ] //For all your post excerpt needs.
			'post_name' => [ <the name> ] // The name (slug) for your post
			'post_parent' => [ <post ID> ] //Sets the parent of the new post.
			'post_password' => [ ? ] //password for post?
			'post_status' => [ 'draft' | 'publish' | 'pending' ] //Set the status of the new post.
			'post_title' => [ <the title> ] //The title of your post.
			'post_type' => [ 'post' | 'page' ] //Sometimes you want to post a page.
			'tags_input' => [ '<tag>, <tag>, <...>' ] //For tags.
			'to_ping' => [ ? ] //?
		  );
		
		  
		// Insert the post into the database
		wp_insert_post( $post );
	}


}
