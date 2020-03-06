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
    
    
    public function JsonConvert_badoinkJ($json_data, $brand){
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
                'pornstar'      => json_encode(is_array($scene['pornStars'])?$scene['pornStars']:explode(',',$scene['pornStars']) ),
                'tags'          => json_encode(is_array($scene['tags'])?$scene['tags']:explode(',',$scene['tags'])),

                'scence_identity' => $brand.'-'.$scene['sceneId']   
            ); 
        }
        return $results;
    }
    public function JsonConvert_vrbanger($json_data, $type) {
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
                'pornstar'      => json_encode($scene['Pornstars']),
                'tags'          => json_encode($scene['Tags']),

                'scence_identity' => $brand.'-'.$scene['Scene_ID']   
            ); 
        }
        return $results;
    }
    private function read_JSON($path){
        if (file_exists($path)) {
            $data = file_get_contents($path);
            if ($data) {
                return json_decode($data);
            }
        }
        return array();
    }
    private function read_CSV($path){
        $arr = array();
        if (($handle = fopen($path, 'r')) !== FALSE) {
            $i = 0;
            $headers = array();
            while (($lineArray = fgetcsv($handle, 40000, $delimiter, '"')) !== FALSE) {
                for ($j = 0; $j < count($lineArray); $j++) {
                    if($i == 0){
                        $headers[$j] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',htmlspecialchars($lineArray[$j]) );
                    }else{
                        $arr[$i - 1][$headers[$j]] = $lineArray[$j];
                    }

                }
                $i++;
            }
            fclose($handle);
        }
        return $arr;
    }
    private function readXML($path){
        if (file_exists($path)) {
            $data = file_get_contents($path);
            if ($data) {
                $safestring = $this->characterToHTMLEntity($data);
                $safestring = str_replace("&", "&amp;", $safestring);
                $xml = simplexml_load_string($safestring, "SimpleXMLElement", LIBXML_NOCDATA);
                return $xml;
            }
        }
        return array();
    }


    public function CSVConvert_hightech($csv_data, $brand){
        $results = array();
        foreach ($csv_data as $key => $scene) {

            $results[] = array(
                'title'         => $scene['title'],
                'video_length'  => $scene['duration'],
                'description'   => isset($scene['description'])?($scene['description']?$scene['description']:''):'',
                'releaseDate'   => isset($scene['releaseDate'])?($scene['releaseDate']?$scene['releaseDate']:''):'',
                'video_url'     => isset($scene['scene_url'])?($scene['scene_url']?$scene['scene_url']:''):'',
                'fps'           => isset($scene['fps'])?($scene['fps']?$scene['fps']:''):'',
                'degrees'       => isset($scene['degrees'])?($scene['degrees']?$scene['degrees']:''):'',
                'src_image'     => isset($scene['thumb_url'])?($scene['thumb_url']?$scene['thumb_url']:''):'',

                'studio'        => $brand,
                'pornstar'      => json_encode(is_array($scene['pornStars'])?$scene['pornStars']:explode(',',$scene['pornStars']) ),
                'tags'          => json_encode(is_array($scene['tags'])?$scene['tags']:explode(',',$scene['tags'])),

                'scence_identity' => $brand.'-'.$scene['sceneId']   
            ); 
        }
        return $results;
    }

    public function XMLConvert_Naughty($xml_data, $brand){
        $results = array();
        foreach ($csv_data as $key => $scene) {

            $results[] = array(
                'title'         => $scene['title'],
                'video_length'  => $scene['duration'],
                'description'   => isset($scene['description'])?($scene['description']?$scene['description']:''):'',
                'releaseDate'   => isset($scene['releaseDate'])?($scene['releaseDate']?$scene['releaseDate']:''):'',
                'video_url'     => isset($scene['scene_url'])?($scene['scene_url']?$scene['scene_url']:''):'',
                'fps'           => isset($scene['fps'])?($scene['fps']?$scene['fps']:''):'',
                'degrees'       => isset($scene['degrees'])?($scene['degrees']?$scene['degrees']:''):'',
                'src_image'     => isset($scene['thumb_url'])?($scene['thumb_url']?$scene['thumb_url']:''):'',

                'studio'        => $brand,
                'pornstar'      => json_encode(is_array($scene['pornStars'])?$scene['pornStars']:explode(',',$scene['pornStars']) ),
                'tags'          => json_encode(is_array($scene['tags'])?$scene['tags']:explode(',',$scene['tags'])),

                'scence_identity' => $brand.'-'.$scene['sceneId']   
            ); 
        }
        return $results;
    }
    


}
