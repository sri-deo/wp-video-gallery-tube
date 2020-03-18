<?php 
/**
* Template name : WP Gallery Tube Template
* author: lampvu
* email: yourmindhasgone@gmail.com
*/

$plugin_name  = 'wp-gallery-tube';
$pornstar_slug = get_query_var('star');

function hoursandmins($time, $format = '%02d:%02d'){
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
function getPornstars($page= 0, $sort=0){

    global $wpdb;
    $page = $page-1;
    if ($sort ==0 ) {
        return $wpdb->get_results("SELECT A.*, COUNT(C.id) as num_scene 
                                    FROM ".$wpdb->prefix."gallery_tube_pornstars  A LEFT JOIN ".$wpdb->prefix."gallery_tube_scene_star B 
                                    ON B.pornstar_id = A.id 
                                    LEFT JOIN ".$wpdb->prefix."gallery_tube C ON C.id= B.tube_id  
                                    GROUP BY A.id  ORDER BY A.slug ASC LIMIT ".($page*12)." , 12 ;");
    } else if ($sort ==1) {
        return $wpdb->get_results("SELECT A.id, A.name ,A.slug ,COUNT(C.id) as num_scene
                                    FROM ".$wpdb->prefix."gallery_tube_pornstars A LEFT JOIN ".$wpdb->prefix."gallery_tube_scene_star B 
                                    ON B.pornstar_id = A.id 
                                    LEFT JOIN ".$wpdb->prefix."gallery_tube C ON C.id= B.tube_id  
                                    GROUP BY A.id ORDER BY num_scene  DESC  LIMIT ".($page*12)." , 12  ;"                                
                                );
    }
}
function getTotalPornStars() {
    global $wpdb;
    return $wpdb->get_var("SELECT COUNT(id) FROM ".$wpdb->prefix."gallery_tube_pornstars ;");
}

function getPornstar($slug, $page=0, $sort=0) {
    global $wpdb;
    $pornstar =  $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."gallery_tube_pornstars WHERE slug=%s   ;" , array($slug) ) );
    
    if ($pornstar) { 
        $page = $page-1;

        if ($sort==0) {
            $sort=" A.title ";
        } else if ($sort==1) {
            $sort = "A.video_length * 1 ";
        }
        
        $pornstar->scenes = $wpdb->get_results("SELECT A.id, A.title, A.video_length,A.video_url,A.site_src, A.fps, A.degrees, A.scene_identity, A.src_image, B.studio_nicename, B.studio_name, B.logo
                                        FROM ".$wpdb->prefix."gallery_tube A JOIN ".$wpdb->prefix."gallery_tube_studios B ON A.studio = B.id
                                        LEFT JOIN ".$wpdb->prefix."gallery_tube_scene_star C ON C.tube_id = A.id
                                        
                                        WHERE  C.pornstar_id = ".$pornstar->id." 
                                        ORDER BY $sort ASC LIMIT ".($page*12)." , 12 ;");

        if ($pornstar->scenes && count($pornstar->scenes))         {
            foreach ($pornstar->scenes as $key => $scene   ) {
                $pornstar->scenes[$key]->tags = $wpdb->get_results("SELECT A.name FROM ".$wpdb->prefix."gallery_tube_tags A 
                                                                JOIN ".$wpdb->prefix."gallery_tube_scene_tag B ON B.tag_id = A.id 
                                                                WHERE B.tube_id= ".$scene->id."  ORDER BY A.name ASC LIMIT 3 ; " );
            }            
        }        
        return $pornstar;                               
    }
    else return 0;
}

function getPornStarTotalScenes($slug){
    global $wpdb;
    $pornstar =  $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."gallery_tube_pornstars WHERE slug=%s   ;" , array($slug) ) );

    if ($pornstar) {
        return $wpdb->get_var("SELECT COUNT(A.id)
                                        FROM ".$wpdb->prefix."gallery_tube A JOIN ".$wpdb->prefix."gallery_tube_studios B ON A.studio = B.id
                                        LEFT JOIN ".$wpdb->prefix."gallery_tube_scene_star C ON C.tube_id = A.id                                        
                                        WHERE  C.pornstar_id = ".$pornstar->id." ;");
    } else return 0;
}


$page=0;
$sort=0;
$page_num=1;
if (isset($_GET['sort'])) {
    $sort = trim($_GET['sort']);
}
if (isset($_GET['page_n']) && intval($_GET['page_n'])) {
    $page_num = intval($_GET['page_n']);        
}
$pornstar=null;

if ($pornstar_slug){
       
    switch ($sort) {
        case 'title':
            $sort=0;
            break;
        case 'length':
            $sort=1;
            break;
        
        default:
            $sort=0;
            break;
    }
    
    $pornstar = getPornstar($pornstar_slug, $page_num, $sort);
    
    if (!$pornstar) {
        wp_redirect(home_url('pornstars'));
    }

    $total_scenes = getPornStarTotalScenes($pornstar_slug);
    $max_page_num = floor($total_scenes/12) +1;    
    if ($page_num >= $max_page_num) {
        $page_num = $max_page_num;
    }

    // add dynamic page title
    function wp_gallery_tube_dynamic_titlepornstar() {
        global $pornstar;
        return "Pornstar: ".$pornstar->name." - ".get_bloginfo('name'); // add dynamic content to this title (if needed)
    }
    add_action( 'pre_get_document_title', 'wp_gallery_tube_dynamic_titlepornstar');
    

} else {

    switch ($sort) {
        case 'name':
            $sort=0;
            break;
        case 'scenes':
            $sort=1;
            break;        
        default:
            $sort=0;
            break;
    }

    
    if ( false === ( $total_pornstars = get_transient( 'total_pornstars' ) ) ) {
        // It wasn't there, so regenerate the data and save the transient    
        $total_pornstars = getTotalPornStars();
        set_transient( 'total_pornstars', $total_pornstars, WEEK_IN_SECONDS );
    }
    $max_page_num = floor($total_pornstars/12) +1;    
    if ($page_num >= $max_page_num) {
        $page_num = $max_page_num;
    }

    $pornstars = getPornstars($page_num, $sort);
    
}


$custom_logo_id = get_theme_mod( 'custom_logo' );
$site_logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

wp_head();

?>



<?php 


if ($pornstar) {
    include  $plugin_name . '-single-pornstar-page-template.php';
} else { ?>

<article id="page-top" class="gallery-tube-bs">
    <nav class="navbar navbar-expand navbar-light bg-white static-top osahan-nav sticky-top">
        &nbsp;&nbsp;
        <button class="btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button> &nbsp;&nbsp;
        <a class="navbar-brand mr-1" href="/"><img class="img-fluid" alt=""
                src="<?=$site_logo[0]? $site_logo[0]: (plugins_url('wp-gallery-tube').'/public/img/site-logo.png') ?>"></a>
        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline  osahan-navbar-search" method="get" action="<?=home_url('library')?>">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search for Pornstars, Tags, Studios ... ">
                <div class="input-group-append">
                    <button class="btn btn-light" type="submit">
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
            <li class="nav-item active">
                <a class="nav-link" href="<?=home_url('pornstars')?>">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Porn Stars</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=home_url('tags')?>">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>Categories</span>
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
                                        <a class="dropdown-item" href="<?=isset($_GET['sort'])?(preg_replace(array("#\&sort=([A-Za-z]+)\S*#","#\?sort=([A-Za-z]+)\S*#"), array("&sort=name","?sort=name"), $_SERVER['REQUEST_URI'])):  ( isset($_GET['page_n']) ? ($_SERVER['REQUEST_URI'].'&sort=name' ) : ($_SERVER['REQUEST_URI'].'?sort=name') )  ?>"><i class="fas fa-fw fa-star"></i> &nbsp; Name</a>
                                        <a class="dropdown-item" href="<?=isset($_GET['sort'])?(preg_replace(array("#\&sort=([A-Za-z]+)\S*#","#\?sort=([A-Za-z]+)\S*#"), array("&sort=scenes","?sort=scenes"), $_SERVER['REQUEST_URI'])):  ( isset($_GET['page_n']) ? ($_SERVER['REQUEST_URI'].'&sort=scenes') : ($_SERVER['REQUEST_URI'].'?sort=scenes') )  ?>"><i class="fas fa-fw fa-signal"></i> &nbsp;
                                            Total Scenes</a>   
                                       
                                    </div>
                                </div>
                                <h3>Pornstars</h3>
                            </div>
                        </div>

                        <?php if ($pornstars && count($pornstars)) {
                            
                            foreach ($pornstars as $key => $pornstar) {
                                # code...
                            
                            ?>
                        
                        <div class="col-xl-3 col-sm-6 mb-3">
                            
                            <div class="channels-card">
                                
                                <div class="channels-card-image">
                                    <a href="<?= home_url('pornstars/'.$pornstar->slug) ?>">
                                        <img class="img-fluid"
                                            src="<?=$pornstar->photo?$pornstar->photo:(plugins_url('wp-gallery-tube').'/public/img/thumbnail-img.jpg') ?>" alt="">
                                    </a>
                                    <div class="channels-card-image-btn">
                                        <a    class="btn btn-outline-danger btn-sm" href="<?=home_url('pornstars/'.$pornstar->slug)?>">View</a>
                                    </div>
                                </div>

                                <div class="channels-card-body">
                                    <div class="channels-title">
                                        <a href="<?=home_url('pornstars/'.$pornstar->slug)?>"><?=$pornstar->name?></a>
                                    </div> 
                                    <div>
                                    <?=$pornstar->num_scene?> Scenes
                                    </div>                                  
                                </div>
                            
                            </div>
                        </div>
                        
                        <?php }} ?>
                        
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
                <hr>
                
            </div>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
            <footer class="sticky-footer ml-0">
                <div class="">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-sm-6">
                            <p class="mt-1 mb-0">&copy; Copyright 2020 <strong class="text-dark"></strong>. All
                                Rights Reserved<br>
                               
                            </p>
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