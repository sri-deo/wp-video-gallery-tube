<?php 
/**
* Template name : WP Gallery Tube Tags Template
* author: lampvu
* email: yourmindhasgone@gmail.com
*/

$plugin_name  = 'wp-gallery-tube';
$tag_name = get_query_var('tag');


function hoursandmins($time, $format = '%02d:%02d'){
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
function getTags($page=0, $sort=0){
    global $wpdb;

    switch ($sort) {
        case 0:
            $sort =' A.name ASC ';
            break;
        case 1:
            $sort =' A.name DESC ';
            break;
        case 2:
            $sort = ' num_scene DESC ';
            break;
        case 3:
            $sort = ' num_scene ASC ';
            break;
        
        default:
            $sort =' A.name ASC ';
            break;
    }   

    return  $wpdb->get_results("SELECT A.id, A.name ,COUNT(C.id) as num_scene
                            FROM ".$wpdb->prefix."gallery_tube_tags A LEFT JOIN ".$wpdb->prefix."gallery_tube_scene_tag B 
                            ON B.tag_id = A.id 
                            LEFT JOIN ".$wpdb->prefix."gallery_tube C ON C.id= B.tube_id  GROUP BY A.id ORDER BY $sort;"                                
);
}

function getTag($tag, $page =0, $sort=0) {
    global $wpdb;
    
    $tag =  $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."gallery_tube_tags WHERE name like %s   ;" , array("%".$wpdb->esc_like(urldecode ($tag))."%") ) );

    if ($tag) {
        $page = $page-1;
        switch ($sort) {
            case 0:
                $sort= " A.title ASC ";
                break;
            case 1:
                $sort= " A.title DESC ";
                break;
            case 2:
                $sort= " A.video_length * 1 DESC ";
                break;
            case 3:
                $sort= " A.video_length * 1 ASC ";
                break;
            
            default:
                $sort= " A.title ASC ";
                break;
        }
        
        $tag->scenes = $wpdb->get_results("SELECT A.id, A.title, A.video_length,A.site_src, A.video_url, A.fps, A.degrees, A.scene_identity, A.src_image, B.studio_nicename, B.studio_name, B.logo
                                        FROM ".$wpdb->prefix."gallery_tube A JOIN ".$wpdb->prefix."gallery_tube_studios B ON A.studio = B.id
                                        LEFT JOIN ".$wpdb->prefix."gallery_tube_scene_tag C ON C.tube_id = A.id
                                        
                                        WHERE  C.tag_id = ".$tag->id." 
                                        ORDER BY $sort  LIMIT ".($page*12)." , 12");

        
        
        if ($tag->scenes && count($tag->scenes)) {
            foreach ($tag->scenes as $key => $scene ) {
                $tag->scenes[$key]->pornstars = $wpdb->get_results("SELECT A.name, A.slug FROM ".$wpdb->prefix."gallery_tube_pornstars A 
                                                                JOIN ".$wpdb->prefix."gallery_tube_scene_star B ON B.pornstar_id = A.id 
                                                                WHERE B.tube_id= ".$scene->id."  " );
            }
            
        }
        
        return $tag;                               
    }
    else return 0;
}
function getMaxTagScenes($tag){
    global $wpdb; 
    
    $tag =  $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."gallery_tube_tags WHERE name like %s   ;" , array("%".$wpdb->esc_like(urldecode ($tag))."%") ) );
    
    if ($tag) {
        return $wpdb->get_var("SELECT COUNT(*)  FROM ".$wpdb->prefix."gallery_tube A  
                            LEFT JOIN ".$wpdb->prefix."gallery_tube_scene_tag C ON C.tube_id = A.id
                            WHERE  C.tag_id = ".$tag->id."") ; 
    } else return 0;
}



$page=0;
$sort=0;

$tag=null;

