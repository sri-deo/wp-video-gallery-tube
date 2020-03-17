<?php 
/**
* Template name : WP Gallery Tube Template
* author: lampvu
* email: yourmindhasgone@gmail.com
*/

$plugin_name  = 'wp-gallery-tube';
$studio_name = get_query_var('studio_name');

function hoursandmins($time, $format = '%02d:%02d'){
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
function getStudios($page=null, $sort=0){
    global $wpdb;
    if ($sort==0) {
        return $wpdb->get_results("SELECT A.*, COUNT(B.id) as count_scene  FROM ".$wpdb->prefix."gallery_tube_studios A LEFT JOIN ".$wpdb->prefix."gallery_tube B ON b.studio=A.id GROUP BY A.id ORDER BY studio_nicename ASC ;");
    } else if ($sort==1) {
        return $wpdb->get_results("SELECT A.*, COUNT(B.id) as count_scene  FROM ".$wpdb->prefix."gallery_tube_studios A LEFT JOIN ".$wpdb->prefix."gallery_tube B ON b.studio=A.id GROUP BY A.id ORDER BY count_scene DESC ;");
    }
}

function getStudio($studio_name,$page=0, $sort=0) {

    $page = $page-1;

    global $wpdb;
    $studio =  $wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."gallery_tube_studios WHERE studio_name=%s   ;" , array($studio_name)));

    if ($studio) {
        if ($sort==0) {
            $sort=" A.title ";
        } else if ($sort==1) {
            $sort = "A.video_length ";
        }

        $studio->scenes = $wpdb->get_results("SELECT A.id, A.title, A.video_length,A.video_url, A.fps, A.degrees, A.scene_identity, A.src_image, B.studio_nicename, B.studio_name, B.logo
                                        FROM ".$wpdb->prefix."gallery_tube A JOIN ".$wpdb->prefix."gallery_tube_studios B ON A.studio = B.id 
                                        WHERE A.studio = ".$studio->id."
                                        ORDER BY $sort ASC LIMIT ".($page*12)." , 12 ");
    
        if ($studio->scenes && count($studio->scenes)) {
            foreach ($studio->scenes as $key => $tube) {            
                
                $t   = $wpdb->get_results("SELECT A.name, A.slug FROM ".$wpdb->prefix."gallery_tube_pornstars A JOIN ".$wpdb->prefix."gallery_tube_scene_star B ON A.id=B.pornstar_id WHERE B.tube_id=".$tube->id );
                $studio->scenes[$key]->pornstars  = $t;            
        
            }
        } 
        return $studio;                               
    }
    else return 0;

}
$page=0;
$sort=0;
if (isset($_GET['sort'])) {
    $sort = trim($_GET['sort']);
}


if ($studio_name) {
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
    $page_num=1;
    if (isset($_GET['page_n']) && intval($_GET['page_n'])) {
        $page_num = intval($_GET['page_n']);
        
    }
    
    $total_scenes = count($studio->scenes);
    $max_page_num = $total_scenes/12 +1;

    $studio = getStudio($studio_name, $page_num, $sort);


    if (!$studio){
        wp_redirect(home_url("studios"));
    } else {

        function wp_gallery_tube_dynamic_titlestudio() {
            global $studio;
            return "Studio: ".$studio->studio_name." - ".get_bloginfo('name'); // add dynamic content to this title (if needed)
        }
        add_action( 'pre_get_document_title', 'wp_gallery_tube_dynamic_titlestudio');
    }
}

switch ($sort) {
    case 'name':
        $sort = 0;
        break;
    case 'scenes':
        $sort = 1;
        break;
    
    default:
        $sort = 0;
        break;
}
$allStudios = getStudios($page, $sort);
$totalStudios = count($allStudios);


$custom_logo_id = get_theme_mod( 'custom_logo' );
$site_logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

wp_head();
?>



<?php 


if ($studio_name) {
    include  $plugin_name . '-single-studio-page-template.php';
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
        <form class="d-none d-md-inline-block form-inline  osahan-navbar-search" method="get" action="<?=home_url('gallery')?>">
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
                <a class="nav-link" href="<?=home_url('gallery')?>">
                    <i class="fas fa-vr-cardboard"></i>
                    <span>VR Videos</span>
                </a>
            </li>
            <li class="nav-item active">
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
                                        <a class="dropdown-item" href="?sort=name"><i class="fas fa-fw fa-star"></i> &nbsp; 
                                            Name A-Z</a>
                                        <a class="dropdown-item" href="?sort=scenes"><i class="fas fa-fw fa-signal"></i> &nbsp;
                                            Total Scenes</a>
                                        
                                    </div>
                                </div>
                                <h6>Channels</h6>
                            </div>
                        </div>

                        <?php if ($allStudios && count($allStudios) ) {
                            
                            foreach ($allStudios as $key => $studio) {
                                
                            
                            ?>
                        <div class="col-xl-3 col-sm-6 mb-3">
                                
                            <div class="channels-card" style="padding:12px;">
                                <div class="channels-card-image">
                                    <a href="<?= home_url('studios/'.$studio->studio_name) ?>">
                                    <img class="img-fluid" style="width:120px;height:120px;border-radius:50%;"
                                            src="<?= $studio->logo? $studio->logo:   (plugins_url('wp-gallery-tube').'/public/img/thumbnail-img.jpg') ?>" alt="<?=$studio->studio_name?>"></a>
                                    <div class="channels-card-image-btn">
                                    <a href="<?= home_url('studios/'.$studio->studio_name) ?>"
                                            class="btn btn-outline-danger btn-sm">View Studio
                                            </a></div>
                                </div>
                                <div class="channels-card-body">
                                    <div class="channels-title" style="font-size: 1.5rem;">
                                        <a href="<?= home_url('studios/'.$studio->studio_name) ?>"><?=$studio->studio_nicename ? $studio->studio_nicename : $studio->studio_name ?> </a>
                                    </div>
                                    <div>
                                        <?=$studio->count_scene?> Scenes
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                        <?php }} ?>
                        
                    </div>
                    
                </div>
                <hr>
                
            </div>
            <!-- /.container-fluid -->
            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container">
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