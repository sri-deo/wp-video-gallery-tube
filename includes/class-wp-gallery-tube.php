<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/9kmmr
 * @since      1.0.0
 *
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/includes
 * @author     yourmindhasgone <yourmindhasgone@gmail.com>
 */
class Wp_Gallery_Tube {

	

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WP_GALLERY_TUBE_VERSION' ) ) {
			$this->version = WP_GALLERY_TUBE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'wp-gallery-tube';

		$this->load_dependencies();
		$this->set_locale();

		if (is_admin()) {
			$this->define_admin_hooks();
		}
		
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - 
	 * - Wp_Gallery_Tube_i18n. Defines internationalization functionality.
	 * - Wp_Gallery_Tube_Admin. Defines all hooks for the admin area.
	 * - Wp_Gallery_Tube_Public. Defines all hooks for the public side of the site.
	 *
	 *
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		
		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-gallery-tube-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		if (is_admin()) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-gallery-tube-admin.php';
		}
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-gallery-tube-public.php';

		

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wp_Gallery_Tube_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wp_Gallery_Tube_i18n();

		add_action( 'plugins_loaded', array($plugin_i18n, 'load_plugin_textdomain') );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Wp_Gallery_Tube_Admin( $this->get_plugin_name(), $this->get_version() );

		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_styles') );
		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts') );

		// Add menu item
		add_action('admin_menu', array( $plugin_admin, 'wp_gallery_tube_add_plugin_admin_menu') );

		
		// register ajax actions
		add_action('wp_ajax_gallery_tube_get_tubes', array(  $plugin_admin, 'wp_gallery_tube_get_tubes'  ));
		add_action('wp_ajax_gallery_tube_get_studios', array(  $plugin_admin, 'wp_gallery_tube_get_studios'  ));
		add_action('wp_ajax_gallery_tube_get_pornstars', array(  $plugin_admin, 'wp_gallery_tube_get_pornstars'  ));
		add_action('wp_ajax_gallery_tube_get_tags', array(  $plugin_admin, 'wp_gallery_tube_get_tags'  ));

		add_action('wp_ajax_gallery_tube_get_tube_by_id', array( $plugin_admin, 'get_tube_by_id' ) );


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Wp_Gallery_Tube_Public( $this->get_plugin_name(), $this->get_version() );

		
		
		// enqueue style and scripts
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_styles') );
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_scripts') );

		// rewrite url
		add_action( 'init', array( $plugin_public, 'wp_gallery_tube_rewrite_url_init'), 10,0 );
		add_filter( 'query_vars', array( $plugin_public, 'wp_gallery_tube_query_vars' ) );

		// add page template for the plugin
		add_filter('theme_page_templates', array( $plugin_public, 'wp_gallery_tube_add_interface_page_filter'), 10, 4);
		add_filter('template_include', array( $plugin_public, 'wp_gallery_tube_load_interface_page_template') );


		//
	}

	

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
