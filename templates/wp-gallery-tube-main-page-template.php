<?php 
/**
* Template name : WP Gallery Tube Template
* author: lampvu
* email: yourmindhasgone@gmail.com
*/

$plugin_name  = 'wp-gallery-tube';

/** functions */
function hoursandmins($time, $format = '%02d:%02d'){
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
function getStudios(){
    global $wpdb;
    return $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."gallery_tube_studios ;");
}
function getPornstars(){
    global $wpdb;
    return $wpdb->get_results("SELECT A.id, A.name ,A.slug, A.photo ,COUNT(C.id) as num_scene
                            FROM ".$wpdb->prefix."gallery_tube_pornstars A LEFT JOIN ".$wpdb->prefix."gallery_tube_scene_star B 
                            ON B.pornstar_id = A.id 
                            LEFT JOIN ".$wpdb->prefix."gallery_tube C ON C.id= B.tube_id  
                             GROUP BY A.id ORDER BY num_scene  DESC  LIMIT 12");
}
function getTotalScenes(){
    global $wpdb;
    return $wpdb->get_var("SELECT COUNT(*) FROM ".$wpdb->prefix."gallery_tube ;");
}
function getSceneHome($page){
    $page = $page-1;
    global $wpdb;
    $res = $wpdb->get_results("SELECT A.id, A.title, A.video_length, A.video_url, A.site_src, A.fps, A.degrees, A.scene_identity, A.src_image, B.studio_nicename, B.studio_name
                                FROM ".$wpdb->prefix."gallery_tube A JOIN ".$wpdb->prefix."gallery_tube_studios B ON A.studio = B.id 
                                 ORDER BY A.id ASC LIMIT ".($page*12)." , 12 
                                " );
    if ($res && count($res)) {
        foreach ($res as $key => $tube) {            
            //$res[$key]->tags = $wpdb->get_results("SELECT A.name FROM ".$wpdb->prefix."gallery_tube_tags A JOIN ".$wpdb->prefix."gallery_tube_scene_tag B ON A.id=B.tag_id WHERE A.tube_id=".$tube->id );
            $t   = $wpdb->get_results("SELECT A.name, A.slug FROM ".$wpdb->prefix."gallery_tube_pornstars A LEFT JOIN ".$wpdb->prefix."gallery_tube_scene_star B ON A.id=B.pornstar_id WHERE B.tube_id=".$tube->id );
            $res[$key]->pornstars  = $t;            

        }
    }

    return $res;
}

function searchSceneTags($searchString){
    global $wpdb;
    $searchString = "%".$wpdb->esc_like(strtoupper ($searchString))."%";
    return $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."gallery_tube_tags WHERE (name) LIKE %s LIMIT 12;", array($searchString) ) );    
}
function searchScenePornstar($searchString){
    global $wpdb;
    $searchString = "%".$wpdb->esc_like(strtoupper ($searchString))."%";
    return  $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."gallery_tube_pornstars WHERE (name) LIKE %s  OR (aliases) LIKE %s LIMIT 12;", array($searchString, $searchString)  ));       
}
function searchScene($searchString){
    global $wpdb;
    $searchString = "%".$wpdb->esc_like(strtoupper ($searchString))."%";
    $searchStringStudio = $wpdb->esc_like(strtoupper ($searchString))."%";
    $res =   $wpdb->get_results( $wpdb->prepare( "SELECT A.id, A.title, A.video_length, A.video_url,A.fps,A.site_src, A.degrees, A.scene_identity, A.src_image, B.studio_nicename, B.studio_name
                                                FROM ".$wpdb->prefix."gallery_tube A JOIN ".$wpdb->prefix."gallery_tube_studios B ON A.studio = B.id 
                                                WHERE (A.title) LIKE %s OR (A.description) LIKE %s OR (A.releaseDate) LIKE %s OR (B.studio_name) LIKE %s     LIMIT 12; " ,
                                                array($searchString, $searchString, $searchString, $searchStringStudio) 
                                            ) );   
    if ($res && count($res)) {
        foreach ($res as $key => $tube) {
            $t   = $wpdb->get_results("SELECT A.name, A.slug FROM ".$wpdb->prefix."gallery_tube_pornstars A LEFT JOIN ".$wpdb->prefix."gallery_tube_scene_star B ON A.id=B.pornstar_id WHERE B.tube_id=".$tube->id );
            $res[$key]->pornstars  = $t; 
        }
    }
    return $res;
}

$sceneHome_results = null;
$searchString="";
if (isset($_GET['q']) && $_GET['q']) {
    $searchString = trim($_GET['q']);
    if ($searchString) {
    
        $searchedTags = searchSceneTags($searchString);
        $searchedPornstar = searchScenePornstar($searchString);
        $searchedScene = searchScene($searchString);

    }

}
$page_num=1;
if (isset($_GET['page_n']) && intval($_GET['page_n'])) {
    $page_num = intval($_GET['page_n']);
    
}

?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, minimum-scale=1">
<meta name="theme-color" content="#000000">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php 
wp_head();

