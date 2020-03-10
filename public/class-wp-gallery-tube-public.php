<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/9kmmr
 * @since      1.0.0
 *
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/public
 * @author     yourmindhasgone <yourmindhasgone@gmail.com>
 */
class Wp_Gallery_Tube_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		if ( is_page_template( 'wp-gallery-tube-main-page-template.php' ) || is_page_template( 'wp-gallery-tube-tags-page-template.php' ) ||
		is_page_template('wp-gallery-tube-pornstars-page-template.php') || is_page_template('wp-gallery-tube-studios-page-template.php') || 
		is_page_template('wp-gallery-tube-single-studio-page-template.php') || is_page_template('wp-gallery-tube-single-pornstar-page-template.php') ||
		 is_page_template('wp-gallery-tube-single-tag-page-template.php') ||  is_page_template('wp-gallery-tube-single-page-template.php') ) {

			wp_enqueue_style( $this->plugin_name.'-bs', plugin_dir_url( __FILE__ ) . 'css/gallery-tube-bs.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name.'-fa', plugin_dir_url( __FILE__ ) . 'css/all.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name.'-osahan', plugin_dir_url( __FILE__ ) . 'css/osahan.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name.'-owl', plugin_dir_url( __FILE__ ) . 'css/owl.carousel.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name.'-owl-theme', plugin_dir_url( __FILE__ ) . 'css/owl.theme.css', array(), $this->version, 'all' );

		}

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-gallery-tube-public.css', array(), $this->version, 'all' );
		

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		if ( is_page_template( 'wp-gallery-tube-main-page-template.php' ) || is_page_template( 'wp-gallery-tube-tags-page-template.php' ) ||
		 is_page_template('wp-gallery-tube-pornstars-page-template.php') || is_page_template('wp-gallery-tube-studios-page-template.php') || 
		 is_page_template('wp-gallery-tube-single-studio-page-template.php') || is_page_template('wp-gallery-tube-single-pornstar-page-template.php') ||
		  is_page_template('wp-gallery-tube-single-tag-page-template.php')||  is_page_template('wp-gallery-tube-single-page-template.php') 
		 
		 
		 ) {
			wp_enqueue_script( $this->plugin_name.'-jquery', plugin_dir_url( __FILE__ ) . 'js/jquery.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name.'-bs-js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name.'-js-eas', plugin_dir_url( __FILE__ ) . 'js/jquery.easing.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name.'-owl-js', plugin_dir_url( __FILE__ ) . 'js/owl.carousel.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name.'-custom', plugin_dir_url( __FILE__ ) . 'js/custom.js', array( 'jquery' ), $this->version, true );	
		}
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-gallery-tube-public.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * register page template 
	 */
	public function wp_gallery_tube_add_interface_page_filter($post_templates)
	{
		// Add custom template named template-custom.php to select dropdown 
		$post_templates['wp-gallery-tube-main-page-template.php'] = __('WP Gallery Tube Template');		
		$post_templates['wp-gallery-tube-pornstars-page-template.php'] = __('Wp Gallery Tube Pornstars Template');
		$post_templates['wp-gallery-tube-studios-page-template.php'] = __('Wp Gallery Tube Studios Template');
		$post_templates['wp-gallery-tube-tags-page-template.php'] = __('Wp Gallery Tube Tags Template');
		$post_templates['wp-gallery-tube-single-studio-page-template.php'] = __('Wp Gallery Tube Single Studio Template');
		$post_templates['wp-gallery-tube-single-pornstar-page-template.php'] = __('Wp Gallery Tube Single Pornstar Template');
		$post_templates['wp-gallery-tube-single-tag-page-template.php'] = __('Wp Gallery Tube Single Tag Template');
		$post_templates['wp-gallery-tube-single-page-template.php'] = __('Wp Gallery Tube Single Template');

		return $post_templates;
	}
	/**
	 * load page template
	 */
	public function wp_gallery_tube_load_interface_page_template($template)
	{
		$templates_dir = 'templates';
		if (get_page_template_slug() === 'wp-gallery-tube-main-page-template.php') {

			if ($theme_file = locate_template(array('wp-gallery-tube-main-page-template.php'))) {
				$template = $theme_file;
			} else {
				$template = WP_PLUGIN_DIR . '/' . $this->plugin_name . '/' . $templates_dir . '/wp-gallery-tube-main-page-template.php';
			}
		}
		if (get_page_template_slug() === 'wp-gallery-tube-tags-page-template.php') {

			if ($theme_file = locate_template(array('wp-gallery-tube-tags-page-template.php'))) {
				$template = $theme_file;
			} else {
				$template = WP_PLUGIN_DIR . '/' . $this->plugin_name . '/' . $templates_dir . '/wp-gallery-tube-tags-page-template.php';
			}
		}
		if (get_page_template_slug() === 'wp-gallery-tube-pornstars-page-template.php') {

			if ($theme_file = locate_template(array('wp-gallery-tube-pornstars-page-template.php'))) {
				$template = $theme_file;
			} else {
				$template = WP_PLUGIN_DIR . '/' . $this->plugin_name . '/' . $templates_dir . '/wp-gallery-tube-pornstars-page-template.php';
			}
		}

		if (get_page_template_slug() === 'wp-gallery-tube-studios-page-template.php') {

			if ($theme_file = locate_template(array('wp-gallery-tube-studios-page-template.php'))) {
				$template = $theme_file;
			} else {
				$template = WP_PLUGIN_DIR . '/' . $this->plugin_name . '/' . $templates_dir . '/wp-gallery-tube-studios-page-template.php';
			}
		}
		if (get_page_template_slug() === 'wp-gallery-tube-single-page-template.php') {

			if ($theme_file = locate_template(array('wp-gallery-tube-single-page-template.php'))) {
				$template = $theme_file;
			} else {
				$template = WP_PLUGIN_DIR . '/' . $this->plugin_name . '/' . $templates_dir . '/wp-gallery-tube-single-page-template.php';
			}
		}
		if (get_page_template_slug() === 'wp-gallery-tube-single-studio-page-template.php') {

			if ($theme_file = locate_template(array('wp-gallery-tube-single-studio-page-template.php'))) {
				$template = $theme_file;
			} else {
				$template = WP_PLUGIN_DIR . '/' . $this->plugin_name . '/' . $templates_dir . '/wp-gallery-tube-single-studio-page-template.php';
			}
		}
		if (get_page_template_slug() === 'wp-gallery-tube-single-pornstar-page-template.php') {

			if ($theme_file = locate_template(array('wp-gallery-tube-single-pornstar-page-template.php'))) {
				$template = $theme_file;
			} else {
				$template = WP_PLUGIN_DIR . '/' . $this->plugin_name . '/' . $templates_dir . '/wp-gallery-tube-single-pornstar-page-template.php';
			}
		}
		if (get_page_template_slug() === 'wp-gallery-tube-single-tag-page-template.php') {

			if ($theme_file = locate_template(array('wp-gallery-tube-single-tag-page-template.php'))) {
				$template = $theme_file;
			} else {
				$template = WP_PLUGIN_DIR . '/' . $this->plugin_name . '/' . $templates_dir . '/wp-gallery-tube-single-tag-page-template.php';
			}
		}
		

		if ($template == '') {
			throw new \Exception('No template found');
		}

		return $template;
	}
	/**
	 * wp_gallery_tube_rewrite_url_init : 
	 *
	 * @return void
	 */
	public function wp_gallery_tube_rewrite_url_init(){
		
		
			
		add_rewrite_rule(
			'^tags/([^/]+)/?',
			'index.php?pagename=tags&tag=$matches[1]',
			'top'
		);
		
		add_rewrite_rule(
			'^pornstars/([^/]+)/?',
			'index.php?pagename=pornstars&star=$matches[1]',
			'top'
		);

		add_rewrite_rule(
			'^scene/([^/]+)/?',
			'index.php?pagename=scene&scene_identity=$matches[1]',
			'top'
		);
			
		add_rewrite_rule(
			'^studios/([^/]+)/?',
			'index.php?pagename=studios&studio_name=$matches[1]',
			'top'
		);

		
		if( !get_option('plugin_permalinks_flushed') ) {
 
			flush_rewrite_rules(false);
			update_option('plugin_permalinks_flushed', 1);
	 
		}
		
		
	}
	
	/**
	 * wp_gallery_tube_query_vars
	 *
	 * @param  mixed $query_vars
	 *
	 * @return void
	 */
	public function wp_gallery_tube_query_vars($query_vars){
		
		$query_vars[] = 'tag';
		$query_vars[] = 'star';
		$query_vars[] = 'scene_identity';
		$query_vars[] = 'studio_name';

		return $query_vars;
	}

}
