<?php

/**
 * Fired during plugin activation when need to convert data
 *
 * @link       https://github.com/9kmmr
 * @since      1.0.0
 *
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/includes
 */

/**
 * Fired during plugin activation when need to convert data.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/includes
 * @author     yourmindhasgone <yourmindhasgone@gmail.com>
 */
class Wp_Gallery_Tube_Convert {


    protected $plugin_name = 'wp-gallery-tube';
    
    protected $data_path_json;
    protected $data_path_csv;
    protected $data_path_xml;
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public  function __construct() {

        $this->data_path_json =  plugin_dir_path( dirname( __FILE__ ) ).'datas/json/';
        $this->data_path_csv =  plugin_dir_path( dirname( __FILE__ ) ).'datas/csv/';
        $this->data_path_xml =  plugin_dir_path( dirname( __FILE__ ) ).'datas/xml/';

    }
    public function read_JSON($filename){
        $path = $this->data_path_json.$filename.'.json';
        if (file_exists($path)) {
            $data = file_get_contents($path);
            if ($data) {
                return json_decode($data, true);
            }
        }
        return array();
    }

    public function read_CSV($filename){
        $path = $this->data_path_csv.$filename.'.csv';
        
        $arr = array();

        $file = fopen($path, 'r');

        // Headers
        $headers = fgetcsv($file);

        // Rows
        $data = [];
        while (($row = fgetcsv($file)) !== false)
        {
            $item = [];
            foreach ($row as $key => $value)
                $item[$headers[$key]] = $value ?: null;
            $data[] = $item;
        }

        // Close file
        fclose($file);
        return $data;

    }

    public function readXML($filename){
        $path = $this->data_path_xml.$filename.'.xml';
        if (file_exists($path)) {
            $data = file_get_contents($path);
            if ($data) {
               // $safestring = $this->characterToHTMLEntity($data);
                $safestring = str_replace("&", "&amp;", $data);
                $xml = simplexml_load_string($safestring, "SimpleXMLElement", LIBXML_NOCDATA);
                return $xml;
            }
        }
        return array();
    }
    
    public function JsonConvert_badoink($json_data, $brand){
        $results = array();
        foreach ($json_data as $key => $scene) {

            $results[] = array(
                'title'         => $scene['sceneName'],
                'video_length'  => $scene['length'],
                'description'   => isset($scene['description'])?($scene['description']?$scene['description']:''):'',
                'releaseDate'   => isset($scene['releaseDate'])?($scene['releaseDate']?$scene['releaseDate']:''):'',
                'video_url'     => isset($scene['url'])?($scene['url']?$scene['url']:''):'',
                'fps'           => isset($scene['fps'])?($scene['fps']?$scene['fps']:''):'',
                'degrees'       => isset($scene['degrees'])?($scene['degrees']?$scene['degrees']:''):'',
                'src_image'     => isset($scene['posterImage'])?($scene['posterImage']?$scene['posterImage']:''):'',

                'studio'        => $brand,
                'pornstar'      => (is_array($scene['pornStars'])?$scene['pornStars']:explode(',',$scene['pornStars']) ),
                'tags'          => (is_array($scene['tags'])?$scene['tags']:explode(',',$scene['tags'])),

                'scene_identity' => $brand.'-'.$scene['sceneId']   
            ); 
        }
        return $results;
    }

    public function JsonConvert_vrbanger($json_data, $brand) {
        $results = array();
        foreach ($json_data as $key => $scene) {
            $results[] = array(
                'title'         => $scene['Title'],
                'video_length'  => isset($scene['Full_Length'])?($scene['Full_Length']?$scene['Full_Length']:''):'',
                'description'   => isset($scene['Description'])?($scene['Description']?$scene['Description']:''):'',
                'releaseDate'   => isset($scene['Release_Date'])?($scene['Release_Date']?$scene['Release_Date']:''):'',
                'video_url'     => isset($scene['Video_URL'])?($scene['Video_URL']?$scene['Video_URL']:''):'',
                'fps'           => isset($scene['fps'])?($scene['fps']?$scene['fps']:''):'',
                'src_image'     => isset($scene['Poster'])?($scene['Poster']?$scene['Poster']:''):'',
                'degrees'       => $scene['FOV']?$scene['FOV'][0]:'',

                'studio'        => 'vrbanger',
                'pornstar'      => ($scene['Pornstars']),
                'tags'          => ($scene['Tags']),

                'scene_identity' => $brand.'-'.$scene['Scene_ID']   
            ); 
        }
        return $results;
    }
    