if (isset($_GET['sort'])) {
    $sort = trim($_GET['sort']);
}
if ($tag_name){    
     
    switch ($sort) {
        case 'title-a-z':
            $sort=0;
            break;
        case 'title-z-a':
            $sort=1;
            break;
        case 'length-high':
            $sort=2;
            break;                
        case 'length-low':
            $sort=3;
            break;                
        default:
            $sort=0;
            break;
    }
    
    $page_num=1;
    if (isset($_GET['page_n']) && intval($_GET['page_n'])) {
        $page_num = intval($_GET['page_n']);            
    }
    
    $tag = getTag($tag_name, $page_num, $sort);

    if (!$tag) {
        wp_redirect(home_url('tags'));
    } 
    
    $total_scenes = getMaxTagScenes($tag_name);
    
    $max_page_num = floor($total_scenes/12) +1;


    function wp_gallery_tube_dynamic_titletag() {
        global $tag;
        return "Tag: ".$tag->name." - ".get_bloginfo('name');; // add dynamic content to this title (if needed)
    }
    add_action( 'pre_get_document_title', 'wp_gallery_tube_dynamic_titletag');
    
    
} else {
    
    if (isset($_GET['sort'])) {
        $sort = trim($_GET['sort']);
        
        switch ($sort) {
            case 'name-a-z':
                $sort=0;
                break;
            case 'name-z-a':
                $sort=1;
                break;
            case 'scenes-high':
                $sort=2;
                break;
            case 'scenes-low':
                $sort=3;
                break;
            
            default:
                $sort=0;
                break;
        }
    }
    $tags = getTags($page, $sort);
}


$custom_logo_id = get_theme_mod( 'custom_logo' );
$site_logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, minimum-scale=1">
<meta name="theme-color" content="#000000">
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta name="robots" content="noindex, nofollow" />

<?php 
wp_head();


?>


<?php 


if ($tag) {
    include  $plugin_name . '-single-tag-page-template.php';
} else { ?>

<article id="page-top" class="gallery-tube-bs">
    <nav class="navbar navbar-expand navbar-light bg-white static-top osahan-nav sticky-top">
        &nbsp;&nbsp;
        <button class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle" aria-label="sidebar">
            <i class="fas fa-bars"></i>
        </button> &nbsp;&nbsp;
        <a class="navbar-brand mr-1" href="/"><img class="img-fluid" alt=""
                src="<?=$site_logo[0]? $site_logo[0]: (plugins_url('wp-gallery-tube').'/public/img/site-logo.png') ?>"></a>
        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline  osahan-navbar-search" method="get" style="margin:0;width:100%;" action="<?=home_url('library')?>">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search for Pornstars, Tags, Studios ... ">
                <div class="input-group-append">
                    <button class="btn btn-light" type="submit" aria-label="search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
       
    </nav>
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="<?=home_url('library')?>">
                    <i class="fas fa-vr-cardboard"></i>
                    <span>VR Videos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=home_url('studios')?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Studios</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="<?=home_url('pornstars')?>">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Porn Stars</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?=home_url('tags')?>">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>Tags</span>
                </a>
            </li>

        </ul>
        
        <div id="content-wrapper">
            <div class="container-fluid pb-0">
                <div class="video-block section-padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title">
                                <div class="btn-group float-right right-action">
                                    <a href="#" class="right-action-link text-gray" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="?sort=name-a-z"><i class="fas fa-fw fa-star"></i> &nbsp; Alphabet A-Z</a>
                                        <a class="dropdown-item" href="?sort=name-z-a"><i class="fas fa-fw fa-star"></i> &nbsp; Alphabet Z-A</a>
                                        <a class="dropdown-item" href="?sort=scenes-high"><i class="fas fa-fw fa-signal"></i> &nbsp; Most Scenes First</a>
                                        <a class="dropdown-item" href="?sort=scenes-low"><i class="fas fa-fw fa-signal"></i> &nbsp; Least Scenes First</a>
                                        
                                    </div>
                                </div>
                                <h3>Tags</h3>
                            </div>
                        </div>

                        <?php if ($tags && count($tags)) {
                            
                            foreach ($tags as $key => $tag) {
                                # code...
                            
                            ?>
                        
                        <div class="col-xl-2 col-sm-6 mb-3 text-center">
                            <a href="<?=home_url('tags/'.trim($tag->name))?>">
                                <div class="box">
                                <b><?=$tag->name?></b>
                                <div>
                                <?=$tag->num_scene?> Scenes
                                </div>
                                </div>
                            </a>
                            
                        </div>
                        
                        <?php }} ?>
                        
                    </div>
                    
                </div>
                <hr>
                
            </div>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
            <footer class="sticky-footer ml-0">
                <div class="">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-sm-6">
                            
                        </div>
                        <div class="col-lg-6 col-sm-6 text-right">
                            <div class="app">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        ^
    </a>
   

</section>


<?php }?>
<?php  wp_footer();?>