if ($searchString) {
    
    include  $plugin_name . '-search-result-page-template.php';
}
else {


$studios = getStudios();
$pornstars = getPornstars();
$total_scenes = getTotalScenes();
$max_page_num = floor($total_scenes/12) +1;

if ( false === ( $sceneHome_results = get_transient( 'SceneHome_results_'.$page_num ) ) ) {
    // It wasn't there, so regenerate the data and save the transient

     $sceneHome_results = getSceneHome($page_num);
     set_transient( 'SceneHome_results_'.$page_num, $sceneHome_results, DAY_IN_SECONDS );
}

$custom_logo_id = get_theme_mod( 'custom_logo' );
$site_logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );



?>



<article id="page-top" class="gallery-tube-bs">
    <nav class="navbar navbar-expand navbar-light bg-white static-top osahan-nav sticky-top">
        &nbsp;&nbsp;
        <button class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle" aria-label="sidebar">
            <i class="fas fa-bars"></i>
        </button> &nbsp;&nbsp;
        <a class="navbar-brand mr-1" href="/">
            <img class="img-fluid" alt="" src="<?=$site_logo[0]? $site_logo[0]: (plugins_url('wp-gallery-tube').'/public/img/site-logo.png') ?>">
            </a>
        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline  osahan-navbar-search " style="margin:0;width:100%;"  method="get" action="">
            <div class="input-group">
                <input type="text" name="q" class="form-control" value="" placeholder="Search for Pornstars, Tags, Studios ... ">
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
            <li class="nav-item active">
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
            <li class="nav-item">
                <a class="nav-link" href="<?=home_url('pornstars')?>">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Porn Stars</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=home_url('tags')?>">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>Tags</span>
                </a>
            </li>

        </ul>
        <div id="content-wrapper">
            <div class="container-fluid pb-0">
                <div class="top-mobile-search">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="mobile-search">
                                <div class="input-group">
                                    <input type="text" placeholder="Search for title, pornstar, tags and others"
                                        class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-dark"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="top-category section-padding mb-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title">
                                <div class="btn-group float-right right-action">
                                    <a href="<?=home_url('studios')?>" class="right-action-link text-gray" >
                                        View All
                                    </a>
                                   
                                </div>
                                <h3>Studios</h3>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="owl-carousel owl-carousel-category">
                                <?php   if ($studios && count($studios)) { 
                                foreach ($studios as $key => $studio) {                                  
                                
                                ?>
                                <div class="item">
                                    <div class="category-item">
                                        <a href="<?= home_url('studios/'.$studio->studio_name) ?>">
                                            <img class="img-fluid"
                                                src="<?= $studio->logo? $studio->logo:   (plugins_url('wp-gallery-tube').'/public/img/thumbnail-img.jpg') ?>" alt="">
                                            <h6><?=$studio->studio_nicename ? $studio->studio_nicename : $studio->studio_name ?> <span title="" data-placement="top" data-toggle="tooltip"
                                                    data-original-title=""><i
                                                        class="fas fa-check-circle text-success"></i></span></h6>
                                            
                                        </a>
                                    </div>
                                </div>

                                <?php }} ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="video-block section-padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title">
                                <!-- <div class="btn-group float-right right-action">
                                    <a href="#" class="right-action-link text-gray" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Sort by <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-star"></i> &nbsp; Top
                                            Rated</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-signal"></i> &nbsp;
                                            Viewed</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-times-circle"></i>
                                            &nbsp; Close</a>
                                    </div>
                                </div> -->
                                <h3>Featured Videos</h3>
                            </div>
                        </div>

                        <?php if ($sceneHome_results && count($sceneHome_results)) { 
                       foreach ($sceneHome_results as $key => $scene) {
                        

                     ?>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="video-card preview-video">
                                <div class="video-card-image">
                                    <a class="play-icon" href="#"><i class="fas fa-play-circle"></i></a>
                                    <a href="<?=home_url('scene/'.$scene->scene_identity)?>"><img class="img-fluid"
                                            src="<?=($scene->src_image?$scene->src_image:(plugins_url('wp-gallery-tube').'/public/img/thumbnail-img.jpg'))?>"
                                            alt="previewimg"></a>
                                    <div class="time"><?=hoursandmins($scene->video_length, '%02d:%02d')?></div>
                                </div>
                                <div class="video-card-body">
                                    <div class="video-title">
                                        <a href="<?=home_url('scene/'.$scene->scene_identity)?>"
                                            class="ellipsis"><?= str_replace( ["cock","fuck", "dick", "pussy","anal"], ["c*ck", "f*ck","d*ck", "p*ssy","an*l"]  , (strlen($scene->title) > 50 ? substr($scene->title,0,50)."..." : $scene->title  ) ) ?></a>
                                    </div>
                                    
                                    <div class="" style="display:flex;justify-content: space-between;">
                                        <a  href="<?=home_url('studios/'.$scene->studio_name)?>" style="color: #4eda92;">
                                            <?=$scene->studio_nicename ? $scene->studio_nicename : $scene->studio_name ?> 
                                            <span title="" data-placement="top" data-toggle="tooltip" href="#"   data-original-title="">
                                                <i  class="fas fa-check-circle text-success"></i></span>
                                        </a> 

                                        <a   rel="noreferrer nofollow sponsored " target="_blank" href="<?=(strpos($scene->video_url, "http")!==false )?$scene->video_url:("https://".$scene->video_url)  ?><?=get_option('af_'.$scene->site_src.'_param')?("?".get_option('af_'.$scene->site_src.'_param')."=".(get_option('affiliate_code_'.$scene->site_src)?get_option('affiliate_code_'.$scene->site_src):"")   ):""  ?>" class="btn btn-info btn-outline btn-sm">VIEW UNCENSORED</a>
                                    </div>
                                    <div class="video-view">
                                        
                                        <?=$scene->degrees? ($scene->degrees. '&deg;') : ""?>
                                        <?=$scene->fps? ($scene->fps." FPS"):""?>
                                        <span></span>
                                        <span class="float-right">
                                            <?php 
                                           
                                            $pornstars_view = array();
                                            if ($scene->pornstars && count($scene->pornstars)) {
                                                foreach ($scene->pornstars as $key => $pornstar) {
                                                   $pornstars_view[] = '<a href="/pornstars/'.$pornstar->slug.'">'.$pornstar->name.'</a>';
                                                }
                                            }
                                            echo implode(",", $pornstars_view);

                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php } }  ?>


                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center pagination-sm mb-0">
                            
                            <li class="page-item <?=($page_num<2)?"disabled":""?>">
                                <a class="page-link" href="<?=($page_num >=2)? ("?page_n=".($page_num-1 )) :"?page_n=1" ?><?=isset($_GET['sort'])?'&sort='.$_GET['sort']:'' ?> " tabindex="-1">Previous</a>
                            </li>
                            <?php
                            if ($max_page_num >0) {
                            ?>
                            <li class="page-item <?=($page_num<2)?"active disabled" :""?>">
                                <a class="page-link" href="<?=($page_num >=2 )? "?page_n=".($page_num-1)   : '?page_n=1'   ?><?=isset($_GET['sort'])?'&sort='.$_GET['sort']:'' ?>"><?=($page_num >=2 )? ( $page_num <= ($max_page_num-2)? ($page_num-1): ($max_page_num-2)   ):1   ?></a>
                            </li>
                            <?php } ?>
                            <?php
                            if ($max_page_num >1) {
                            ?>
                            <li class="page-item <?=($page_num>=2 && $page_num<$max_page_num)?"active disabled" :""  ?>">
                                <a class="page-link" href="?page_n=<?=($page_num>2)? ( ($page_num<$max_page_num-1)? $page_num :($max_page_num-1)  ):2?><?=isset($_GET['sort'])?'&sort='.$_GET['sort']:'' ?>"><?=($page_num>2)? ( ($page_num< ($max_page_num-1) )? $page_num :($max_page_num-1)  ):2?></a>
                            </li>
                            <?php } ?>
                            <?php
                            if ($max_page_num >2) {
                            ?>
                            <li class="page-item <?=($page_num>=$max_page_num)?"active disabled" :""  ?>">
                                <a class="page-link" href="?page_n=<?=($page_num>2)?( ($page_num<$max_page_num)?($page_num+1):$max_page_num   ):3  ?><?=isset($_GET['sort'])?'&sort='.$_GET['sort']:'' ?>"><?=($page_num>2)?( ($page_num<$max_page_num)?($page_num+1):$max_page_num   ):3  ?></a>
                            </li>
                            <?php } ?>
                            <li class="page-item  <?=($page_num>=$max_page_num)?"disabled":""?>">
                                <a class="page-link" href="<?=("?page_n=".($page_num+1)) ?><?=isset($_GET['sort'])?'&sort='.$_GET['sort']:'' ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <hr class="mt-0">
                <div class="video-block section-padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title">
                            <div class="btn-group float-right right-action">
                                    <a href="<?=home_url('pornstars')?>" class="right-action-link text-gray" >
                                        View All
                                    </a>
                                   
                                </div>
                                <h3>Popular Porn Stars</h3>
                            </div>
                        </div>

                        <?php  if ($pornstars  && count($pornstars) ) {
                            
                            foreach ($pornstars as $key => $pornstar) {
                                # code...
                            
                            ?>

                        <div class="col-xl-3 col-sm-4 mb-3">
                            <div class="channels-card">
                                <div class="channels-card-image">
                                    <a href="<?= home_url('pornstars/'.$pornstar->slug) ?>"><img class="img-fluid"
                                            src="<?=$pornstar->photo?$pornstar->photo:(plugins_url('wp-gallery-tube').'/public/img/thumbnail-img.jpg') ?>" alt=""></a>
                                    <div class="channels-card-image-btn">
                                        <a type="button" href="<?= home_url('pornstars/'.$pornstar->slug) ?>"
                                            class="btn btn-outline-danger btn-sm">View
                                            </a>
                                        </div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="<?=home_url('/pornstars/'.$pornstar->slug) ?>"><?=$pornstar->name?></a>
                                    </div>
                                    <div class="channels-view">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php  }} ?>
                        
                    </div>
                </div>
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
    
</article>

<?php } ?>

<?php

wp_footer();
?>