    public function CSVConvert_hightech($csv_data, $brand){
        $results = array();
        foreach ($csv_data as $key => $scene) {
            $tokens = explode('/', $scene['SceneURL']);
            $t = explode('?', $tokens[count($tokens)-1])[0];
            $results[] = array(
                'title'         => $scene['Title'],
                'video_length'  => $scene['Duration (sec)'],
                'description'   => isset($scene['description'])?($scene['description']?$scene['description']:''):'',
                'releaseDate'   => isset($scene['releaseDate'])?($scene['releaseDate']?$scene['releaseDate']:''):'',
                'video_url'     => isset($scene['SceneURL'])?($scene['SceneURL']?$scene['SceneURL']:''):'',
                'fps'           => isset($scene['fps'])?($scene['fps']?$scene['fps']:''):'',
                'degrees'       => isset($scene['degrees'])?($scene['degrees']?$scene['degrees']:''):'',
                'src_image'     => isset($scene['ThumbURL'])?($scene['ThumbURL']?$scene['ThumbURL']:''):'',

                'studio'        => $brand,
                'pornstar'      => (is_array($scene['Pornstars'])?$scene['Pornstars']:explode(',',$scene['Pornstars']) ),
                'tags'          => (is_array($scene['Tags'])?$scene['Tags']:explode(',',$scene['Tags'])),

                'scene_identity' => $brand.'-'.$t  
            ); 
        }
        return $results;
    }

    public function CSVConvert_sexlikereal($csv_data) {
        $results = array();
        foreach ($csv_data as $key => $scene) {
            
            $brand = $scene['Studio'];
            $tokens = explode('/', $scene['SceneURL']);
            $t = explode('?', $tokens[count($tokens)-1])[0];
            $t = explode('-',$t)[0];
            $results[] = array(
                'title'         => $scene['Title'],
                'video_length'  => $scene['Duration (sec)'],
                'description'   => isset($scene['Description'])?($scene['Description']?$scene['Description']:''):'',
                'releaseDate'   => isset($scene['Release date'])?($scene['Release date']?$scene['Release date']:''):'',
                'video_url'     => isset($scene['SceneURL'])?($scene['SceneURL']?$scene['SceneURL']:''):'',
                'fps'           => isset($scene['fps'])?($scene['fps']?$scene['fps']:''):'',
                'degrees'       => isset($scene['degrees'])?($scene['degrees']?$scene['degrees']:''):'',
                'src_image'     => isset($scene['ThumbURL'])?($scene['ThumbURL']?$scene['ThumbURL']:''):'',

                'studio'        => $brand,
                'pornstar'      => (is_array($scene['Pornstars'])?$scene['Pornstars']:explode(',',$scene['Pornstars']) ),
                'tags'          => (is_array($scene['Tags'])?$scene['Tags']:explode(',',$scene['Tags'])),

                'scene_identity' => $brand.'-'.$t  
            ); 
        }
        
        return $results;
    }

    public function XMLConvert_Naughty($xml_data, $brand){
        $results = array();
        foreach ($csv_data as $key => $scene) {

            $results[] = array(
                'title'         => $scene->title,
                'video_length'  => $scene['duration'],
                'description'   => isset($scene['description'])?($scene['description']?$scene['description']:''):'',
                'releaseDate'   => isset($scene['published_date_nice'])?($scene['published_date_nice']?$scene['published_date_nice']:''):'',
                'video_url'     => isset($scene['url'])?($scene['url']?('https://www.naughtyamerica.com/'.$scene['url']):''):'',
                'fps'           => isset($scene['fps'])?($scene['fps']?$scene['fps']:''):'',
                'degrees'       => isset($scene['degrees'])?($scene['degrees']?$scene['degrees']:''):'',
                'src_image'     => isset($scene['thumbnail'])?($scene['thumbnail']?$scene['thumbnail']:''):'',

                'studio'        => $brand,
                'pornstar'      => (is_array($scene['pornStars'])?$scene['pornStars']:explode(',',$scene['pornStars']) ),
                'tags'          => (is_array($scene['tags'])?$scene['tags']:explode(',',$scene['tags'])),

                'scene_identity' => $brand.'-'.$scene['sceneId']   
            ); 
        }
        return $results;
    }
    
}
