<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/9kmmr
 * @since      1.0.0
 *
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/admin
 * @author     yourmindhasgone <yourmindhasgone@gmail.com>
 */
class Wp_Gallery_Tube_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Gallery_Tube_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Gallery_Tube_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-gallery-tube-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Gallery_Tube_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Gallery_Tube_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-gallery-tube-admin.js', array( 'jquery' ), $this->version, false );

	}
	/**
	 * wp_gallery_tube_add_plugin_admin_menu
	 *
	 * @return void
	 */
	public function wp_gallery_tube_add_plugin_admin_menu(){
		add_menu_page(
			__('G-Tube', 'pm_wdb'),
			__('G-Tube', 'pm_wdb'),
			'manage_options',
			'wp_gallery_tube',
			array(
				$this,
				'wp_gallery_tube_display_plugin_page'
			),
			dirname((plugin_dir_url( __FILE__ ))).'/admin/menu.png', 
			25
		);

		add_submenu_page(
			'wp_gallery_tube',
			__('Studios'),
			__('Studios'), 
			'manage_options', 
			'studios', 
			array(
				$this,
				'wp_gallery_tube_studios_page'
			) 
		);
		add_submenu_page(
			'wp_gallery_tube',
			__('Porn Stars'),
			__('Porn Stars'), 
			'manage_options', 
			'pornstars', 
			array(
				$this,
				'wp_gallery_tube_pornstars_page'
			) 
		);
		add_submenu_page(
			'wp_gallery_tube',
			__('Tags'),
			__('Tags'), 
			'manage_options', 
			'scene_tags', 
			array(
				$this,
				'wp_gallery_tube_scene_tags_page'
			) 
		);

		

	}
	/**
	 * wp_gallery_tube_display_plugin_page
	 *
	 * @return void
	 */
	public function wp_gallery_tube_display_plugin_page(){
		
		include  'partials/' . $this->plugin_name . '-admin-display.php';
	}
	public function wp_gallery_tube_studios_page(){

		include  'partials/' . $this->plugin_name . '-studios-display.php';
	}
	public function wp_gallery_tube_pornstars_page(){

		include  'partials/' . $this->plugin_name . '-pornstars-display.php';
	}
	public function wp_gallery_tube_scene_tags_page(){
		
		include  'partials/' . $this->plugin_name . '-tags-display.php';
	}

}
