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

	protected $dataConverter;
	protected $dataImporter;

	private $json_data_path_badoink;
	private $json_data_path_vrbanger;
	private $csv_data_path;
	private $xml_data_path;

	private $studios_lists;
	private $studios_map = array();

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

		$this->get_list_import_data();

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-gallery-tube-database.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-gallery-tube-convert.php';

		$this->studios_lists = array(
			'18vr',
			'babevr',
			'bcvr',
			'kinkvr',
			'vrcx',
			'rjvr',
			
			'vrbanger',

			'sexbabesvr',    // csv
			'stasyqvr',		 // csv
			'vrconk',		 //csv

			'naughtyamerica' // xml

		);
		
		$this->dataConverter = new Wp_Gallery_Tube_Convert();
		$this->dataImporter = new Wp_Gallery_Tube_Database();


		$this->get_list_studios();
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
		

		if (isset($_POST['sub'])) {
			$start = microtime(TRUE);
			file_put_contents(plugin_dir_path( dirname( __FILE__ ) ).'log.log',date("Y-m-d H:m:s").' start :'.time().'-'.'');
			$this->wp_gallery_tube_start_insert_data();
			$end = microtime(TRUE);
			file_put_contents(plugin_dir_path( dirname( __FILE__ ) ).'log.log','end: '.time(). '|total time :' . ($end - $start) . " seconds to complete.", FILE_APPEND);
		}

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


	private function get_list_import_data(){

		$this->json_data_path_badoink = array(
			'18vr',
			'babevr',
			'bcvr',
			'kinkvr',
			'vrcx'
		);
		
		$this->json_data_path_vrbanger = array(
			'vrbanger-straight',
			'vrbanger-trans',
			'vrbanger-gay'
		);

		$this->csv_data_path = array(

			'rjvr',
			'sexbabesvr',
			'stasyqvr',
			'vrconk'

		);

		$this->xml_data_path = array(
			'naughtyamerica'
		);

	}
	private function get_list_studios(){

		foreach ($this->studios_lists  as $key => $value) {
			$this->studios_map[$value] = $this->dataImporter->gallery_tube_insert_studios(array('studio_name' => $value));
		}
	}
	
	/**
	 * wp_gallery_tube_get_data_latest
	 *
	 * @return void
	 */
	public function wp_gallery_tube_get_data_latest(){
		


	}	
	

	private function loopInsertData($converted_data){
		foreach ($converted_data as $key => $datas_import) {
			
			
			$datas_import['studio'] = $this->studios_map[$datas_import['studio']];

			$tube_id = $this->dataImporter->gallery_tube_insert_tubes($datas_import);

			if ($tube_id ) {

				$this->loopInsertScenePornstar($tube_id, $datas_import['pornstar']);
	
				$this->loopInsertSceneTag($tube_id, $datas_import['tags']);

			}

		}
	}
	private function loopInsertScenePornstar($tube_id, $pornstars){
		if ($pornstars && count($pornstars)) {

			foreach ($pornstars as $key => $value) {
	
				$pornstar_id = $this->dataImporter->gallery_tube_insert_pornstars(array(
					'name' => $value,
					'slug' => sanitize_title($value)
				));
				$this->dataImporter->gallery_tube_insert_scene_pornstar(array(
					'tube_id' 		=>  $tube_id,
					'pornstar_id' 	=> $pornstar_id
				));
			}
		}
	}

	private function loopInsertSceneTag($tube_id, $tags){
		if ($tags && count($tags)) {

			foreach ($tags as $key => $value) {
	
				$tag_id = $this->dataImporter->gallery_tube_insert_tags(array(
					'name' => $value
				));
				$this->dataImporter->gallery_tube_insert_scene_tag(array(
					'tube_id' 		=>  $tube_id,
					'tag_id' 		=> $tag_id
				));
			}
		}
	}
	/**
	 * wp_gallery_tube_start_insert_data
	 *
	 * @return void
	 */
	public function wp_gallery_tube_start_insert_data(){

		foreach ($this->json_data_path_badoink as $key => $json_file) {
			$data_from_json_badoink = $this->dataConverter->read_JSON($json_file);
			$brand_name = $json_file;
			$converted_json_badoink = $this->dataConverter->JsonConvert_badoink($data_from_json_badoink, $brand_name);
		
			$this->loopInsertData($converted_json_badoink);
		}
		
		

		
		foreach ($this->json_data_path_vrbanger as $key => $json_file) {			
			$data_from_json_vrbanger = $this->dataConverter->read_JSON($json_file);	

			$converted_json_vrbanger = $this->dataConverter->JsonConvert_vrbanger($data_from_json_vrbanger, 'vrbanger');
			
			$this->loopInsertData($converted_json_vrbanger);
		}
		
		foreach ($this->csv_data_path as $key => $csv_file) {
			
			$data_from_csv = $this->dataConverter->read_CSV($csv_file);
			
			$brand_name = $csv_file;
			$converted_csv= $this->dataConverter->CSVConvert_hightech($data_from_csv, $brand_name);
			
			$this->loopInsertData($converted_csv);
		} 
		
		/* foreach ($this->xml_data_path as $key => $xml_file) {
			$data_from_xml = $this->dataConverter->readXML($xml_file);
			$brand_name = $json_file;
		}

		$data_from_xml = $data_from_xml->entry;
		
		$converted_xml = $this->dataConverter->XMLConvert_Naughty($data_from_xml, $brand_name); */


		

	}


	public function wp_gallery_tube_get_tubes(){
		echo json_encode($this->dataImporter->gallery_tube_get($_POST, "tubes"));
		die();
	}
	public function wp_gallery_tube_get_studios(){
		echo json_encode($this->dataImporter->gallery_tube_get($_POST, "studios"));
		die();
	}
	public function wp_gallery_tube_get_pornstars(){
		echo json_encode($this->dataImporter->gallery_tube_get($_POST, "pornstars"));
		die();
	}
	public function wp_gallery_tube_get_tags(){
		echo json_encode($this->dataImporter->gallery_tube_get($_POST, "tags"));
		die();
	}


}
